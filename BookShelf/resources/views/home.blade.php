<!-- php artisan serve , npm install tw-elements (once)-->
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
</head>

<body class="font-body min-h-screen mt-">

    <!-- Start Background Animation Body -->
    <div class="area">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
    </div>
    <!-- End Background Animation Body -->

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


    <!-- Logo -->
    <div class="flex justify-center pt-10">
        <img src="{{ asset('images/book23.png') }}" class="object-scale-down h-48 w-96">
    </div>

    <!-- Search bar -->
    <div class="flex items-center justify-center flex-1 pt-16">
        <div class="relative w-2/4 max-w-xl mx-auto flex items-center justify-center bg-white rounded-xl">
            <form id="searchForm" action="{{ route('searchbooks') }}" method="GET" class="w-full">
                <input placeholder="Search for title, author" class="rounded-xl w-full h-16 bg-transparent py-2 pl-8 pr-32 outline-none border-2 border-gray-100 shadow-md hover:outline-none focus:ring-teal-200 focus:border-teal-200 flex items-center justify-center" type="text" name="query" id="query">
                <button type="submit" class="absolute inline-flex items-center h-10 px-4 py-2 text-sm text-white transition duration-150 ease-in-out rounded-xl outline-none right-3 top-3 bg-teal-600 sm:px-6 sm:text-base sm:font-medium hover:bg-teal-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-teal-500">
                    <svg class="-ml-0.5 sm:-ml-1 mr-2 w-4 h-4 sm:h-5 sm:w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                    Search
                </button>
            </form>
        </div>
    </div>
    <!-- End of search bar -->

    <!-- search results -->
    <div id="searchResults" class="items-center justify-center flex-1 pt-14">
        @if (session('errorMessage'))
        <div class="alert alert-danger">
            {{ session('errorMessage') }}
        </div>
        @else
        <div class="max-w-6xl mx-auto mt-10">
            <!-- Display the search term -->
            
            @if(!empty($searchTerm))
                <h1 class="text-left text-white pb-10 text-2xl">Results for "{{ $searchTerm }}"</h1>
            @endif
            
            @forelse($books as $book)
            <div class="border border-ash-gray rounded-lg p-4 text-left text-white mb-4 flex bg-dark-slate-gray">
                <img src="{{ isset($book['cover_image']) ? $book['cover_image'] : (isset($book['cover']) ? $book['cover'] : 'https://i.pinimg.com/564x/01/7c/44/017c44c97a38c1c4999681e28c39271d.jpg') }}" alt="Cover image for {{ $book['title'] }}" style="width: 100px; height: auto;" onerror="this.onerror=null; this.src='https://i.pinimg.com/564x/01/7c/44/017c44c97a38c1c4999681e28c39271d.jpg';">
                <div class="ml-4">
                    <h2 class="mt-2">
                        <a href="{{ route('displayBook', ['index' => $index ?? $loop->index ?? -1, 'id' => substr(strrchr($book['key'], '/'), 1) ? substr(strrchr($book['key'], '/'), 1) : $book -> id ]) }}" class="hover:text-reseda-green hover:underline">{{ $book['title'] }}</a>
                    </h2>
                    <p>{{ isset($book['author_name']) ? $book['author_name'][0] : $book->author }}</p>
                </div>
            </div>
            @empty
            <div class="text-center text-gray-500">No books found</div>
            @endforelse
        </div>
        @endif
    </div>
    <!-- end of search results -->






</body>

</html>