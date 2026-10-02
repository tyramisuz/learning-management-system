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

<title>Edit Assignment</title>

<form action="{{ route('groups.updateAssignment', ['id'=>$id,'groupId'=> $groupId]) }}" method="POST" enctype="multipart/form-data">
  <div class="px-4 bg-gray-100 sm:px-6 md:px7 py-10 lg:px-8"> 
    <div class="mx-auto max-w-7xl"> 

        <div class="space-y-15"> 
          <div class="px-4 sm:px-0 sm:flex-0">
            <h2 class="text-2xl text-center font-bold leading-7 text-grey-900">Edit Assignment</h2>
          </div>

            @csrf
            @method('PUT')

          <div class="bg-white mt-4 shadow-lg rounded-lg p-4">
            <!-- in edit quiz -->
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-5">
              <div class="sm:col-span-4">
                <label for="" class="block text-sm font-semibold leading-6 text-gray-900">Assign Quiz</label>
                <div class="mt-2">
                  <select id="" name="quiz_id" class="flex text-gray-900 rounded-md bg-white/5 ring-1 ring-inset ring-white/10 w-full ps-10 p-2.5 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500" value="" required>
                    @foreach($quizzes as $quizT)
                    <option selected class="text-gray-900">{{$quizT->title}}</option>
                    @endforeach
                    @foreach($quiz as $quiz)
                    @if (auth()->user()->id == $quiz->user_id && $quiz->status == 'publish')
                    <option class="text-gray-900" value="{{$quiz->id}}">{{$quiz->title}}</option>
                    @endif
                    @endforeach
                  </select>
                </div>
              </div>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-18sm:grid-cols-5">
              <div class="sm:col-span-4">
                      <label for="about" class="block text-sm font-semibold leading-6 text-gray-900">Due Date</label>
                    <div class="relative max-w-sm">
                    <div class="absolute inset-y-0 start-0 flex items-center pl-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input id="dueDate" type="date" name="dueDate" class="flex rounded-md bg-white/5 ring-1 ring-inset w-full pl-10 p-2.5 ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500" value="{{$groupquiz->dueDate}}" placeholder="Select date">
                  </div>
                </div>
            </div> 
            
            <div class="flex gap-2">
                 <div class="mt-6 flex items-center justify-end gap-x-6 w-full">
                    <a href="{{route('groups.manageQuiz', $groupquiz->group_id)}}" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:w-auto sm:text-sm">Cancel</a>
                    <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                 </div>
               </div>
            </div>

          </div>
        </div>
  </div>

</form>

<script>

    $(document).ready(function(){
        $("#dueDate").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
        });
    });

  //  timer message
    document.addEventListener('DOMContentLoaded', function() {

        // Select the alert message
        var alertMessage = document.getElementById('alert');

        // If the alert message exists, set a timeout to hide it
        if (alertMessage) {
          console.log('5 sec');
            setTimeout(function() {
                alertMessage.style.display = 'none';
            }, 5000); 
        }
       
    });

    // confirm delete
        function confirmDelete(quizId) {
        if (confirm("Are you sure you want to delete this question?")) {
            // Proceed with the delete action
            const form = document.getElementById('delete_form_' + quizId);
            form.submit(); // Submit the form for deletion
        } else {
            // Cancel the delete action
            console.log('Delete operation canceled.');
        }
    }

</script>

@endsection