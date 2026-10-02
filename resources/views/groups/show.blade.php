@extends('layout')
  
@section('content')
  
<style>
    #alert {
        transition: opacity 0.5s ease-out;
    }
</style>
@if ($message = Session::get('error'))
    <div id="alert" class=" alert flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-green-400" role="alert">
        <div class="ms-3 text-sm font-medium">
        {{$message}}
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
  
  
  <x-app-layout>

    <title>Group Details</title>

    <div class="px-4 sm:px-6 md:px7 py-2 lg:px-8"> 
        <div class="flex justify-end"> 
            <div class="mr-2 items-center sm:flex sm:items-center">
                <div class="sm:ml-16 sm:mt-0 sm:flex-none">
                    @if(auth()->user()->id != $owner->id)
                    <a type="button" class="w-auto px-6 py-2 mb-4 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 rounded-lg block border-b border-purple-300 hover:bg-purple-300 text-purple-700 rounded-lg" style="background-color: {{$group->color}};"
                    href="{{route('groups.enroll')}}">
                    Back
                    </a>
                    @elseif(auth()->user()->id == $owner->id)
                    <a type="button" class="w-auto px-6 py-2 mb-4 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 rounded-lg block border-b border-purple-300 hover:bg-purple-300 text-purple-700 rounded-lg" style="background-color: {{$group->color}};"
                    href="{{route('groups.index')}}">
                    Back
                    </a>
                    @endif
                </div>
            </div>
        </div>

        <div class="mx-auto max-w-7xl"> 
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 mt-2 gap-2">
                <div class="col-span-2">
                    <div class="space-y-15"> 
                        <div class="px-4 sm:px-0 sm:flex-0">
                            <div class="h-40 text-gray-900 bg-opacity-50 p-4 rounded-lg" style="background-color: {{$group->color}};">
                                <h2 class="text-3xl uppercase font-bold">
                                    {{$group->name}}
                                </h2>
                                <h5 class="text-m text-gray-800 mt-2">{{$owner->name}}</h5>
                                <p class="mt-4 text-l underline">{{$group->description}}</p>
                            </div>
                        </div>
                    </div>
                    <div class="container px-4 mx-auto">
                        <h2 class="text-xl mt-2 font-semibold py-2">Assignment</h2>
                        
                        <div class="flex flex-col gap-4">
                            @forelse($quizzes as $quiz)
                                <div class="bg-gray-100 shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition duration-300">
                                    <a href="{{ route('groups.quiz', ['group' => $id, 'quiz' => $quiz->id]) }}" class="block">
                                        <div class="p-4 flex items-center justify-between">
                                            <div class="flex items-center gap-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-purple-800">
                                                    <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd" />
                                                    <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                                                </svg>
                                                <div>
                                                    <p class="text-sm font-semibold uppercase">{{ $quiz->title }}</p>
                                                    <p class="text-sm text-gray-600">{{ $quiz->created_at->format('M d, Y') }}</p>
                                                </div>
                                            </div>
                                            <div class="flex gap-2">
                                                @if(auth()->user()->id != $owner->id)
                                                    @if ($quiz->action == 'take')
                                                        <a href="{{ route('questions.show.group', ['quizId' => $quiz->id, 'groupId' => $id]) }}"c class="font-semibold uppercase px-2 py-2 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 rounded-md border-b border-gray-500 text-green-900 font-extrabold bg-green-300 hover:bg-green-500">
                                                            Take
                                                        </a>
                                                    @else
                                                        <a href="{{ route('questions.show.group', ['quizId' => $quiz->id, 'groupId' => $id]) }}" class="font-semibold uppercase px-2 py-2 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 rounded-md border-b border-gray-500 text-purple-900 font-extrabold bg-purple-300 hover:bg-purple-500">
                                                            Retake
                                                        </a>
                                                        <a href="{{ route('report.view',['userId'=>auth()->user()->id, 'quizId'=>$quiz->id, 'attempt'=>1]) }}" class="font-semibold uppercase px-2 py-2 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 rounded-md border-b border-gray-500 text-yellow-900 font-extrabold bg-yellow-300 hover:bg-yellow-500">
                                                            Report
                                                        </a>
                                                    @endif
                                                @endif
                                            </div>
                                        </div>
                                    </a>
                                </div>


                            @empty
                            <div class="col-span-1 md:col-span-2 lg:col-span-3">
                                <p class="text-gray-600 text-center">No assignment posted</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div>
                <div class="space-y-15">
                    <div class="px-4 sm:px-0 sm:flex-0">
                        <div class="text-gray-900 min-h-screen bg-opacity-50 p-4 rounded-lg bg-gray-400">
                            <div class="flex gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                    <path d="M13.5 4.06c0-1.336-1.616-2.005-2.56-1.06l-4.5 4.5H4.508c-1.141 0-2.318.664-2.66 1.905A9.76 9.76 0 0 0 1.5 12c0 .898.121 1.768.35 2.595.341 1.24 1.518 1.905 2.659 1.905h1.93l4.5 4.5c.945.945 2.561.276 2.561-1.06V4.06ZM18.584 5.106a.75.75 0 0 1 1.06 0c3.808 3.807 3.808 9.98 0 13.788a.75.75 0 0 1-1.06-1.06 8.25 8.25 0 0 0 0-11.668.75.75 0 0 1 0-1.06Z" />
                                    <path d="M15.932 7.757a.75.75 0 0 1 1.061 0 6 6 0 0 1 0 8.486.75.75 0 0 1-1.06-1.061 4.5 4.5 0 0 0 0-6.364.75.75 0 0 1 0-1.06Z" />
                                </svg>
                                <h2 class="font-extrabold text-xl break-words underline">Announcement</h2>
                            </div>

                            <div id="announcement-list">
                                @foreach($groupedAnnouncements as $date => $announcements)
                                        <h2 class="mt-4 text-xl font-semibold">{{$date}}</h2>
                                    @forelse($announcements as $announcement)
                                        <div class="mt-4 w-full py-2">
                                            <div class="flex">
                                                @if($announcement->created_by == $owner->id || $announcement->title == $owner->name)
                                                    @if($owner->image)
                                                        <img class="h-8 w-8 mr-2 rounded-full" src="{{ Storage::url($owner->image) }}" alt="Sender Image">
                                                    @else
                                                        <img class="h-8 w-8 mr-2 rounded-full" src="/images/default.jpeg" alt="profile">
                                                    @endif
                                                @else
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-2 h-10 w-10">
                                                    <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                                    </svg>

                                                @endif

                                                <div class="flex flex-col w-full">
                                                    @if($announcement->created_by != null)
                                                    <p class="text-sm"><span class="font-semibold"><span class="font-bold">{{$owner->name}}</span></span></p>
                                                    @else
                                                    <p class="text-sm"><span class="font-semibold"><span class="font-bold">{{$announcement->title}}</span></span></p>
                                                    @endif
                                                    <p class="text-sm text-gray-600">{{$announcement->message}}</p>
                                                </div>
                                                <div class="self-end ml-auto">
                                                    <p class="text-xs text-gray-600">{{$announcement->created_at->format('g:i')}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @empty
                                            <p class="text-center mt-4">No announcements</p>
                                    @endforelse
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


                </div>

            </div>
           
        <div>     

    </div>

</x-app-layout>


<!-- timer message -->
<script>
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

<!-- ajax -->
<script>

    function fetchAnnouncements() {
        fetch('{{ route("announcements.fetch", $id) }}')
        .then(response => response.json())
        .then(data => {
            const owner = data.owner;
            const ownerImage = data.ownerImage;
            console.log(ownerImage);
            const groupedAnnouncements = data.groupedAnnouncements;
            var announcementList = document.getElementById('announcement-list');
            announcementList.innerHTML = '';

            if (Object.keys(groupedAnnouncements).length > 0) {
                Object.keys(groupedAnnouncements).forEach(date => {
                    // Add date heading
                    announcementList.innerHTML += '<h2 class="text-xl font-semibold mt-4">' + date + '</h2>';

                    // Iterate over announcements for this date
                    groupedAnnouncements[date].forEach(announcement => {
                        var image = '';
                        var creator = '';

                        if (announcement.created_by == owner.id || announcement.title == owner.name) {
                            if (ownerImage) {
                                console.log('ade');
                                image = '<img class="h-8 w-8 mr-2 rounded-full" src="' + ownerImage + '" alt="Sender Image">';
                            } else {
                                image = '<img class="h-8 w-8 mr-2 rounded-full" src="/images/default.jpeg" alt="profile">';
                                console.log('takde');
                            }
                        } else {
                            console.log('icon');
                            image =
                                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="mr-2 h-10 w-10">' +
                                '<path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />' +
                                '</svg>';
                        }

                        var created_by = '';
                        if (announcement.created_by != null) {
                            created_by = '<p class="text-sm"><span class="font-semibold"><span class="font-bold">' + owner.name + '</span></span></p>';
                        } else {
                            created_by = '<p class="text-sm"><span class="font-semibold"><span class="font-bold">' + announcement.title + '</span></span></p>';
                        }

                        // Append announcement HTML
                        announcementList.innerHTML +=
                            '<div class="mt-4 w-full py-2">' +
                            '<div class="flex">' +
                            image +
                            '<div class="flex flex-col w-full">' +
                            created_by +
                            '<p class="text-sm text-gray-600">' + announcement.message + '</p>' +
                            '</div>' +
                            '<div class="self-end ml-auto">' +
                            '<p class="text-xs text-gray-600">' + announcement.time + '</p>' +
                            '</div>' +
                            '</div>' +
                            '</div>';
                    });
                });
            } else {
                announcementList.innerHTML += '<p class="text-center mt-4">No announcements</p>';
            }
        })
        .catch(error => console.error('Error fetching announcements:', error));
    }


        function groupAnnouncementsByDate(announcements) {
            const grouped = {};
            announcements.forEach(announcement => {
                const date = new Date(announcement.created_at).toLocaleDateString('en-US');
                if (!grouped[date]) {
                    grouped[date] = [];
                }
                grouped[date].push(announcement);
            });
            return grouped;
        }

        setInterval(fetchAnnouncements, 6000);
        fetchAnnouncements();

</script>

@endsection