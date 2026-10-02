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


<title>Participants</title>
<div class="px-4 sm:px-6 md:px7 py-10 lg:px-8">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-base mb-5 font-bold leading-6 text-xl text-slate-950">Quiz: {{$quiz->title}}</h1>
      <h1 class="text-base font-bold leading-6 text-l text-slate-950">First Attempt Participants</h1>
      <p class="mt-2 text-xs text-gray-700">Learning Odyssey</p>
    </div>
  </div>


<div class="mt-8 flow-root">
  <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
    <div class="inline-block min-w-full py-2 align-middle">
      <table class="min-w-full divide-y divide-gray-300">
        <thead>
          <tr>
            <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">Date Submit</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Gender</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Email</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Score</th>
            <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">School</th>
            <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Action</th>
            
          </tr>
        </thead>
        
        <tbody class="divide-y divide-gray-200 bg-white">
          @foreach ($users  as $user)
              <input type="hidden" name="user_id" value="{{ $user->id }}">
    
              <tr>
                <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm text-gray-700 sm:pl-6 lg:pl-8">{{ $dateSubmit }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">{{ $user->name }}</td>

                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">{{ $user->gender }}</td>

                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">{{ $user-> email }}</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">{{ $formatted[$user->id] ?? 0 }}%</td>
                <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-700">{{ $user-> school}}</td>

                <td class="relative whitespace-nowrap py-4 pl-3 pr-4 text-right text-sm font-medium sm:pr-6 lg:pr-8 flex justify-center">
                <a href="{{route('report.student', ['userId'=> $user->id,'quizId' =>$quiz->id, 'attempt'=> $attempt])}}" class="ms-3 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">View Report</a>
                </td>                                
              </tr>
          @endforeach
        </tbody>
      </table>
      {{ $users->links('pagination.custom') }}
    </div>
  </div>
</div>

        <div class="mt-6 flex justify-end"> 
          <div class="mr-2 items-center sm:flex sm:items-center">
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a type="button" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" href="{{ route('quizzes.participants', $quiz->id) }}">Back</a>
            </div>
          </div>
        </div>

    </div>
  </div>

@endsection
