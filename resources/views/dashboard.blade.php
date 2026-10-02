@extends('layout')

@section('content')

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
            bottom: 80%; /* Position the tooltip above the text */
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }

        .quiz-card-each {
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .quiz-card-each:hover {
            transform: scale(1.05); /* Enlarges the card slightly on hover */
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15); /* Adds a shadow effect */
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

</style>
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

<x-app-layout>

<div class="m-4 sm:px-6 md:px7 py-8 lg:px-8">

    <div class="flex justify-center gap-2">
        <!-- search -->
        <div class="mt-10 w-3/4 lg:w-1/2 relative">
                <div for="search" class="sr-only">Search Quizzes...</div>
                <input id="searchInput" name="search" class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6 h-10" placeholder="Search" type="text">
                <button id="clearSearch" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer outline-none" style="display: none;">
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

    <div class=" container mx-auto p-4">
        <div class="quiz-card grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
            @foreach ($quizzes as $quiz)
                @if ($quiz->visibility == 'public' && $quiz->status == 'publish')
                <div class="quiz-card-each card-content border-b-8 border-l-8 border-yellow-500 p-6 rounded shadow-md mb-6" style="{{ $quiz->icon ? 'background-image: url(' . Storage::url($quiz->icon) . ');' : 'background-color: #ADD8E6;' }}">
                        <div class="flex items-center justify-between mb-3">
                                    <h2 class="card-title text-gray-800 text-lg truncate overflow-hidden text-ellipsis font-bold w-full">{{$quiz->title}}</h2>
                                    @php
                                        $bookmark = $quiz->bookmarks()->where('user_id', auth()->user()->id)->first();
                                        $isSaved = $bookmark && $bookmark->status === 'saved';
                                    @endphp
                                    <button id="" class="saveajax tooltip save saved-icon" data-quiz_id="{{$quiz->id}}" data-status="{{$isSaved ? 'saved' : 'unsaved'}}">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $isSaved ? 'yellow' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 save-icon quiz-icon-{{$quiz->id}}">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                        </svg>
                                        @if($isSaved == true)
                                            <span class="tooltip-text">Unsave</span>
                                        @else
                                            <span class="tooltip-text">Save</span>
                                        @endif
                                    </button>
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
                                                <img class="h-10 w-10 rounded-full bg-indigo-700" src="{{ asset(Storage::url($quiz->user->image)) }}" alt="Profile Image">
                                            @else
                                                <img class="h-10 w-10 rounded-full bg-indigo-700" src="{{ asset('images/default.jpeg') }}" alt="Default Profile Image">
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex justify-end mt-4">
                                @if ($quiz->action == 'take')
                                    <a type="button" class="block w-24 rounded-md bg-indigo-600 px-2 py-1 text-center text-m font-semibold text-white hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700" href="{{ route('questions.show', $quiz->id) }}">TAKE</a>
                                @else
                                <div class="flex gap-2">
                                    <a type="button" class="block rounded-md bg-indigo-600 px-2 py-1 text-center text-m font-semibold text-white hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700" href="{{ route('questions.show', $quiz->id) }}">RETAKE</a>
                                    <a type="button" class="block rounded-md bg-green-600 px-2 py-1 text-center text-m font-semibold text-white hover:bg-green-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-700" href="{{ route('report.view', ['userId'=>auth()->user()->id, 'quizId'=>$quiz->id, 'attempt'=>1]) }}">REPORT</a>
                                </div>
                                @endif
                            </div>
                        </div>              
                    </div>
                @endif
            @endforeach
        </div>
    </div>

</div>

</x-app-layout>


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
                console.log('in'); 
                $('#clearSearch').show();
                filterQuizzes();
            } else {
                $('#clearSearch').hide();
                fetchData(); // Fetch data without any filters
            }

        });

        // Bind the filter checkboxes event
        $('.genre-filter, .duration-filter, .passgrade-filter, .sort-filter').on('change', function () {
            console.log('kk');
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

            console.log(selectedFilters);

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
                url: "{{ route('quizzes.search') }}",
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
                    console.log('first',response);
                    let quizCards = $('.quiz-card');
                    quizCards.html('');
                    $.each(response.quizzes, function (index, quiz) {
                        var profileImageUrl = '';
                        if (quiz.imageUrl)
                        {
                            profileImageUrl = '<img class="h-12 w-12 rounded-full bg-indigo-700 inline-block ml-2" src="'+quiz.imageUrl+'" alt="Profile Image">';
                            
                        }
                        else{
                            profileImageUrl = '<img class="h-12 w-12 rounded-full bg-indigo-700 inline-block ml-2" src="/images/default.jpeg" alt="Default Profile Image">';
                            
                        }
                        console.log(quiz.iconUrl);
                        var backgroundStyle = '';
                        if (quiz.iconUrl) {
                            backgroundStyle = 'background-image: url(' + quiz.iconUrl + ');';
                        } else {
                            backgroundStyle = 'background-color: #ADD8E6;';
                        }
                        console.log(backgroundStyle);
                            var action = '';
                            if (quiz.action == 'take') {
                                action = 
                                '<a type="button" class="block w-24 rounded-md bg-indigo-600 px-2 py-1 text-center text-m font-semibold text-white hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700" href="/questions/show/'+ quiz.id +'/">TAKE</a>';
                            } else {
                                action = 
                                '<div class="flex gap-2">'+
                                    '<a type="button" class="block rounded-md bg-indigo-600 px-2 py-1 text-center text-m font-semibold text-white hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700" href="/questions/show/'+quiz.id+'/">RETAKE</a>'+
                                    '<a type="button" class="block rounded-md bg-green-600 px-2 py-1 text-center text-m font-semibold text-white hover:bg-green-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-700" href="/report/view/'+userId+'/'+quiz.id+'/'+attempt+'/participant/">REPORT</a>'+
                                '</div>';
                            }
        
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
                            console.log(isSaved);   
                            let userId = auth()->user()->id;
                            let attempt = 1;
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
                            console.log('users', quiz.participants);
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
                                                    '<button id="" class="saveajax tooltip save saved-icon" data-quiz_id="'+quiz.id+'" data-status="'+(isSaved ? 'saved' : 'unsaved')+'">'+
                                                        '<svg xmlns="http://www.w3.org/2000/svg" fill="'+(isSaved ? 'yellow' : 'none')+'" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 save-icon quiz-icon-'+quiz.id+'">'+
                                                            '<path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z"/>'+
                                                        '</svg>'+
                                                        '<span class="tooltip-text">'+(isSaved ? 'Unsave' : 'Save')+'</span>'+
                                                    '</button>'+
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
                                            '</div>'+
        
                                            '<div class="container mx-auto mt-4 flex justify-between items-center">'+
                                                '<div class="leading-relaxed text-base font-bold text-gray-800 min-w-[200px]">'+
                                                    'By:'+
                                                    '<div class="flex items-center mt-2">'+
                                                    '<span class="bg-purple-400 text-l text-white rounded-full px-3 py-1">'
                                                        +quiz.user.name+
                                                    '</span>'
                                                        + profileImageUrl +
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+

                                            '<div class="flex justify-end mt-4">'
                                               +action+
                                            '</div>'+
                                        '</div>'+
                                    '</div>';
                                // '</div>';
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
                                console.log('Full response:', response);
                                if (response.status !== undefined) {
                                console.log('Received status:', response.status);
                                var newstatus = response.status;
                                if (newstatus === 'saved') {
                                    console.log('Status is saved');
                                    button.find('svg').attr('fill', 'yellow');
                                    button.find('.tooltip-text').text('Unsave');
                                } else {
                                    console.log('Status is unsaved');
                                    button.find('svg').attr('fill', 'none');
                                    button.find('.tooltip-text').text('Save');
                                }
                                } else {
                            console.error('Status is undefined in the response');
                            }
                            },
                            error: function(xhr) {
                                console.log(xhr.responseText);
                            }
                        });
                    });

                },
                error: function (xhr) {
                    console.log(xhr.responseText);
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
                    console.log('Full response:', response);
                    if (response.status !== undefined) {
                    console.log('Received status:', response.status);
                    var newstatus = response.status;
                    if (newstatus === 'saved') {
                        console.log('Status is saved');
                        button.find('svg').attr('fill', 'yellow');
                        button.find('.tooltip-text').text('Unsave');
                    } else {
                        console.log('Status is unsaved');
                        button.find('svg').attr('fill', 'none');
                        button.find('.tooltip-text').text('Save');
                    }
                    } else {
                console.error('Status is undefined in the response');
                }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection