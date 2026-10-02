@extends('layout')

@section('content')

<style>
    #alert {
        transition: opacity 0.5s ease-out;
    }

    .dropdown {
    width: 200px; 
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
            bottom: 125%; /* Position the tooltip above the text */
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

<div class="px-4 bg-white sm:px-6 md:px7 py-2 lg:px-8"> 
<div class="divide-y divide-gray-200 overflow-hidden rounded-lg bg-white shadow">
    <div class="px-4 py-5 sm:px-6">
            <div class="h-40 text-gray-900 bg-opacity-50 p-4 rounded-lg" style="background-color: {{$group->color}};">
                <h2 class="text-3xl uppercase font-bold">
                    {{$group->name}}
                </h2>
                <p class="mt-4 text-l underline">{{$group->description}}</p>
            </div>
    </div>
    
    <div class="px-4 py-5 sm:p-6">
        <div class="grid grid-cols-2">
            <div>
                <h2 class="mt-2 font-bold text-2xl leading-7">Quiz: {{$quiz->title}}</h2>
                <h1 class="font-semibold mt-2 text-sm leading-7">Genre: {{$quiz->genre->name}}</h1>
                <h4 class="py-2 font-semibold text-m">Points:
                <span class="text-gray-800 text-m">{{$points}}</span>
                <p class="">Due on: {{$date}}</p>
                </h4>
                <!-- @php
                    $rating = $rate ?? 0;
                    $filledStars = floor($rating);
                    $halfStar = ($rating - $filledStars) >= 0.5;
                    $emptyStars = 5 - $filledStars - ($halfStar ? 1 : 0);
                @endphp
                
                <h2><strong>Review</strong></h2>
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
                    </div> -->
                
            </div>
            @if($quiz->user_id != auth()->user()->id)
            <div>
                <div class="flex mb-2 justify-between">
                    <h2 class="text-2xl font-semibold text-gray-900">Work</h2>
                    <div class="">
                        @if($action == 'take')
                        <p class="text-red-600 "><strong>Not Completed</strong></p>
                        @else
                        <p class="text-green-600"><strong>Completed</strong></p>
                        @endif
                    </div>
                </div>
                @php
                //dd($groupId);
                @endphp
                <div class="text-center items-center px-6">
                    @if ($action == 'take')
                    <a type="button" href="{{ route('questions.show.group',[ 'quizId'=> $quiz->id, 'groupId'=> $groupId ]) }}" class="font-semibold uppercase w-full sm:w-auto px-9 py-4 mb-4 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 rounded-md block  border-b border-gray-500 text-green-900 font-extrabold bg-green-300 hover:bg-green-500">Take</a>
                    @else
                    <a type="button" href="{{ route('questions.show.group',[ 'quizId'=>$quiz->id, 'groupId'=>$groupId]) }}" class="font-semibold uppercase w-full sm:w-auto px-9 py-4 mb-4 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 rounded-md block  border-b border-gray-500 text-purple-900 font-extrabold bg-purple-300 hover:bg-purple-500">Retake</a>
                    <a type="button" href="{{ route('report.view', $quiz->id) }}" class="font-semibold uppercase w-full sm:w-auto px-9 py-4 mb-4 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 rounded-md block  border-b border-gray-500 text-yellow-900 font-extrabold bg-yellow-300 hover:bg-yellow-500">Report</a>
                    @endif
                </div>
            </div>
            @endif
        </div>
    </div>

    
    <div class="px-4 py-4 sm:px-6">
        <div class="flex justify-end">
            <a type="button" class="w-auto px-6 py-2 mb-4 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 rounded-sm block border-b border-purple-300 hover:bg-purple-300 text-purple-700 rounded-lg" style="background-color: {{$group->color}};"
            onclick="history.back();">
            Back
            </a>
        </div>
    </div>
    
</div>

@endsection