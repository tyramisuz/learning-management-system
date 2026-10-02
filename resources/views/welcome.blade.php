<!DOCTYPE html>
<html class="">

<head>
    <title>Learning Odyssey</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('odyssey.png') }}">

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

    <!-- font  -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />

    <!-- lotti  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.7.10/lottie.min.js"></script>


    <style>
        #alert {
            transition: opacity 0.5s ease-out;
        }
    
        .tooltip {
                position: relative;
                display: inline-block;
            }
    
            .tooltip .tooltip-text {
                visibility: hidden;
                width: 100px;
                background-color: black;
                color: #fff;
                text-align: center;
                border-radius: 4px;
                padding: 2px 0;
                position: absolute;
                z-index: 1;
                bottom: 125%;
                left: 50%;
                margin-left: -60px;
                opacity: 0;
                transition: opacity 0.3s;
            }
    
            .tooltip:hover .tooltip-text {
                visibility: visible;
                opacity: 1;
            }
    </style>
    
    <style>

        /* * {
            outline: 1px solid red;
        } */

        html {
            scroll-behavior: smooth;
        }

        .custom-login, .register {
            background-color: #2979ff; 
            /* transition: background-color 0.3s ease; */
        }

        .custom-login:hover, .register:hover, {
            background-color: #0d47a1; 
        }
  
        .custom-signup:hover, .video:hover, {
            background-color: #eeeeee; 
            color: #0d47a1;
        }
        
        .topnav:hover {
          background-color: #f0f4f8; 
          border: 2px solid #3b82f6; 
          color: #1d4ed8;
        }

        .join:hover{
          color: #1d4ed8;
        }

        .topnav {
          transition: background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease;
        }

        .animation-container {
            display: flex;
            justify-content: center; 
            align-items: center; 
            margin: 0 auto; 
            height: auto; 
        }

        .lottie-animation {
            width: 250px; 
            height: 250px; 
            max-width: 50vw; 
            max-height: 50vw; 
        }

        .card-container {
            position: relative;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-container:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        .card-container a {
            text-decoration: none;
            color: inherit;
        }

        .card-container h5 {
            margin-bottom: 1rem;
        }

        .card-container p {
            margin-bottom: 1rem;
        }

        .card-container .btn-see-how {
            color: #ffffff; 
            background-color: #1d4ed8; 
            border-radius: 0.375rem; 
        }

        .card-container .btn-see-how:hover {
            background-color: #1e40af; 
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        /* Animation for Rocket Icon */
        @keyframes rocket-launch {
            0% { transform: translateY(0); }
            100% { transform: translateY(-10px); }
        }

        .card-container .animate-pulse {
            animation: rocket-launch 1s infinite;
        }

        /* Animation for Progress Bar Icon */
        @keyframes progress-bar {
            0% { transform: scaleX(1); }
            50% { transform: scaleX(0.9); }
            100% { transform: scaleX(1); }
        }

        .card-container .animate-pulse {
            animation: progress-bar 1s infinite;
        }

        /* Animation for Bell Icon */
        @keyframes bell-ring {
            0% { transform: rotate(0deg); }
            50% { transform: rotate(10deg); }
            100% { transform: rotate(0deg); }
        }

        .card-container .animate-ring {
            animation: bell-ring 1s infinite;
        }

        /* Add a gradient background and box-shadow */
        .addition {
            background: linear-gradient(to right, #e0f2f1, #c6ffdd);
        }

        /* Hover effects */
        .addition:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            transform: scale(1.05);
        }

        /* Link hover effect */
        .group:hover span {
            color: #1d4ed8;
            border-bottom: 2px solid #1d4ed8;
        }

        /* Arrow animation */
        .group-hover:translate-x-1 {
            transform: translateX(4px);
        }

        /* Transition effects */
        .transition-transform {
            transition: transform 0.3s ease;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        /* styles.css */
        .quiz-card-each {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .quiz-card-each:hover {
            transform: scale(1.05); 
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15); 
        }

        .card-content {
            padding: 1.5rem;
            border-radius: 0.5rem;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }


        .review-stars svg {
            transition: transform 0.3s ease, fill 0.3s ease;
        }

        .review-stars svg:hover {
            transform: scale(1.2);
        }

        .feature-card {
          position: relative;
          padding-left: 4rem;
          padding: 1.5rem; 
          border: 1px solid transparent;
          border-radius: 0.5rem;
          background-color: white;
          box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
          transition: background-color 0.3s ease, box-shadow 0.3s ease, transform 0.3s ease;
        }

        .feature-card:hover {
          background-color: #f0f4f8;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
          transform: scale(1.03); 
        }

        .icon {
          height: 2rem; 
          width: 2rem; 
          color: white;
        }

        .icon-container .icon {
          transition: transform 0.3s ease;
        }

        /* Animations */
        .animate-bounce {
          animation: bounce 1s infinite;
        }

        .animate-pulse {
          animation: pulse 2s infinite;
        }

        .animate-spin {
          animation: spin 1s infinite linear;
        }

        .animate-ping {
          animation: ping 1s infinite;
        }

        @keyframes bounce {
          0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
          }
          40% {
            transform: translateY(-30px);
          }
          60% {
            transform: translateY(-15px);
          }
        }

        @keyframes pulse {
          0% {
            transform: scale(1);
            opacity: 1;
          }
          50% {
            transform: scale(1.05);
            opacity: 0.5;
          }
          100% {
            transform: scale(1);
            opacity: 1;
          }
        }

        @keyframes spin {
          0% {
            transform: rotate(0deg);
          }
          100% {
            transform: rotate(360deg);
          }
        }

        @keyframes ping {
          0% {
            transform: scale(1);
            opacity: 1;
          }
          75%, 100% {
            transform: scale(2);
            opacity: 0;
          }
        }

        .content-section {
          background-color: #1976d2; 
          padding: 2rem; 
          /* border-radius: 0.5rem;  */
          box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); 
        }

        .social:hover{
          color: #ffeb3b;
        }
        .content-section h2 {
          background: linear-gradient(to right, #455a64, #263238); 
          -webkit-background-clip: text; 
          -webkit-text-fill-color: transparent; 
          display: inline-block; 
        }

        .content-section p.headline {
          color: #ffc107;
        }

        .content-section p.subheading {
          color: #4b5563; 
        }

        .content-section p.description {
          color: #ffffff; 
        }

        #testimonialCarousel {
          transition: transform 0.5s ease;
        }

    
    </style>

  <!-- animated word quizzes  -->
    <style>
      /* Google chrome */
      @-webkit-keyframes svg-text-anim  {
        40% {
          stroke-dashoffset: 0;
          fill: transparent;
        }
        60% {
          stroke-dashoffset: 0;
          fill: #ffc107;
        }
        100% {
          stroke-dashoffset: 0;
          fill: #ffc107;
        }
      }

      @keyframes svg-text-anim  {
        40% {
          stroke-dashoffset: 0;
          fill: transparent;
        }
        60% {
          stroke-dashoffset: 0;
          fill: #ffc107;
        }
        100% {
          stroke-dashoffset: 0;
          fill: #ffc107;
        }
      }

      /* #svgGroup {
        animation: svg-text-anim 2s ease-in-out forwards;
      } */

    </style>
    
</head>

@if ($errors->any())
  <div id="alert" class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
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
  <div id="alert" class=" alert flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50" role="alert">
    <div class="ms-3 text-sm font-medium">
      {{$message}}
    </div>
  </div>
@endif
<!-- timer message -->
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Select the alert message
        var alertMessage = document.getElementById('alert');

        // If the alert message exists, set a timeout to hide it
        if (alertMessage) {
            setTimeout(function() {
                alertMessage.style.display = 'none';
            }, 5000); 
        }
    });
</script>

