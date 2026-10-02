@extends('layout')
  
@section('content')
  
<style>
    #alert {
        transition: opacity 0.5s ease-out;
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

<title>Members</title>

<div class="px-4 bg-gray-100 sm:px-6 md:px7 py-2 lg:px-8"> 

    <div class="border-b mt-6 border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
    <div class="text-left">
        <h3 class="text-base font-semibold leading-6 text-gray-900">Participants</h3>
        <p class="mt-2 text-sm text-gray-700">Learning Odyssey</p>
    </div>
    <div class="mt-3 sm:ml-4 sm:mt-0">
        <div class="hidden flex rounded-md shadow-sm">
        <div class="relative flex-grow focus-within:z-10">
            <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
            <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
            </svg>
            </div>
            <input type="text" name="search" id="searchParticipant" class="hidden w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-sm leading-6 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:block" placeholder="Search participants">
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
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900">Report</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                    <!-- <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"></th> -->
                    <!-- <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th> -->
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @if($members->isNotEmpty())
                        @foreach($responses as $response)
                        @php
                        //dd($response['attempt']);
                        @endphp
                            <tr>
                            <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                                <div class="flex items-center">
                                <div class="h-11 w-11 flex-shrink-0">
                                    @if($response['member']->user->image)
                                    <img class="ml-2 rounded-full" src="{{ Storage::url($response['member']->user->image) }}" alt="Sender Image">
                                    @else
                                    <img class="ml-2 rounded-full" src="/images/default.jpeg" alt="profile">
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium text-gray-900">{{$response['member']->user->name}}</div>
                                    <div class="mt-1 text-gray-500">{{$response['member']->user->email}}</div>
                                </div>
                                </div>
                            </td>
                                
                            @if($response['status'] == 'assigned')
                            <td class="relative whitespace-nowrap py-5 pl-3 pr-4 text-center text-sm font-medium sm:pr-0">
                                <a href="{{route('report.group', ['userId'=> $response['member']->user->id, 'quizId' =>$quizId, 'attempt'=> '1' ])}}" class="ms-3 inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-800 focus:bg-green-700 active:bg-green-900 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition ease-in-out duration-150">Report</a>
                            </td>
                            @else
                            <td class="relative whitespace-nowrap py-5 pl-3 pr-4 text-center text-sm font-medium sm:pr-0">N/A</td>
                            @endif
                        
                            <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                @if($response['status'] == 'assigned')
                                <!-- <span class="inline-flex items-center rounded-md bg-green-50 px-6 py-2 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20"><strong>Assigned</strong></span> -->
                                <div class="text-green-600"><strong>Assigned</strong></div>
                                @else
                                <!-- <span class="inline-flex items-center rounded-md bg-green-50 px-6 py-2 text-sm font-medium text-red-700 ring-1 ring-inset ring-red-600/20"><strong></strong></span> -->
                                <div class="text-red-600"><strong>Not Completed</strong></div>
                                @endif
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
            <a type="button" class="w-auto px-6 py-2 mb-4 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 rounded-sm block border-b border-purple-300 hover:bg-purple-300 text-purple-700 rounded-lg" style="background-color: {{$group->color}};"
            href="{{route('groups.index', $groupId)}}">
            Back
            </a>
          </div>
      </div>
    </div>
</div>
  @endsection