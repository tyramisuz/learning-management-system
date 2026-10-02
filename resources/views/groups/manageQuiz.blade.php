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
<x-app-layout>

<div class="px-4 sm:px-6 md:px7 py-2 lg:px-8"> 
<div class="mx-auto max-w-7xl"> 

    <div class="space-y-15"> 
        <div class="px-4 sm:px-6 py-4 md:px7 lg:px-8"> 
            <h2 class="text-2xl mt-2 font-bold leading-7 text-grey-900">Quiz Assigned</h2>
        </div>

        <!-- assign quiz -->
        <div class="px-4 sm:px-6 md:px7 py-4 lg:px-8"> 
            <div class="mx-auto max-w-7xl"> 

                @if($group->groupquizzes->isNotEmpty())
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-white dark:text-white">
                        <thead class="text-xs text-black uppercase bg-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    No
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Name
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Assign On
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Status
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-900 bg-white">
                        @foreach($groupquizzes as $groupquiz)
                            <tr class=" border-b">
                                <td scope="row" class="px-6 py-4  font-medium text-sm text-gray-900 whitespace-nowrap">
                                    {{ ++$i }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $groupquiz->quiz->title }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $groupquiz->quiz->created_at->format('M d, Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{$groupquiz->status}}</span>
                                </td>

                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        @if($groupquiz->status == 'active')
                                        <a href="#" data-quiz_id="{{$groupquiz->quiz->id}}" class="confirmUnassign tooltip">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-red-600">
                                            <path d="M12 1.5a.75.75 0 0 1 .75.75V7.5h-1.5V2.25A.75.75 0 0 1 12 1.5ZM11.25 7.5v5.69l-1.72-1.72a.75.75 0 0 0-1.06 1.06l3 3a.75.75 0 0 0 1.06 0l3-3a.75.75 0 1 0-1.06-1.06l-1.72 1.72V7.5h3.75a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9a3 3 0 0 1 3-3h3.75Z" />
                                            </svg>
                                            <span class="tooltip-text">Deactivate</span>
                                        </a>
                                        @else
                                        <a href="#" data-quiz_id="{{$groupquiz->quiz->id}}" class="confirmAssign tooltip">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-blue-600">
                                            <path d="M11.47 1.72a.75.75 0 0 1 1.06 0l3 3a.75.75 0 0 1-1.06 1.06l-1.72-1.72V7.5h-1.5V4.06L9.53 5.78a.75.75 0 0 1-1.06-1.06l3-3ZM11.25 7.5V15a.75.75 0 0 0 1.5 0V7.5h3.75a3 3 0 0 1 3 3v9a3 3 0 0 1-3 3h-9a3 3 0 0 1-3-3v-9a3 3 0 0 1 3-3h3.75Z" />
                                            </svg>
                                            <span class="tooltip-text">Activate</span>
                                        </a>
                                        @endif
                                        <a href="{{ route('groups.members', ['groupId'=>$id , 'quizId' =>$groupquiz->quiz->id]) }}" class="tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                            <path d="M4.5 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM14.25 8.625a3.375 3.375 0 1 1 6.75 0 3.375 3.375 0 0 1-6.75 0ZM1.5 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM17.25 19.128l-.001.144a2.25 2.25 0 0 1-.233.96 10.088 10.088 0 0 0 5.06-1.01.75.75 0 0 0 .42-.643 4.875 4.875 0 0 0-6.957-4.611 8.586 8.586 0 0 1 1.71 5.157v.003Z" />
                                        </svg>
                                        <span class="tooltip-text">Participants</span>
                                        </a>

                                        <!-- <a href="{{ route('groups.editAssignment', ['id' => $groupquiz->quiz->id, 'groupId' => $id])}}" class="tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="edit size-6 text-green-500">
                                        <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                        <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>
                                        <span class="tooltip-text">Edit assignment</span>
                                        </a> -->

                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                @else
                    <p class="text-center">No quiz assigned for this group.</p>
                @endif

            <div class="mt-6 flex justify-end"> 
                <div class="mr-2 items-center sm:flex sm:items-center">
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    <a type="button" class="w-auto px-6 py-2 mb-4 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 block border-b border-purple-300 hover:bg-purple-300 text-purple-700 rounded-lg" style="background-color: {{$group->color}};"
                    onclick="history.back();">
                    Back
                    </a>
                    </div>
                </div>
            </div>

            </div>
        </div>

        <!-- unassign quiz -->
    <form action="{{ route('groups.unassignQuiz', $id)}}" method="POST" id="unassignForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="group_id" value="{{$id}}">
        <div id="unassignModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
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
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">By doing this,student will not be able to see or answer this quiz anymore</h3>
                        <button id="unassign" type="submit" form="unassignForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        Unassign
                        </button>
                        <button id="dont" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100">
                        No, cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
    
    <!-- assign quiz -->
    <form action="{{ route('groups.assignBack', $id)}}" method="POST" id="assignForm" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="group_id" value="{{$id}}">
        <div id="assignModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
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
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Assign back this quiz?</h3>
                        <button id="assign" type="submit" form="assignForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                        assign
                        </button>
                        <button id="no" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:text-white hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        No, cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

</div>
</div>
</x-app-layout>

<script>
    $(document).ready(function(){
        var modal = $('#unassignModal');
        var modal2 = $('#assignModal');
        var quizId = null;

        $('.confirmUnassign').on('click', function(){
            quizId = $(this).data('quiz_id');
            modal.removeClass('hidden');
        });

        $('#unassign').on('click', function(){
            if(quizId)
            {
                let url= '{{ route("groups.unassignQuiz", ":id")}}'.replace(":id", quizId);
                $('#unassignForm').attr('action', url);
                $('#unassignForm').submit();
            }
            else{
                console.log('quiz id not set');
            }
        });

        $('#dont').on('click', function(){
            modal.addClass('hidden');
        });
        $('.close').on('click', function(){
            modal.addClass('hidden');
        });

        $('.confirmAssign').on('click', function(){
            quizId = $(this).data('quiz_id');
            modal2.removeClass('hidden');
        });

        $('#assign').on('click', function(){
            if(quizId)
            {
                let url= '{{ route("groups.assignBack", ":id")}}'.replace(":id", quizId);
                $('#assignForm').attr('action', url);
                $('#assignForm').submit();
            }
            else{
                console.log('quiz id not set');
            }
        });

        $('#no').on('click', function(){
            modal2.addClass('hidden');
        });
        $('.close').on('click', function(){
            modal2.addClass('hidden');
        });

    });
</script>
@endsection