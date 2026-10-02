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
            width: 100px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 4px;
            padding: 2px 0;
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

<title>Users</title>
<x-app-layout>
<div class="px-4 bg-gray-100 sm:px-6 md:px7 py-2 lg:px-8"> 

    <div class="border-b mt-6 border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
        <div class="text-left">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Users Listing</h3>
            <p class="mt-2 text-sm text-gray-700">Learning Odyssey</p>
        </div>

        <div class="mt-3 sm:ml-4 sm:mt-0">
            <div class="flex rounded-md shadow-sm">
                <div class="relative flex-grow focus-within:z-10">
                    <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                        <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                    </svg>
                    </div>
                    <input type="text" name="search" id="searchUser" class="hidden w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-sm leading-6 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:block" placeholder="Search Users">
                    <button id="clearSearch" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer outline-none" style="display: none;">
                        <svg class="w-4 h-4 text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 12.586l-4.293 4.293-1.414-1.414L8.586 11 4.293 6.707l1.414-1.414L10 9.172l4.293-4.293 1.414 1.414L11.414 11l4.293 4.293-1.414 1.414L10 12.586z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full mb-6 divide-y divide-gray-300">
                <thead>
                    <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Action</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"></th>
                    <!-- <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"></th> -->
                    <!-- <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th> -->
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white" id="user-list">
                    @if($users->isNotEmpty())
                        @foreach($users as $user)
                            <tr>
                            <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                                <div class="flex items-center">
                                <div class="h-11 w-11 flex-shrink-0">
                                    @if($user->image)
                                    <img class="ml-2 rounded-full" src="{{ Storage::url($user->image) }}" alt="Sender Image">
                                    @else
                                    <img class="ml-2 rounded-full" src="/images/default.jpeg" alt="profile">
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium text-gray-900">{{$user->name}}</div>
                                    <div class="mt-1 text-gray-500">{{$user->email}}</div>
                                </div>
                                </div>
                            </td>
                                
                            <td class="whitespace-nowrap py-5 pl-4 font-bold pr-3 text-sm sm:pl-0">
                                @if($user->status == 'active')
                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{$user->status}}</span>
                                @else 
                                <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-sm font-medium text-red-700 ring-1 ring-inset ring-red-600/20">{{$user->status}}</span>
                                @endif
                            </td>

                            <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                                <a href="{{ route('admin.indexQuiz', $user->id)}}" class="tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-purple-600">
                                <path d="M5.566 4.657A4.505 4.505 0 0 1 6.75 4.5h10.5c.41 0 .806.055 1.183.157A3 3 0 0 0 15.75 3h-7.5a3 3 0 0 0-2.684 1.657ZM2.25 12a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3v-6ZM5.25 7.5c-.41 0-.806.055-1.184.157A3 3 0 0 1 6.75 6h10.5a3 3 0 0 1 2.683 1.657A4.505 4.505 0 0 0 18.75 7.5H5.25Z" />
                                </svg>
                                    <span class="tooltip-text">Quizzes</span>
                                </a>
                                <a href="{{route('admin.indexGroup', $user->id)}}" class="statusConfirm publish-btn tooltip" >
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-green-600">
                                <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                </svg>
                                    <span class="tooltip-text">Groups</span>
                                </a>
                                <a href="{{route('admin.editUser', $user->id)}}" class="tooltip">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-blue-600">
                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                </svg>
                                  <span class="tooltip-text">Edit User</span>
                                </a>
                            </td>
                        <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                            @if($user->status == 'blocked')
                              <a data-user2_id="{{$user->id}}" class="unblock ms-3 inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 transition ease-in-out duration-150">Unblock</a>
                            @else
                              <a data-user_id="{{$user->id}}" class="block ms-3 inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 transition ease-in-out duration-150">Block</a>
                            @endif
                        </td>
                        </tr>
                        @endforeach
                    @else
                        <tr class="text-sm leading-6 text-gray-900">
                            <td colspan="3" class="py-5 text-center">No Users.</td>
                        </tr>
                    @endif

                    <!-- block user modal -->
                    <form action="{{ route('admin.blockUser', $user->id)}}" id="blockUserForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div id="blockUserModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
                            <div class="modal-content relative p-4 w-full max-w-md max-h-full">
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
                                            <p class="text-m font-normal text-gray-500 mb-2 dark:text-gray-400">User cannot log into the system.</p>
                                            <p class="text-m font-normal text-gray-500 mb-4 dark:text-gray-400">Sure want to block?</p>
                                            <button id="block" type="button" form="blockUserForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Block
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

                    <!-- unblock user modal -->
                    <form action="{{ route('admin.unblockUser', $user->id)}}" id="unblockUserForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div id="unblockUserModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
                            <div class="modal-content2 relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <!-- Close button aligned to the right -->
                                        <button type="button" class="close2 absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                                        <svg class="w-3 h-3 close" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                        </svg>            
                                        <span class="sr-only">Close modal</span>
                                        </button>
                                        <div class="p-4 md:p-5 text-center">
                                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                                </svg>
                                            <p class="text-m font-normal text-gray-500 mb-2 dark:text-gray-400">Unblocking this user makes the system acessible to them again.</p>
                                            <p class="text-m font-normal text-gray-500 mb-4 dark:text-gray-400">Unblock?</p>
                                            <button id="unblock" type="button" form="unblockUserForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                            Unblock
                                            </button>
                                            <button id="no2" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700">
                                            No, cancel
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </tbody>

            </table>
            <div class="pagination mt-4">
                {{$users->links('pagination.custom')}}
            </div>


        </div>
        </div>
    </div>

    <div class="mt-6 flex justify-end"> 
      <div class="mr-2 items-center sm:flex sm:items-center">
          <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a type="button" class="w-auto px-6 py-2 mb-4 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 block border-b border-purple-300 hover:bg-purple-600 hover:text-white rounded-lg bg-purple-500" 
            href="">
            Back
            </a>
        </div>
    </div>
