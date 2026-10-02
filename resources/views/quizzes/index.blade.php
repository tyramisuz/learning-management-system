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

<title>Inventory</title>
<div class="px-4 sm:px-6 md:px7 py-10 lg:px-8">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-base font-bold leading-6 text-xl text-slate-950">Quizzes</h1>
      <p class="mt-2 text-sm text-gray-700">Learning Odyssey</p>
    </div>
      <div class="mt-4 sm:ml-16 sm:mt-0 flex gap-2">
            <a type="button" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" href="{{ route('quizzes.create') }}">Create Quiz</a>
      </div>
  </div>

  <div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block w-full py-2 align-middle sm:px-6 lg:px-8">
        @if($quizzes->isNotEmpty())
          <table class="min-w-full divide-y divide-gray-300">
              <thead>
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">No</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Title</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Participants</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Duration</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Total Point</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"></th>
                  <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900 ">Action</th>
                  
                </tr>
              </thead>
              
              <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($quizzes as $quiz)
                  @if (auth()->user()->id == $quiz->user_id)
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
            
                      <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ ++$i }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $quiz->title }}</td>
                    
                        @if($quiz->participants == null)
                        <td>
                        <a class="ms-3 inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:bg-blue-600 active:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">N/A</a>
                        </td>
                        @else
                        <td>
                          
                          <a href="{{route('quizzes.participants', $quiz->id)}}" class="ms-3 inline-flex items-center px-6 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            {{$quiz->participants}}
                          </a>
                        </td>
                        @endif


                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $quiz-> duration}}</td>

                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $quiz->totalpoints }}</td>

                        @if ($quiz->status == 'draft')
                          <td class="whitespace-nowrap px-3 py-4 text-sm font-bold text-purple-500">{{ $quiz-> status}}</td>
                        @else
                          <td class="whitespace-nowrap px-3 py-4 text-sm font-bold text-green-500">{{ $quiz-> status}}</td>
                        @endif
                          <td class="whitespace-nowrap px-3 py-4 text-sm font-bold text-green-500">
                        @if($quiz->questions->isNotEmpty())
                          <a href="{{ route('questions.index', $quiz->id) }}" class="ms-3 inline-flex items-center px-4 py-2 bg-teal-400 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-400 focus:bg-blue-400 active:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-gray-600 focus:ring-offset-2 transition ease-in-out duration-150">Question</a>
                        @endif
                        <!-- </td> -->

                        <td class="gap-2 relative whitespace-nowrap py-4 pl-3 pr-4 text-center justify-end text-sm font-medium sm:pr-6 lg:pr-8 flex">
                          @if($quiz->status == 'draft')
                          <a href="{{ route('questions.create', $quiz->id) }}" class="tooltip">
                          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                          </svg>
                              <span class="tooltip-text">Create Question</span>
                            </a>
                          @endif
                          @if ($quiz->status == 'draft' && $quiz->questions->isNotEmpty())
                            <input type="hidden" name="status_{{$quiz->id}}" id="status_{{$quiz->id}}" value="draft">
                            <a data-quiz_id="{{ $quiz->id }}" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="statusConfirm publish-btn tooltip" href="#">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 8.25H7.5a2.25 2.25 0 0 0-2.25 2.25v9a2.25 2.25 0 0 0 2.25 2.25h9a2.25 2.25 0 0 0 2.25-2.25v-9a2.25 2.25 0 0 0-2.25-2.25H15m0-3-3-3m0 0-3 3m3-3V15" />
                                </svg>
                                <span class="tooltip-text">Publish</span>
                            </a>
                            @endif
                            @if($quiz->status == 'draft')
                            <a href="{{ route('quizzes.edit', $quiz->id) }}" class="tooltip">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                              </svg>
                              <span class="tooltip-text">Edit</span>
                            </a>
                            @endif
                          @if ($quiz->questions->isNotEmpty())
                            <a href="{{ route('questions.show', $quiz->id) }}" class="tooltip">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-yellow-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 0 0 6 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 0 1 6 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 0 1 6-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0 0 18 18a8.967 8.967 0 0 0-6 2.292m0-14.25v14.25" />
                            </svg>
                            <span class="tooltip-text">Practice</span>
                            </a>
                            @endif
                            @if($quiz->status == 'publish')
                            <input type="hidden" name="status_{{$quiz->id}}" id="status_{{$quiz->id}}" value="draft">
                            <a data-quiz_id="{{ $quiz->id }}" data-modal-target="popup-modal" data-modal-toggle="popup-modal" class="statusConfirm1 unpublish-btn tooltip" href="#">
                              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m8.25 3v6.75m0 0-3-3m3 3 3-3M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                              </svg>
                              <span class="tooltip-text">Unpublish</span>
                            </a>
                            @endif
                          @if($quiz->status == 'publish' && $quiz->participants !== null)
                            <a href="{{ route('report.creator',$quiz->id) }}" class="tooltip">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-green-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25M9 16.5v.75m3-3v3M15 12v5.25m-4.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
                            </svg>
                            <span class="tooltip-text">Report</span>
                            </a>
                          @endif
                          <form action="{{route('quizzes.duplicate', $quiz->id)}}" method="POST" id="duplicate_quiz_{{ $quiz->id }}">
                            @csrf
                            <a onclick="duplicate( {{$quiz->id}} )" class="tooltip">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-purple-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" />
                            </svg>
                            <span class="tooltip-text">Duplicate</span>
                            </a>
                          </form>
                            <a data-quiz_id="{{$quiz->id}}" class="confirmQuiz tooltip">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg>
                            <span class="tooltip-text">Delete</span>
                            </a>
                        </td>
                      </tr>
                                  
                  @endif
                @endforeach
              </tbody>

              <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
              <script>
                  $(document).ready(function() {
                      // Function to close the modal
                      function closeModal() {
                          $('#confirmationModal').addClass('hidden');
                          $('#unpublishModal').addClass('hidden');
                      }

                      // Click event for the close button
                      $('[data-modal-hide="popup-modal"]').on('click', function() {
                          closeModal();
                      });
                  });
              </script>

              
            <form action="{{ route('quizzes.publish', $quiz->id) }}" id="publishForm" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div id="confirmationModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
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
                              <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Are you sure you want to publish this quiz? Quiz cannot be edited once published</h3>
                              <input type="hidden" id="publish_date" name="publish_date" value="">
                              <button id="yesButton" type="submit" form="publishForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                  Yes, I'm sure
                              </button>
                              <button id="noButton" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                  No, cancel
                              </button>
                          </div>
                      </div>
                  </div>
              </div>

            </form>

            <form action="{{ route('quizzes.unpublish', $quiz->id) }}" id="unpublishForm" method="POST" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div id="unpublishModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center  w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
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
                              <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Do you want to unpublish this quiz?</h3>
                              <button id="yesButton1" type="submit" form="unpublishForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                  Yes, I'm sure
                                </button>
                                <button id="noButton1" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                No, cancel
                              </button>
                          </div>
                      </div>
                  </div>
              </div>
            </form>
            
            <!-- delete quiz modal -->
            <form action="{{ route('quizzes.destroy', $quiz->id)}}" id="removeQuizForm" method="POST" enctype="multipart/form-data">
               @csrf
               @method('PUT')
               <div id="removeQuizModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
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
                                   <p class="text-m font-normal text-gray-500 mb-2 dark:text-gray-400">This quiz will not be accessible anywhere</p>
                                   <p class="text-m font-normal text-gray-500 mb-4 dark:text-gray-400">Sure want to remove?</p>
                                   <button id="removeQuiz" type="button" form="removeQuizForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
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

          </table>
        @else
        <p class="text-center">No quiz created for this account, Create New Quiz.</p>
        @endif
        
        {{$quizzes->links('pagination.custom')}}

  </div>
