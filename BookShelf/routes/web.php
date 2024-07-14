<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

// Everyone

Route::get('/', function () { // '/' is the root URL of the website (http://localhost:8000/) 
    return view('home'); // 'home' is the name of the view file
});

Route::post('/', function () {
    return view('home');
});

Route::get('/resetpassword', function () {
    return view('resetpassword');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/test', function () {
    return view('test');
});




// Users
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register'); // 'register' is the name of the route and can be used to generate URLs in the views using the route() helper function , get request to the register route to display the registration form
Route::post('/register', [UserController::class, 'register'])->name('register'); // post request to the register route to handle the form submission 


// Route to display the login form
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');

// Route to handle the login form submission
Route::post('/login', [UserController::class, 'login']);

// Logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// DB

//Route::get('/', [BookController::class, 'index']); // get request to the root URL to display the starting page , show all books
//Route::get('/bookshelf', [BookController::class, 'showlib']); // get request to the personal route to display the personal bookshelf , show personal books

Route::get('/bookshelf', [BookController::class, 'showCategories'])->name('showCategories'); // get request to the personal route to display the personal bookshelf , show personal books
Route::post('/categories', [BookController::class, 'storeCategory'])->name('storeCategory'); // post request to the categories route to store a category
Route::delete('/categories', [BookController::class, 'destroyCategory'])->name('destroyCategory'); // delete request to the categories route to delete a category
Route::get('/categoryContent/{catId}/{userId}', [BookController::class, 'displayCategory'])->name('displayCategory'); // get request to the categories route to display a category

Route::get('/book/works/{id}/bookfromcategory', [BookController::class, 'displayBookFromCategory'])->name('displayBookFromCategory'); 

// Search
Route::get('/', [BookController::class, 'searchBooks'])->name('searchbooks'); // get request to the root URL to display the starting page , search for books
Route::get('/book/works/{index}/{id}', [BookController::class, 'displayBook']) ->name('displayBook');

// Add/remove books
Route::get('/book/works/{index}/{id}/{categoryId}/add', [BookController::class, 'addBookToCategory'])->name('addBookToCategory');
Route::get('/book/works/{index}/{id}/{categoryId}/remove', [BookController::class, 'removeBookFromCategory'])->name('removeBookFromCategory');