</div> 
</div>
</x-app-layout>

<script>
$(document).ready(function(){
        
        // fetchUsers();
        var modal = $('#blockUserModal');
        let userId = null;

        $('.block').on('click', function(){
            userId = $(this).data('user_id');
            modal.removeClass('hidden');
        });

        $('#block').on('click', function(){
            if(userId)
            {
                let url = '{{route("admin.blockUser", ":id")}}'.replace(":id", userId);
                $('#blockUserForm').attr('action', url);
                $('#blockUserForm').submit();
            }
        });

        $('.modal-content').on('click', function(){
          modal.addClass('hidden');
        });
        $('#no').on('click', function(){
            modal.addClass('hidden');
        });

        $('.close').on('click', function(){
            modal.addClass('hidden');
        });

        var modal2 = $('#unblockUserModal');
        let userId2 = null;

        $('.unblock').on('click', function(){
            userId2 = $(this).data('user2_id');
            modal2.removeClass('hidden');
        });

        $('#unblock').on('click', function(){
            if(userId2)
            {
                let url = '{{route("admin.unblockUser", ":id")}}'.replace(":id", userId2);
                $('#unblockUserForm').attr('action', url);
                $('#unblockUserForm').submit();
            }
        });

        $('.modal-content2').on('click', function(){
          modal2.addClass('hidden');
        });
        $('#no2').on('click', function(){
            modal2.addClass('hidden');
        });

        $('.close2').on('click', function(){
            modal2.addClass('hidden');
        });

        let currentPage = 1;

        $('#clearSearch').on('click', function(){
            $('#searchUser').val('').focus();
            fetchUsers();
            $('#clearSearch').hide();
        });

        $('#searchUser').on('keyup', function () {
            
            let search = $(this).val();
            currentPage = 1;
            if (search.trim() !== '') {
                console.log('in'); 
                $('#clearSearch').show();
                fetchUsers(search);
            } else {
                $('#clearSearch').hide();
                fetchUsers(); // Fetch data without any filters
            }

        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            
            // Extract the page number from the href attribute
            var page = $(this).attr('href').split('page=')[1];
            console.log('Page number:', page);

            
            // Get the current search query
            var searchQuery = $('#searchUser').val();
            
            // Fetch users with the current search query and page number
            fetchUsers(searchQuery, page);
        });

        function fetchUsers(query = '', page = 1){
            $.ajax({
                url: "{{ route('user.search') }}",
                type: 'GET',
                data: { query: query, page: page },
                success: function(data) {
                    let userList = $('#user-list');
                    userList.empty(); 
                    
                    if (data.users) {
                        console.log(data.users);
                        data.users.forEach((user) => {
                            let image = '';
                            if(user.imageUrl)
                            {
                                image = '<img class="ml-2 rounded-full" src="'+user.imageUrl+'" alt="Sender Image">';
                            }
                            else{
                                image = '<img class="ml-2 rounded-full" src="/images/default.jpeg" alt="profile">';
                            }

                            var block = "{{route('admin.blockUser','')}}/"+user.id;
                            console.log(block);
                            var unblock = "{{route('admin.unblockUser','')}}/"+user.id;
                            let status = '';
                            if(user.status == 'blocked')
                            {
                                status = 
                                '<a data-user2_id="'+user.id+'" class="unblock ms-3 inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 transition ease-in-out duration-150">Unblock</a>'+
                                '<form action="'+unblock+'" id="unblockUserForm" method="POST">'+
                                    '@csrf'+
                                    '@method('PUT')'+
                                    '<div id="unblockUserModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">'+
                                        '<div class="modal-content2 relative p-4 w-full max-w-md max-h-full">'+
                                            '<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">'+
                                                    '<button type="button" class="close2 absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">'+
                                                    '<svg class="w-3 h-3 close" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">'+
                                                        '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>'+
                                                    '</svg>'+
                                                    '<span class="sr-only">Close modal</span>'+
                                                    '</button>'+
                                                    '<div class="p-4 md:p-5 text-center">'+
                                                            '<svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">'+
                                                                '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>'+
                                                            '</svg>'+
                                                        '<p class="text-m font-normal text-gray-500 mb-2 dark:text-gray-400">Unblocking this user makes the system acessible to them again.</p>'+
                                                        '<p class="text-m font-normal text-gray-500 mb-4 dark:text-gray-400">Unblock?</p>'+
                                                        '<button id="unblock" type="button" form="unblockUserForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">'+
                                                        'Unblock'+
                                                        '</button>'+
                                                        '<button id="no2" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700">'+
                                                        'No, cancel'+
                                                        '</button>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</form>';
                            } else {
                                 status = 
                                 '<a data-user_id="'+user.id+'" class="block ms-3 inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 transition ease-in-out duration-150">Block</a>'+
                                 '<form action="'+block+'" id="blockUserForm" method="POST">'+
                                     '@csrf'+
                                     '@method('PUT')'+
                                     '<div id="blockUserModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">'+
                                         '<div class="modal-content relative p-4 w-full max-w-md max-h-full">'+
                                             '<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">'+
                                                     '<button type="button" class="close absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">'+
                                                     '<svg class="w-3 h-3 close" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">'+
                                                         '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>'+
                                                     '</svg>'+            
                                                     '<span class="sr-only">Close modal</span>'+
                                                     '</button>'+
                                                     '<div class="p-4 md:p-5 text-center">'+
                                                             '<svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">'+
                                                                 '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>'+
                                                             '</svg>'+
                                                         '<p class="text-m font-normal text-gray-500 mb-2 dark:text-gray-400">Blocking this user means blocking them from access the data in the system</p>'+
                                                         '<p class="text-m font-normal text-gray-500 mb-4 dark:text-gray-400">Sure want to block?</p>'+
                                                         '<button id="block" type="button" form="blockUserForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">'+
                                                         'Block'+
                                                         '</button>'+
                                                         '<button id="no" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700">'+
                                                         'No, cancel'+
                                                         '</button>'+
                                                     '</div>'+
                                                 '</div>'+
                                             '</div>'+
                                         '</div>'+
                                     '</div>'+
                                 '</form>';
                            }
                            var userStatus = '';
                            if(user.status == 'active')
                            {
                                userStatus = '<span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">'+user.status+'</span>';
                            }
                            else 
                            {
                               userStatus = '<span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-sm font-medium text-red-700 ring-1 ring-inset ring-red-600/20">'+user.status+'</span>';
                            }

                            let userContent = '';
                        
                                userContent +=
                                    '<tr>'+
                                        '<td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">'+
                                            '<div class="flex items-center">'+
                                                '<div class="h-11 w-11 flex-shrink-0">'+
                                                    image+
                                                '</div>'+
                                                '<div class="ml-4">'+
                                                    '<div class="font-medium text-gray-900">'+user.name+'</div>'+
                                                    '<div class="mt-1 text-gray-500">'+user.email+'</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</td>'+
                                        '<td class="whitespace-nowrap py-5 pl-4 font-bold pr-3 text-sm sm:pl-0">'+userStatus+'</td>'+
                                        '<td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">'+
                                            '<a href="/index/quizzes/'+user.id+'" class="tooltip">'+
                                                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-purple-600">'+
                                                    '<path d="M5.566 4.657A4.505 4.505 0 0 1 6.75 4.5h10.5c.41 0 .806.055 1.183.157A3 3 0 0 0 15.75 3h-7.5a3 3 0 0 0-2.684 1.657ZM2.25 12a3 3 0 0 1 3-3h13.5a3 3 0 0 1 3 3v6a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3v-6ZM5.25 7.5c-.41 0-.806.055-1.184.157A3 3 0 0 1 6.75 6h10.5a3 3 0 0 1 2.683 1.657A4.505 4.505 0 0 0 18.75 7.5H5.25Z" />'+
                                                '</svg>'+
                                                '<span class="tooltip-text">Quizzes</span>'+
                                            '</a>'+
                                            '<a href="/index/groups/'+user.id+'" class="statusConfirm publish-btn tooltip">'+
                                                '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-green-600">'+
                                                    '<path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.381ZM8.25 21a.75.75 0 0 1-.75-.75A3.75 3.75 0 0 1 11.25 16.5h1.5a3.75 3.75 0 0 1 3.75 3.75.75.75 0 0 1-.75.75h-7.5ZM14.603 15.79a7.415 7.415 0 0 1 1.14-1.143 7.425 7.425 0 0 1 5.771 3.104.75.75 0 0 1-.374 1.173 14.22 14.22 0 0 1-6.264 1.252c-2.15 0-4.227-.455-6.125-1.252a.75.75 0 0 1-.374-1.173 7.425 7.425 0 0 1 5.771-3.104c.403 0 .8.027 1.19.076Z" clip-rule="evenodd" />'+
                                                '</svg>'+
                                                '<span class="tooltip-text">Groups</span>'+
                                            '</a>'+
                                            '<a href="/users/edit/'+user.id+'" class="tooltip">'+
                                            '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-blue-600">'+
                                            '<path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />'+
                                            '<path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />'+
                                            '</svg>'+
                                            '<span class="tooltip-text">Edit User</span>'+
                                            '</a>'+
                                        '</td>'+
                                        '<td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">'
                                            +status+
                                        '</td>'+
                                    '</tr>';
                                    
                            userList.append(userContent);
                        });

                    } else {
                        $('#user-list').html('<tr><td colspan="4" class="text-center text-gray-500">No users found</td></tr>');
                    }
                    $('.pagination').html(data.links);

                    var modal = $('#blockUserModal');
                    let userId = null;

                    $('.block').on('click', function(){
                        userId = $(this).data('user_id');
                        modal.removeClass('hidden');
                    });

                    $('#block').on('click', function(){
                        if(userId)
                        {
                            let url = '{{route("admin.blockUser", ":id")}}'.replace(":id", userId);
                            console.log(url);
                            $('#blockUserForm').attr('action', url);
                            $('#blockUserForm').submit();
                        }
                    });

                    $('.modal-content').on('click', function(){
                    modal.addClass('hidden');
                    });
                    $('#no').on('click', function(){
                        modal.addClass('hidden');
                    });

                    $('.close').on('click', function(){
                        modal.addClass('hidden');
                    });

                    var modal2 = $('#unblockUserModal');
                    let userId2 = null;

                    $('.unblock').on('click', function(){
                        userId2 = $(this).data('user2_id');
                        modal2.removeClass('hidden');
                    });

                    $('#unblock').on('click', function(){
                        if(userId2)
                        {
                            let url = '{{route("admin.unblockUser", ":id")}}'.replace(":id", userId2);
                            $('#unblockUserForm').attr('action', url);
                            $('#unblockUserForm').submit();
                        }
                    });

                    $('.modal-content2').on('click', function(){
                    modal2.addClass('hidden');
                    });
                    $('#no2').on('click', function(){
                        modal2.addClass('hidden');
                    });

                    $('.close2').on('click', function(){
                        modal2.addClass('hidden');
                    });


                },
                error: function() {
                    alert('Failed to fetch data');
                }
            });
        }
    
});

</script>
  @endsection
