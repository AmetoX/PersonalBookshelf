<!-- php artisan serve -->
<!-- npx tailwindcss -i app.css -o style.css  .pt tailwind    npx tailwindcss -i resources/css/app.css -o resources/css/style.css --watch  //pt css    npm run dev //pt vite (sa pot accesa fisiere)  <script src="https://cdn.tailwindcss.com"></script>-->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal BookShelf</title>

    @vite('resources/css/style.css')
    @vite('resources/js/app.js')
    @vite('resources/css/custom.css')

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/book.png') }}" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/tw-elements/1.0.0/tw-elements.min.css" rel="stylesheet" />
</head>

<body class="font-body animated-background bg-gradient-to-r from-cambridge-blue via-ash-gray to-resedagreen min-h-screen">


    <!-- The menu -->
    <nav x-data="{
                navigationMenuOpen: false,
                navigationMenu: '',
                navigationMenuCloseDelay: 200,
                navigationMenuCloseTimeout: null,
                navigationMenuLeave() {
                let that = this;
                this.navigationMenuCloseTimeout = setTimeout(() => {
                that.navigationMenuClose();
                }, this.navigationMenuCloseDelay);
                },
                navigationMenuReposition(navElement) {
                this.navigationMenuClearCloseTimeout();                   
                this.$refs.navigationDropdown.style.left = navElement.offsetLeft + 'px';
                this.$refs.navigationDropdown.style.marginLeft = (navElement.offsetWidth/2) + 'px';                    
                },
                navigationMenuClearCloseTimeout(){
                clearTimeout(this.navigationMenuCloseTimeout);
                },
                navigationMenuClose(){
                this.navigationMenuOpen = false;
                this.navigationMenu = '';
                }}" class="relative z-10 w-full">
        <div class="relative flex flex-row justify-between items-center py-1 px-4">
            <div class="flex-1"></div>
            <div class="flex flex-row justify-center items-center gap-4">

                <div>
                    <a href="/" class="inline-flex items-center justify-center h-10 px-4 py-2 text-xm font-medium transition-colors text-white rounded-md hover:text-black focus:outline-none disabled:opacity-50 disabled:pointer-events-none bg-background hover:bg-ash-gray group w-max">
                        Search
                    </a>
                </div>

                <div>
                    <button :class="{ 'bg-ash-gray' : navigationMenu=='explore', 'hover:bg-neutral-100' : navigationMenu!='explore' }" @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='explore'" @mouseleave="navigationMenuLeave()" class="inline-flex items-center justify-center h-10 px-4 py-2 text-xm font-medium transition-colors rounded-md text-white hover:text-black focus:outline-none disabled:opacity-50 disabled:pointer-events-none bg-background hover:bg-neutral-100 group w-max">
                        <span>Explore</span>
                        <svg :class="{ '-rotate-180' : navigationMenuOpen==true && navigationMenu == 'explore' }" class="relative top-[1px] ml-1 h-3 w-3 ease-out duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                </div>

                <div>
                    <button :class="{ 'bg-ash-gray' : navigationMenu=='comunity', 'hover:bg-neutral-100' : navigationMenu!='comunity' }" @mouseover="navigationMenuOpen=true; navigationMenuReposition($el); navigationMenu='comunity'" @mouseleave="navigationMenuLeave()" class="inline-flex items-center justify-center h-10 px-4 py-2 text-xm font-medium transition-colors text-white hover:text-black rounded-md hover:white focus:outline-none disabled:opacity-50 disabled:pointer-events-none group w-max">
                        <span>Community</span>
                        <svg :class="{ '-rotate-180' : navigationMenuOpen==true && navigationMenu == 'comunity' }" class="relative top-[1px] ml-1 h-3 w-3 ease-out duration-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                </div>

                @if (auth()->check())
                <div>
                    <a href="{{ route('showCategories') }}" class="inline-flex items-center justify-center h-10 px-4 py-2 text-xm font-medium transition-colors text-white rounded-md hover:text-black focus:outline-none disabled:opacity-50 disabled:pointer-events-none bg-background hover:bg-ash-gray group w-max">
                        BookShelf
                    </a>
                </div>
                @endif
            </div>

            <div class="flex-1 flex justify-end">
                <div x-data="{ open: false }" @mouseenter="open = true" @mouseleave="open = false" class="relative">
                    @if (!auth()->check())
                    <button @mouseover="open = true" @mouseenter="open = true" @mouseleave="open = false" :class="{ 'bg-ash-gray': open }" class="inline-flex items-right justify-center h-10 px-5 py-2 text-xm font-medium transition-colors rounded-md focus:outline-none disabled:opacity-50 disabled:pointer-events-none group w-max hover:text-black hover:bg-ash-gray">
                        Log In
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" x-placement="bottom-end" @mouseenter="open = true" @mouseleave="open = false" class="absolute right-0 mt-2 w-20 bg-white shadow-md rounded-md overflow-hidden">
                        <a href="/login" class="flex px-2 py-2 text-sm text-gray-700 hover:bg-ash-gray rounded-lg flex-row flex-1 justify-center">Login</a>
                        <a href="/register" class="flex px-2 py-2 text-sm text-gray-700 hover:bg-ash-gray rounded-lg flex-row flex-1 justify-center">Register</a>
                    </div>

                    @else
                    <button @mouseover="open = true" @mouseenter="open = true" @mouseleave="open = false" :class="{ 'bg-ash-gray': open }" class="inline-flex flex-row items-center justify-center h-10 px-5 py-2 text-lg font-medium transition-colors rounded-md focus:outline-none disabled:opacity-50 disabled:pointer-events-none group w-max text-white hover:text-black hover:bg-ash-gray">
                        <img src="{{ asset('images/user.png') }}" alt="User Icon" class="mr-1 h-4 w-4">
                        {{ auth()->user()->name }}
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0 scale-95" x-transition:enter-end="transform opacity-100 scale-100" x-transition:leave="transition ease-in duration-75" x-transition:leave-start="transform opacity-100 scale-100" x-transition:leave-end="transform opacity-0 scale-95" x-placement="bottom-end" @mouseenter="open = true" @mouseleave="open = false" class="absolute right-0 mt-2 min-w-full bg-white shadow-md rounded-md overflow-hidden">
                        <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center px-2 py-2 text-sm text-gray-700 hover:bg-ash-gray rounded-lg justify-center w-full">Logout</button>
                        </form>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div x-ref="navigationDropdown" x-show="navigationMenuOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" @mouseover="navigationMenuClearCloseTimeout()" @mouseleave="navigationMenuLeave()" class="absolute top-0 pt-3 duration-200 ease-out -translate-x-1/2 translate-y-11" x-cloak>
            <div class="flex justify-center w-auto h-auto overflow-hidden bg-white border rounded-md shadow-sm border-neutral-200/70">

                <!-- First menu -->
                <div x-show="navigationMenu == 'explore'" class="flex items-stretch justify-center w-full p-6">
                    <div class="flex-shrink-0 w-48 rounded pt-28 pb-7 bg-favicon bg-center bg-cover">
                        <div class="relative px-7 space-y-1.5 text-white">
                            <span class="block font-bold"></span>
                            <span class="block text-sm opacity-60"></span>
                        </div>
                    </div>
                    <div class="w-72">
                        <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-ash-gray">
                            <span class="block mb-1 font-medium text-black">Categories</span>
                            <span class="block font-medium leading-5 opacity-50">Find new books by categories(genres).</span>
                        </a>
                        <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-ash-gray">
                            <span class="block mb-1 font-medium text-black">Popular</span>
                            <span class="block font-medium leading-5 opacity-50">Find the hot books at the moment.</span>
                        </a>
                        <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-ash-gray">
                            <span class="block mb-1 font-medium text-black">Our recomandations</span>
                            <span class="block font-medium leading-5 opacity-50">Books that we consider you should try.</span>
                        </a>
                    </div>
                </div>

                <!-- Second menu -->
                <div x-show="navigationMenu == 'comunity'" class="flex items-stretch justify-center w-full max-w-2xl p-6 gap-x-3">
                    <div class="flex-shrink-0 w-48 rounded pt-28 pb-7 bg-favicon2 bg-center bg-cover">
                        <div class="relative px-7 space-y-1.5 text-white">
                            <span class="block font-bold"></span>
                            <span class="block text-sm opacity-60"></span>
                        </div>
                    </div>
                    <div class="w-72">
                        <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-ash-gray">
                            <span class="block mb-1 font-medium text-black">Discussions</span>
                            <span class="block font-medium leading-5 opacity-50">Discuss abut differnt subjects.</span>
                        </a>
                        <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-ash-gray">
                            <span class="block mb-1 font-medium text-black">Groups</span>
                            <span class="block font-medium leading-5 opacity-50">Find groups and chat about your favorites books & topics.</span>
                        </a>
                        <a href="#_" @click="navigationMenuClose()" class="block px-3.5 py-3 text-sm rounded hover:bg-ash-gray">
                            <span class="block mb-1 font-medium text-black">Quotes</span>
                            <span class="block font-medium leading-5 opacity-50">Quotes among the readers.</span>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </nav>
    <!-- End of menu -->


    <!-- Display book details -->
    <div class="flex justify-center p-8">
        <div class="book-details bg-ash-gray bg-opacity-80 p-6 rounded-lg shadow-md w-4/5 flex">
            @if($book)
            <img src="{{ isset($book['cover_image']) ? $book['cover_image'] : (isset($book['cover']) ? $book['cover'] : 'https://i.pinimg.com/564x/01/7c/44/017c44c97a38c1c4999681e28c39271d.jpg') }}" alt="Cover image for {{ $book['title'] }}" class="w-[350px] h-[400px] object-contain object-top mr-5 border-2 border-black rounded-lg" onerror="this.onerror=null; this.src='https://i.pinimg.com/564x/01/7c/44/017c44c97a38c1c4999681e28c39271d.jpg';">
            <div>
                <h1 class="text-2xl">{{ isset($book['title']) ? $book['title'] : 'No title available' }}</h1>
                <h2 class="text-black text-xl underline">{{ isset($book['author_name']) ? $book['author_name'][0] : $book->author }}</h2>

                <br>
                @auth

                <!-- Adding the book to the library -->

                @php
                $bookId = isset($book['key']) ? substr(strrchr($book['key'], '/'), 1) : $book->id;
                $categoriesWithoutBook = Auth::user()->categories->filter(function ($category) use ($bookId) {
                    return !$category->books()->where('book_id', $bookId)->where('user_id', Auth::user()->id)->exists();
                });
                @endphp

                @if(Auth::user()->categories->count() == 0)
                <!-- Link to bookshelf page to create a list -->
                <div class="mt-4">
                    <a href="{{ route('showCategories') }}" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-3 py-2 bg-cambridge-blue text-xs font-medium text-white hover:bg-gray-50 hover:text-black focus:outline-none">
                        Create your first list
                    </a>
                </div>
                @elseif($categoriesWithoutBook->count() > 0)
                <!-- Add book dropdown -->
                <div x-data="{ open: false }" class="relative inline-block text-left">
                    <button @click="open = !open" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-cambridge-blue text-sm font-medium text-white hover:bg-gray-50 hover:text-black focus:outline-none">
                        Add
                        <img src="{{ asset('images/save.png') }}" alt="Add to bookshelf" class="w-5 h-5 ml-2">
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition class="origin-top-right absolute right-0 mt-2 w-fit rounded-md shadow-lg bg-cambridge-blue ring-1 ring-black ring-opacity-5">
                        <ul>
                            @foreach($categoriesWithoutBook as $category)
                            <li>
                                <a href="{{ route('addBookToCategory', ['index' => $index, 'id' => $bookId, 'categoryId' => $category->id]) }}" class="block px-4 py-2 text-sm text-white hover:bg-gray-100 hover:text-black">
                                    {{ $category->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif

                @php
                $bookId = isset($book['key']) ? substr(strrchr($book['key'], '/'), 1) : $book->id;
                $categoriesWithBook = Auth::user()->categories->filter(function ($category) use ($bookId) {
                    return $category->books()->where('book_id', $bookId)->where('user_id', Auth::user()->id)->exists();
                });
                @endphp

                @if($categoriesWithBook->count() > 0)
                <!-- Remove book dropdown -->
                <div x-data="{ open: false }" class="relative inline-block text-left mt-2">
                    <button @click="open = !open" class="inline-flex justify-center w-full rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-cambridge-blue text-sm font-medium text-white hover:text-black hover:bg-gray-50 focus:outline-none">
                        Remove
                        <img src="{{ asset('images/remove.png') }}" alt="Remove from bookshelf" class="w-5 h-5 ml-2">
                    </button>

                    <div x-show="open" @click.away="open = false" x-transition class="origin-top-right absolute right-0 mt-2 w-fit rounded-md shadow-lg bg-cambridge-blue  ring-1 ring-black ring-opacity-5">
                        <ul>
                            @foreach($categoriesWithBook as $category)
                            <li>
                                <a href="{{ route('removeBookFromCategory', ['index' => $index, 'id' => $bookId, 'categoryId' => $category->id]) }}" class="block px-4 py-2 text-sm text-white hover:text-black hover:bg-gray-100">
                                    {{ $category->name }}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
                @endauth

                <br><br>
                <!-- Display the book description-->
                <h3 class="text-black text-lg font-bold underline">Description:</h3>
                <p class="text-lg">{{ isset($book['description']) ? $book['description'] : 'No description available' }}</p>

                <!-- Display subjects -->
                
                @if(isset($book['subjects']))
                <div class="mt-5">
                    <h3 class="text-black text-lg">Categories:</h3>
                    <p class="text-black text-base">
                        @if(is_string($book['subjects']))
                        {{ $book['subjects'] }}
                        @elseif(is_array($book['subjects']))
                        {{ implode(', ', array_slice($book['subjects'], 0, 10)) }} <!-- Display the first 10 items -->
                        @endif
                    </p>
                </div>
                @endif
                
            </div>
            @else
            <p>No book data available</p>
            @endif
        </div>
    </div>


    <!-- End of book details -->


    <!-- Recomandations --> 
    <div class="suggestions flex flex-wrap justify-center space-x-12 mt-32">
        <h2 class="text-2xl  text-black w-full text-center mb-4">Our Suggestions:</h2>
        @foreach($suggestions as $suggestion)
        <div class="card w-32">
            <div class="card-body border border-black rounded-lg w-40 h-full">
                <img class="w-full h-48 object-cover rounded-t-lg" src="{{ isset($suggestion['cover_image']) ? $suggestion['cover_image'] : (isset($suggestion['cover']) ? $suggestion['cover'] : 'https://i.pinimg.com/564x/01/7c/44/017c44c97a38c1c4999681e28c39271d.jpg') }}" alt="Cover image for {{ $suggestion['title'] }}" onerror="this.onerror=null; this.src='https://i.pinimg.com/564x/01/7c/44/017c44c97a38c1c4999681e28c39271d.jpg';">
                <div class="p-1">
                    <a href="{{ route('displayBook', ['index' => -1, 'id' => $suggestion->id]) }}" class="text-blackfont-bold hover:underline hover:text-sage " style="word-wrap: break-word; width: 150px; display: inline-block;">{{ $suggestion['title'] }}</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>









    <script src="https://cdnjs.cloudflare.com/ajax/libs/tw-elements/1.0.0/tw-elements.umd.min.js"></script>
</body>

</html>