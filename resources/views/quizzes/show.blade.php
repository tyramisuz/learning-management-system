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

<title>List Quiz</title>

<div class="px-4 sm:px-6 md:px7 py-10 lg:px-8"> 
<div class="mx-auto max-w-7xl"> 
<div class="px-4 sm:px-0">

    @csrf
    @method('PUT')

    <div class="space-y-15"> 
        <div class="px-4 sm:px-0 sm:flex-0">
        <h2 class="text-2xl text-center font-bold leading-7 text-grey-900">Quiz Details</h2>
        </div>
       
<div class="py-3 border-t border-white/10">
    <dl class="divide-y divide-white/10">
      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-l font-medium leading-6 font-bold text-grey-900">Title</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">{{ $quiz->title }}</dd>
      </div>

      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-l font-medium leading-6 font-bold text-grey-900">Genre</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> {{ $quiz->genre }}</dd>
      </div>
    
            @php
            $hours = floor($quiz->duration / 60);
            $minutes = $quiz->duration % 60;
            @endphp

      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-l font-medium leading-6 font-bold text-grey-900">Duration</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">
          @if($minutes == 0)
              @if($hours == 1)
                  {{$hours}} Hour
              @else
                  {{$hours}} Hours
              @endif
          @else
              @if($hours == 1)
                  {{$hours}} Hour {{$minutes}} Minutes
              @else
                  {{$minutes}} Minutes
              @endif
          @endif
        </dd>
      </div>

      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-l font-medium leading-6 font-bold text-grey-900">Visibility</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> {{ $quiz->visibility }}</dd>
      </div>

      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-l font-medium leading-6 font-bold text-grey-900">Status</dt>
        <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> {{ $quiz->status }}</dd>
      </div>

      <div class="px-4 py-6 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-0">
        <dt class="text-l font-medium leading-6 font-bold text-grey-900">Participation</dt>
        @if($quiz->participants == null)
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0">N/A</dd>
          @else
          <dd class="mt-1 text-sm leading-6 text-gray-700 sm:col-span-2 sm:mt-0"> {{ $quiz->participants }}</dd>
        @endif
      </div>
    </dl> 
</div>

<div class="px-4 sm:px-6 md:px7 py-6 lg:px-6"> 
  <div class="mx-auto max-w-7xl"> 

  <h2 class="m-5 text-red-900 font-medium text-xl">Questions Details</h2>

    @if($quiz->questions->isNotEmpty())
    <div class="relative overflow-x-auto shadow-md">
                <table class="w-full text-sm text-left rtl:text-right text-white dark:text-white">
                    <thead class="text-xs text-black  uppercase bg-gray-300 dark:bg-gray-100 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Type
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Points
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Question
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($questions as $question)
                        <tr class="odd:bg-gray-500 odd:dark:bg-gray-900 even:bg-gray-700 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <th scope="row" class="px-6 py-4 font-medium text-white whitespace-nowrap dark:text-white">
                            {{ ++$i }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $question->type }}
                            </td>
                            <td class="px-6 py-4">
                                {{ $question->point}}
                            </td>
                            <td class="px-6 py-4">
                            {{ $question->question }}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center">No questions available for this quiz.</p>
        @endif
    </div>

  <div class="mt-6 flex justify-end"> 
    <div class="mr-2 items-center sm:flex sm:items-center">
      <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
      <a type="button" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" href="{{ route('quizzes.index') }}">Back</a>
      </div>
    </div>
  </div>

  </div>
</div>


@endsection