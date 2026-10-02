@extends('layout')

@section('content')

<style>
    #alert {
        transition: opacity 0.5s ease-out;
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

<title>Participants</title>
<div class="px-4 sm:px-6 md:px-7 py-10 lg:px-8">
    <div class="sm:flex sm:items-center">
            <div class="sm:flex-auto">
                <h1 class="text-base mb-5 font-bold leading-6 text-xl text-slate-950">Quiz: {{$quiz->title}}</h1>
            </div>
            <div class="mt-4 sm:ml-16 sm:mt-0 flex gap-2">
                    <a type="button" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" href="{{ route('quizzes.index') }}">Back</a>
            </div>
        </div>
        <h1 class="text-base font-bold leading-6 text-l text-slate-950">Participants</h1>
        <p class="mt-2 text-xs text-gray-700">Learning Odyssey</p>

    </div>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 xl:grid-cols-2 gap-4">
        <div class="w-full px-4">
            <div class="relative min-w-0 break-words bg-white rounded-lg shadow-lg mb-6 hover:bg-gray-100 transition-colors duration-300 ease-in-out">
                <a href="{{ route('quizzes.firstattempt', $quiz->id) }}" class="block">
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                <h5 class="text-blueGray-400 font-bold text-xl">First Attempt</h5>
                                <span class="font-bold text-xs">Participant</span>
                            </div>
                        </div>
                        <p class="text-red-500 text-3xl"><strong>{{ $firstparticipant }}</strong></p>
                    </div>
                </a>
            </div>
        </div>

        <div class="w-full px-4">
            <div class="relative min-w-0 break-words bg-white rounded-lg shadow-lg mb-6 hover:bg-gray-100 transition-colors duration-300 ease-in-out">
                <a href="{{ route('quizzes.subsequentattempt', $quiz->id) }}" class="block">
                    <div class="flex-auto p-4">
                        <div class="flex flex-wrap">
                            <div class="relative w-full pr-4 max-w-full flex-grow flex-1">
                                <h5 class="text-blueGray-400 font-bold text-xl">Subsequent Attempt</h5>
                                <span class="font-bold text-xs">Participant</span>
                            </div>
                        </div>
                        <p class="text-red-500 text-3xl"><strong>{{ $subsequentparticipant }}</strong></p>
                    </div>
                </a>
            </div>
        </div>
    </div>



</div>

<style>
    .attempt-button:hover {
        opacity: 0.8;
    }
    .attempt-button {
        display: inline-block;
    }
</style>

@endsection
