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

<title>Create Group</title>

<form action="{{ route('groups.store') }}" method="POST" enctype="multipart/form-data">
  <div class="px-4 bg-gray-100 sm:px-6 md:px7 py-10 lg:px-8"> 
    <div class="mx-auto max-w-7xl"> 
      
      <div class="space-y-15"> 
        <div class="px-4 sm:px-0 sm:flex-0">
          <h2 class="text-2xl text-center font-bold mb-8 leading-7 text-grey-900">Add Group</h2>
        </div>
        
        @csrf
        
        <div class="bg-white shadow-lg rounded-lg p-4">
          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-5">
            <div class="sm:col-span-4">
              <label for="" class="block text-sm font-semibold leading-6 text-gray-900">Name</label>
              <div class="mt-2">
                <div class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                  <input type="text" name="name" id="" autocomplete="" class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 focus:ring-0 sm:text-sm sm:leading-8" placeholder="Mars" required>
                </div>
              </div>
            </div>
          </div>
          
          <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-5">
            <div class="sm:col-span-4">
              <label for="" class="block text-sm font-semibold leading-6 text-gray-900">Description</label>
              <div class="mt-2">
                <div class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                  <textarea type="text" name="description" class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 focus:ring-0 sm:text-sm sm:leading-8" placeholder="Upcoming Exams Practices" required></textarea>
                </div>
              </div>
            </div>
          </div>
          <div class="flex gap-2">
              <div class="mt-6 flex items-center justify-end gap-x-6 w-full">
                  <a href="{{route('groups.index')}}" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</a>
                  <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
              </div>
          </div>

        </div>


        </div>
    </div>


  </div>
</form>

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