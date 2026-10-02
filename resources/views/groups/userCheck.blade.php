<!DOCTYPE html>
<html>

    <head>
        <title>Learning Odyssey</title>

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
        <link href="{{ asset('css/style.css') }}" rel="stylesheet">


        <!-- Include Tailwind CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css">

        <!-- Include Flatpickr CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


        <style>
            .clock-dropdown {
                display: none;
            }
        </style>

        <!-- Include jQuery -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


        <!-- Include Flatpickr JS -->
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

        <link rel="icon" type="image/x-icon" href="{{ asset('odyssey.png') }}">


        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
        
        
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
        
        <script src="https://unpkg.com/@popperjs/core@2"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </head>

    @if ($errors->any())
    <div id="alert" class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
        <div>
        <span class="font-medium">There were some problems with your input:</span>
        <ul class="mt-1.5 list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{$error}}</li>
            @endforeach
        </ul>
        </div>
    </div>
    
    @endif
    @if ($message = Session::get('success'))
    <div id="alert" class=" alert flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <div class="ms-3 text-sm font-medium">
        {{$message}}
        </div>
    </div>
    @endif

    <!-- component -->
    <body class="flex justify-center items-center h-screen bg-white">
        <section class="w-full sm:max-w-md mt-6 px-2 py-2 overflow-hidden sm:rounded-lg">
            <div class="flex justify-center mb-10">
                <img class="w-14 h-14 sm:w-24 sm:h-24 md:w-26 md:h-26 lg:w-28 lg:h-28 xl:w-32 xl:h-32" alt="Logo" src="{{ asset('odyssey.png') }}">
            </div>
            <div class="max-w-md w-full bg-gray-300 shadow-lg rounded-lg p-6 space-y-4">
                <div class="mb-4">
                    <p class="text-gray-600">User Authentication Check</p>
                    <h2 class="text-xl font-bold">Join Group</h2>
                </div>
                <form action="{{ route('groups.view', $id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <input name="name" class="w-full mb-2 p-4 text-sm bg-gray-50 focus:outline-none border border-gray-200 rounded text-gray-600" type="text" placeholder="Username">
                    </div>
                    <div>
                        <input name="email" class="w-full mb-2 p-4 text-sm bg-gray-50 focus:outline-none border border-gray-200 rounded text-gray-600" type="email" placeholder="Email">
                    </div>
                    <div>
                        <input name="password" class="w-full mb-4 p-4 text-sm bg-gray-50 focus:outline-none border border-gray-200 rounded text-gray-600" type="password" placeholder="Password">
                    </div>
                    <div>
                        <button class="w-full py-2 bg-blue-600 hover:bg-blue-700 rounded text-sm font-bold text-gray-50 transition duration-200">Submit</button>
                    </div>
                    <div class="flex mt-2 items-center justify-between">
                        <div>
                        @if (Route::has('password.request'))
                            <a class="text-sm text-blue-600 hover:underline" href="{{ route('password.request') }}">Forgot password?</a>
                        @endif
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </body>

</html>