<body class="overflow-x-hidden">
  <x-app-layout>

    <div class="bg-white">
      <!-- Header -->
      <header class="fixed inset-x-0 top-0 z-50 w-full bg-white shadow">
        <nav class="flex items-center justify-between p-4 lg:px-8" aria-label="Global">
        <div class="flex items-center justify-between w-full lg:flex-1">
            <a href="#" class="flex items-center relative">
                <img class="h-12 w-auto" src="{{asset('odyssey2.png')}}" alt="Odyssey">
                <!-- <span class="text-transparent ml-2 bg-clip-text bg-gradient-to-r from-blue-500 to-purple-600 text-2xl font-bold">Odyssey</span> -->
                <!-- <span class="text-transparent ml-2 bg-clip-text bg-gradient-to-r from-slate-400 to-indigo-500 text-2xl font-bold">Odyssey</span> -->
                <span class="text-transparent ml-2 bg-clip-text bg-gradient-to-r from-gray-400 to-blue-500 text-2xl font-bold">Odyssey</span>

                <!-- <video autoplay muted loop playsinline class="w-1/4 h-1/7 ">
                    <source src="{{asset('animatedLogo.mp4')}}" type="video/mp4">
                </video> -->
            </a>
          <div id="social" class="flex gap-4 items-center">
                <svg fill="#1C2033" class="social" width="24" height="24" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_412_53)"><path d="M54.2141 11.2742C50.0713 9.33582 45.6415 7.92712 41.0104 7.125C40.4416 8.1533 39.7772 9.53637 39.319 10.6366C34.396 9.89625 29.5182 9.89625 24.6858 10.6366C24.2277 9.53637 23.5481 8.1533 22.9743 7.125C18.3382 7.92712 13.9033 9.341 9.76051 11.2844C1.40438 23.9116 -0.86083 36.2252 0.271778 48.3639C5.814 52.5027 11.1851 55.0169 16.4655 56.6621C17.7693 54.8678 18.9321 52.9603 19.9338 50.9501C18.026 50.2251 16.1987 49.3306 14.4722 48.292C14.9302 47.9526 15.3783 47.5979 15.8111 47.2328C26.3419 52.1583 37.7837 52.1583 48.1886 47.2328C48.6266 47.5979 49.0745 47.9526 49.5276 48.292C47.7959 49.3356 45.9637 50.2302 44.0559 50.9552C45.0576 52.9603 46.2154 54.873 47.5242 56.6672C52.8097 55.022 58.1858 52.5079 63.728 48.3639C65.0569 34.292 61.4578 22.0916 54.2141 11.2742ZM21.3685 40.8987C18.2073 40.8987 15.6148 37.9475 15.6148 34.3537C15.6148 30.7599 18.1519 27.8036 21.3685 27.8036C24.5851 27.8036 27.1775 30.7547 27.1221 34.3537C27.1271 37.9475 24.5851 40.8987 21.3685 40.8987ZM42.6313 40.8987C39.4701 40.8987 36.8776 37.9475 36.8776 34.3537C36.8776 30.7599 39.4147 27.8036 42.6313 27.8036C45.8479 27.8036 48.4403 30.7547 48.385 34.3537C48.385 37.9475 45.8479 40.8987 42.6313 40.8987Z"/></g><defs><clipPath id="clip0_412_53"><rect width="64" height="64" fill="white"/></clipPath></defs></svg>
                <svg fill="#1C2033" class="social" width="24" height="24" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><path d="M56.1 15.3L59.9 10.5C61 9.2 61.3 8.2 61.4 7.7C58.4 9.5 55.6 10.1 53.8 10.1H53.1L52.7 9.7C50.3 7.6 47.3 6.5 44.1 6.5C37.1 6.5 31.6 12.3 31.6 19C31.6 19.4 31.6 20 31.7 20.4L32 22.4L29.9 22.3C17.1 21.9 6.6 10.9 4.9 9C2.1 14 3.7 18.8 5.4 21.8L8.8 27.4L3.4 24.4C3.5 28.6 5.1 31.9 8.2 34.3L10.9 36.3L8.2 37.4C9.9 42.5 13.7 44.6 16.5 45.4L20.2 46.4L16.7 48.8C11.1 52.8 4.1 52.5 1 52.2C7.3 56.6 14.8 57.6 20 57.6C23.9 57.6 26.8 57.2 27.5 56.9C55.5 50.3 56.8 25.3 56.8 20.3V19.6L57.4 19.2C60.8 16 62.2 14.3 63 13.3C62.7 13.4 62.3 13.6 61.9 13.7L56.1 15.3Z"/></svg>
                <svg fill="#1C2033" class="social" width="24" height="24" viewBox="0 0 64 64" xmlns="http://www.w3.org/2000/svg"><path d="M32.1 43.6004C38.5065 43.6004 43.7 38.4069 43.7 32.0004C43.7 25.5939 38.5065 20.4004 32.1 20.4004C25.6935 20.4004 20.5 25.5939 20.5 32.0004C20.5 38.4069 25.6935 43.6004 32.1 43.6004Z"/><path d="M44.7 1H19.3C9.2 1 1 9.2 1 19.3V44.5C1 54.8 9.2 63 19.3 63H44.5C54.8 63 63 54.8 63 44.7V19.3C63 9.2 54.8 1 44.7 1ZM32.1 47.2C23.6 47.2 16.9 40.3 16.9 32C16.9 23.7 23.7 16.8 32.1 16.8C40.4 16.8 47.2 23.7 47.2 32C47.2 40.3 40.5 47.2 32.1 47.2ZM53.1 18.2C52.1 19.3 50.6 19.9 48.9 19.9C47.4 19.9 45.9 19.3 44.7 18.2C43.6 17.1 43 15.7 43 14C43 12.3 43.6 11 44.7 9.8C45.8 8.6 47.2 8 48.9 8C50.4 8 52 8.6 53.1 9.7C54.1 11 54.8 12.5 54.8 14.1C54.7 15.7 54.1 17.1 53.1 18.2Z"/><path d="M49.0016 11.5996C47.7016 11.5996 46.6016 12.6996 46.6016 13.9996C46.6016 15.2996 47.7016 16.3996 49.0016 16.3996C50.3016 16.3996 51.4016 15.2996 51.4016 13.9996C51.4016 12.6996 50.4016 11.5996 49.0016 11.5996Z"/></svg>
            <a href="#faq"
              class="hidden lg:block select-none rounded-lg mr-4 border hover:bg-gray-200 border-gray-900 py-2.5 px-2 text-center align-middle font-sans text-xs font-bold uppercase text-gray-900 transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
              type="button">
              FAQ's
            </a>  
          </div>

          <!-- Hamburger Button  -->
            <div class="ml-2 lg:hidden">
                <button id="mobile-menu-button" class="text-gray-700 hover:text-gray-900 focus:outline-none">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="hidden lg:flex lg:gap-x-4">
            <a href="#quizzes" class="text-m topnav font-roboto font-semibold leading-6 hover:border hover:border-blue-500 px-4 py-2 rounded-lg transition-all">Quizzes</a>
            <a href="#features" class="text-m topnav font-roboto font-semibold leading-6 hover:border hover:border-blue-500 px-4 py-2 rounded-lg transition-all">Features</a>
            <a href="#" id="teachers-link" class="text-m topnav font-roboto font-semibold leading-6 hover:border hover:border-blue-500 px-4 py-2 rounded-lg transition-all">Teachers</a>
            <!-- Dropdown Menu for Teachers -->
            <div id="teachers-dropdown" class="hidden absolute mt-14 bg-white rounded-lg shadow w-64">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 dropdown-menu">
                    <li class="border-b border-gray-200">
                        <a href="#" class="block flex gap-4 px-10 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#7e57c2">
                            <path d="M560-360q17 0 29.5-12.5T602-402q0-17-12.5-29.5T560-444q-17 0-29.5 12.5T518-402q0 17 12.5 29.5T560-360Zm-30-128h60q0-29 6-42.5t28-35.5q30-30 40-48.5t10-43.5q0-45-31.5-73.5T560-760q-41 0-71.5 23T446-676l54 22q9-25 24.5-37.5T560-704q24 0 39 13.5t15 36.5q0 14-8 26.5T578-596q-33 29-40.5 45.5T530-488ZM320-240q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320Zm0-80h480v-480H320v480ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm160-720v480-480Z"/>
                        </svg>
                            Quizzes
                        </a>
                    </li>
                    <li class="border-b border-gray-200">
                        
                        <a href="#" class="block px-10 flex gap-4 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#43a047">
                            <path d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780Zm-455-80h311q-10-20-55.5-35T480-370q-55 0-100.5 15T325-320ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Zm0-80q17 0 28.5-11.5T520-600q0-17-11.5-28.5T480-640q-17 0-28.5 11.5T440-600q0 17 11.5 28.5T480-560Zm1 240Zm-1-280Z"/>
                        </svg>
                            Groups
                        </a>
                    </li>
                    <li class="border-b border-gray-200">
                        <a href="#" class="block px-10 flex gap-4 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffca28 ">
                            <path d="M480-160q-48-38-104-59t-116-21q-42 0-82.5 11T100-198q-21 11-40.5-1T40-234v-482q0-11 5.5-21T62-752q46-24 96-36t102-12q58 0 113.5 15T480-740v484q51-32 107-48t113-16q36 0 70.5 6t69.5 18v-480q15 5 29.5 10.5T898-752q11 5 16.5 15t5.5 21v482q0 23-19.5 35t-40.5 1q-37-20-77.5-31T700-240q-60 0-116 21t-104 59Zm80-200v-380l200-200v400L560-360Zm-160 65v-396q-33-14-68.5-21.5T260-720q-37 0-72 7t-68 21v397q35-13 69.5-19t70.5-6q36 0 70.5 6t69.5 19Zm0 0v-396 396Z"/>
                        </svg>
                        Practice
                        </a>
                    </li>
                    <li class="border-b border-gray-200">
                        <a href="#" class="block px-10 flex gap-4 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#c62828">
                            <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h404q-4 20-4 40t4 40H160l320 200 146-91q14 13 30.5 22.5T691-572L480-440 160-640v400h640v-324q23-5 43-14t37-22v360q0 33-23.5 56.5T800-160H160Zm0-560v480-480Zm600 80q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35Z"/>
                        </svg>
                        Invite & Get Notified
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block flex gap-4 font-semibold px-10 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#0d47a1">
                            <path d="M280-280h80v-200h-80v200Zm320 0h80v-400h-80v400Zm-160 0h80v-120h-80v120Zm0-200h80v-80h-80v80ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z"/>
                        </svg>
                        Track Students Progress
                        </a>
                    </li>
                </ul>
            </div>
            <a href="#" id="students-link" class="text-m topnav font-roboto font-semibold leading-6 hover:border hover:border-blue-500 px-4 py-2 rounded-lg transition-all">Students</a>
            <!-- Dropdown Menu for Students -->
            <div id="students-dropdown" class="hidden absolute mt-14 bg-white rounded-lg shadow w-64">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 dropdown-menu">
                    <li class="border-b border-gray-200">
                        <a href="#" class="block flex gap-4 px-10 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#8d6e63">
                            <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h168q13-36 43.5-58t68.5-22q38 0 68.5 22t43.5 58h168q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm80-80h280v-80H280v80Zm0-160h400v-80H280v80Zm0-160h400v-80H280v80Zm200-190q13 0 21.5-8.5T510-820q0-13-8.5-21.5T480-850q-13 0-21.5 8.5T450-820q0 13 8.5 21.5T480-790ZM200-200v-560 560Z"/>
                        </svg>
                        Assignments
                        </a>
                    </li>
                    <li class="border-b border-gray-200">
                        
                        <a href="#" class="block px-10 flex gap-4 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fb8c00">
                            <path d="M500-482q29-32 44.5-73t15.5-85q0-44-15.5-85T500-798q60 8 100 53t40 105q0 60-40 105t-100 53Zm220 322v-120q0-36-16-68.5T662-406q51 18 94.5 46.5T800-280v120h-80Zm80-280v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Zm-480-40q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM0-160v-112q0-34 17.5-62.5T64-378q62-31 126-46.5T320-440q66 0 130 15.5T576-378q29 15 46.5 43.5T640-272v112H0Zm320-400q33 0 56.5-23.5T400-640q0-33-23.5-56.5T320-720q-33 0-56.5 23.5T240-640q0 33 23.5 56.5T320-560ZM80-240h480v-32q0-11-5.5-20T540-306q-54-27-109-40.5T320-360q-56 0-111 13.5T100-306q-9 5-14.5 14T80-272v32Zm240-400Zm0 400Z"/>
                        </svg>
                        Join Groups
                        </a>
                    </li>
                    <li class="border-b border-gray-200">
                        <a href="#" class="block px-10 flex gap-4 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#26a69a">
                            <path d="M720-440v-80h160v80H720Zm48 280-128-96 48-64 128 96-48 64Zm-80-480-48-64 128-96 48 64-128 96ZM200-200v-160h-40q-33 0-56.5-23.5T80-440v-80q0-33 23.5-56.5T160-600h160l200-120v480L320-360h-40v160h-80Zm240-182v-196l-98 58H160v80h182l98 58Zm120 36v-268q27 24 43.5 58.5T620-480q0 41-16.5 75.5T560-346ZM300-480Z"/>
                        </svg>
                        Get Announced
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block flex gap-4 font-semibold px-10 py-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#d500f9">
                            <path d="m354-287 126-76 126 77-33-144 111-96-146-13-58-136-58 135-146 13 111 97-33 143ZM233-120l65-281L80-590l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Zm247-350Z"/>
                        </svg>
                        Grades & Quiz Report
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        
          <div class="hidden gap-2 lg:flex lg:flex-1 lg:justify-end">
              @if (Route::has('login'))
              @auth
                <li><a 
                    href="{{ url('/dashboard') }}" class="inline-flex items-center h-10 px-5 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800">
                    <span>Dashboard</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ml-2 size-6">
                    <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                    <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                    </svg>
                    </a>
                </li>
                @else 
                    <a href="{{route('groups.enroll')}}"
                      class="select-none rounded-lg flex gap-2 mr-4 border hover:bg-gray-200 border-gray-200 hover:border-gray-400 py-2.5 px-2 text-center align-middle font-sans text-m font-bold text-gray-900 join transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none"
                      type="button">
                      <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#9e9e9e">
                        <path d="M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160Zm40 200q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                      </svg>
                        Join a Group
                    </a> 
                    <a href="{{ route('register') }}" class="custom-signup select-none rounded-lg py-2 px-4 text-center align-middle text-m text-blue-600 bg-gray-100 shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none">
                        Sign up
                    </a>
                    <a href="{{ route('login') }}" class="custom-login select-none rounded-lg py-2 px-4 text-center align-middle text-m text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none" type="button">
                      Log in
                    </a>
                @endif
                @endauth
          </div>
        </nav>

        <div id="mobile-menu" class="hidden lg:hidden bg-white shadow-lg">
            <a href="#quizzes" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Quizzes</a>
            <a href="#features" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Features</a>
            <a href="#" id="mobile-teachers-link" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Teachers</a>
            <!-- Dropdowns -->
            <div id="mobile-teachers-dropdown" class="hidden">
                <!-- <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Dropdown Item 1</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Dropdown Item 2</a> -->
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 dropdown-menu">
                    <li class="border-b border-gray-200">
                        <a href="#" class="block flex gap-4 px-10 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#7e57c2">
                            <path d="M560-360q17 0 29.5-12.5T602-402q0-17-12.5-29.5T560-444q-17 0-29.5 12.5T518-402q0 17 12.5 29.5T560-360Zm-30-128h60q0-29 6-42.5t28-35.5q30-30 40-48.5t10-43.5q0-45-31.5-73.5T560-760q-41 0-71.5 23T446-676l54 22q9-25 24.5-37.5T560-704q24 0 39 13.5t15 36.5q0 14-8 26.5T578-596q-33 29-40.5 45.5T530-488ZM320-240q-33 0-56.5-23.5T240-320v-480q0-33 23.5-56.5T320-880h480q33 0 56.5 23.5T880-800v480q0 33-23.5 56.5T800-240H320Zm0-80h480v-480H320v480ZM160-80q-33 0-56.5-23.5T80-160v-560h80v560h560v80H160Zm160-720v480-480Z"/>
                        </svg>
                            Quizzes
                        </a>
                    </li>
                    <li class="border-b border-gray-200">
                        
                        <a href="#" class="block px-10 flex gap-4 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#43a047">
                            <path d="M0-240v-63q0-43 44-70t116-27q13 0 25 .5t23 2.5q-14 21-21 44t-7 48v65H0Zm240 0v-65q0-32 17.5-58.5T307-410q32-20 76.5-30t96.5-10q53 0 97.5 10t76.5 30q32 20 49 46.5t17 58.5v65H240Zm540 0v-65q0-26-6.5-49T754-397q11-2 22.5-2.5t23.5-.5q72 0 116 26.5t44 70.5v63H780Zm-455-80h311q-10-20-55.5-35T480-370q-55 0-100.5 15T325-320ZM160-440q-33 0-56.5-23.5T80-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T160-440Zm640 0q-33 0-56.5-23.5T720-520q0-34 23.5-57t56.5-23q34 0 57 23t23 57q0 33-23 56.5T800-440Zm-320-40q-50 0-85-35t-35-85q0-51 35-85.5t85-34.5q51 0 85.5 34.5T600-600q0 50-34.5 85T480-480Zm0-80q17 0 28.5-11.5T520-600q0-17-11.5-28.5T480-640q-17 0-28.5 11.5T440-600q0 17 11.5 28.5T480-560Zm1 240Zm-1-280Z"/>
                        </svg>
                            Groups
                        </a>
                    </li>
                    <li class="border-b border-gray-200">
                        <a href="#" class="block px-10 flex gap-4 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#ffca28 ">
                            <path d="M480-160q-48-38-104-59t-116-21q-42 0-82.5 11T100-198q-21 11-40.5-1T40-234v-482q0-11 5.5-21T62-752q46-24 96-36t102-12q58 0 113.5 15T480-740v484q51-32 107-48t113-16q36 0 70.5 6t69.5 18v-480q15 5 29.5 10.5T898-752q11 5 16.5 15t5.5 21v482q0 23-19.5 35t-40.5 1q-37-20-77.5-31T700-240q-60 0-116 21t-104 59Zm80-200v-380l200-200v400L560-360Zm-160 65v-396q-33-14-68.5-21.5T260-720q-37 0-72 7t-68 21v397q35-13 69.5-19t70.5-6q36 0 70.5 6t69.5 19Zm0 0v-396 396Z"/>
                        </svg>
                        Practice
                        </a>
                    </li>
                    <li class="border-b border-gray-200">
                        <a href="#" class="block px-10 flex gap-4 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#c62828">
                            <path d="M160-160q-33 0-56.5-23.5T80-240v-480q0-33 23.5-56.5T160-800h404q-4 20-4 40t4 40H160l320 200 146-91q14 13 30.5 22.5T691-572L480-440 160-640v400h640v-324q23-5 43-14t37-22v360q0 33-23.5 56.5T800-160H160Zm0-560v480-480Zm600 80q-50 0-85-35t-35-85q0-50 35-85t85-35q50 0 85 35t35 85q0 50-35 85t-85 35Z"/>
                        </svg>
                        Invite & Get Notified
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block flex gap-4 font-semibold px-10 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#0d47a1">
                            <path d="M280-280h80v-200h-80v200Zm320 0h80v-400h-80v400Zm-160 0h80v-120h-80v120Zm0-200h80v-80h-80v80ZM200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h560q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm0-560v560-560Z"/>
                        </svg>
                        Track Students Progress
                        </a>
                    </li>
                </ul>
            </div>
            <a href="#" id="mobile-students-link" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Students</a>
            <div id="mobile-students-dropdown" class="hidden">
                <!-- <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Dropdown Item 1</a>
                <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Dropdown Item 2</a> -->
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200 dropdown-menu">
                    <li class="border-b border-gray-200">
                        <a href="#" class="block flex gap-4 px-10 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#8d6e63">
                            <path d="M200-120q-33 0-56.5-23.5T120-200v-560q0-33 23.5-56.5T200-840h168q13-36 43.5-58t68.5-22q38 0 68.5 22t43.5 58h168q33 0 56.5 23.5T840-760v560q0 33-23.5 56.5T760-120H200Zm0-80h560v-560H200v560Zm80-80h280v-80H280v80Zm0-160h400v-80H280v80Zm0-160h400v-80H280v80Zm200-190q13 0 21.5-8.5T510-820q0-13-8.5-21.5T480-850q-13 0-21.5 8.5T450-820q0 13 8.5 21.5T480-790ZM200-200v-560 560Z"/>
                        </svg>
                        Assignments
                        </a>
                    </li>
                    <li class="border-b border-gray-200">
                        
                        <a href="#" class="block px-10 flex gap-4 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#fb8c00">
                            <path d="M500-482q29-32 44.5-73t15.5-85q0-44-15.5-85T500-798q60 8 100 53t40 105q0 60-40 105t-100 53Zm220 322v-120q0-36-16-68.5T662-406q51 18 94.5 46.5T800-280v120h-80Zm80-280v-80h-80v-80h80v-80h80v80h80v80h-80v80h-80Zm-480-40q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47ZM0-160v-112q0-34 17.5-62.5T64-378q62-31 126-46.5T320-440q66 0 130 15.5T576-378q29 15 46.5 43.5T640-272v112H0Zm320-400q33 0 56.5-23.5T400-640q0-33-23.5-56.5T320-720q-33 0-56.5 23.5T240-640q0 33 23.5 56.5T320-560ZM80-240h480v-32q0-11-5.5-20T540-306q-54-27-109-40.5T320-360q-56 0-111 13.5T100-306q-9 5-14.5 14T80-272v32Zm240-400Zm0 400Z"/>
                        </svg>
                        Join Groups
                        </a>
                    </li>
                    <li class="border-b border-gray-200">
                        <a href="#" class="block px-10 flex gap-4 py-4 font-semibold hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#26a69a">
                            <path d="M720-440v-80h160v80H720Zm48 280-128-96 48-64 128 96-48 64Zm-80-480-48-64 128-96 48 64-128 96ZM200-200v-160h-40q-33 0-56.5-23.5T80-440v-80q0-33 23.5-56.5T160-600h160l200-120v480L320-360h-40v160h-80Zm240-182v-196l-98 58H160v80h182l98 58Zm120 36v-268q27 24 43.5 58.5T620-480q0 41-16.5 75.5T560-346ZM300-480Z"/>
                        </svg>
                        Get Announced
                        </a>
                    </li>
                    <li>
                        <a href="#" class="block flex gap-4 font-semibold px-10 py-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#d500f9">
                            <path d="m354-287 126-76 126 77-33-144 111-96-146-13-58-136-58 135-146 13 111 97-33 143ZM233-120l65-281L80-590l288-25 112-265 112 265 288 25-218 189 65 281-247-149-247 149Zm247-350Z"/>
                        </svg>
                        Grades & Quiz Report
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Mobile Login, Signup, Join a Group -->
            @if (Route::has('login'))
              @auth
                <div class="flex flex-col items-center justify-center space-y-4 w-full">
                  <a href="{{ url('/dashboard') }}" class="inline-flex items-center h-10 px-5 text-indigo-100 transition-colors duration-150 bg-indigo-700 rounded-lg focus:shadow-outline hover:bg-indigo-800 w-full">
                    <span>Dashboard</span>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="ml-2 size-6">
                      <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                      <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                    </svg>
                  </a>
                </div>
            @else
                <div class="flex flex-col items-center justify-center space-y-4 w-full">
                <a href="{{route('groups.enroll')}}"
                  class="select-none flex justify-center items-center rounded-lg gap-2 border hover:bg-gray-200 border-gray-200 hover:border-gray-400 py-2.5 px-2 font-sans text-m font-bold text-gray-900 join transition-all hover:opacity-75 focus:ring focus:ring-gray-300 active:opacity-[0.85] disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none w-full"
                  type="button">
                  <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#9e9e9e">
                    <path d="M440-280h80v-160h160v-80H520v-160h-80v160H280v80h160v160Zm40 200q-83 0-156-31.5T197-197q-54-54-85.5-127T80-480q0-83 31.5-156T197-763q54-54 127-85.5T480-880q83 0 156 31.5T763-763q54 54 85.5 127T880-480q0 83-31.5 156T763-197q-54 54-127 85.5T480-80Zm0-80q134 0 227-93t93-227q0-134-93-227t-227-93q-134 0-227 93t-93 227q0 134 93 227t227 93Zm0-320Z"/>
                  </svg>
                  Join a Group
                </a>

                  <a href="{{ route('register') }}" class="custom-signup select-none rounded-lg py-2 px-4 text-center align-middle text-m text-blue-600 bg-gray-100 shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none w-full">
                    Sign up
                  </a>
                  <a href="{{ route('login') }}" class="custom-login select-none rounded-lg py-2 px-4 text-center align-middle text-m text-white shadow-md shadow-blue-500/20 transition-all hover:shadow-lg hover:shadow-blue-500/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none disabled:pointer-events-none disabled:opacity-50 disabled:shadow-none w-full" type="button">
                    Log in
                  </a>
                </div>
              @endauth
            @endif

          
        </div>
        <script>
            $(document).ready(function () {
            // Toggle mobile menu visibility
            $('#mobile-menu-button').click(function () {
                $('#mobile-menu').toggleClass('hidden');
            });

            // Toggle Teachers dropdown in mobile menu
            $('#mobile-teachers-link').click(function () {
                $('#mobile-teachers-dropdown').toggleClass('hidden');
            });

            // Toggle Students dropdown in mobile menu
            $('#mobile-students-link').click(function () {
                $('#mobile-students-dropdown').toggleClass('hidden');
            });

            // Close the mobile menu when clicking outside of it
            $(document).click(function (event) {
                if (!$(event.target).closest('#mobile-menu-button, #mobile-menu').length) {
                    $('#mobile-menu').addClass('hidden');
                    $('#mobile-teachers-dropdown').addClass('hidden');
                    $('#mobile-students-dropdown').addClass('hidden');
                }
            });
          });
        </script>
      </header>

      <main class="isolate">
        <!-- Hero section -->
        <div class="relative">
          <div class="absolute inset-x-0 -top-40 -z-10 transform-gpu overflow-hidden blur-3xl sm:-top-80" aria-hidden="true">
            <div class="relative left-[calc(50%-11rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 rotate-[30deg] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%-30rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
          </div>
          <div class="py-14 sm:py-32 relative">
              <div class="mx-auto max-w-7xl px-6 lg:px-8">
              <div class="relative mx-auto max-w-2xl text-center z-10">
                  <div class="animation-container">
                      <div id="lottie-container" class="lottie-animation"></div>
                  </div>
                  <h1 class="text-4xl font-opensans font-extrabold tracking-tight text-gray-900 sm:text-6xl">
                      <span>Transform Your Classroom Experience</span> with Unified Access.
                  </h1>
                  <p class="mt-6 text-lg leading-8 text-gray-600">
                      Access all features with a single login. Create, Manage and learn with our Odyssey system. Streamlining your experience.
                  </p>
                  <div class="hidden lg:block mt-10 flex-col items-center justify-center gap-y-6 lg:flex-row lg:gap-x-6 lg:gap-y-0">
                    <a href="{{ route('register') }}" class="text-white register font-opensans font-medium py-6 px-8 border-b-4 border-yellow-500 hover:border-yellow-600 rounded-lg">
                        Register now - it's free!
                    </a>
                    <a href="#" class="ml-4 font-opensans video font-semibold py-6 px-8 border-b-4 border-yellow-500 hover:border-yellow-600 rounded-lg">
                        Watch a demo video <span aria-hidden="true">→</span>
                    </a>
                  </div>
                  <div class="lg:hidden mt-6 flex flex-col items-center justify-center gap-y-6 lg:flex-row lg:gap-x-6 lg:gap-y-0">
                    <a href="{{ route('register') }}" class="text-white register font-opensans font-medium py-6 px-8 border-b-4 border-yellow-500 hover:border-yellow-600 rounded-lg">
                        Register now - it's free!
                    </a>
                    <a href="#" class="ml-4 font-opensans video font-semibold py-6 px-8 border-b-4 border-yellow-500 hover:border-yellow-600 rounded-lg">
                        Watch a demo video <span aria-hidden="true">→</span>
                    </a>
                  </div>
              </div>

              </div>
          </div>

          <div class="absolute inset-x-0 top-[calc(100%-13rem)] -z-10 transform-gpu overflow-hidden blur-3xl sm:top-[calc(100%-30rem)]" aria-hidden="true">
            <div class="relative left-[calc(50%+3rem)] aspect-[1155/678] w-[36.125rem] -translate-x-1/2 bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30 sm:left-[calc(50%+36rem)] sm:w-[72.1875rem]" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
          </div>
        </div>

        <!-- Logo cloud -->
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
          <div id="features" class="mt-16 flex justify-center">
            <p class="relative addition rounded-full px-6 py-4 text-sm leading-6 text-gray-600 bg-gradient-to-r from-indigo-100 via-blue-100 to-indigo-200 ring-1 ring-inset ring-gray-900/10 hover:ring-gray-900/20 transition-all duration-300 hover:scale-105 hover:shadow-lg transform-gpu text-center">
              <span class="hidden md:inline">Invite and Notify with Convenience by Multiple Ways.</span>
              <a href="#" class="font-semibold text-indigo-600 relative group">
                <span class="absolute inset-0" aria-hidden="true"></span>
                See how
                <span aria-hidden="true" class="group-hover:translate-x-1 transition-transform duration-300">&rarr;</span>
              </a>
            </p>
          </div>
        </div>

        <!-- Feature section -->
        <div class="mx-auto mt-12 max-w-7xl px-6 sm:mt-20 lg:px-8">
          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="card-container max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg transition-shadow duration-300">
              <div class="flex gap-2 items-center mb-4">
                <svg class="w-12 h-12 sm:w-16 sm:h-16 text-yellow-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 2a1 1 0 0 1 1 1v4a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1h11zM3 12v6a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3v-6M9 16l1 1m0-2l-1 1m8-1l-1 1m0-2l1 1"/>
                </svg>
                <h5 class="text-xl sm:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Effortlessly Create and Manage Quizzes and Classes.</h5>
              </div>
              <p class="mb-3 font-normal text-gray-700 text-justify dark:text-gray-400">Easily design engaging quizzes and set up classes with our user-friendly tools, streamlining your educational content creation.</p>
              <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center btn-see-how">
                See how
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
              </a>
            </div>

            <div class="card-container max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg transition-shadow duration-300">
              <div class="flex gap-2 items-center mb-4">
                <svg class="w-12 h-12 sm:w-16 sm:h-16 text-green-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                </svg>
                <h5 class="text-xl sm:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Seamlessly Join Classes and Monitor Your Progress </h5>
              </div>
              <p class="mb-3 font-normal text-justify text-gray-700 dark:text-gray-400">Easily join classes and keep track of your progress with our integrated tracking system.</p>
              <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center btn-see-how">
                See how
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
              </a>
            </div>

            <div class="card-container max-w-full p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 hover:shadow-lg transition-shadow duration-300">
              <div class="flex gap-2 items-center mb-4">
                <svg class="w-12 h-12 sm:w-16 sm:h-16 text-red-500 animate-ring" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 18a4 4 0 0 0-8 0m2-2a2 2 0 0 1 2 2m-2 0a2 2 0 0 1-2-2M5 13v-4a6 6 0 0 1 6-6h2a6 6 0 0 1 6 6v4M8 13v2h8v-2H8zm-2 4v2a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3v-2m-1 0v2"/>
                </svg>
                <h5 class="text-xl sm:text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Receive Timely Updates and Announcements.</h5>
              </div>
              <p class="mb-3 font-normal text-justify text-gray-700 dark:text-gray-400">Stay informed with important announcements and updates directly from your classes.</p>
              <a href="#" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center btn-see-how">
                See how
                <svg class="rtl:rotate-180 w-3.5 h-3.5 ms-2" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
                </svg>
              </a>
            </div>
          </div>

          <div class="mx-auto mt-8 max-w-2xl lg:text-center content-section">
            <h2 class="text-base font-semibold leading-7">Unlock Your Potential</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight sm:text-4xl headline">The tools you need to achieve your goals</p>
            <p class="mt-6 text-lg leading-8 text-justify description">Discover how our platform can elevate your productivity and streamline your workflow. From intuitive interfaces to powerful integrations, we’ve got everything you need to excel and reach new heights.</p>
          </div>

          <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-4xl">
            <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-10 lg:max-w-none lg:grid-cols-2 lg:gap-y-16">
              <!-- Flexible Quiz Creation -->
              <div class="relative feature-card hover:scale-105 hover:bg-gray-100 transition-transform duration-300 ease-in-out">
                <dt class="text-base font-semibold leading-7 text-gray-900 flex top-0">
                  <div class="icon-container">
                    <svg xmlns="http://www.w3.org/2000/svg" height="54px" viewBox="0 -960 960 960" width="54px" fill="#e91e63">
                      <path d="M160-400v-400h640v400H160Zm140 160v-40h360v40H300Zm-200 80v-600h80v80h680v520H100Zm60-340h560v-240H160v240Zm0 0v-240 240Z"/>
                    </svg>
                  </div>
                  <span class="ml-4">Flexible Quiz Creation</span>
                </dt>
                <dd class="mt-2 text-base leading-7 text-gray-600 text-justify">
                  Create quizzes with ease using our flexible tools, allowing for customization to meet your educational needs.
                </dd>
              </div>

              <!-- Dynamic Class Management -->
              <div class="relative feature-card hover:scale-105 hover:bg-gray-100 transition-transform duration-300 ease-in-out">
                <dt class="text-base font-semibold leading-7 text-gray-900 flex top-0">
                  <div class="icon-container">
                    <svg xmlns="http://www.w3.org/2000/svg" height="54px" viewBox="0 -960 960 960" width="54px" fill="#4caf50">
                      <path d="M280-400h400v-240H280v240Zm-120 400v-240h-60v-320h60v-320h640v320h60v320h-60v240H160Zm60-60h520v-120H220v120Zm0-180h520v-240H220v240Zm0-300h520v-120H220v120Zm-60-120v-240 240Z"/>
                    </svg>
                  </div>
                  <span class="ml-4">Dynamic Class Management</span>
                </dt>
                <dd class="mt-2 text-base leading-7 text-gray-600 text-justify">
                  Manage your classes effortlessly with tools that adapt to your teaching style and classroom needs.
                </dd>
              </div>

              <!-- Comprehensive Analytics -->
              <div class="relative feature-card hover:scale-105 hover:bg-gray-100 transition-transform duration-300 ease-in-out">
                <dt class="text-base font-semibold leading-7 text-gray-900 flex top-0">
                  <div class="icon-container">
                    <svg xmlns="http://www.w3.org/2000/svg" height="54px" viewBox="0 -960 960 960" width="54px" fill="#2196f3">
                      <path d="M420-120v-180h-180v-60h180v-180h60v180h180v60H480v180h-60ZM80-560v-60h800v60H80Z"/>
                    </svg>
                  </div>
                  <span class="ml-4">Comprehensive Analytics</span>
                </dt>
                <dd class="mt-2 text-base leading-7 text-gray-600 text-justify">
                  Gain deep insights into student performance and quiz effectiveness with our detailed analytics reports.
                </dd>
              </div>

              <!-- Secure Data Protection -->
              <div class="relative feature-card hover:scale-105 hover:bg-gray-100 transition-transform duration-300 ease-in-out">
                <dt class="text-base font-semibold leading-7 text-gray-900 flex top-0">
                  <div class="icon-container">
                    <svg xmlns="http://www.w3.org/2000/svg" height="54px" viewBox="0 -960 960 960" width="54px" fill="#ff9800">
                      <path d="M480-240q83 0 141.5-58.5T680-440v-120q0-83-58.5-141.5T480-760q-83 0-141.5 58.5T280-560v120q0 83 58.5 141.5T480-240Zm0-60q-58 0-99-41t-41-99v-120q0-58 41-99t99-41q58 0 99 41t41 99v120q0 58-41 99t-99 41ZM180-160v-60h600v60H180Zm300-300Z"/>
                    </svg>
                  </div>
                  <span class="ml-4">Secure Data Protection</span>
                </dt>
                <dd class="mt-2 text-base leading-7 text-gray-600 text-justify">
                  Rest easy knowing your data is protected with our top-notch security features.
                </dd>
              </div>
            </dl>
          </div>
        </div>

        <!-- quizzes  -->
        <div id="quizzes">
          <div class="m-4 mt-6 sm:px-6 md:px7 py-8 lg:px-8">
              <div class="flex justify-center items-center">
                <svg id="svgGroup" width="250" height="250" class="animatedQuiz" viewBox="0 0 498.122 135.793" xmlns="http://www.w3.org/2000/svg">
                  <g stroke-linecap="round" fill-rule="evenodd" font-size="9pt" stroke="#000" stroke-width="0.25mm" fill="none" style="stroke:#000;stroke-width:0.25mm;fill:none">
                    <path d="M 31.351 109.164 A 46.186 46.186 0 0 0 44.459 110.962 A 50.613 50.613 0 0 0 49.266 110.738 A 40.718 40.718 0 0 0 67.567 104.59 A 39.91 39.91 0 0 0 75.795 97.618 A 46.519 46.519 0 0 0 83.204 86.353 A 49.434 49.434 0 0 0 83.449 85.829 Q 88.844 74.129 88.844 58.155 Q 88.844 50.533 87.604 43.925 A 54.116 54.116 0 0 0 83.204 30.249 A 50.746 50.746 0 0 0 81.335 26.742 A 41.18 41.18 0 0 0 67.567 12.342 A 39.708 39.708 0 0 0 57.51 7.847 A 46.605 46.605 0 0 0 44.459 6.08 A 52.076 52.076 0 0 0 38.844 6.376 A 41.382 41.382 0 0 0 21.278 12.269 A 39.215 39.215 0 0 0 13.238 18.863 A 45.103 45.103 0 0 0 5.641 30.103 Q 2.38 36.836 1.005 45.159 A 79.75 79.75 0 0 0 0.001 58.155 A 94.057 94.057 0 0 0 0.002 58.616 Q 0.037 65.758 1.159 72.039 A 56.209 56.209 0 0 0 5.641 86.353 A 51.478 51.478 0 0 0 7.909 90.609 A 41.365 41.365 0 0 0 21.278 104.59 A 39.312 39.312 0 0 0 31.351 109.164 Z M 44.459 96.9 A 22.207 22.207 0 0 0 61.634 89.384 A 29.346 29.346 0 0 0 63.905 86.536 A 36.426 36.426 0 0 0 69.013 75.572 Q 70.375 70.845 70.886 65.223 A 78.173 78.173 0 0 0 71.192 58.155 Q 71.192 40.87 63.905 30.982 A 24.733 24.733 0 0 0 56.596 24.223 Q 51.629 21.29 45.308 21.106 A 29.283 29.283 0 0 0 44.459 21.094 A 23.973 23.973 0 0 0 34.177 23.249 Q 28.916 25.71 25.05 30.982 A 34.207 34.207 0 0 0 19.906 41.669 Q 18.523 46.373 18.048 52.003 A 73.174 73.174 0 0 0 17.799 58.155 Q 17.799 70.876 21.413 79.782 A 34.103 34.103 0 0 0 25.05 86.536 Q 32.301 96.9 44.459 96.9 Z M 35.67 108.619 L 53.248 107.081 Q 56.251 114.624 63.209 118.14 Q 70.167 121.656 78.297 121.656 A 48.539 48.539 0 0 0 81.501 121.555 A 35.581 35.581 0 0 0 84.376 121.253 A 51.195 51.195 0 0 0 86.958 120.804 A 38.711 38.711 0 0 0 89.283 120.264 L 92.433 132.789 Q 89.796 134.107 85.694 134.949 A 39.55 39.55 0 0 1 81.336 135.581 A 53.657 53.657 0 0 1 76.466 135.791 A 51.207 51.207 0 0 1 64.492 134.46 A 37.544 37.544 0 0 1 50.575 128.028 A 43.753 43.753 0 0 1 35.67 108.619 Z" id="0" vector-effect="non-scaling-stroke"/>
                    <path d="M 107.008 80.933 L 107.008 33.326 L 124 33.326 L 124 78.809 Q 124 86.544 125.909 90.629 A 10.324 10.324 0 0 0 126.893 92.322 A 9.163 9.163 0 0 0 131.977 95.776 Q 133.865 96.314 136.231 96.314 A 17.173 17.173 0 0 0 141.546 95.514 A 15.162 15.162 0 0 0 145.167 93.787 A 23.418 23.418 0 0 0 147.914 91.665 Q 149.262 90.468 150.681 88.92 A 59.034 59.034 0 0 0 153.59 85.474 L 153.59 33.326 L 170.582 33.326 L 170.582 109.131 L 156.593 109.131 L 155.274 97.852 L 154.762 97.852 A 50.256 50.256 0 0 1 148.511 104.053 A 41.4 41.4 0 0 1 143.885 107.374 Q 138.062 110.962 130.299 110.962 A 29.817 29.817 0 0 1 123.502 110.238 Q 116.445 108.586 112.574 103.162 Q 108.435 97.361 107.374 87.895 A 62.602 62.602 0 0 1 107.008 80.933 Z" id="1" vector-effect="non-scaling-stroke"/>
                    <path d="M 210.645 109.131 L 193.507 109.131 L 193.507 33.326 L 210.645 33.326 L 210.645 109.131 Z M 198.886 19.357 A 12.63 12.63 0 0 0 202.223 19.776 A 13.532 13.532 0 0 0 204.42 19.604 A 9.675 9.675 0 0 0 209.693 17.029 Q 212.55 14.283 212.55 9.742 A 12.313 12.313 0 0 0 212.515 8.808 A 9.044 9.044 0 0 0 209.693 2.71 A 9.493 9.493 0 0 0 205.559 0.414 A 12.791 12.791 0 0 0 202.223 0 Q 197.608 0 194.752 2.71 A 8.815 8.815 0 0 0 192.404 6.382 A 10.638 10.638 0 0 0 191.895 9.742 A 12.864 12.864 0 0 0 192.013 11.512 A 9.163 9.163 0 0 0 194.752 17.029 A 9.459 9.459 0 0 0 198.886 19.357 Z" id="2" vector-effect="non-scaling-stroke"/>
                    <path d="M 286.378 109.131 L 227.418 109.131 L 227.418 100.049 L 263.892 47.022 L 231.446 47.022 L 231.446 33.326 L 285.279 33.326 L 285.279 42.408 L 248.878 95.582 L 286.378 95.582 L 286.378 109.131 Z" id="3" vector-effect="non-scaling-stroke"/>
                    <path d="M 354.42 109.131 L 295.46 109.131 L 295.46 100.049 L 331.934 47.022 L 299.488 47.022 L 299.488 33.326 L 353.321 33.326 L 353.321 42.408 L 316.92 95.582 L 354.42 95.582 L 354.42 109.131 Z" id="4" vector-effect="non-scaling-stroke"/>
                    <path d="M 429.933 75.879 L 381.373 75.879 A 31.58 31.58 0 0 0 382.863 82.986 A 21.808 21.808 0 0 0 388.551 91.993 Q 394.703 97.779 404.078 97.779 A 32.573 32.573 0 0 0 411.165 97.028 A 29.021 29.021 0 0 0 413.563 96.387 A 38.388 38.388 0 0 0 422.104 92.472 A 42.52 42.52 0 0 0 422.169 92.432 L 427.809 102.832 A 45.283 45.283 0 0 1 415.797 108.802 A 44.329 44.329 0 0 1 402.109 110.962 A 49.531 49.531 0 0 1 401.881 110.962 A 39.438 39.438 0 0 1 389.082 108.928 A 36.049 36.049 0 0 1 383.058 106.238 A 34.629 34.629 0 0 1 369.732 92.79 A 41.038 41.038 0 0 1 369.654 92.652 A 37.544 37.544 0 0 1 365.627 81.523 Q 364.674 76.745 364.674 71.265 A 50.629 50.629 0 0 1 365.704 60.806 A 37.81 37.81 0 0 1 369.691 50.025 A 39.154 39.154 0 0 1 376.641 40.911 A 34.338 34.338 0 0 1 382.691 36.255 A 32.581 32.581 0 0 1 395.431 31.687 A 31.605 31.605 0 0 1 399.537 31.421 A 36.576 36.576 0 0 1 409.112 32.603 A 25.389 25.389 0 0 1 422.682 41.419 Q 430.462 51.163 430.66 66.646 A 63.538 63.538 0 0 1 430.665 67.457 A 48.926 48.926 0 0 1 430.472 71.86 A 44.927 44.927 0 0 1 430.445 72.144 Q 430.298 73.67 430.117 74.831 A 24.802 24.802 0 0 1 429.933 75.879 Z M 381.153 64.234 L 415.87 64.234 A 34.08 34.08 0 0 0 415.436 58.615 Q 414.937 55.632 413.862 53.229 A 16.295 16.295 0 0 0 411.842 49.842 A 13.006 13.006 0 0 0 403.858 45.048 A 20.059 20.059 0 0 0 399.903 44.678 A 17.148 17.148 0 0 0 388.261 49.194 A 22.307 22.307 0 0 0 387.672 49.732 A 19.507 19.507 0 0 0 382.978 56.808 Q 381.666 60.1 381.153 64.234 Z" id="5" vector-effect="non-scaling-stroke"/>
                    <path d="M 440.333 99.976 L 447.877 90.235 A 33.359 33.359 0 0 0 469.41 98.072 Q 475.709 98.072 478.822 95.362 A 8.966 8.966 0 0 0 481.228 92.144 A 8.975 8.975 0 0 0 481.934 88.55 A 7.608 7.608 0 0 0 479.021 82.409 A 11.799 11.799 0 0 0 477.064 81.116 A 71.505 71.505 0 0 0 471.818 78.598 A 97.008 97.008 0 0 0 465.821 76.246 A 66.221 66.221 0 0 1 455.457 71.338 A 25.919 25.919 0 0 1 449.657 66.768 A 23.325 23.325 0 0 1 447.584 64.234 Q 444.581 59.986 444.581 53.907 A 20.997 20.997 0 0 1 446.875 44.062 A 21.671 21.671 0 0 1 451.832 37.83 A 24.158 24.158 0 0 1 461.406 32.737 Q 465.036 31.709 469.355 31.484 A 47.555 47.555 0 0 1 471.827 31.421 A 39.476 39.476 0 0 1 480.482 32.338 A 33.314 33.314 0 0 1 485.853 34.021 A 44.538 44.538 0 0 1 492.77 37.561 A 36.874 36.874 0 0 1 496.803 40.503 L 489.405 50.245 A 31.981 31.981 0 0 0 481.056 45.85 A 26.988 26.988 0 0 0 472.267 44.385 Q 468.689 44.385 466.255 45.308 A 8.343 8.343 0 0 0 463.477 46.985 Q 460.694 49.585 460.694 53.101 A 7.523 7.523 0 0 0 461.411 56.431 Q 462.186 58.027 463.8 59.181 A 10.162 10.162 0 0 0 464.723 59.766 A 43.444 43.444 0 0 0 467.534 61.207 Q 470.838 62.763 475.472 64.417 A 138.024 138.024 0 0 0 475.782 64.527 Q 481.642 66.578 486.732 69.397 A 25.471 25.471 0 0 1 492.989 74.203 A 23.335 23.335 0 0 1 494.972 76.612 A 16.347 16.347 0 0 1 497.64 82.809 A 23.324 23.324 0 0 1 498.121 87.671 A 21.273 21.273 0 0 1 491.412 103.397 A 27.883 27.883 0 0 1 490.614 104.151 Q 483.106 110.962 468.897 110.962 A 43.798 43.798 0 0 1 453.333 108.106 A 38.156 38.156 0 0 1 443.178 102.462 A 35.247 35.247 0 0 1 440.333 99.976 Z" id="6" vector-effect="non-scaling-stroke"/>
                  </g>
                </svg>
              </div>
              <div class="flex justify-center gap-2">
                  <!-- search -->
                  <div  class="mt-10 w-3/4 lg:w-1/2 relative">
                          <div for="search" class="sr-only">Search Quizzes...</div>
                          <input id="searchInput" name="search" class="block w-full rounded-md border-0 bg-white py-6 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 h-10" placeholder="Search Quizzes..." type="text">
                          <button id="clearSearch" class="absolute inset-y-0 right-0 flex items-center pr-3 cursoutline-none focus:outline-none" style="display: none;">
                              <svg class="w-4 h-4 text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out" fill="currentColor" viewBox="0 0 20 20">
                                  <path fill-rule="evenodd" d="M10 12.586l-4.293 4.293-1.414-1.414L8.586 11 4.293 6.707l1.414-1.414L10 9.172l4.293-4.293 1.414 1.414L11.414 11l4.293 4.293-1.414 1.414L10 12.586z" clip-rule="evenodd"></path>
                              </svg>
                          </button>
                  </div>
              </div> 
          
              <!-- filter -->
              <div class="container mx-auto p-4">
              <div class="mt-8 relative justify-center flex flex-wrap gap-2">
                  <div class="relative">
                      <button type="button" class="flex rounded-lg items-center justify-between bg-white px-2 py-3 text-sm text-gray-400 genre-icon" aria-controls="filter-section-0" aria-expanded="false">
                          <span class="font-medium text-gray-900">Genre</span>
                          <span class="ml-6 flex items-center">
                              <svg class="h-5 w-5 rotate-0 transform cursor-pointer " viewBox="0 0 20 20" fill="currentColor" aria-hidden="false">
                                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                              </svg>
                          </span>
                      </button>
                      <div class="absolute right-0 mt-2 z-50 w-48 bg-white border border-gray-200 divide-y divide-gray-200 rounded-md shadow-lg hidden z-top genre-dropdown" id="filter-section-0">
                          <div class="p-2 space-y-2">
                              <div class="flex items-center">
                                  <input id="m" name="genre[]" value="Mathematics" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 genre-filter">
                                  <label for="m" class="ml-3 text-sm text-gray-500">Mathematics</label>
                              </div>
                              <div class="flex items-center">
                                  <input id="e" name="genre[]" type="checkbox" value="English" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 genre-filter">
                                  <label for="e" class="ml-3 text-sm text-gray-500">English</label>
                              </div>
                              <div class="flex items-center">
                                  <input id="h" name="genre[]"  type="checkbox" value="History" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 genre-filter">
                                  <label for="h" class="ml-3 text-sm text-gray-500">History</label>
                              </div>
                              <div class="flex items-center">
                                  <input id="s" name="genre[]" type="checkbox" value="Science" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 genre-filter">
                                  <label for="s" class="ml-3 text-sm text-gray-500">Science</label>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="relative">
                      <button type="button" class="flex rounded-lg items-center justify-between bg-white px-2 py-3 text-sm text-gray-400 duration-icon" aria-controls="filter-section-1" aria-expanded="false">
                          <span class="font-medium text-gray-900">Duration</span>
                          <span class="ml-6 flex items-center">
                              <svg class="h-5 w-5 rotate-0 transform cursor-pointer " viewBox="0 0 20 20" fill="currentColor" aria-hidden="false">
                                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                              </svg>
                          </span>
                      </button>
                      <div class="absolute right-0 mt-2 z-50 w-48 bg-white border border-gray-200 divide-y divide-gray-200 rounded-md shadow-lg hidden z-top duration-dropdown" id="filter-section-1">
                          <div class="p-2 space-y-2">
                              <div class="flex items-center">
                                  <input id="less" name="duration[]" value="Less than 1 hour" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 duration-filter">
                                  <label for="less" class="ml-3 text-sm text-gray-500">Less than 1 hour</label>
                              </div>
                              <div class="flex items-center">
                                  <input id="equal" name="duration[]" value="1 hour" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 duration-filter">
                                  <label for="equal" class="ml-3 text-sm text-gray-500">1 hour</label>
                              </div>
                              <div class="flex items-center">
                                  <input id="more" name="duration[]" value="More than 1 hour" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 duration-filter">
                                  <label for="more" class="ml-3 text-sm text-gray-500">more than 1 hour</label>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="relative">
                      <button type="button" class="flex rounded-lg items-center justify-between bg-white px-2 py-3 text-sm text-gray-400 sort-icon" aria-controls="filter-section-0" aria-expanded="false">
                          <span class="font-medium text-gray-900">Sort</span>
                          <span class="ml-6 flex items-center">
                              <svg class="h-5 w-5 rotate-0 transform cursor-pointer " viewBox="0 0 20 20" fill="currentColor" aria-hidden="false">
                                  <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                              </svg>
                          </span>
                      </button>
                      <div class="absolute right-0 mt-2 z-50 w-48 bg-white border border-gray-200 divide-y divide-gray-200 rounded-md shadow-lg hidden z-top sort-dropdown" id="filter-section-0">
                          <div class="p-2 space-y-2">
                              <div class="flex items-center">
                                  <input id="popular" name="sort[]" value="Most Popular" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sort-filter">
                                  <label for="popular" class="ml-3 text-sm text-gray-500">Most Popular</label>
                              </div>
                              <div class="flex items-center">
                                  <input id="rating" name="sort[]" type="checkbox" value="Best Rating" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sort-filter">
                                  <label for="rating" class="ml-3 text-sm text-gray-500">Best Rating</label>
                              </div>
                              <div class="flex items-center">
                                  <input id="newest" name="sort[]"  type="checkbox" value="Newest" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 sort-filter">
                                  <label for="newest" class="ml-3 text-sm text-gray-500">Newest</label>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
          
              <!-- filter tags-->
            <div class="mx-auto max-w-7xl px-4 py-3 sm:flex sm:items-center sm:px-6 lg:px-8">
              <h3 class="text-sm font-medium text-gray-500">
                Filters
                <span class="sr-only">, active</span>
              </h3>
          
              <div aria-hidden="true" class="hidden h-5 w-px bg-gray-300 sm:ml-4 sm:block"></div>
          
              <div class="mt-2 sm:ml-4 sm:mt-0">
                <div class="-m-1 flex flex-wrap items-center" id="active-filters">
                  <!-- filter -->
                </div>
              </div>
          
            </div>
          
            <div class="container mx-auto p-4">
                <div class="quiz-card grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
                    @foreach ($quizzes as $quiz)
                        @if ($quiz->visibility == 'public' && $quiz->status == 'publish')
                            <div class="quiz-card-each card-content border-b-8 border-l-8 border-yellow-500 p-6 rounded-lg shadow-md mb-6" style="{{ $quiz->icon ? 'background-image: url(' . Storage::url($quiz->icon) . ');' : 'background-color: #ADD8E6;' }}">
                                <div class="flex items-center justify-between mb-3">
                                            <h2 class="card-title text-gray-800 text-lg truncate overflow-hidden text-ellipsis font-bold w-full">{{$quiz->title}}</h2>
                                            <input type="hidden" name="status" value="">
                                    
                                </div>
                            
                                <div class="flex-grow">
                                    <div class="mt-2">
                                        <p class="leading-relaxed text-base font-semibold text-gray-800 text-ellipsis">
                                            Genre: <span class="font-medium">{{$quiz->genre->name}}</span>
                                        </p>
                                        <p class="leading-relaxed text-base font-semibold text-gray-800 text-ellipsis">
                                            @php
                                            $hours = floor($quiz->duration / 60);
                                            $minutes = $quiz->duration % 60;
                                            @endphp
                            
                                            @if($hours == 0)
                                                @if($minutes == 1)
                                                    Duration: <span class="font-medium">{{$minutes}} Minute</span>
                                                @else
                                                    Duration: <span class="font-medium">{{$minutes}} Minutes</span>
                                                @endif
                                            @else
                                                @if($minutes == 0)
                                                    @if($hours == 1)
                                                        Duration: <span class="font-medium">{{$hours}} Hour</span>
                                                    @else
                                                        Duration: <span class="font-medium">{{$hours}} Hours</span>
                                                    @endif
                                                @else
                                                    @if($hours == 1)
                                                        Duration: <span class="font-medium">{{$hours}} Hour {{$minutes}} Minutes</span>
                                                    @else
                                                        Duration: <span class="font-medium">{{$hours}} Hours {{$minutes}} Minutes</span>
                                                    @endif
                                                @endif
                                            @endif
                                        </p>
                                        <p class="leading-relaxed text-base font-semibold text-gray-800 text-ellipsis">
                                            Total Score: <span class="font-medium">{{$quiz->total_points}}</span>
                                        </p>
                                        <p class="leading-relaxed text-base font-semibold text-gray-800 text-ellipsis">
                                            Pass Grade: <span class="font-medium">{{$quiz->passgrade}}</span>
                                        </p>
                                        <p class="leading-relaxed text-base font-semibold text-gray-800 text-ellipsis">
                                            Total Questions: <span class="font-medium">{{$quiz->questions}}</span>
                                        </p>
                                        <p class="leading-relaxed text-base font-semibold text-gray-800 text-ellipsis">
                                            Publish Date : <span class="font-medium">{{$quiz->publish_date}}</span>
                                        </p>
                            
                                        <div class="flex flex-wrap justify-between items-center gap-4 mt-2">
                                            <div class="font-semibold flex-1 break-all text-ellipsis min-w-[200px]">
                                                @php
                                                    $rating = $quiz->average ?? 0;
                                                    $filledStars = floor($rating);
                                                    $halfStar = ($rating - $filledStars) >= 0.5;
                                                    $emptyStars = 5 - $filledStars - ($halfStar ? 1 : 0);
                                                @endphp
                            
                                                Review:
                                                <div class="flex items-center mt-2">
                                                    @for ($i = 0; $i < $filledStars; $i++)
                                                        <svg class="w-6 h-6 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                                        </svg>
                                                    @endfor
                            
                                                    @if ($halfStar)
                                                        <svg class="w-6 h-6 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                                        </svg>
                                                    @endif
                            
                                                    @for ($i = 0; $i < $emptyStars; $i++)
                                                        <svg class="w-6 h-6 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                                        </svg>
                                                    @endfor
                                                </div>
                            
                                            </div>
                                            
                                            <div class="flex items-center space-x-2 mt-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                                    <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                                    <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                                </svg>
                                                @if($quiz->participants != null)
                                                <h4 class="text-xl font-bold text-navy-700">{{$quiz->participants}}</h4>
                                                @else
                                                <h4 class="text-xl font-bold text-navy-700 dark:text-white">0</h4>
                                                @endif
                                            </div>
                                        </div>
                            
                                    </div>      
                            
                                    <div class="container mx-auto mt-4 flex justify-between items-center">
                                        <div class="leading-relaxed text-base font-bold text-gray-800 min-w-[200px]">
                                            By:
                                            <div class="flex gap-2 items-center mt-2">
                                                <span class="bg-purple-400 text-l md:text-sm text-ellipsis text-white rounded-full px-3 py-1">
                                                    {{ $quiz->user->name }}
                                                </span>
                                                <div class="">
                                                    @if ($quiz->user->image)
                                                        <img class="h-12 w-12 rounded-full bg-indigo-700" src="{{ Storage::url($quiz->user->image) }}" alt="Profile Image">
                                                    @else
                                                        <img class="h-12 w-12 rounded-full bg-indigo-700" src="/images/default.jpeg" alt="Default Profile Image">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                            
                                        <div class="flex flex-col flex-wrap p-y-2 space-x-2 mt-2">
                                                <a type="button" class="block rounded-md bg-indigo-600 px-2 py-1 text-center text-m font-semibold text-white hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700" href="{{ route('questions.show', $quiz->id) }}">TAKE</a>
                                        </div>
                            
                                    </div>
                                </div>              

                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
          
          </div>
        </div>

        <!-- logo  -->
        <div class="mx-auto grid max-w-lg grid-cols-4 items-center gap-x-8 gap-y-0 sm:max-w-xl sm:grid-cols-6 sm:gap-x-10 lg:max-w-none lg:grid-cols-5">
            <img class="col-span-1 w-full object-contain" src="{{asset('pic1.jpg')}}" alt="pic1" width="158" height="48">
            <img class="col-span-1 w-full object-contain" src="{{asset('pic6.jpeg')}}" alt="pic3" width="158" height="48">
            <img class="col-span-1 w-full object-contain" src="{{asset('pic4.jpg')}}" alt="pic4" width="158" height="48">
            <img class="col-span-1 w-full object-contain" src="{{asset('pic5.jpeg')}}" alt="pic4" width="158" height="48">
        </div>

        <style>
            .swiper-button-prev:after,
            .swiper-rtl .swiper-button-next:after {
                content: '' !important;
            }

            .swiper-button-next:after,
            .swiper-rtl .swiper-button-prev:after {
                content: '' !important;
            }

            .swiper-button-next svg,
            .swiper-button-prev svg {
                width: 24px !important;
                height: 24px !important;
            }

            .swiper-button-next,
            .swiper-button-prev {
                position: relative !important;
            }

            .swiper-slide.swiper-slide-active {
                --tw-border-opacity: 1 !important;
                border-color: rgb(79 70 229 / var(--tw-border-opacity)) !important;
            }

            .swiper-slide.swiper-slide-active>.swiper-slide-active\:text-indigo-600 {
                --tw-text-opacity: 1;
                color: rgb(79 70 229 / var(--tw-text-opacity));
            }

            .swiper-slide.swiper-slide-active>.flex .grid .swiper-slide-active\:text-indigo-600 {
                --tw-text-opacity: 1;
                color: rgb(79 70 229 / var(--tw-text-opacity));
            }
        </style>

        <section class="mt-24">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
              <div class="mb-14 flex flex-col justify-center items-center sm:flex-row sm:items-center sm:justify-between max-sm:gap-8">
                <h2 class="text-4xl font-bold text-gray-900 lg:text-left">What Our Users say</h2>
                    
                    <div class="flex mt-8 items-center gap-8">
                        <button id="slider-button-left"
                            class="swiper-button-prev group flex justify-center items-center border border-solid border-indigo-600 w-12 h-12 transition-all duration-500 rounded-full hover:bg-indigo-600 "
                            data-carousel-prev>
                            <svg class="h-6 w-6 text-indigo-600 group-hover:text-white" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M20.9999 12L4.99992 12M9.99992 6L4.70703 11.2929C4.3737 11.6262 4.20703 11.7929 4.20703 12C4.20703 12.2071 4.3737 12.3738 4.70703 12.7071L9.99992 18"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                        <button id="slider-button-right"
                            class="swiper-button-next group flex justify-center items-center border border-solid border-indigo-600 w-12 h-12 transition-all duration-500 rounded-full hover:bg-indigo-600"
                            data-carousel-next>
                            <svg class="h-6 w-6 text-indigo-600 group-hover:text-white" viewBox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M3 12L19 12M14 18L19.2929 12.7071C19.6262 12.3738 19.7929 12.2071 19.7929 12C19.7929 11.7929 19.6262 11.6262 19.2929 11.2929L14 6"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                </div>
                
                <div class="lg:flex grid grid-cols-1 md:grid-cols-2 justify-center items-center gap-8 swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div
                            class="swiper-slide group bg-white border border-solid h-auto border-gray-300 rounded-2xl p-6 transition-all duration-500 w-full hover:border-indigo-600 slide-active:border-indigo-600">
                            <div
                                class="flex items-center mb-9 gap-2 text-amber-500 transition-all duration-500  group-hover:text-indigo-600 swiper-slide-active:text-indigo-600">
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                            </div>
                            <p
                                class="text-sm text-gray-500 text-justify leading-8 h-24 transition-all duration-500 mb-9 group-hover:text-gray-800">
                                The group management feature is a game-changer for collaborative learning. I can invite students to join specific groups and assign tailored quizzes to each one.
                            </p>
                            <div class="flex items-center gap-5">
                                <img class="rounded-full" src=" https://pagedone.io/asset/uploads/1696229994.png" alt="avatar" />
                              
                                <div class="grid gap-1">
                                    <h5
                                        class="text-gray-900 font-medium transition-all duration-500  group-hover:text-indigo-600 swiper-slide-active:text-indigo-600">
                                        Mark Williams</h5>
                                    <span class="text-sm leading-6 text-gray-500">University Lecturer</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="swiper-slide group bg-white border border-solid border-gray-300 rounded-2xl p-6 transition-all duration-500 w-full hover:border-indigo-600 slide-active:border-indigo-600">
                            <div
                                class="flex items-center mb-9 gap-2 text-amber-500 transition-all duration-500  group-hover:text-indigo-600 swiper-slide-active:text-indigo-600">
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                            </div>
                            <p
                                class="text-sm text-gray-500 text-justify leading-8 h-24 transition-all duration-500 mb-9  group-hover:text-gray-800">
                                This system has transformed how I manage my classroom. I can easily create quizzes, assign them to different groups, and monitor student progress in real time. 
                            </p>
                            <div class="flex items-center gap-5">
                                <img class="rounded-full" src="https://pagedone.io/asset/uploads/1696229969.png" alt="avatar" />
                                <div class="grid gap-1">
                                    <h5
                                        class="text-gray-900 font-medium transition-all duration-500  group-hover:text-indigo-600 swiper-slide-active:text-indigo-600">
                                        Sarah Johnson</h5>
                                    <span class="text-sm leading-6 text-gray-500">High School Teacher</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="swiper-slide group bg-white border border-solid border-gray-300 rounded-2xl p-6 transition-all duration-500 w-full hover:border-indigo-600 ">
                            <div
                                class="flex items-center mb-9 gap-2 text-amber-500 transition-all duration-500  group-hover:text-indigo-600 swiper-slide-active:text-indigo-600">
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                            </div>
                            <p
                                class="text-sm text-gray-500 text-justify leading-8 h-24 transition-all duration-500 mb-9 group-hover:text-gray-800 ">
                                I love how intuitive and powerful this system is. Creating quizzes is a breeze, and the automated notifications ensure that students never miss an assignment.
                            </p>
                            <div class="flex items-center gap-5">
                                <img class="rounded-full" src="https://pagedone.io/asset/uploads/1696229969.png" alt="avatar" />
                                <div class="grid gap-1">
                                    <h5
                                        class="text-gray-900 font-medium transition-all duration-500 group-hover:text-indigo-600 swiper-slide-active:text-indigo-600">
                                        Laura Adams</h5>
                                    <span class="text-sm leading-6 text-gray-500">Middle School Teacher</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="swiper-slide group bg-white border border-solid border-gray-300 rounded-2xl p-6 transition-all duration-500 w-full hover:border-indigo-600 slide-active:border-indigo-600">
                            <div
                                class="flex items-center mb-9 gap-2 text-amber-500 transition-all duration-500  group-hover:text-indigo-600 swiper-slide-active:text-indigo-600">
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                            </div>
                            <p
                                class="text-sm text-justify text-gray-500 leading-8 h-24 transition-all duration-500 mb-9 group-hover:text-gray-800">
                                This system is a lifesaver! I can easily join study groups, take assigned quizzes, and get instant notifications about important updates.
                            </p>
                            <div class="flex items-center gap-5">
                                <img class="rounded-full" src="https://pagedone.io/asset/uploads/1696229969.png" alt="avatar" />
                                <div class="grid gap-1">
                                    <h5
                                        class="text-gray-900 font-medium transition-all duration-500  group-hover:text-indigo-600 swiper-slide-active:text-indigo-600">
                                        Maria Garcia</h5>
                                    <span class="text-sm leading-6 text-gray-500">High School Senior</span>
                                </div>
                            </div>
                        </div>
                        <div 
                          class="swiper-slide group bg-white border border-solid border-gray-300 rounded-2xl p-6 transition-all duration-500 w-full hover:border-indigo-600 ">
                            <div
                                class="flex items-center mb-9 gap-2 text-amber-500 transition-all duration-500 group-hover:text-indigo-600 swiper-slide-active:text-indigo-600">
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                            </div>
                            <p
                                class="text-sm text-justify text-gray-500 leading-8 h-24 transition-all duration-500 mb-9  group-hover:text-gray-800">
                                This learning system makes studying so much easier! The quizzes are interactive and fun, and I love getting instant feedback on my answers. 
                            </p>
                            <div class="flex items-center gap-5">
                                <img class="rounded-full" src="https://pagedone.io/asset/uploads/1696229969.png" alt="avatar" />
                                <div class="grid gap-1">
                                    <h5
                                        class="text-gray-900 font-medium transition-all duration-500  group-hover:text-indigo-600 swiper-slide-active:text-indigo-600">
                                        Jessica Brown</h5>
                                    <span class="text-sm leading-6 text-gray-500">10th Grade Student</span>
                                </div>
                            </div>
                        </div>
                        <div
                            class="swiper-slide group bg-white border border-solid border-gray-300 rounded-2xl p-6 transition-all duration-500 w-full hover:border-indigo-600 ">
                            <div
                                class="flex items-center mb-9 gap-2 text-amber-500 transition-all duration-500  group-hover:text-indigo-600 swiper-slide-active:text-indigo-600">
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                                <svg class="w-5 h-5" viewBox="0 0 18 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M8.10326 1.31699C8.47008 0.57374 9.52992 0.57374 9.89674 1.31699L11.7063 4.98347C11.8519 5.27862 12.1335 5.48319 12.4592 5.53051L16.5054 6.11846C17.3256 6.23765 17.6531 7.24562 17.0596 7.82416L14.1318 10.6781C13.8961 10.9079 13.7885 11.2389 13.8442 11.5632L14.5353 15.5931C14.6754 16.41 13.818 17.033 13.0844 16.6473L9.46534 14.7446C9.17402 14.5915 8.82598 14.5915 8.53466 14.7446L4.91562 16.6473C4.18199 17.033 3.32456 16.41 3.46467 15.5931L4.15585 11.5632C4.21148 11.2389 4.10393 10.9079 3.86825 10.6781L0.940384 7.82416C0.346867 7.24562 0.674378 6.23765 1.4946 6.11846L5.54081 5.53051C5.86652 5.48319 6.14808 5.27862 6.29374 4.98347L8.10326 1.31699Z"
                                        fill="currentColor" />
                                </svg>
                            </div>
                            <p
                                class="text-sm text-justify text-gray-500 leading-8 h-24 transition-all duration-500 mb-9 group-hover:text-gray-800 ">
                                I appreciate how this system lets me take quizzes at my own pace. The group invitations have made collaborative projects seamless, and the notifications keep me informed about any new assignments or announcements. 
                            </p>
                            <div class="flex items-center gap-5">
                                <img class="rounded-full" src="https://pagedone.io/asset/uploads/1696230027.png" alt="avatar" />
                                <div class="grid gap-1">
                                    <h5
                                        class="text-gray-900 font-medium transition-all duration-500  group-hover:text-indigo-600 swiper-slide-active:text-indigo-600">
                                        Alex Chen</h5>
                                    <span class="text-sm leading-6 text-gray-500">College Student</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Swiper CSS -->
        <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
        <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

        <script>
                var swiper = new Swiper(".mySwiper", {
                  slidesPerView: 3,
                  spaceBetween: 28,
                  centeredSlides: true,
                  loop: true,
                  pagination: {
                      el: ".swiper-pagination",
                      clickable: true,
                  },
                  navigation: {
                      nextEl: ".swiper-button-next",
                      prevEl: ".swiper-button-prev",
                  },
                  breakpoints: {
                      0: {
                          slidesPerView: 1,
                          spaceBetween: 20,
                          centeredSlides: false,
                      },
                      768: {
                          slidesPerView: 2,
                          spaceBetween: 28,
                          centeredSlides: true,
                      },
                      1024: {
                          slidesPerView: 3,
                          spaceBetween: 32,
                      },
                  },
                });
        </script>

        <!-- FAQs -->
        <div id="faq" class="w-full pb-8 sm:pb-24 sm:pt-12 lg:px-8 lg:pb-10">
              <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
                  <div class="max-w-2xl mx-auto text-center">
                      <h2 class="text-xl mt-4 font-bold leading-tight text-black sm:text-4xl lg:text-5xl">
                      Frequently Asked Questions
                      </h2>
                  </div>
                  <div class="max-w-3xl mx-auto mt-8 space-y-4 md:mt-16">
                      <div
                          class="transition-all duration-200 bg-white border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50">
                          <button type="button" id="question1" data-state="closed" class="flex items-center justify-between w-full px-4 sm:p-6 outline-none focus:outline-none">
                              <span class="flex text-lg font-semibold text-black">What is Odyssey?</span>
                              <svg id="arrow1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                  class="w-6 h-6 text-gray-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                              </svg>
                          </button>
                          <div id="answer1" style="display:none" class="px-4 pb-5 sm:px-6 sm:pb-6">
                              <p class="text-justify">Odyssey is an online platform designed to provide educational resources, quizzes, and interactive learning experiences. It allows users to access various quizzes, track their progress, and evaluate their knowledge through quizzes and assessments.</p>
                          </div>
                      </div>
                      <div
                          class="transition-all duration-200 bg-white border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50">
                          <button type="button" id="question2" data-state="closed" class="flex items-center justify-between w-full px-4 sm:p-6 outline-none focus:outline-none">
                              <span class="flex text-lg font-semibold text-black">How do I create an account?</span>
                              <svg id="arrow2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                  class="w-6 h-6 text-gray-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                              </svg>
                          </button>
                          <div id="answer2" style="display:none" class="px-4 pb-5 sm:px-6 sm:pb-6">
                              <p class="text-justify">To create an account, click on the "Sign Up" button on the homepage. Fill in the required details, such as your name, gender, birthday, school, email address, and password. Once you submit the form, you'll receive a confirmation email. Follow the instructions in the email to activate your account.</p>
                          </div>
                      </div>
                      <div
                          class="transition-all duration-200 bg-white border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50">
                          <button type="button" id="question3" data-state="closed" class="flex items-center justify-between w-full px-4 sm:p-6 outline-none focus:outline-none">
                              <span class="flex text-lg font-semibold text-black">How do I enroll in a Classes?</span>
                              <svg id="arrow3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                  class="w-6 h-6 text-gray-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                              </svg>
                          </button>
                          <div id="answer3" style="display:none" class="px-4 pb-5 sm:px-6 sm:pb-6">
                              <p class="text-justify">To enroll in classes, you can enter the group code in the join group page or you can join the group via link shared by your teacher.</p>
                          </div>
                      </div>
                      <div
                          class="transition-all duration-200 bg-white border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50">
                          <button type="button" id="question4" data-state="closed" class="flex items-center justify-between w-full px-4 sm:p-6 outline-none focus:outline-none">
                              <span class="flex text-lg font-semibold text-black">How do I start a quiz?</span>
                              <svg id="arrow4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                  class="w-6 h-6 text-gray-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                              </svg>
                          </button>
                          <div id="answer4" style="display:none" class="px-4 pb-5 sm:px-6 sm:pb-6">
                              <p class="text-justify">You can participate in public quizzes available in your dashboard, you can also create your own quiz and publish it.</p>
                          </div>
                      </div>
                      <div
                          class="transition-all duration-200 bg-white border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50">
                          <button type="button" id="question5" data-state="closed" class="flex items-center justify-between w-full px-4 py-5 sm:p-6 outline-none focus:outline-none" style="outline: none;">
                              <span class="flex text-lg font-semibold text-black">How is my quiz score calculated?</span>
                              <svg id="arrow5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                  class="w-6 h-6 text-gray-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                              </svg>
                          </button>
                          <div id="answer5" style="display:none" class="px-4 pb-5 sm:px-6 sm:pb-6">
                              <p class="text-justify">Your quiz score is calculated based on the number of correct answers you provide. Each question may have different point values, which contribute to your total score. Your score is displayed at the end of the quiz in the report.</p>
                          </div>
                      </div>
                      <div
                          class="transition-all duration-200 bg-white border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50">
                          <button type="button" id="question6" data-state="closed" class="flex items-center justify-between w-full px-4 sm:p-6 outline-none focus:outline-none" style="outline: none;">
                              <span class="flex text-lg font-semibold text-black">Can I retake a quiz?</span>
                              <svg id="arrow6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                  class="w-6 h-6 text-gray-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                              </svg>
                          </button>
                          <div id="answer6" style="display:none" class="px-4 pb-5 sm:px-6 sm:pb-6">
                              <p class="text-justify">Yes, you can retake the quiz and you can see the retake quiz details report once after the submitting but only your first take report will be counted in the system.</p>
                          </div>
                      </div>
                      <div
                          class="transition-all duration-200 bg-white border border-gray-200 shadow-lg cursor-pointer hover:bg-gray-50">
                          <button type="button" id="question7" data-state="closed" class="flex items-center justify-between w-full px-4 sm:p-6 outline-none focus:outline-none" style="outline: none;">
                              <span class="flex text-lg text-left font-semibold text-black">Are my personal details and data secure?</span>
                              <svg id="arrow7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                  class="w-6 h-6 text-gray-400">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                              </svg>
                          </button>
                          <div id="answer7" style="display:none" class="px-4 pb-5 sm:px-6 sm:pb-6">
                              <p class="text-justify">Yes, we prioritize the security of your personal details and data. We use encryption and other security measures to protect your information. For more details, please review our [Privacy Policy].</p>
                          </div>
                      </div>
                  </div>
                  <p class="text-center text-gray-600 textbase mt-9">
                      Still have questions?
                      <span class="cursor-pointer font-medium text-tertiary transition-all duration-200 hover:text-tertiary focus:text-tertiary hover-underline">Contact
                          our support
                      </span>
                  </p>
              </div>
              <script>
                  // JavaScript to toggle the answers and rotate the arrows
                  document.querySelectorAll('[id^="question"]').forEach(function(button, index) {
                      button.addEventListener('click', function() {
                          var answer = document.getElementById('answer' + (index + 1));
                          var arrow = document.getElementById('arrow' + (index + 1));

                          if (answer.style.display === 'none' || answer.style.display === '') {
                              answer.style.display = 'block';
                              arrow.style.transform = 'rotate(0deg)';
                          } else {
                              answer.style.display = 'none';
                              arrow.style.transform = 'rotate(-180deg)';
                          }
                      });
                  });
              </script>

        </div>

        <!-- CTA section -->
        <div class="relative -z-10 px-6 lg:px-8">
          <div class="absolute inset-x-0 top-1/2 -z-10 flex -translate-y-1/2 transform-gpu justify-center overflow-hidden blur-3xl sm:bottom-0 sm:right-[calc(50%-6rem)] sm:top-auto sm:translate-y-0 sm:transform-gpu sm:justify-end" aria-hidden="true">
            <div class="aspect-[1108/632] w-[69.25rem] flex-none bg-gradient-to-r from-[#ff80b5] to-[#9089fc] opacity-25" style="clip-path: polygon(73.6% 48.6%, 91.7% 88.5%, 100% 53.9%, 97.4% 18.1%, 92.5% 15.4%, 75.7% 36.3%, 55.3% 52.8%, 46.5% 50.9%, 45% 37.4%, 50.3% 13.1%, 21.3% 36.2%, 0.1% 0.1%, 5.4% 49.1%, 21.4% 36.4%, 58.9% 100%, 73.6% 48.6%)"></div>
          </div>
          <div class="mx-auto max-w-2xl text-center">
            <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Boost Your Teaching and Learning Productivity with Our App</h2>
            <p class="mx-auto mt-6 max-w-xl text-lg leading-8 text-gray-600">Simplify your educational processes with our all-in-one system for teachers and students.</p>
            <div class="mt-10 flex items-center justify-center gap-x-6">
              <a href="#" class="rounded-md bg-indigo-600 px-4 py-3 text-sm border-b-4 border-yellow-600 hover:bg-blue-500 fontfont-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Start Now</a>
              <!-- <a href="#" class="text-sm font-semibold leading-6 text-gray-900">Learn More <span aria-hidden="true">→</span></a> -->
            </div>
          </div>
          <div class="absolute left-1/2 right-0 top-full -z-10 hidden -translate-y-1/2 transform-gpu overflow-hidden blur-3xl sm:block" aria-hidden="true">
            <div class="aspect-[1155/678] w-[72.1875rem] bg-gradient-to-tr from-[#ff80b5] to-[#9089fc] opacity-30" style="clip-path: polygon(74.1% 44.1%, 100% 61.6%, 97.5% 26.9%, 85.5% 0.1%, 80.7% 2%, 72.5% 32.5%, 60.2% 62.4%, 52.4% 68.1%, 47.5% 58.3%, 45.2% 34.5%, 27.5% 76.7%, 0.1% 64.9%, 17.9% 100%, 27.6% 76.8%, 76.1% 97.7%, 74.1% 44.1%)"></div>
          </div>
        </div>

      </main>

      <!-- pricing plan  -->
      <div class="sm:py-32">
          <div class="mx-auto max-w-7xl px-6 lg:px-8">
              <div class="mx-auto max-w-4xl text-center">
                  <h2 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Pricing Plans</h2>
                  <p class="mt-4 text-lg leading-8 text-gray-600">Choose a plan that fits your learning style.</p>
              </div>
              <div class="relative mt-16 grid lg:grid-cols-3 gap-y-16 lg:mx-auto lg:max-w-none lg:gap-y-0">
                  <!-- Basic Plan -->
                  <div class="flex flex-col justify-between rounded-3xl bg-white p-8 ring-1 ring-gray-200 xl:p-10 transition-transform transform hover:scale-105 lg:min-h-[550px]">
                      <div>
                          <div class="flex items-center justify-between gap-x-4">
                              <h3 id="tier-basic" class="text-lg font-semibold leading-8 text-blue-700">Basic</h3>
                          </div>
                          <p class="mt-4 text-sm leading-6 text-gray-600">Access to all beginner courses.</p>
                          <p class="mt-6 flex items-baseline gap-x-1">
                              <span class="text-4xl font-bold tracking-tight text-gray-900">$10</span>
                              <span class="text-sm font-semibold leading-6 text-gray-600">/month</span>
                          </p>
                          <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-600">
                              <li class="flex gap-x-3">
                                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                  </svg>
                                  Access to all beginner courses
                              </li>
                              <li class="flex gap-x-3">
                                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                  </svg>
                                  Interactive quizzes and assignments
                              </li>
                              <li class="flex gap-x-3">
                                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                  </svg>
                                  Community support
                              </li>
                          </ul>
                      </div>
                      <a href="#" aria-describedby="tier-basic" class="mt-8 block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold leading-6 text-white shadow-sm ring-1 ring-indigo-600 hover:bg-indigo-500">Join Now</a>
                  </div>

                  <!-- Pro Plan -->
                  <div class="flex flex-col justify-between rounded-3xl bg-white p-8 ring-1 ring-gray-200 lg:-mt-8 xl:p-10 transition-transform transform hover:scale-105 lg:min-h-[550px]">
                      <div>
                          <div class="flex items-center justify-between gap-x-4">
                              <h3 id="tier-pro" class="text-lg font-semibold leading-8 text-blue-700">Pro</h3>
                          </div>
                          <p class="mt-4 text-sm leading-6 text-gray-600">Advanced features for pros.</p>
                          <p class="mt-6 flex items-baseline gap-x-1">
                              <span class="text-4xl font-bold tracking-tight text-gray-900">$30</span>
                              <span class="text-sm font-semibold leading-6 text-gray-600">/month</span>
                          </p>
                          <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-600">
                              <li class="flex gap-x-3">
                                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                  </svg>
                                  Advanced course access
                              </li>
                              <li class="flex gap-x-3">
                                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                  </svg>
                                  Priority support
                              </li>
                              <li class="flex gap-x-3">
                                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                  </svg>
                                  Custom learning paths
                              </li>
                          </ul>
                      </div>
                      <a href="#" aria-describedby="tier-pro" class="mt-8 block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold leading-6 text-white shadow-sm ring-1 ring-indigo-600 hover:bg-indigo-500">Join Now</a>
                  </div>

                  <!-- Premium Plan -->
                  <div class="flex flex-col justify-between rounded-3xl bg-white p-8 ring-1 ring-gray-200 xl:p-10 transition-transform transform hover:scale-105 lg:min-h-[550px]">
                      <div>
                          <div class="flex items-center justify-between gap-x-4">
                              <h3 id="tier-premium" class="text-lg font-semibold leading-8 text-blue-700">Premium</h3>
                          </div>
                          <p class="mt-4 text-sm leading-6 text-gray-600">Unlimited access to all courses and premium features.</p>
                          <p class="mt-6 flex items-baseline gap-x-1">
                              <span class="text-4xl font-bold tracking-tight text-gray-900">$50</span>
                              <span class="text-sm font-semibold leading-6 text-gray-600">/month</span>
                          </p>
                          <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-600">
                              <li class="flex gap-x-3">
                                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                  </svg>
                                  Unlimited access to all courses
                              </li>
                              <li class="flex gap-x-3">
                                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                  </svg>
                                  Exclusive webinars
                              </li>
                              <li class="flex gap-x-3">
                                  <svg class="h-6 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                      <path fill-rule="evenodd" d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z" clip-rule="evenodd" />
                                  </svg>
                                  Personalized coaching
                              </li>
                          </ul>
                      </div>
                      <a href="#" aria-describedby="tier-premium" class="mt-8 block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold leading-6 text-white shadow-sm ring-1 ring-indigo-600 hover:bg-indigo-500">Join Now</a>
                  </div>
              </div>
          </div>
      </div>

      <!-- Footer -->
      <div class="mx-auto max-w-7xl px-6 lg:px-8">
        <footer aria-labelledby="footer-heading" class="relative border-t border-gray-900/10 sm:mt-56 sm:py-32">
          <h2 id="footer-heading" class="sr-only">Footer</h2>
          <div class="xl:grid xl:grid-cols-3 xl:gap-8">
            <video autoplay muted loop playsinline class="w-1/4 h-1/5 ">
                <source src="{{asset('animatedLogo.mp4')}}" type="video/mp4">
            </video>
            <div class="mt-16 grid grid-cols-2 gap-8 xl:col-span-2 xl:mt-0">
              <div class="md:grid md:grid-cols-2 md:gap-8">
                <div>
                  <h3 class="text-sm font-semibold leading-6 text-gray-900">Learning Resources</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Quizzes</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Groups</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Tutorials</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Webinars</a>
                    </li>
                  </ul>
                </div>
                <div class="md:mt-0">
                  <h3 class="text-sm font-semibold leading-6 text-gray-900">Support</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">FAQs</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Contact Us</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Help Center</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Community Forum</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div class="md:grid md:grid-cols-2 md:gap-8">
                <div>
                  <h3 class="text-sm font-semibold leading-6 text-gray-900">Our Team</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">About us</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Careers</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Blogs</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Press</a>
                    </li>
                  </ul>
                </div>
                <div class="md:mt-0">
                  <h3 class="text-sm font-semibold leading-6 text-gray-900">Legal</h3>
                  <ul role="list" class="mt-6 space-y-4">
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Private Policy</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Terms of Service</a>
                    </li>
                    <li>
                      <a href="#" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Cookie Policy</a>
                    </li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>

  </x-app-layout>
