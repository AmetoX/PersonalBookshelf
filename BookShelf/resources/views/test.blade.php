<!-- php artisan serve -->
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personal BookShelf</title>

    @vite('resources/css/style.css')
    @vite('resources/js/app.js')
    @vite('resources/css/menu.css')
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <!--  npx tailwindcss -i app.css -o style.css  .pt tailwind    npx tailwindcss -i resources/css/app.css -o resources/css/style.css --watch  //pt css    npm run dev //pt vite (sa pot accesa fisiere)  <script src="https://cdn.tailwindcss.com"></script>-->


    
</head>

<body class="font-body bg-gradient-to-b from-palette4 to-palette3 min-h-screen">







    <div class="bg-gray-100">
        <div class="h-screen flex overflow-hidden bg-gray-200">
            <!-- Sidebar -->
            <div class="absolute right-0 bg-gray-800 text-white w-56 min-h-screen overflow-y-auto transition-transform transform translate-x-full ease-in-out duration-300" id="sidebar">
           
            
                <!-- Your Sidebar Content -->
                <div class="p-4">
                    <h1 class="text-2xl font-semibold">Sidebar</h1>
                    <ul class="mt-4">
                        <li class="mb-2"><a href="#" class="block hover:text-indigo-400">Home</a></li>
                        <li class="mb-2"><a href="#" class="block hover:text-indigo-400">About</a></li>
                        <li class="mb-2"><a href="#" class="block hover:text-indigo-400">Services</a></li>
                        <li class="mb-2"><a href="#" class="block hover:text-indigo-400">Contact</a></li>
                    </ul>
                </div>
            </div>

            <!-- Content -->
            <div class="flex-1 flex flex-col overflow-hidden">
                <!-- Navbar -->
                <div class="bg-white shadow">
                    <div class="container mx-auto">
                        <div class="flex justify-between items-center py-4 px-2">
                            <h1 class="text-xl font-semibold">Animated Drawer</h1>

                            <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
                            <div class="relative py-3 sm:max-w-xl mx-2">
                                <nav x-data="{ open: false }">
                                    <button class="w-14 h-14 relative focus:outline-none bg-green-600 rounded" @click="open = !open " id="open-sidebar">
                                        <div class="block w-5 absolute left-6 top-1/2   transform  -translate-x-1/2 -translate-y-1/2">
                                            <span class="block absolute h-0.5 w-7 text-white bg-current transform transition duration-500 ease-in-out" :class="{'rotate-45': open,' -translate-y-1.5': !open }"></span>
                                            <span class="block absolute  h-0.5 w-5 text-white bg-current   transform transition duration-500 ease-in-out" :class="{'opacity-0': open } "></span>
                                            <span class="block absolute  h-0.5 w-7 text-white bg-current transform  transition duration-500 ease-in-out" :class="{'-rotate-45': open, ' translate-y-1.5': !open}"></span>
                                        </div>
                                    </button>
                                </nav>
                            </div>
                            </button>
                        </div>
                    </div>
                </div>
                <!-- Content Body -->
                <div class="flex-1 overflow-auto p-4">
                    <h1 class="text-2xl font-semibold">Welcome to our website</h1>
                    <p>... Content goes here ...</p>
                </div>
            </div>
        </div>
    </div>




    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js"></script>
    <div class="relative py-3 sm:max-w-xl mx-2">
        <nav x-data="{ open: false }">
            <button class="w-14 h-14 relative focus:outline-none bg-green-600 rounded" @click="open = !open " id="open-sidebar">
                <div class="block w-5 absolute left-6 top-1/2   transform  -translate-x-1/2 -translate-y-1/2">
                    <span class="block absolute h-0.5 w-7 text-white bg-current transform transition duration-500 ease-in-out" :class="{'rotate-45': open,' -translate-y-1.5': !open }"></span>
                    <span class="block absolute  h-0.5 w-5 text-white bg-current   transform transition duration-500 ease-in-out" :class="{'opacity-0': open } "></span>
                    <span class="block absolute  h-0.5 w-7 text-white bg-current transform  transition duration-500 ease-in-out" :class="{'-rotate-45': open, ' translate-y-1.5': !open}"></span>
                </div>
            </button>
        </nav>
    </div>


</body>

</html>