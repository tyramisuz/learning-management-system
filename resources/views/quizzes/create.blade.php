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

<title>Create Quiz</title>

<form action="{{ route('quizzes.store', ['quiz' => $quiz->id]) }}" method="POST" id="quizForm" enctype="multipart/form-data">
  <div class="px-4 sm:px-6 md:px7 py-10 lg:px-8"> 
    <div class="mx-auto max-w-7xl"> 

      <div class="space-y-15"> 
              <div class="px-4 sm:px-0 sm:flex-0">
              <h2 class="text-3xl text-center font-bold leading-7 text-grey-900">Add Quiz</h2>
              </div>
                        
                @csrf
                <div class="px-4 py-6 mx-auto lg:py-6">
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
                    <div class="sm:col-span-2">
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                        <input type="text" name="title" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Past Year 2013" required>
                    </div>

                      <div>
                          <label class="block mb-2 text-sm font-medium text-gray-900">Genre</label>
                          <select id="" name="genre" class="block bg-gray-50 border max-w-xs md:max-w-full border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" required>
                          <option selected class="text-gray-900" value="">Choose Genre</option>
                          @foreach($genres as $genre)
                          <option class="text-gray-900" value="{{$genre->name}}">{{$genre->name}}</option>
                          @endforeach
                          </select>
                      </div>
                      
                      @php
                          $hours = floor($quiz->duration / 60);
                          $minutes = $quiz->duration % 60;
                      @endphp

                    <div class="w-full">
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Duration</label>
                          <div class="mt-2 flex gap-3">
                              <div class="max-w-sm">
                                  <select id="hoursButton" name="duration_hours" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                      <option selected value="">Hours</option> 
                                      @foreach($lhours as $lhour)
                                      <option value="{{ $lhour }}">{{ $lhour }}</option>
                                      @endforeach
                                  </select>
                              </div>
                              <div class="max-w-sm">
                                  <select id="minutesButton" name="duration_minutes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                      <option selected value="">Minutes</option> 
                                      @foreach($lminutes as $lminute)
                                      <option value="{{ $lminute }}">{{ $lminute }}</option>
                                      @endforeach
                                  </select>
                              </div>
                          </div>
                    </div>

                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Visibility</label>
                        <select id="visibility" name="visibility" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" required>
                          <option class="text-gray-900" value="public">Public</option>
                          <option class="text-gray-900" value="private">Private</option>
                        </select>
                    </div>

                    <div>
                        <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer Review</label>
                        <select id="" name="permission" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" required>
                          <option selected class="text-gray-900" value="Yes">Yes</option>
                          <option class="text-gray-900" value="No">No</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Set Passing Grade</label>
                        <select id="" name="passgrade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" required>
                          <option selected class="text-gray-900" value="">Choose</option>
                          @foreach($passing as $pass)
                          <option class="text-gray-900" value="{{$pass}}">{{$pass}}</option>
                          @endforeach
                        </select>
                    </div>
                  
                  <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                  
                    <div>
                      <label for="icon" class="block text-sm font-semibold leading-6 text-gray-900">Add Image</label>
                        <div class="mt-2">
                          <div class="relative border-2 border-indigo-500 border-dashed rounded-lg p-8" id="dropzone">
                            <div class="mt-2 text-center">
                                <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                              <h3 class="mt-2 text-sm font-medium text-gray-900">
                                <label for="file-upload" class="relative cursor-pointer">
                                  <span class="text-indigo-600">Browse</span>
                                  <span>to upload</span>
                                  <input id="file-upload" name="icon" type="file" class="sr-only" onchange="handleFileUpload(event)">
                                </label>
                              </h3>
                              <p class="mt-1 text-xs text-gray-500">
                                  PNG, JPG, JPEG and GIF up to 2MB
                              </p>
                            </div>
                            <img src="" name="icon" class="mt-4 mx-auto w-64 h-64 rounded-lg hidden" id="preview">
                          </div>
                        </div>
                    </div>
        

                </div>
                </div>
      </div>


      <div class="flex gap-2">
          <input type="hidden" name="status" id="status" value="draft">
          <div class="mt-6 flex items-center justify-end gap-x-6 w-full">
              <a href="{{route('quizzes.index')}}" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</a>
              <button onclick="document.getElementById('status').value='draft'" type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
          </div>
      </div>

    </div>
  </div>

</form>

<script>
    var dropzone = document.getElementById('dropzone');
    var fileInput = document.getElementById('file-upload');


    dropzone.addEventListener('dragover', e => {
        e.preventDefault(); // Prevent default behavior
        dropzone.classList.add('border-indigo-600');
    });

    dropzone.addEventListener('dragleave', e => {
        e.preventDefault(); // Prevent default behavior
        dropzone.classList.remove('border-indigo-600');
    });

    dropzone.addEventListener('drop', e => {
        e.preventDefault(); // Prevent default behavior
        dropzone.classList.remove('border-indigo-600');
        var file = e.dataTransfer.files[0];
        fileInput.files = e.dataTransfer.files;
        previewImage(file);
    });

    function handleFileUpload(event) {
        var file = event.target.files[0];
        previewImage(file);
    }

    function previewImage(file) {
        var reader = new FileReader();
        reader.readAsDataURL(file);
        reader.onload = () => {
            var preview = document.getElementById('preview');
            preview.src = reader.result;
            preview.classList.remove('hidden');
        };
    }
</script>

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

<script>

  function toggleClockDropdown() {
    var dropdown = document.getElementById("clockDropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
  }



  function toggleClockDropdown2() {
    var dropdown2 = document.getElementById("clockDropdown2");
    dropdown2.style.display = dropdown2.style.display === "block" ? "none" : "block";
  }


 // document.addEventListener('DOMContentLoaded', function () {
    $(document).ready(function(){
        $("#dueDate").flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
        });
    });

    //delete
    function confirmDelete(questionId) {
    if (confirm("Are you sure you want to delete this question?")) {
        // Proceed with the delete action
        const form = document.getElementById('delete_form_' + questionId);
        form.submit(); // Submit the form for deletion
    } else {
        // Cancel the delete action
        console.log('Delete operation canceled.');
    }
    }


    function toggleClockDropdown() {
    var dropdown = document.getElementById("clockDropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    function toggleClockDropdown2() {
    var dropdown2 = document.getElementById("clockDropdown2");
    dropdown2.style.display = dropdown2.style.display === "block" ? "none" : "block";
    }

    //calendar
    $(document).ready(function() {
    $("#dueDate").flatpickr({
        enableTime: false,
        dateFormat: "Y-m-d",
        // Additional options as needed
    });
    });

    $(document).ready(function() {
    var dropdownButton = document.getElementById("dropdownDefaultButton");
    var dropdown = document.getElementById("dropdown");

    if (dropdownButton) {
        dropdownButton.addEventListener("click", function(event) {
            event.preventDefault(); // Prevent default link behavior
            dropdown.classList.toggle("hidden"); // Toggle the 'hidden' class to show/hide the dropdown
        });
    }

  });
    
    //close button
    document.addEventListener("DOMContentLoaded", function() {
    const closeButton = document.querySelector("[data-dismiss-target='#alert']");

    if (closeButton) {
        closeButton.addEventListener("click", function() {
            const alert = document.querySelector("#alert");
            if (alert) {
                alert.classList.add("hidden");
            }
        });
    }
    });    
   
</script>
@endsection