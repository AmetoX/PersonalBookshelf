<!-- php artisan serve -->
<!--  npx tailwindcss -i app.css -o style.css  .pt tailwind    npx tailwindcss -i resources/css/app.css -o resources/css/style.css --watch  //pt css    npm run dev //pt vite (sa pot accesa fisiere)  <script src="https://cdn.tailwindcss.com"></script>-->
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

    <link rel="shortcut icon" type="image/png" href="{{ asset('images/book.png') }}" />
</head>

<body class="font-body bg-gradient-to-b from-palette4 to-palette3 min-h-screen">

    <!--  -->
    <div class="bg-cover bg-center bg-fixed" style="background-image: url('images/lib.jpg') ">
        <div class="h-screen flex justify-center items-center">

            <div class="relative py-3 sm:max-w-xl sm:mx-auto ">
                <div class="absolute inset-0 bg-gradient-to-br from-palette1 to-palette2 bg-opacity-50 shadow-lg transform -skew-y-6 sm:skew-y-0 sm:-rotate-6 sm:rounded-3xl "></div>
                <div class="relative px-4 py-10 bg-white shadow-lg  sm:rounded-3xl sm:p-20 ">

                    <div class="max-w-md mx-auto">
                        <div>
                            <h1 class="text-2xl font-semibold">Reset Password</h1>
                        </div>
                        <div class="divide-y divide-gray-200">
                            <div class="py-8 text-base leading-6 space-y-4 text-gray-700 sm:text-lg sm:leading-7">
                                <div class="relative">
                                    <input autocomplete="off" id="email" name="email" type="text" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Email address" />
                                    <label for="email" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Email Address</label>
                                </div>
                                <div class="relative">
                                    <input autocomplete="off" id="password" name="password" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="Password" />
                                    <label for="password" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Password</label>
                                </div>

                                <div class="relative">
                                    <input autocomplete="off" id="reenterpassword" name="reenterpassword" type="password" class="peer placeholder-transparent h-10 w-full border-b-2 border-gray-300 text-gray-900 focus:outline-none focus:borer-rose-600" placeholder="reenterpassword" />
                                    <label for="reenterpassword" class="absolute left-0 -top-3.5 text-gray-600 text-sm peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-440 peer-placeholder-shown:top-2 transition-all peer-focus:-top-3.5 peer-focus:text-gray-600 peer-focus:text-sm">Reenter Password</label>
                                </div>

                                <div class="relative">
                                    <a href="/" class="bg-palette1 absolute right-0 top-1 text-white rounded-md px-2 py-1 hover:bg-opacity-75">Reset</a>
                                </div>
                                <a href="/login" class="text-sm text-amber-900">Back to Login</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




</body>

</html>