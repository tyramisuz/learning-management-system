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
            width: 120px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 6px;
            padding: 5px 0;
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
<div class="px-4 sm:px-6 md:px7 py-10 lg:px-8">
    <div class="mx-auto max-w-7xl"> 
        <div class="space-y-15"> 
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                <h1 class="text-base font-bold leading-6 text-xl text-slate-950">Group</h1>
                <p class="mt-2 text-sm text-gray-700">Learning Odyssey</p>
                </div>
                <div class="relative group">
                <a href="{{ route('groups.create') }}" class="tooltip">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 text-indigo-500">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span class="tooltip-text">Create Group</span>
                </a>
                </div>
            </div>
            <div class="container mx-auto p-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
                    @forelse($groups as $group)
                        @if (auth()->user()->id == $userId && $creator == true)
                                <div class="p-6 rounded-lg shadow-md relative" style="background-color: {{$group->color}};">
                                    <div class="absolute top-4 right-4">
                                        <button class="dropdownDefaultButton" data-group-id="{{ $group->id }}" type="button">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                                            </svg>
                                        </button>
                                    </div>
                                    
                                    <!-- Dropdown menu -->
                                    <div class="dropdown z-50 absolute right-0 top-0 mt-10 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 hidden">
                                        <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                                            <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-300" data-action="managegroup" onclick="handleMenuClick('managegroup', {{ $group->id }})">Manage Group</a>
                                            </li>
                                            <li>
                                            <a href="#" data-group2_id="{{$group->id}}" class="block px-4 py-2 hover:bg-gray-300" data-action="announcement">Send Announcement</a>
                                            </li>
                                            <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-300" data-action="invitationstatus" onclick="handleMenuClick('invitationstatus', {{ $group->id }})">Invitation Status</a>
                                            </li>
                                            <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-300" data-action="assign" onclick="handleMenuClick('assign', {{ $group->id }})">Assign Quiz</a>
                                            </li>
                                            <li>
                                            <a href="#" class="block px-4 py-2 hover:bg-gray-300" data-action="manageQuiz" onclick="handleMenuClick('manageQuiz', {{ $group->id }})">Manage Quiz</a>
                                            </li>
                                            <li>
                                                <a href="#" data-group_id="{{$group->id}}" class="confirmRemove block px-4 py-2 hover:bg-gray-300">Remove</a>
                                            </li>
                                        </ul>
                                    </div>
                                    
                                    <div class="flex items-center mb-3">
                                        <a href="{{route('groups.show', $group->id)}}" class="hover:underline text-gray-800 font-bold text-lg">{{$group->name}}</a>
                                    </div>
                                    
                                    <div class="justify-between">
                                        <p class="leading-relaxed text-base text-gray-800">
                                            Description: <span class="underline">{{$group->description}}</span>
                                        </p>
                                    </div>
                                    
                                    <div class="mt-4 text-sm text-gray-500 mb-2">Created on: {{ $group->created_at->format('M d, Y') }}</div>
                                    
                                    <!-- QR Modal for each group -->
                                    <div id="qrModal-{{ $group->id }}" class="fixed z-50 top-0 left-0 w-full h-full bg-black bg-opacity-50 flex justify-center items-center hidden">
                                        <div class="bg-white rounded-lg p-8 max-w-md">
                                            <!-- Close button -->
                                            <button class="absolute top-4 right-4 text-gray-700 hover:text-gray-900" onclick="closeQRModal({{ $group->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            </button>
                                            
                                            <!-- QR Code -->
                                            <div id="qrcode-{{ $group->id }}" class="mt-4"></div>
                                            
                                            <!-- Download QR Code -->
                                            <div class="mt-4">
                                                <button class="bg-indigo-500 w-full text-white px-4 py-2 rounded-md hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-indigo-500" onclick="downloadQRCode({{ $group->id }})">Download QR Code</button>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </div>
                        @endif
                        @empty
                            <div class="col-span-1 md:col-span-2 text-center lg:col-span-3">
                                <p class="text-gray-600 text-center">No group has been created. Create a new one.</p>
                            </div>
                    @endforelse
                    @if($id)
                        <!-- Announcement Modal -->
                        <div id="announcement-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-50" aria-hidden="true"></div>
                                <!-- Modal content -->
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <!-- Modal header -->
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-xl font-semibold text-gray-900">
                                            Send Announcement to this group<span class="font-extrabold italic"></span>
                                        </h3>
                                        <button type="button" class="close end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="announcement-modal-{{ $group->id }}">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <!-- Modal body -->
                                    <div class="p-4 md:p-5">
                                        <form id="announceForm" class="space-y-4" action="{{ route('groups.sendAnnouncement', $group->id) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div>
                                                <label for="message" class="block mb-4 text-sm font-medium text-gray-900">Message</label>
                                                <input type="text" name="message" id="message" class="py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="Hello everyone" required />
                                            </div>
                                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send Announcement</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            @if($id)
                <!-- delete group modal -->
                <form action="{{ route('groups.destroy', $id)}}" id="removeForm" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')
                    <div id="removeModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
                        <div class="relative p-4 w-full max-w-md max-h-full">
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Close button aligned to the right -->
                                    <button type="button" class="close absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                    <svg class="w-3 h-3 close" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>            
                                    <span class="sr-only">Close modal</span>
                                    </button>
                                    <div class="p-4 md:p-5 text-center">
                                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                            </svg>
                                        <p class="text-m font-normal text-gray-500 mb-2 dark:text-gray-400">You cannot undo your action</p>
                                        <p class="text-m font-normal text-gray-500 mb-4 dark:text-gray-400">Sure want to delete?</p>
                                        <button id="remove" type="submit" form="removeForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                        Remove
                                        </button>
                                        <button id="no" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700">
                                        No, cancel
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                
            @endif
        </div>
    </div>