</body>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- search & filter-->
<script>

    $(document).ready(function () {

        // dropdown
        $(document).on('click', function(event) {
            if (!$(event.target).closest('.genre-dropdown').length &&
                !$(event.target).closest('.genre-icon').length) {
                $('.genre-dropdown').hide();
            }
            if (!$(event.target).closest('.duration-dropdown').length &&
                !$(event.target).closest('.duration-icon').length) {
                $('.duration-dropdown').hide();
            }
            if (!$(event.target).closest('.passgrade-dropdown').length &&
                !$(event.target).closest('.passgrade-icon').length) {
                $('.passgrade-dropdown').hide();
            }
            if (!$(event.target).closest('.sort-dropdown').length &&
                !$(event.target).closest('.sort-icon').length) {
                $('.sort-dropdown').hide();
            }
        });

        $('.genre-icon').click(function() {
            $('.genre-dropdown').toggle();
            $('.duration-dropdown').hide();
            $('.passgrade-dropdown').hide();
            $('.sort-dropdown').hide();
        });
        $('.duration-icon').click(function() {
            $('.duration-dropdown').toggle();
            $('.genre-dropdown').hide();
            $('.passgrade-dropdown').hide();
            $('.sort-dropdown').hide();
        });
        $('.passgrade-icon').click(function() {
            $('.passgrade-dropdown').toggle();
            $('.genre-dropdown').hide();
            $('.duration-dropdown').hide();
            $('.sort-dropdown').hide();
        });
        $('.sort-icon').click(function() {
            $('.sort-dropdown').toggle();
            $('.genre-dropdown').hide();
            $('.duration-dropdown').hide();
            $('.passgrade-dropdown').hide();

        });
            
        $('#clearSearch').on('click', function(){
            $('#searchInput').val('').focus();
            fetchData();
            $('#clearSearch').hide();
        });

        // Bind the search input event
        $('#searchInput').on('keyup', function () {
            
            let search = $('#searchInput').val();
            let selectedGenres = [];
            let selectedDurations = [];
            let selectedPassgrades = [];
            let selectedSort = [];
            
            if (search.trim() !== '' || selectedGenres.length > 0 || selectedDurations.length > 0 || selectedPassgrades.length > 0 || selectedSort > 0) {
                // console.log('in'); 
                $('#clearSearch').show();
                filterQuizzes();
            } else {
                $('#clearSearch').hide();
                fetchData(); // Fetch data without any filters
            }

        });

        // Bind the filter checkboxes event
        $('.genre-filter, .duration-filter, .passgrade-filter, .sort-filter').on('change', function () {
            // console.log('kk');
            updateFilters();
            filterQuizzes();
        });

        // Call filterQuizzes on page load
        filterQuizzes();

        // fetchData();
    });
    

        function updateFilters(){
            let selectedGenre = $('.genre-filter:checked').map(function(){
                return $(this).val();
            }).get();

            let selectedDuration = $('.duration-filter:checked').map(function(){
                return $(this).val();
            }).get();

            let selectedPassgrade = $('.passgrade-filter:checked').map(function(){
                return $(this).val();
            }).get();

            let selectedSort = $('.sort-filter:checked').map(function(){
                return $(this).val();
            }).get();

            let selectedFilters = [...selectedGenre, ...selectedDuration, ...selectedPassgrade, ...selectedSort];

            // console.log(selectedFilters);

            let filterContainer  = $('#active-filters');
            filterContainer.empty();

            selectedFilters.forEach(function(filter){
                filterContainer.append(
                    '<span class="m-1 inline-flex items-center rounded-full border border-gray-200 bg-white py-1.5 pl-3 pr-2 text-sm font-medium text-gray-900">'+
                    '<span>'+filter+'</span>'+
                        '<button type="button" class="ml-1 inline-flex h-4 w-4 flex-shrink-0 rounded-full p-1 text-gray-400 hover:bg-gray-200 hover:text-gray-500 remove-filter" data-filter="'+filter+'">'+
                            '<span class="sr-only">Remove filter for '+filter+'</span>'+
                            '<svg class="h-2 w-2" stroke="currentColor" fill="none" viewBox="0 0 8 8">'+
                                '<path stroke-linecap="round" stroke-width="1.5" d="M1 1l6 6m0-6L1 7" />'+
                            '</svg>'+
                        '</button>'+
                    '</span>'
                );
            });

            // remove filter
            $('.remove-filter').on('click', function(){
                let filter = $(this).data('filter');
                if ($('.genre-filter[value="' + filter + '"]').length > 0) {
                    $('.genre-filter[value="' + filter + '"]').prop('checked', false);
                } else if ($('.duration-filter[value="' + filter + '"]').length > 0) {
                    $('.duration-filter[value="' + filter + '"]').prop('checked', false);
                } else if ($('.passgrade-filter[value="' + filter + '"]').length > 0) {
                    $('.passgrade-filter[value="' + filter + '"]').prop('checked', false);
                } else if ($('.sort-filter[value="' + filter + '"]').length > 0) {
                    $('.sort-filter[value="' + filter + '"]').prop('checked', false);
                }

                updateFilters();
                filterQuizzes();
            });

        }

        function filterQuizzes() {
            let search = $('#searchInput').val();
            let selectedGenres = [];
            let selectedDurations = [];
            let selectedPassgrades = [];
            let selectedSort = [];

            $('.genre-filter:checked').each(function () {
                selectedGenres.push($(this).val());
            });
            
            $('.duration-filter:checked').each(function () {
                selectedDurations.push($(this).val());
            });
            
            $('.passgrade-filter:checked').each(function () {
                selectedPassgrades.push($(this).val());
            });

            $('.sort-filter:checked').each(function () {
                selectedSort.push($(this).val());
            });

            fetchData(search, selectedGenres, selectedDurations, selectedPassgrades, selectedSort);
        }

        function fetchData(search = '', selectedGenres = [], selectedDurations = [], selectedPassgrades =[], selectedSort=[]) {                                                                                                      
            $.ajax({
                url: "{{ route('quizzes.search.welcome') }}",
                type: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    search: search,
                    genres: selectedGenres,
                    durations: selectedDurations,
                    passgrades: selectedPassgrades,
                    sort: selectedSort,
                },
                success: function (response) {
                    // console.log('first',response);
                    let quizCards = $('.quiz-card');
                    quizCards.html('');
                    $.each(response.quizzes, function (index, quiz) {
                        // console.log('avg',quiz.average);
                        var profileImageUrl = '';
                        if (quiz.imageUrl)
                        {
                            profileImageUrl = '<img class="h-12 w-12 rounded-full bg-indigo-700 inline-block ml-2" src="'+quiz.imageUrl+'" alt="Profile Image">';
                        }
                        else{
                            profileImageUrl = '<img class="h-12 w-12 rounded-full bg-indigo-700 inline-block ml-2" src="/images/default.jpeg" alt="Default Profile Image">';
                        }
                        var backgroundStyle = '';
                        if (quiz.iconUrl) {
                            backgroundStyle = 'background-image: url(' + quiz.iconUrl + ');';
                        } else {
                            backgroundStyle = 'background-color: #ADD8E6;';
                        }
                         var action = '';
                                action = 
                                '<a type="button" class="block rounded-md bg-indigo-600 px-2 py-1 text-center text-m font-semibold text-white hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700" href="/questions/show/'+ quiz.id +'/">TAKE</a>';
        
                            var rating = quiz.average ?? 0;
                            var filledStars = Math.floor(rating);
                            var halfStar = (rating - filledStars) >= 0.5;
                            var emptyStars = 5 - filledStars - (halfStar ? 1 : 0);
                            var review = '';
                            for (var i = 0; i < filledStars; i++) {
                                review += 
                                    '<svg class="w-6 h-6 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">' +
                                        '<path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>'+
                                    '</svg>';
                            }
                            if (halfStar) {
                                review += 
                                    '<svg class="w-6 h-6 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">'+
                                        '<path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>'+
                                    '</svg>';
                            }
                            for (var i = 0; i < emptyStars; i++) {
                                review += 
                                    '<svg class="w-6 h-6 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20"> '+
                                        '<path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>'+
                                    '</svg>';
                            }

                            let isSaved = quiz.savestatus === 'saved';
                            // console.log(isSaved);   

                            let hours = quiz.hours;
                            let minutes = quiz.minutes;
                            let duration = '';
                            let participants = '';
                            if (hours == 0) {
                                if (minutes == 1) {
                                    duration = 'Duration: <span class="font-medium">' + minutes + ' Minute</span>';
                                } else {
                                    duration = 'Duration: <span class="font-medium">' + minutes + ' Minutes</span>';
                                }
                            } else {
                                if (minutes == 0) {
                                    if (hours == 1) {
                                        duration = 'Duration: <span class="font-medium">' + hours + ' Hour</span>';
                                    } else {
                                        duration = 'Duration: <span class="font-medium">' + hours + ' Hours</span>';
                                    }
                                } else {
                                    if (hours == 1) {
                                        duration = 'Duration: <span class="font-medium">' + hours + ' Hour ' + minutes + ' Minutes</span>';
                                    } else {
                                        duration = 'Duration: <span class="font-medium">' + hours + ' Hours ' + minutes + ' Minutes</span>';
                                    }
                                }
                            }
                            // console.log('users', quiz.participants);
                            if(quiz.participants == null)
                            {
                                participants = '<h4 class="text-xl font-bold text-navy-700 dark:text-white">0</h4>';

                            } else{
                                participants = '<h4 class="text-xl font-bold text-navy-700 dark:text-white">'+quiz.participants+'</h4>';
                            }
                            let cardContent = '';
                            
                            if (quiz.visibility == 'public' && quiz.status == 'publish')
                            {
                                cardContent += 
                                '<div  class="quiz-card-each card-content border-b-8 border-l-8 border-yellow-500 p-6 rounded-lg shadow-md mb-6" style="' + backgroundStyle + '">' + 
                                        '<div class="flex items-center justify-between mb-3">'+
                                            '<h2 class="card-title text-gray-800 text-lg truncate overflow-hidden text-ellipsis font-bold  w-full">'+quiz.title+'</h2>'+
                                                    '<input type="hidden" name="status" value="">'+
                                        '</div>'+
        
                                        '<div class="flex-grow">'+
                                            '<div class="mt-2">'+
                                                '<p class="leading-relaxed text-base font-semibold text-gray-800">'+
                                                    'Genre: <span class="font-medium">'+quiz.genre.name+'</span>'+
                                                '</p>'+
                                                '<p class="leading-relaxed text-base font-semibold text-gray-800">'+
                                                    duration+
                                                '</p>'+
                                                '<p class="leading-relaxed text-base font-semibold text-gray-800">'+
                                                    'Total Score: <span class="font-medium">'+quiz.total_points+'</span>'+
                                                '</p>'+
                                                '<p class="leading-relaxed text-base font-semibold text-gray-800">'+
                                                    'Pass Grade: <span class="font-medium">'+quiz.passgrade+'</span>'+
                                                '</p>'+
                                                '<p class="leading-relaxed text-base font-semibold text-gray-800">'+
                                                    'Total Questions: <span class="font-medium">'+quiz.total_questions+'</span>'+
                                                '</p>'+
                                                '<p class="leading-relaxed text-base font-semibold text-gray-800">'+
                                                    'Publish Date : <span class="font-medium">'+quiz.publish_date+'</span>'+
                                                '</p>'+
        
                                            '<div class="flex justify-between items-start">' +
                                                '<div class="leading-relaxed text-base font-semibold text-gray-800 flex-1 min-w-[200px]">' +
                                                    'Review:' +
                                                    '<div class="flex items-center mt-2">' + review + '</div>' +
                                                '</div>' +
                                                '<div class="items-center space-x-2 mt-2">' +
                                                    '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">' +
                                                        '<path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />' +
                                                        '<path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />' +
                                                    '</svg>' 
                                                    + participants +
                                                '</div>' +
                                            '</div>'+
        
                                            '<div class="flex mt-4 justify-between items-center ">'+
                                                '<div class="leading-relaxed text-base font-bold text-gray-800 flex-1 min-w-[200px]">'+
                                                    'By:'+
                                                    '<div class="flex items-center mt-2">'+
                                                    '<span class="bg-purple-400 text-l text-white rounded-full px-3 py-1">'
                                                        +quiz.user.name+
                                                    '</span>'
                                                        + profileImageUrl +
                                                    '</div>'+
                                                '</div>'+
                                                '<div class="flex flex-col flex-wrap gap-y-2 flex-shrink-0 mr-2">'
                                                   + action +
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>';
                            }
                            
        
                            quizCards.append(cardContent);
                    });

                    $('.saveajax').click(function(e) {
                        e.preventDefault();
                        
                        var button = $(this);
                        var quizId = button.data('quiz_id');
                        var status = button.data('status');
                        
                        $.ajax({
                            url: '{{ route("bookmark.store") }}',
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                quiz_id: quizId,
                                status: status
                            },
                            success: function(response) {
                                button.data('status', response.status);
                                // console.log('Full response:', response);
                                if (response.status !== undefined) {
                                // console.log('Received status:', response.status);
                                var newstatus = response.status;
                                if (newstatus === 'saved') {
                                    // console.log('Status is saved');
                                    button.find('svg').attr('fill', 'yellow');
                                    button.find('.tooltip-text').text('Unsave');
                                } else {
                                    // console.log('Status is unsaved');
                                    button.find('svg').attr('fill', 'none');
                                    button.find('.tooltip-text').text('Save');
                                }
                                } else {
                            console.error('Status is undefined in the response');
                            }
                            },
                            error: function(xhr) {
                                // console.log(xhr.responseText);
                            }
                        });
                    });

                },
                error: function (xhr) {
                    // console.log(xhr.responseText);
                }
            });

        }

        
