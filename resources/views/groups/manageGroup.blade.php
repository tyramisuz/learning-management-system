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
<x-app-layout>
<title>Manage Group</title>

<div class="px-4 bg-gray-100 sm:px-6 md:px7 py-2 lg:px-8"> 
  <div class="mx-auto max-w-7xl"> 
    <div class="space-y-15"> 
      <form action="{{ route('groups.update', $id) }}" method="POST" enctype="multipart/form-data">
              <div class="px-4 sm:px-0 sm:flex-0">
                <h2 class="text-2xl text-center font-bold leading-7 py-8 text-grey-900">Manage Group</h2>
              </div>
                        
                @csrf
                @method('PUT')
          
                <div class="bg-white shadow-lg rounded-lg p-4">
                  <div class="ml-5 mt-2 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-5">
                    <div class="sm:col-span-4">
                      <label for="name" class="block text-sm font-semibold leading-6 text-gray-900">Name</label>
                      <div class="relative mt-2">
                        <div class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                          <input type="text" name="name" id="name" autocomplete="" class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 focus:ring-0 sm:text-sm sm:leading-8 outline: none box-shadow: none" placeholder="Mars" value="{{$group->name}}" >
                        </div>
                        <div>
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-800 absolute right-0 mt-2 cursor-pointer" id="edit-name">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                          </svg>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="ml-5 mt-10 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-5">
                    <div class="sm:col-span-4">
                      <label for="description" class="block text-sm font-semibold leading-6 text-gray-900">Description</label>
                      <div class="relative mt-2">
                        <div class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                          <textarea name="description" id="description" class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 focus:ring-0 sm:text-sm sm:leading-8" placeholder="Upcoming Exams Practices">{{$group->description}}</textarea>
                        </div>
                        <div>
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-800 absolute right-0 mt-2 cursor-pointer" id="edit-description">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                          </svg>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="ml-5 mt-10 flex gap-2 justify-end">
                    <!-- <a href="{{route('groups.index')}}" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:w-auto sm:text-sm">Cancel</a> -->
                    <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                  </div>
                </div>
      </form>

        <script>

            function deleteGroup(id){
                console.log('group');
                if(confirm('Are you sure want to delete this group?')){
                    var form = $('#delete_group_' + id);
                    if(form.length){
                        form.submit();
                    } else {
                        console.error("form not found");
        
                    }
                    
                }
            }

            function deleteMember(id){
                console.log('member');
                var yes = $('.');
                if(confirm('Are you sure want to delete this group?')){
                    var form = $('#delete_group_' + id);
                    if(form.length){
                        form.submit();
                    } else {
                        console.error("form not found");
        
                    }
                    
                }
            }

        </script>

        <!-- share group -->
      <div class="ml-5 mt-4 flex justify-end items-center gap-2">
        <div class="relative inline-block">

            <!-- Share menu -->
            <div id="dropdownShare" class="absolute right-0 mt-12 w-44 rounded-lg shadow-lg bg-white divide-y divide-gray-100 dark:bg-gray-700 hidden z-50">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownButton">
                    <li>
                        <a href="#" data-action="invite" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Invite via Email</a>
                    </li>
                    <li>
                        <a href="#" data-action="shareLink" data-group_id="{{$id}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Share Link</a>
                    </li>
                    <li>
                        <a href="#" data-action="shareCode" data-group_id="{{$id}}" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Share Code</a>
                    </li>
                </ul>
            </div>
        </div>

      </div>

      <!-- invite modal -->
      <div id="invitation-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
          <div class="relative p-4 w-full max-w-md max-h-full">
              <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-50" aria-hidden="true"></div>
              <!-- Modal content -->
              <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                  <!-- Modal header -->
                  <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                      <h3 class="text-xl font-semibold text-gray-900">
                          Send Invitation
                      </h3>
                      <button type="button"  class="close end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="authentication-modal">
                          <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                              <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                          </svg>
                          <span class="sr-only">Close modal</span>
                      </button>
                  </div>
                  <!-- Modal body -->
                  <div class="p-4 md:p-5">
                      <form class="space-y-4" action="{{route('groups.invite', $id)}}" method="POST" enctype="multipart/form-data">
                      @csrf
                          <div>
                              <label for="email" class="block mb-4 text-sm font-medium text-gray-900">Email<span class="font-semibold text-red-500"> *Separate emails by using comma','</span></label>
                              
                              <textarea type="email" name="student_email" id="email" class="py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="name@gmail.com, abu@gmail.com" required></textarea>
                              <!-- <select class="flex text-gray-900 rounded-md bg-white/5 ring-1 ring-inset ring-white/10 w-full block ps-10 p-2.5 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500" id="email" type="email" name= "student_email"multiple="multiple">
                                <option selected="selected">ahmad@gmail.com</option>
                              </select> -->
                          </div>
                          <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Send Invite</button>
                      </form>
                  </div>
              </div>
          </div>
      </div>
          
      <!-- Link modal -->
        <div id="link-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-50" aria-hidden="true"></div>
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Share Group Link<span class="font-extrabold italic"></span>
                        </h3>
                        <button type="button" class="closeLink end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="announcement-modal-{{ $group->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                            <div class="relative">
                                <label for="linkInput" class="block mb-4 text-sm font-medium text-gray-900">Group Link</label>
                                <input type="text" id="linkInput" class="py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pr-10" readonly />
                                <div id="copyButton" class="absolute inset-y-14 right-0 flex items-center pr-3 cursor-pointer tooltip">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500 hover:text-gray-700">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                                    </svg>
                                    <span class="tooltip-text">Copy Link</span>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Code modal -->
        <div id="code-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-50" aria-hidden="true"></div>
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Share Group Code<span class="font-extrabold italic"></span>
                        </h3>
                        <button type="button" class="closeCode end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="announcement-modal-{{ $group->id }}">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                            <div class="relative">
                                <label for="codeInput" class="block mb-4 text-sm font-medium text-gray-900">Group Code</label>
                                <input type="text" id="codeInput" class="py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pr-10" readonly />
                                <div id="copyCodeButton" class="absolute inset-y-14 right-0 flex items-center pr-3 cursor-pointer tooltip">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-500 hover:text-gray-700">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.666 3.888A2.25 2.25 0 0 0 13.5 2.25h-3c-1.03 0-1.9.693-2.166 1.638m7.332 0c.055.194.084.4.084.612v0a.75.75 0 0 1-.75.75H9a.75.75 0 0 1-.75-.75v0c0-.212.03-.418.084-.612m7.332 0c.646.049 1.288.11 1.927.184 1.1.128 1.907 1.077 1.907 2.185V19.5a2.25 2.25 0 0 1-2.25 2.25H6.75A2.25 2.25 0 0 1 4.5 19.5V6.257c0-1.108.806-2.057 1.907-2.185a48.208 48.208 0 0 1 1.927-.184" />
                                    </svg>
                                    <span class="tooltip-text">Copy Code</span>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex mt-10 justify-between">
          <h2 class="text-2xl font-bold">Member List</h2>
          <button id="dropdownButton" data-group-id="{{$id}}" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">Share Group
            <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
            </svg>
          </button>
        </div>

      <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full mb-6 divide-y divide-gray-300">
              <thead>
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Join Date</th>
                  <!-- <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th> -->
                  <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Action</th>
                  <!-- <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th> -->
                </tr>
              </thead>
              <tbody class="divide-y divide-gray-200 bg-white">
                @if($members->isNotEmpty())
                    @foreach($members as $member)
                        <tr>
                        <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                            <div class="flex items-center">
                            <div class="h-11 w-11 flex-shrink-0">
                                @if($member->user->image)
                                <img class="ml-2 rounded-full" src="{{ Storage::url($member->user->image) }}" alt="Sender Image">
                                @else
                                <img class="ml-2 rounded-full" src="/images/default.jpeg" alt="profile">
                                @endif
                            </div>
                            <div class="ml-4">
                                <div class="font-medium text-gray-900">{{$member->user->name}}</div>
                                <div class="mt-1 text-gray-500">{{$member->user->email}}</div>
                            </div>
                            </div>
                        </td>
                        @php
                            $date = $member->updated_at->format('D, M j, Y');
                            // dd($date);
                            $time = $member->updated_at->format('h:m:s a');
                        @endphp
                        <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                            <div class="text-gray-900">{{$date}}</div>
                            <div class="mt-1 text-gray-500">{{$time}}</div>
                        </td>
                        <!-- <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">{{$member->is_creator ? 'Admin': 'Member'}}</td> -->
                        <td class="relative whitespace-nowrap py-5 pl-3 pr-4 text-center text-sm font-medium sm:pr-0">
                            <button data-member_id="{{$member->user->id}}" type="button" class="removeConfirm mt-5 ms-3 inline-flex focus:ring-red-700 items-center px-4 py-2 bg-red-500 border border-transparent rounded-md text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">REMOVE</button>
                        </td>
                        </tr>
                    @endforeach
                @else
                    <tr class="text-sm leading-6 text-gray-900">
                        <td colspan="3" class="py-5 text-center">No members.</td>
                    </tr>
                @endif
            </tbody>
        </table>
          </div>
        </div>
      </div>

      <div class="mt-6 flex justify-end"> 
          <div class="mr-2 items-center sm:flex sm:items-center">
              <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a type="button" class="w-auto px-6 py-2 rounded-lg mb-4 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 block border-b border-purple-300 hover:bg-purple-300 text-purple-700 rounded-lg" style="background-color: {{$group->color}};"
                href="{{route('groups.index')}}">
                Back
                </a>
              </div>
          </div>
      </div>
      
      <!-- remove modal -->
      <form action="{{ route('member.destroy', $id)}}" method="POST" id="removeForm" enctype="multipart/form-data">
          @csrf
          @method('DELETE')
          <input type="hidden" name="group_id" value="{{$id}}">
          <div id="removeModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
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
                          <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Do you want to remove this member?</h3>
                          <button id="yesRemove" type="submit" form="removeForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                              Yes, I'm sure
                          </button>
                          <button id="noButton1" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:text-white hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                          No, cancel
                          </button>
                      </div>
                  </div>
              </div>
          </div>
          
      </form>  

    </div>
  </div>
</div>

</x-app-layout>



<!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->
<!-- timer message -->
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Select the alert message
        
        // If the alert message exists, set a timeout to hide it
        if (alertMessage) {
          console.log('5 sec');
            setTimeout(function() {
                alertMessage.style.display = 'none';
            }, 5000); 
        }
        
    });
    
    var alertMessage = document.getElementById('alert');

    const modal = $('#removeModal');
    let memberId = null;

    $('.removeConfirm').on('click', function() {
        memberId = $(this).data('member_id');
        modal.removeClass('hidden');
        console.log('Member id:', memberId);
    });

    $('#yesRemove').on('click', function() {
        if (memberId) {
            let url = '{{ route("member.destroy", ":id") }}'.replace(':id', memberId);
            $('#removeForm').attr('action', url);
            $('#removeForm').submit();
            console.log('Member ID:', memberId);
        } else {
            console.error('Member ID not set');
        }
    });

    $('#noButton1').on('click', function() {
        modal.addClass('hidden');
        memberId = null;
    });

    $('.close').on('click', function() {
        modal.addClass('hidden');
        memberId = null;
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css">
<script>


    $(document).ready(function(){


      $('select').select2({
        createTag: function (params) {
          var term = $.trim(params.term);

          if (term === '') {
            return null;
          }

          return {
            id: term,
            text: term,
            newTag: true // add additional parameters
          }
        }
      });

      $('select').select2({
        createTag: function (params) {
          // Don't offset to create a tag if there is no @ symbol
          if (params.term.indexOf('@') === -1) {
            // Return null to disable tag creation
            return null;
          }

          return {
            id: params.term,
            text: params.term
          }
        }
      });

      $('select').select2({
        insertTag: function (data, tag) {
          // Insert the tag at the end of the results
          data.push(tag);
        }
      });

      $('#edit-name').on('click', function(){
        $('#name').focus();
      });
  
      $('#edit-description').on('click', function(){
        $('#description').focus();
      });
  

        $('#dropdownButton').click(function() {
            $('#dropdownShare').toggleClass('hidden');
        });

        $('#dropdownButton').on('click', function(event) {
            console.log('click in'); 
            var button = $(this);
            var groupId = button.data('group-id'); 

            $('.dropdownShare').find('a').each(function() {
                var action = $(this).data('action');
                if (action === 'QR') {
                    $(this).attr('href', `{{ route('groups.manage', '') }}/${groupId}`);
                }
            });

            event.stopPropagation(); 
        });

        $(document).click(function(event) {
                if(!$(event.target).closest('#dropdownButton').length && !$(event.target).closest('#dropdownShare').length) {
                    $('#dropdownShare').addClass('hidden');
                }
        });

        $('[data-action="invite"]').click(function(e) {
            e.preventDefault();
            $('#invitation-modal').removeClass('hidden');
            $('#invitation-modal').addClass('flex');
            $('#invitation-modal').attr('aria-hidden', 'false');
        });

        $('.close').on('click', function(e){
          e.preventDefault();
            $('#invitation-modal').addClass('hidden');
            $('#invitation-modal').removeClass('flex');
            $('#invitation-modal').attr('aria-hidden', 'true');
        });

      });

      $('a[data-action="shareLink"]').on('click', function (event) {
          event.preventDefault();
          
          var groupId = $(this).data('group_id');
          console.log(groupId);
          var linkModal = $('#link-Modal');
          var linkInput = $('#linkInput');
          
        fetch('/group/' + groupId + '/shareLink')
        .then(response => response.json())
        .then(data => {
            console.log(data.url);
            $('#linkInput').val(data.url);
            $('#link-modal').removeClass('hidden'); 
            $('#link-modal').addClass('flex');
            $('#link-modal').attr('aria-hidden', 'false');
        })
        .catch(error => console.error('Error:', error));

      });

      $('#copyButton').on('click', function() {
          var linkInput = $('#linkInput').get(0); 
          linkInput.select(); 
          try {
              var successful = document.execCommand('copy');
              var msg = successful ? 'Link copied to clipboard!' : 'Failed to copy link!';
              alert(msg); 
          } catch (err) {
              console.error('Error copying text: ', err);
              alert('Failed to copy link!');
          }
      });


      $('.closeLink').on('click', function(e){
        e.preventDefault();
          $('#link-modal').addClass('hidden');
          $('#link-modal').removeClass('flex');
          $('#link-modal').attr('aria-hidden', 'true');
      });

      $('a[data-action="shareCode"]').on('click', function (event) {
          event.preventDefault();
          
          var groupId = $(this).data('group_id');
          console.log(groupId);
          var linkModal = $('#code-Modal');
          var linkInput = $('#codeInput');
          
        fetch('/group/' + groupId + '/shareCode')
        .then(response => response.json())
        .then(data => {
            console.log(data.code);
            $('#codeInput').val(data.code);
            $('#code-modal').removeClass('hidden'); 
            $('#code-modal').addClass('flex');
            $('#code-modal').attr('aria-hidden', 'false');
        })
        .catch(error => console.error('Error:', error));

      });

      $('#copyCodeButton').on('click', function() {
          var codeInput = $('#codeInput').get(0); 
          codeInput.select(); 
          try {
              var successful = document.execCommand('copy');
              var msg = successful ? 'Code copied to clipboard!' : 'Failed to copy code!';
              alert(msg); 
          } catch (err) {
              console.error('Error copying text: ', err);
              alert('Failed to copy code!');
          }
      });

      $('.closeCode').on('click', function(e){
        e.preventDefault();
          $('#code-modal').addClass('hidden');
          $('#code-modal').removeClass('flex');
          $('#code-modal').attr('aria-hidden', 'true');
      });

</script>

@endsection