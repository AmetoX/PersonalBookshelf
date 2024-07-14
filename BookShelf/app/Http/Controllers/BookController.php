<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\Book;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;


class BookController extends Controller
{
    public function storeCategory(Request $request)
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please log in to create or view categories.');
        }

        // Validate user input
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Create and store the category
        $category = new Category();
        $category->name = $request->input('name');
        $category->user_id = Auth::id(); // Note: user_id instead of users_id
        $category->save();

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function showCategories()
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->back()->with('error', 'Please log in to create or view categories.');
        }

        // Fetch all categories belonging to the authenticated user
        $categories = Category::where('user_id', Auth::id())->get();

        return view('displayBookShelf', compact('categories'));
    }
    public function destroyCategory(Request $request)
    {
        // Find the category by name and user ID
        $category = Category::where('name', $request->name)
            ->where('user_id', auth()->id())
            ->first();

        // Check if the category exists
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        // Delete the category
        $category->delete();

        // Redirect back with success message
        return redirect()->back()->with('success', 'Category deleted successfully.');
    }
    public function displayCategory($catId, $userId)
    {
        // Find the category by ID
        $category = Category::find($catId);

        // Check if the category exists
        if (!$category) {
            return redirect()->back()->with('error', 'Category not found.');
        }

        // Check if the category belongs to the authenticated user
        if ($category->user_id != $userId) {
            return redirect()->back()->with('error', 'You are not authorized to view this category.');
        }

        // Load books belonging to the category and the user
        $books = $category->books()->where('user_id', $userId)->get();

        // Fetch book details from the 'shelf' table
        $bookDetails = [];
        foreach ($books as $book) {
            $bookDetail = Book::where('id', $book->id)->first();
            if ($bookDetail) {
                $bookDetails[] = $bookDetail;
            }
        }

        return view('displayCategoryContent', ['books' => $bookDetails, 'category' => $category]);
    }


    // Search

    public function searchBooks(Request $request)
    {
        // Get the search query
        $query = $request->input('query');

        // Perform the search query if the query is not empty
        if (!empty($query)) {
            try {
                // Make an HTTP request to search for books
                $books = $this->searchBooksApi($query);

                // Store the search results in the session
                session()->put('books', $books);

                // Return the books to the view
                return view('home', ['books' => $books, 'searchTerm' => $query]);
            } catch (\Exception $e) {
                // Handle API request errors
                Log::error('API request failed:', [$e->getMessage()]);

                // Flash the error message to the session
                session()->flash('errorMessage', 'API request failed: ' . $e->getMessage());
                return redirect()->back();
            }
        } else {
            // If the query is empty, return an empty result
            $books = Book::inRandomOrder()->take(10)->get();
            $index = -1;
            session()->put('books', $books);
            return view('home', ['books' => $books, 'index' => $index]);
        }
    }

    private function searchBooksApi($query)
    {
        // Make an HTTP request to the Open Library API to search for books
        $response = Http::withoutVerifying()->timeout(10)->get('https://openlibrary.org/search.json', [
            'q' => $query,
            'limit' => 10 // Limit the results
        ]);

        // Check if the request was successful
        if ($response->successful()) {
            // Extract the search results from the response
            $books = $response->json()['docs'];

            // Fetch additional details for each book
            foreach ($books as &$book) {
                $this->fetchBookDetailsForSearchResult($book);
            }

            return $books;
        } else {
            // Handle the case when the request fails
            $errorMessage = $response->body();
            throw new \Exception($errorMessage);
        }
    }

    private function fetchBookDetailsForSearchResult(&$book)
    {      
        if (isset($book['cover_i'])) {
            $book['cover_image'] = 'https://covers.openlibrary.org/b/id/' . $book['cover_i'] . '-M.jpg';
        } else {
            $book['cover_image'] = null; 
        }
        
        $book['title'] = $book['title'] ?? 'No title available';      
        $book['author_name'] = $book['author_name'] ?? 'Unknown';
    }

    public function displayBook($index, $id)
    {
        // Get the search results from the session
        $books = session('books');
        $suggestions = Book::inRandomOrder()->take(7)->get();
        
        // Check if $books is not null before proceeding
        if ($books) {
            // Check if the index is within the range of the books array
            if ($index >= 0 && $index < count($books)) {
                // Get the book details based on the index
                $book = $books[$index];

                // Fetch the book details using the book ID
                $bookDetails = $this->fetchBookDetails($id);

                // Merge the book details from the search results with the additional details fetched
                if ($bookDetails instanceof \App\Models\Book) {
                    $bookDetails = $bookDetails->toArray(); // if the book is fetched from the database
                } elseif ($bookDetails instanceof \Illuminate\View\View) {
                    // Convert the view to an array
                    $bookDetails = $bookDetails->getData();
                }
                $book = array_merge($book, $bookDetails); // if the book is fetched from the API
                
                // Store the merged book details in the session
                session()->put('bookDetails', $book);
            
                // Pass the merged book details to the view and render the displayBook.blade.php template
                return view('displayBook', ['book' => $book, 'index' => $index, 'suggestions' => $suggestions]);
            } elseif ($index == -1) {
                
                // Get the book details using the book ID
                $bookDetails = $this->fetchBookDetails($id);
                // Pass the book details to the view and render the displayBook.blade.php template
                return view('displayBook', ['book' => $bookDetails, 'index' => -1, 'suggestions' => $suggestions]);
            } else {
                // Handle case when index is out of range
                // For example, redirect back to the search page with an error message
                return redirect()->back()->with('errorMessage', 'Invalid book index.');
            }
        }
    }

    private function fetchBookDetails($id)
    {
        if ($book = $this->fetchFromDb($id)) {
            return $book;
        } else {
            return $this->fetchFromApi($id);
        }
    }

    public function displayBookFromCategory($id)
    {
        // Fetch the book details using the book ID
        $bookDetails = $this->fetchBookDetails($id);
        $suggestions = Book::inRandomOrder()->take(7)->get();
        // Check if the book details are fetched successfully
        if ($bookDetails) {
            // Pass the book details to the view and render the displayBook.blade.php template
            return view('displayBook', ['book' => $bookDetails, 'index' => -1, 'suggestions' => $suggestions]);
        } else {
            // Handle the case when the book details are not fetched
            return redirect()->back()->with('errorMessage', 'Book details not found.');
        }
    }

    private function fetchFromDb($id)
    {
        $book = Book::find($id);
        return $book;
    }

    private function fetchFromApi($id)
    {
        try {
            // Make HTTP request to the Open Library API
            $bookResponse = Http::withoutVerifying()->timeout(10)->get('https://openlibrary.org/works/' . $id . '.json');

           
            Log::info('HTTP request status:', ['status' => $bookResponse->status()]);

            // Check if the request was successful
            if ($bookResponse->successful()) {
                // Extract the book data from the API response
                $bookData = $bookResponse->json();
                
                // Fetch the cover image URL
                $coverImage = null;
                if (isset($bookData['covers'][0])) {
                    $coverImageId = $bookData['covers'][0];
                    $coverImage = 'https://covers.openlibrary.org/b/id/' . $coverImageId . '-M.jpg';
                }

                // Add cover image URL to book data
                $bookData['cover_image'] = $coverImage;

                // Handle description
                if (isset($bookData['description'])) {
                    if (is_array($bookData['description'])) {
                        // If description is an array, concatenate its elements into a single string
                        $description = $bookData['description']['value'];
                        $bookData['description'] = $description;
                    } else {
                        // If description is already a string, keep it as it is
                        $description = $bookData['description'];
                    }
                } else {
                    // If description is not set, set it to null
                    $description = null;
                }

                // Assign description to book data               
                $bookData['description'] = $description;

                // Handle subjects
                $subjects = null;
                if (isset($bookData['subjects'])) {
                    $subjects = array_slice($bookData['subjects'], 0, 5);
                }
                
                // Assign subjects to book data
                $bookData['subjects'] = $subjects;

                return $bookData;
            } else {
                
                Log::error('HTTP request to Open Library API failed:', ['status' => $bookResponse->status()]);
                return null;
            }
        } catch (\Exception $e) {
            
            Log::error('API request failed:', [$e->getMessage()]);
            return null;
        }
    }


    //adding the book

    public function addBookToCategory($index, $bookId, $categoryId)
    {
        // Check if the book already exists in the database
        $book = Book::find($bookId);
        
        // If the book isn't found in the database, use the stored book data from the session
        if (!$book && $storedBook = session('bookDetails')) {
            $book = new Book;
            $book->id = $bookId;
            $book->title = $storedBook['title'];
            $book->author = is_array($storedBook['author_name']) ? $storedBook['author_name'][0] : $storedBook['author_name'];
            $book->description = $storedBook['description'];
            $book->subjects = $storedBook['subjects'] ? implode(', ', $storedBook['subjects']) : null;
            // Check if the cover_i key exists in the storedBook array
            if (isset($storedBook['cover_i'])) {
                $book->cover = 'https://covers.openlibrary.org/b/id/' . $storedBook['cover_i'] . '-M.jpg';
            } else {
                $book->cover = null; // Default cover image URL or null
            }
            $book->save();
        }

        // Attach the book to the category
        if ($book) {
            $category = Category::find($categoryId);

            // Check if the category exists
            if (!$category) {
                return redirect()->back()->withErrors(['error' => 'Category not found']);
            }

            // Check if the book already exists in the category
            $existingBook = DB::table('shelf')
                ->where('categories_id', $categoryId)
                ->where('book_id', $book->id)
                ->where('user_id', Auth::user()->id)
                ->first();

            if ($existingBook) {
                return redirect()->back()->withErrors(['error' => 'Book already exists in this category']);
            }

            // Add the book to the user's bookshelf
            DB::table('shelf')->insert([
                'categories_id' => $categoryId,
                'book_id' => $book->id,
                'user_id' => Auth::user()->id
            ]);
        }


        // Redirect back to the book details page
        return redirect()->route('displayBook', ['index' => $index, 'id' => $bookId, 'categoryId' => $categoryId]);
    }


    public function removeBookFromCategory($index, $bookId, $categoryId)
    {       
        $book = Book::find($bookId);
        $category = Category::find($categoryId);

        if (!$book) {
            return redirect()->back()->withErrors(['error' => 'Book not found']);
        }

        if (!$category) {
            return redirect()->back()->withErrors(['error' => 'Category not found']);
        }

        DB::table('shelf')
            ->where('book_id', $bookId)
            ->where('categories_id', $categoryId)
            ->where('user_id', Auth::user()->id)
            ->delete();

        return redirect()->route('displayBook', ['index' => $index, 'id' => $bookId, 'categoryId' => $categoryId]);
    }
}
