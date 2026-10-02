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

<title>Questions</title>

<div class="px-4 sm:px-6 md:px7 lg:px-8"> 
<div class="mx-auto max-w-7xl"> 

    <div class="space-y-15"> 
        <div class="px-4 sm:px-6 py-6 md:px7 lg:px-8"> 
        <h2 class="text-2xl mt-2 font-bold leading-7 text-grey-900">List Questions</h2>
        </div>

        <div class="px-4 sm:px-6 md:px7 lg:px-8"> 
            <div class="mx-auto max-w-7xl"> 
            <div class="relative flex justify-between items-center">
                <h2 class="text-xl font-bold leading-7 text-gray-900">Quiz: {{$quiz->title}}</h2>
                <div class=" bg-gray-100 p-2 px-4 rounded-lg">
                    <h2 class="total-points text-l font-bold text-gray-800">Total Points</h2>
                    <p class="text-xl font-bold text-green-500">{{ $totalpoint }}</p>
                </div>
            </div>

                @if(($quiz->questions->isNotEmpty() && $quiz->status != ('publish')) || (auth()->user()->id == 1))
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-900">
                            <thead class="text-xs text-black uppercase bg-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Question
                                    </th>
                                    <!-- <th scope="col" class="px-6 py-3">
                                        Media
                                    </th> -->
                                    <th scope="col" class="px-6 py-3">
                                        Points
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $question)
                                <tr class="odd:bg-gray-200 even:bg-gray-300 border-b">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ ++$i }}
                                    </td>
                                    <td class="px-6 py-4">
                                    {{ $question->question }}
                                    </td>
                                    <!-- <td class="px-6 py-4">
                                    @if($question->media != null)
                                    <img src="{{ asset('storage/' . $question->media) }}" class="rounded-lg w-24 h-24 object-fill" alt="media">
                                    @else
                                    <p>N/A</P>
                                    @endif
                                    </td> -->
                                    <td class="px-6 py-4">
                                        {{ $question->point}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $question->type }}
                                    </td>
                                    <td class="px-6 py-4 flex">
                                    <a href="{{route('questions.edit', $question->id)}}" class="tooltip">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-500">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                    <span class="tooltip-text">Edit</span>
                                    </a>
                                        <a data-question_id="{{ $question->id }}" class=" confirmques tooltip">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-500">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                        </svg>
                                            <span class="tooltip-text">Delete</span>
                                        </a>
                                    </form>
                                    </td>
                                </tr>
                                    
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$questions->links('pagination.custom')}}
                    
                    <div class="mt-4 flex justify-end"> 
                        <div class="sm:ml-16 sm:mt-0 sm:flex-none">
                            @if(auth()->user()->role == 'user')
                            <div class="mt-4 sm:ml-16 sm:mt-0 flex gap-2">
                                <a type="button" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" href="{{ route('quizzes.index') }}">Back</a>
                            </div>
                            @else 
                            <div class="mt-4 sm:ml-16 sm:mt-0 flex gap-2">
                                <a type="button" class="block rounded-md bg-indigo-500 px-3 py-2.5 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" href="{{route('admin.indexQuiz', $creatorId)}}">Back</a>
                            </div>
                            @endif
                        </div>               
                    </div>

                    @elseif($quiz->questions->isNotEmpty() && $quiz->status == ('publish'))
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-900">
                            <thead class="text-xs text-black uppercase bg-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        No
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Question
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Points
                                    </th>
                                    <th scope="col" class="px-6 py-3">
                                        Type
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($questions as $question)
                                <tr class="odd:bg-gray-200 even:bg-gray-300 border-b">
                                    <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap">
                                    {{ ++$i }}
                                    </td>
                                    <td class="px-6 py-4">
                                    {{ $question->question }}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $question->point}}
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $question->type }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{$questions->links('pagination.custom')}}
                    <div class="mt-2 flex justify-end"> 
                        <div class="mr-2 items-center sm:flex sm:items-center">
                            <div class="sm:ml-16 sm:mt-0 sm:flex-none">
                            <a type="button" class="block rounded-md bg-indigo-500 px-3 py-2.5 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" href="{{ route('quizzes.index') }}">Back</a>
                            </div>
                        </div>
                    </div>
                    
                    @else
                    <p class="text-center">No questions available for this quiz.</p>
                @endif

                <!-- delete quiz modal -->
         <form action="{{ route('questions.destroy', $question->id)}}" id="removeQuestionForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('DELETE')
            <div id="removeQuestionModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
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
                                <p class="text-m font-normal text-gray-500 mb-2 dark:text-gray-400">You cannot undo your action</p>
                                <p class="text-m font-normal text-gray-500 mb-4 dark:text-gray-400">Sure want to remove?</p>
                                <button id="removeQues" type="button" form="removeQuestionForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
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
            </div>
        </div>
    </div>

