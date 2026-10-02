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

<title>Edit Quiz</title>

<form action="{{ route('quizzes.update', $quiz->id) }}" method="POST"  enctype="multipart/form-data">
<div class="px-4 sm:px-6 md:px7 lg:px-8"> 
<div class="mx-auto max-w-7xl"> 
    @csrf
    @method('PUT')

    <div class="space-y-15"> 
        <div class="px-4 sm:px-0 sm:flex-0">
        <h2 class="text-3xl text-center font-bold leading-7 text-grey-900">Edit Quiz</h2>
        </div>
       
<div class="px-4 py-6 mx-auto lg:py-6">
          <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
              <div class="sm:col-span-2">
                  <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Title</label>
                  <input type="text" name="title" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$quiz->title}}" placeholder="Past Year 2013" required>
              </div>

                <div class="w-full">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Genre</label>
                    <select id="" name="genre" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" required>
                    <option selected class="text-gray-900" value="{{$quiz->genre}}">{{$quiz->genre->name}}</option>
                    <option class="text-gray-900" value="Mathematics">Mathematics</option>
                    <option class="text-gray-900" value="Science">Science</option>
                    <option class="text-gray-900" value="History">History</option>
                    <option class="text-gray-900" value="English">English</option>
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
                                <option selected value="{{ ($hours > 0 ? $hours . ' Hours ' : '') }}">{{ ($hours > 0 ? $hours . ' Hours ' : 'Hours') }}</option> 
                                @foreach($lhours as $lhour)
                                <option value="{{ $lhour }}">{{ $lhour }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="max-w-sm">
                            <select id="minutesButton" name="duration_minutes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                <option selected value="{{ ($minutes > 0 ? $minutes . ' Minutes ' : '0') }}">{{ ($minutes > 0 ? $minutes . ' Minutes ' : 'Minute') }}</option> 
                                @foreach($lminutes as $lminute)
                                <option value="{{ $lminute }}">{{ $lminute }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
              </div>

              <div>
                  <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Visibility</label>
                  <select id="visibility" name="visibility" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{ $quiz->visibility}}" required>
                    <option class="text-gray-900" value="public" {{ $quiz->visibility == 'Public' ? 'selected' : '' }}>Public</option>
                    <option class="text-gray-900" value="private" {{ $quiz->visibility == 'Private' ? 'selected' : '' }}>Private</option>
                  </select>
              </div>

              <div>
                  <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer Review</label>
                  <select id="" name="permission" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" required>
                    <option selected class="text-gray-900" value="{{$quiz->permission}}">{{$quiz->permission}}</option>
                    <option class="text-gray-900" value="No">No</option>
                  </select>
              </div> 

              <div>
                  <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Set Passing Grade</label>
                  <select id="" name="passgrade" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" required>
                    <option selected class="text-gray-900" value="{{$quiz->passgrade}}">{{$quiz->passgrade}}</option>
                    @foreach($passing as $pass)
                    <option class="text-gray-900" value="{{$pass}}">{{$pass}}</option>
                    @endforeach
                  </select>
              </div>

             <!-- image -->
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
                                  <input id="file-upload" name="icon" value="{{Storage::url($quiz->icon)}}" type="file" class="sr-only" onchange="handleFileUpload(event)">
                                </label>
                              </h3>
                              <p class="mt-1 text-xs text-gray-500">
                                  PNG, JPG, JPEG and GIF up to 2MB
                              </p>
                            </div>
                            @if($quiz->icon == 'NULL')
                                <p class="mt-1 text-center text-sm text-red-500 font-semibold" id="icon-text">
                                    Icon not applicable, click browse to add an icon</p>
                                </p>
                                <img src="" name="icon" class="mt-4 mx-auto w-64 h-64 rounded-lg hidden" id="preview">
                            @else
                                <img src="{{ $quiz->icon ? Storage::url($quiz->icon) : '' }}" class="mt-4 mx-auto w-64 h-64 rounded-lg {{ $quiz->icon ? '' : 'hidden' }}" id="preview">
                            @endif
                          </div>
                        </div>
                    </div>
          </div>
</div>

<div class="flex gap-2">
    <input type="hidden" name="status" id="status" value="">
    <div class="py-2 flex items-center justify-end gap-x-6 w-full">
    <a onclick= "history.back();" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</a>
    <button id="statusConfirm" type="button" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
    </div>
</div>

<div id="confirmationModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
          <!-- Close button aligned to the right -->
          <button type="button" class="absolute top-3 mr-2 text-gray-400 inset-0 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                <svg class="w-3 h-3 close" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to publish this quiz? Quiz cannot be edited once published</h3>
                <input type="hidden" id="publish_date" name="publish_date" value="">
                <button id="yesButton" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                    Yes, I'm sure
                </button>
                <button id="noButton" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No, cancel</button>
            </div>
        </div>
    </div>
</div>

</form>

<!-- upload image -->
<script>
    var dropzone = document.getElementById('dropzone');
    var fileInput = document.getElementById('file-upload');
    var iconText = document.getElementById('icon-text');



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
            if(iconText){
                iconText.classList.add('hidden');
            }
    });

    function handleFileUpload(event) {
        var file = event.target.files[0];
        previewImage(file);
        if(iconText){
                iconText.classList.add('hidden');
            }
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
<script>
    //status confirm
    // Get the modal
    var modal = document.getElementById("confirmationModal");

    // Get the button that opens the modal
    var btn = document.getElementById("statusConfirm");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // Get the "Yes" and "No" buttons
    var yesButton = document.getElementById("yesButton");
    var noButton = document.getElementById("noButton");

    

    // When the user clicks the button, open the modal
    btn.onclick = function() {
        modal.classList.remove("hidden");
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
        modal.classList.add("hidden");
    }

    // When the user clicks "No", close the modal
    noButton.onclick = function() {
        modal.classList.add("hidden");
        document.getElementById('status').value = 'draft';
    }

    // When the user clicks "Yes", perform the action and close the modal
    yesButton.onclick = function() {
        let currentDate = new Date(); 
        var formattedDate = currentDate.toISOString().split('T')[0]; 
        $('#publish_date').val(formattedDate); 
        $('#status').val('publish');
        modal.classList.add("hidden");
        
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.classList.add("hidden");
        }
    }
</script>

@endsection