</div>

</x-app-layout>

<!-- dropdown menu -->
<script>
    $(document).ready(function() {
    $(document).on('click', function(event) {
        if (!$(event.target).closest('.dropdown').length && !$(event.target).closest('.dropdownDefaultButton').length) {
            $('.dropdown').addClass('hidden');
        }
    });

    $('.dropdownDefaultButton').on('click', function(event) {
        event.preventDefault();
        var button = $(this);
        var groupId = button.data('group-id');
        var dropdown = button.closest('.relative').find('.dropdown');

        dropdown.toggleClass('hidden');

        // Update the href attributes for each menu item with the group ID
        dropdown.find('a').each(function() {
            var action = $(this).data('action');
            if (action === 'assign') {
                $(this).attr('href', `{{ route('groups.assign', '') }}/${groupId}`);
            } else if (action === 'managegroup') {
                $(this).attr('href', `{{ route('groups.manage', '') }}/${groupId}`);
            } else if (action === 'manageQuiz') {
                $(this).attr('href', `{{ route('groups.manageQuiz', '') }}/${groupId}`);
            }  else if (action === 'invitationstatus') {
                $(this).attr('href', `{{ route('groups.invitationStatus', '') }}/${groupId}`);
            } 
        });

            event.stopPropagation();
        });

        $('.dropdown').on('click', function(event) {
            event.stopPropagation();
        });

        var modal = $('#removeModal');
        let groupId = null;

        $('.confirmRemove').on('click', function(){
            groupId = $(this).data('group_id');
            modal.removeClass('hidden');
        });

        $('#remove').on('click', function(){
            if(groupId)
            {
                let url = '{{route("groups.destroy", ":id")}}'.replace(":id", groupId);
                $('#removeForm').attr('action', url);
                $('#removeForm').submit();
                console.log('Group ID:', groupId);
            } else {
                console.error('Group ID not set');
            }
        });

        $('#no').on('click', function(){
            modal.addClass('hidden');
        });

        $('.close').on('click', function(){
            modal.addClass('hidden');
        });
    });

    let groupId = null;

    $('[data-action="announcement"]').click(function(e) {
        e.preventDefault();
        $('#announcement-modal').removeClass('hidden');
        $('#announcement-modal').addClass('flex');
        $('#announcement-modal').attr('aria-hidden', 'false');
        groupId = $(this).data('group2_id');
        console.log(groupId);
        let url = '{{route("groups.sendAnnouncement", ":id")}}'.replace(":id", groupId);
        $('#announceForm').attr('action',url);
    });

    $('.close').on('click', function(e){
        e.preventDefault();
        $('#announcement-modal').addClass('hidden');
        $('#announcement-modal').removeClass('flex');
        $('#announcement-modal').attr('aria-hidden', 'true');
    });

    function openQRModal(groupId) {
        const shareLink = `https:/share/group/${groupId}`;

        // API endpoint for QR code generation (replace with actual API endpoint)
        const apiUrl = `https://api.qrserver.com/v1/create-qr-code/?data=${encodeURIComponent(shareLink)}&size=200x200`;

        // Fetch API to get the QR code image
        fetch(apiUrl)
            .then(response => response.blob())
            .then(blob => {
                const qrDiv = document.getElementById('qrcode-' + groupId);
                qrDiv.innerHTML = ''; // Clear previous QR code if any

                const qrImg = document.createElement('img');
                qrImg.src = URL.createObjectURL(blob);
                qrImg.alt = 'QR Code';

                qrDiv.appendChild(qrImg);

                // Show the modal
                const modal = document.getElementById('qrModal-' + groupId);
                modal.classList.remove('hidden');
            })
            .catch(error => {
                console.error('Error fetching QR code:', error);
                alert('Failed to generate QR code. Please try again later.');
            });
    }

    function closeQRModal(groupId) {
        const modal = document.getElementById('qrModal-' + groupId);
        modal.classList.add('hidden');
    }

    function downloadQRCode(groupId) {
        const qrDiv = document.getElementById('qrcode-' + groupId);
        const qrImg = qrDiv.querySelector('img');

        if (qrImg) {
            const link = document.createElement('a');
            link.href = qrImg.src;
            link.download = 'qrcode.png'; // Set the default download filename
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        } else {
            alert('No QR code available to download.');
        }
    }


    function handleMenuClick(action, groupId) {
        console.log(`Action: ${action}, Group ID: ${groupId}`);
        // Handle the action here, e.g., redirect or open a modal
    }

</script>

@endsection