</script>
<!-- saved/unsaved -->
<script>
    $(document).ready(function() {
        $('.saveajax').click(function(e) {
            e.preventDefault();
            
            var button = $(this);
            var quizId = button.data('quiz_id');
            var status = button.data('status');
            
            $.ajax({
                url: '{{ route("bookmark.store") }}',
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    quiz_id: quizId,
                    status: status
                },
                success: function(response) {
                    button.data('status', response.status);
                    // console.log('Full response:', response);
                    if (response.status !== undefined) {
                    // console.log('Received status:', response.status);
                    var newstatus = response.status;
                    if (newstatus === 'saved') {
                        // console.log('Status is saved');
                        button.find('svg').attr('fill', 'yellow');
                        button.find('.tooltip-text').text('Unsave');
                    } else {
                        // console.log('Status is unsaved');
                        button.find('svg').attr('fill', 'none');
                        button.find('.tooltip-text').text('Save');
                    }
                    } else {
                console.error('Status is undefined in the response');
                }
                },
                error: function(xhr) {
                    // console.log(xhr.responseText);
                }
            });
        });
    });
</script>

<!-- teachers and student dropdown  -->
<script>
    $(document).ready(function() {
        $('#teachers-link').hover(
            function() {
                $('#teachers-dropdown').css({
                    // 'top': $(this).offset().top + $(this).outerHeight(),
                    'left': $(this).offset().left
                }).removeClass('hidden');
            },
            function() {
                setTimeout(function() {
                    if (!$('#teachers-dropdown').is(':hover')) {
                        $('#teachers-dropdown').addClass('hidden');
                    }
                }, 50);
            }
        );

        $('#teachers-dropdown').hover(
            function() {
                $(this).removeClass('hidden');
            },
            function() {
                $(this).addClass('hidden');
            }
        );

        $('#students-link').hover(
            function() {
                $('#students-dropdown').css({
                    // 'top': $(this).offset().top + $(this).outerHeight(),
                    'left': $(this).offset().left
                }).removeClass('hidden');
            },
            function() {
                setTimeout(function() {
                    if (!$('#students-dropdown').is(':hover')) {
                        $('#students-dropdown').addClass('hidden');
                    }
                }, 50);
            }
        );

        $('#students-dropdown').hover(
            function() {
                $(this).removeClass('hidden');
            },
            function() {
                $(this).addClass('hidden');
            }
        );
        
    });