</div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Handle click event on the anchor element
        $('a[data-modal-toggle="popup-modal"]').click(function (e) {
            e.preventDefault(); // Prevent default anchor behavior
            // Get the modal target from data attribute
            var modalTarget = $(this).data('modal-target');
            // Show the modal corresponding to the target
            $('#' + modalTarget).show(); // Assuming your modal has an ID matching the modal target
        });
    });
</script>

<script>
  
  document.addEventListener('DOMContentLoaded', function () {
    const yesButton = document.getElementById('yesButton');
    const noButton = document.getElementById('noButton');
    const modal = document.getElementById('confirmationModal');
    let quizId = null;


    // if(publishButton != null)
    
      // Open modal and set quiz ID
      $('.statusConfirm').on('click', function (event) {
          quizId = $(this).data('quiz_id');
          modal.classList.remove('hidden');
          // $('#confirmationModal').show();
          console.log('Quiz ID set:', quizId);
      });

       // Handle Yes button click
        yesButton.addEventListener('click', function () {
          if (quizId) {

            let currentDate = new Date(); 
            let formattedDate = currentDate.toISOString().split('T')[0]; 

            // Set the value of the hidden input field with ID 'publish_date'
            document.getElementById('publish_date').value = formattedDate;

              let url ='{{route("quizzes.publish", "id")}}'.replace('id', quizId);
              console.log(url);
              $('#publishForm').attr('action', url);
              $('#publishForm').submit();
              console.log('Quiz ID:', quizId);
  
              const statusInput = document.getElementById(`status_${quizId}`);
              console.log('Status input:', statusInput);
            } else {
              console.error('Quiz ID not set');
            }
        });
  

        // Handle No button click
        noButton.addEventListener('click', function () {
            modal.classList.add('hidden');
        });
  });

  document.addEventListener('DOMContentLoaded', function () {
    const yesButton1 = document.getElementById('yesButton1');
    const noButton1 = document.getElementById('noButton1');
    const modal = document.getElementById('unpublishModal');
    let quizId = null;


    // if(publishButton != null)
    
      // Open modal and set quiz ID
      $('.statusConfirm1').on('click', function (event) {
          quizId = $(this).data('quiz_id');
          modal.classList.remove('hidden');
          // $('#confirmationModal').show();
          console.log('Quiz ID set:', quizId);
      });

       // Handle Yes button click
        yesButton1.addEventListener('click', function () {
          if (quizId) {
              let url ='{{route("quizzes.unpublish", "id")}}'.replace('id', quizId);
              console.log(url);
              $('#unpublishForm').attr('action', url);
              $('#unpublishForm').submit();
              console.log('Quiz ID:', quizId);
  
              const statusInput = document.getElementById(`status_${quizId}`);
              console.log('Status input:', statusInput);
            } else {
              console.error('Quiz ID not set');
            }
        });
  

        // Handle No button click
        noButton1.addEventListener('click', function () {
            modal.classList.add('hidden');
        });
  });
      

</script>  

<script>
  var modal = $('#removeQuizModal');
        let quizId = null;

        $('.confirmQuiz').on('click', function(){
            quizId = $(this).data('quiz_id');
            modal.removeClass('hidden');
        });

        $('#removeQuiz').on('click', function(){
            if(quizId)
            {
                let url = '{{route("quizzes.destroy", ":id")}}'.replace(":id", quizId);
                $('#removeQuizForm').attr('action', url);
                $('#removeQuizForm').submit();
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

    function duplicate(quizId) {

            var form = document.getElementById('duplicate_quiz_' + quizId);
            if (form) {
                form.submit(); 
            } else {
                console.error("Form not found");
            }
    }

    //close button
    document.addEventListener("DOMContentLoaded", function() {
    const closeButton = document.querySelector("[data-dismiss-target='#alert']");

    if (closeButton) {
      console.log('click');
      $('#closeButton').on('click', function (event) {
        // closeButton.addEventListener("click", function() {
            const alert = document.querySelector("#alert");
            if (alert) {
                alert.classList.add("hidden");
            }
        });
    }
});
</script>

@endsection
