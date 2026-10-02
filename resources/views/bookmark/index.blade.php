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

    <div class="px-4 sm:px-6 md:px7 py-10 lg:px-8">
        <h1 class="text-base font-bold leading-6 text-xl text-slate-950">Favourite Quizzes </h1>
    </div>
    
    @if ($savedQuiz->isNotEmpty())
    <!-- card -->
    <div class=" container mx-auto p-4">
        <div class="quiz-card grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-3 gap-4">
            @foreach ($quizzes as $quiz)
                @if ($quiz->visibility == 'public' && $quiz->status == 'publish')
                <div id="card-{{$quiz->id}}" class="quiz-card-each card-content border-b-8 border-l-8 border-yellow-500 p-6 rounded shadow-md mb-6" style="{{ $quiz->icon ? 'background-image: url(' . Storage::url($quiz->icon) . ');' : 'background-color: #ADD8E6;' }}">
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
                                                <img class="h-12 w-12 rounded-full bg-indigo-700" src="{{ Storage::url($quiz->user->image) }}" alt="Profile Image">
                                            @else
                                                <img class="h-12 w-12 rounded-full bg-indigo-700" src="/images/default.jpeg" alt="Default Profile Image">
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
                                    <a type="button" class="block rounded-md bg-green-600 px-2 py-1 text-center text-m font-semibold text-white hover:bg-green-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-700" href="{{ route('report.view', $quiz->id) }}">REPORT</a>
                                </div>
                                @endif
                            </div>
                        </div>              
                    </div>
                @endif
            @endforeach
        </div>
    </div>
    @else
    <!-- <div class="col-span-1 md:col-span-2 lg:col-span-3"> -->
        <p class="text-gray-600 text-center">You have no quiz saved.</p>
    <!-- </div> -->
    @endif

</x-app-layout>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
                    var quizId = button.data('quiz_id');
                    console.log('Received response:', response);
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
                        $('#card-' + quizId).remove();

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