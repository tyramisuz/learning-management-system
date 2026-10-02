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

<title>Edit User</title>

<form action="{{ route('admin.updateUser', $id) }}" method="POST"  enctype="multipart/form-data">
<div class="px-4 sm:px-6 md:px7 lg:px-8"> 
<div class="mx-auto max-w-7xl"> 
    @csrf
    @method('PUT')

    <div class="space-y-15"> 
        <div class="px-4 sm:px-0 sm:flex-0">
        <h2 class="text-3xl py-8 text-center font-bold leading-7 text-grey-900">Edit User</h2>
        </div>
       
<div class="px-4 py-6 mx-auto lg:py-6">
          <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">
            <div class="sm:col-span-2">
                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Name</label>
                <input type="text" name="name" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$user->name}}" placeholder="Ahmad" required>
            </div>

            <div class="w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Gender</label>
                <select id="" name="gender" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" required>
                <option selected class="text-gray-900" value="{{$user->gender}}">{{$user->gender}}</option>
                @if($user->gender == 'Male')
                <option class="text-gray-900" value="Female">Female</option>
                @else
                <option class="text-gray-900" value="Male">Male</option>
                @endif
                </select>
            </div>

            <div>
                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Birthday</label>
                <div class="relative max-w-sm">
                    <div class="absolute inset-y-0 start-0 flex items-center pl-3.5 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
                        </svg>
                    </div>
                    <input id="dueDate" type="date" name="dob" class="flex rounded-md bg-white/5 ring-1 ring-inset w-full pl-10 p-2.5 ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500" value="{{$user->dateOfBirth}}" placeholder="{{$user->dateOfBirth}}">
                </div>
            </div>

            <div>
                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">School</label>
                <input type="text" name="school" id="school" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="{{$user->school}}" placeholder="SMKTS" required>
            </div>

            <!-- image -->
            <div>
                <label for="image" class="block text-sm font-semibold leading-6 text-gray-900">Add Image</label>
                <div class="mt-2">
                    <div class="relative border-2 border-indigo-500 border-dashed rounded-lg p-8" id="dropzone">
                    <div class="mt-2 text-center">
                        <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                        <h3 class="mt-2 text-sm font-medium text-gray-900">
                        <label for="file-upload" class="relative cursor-pointer">
                            <span class="text-indigo-600">Browse</span>
                            <span>to upload</span>
                            <input id="file-upload" name="image" value="{{Storage::url($user->image)}}" type="file" class="sr-only" onchange="handleFileUpload(event)">
                        </label>
                        </h3>
                        <p class="mt-1 text-xs text-gray-500">
                            PNG, JPG, JPEG and GIF up to 2MB
                        </p>
                    </div>
                    @if($user->image == 'NULL')
                        <p class="mt-1 text-center text-sm text-red-500 font-semibold" id="image-text">
                            Image not applicable, click browse to add an image</p>
                        </p>
                        <img src="" name="image" class="mt-4 mx-auto w-64 h-64 rounded-full hidden" id="preview">
                    @else
                        <img src="{{ $user->image ? Storage::url($user->image) : '' }}" class="mt-4 mx-auto w-64 h-64 rounded-full {{ $user->image ? '' : 'hidden' }}" id="preview">
                    @endif
                    </div>
                </div>
            </div>

          </div>
</div>


<div class="flex gap-2">
    <div class="py-2 flex items-center justify-end gap-x-6 w-full">
    <a href="{{route('admin.indexUser')}}" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</a>
    <button type="Submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
    </div>
</div>



</form>

<!-- upload image -->
<script>
    var dropzone = document.getElementById('dropzone');
    var fileInput = document.getElementById('file-upload');
    var iconText = document.getElementById('image-text');



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
<!-- date -->
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