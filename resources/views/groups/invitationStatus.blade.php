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
<div class="px-4 bg-white sm:px-6 md:px7 py-2 lg:px-8"> 
    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
          <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full mb-6 divide-y divide-gray-300">
                <thead>
                    <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Invite Date</th>
                    <!-- <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th> -->
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"></th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @if($invitations->isNotEmpty())
                        @foreach($invitations as $invitation)
                            <tr>
                            <td class="whitespace-nowrap py-5 pl-4 pr-3 text-sm sm:pl-0">
                                <div class="flex items-center">
                                <div class="h-11 w-11 flex-shrink-0">
                                    @if($invitation->user && $invitation->user->image)
                                    <img class="ml-2 rounded-full" src="{{ Storage::url($invitation->user->image) }}" alt="Profile Image">
                                    @else
                                    <img class="ml-2 rounded-full" src="/images/default.jpeg" alt="profile">
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <div class="font-medium text-gray-900">{{$invitation->user->name}}</div>
                                    <div class="mt-1 text-gray-500">{{$invitation->user->email}}</div>
                                </div>
                                </div>
                            </td>
                            @php
                                $date = $invitation->created_at->format('D, M j, Y');
                                // dd($date);
                                $time = $invitation->created_at->format('h:m:s a');
                            @endphp
                            <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                <div class="text-gray-900">{{$date}}</div>
                                <div class="mt-1 text-gray-500">{{$time}}</div>
                            </td>
                            <td class="whitespace-nowrap px-3 py-5 text-sm text-gray-500">
                                @if($invitation->status  == 'accepted')
                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{$invitation->status}}</span>
                                @elseif($invitation->status == 'pending')
                                <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-sm font-medium text-yellow-700 ring-1 ring-inset ring-yellow-600/20">{{$invitation->status}}</span>
                                @else
                                <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-sm font-medium text-red-700 ring-1 ring-inset ring-red-600/20">{{$invitation->status}}</span>
                                @endif
                            </td>
                            <td class="relative whitespace-nowrap py-5 pl-3 pr-4 text-sm font-medium sm:pr-0">
                                @if($invitation->status == 'pending')
                                <button data-invite_id="{{$invitation->id}}" type="button" class="cancelConfirm mt-5 ms-3 inline-flex focus:ring-red-700 items-center px-4 py-2 bg-red-500 border border-transparent rounded-md text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 active:bg-red-900 focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150">Cancel Invite</button>
                                @endif
                            </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="text-sm leading-6 text-gray-900">
                            <td colspan="3" class="py-5 text-center">No invitations.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        </div>
    </div>
  </div>

  <div class="mt-6 flex justify-end"> 
      <div class="mr-10 items-center sm:flex sm:items-center">
          <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a href="{{route('groups.index')}}" type="button" class="w-auto px-6 py-2 mb-4 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 rounded-sm block border-b border-purple-300 hover:bg-purple-300 text-purple-700 rounded-lg" style="background-color: {{$group->color}};">
            Back
            </a>
          </div>
      </div>
  </div>
</div>

    <!-- remove modal -->
    <form action="{{ route('invitation.cancel', $id)}}" method="POST" id="cancelForm" enctype="multipart/form-data">
        @csrf
        @method('DELETE')
        <input type="hidden" name="group_id" value="{{$id}}">
        <div id="cancelModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
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
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Student will not be able to join this group,Cancel Invitation?</h3>
                        <button id="cancel" type="submit" form="cancelForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Yes
                        </button>
                        <button id="noCancel" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        No, cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
    </form> 
<script>

    $(document).ready(function(){
        var modal = $('#cancelModal');
        var inviteId = null;

        $('.cancelConfirm').on('click', function(){
            inviteId = $(this).data('invite_id');
            modal.removeClass('hidden');

        });

        $('#cancel').on('click', function(){
            if(inviteId)
            {
                let url = '{{route("invitation.cancel",":id")}}'.replace(':id', inviteId);
                $('#cancelForm').attr('action',url);
                $('#cancelForm').submit();
            }
            else{
                console.log('user id not found');
            }
        });
        $('#noCancel').on('click',function(){
            modal.addClass('hidden');
        });

        $('.close').on('click',function(){
            modal.addClass('hidden');
        })
    });
</script>
@endsection