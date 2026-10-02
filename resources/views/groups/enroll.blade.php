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
@if ($error = Session::get('error'))
<div id="alert" class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
    <div class="ms-3 text-sm font-medium">
      {{$error}}
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

<div class="m-4 sm:px-6 md:px7 py-8 lg:px-8">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-base font-bold leading-6 text-xl text-slate-950">Enrolled Group</h1>
      <p class="mt-2 text-sm text-gray-700">Learning Odyssey</p>
    </div>
    <div class="relative group">
      <a href="" class="joinGroup tooltip">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-10 w-10 text-indigo-500">
              <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
          </svg>
          <span class="tooltip-text">Join Group</span>
      </a>
    </div>
    <!-- <div class="mt-4 sm:ml-16 sm:mt-0 flex gap-2">
      <a type="button" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" >Create Group</a>
    </div> -->
</div>


    <div class="container mx-auto p-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-4">
          @forelse($groupData as $data)
            <div class="p-6 rounded-lg shadow-md relative" style="background-color:{{$data['group_color']}};">
              <!-- Menu Icon -->
              <button class="dropdownEnroll absolute right-4 top-2 h-6 w-6 text-gray-500 hover:text-gray-800 cursor-pointer" data-group-id="{{ $data['group_id'] }}" type="button">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
              </button>

              <div class="dropdown2 z-50 absolute right-0 top-0 mt-10 bg-white divide-y divide-gray-100 rounded-lg shadow dark:bg-gray-700 hidden">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                  <li>
                    <a href="#" data-group_id="{{ $data['group_id']}}" data-action="leave" class="confirmLeave block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600">Unenrol</a>
                  </li>
                </ul>
              </div>
              
              <div class="flex justify-between items-center mt-2 mb-4">
                  <div>
                      <a href="{{ route('groups.show', $data['group_id']) }}" class="text-xl font-semibold mb-2 text-gray-800 hover:underline uppercase">{{ $data['group_name'] }}</a>
                      <p class="text-gray-600">{{ $data['creator_name'] }}</p>
                  </div>
                  
                  @if($data['creator_image'])
                  <img src="{{ Storage::url($data['creator_image']) }}" alt="creator image" class="w-16 h-16 rounded-full object-cover">
                  @else
                  <img src="/images/default.jpeg" alt="default img" class="w-16 h-16 rounded-full object-cover">
                  @endif
              </div>
              
              <div class="text-sm text-gray-500 mb-2">Joined on: {{ $data['join_date']->format('M d, Y') }}</div>
          
            </div>
          @empty
            <div class="col-span-1 md:col-span-2 lg:col-span-3">
              <p class="text-gray-600 text-center">You are not enrolled in any groups.</p>
            </div>
          @endforelse
        </div>
    </div>
    <!-- leave modal -->
    <form action="{{ route('groups.leave', $groupId )}}" id="leaveForm" method="POST" id="LeaveForm" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <div id="leaveModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
          <div class="relative p-4 w-full max-w-md max-h-full">
              <div class="relative bg-white rounded-lg py-4 shadow dark:bg-gray-700">
                <h2 class="font-semibold ml-4 mt-4">Unenrol from this group?</h2>
              <!-- Close button aligned to the right -->
                      <button type="button" class="close absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                        <svg class="w-3 h-3 close" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>            
                        <span class="sr-only">Close modal</span>
                      </button>
                      <div class="p-4 md:p-5">
                          <p class="text-m font-normal text-gray-500 mb-4 dark:text-gray-400">You will be removed from this group</p>
                          <p class="text-m font-normal text-gray-500 mb-4 dark:text-gray-400">You will no longer see this group or participate in it</p>
                          <button id="leave" type="submit" form="leaveForm" class="text-black focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg hover:text-red-700 text-sm inline-flex items-center px-5 py-2.5 text-center" style="background-color: {{$data['group_color']}};">
                          Unenrol
                          </button>
                          <button id="nope" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                          No, cancel
                          </button>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </form>
    <!-- join Modal -->
    <div id="join-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-50" aria-hidden="true"></div>
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Enter Code to join group<span class="font-extrabold italic"></span>
                    </h3>
                    <button type="button" class="close end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form id="joinForm" class="space-y-4" action="{{ route('groups.joinCode') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div>
                            <label for="code" class="block mb-4 text-sm font-medium text-gray-900">Code</label>
                            <input type="text" name="code" id="code" class="py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder="ankluf" required />
                        </div>
                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Join Group</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
<script>

    $('.dropdownEnroll').on('click', function(event) {
      var button = $(this);
        var dropdown = button.closest('.relative').find('.dropdown2');
            event.preventDefault();
            dropdown.toggleClass('hidden');
    });

    $(document).on('click', function(event) {
        if (!$(event.target).closest('.dropdown2').length && !$(event.target).closest('.dropdownEnroll').length) {
            $('.dropdown2').addClass('hidden');
        }
    });

    const modal = $('#leaveModal');
    let groupId = null;

    $('.confirmLeave').on('click', function(){
      groupId = $(this).data('group_id');
      modal.removeClass('hidden');
    });

    $('#leave').on('click', function(){
      if(groupId)
      {
        let url = '{{route("groups.leave", ":id")}}'.replace(":id", groupId);
        $('#leaveForm').attr('action', url);
        $('#leaveForm').submit();
        console.log('Group ID:', groupId);
      } else {
          console.error('Group ID not set');
      }
    });
    $('#nope').on('click', function(){
      modal.addClass('hidden');
    });
    $('.close').on('click', function(){
      modal.addClass('hidden');
    });

    $('.joinGroup').on('click', function(e) {
      console.log('in');
        e.preventDefault();
        $('#join-modal').removeClass('hidden');
        $('#join-modal').addClass('flex');
        $('#join-modal').attr('aria-hidden', 'false');
    });

    $('.close').on('click', function(e){
        e.preventDefault();
        $('#join-modal').addClass('hidden');
        $('#join-modal').removeClass('flex');
        $('#join-modal').attr('aria-hidden', 'true');
    });
</script>
@endsection