</script>

<!-- animated header -->
<script>
    var animation = lottie.loadAnimation({
        container: document.getElementById('lottie-container'), 
        renderer: 'svg', 
        loop: true, 
        autoplay: true, 
        path: '/animation.json' 
    });

</script>

<!-- animated word quizzes  -->
<script>
  function setTextAnimation(delay, duration, strokeWidth, timingFunction, strokeColor,repeat) {
            let role = document.getElementById('svgGroup');
            if(role){
              const paths = role.querySelectorAll('path');
              let mode=repeat?'infinite':'forwards'
              for (let i = 0; i < paths.length; i++) {
                  const path = paths[i];
                  const length = path.getTotalLength();
                  path.style["stroke-dashoffset"] = `${length}px`;
                  path.style["stroke-dasharray"] = `${length}px`;
                  path.style["stroke-width"] = `${strokeWidth}px`;
                  path.style["stroke"] = `${strokeColor}`;
                  path.style["animation"] = `${duration}s svg-text-anim ${mode} ${timingFunction}`;
                  path.style["animation-delay"] = `${i * delay}s`;
              }
            }

            let social = document.getElementById('social');
            if(social){
              const paths = social.querySelectorAll('path');
              let mode=repeat?'infinite':'forwards'
              for (let i = 0; i < paths.length; i++) {
                  const path = paths[i];
                  const length = path.getTotalLength();
                  path.style["stroke-dashoffset"] = `${length}px`;
                  path.style["stroke-dasharray"] = `${length}px`;
                  path.style["stroke-width"] = `${strokeWidth}px`;
                  path.style["stroke"] = `${strokeColor}`;
                  path.style["animation"] = `${duration}s svg-text-anim ${mode} ${timingFunction}`;
                  path.style["animation-delay"] = `${i * delay}s`;
              }
            }
        }
 setTextAnimation(0.1,2.7,3,'step-start','#2979ff',true);

</script>
