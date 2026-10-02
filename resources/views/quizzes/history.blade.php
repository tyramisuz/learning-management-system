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

<x-app-layout>
    <div class="bg-gray-100 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h2 class="mt-10 ml-2mx-auto max-w-2xl text-base font-semibold leading-6 py-8 text-gray-900 lg:mx-0 lg:max-w-none">Quiz History</h2>
        @if($quizzes->isNotEmpty())
            <!-- <p class="text-l text-gray-900 py-4">Completed</p> -->
            @foreach($quizzes as $quiz)
            <div class="p-4 mb-2 rounded-lg shadow-lg flex items-center justify-between" style="{{ $quiz->icon ? 'background-image: url(' . Storage::url($quiz->icon) . ');' : 'background-color: #ADD8E6;' }}">
                <div class="flex items-center gap-4">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-purple-800">
                        <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd" />
                        <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                    </svg>
                    <div>
                        <p class="text-sm font-semibold uppercase">{{ $quiz->title }}</p>
                        @php
                            
                            $response = \App\Models\Response::where('quiz_id', $quiz->id)
                                                            ->where('user_id', auth()->user()->id)
                                                            ->pluck('created_at')
                                                            ->first();
                                                            //dd($response);
                        @endphp
                        <p class="text-sm text-gray-600">Completed On {{ $response->format('M d, Y') }}</p>
                    </div>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('questions.show', $quiz->id)}}" class="font-semibold uppercase px-2 py-2 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 rounded-md border-b border-gray-500 text-purple-900 font-extrabold bg-purple-300 hover:bg-purple-500">
                        Retake
                    </a>
                    <a href="{{ route('report.view', ['userId'=>auth()->user()->id, 'quizId'=>$quiz->id, 'attempt'=>1]) }}" class="font-semibold uppercase px-2 py-2 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 rounded-md border-b border-gray-500 text-yellow-900 font-extrabold bg-yellow-300 hover:bg-yellow-500">
                        Report
                    </a>
                </div>
            </div>
            @endforeach
        {{$quizzes->links('pagination.custom')}}

        @else
            <p class="text-center">You have no submitted quiz.</p>
        @endif
    </div>
</x-app-layout>

@endsection
