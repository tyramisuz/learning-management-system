<!DOCTYPE html>
<html>

<head>
    <title>Learning Odyssey</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('storage/logo.jpeg') }}">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">

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

    <!-- Include Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link rel="icon" type="image/x-icon" href="{{ asset('odyssey.png') }}">

</head>

<body class="">
    @include('sidenav')

    <main class="md:w-[calc(100%-256px)] md:ml-64 min-h-screen bg-gray-100 transition-all main">

        @yield('content')
    </main>

    <script src="{{ mix('js/app.js') }}"></script>

</body>

</html>
