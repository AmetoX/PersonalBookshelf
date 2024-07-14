<!-- php artisan serve -->
<!-- <script src="https://cdn.tailwindcss.com"></script> -->
<!--  npx tailwindcss -i app.css -o style.css  .pt tailwind    npx tailwindcss -i resources/css/app.css -o resources/css/style.css --watch  //pt css    npm run dev //pt vite (sa pot accesa fisiere)  <script src="https://cdn.tailwindcss.com"></script>-->
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

<body class="font-body animated-background bg-gradient-to-r from-cambridge-blue via-reseda-green2 to-resedagreen min-h-screen">


    <!-- <ul> defineste o lista si <li>item din lista -->

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

    <!-- Displaying the books in each category from the db -->
    <div class="w-fit mx-auto pt-4">
        <h2 class="mb-4 text-2xl underline font-semibold text-gray-700 ">{{ $category->name }}</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-16 justify-items-center pt-4">
            @foreach ($books as $book)
            <div class="card">
                <div class="card-body border border-black rounded-lg w-fit h-full bg-ash-gray">
                    @if ($book->cover)
                    <img class="w-64 h-96 object-cover rounded-t-lg" src="{{ $book->cover ? $book->cover : 'https://i.pinimg.com/564x/01/7c/44/017c44c97a38c1c4999681e28c39271d.jpg'}}" alt="Cover image for {{ $book->name }}">
                    @else
                    <p>No cover image available</p>
                    @endif
                    <div class="p-4">
                        <a class="text-gray-700 font-bold hover:text-myrtle-green" style="word-wrap: break-word; width: 150px; display: inline-block;" href="{{ route('displayBookFromCategory', ['id' => $book->id ])}}">
                            {{ $book->title}}
                        </a>
                        <p class="text-gray-700">{{ $book->author }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>



</body>

</html>