</div>
</div>

<script>
        var modal = $('#removeQuestionModal');
        let questionId = null;

        $('.confirmques').on('click', function(){
            quesId = $(this).data('question_id');
            modal.removeClass('hidden');
        });

        $('#removeQues').on('click', function(){
            if(quesId)
            {
                let url = '{{route("questions.destroy", ":id")}}'.replace(":id", quesId);
                $('#removeQuestionForm').attr('action', url);
                $('#removeQuestionForm').submit();
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

    function toggleClockDropdown() {
    var dropdown = document.getElementById("clockDropdown");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    // function selectHour(hour) {
    // document.getElementById("duration_hours").value = hour;
    // document.getElementById("hoursButton").textContent = hour + " Hours";
    // toggleClockDropdown(); // Close the hours dropdown after selection
    // }

    function toggleClockDropdown2() {
    var dropdown2 = document.getElementById("clockDropdown2");
    dropdown2.style.display = dropdown2.style.display === "block" ? "none" : "block";
    }

    // function selectMinute(minute) {
    // document.getElementById("duration_minutes").value = minute;
    // document.getElementById("minutesButton").textContent = minute + " Minutes";
    // toggleClockDropdown2(); // Close the minutes dropdown after selection
    // }

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


   
    // document.addEventListener('DOMContentLoaded', function () {
    //     var openModalBtn = document.getElementById('openModalBtn');
    //     var questionModal = document.getElementById('questionModal');
    //     var closeModalBtn = document.getElementById('closeModalBtn');
    //     var close = document.getElementById('close');
    //     var createQuestionBtn = document.getElementById('createQuestionBtn');
    //     var questionTypeSelect = document.getElementById('questionType');
    //     var createdQuestionsContainer = document.getElementById('createdQuestions');

    //     openModalBtn.addEventListener('click', function () {
    //         questionModal.classList.remove('hidden');
    //     });

    //     closeModalBtn.addEventListener('click', function () {
    //         questionModal.classList.add('hidden');
    //     });

    //     close.addEventListener('click', function(){
    //         questionModal.classList.add('hidden');
    //     });

    //     createQuestionBtn.addEventListener('click', function () {
    //         var questionType = questionTypeSelect.value;
    //         var questionForm = generateQuestionForm(questionType);
    //         createdQuestionsContainer.appendChild(questionForm);
    //         questionModal.classList.add('hidden');
    //     });

    //     function generateQuestionForm(questionType) {
    //         var form = document.createElement('form');
    //         form.classList.add('mt-4', 'border', 'border-gray-300', 'p-4', 'rounded-md');

    //         // Create form elements based on question type
    //         if (questionType === 'Multiple-questions') {
    //             var questionLabel = document.createElement('label');
    //             questionLabel.innerText = 'Question:';
    //             form.appendChild(questionLabel);

    //             var questionInput = document.createElement('input');
    //             questionInput.setAttribute('type', 'text');
    //             questionInput.setAttribute('name', 'question');
    //             questionInput.classList.add('block', 'mt-1', 'w-full', 'border-gray-300', 'rounded-md', 'shadow-sm', 'focus:border-indigo-500', 'focus:ring-indigo-500');
    //             form.appendChild(questionInput);

    //             // Add more elements for multiple-choice questions
    //         } else if (questionType === 'Openended') {
    //             var questionLabel = document.createElement('label');
    //             questionLabel.innerText = 'Question:';
    //             form.appendChild(questionLabel);

    //             var questionTextarea = document.createElement('textarea');
    //             questionTextarea.setAttribute('name', 'question');
    //             questionTextarea.classList.add('block', 'mt-1', 'w-full', 'border-gray-300', 'rounded-md', 'shadow-sm', 'focus:border-indigo-500', 'focus:ring-indigo-500');
    //             form.appendChild(questionTextarea);

    //             // Add more elements for open-ended questions
    //         }

    //         // Create and append a submit button
    //         var submitBtn = document.createElement('button');
    //         submitBtn.setAttribute('type', 'submit');
    //         submitBtn.classList.add('mt-2', 'px-4', 'py-2', 'bg-blue-600', 'text-white', 'rounded-md', 'hover:bg-blue-700', 'focus:outline-none', 'focus:ring-2', 'focus:ring-offset-2', 'focus:ring-blue-500');
    //         submitBtn.innerText = 'Save';
    //         form.appendChild(submitBtn);

    //         return form;
    //     }
    // });

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