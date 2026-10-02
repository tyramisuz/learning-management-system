@extends('outline')

@section('content')

<style>
    .answered-tab{
        background-color: #4CAF50;
        color: #fff;
    }
    #alert {
        transition: opacity 0.5s ease-out;
    }
    .flag-icon {
    fill: transparent; /* Initial state, not clicked */
    }

    .flag-icon.clicked {
        fill: yellow; /* Filled with yellow color when clicked */
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

@if ($error = Session::get('error'))
<div id="alert" class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
    <div class="ms-3 text-sm font-medium">
      {{$error}}
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

<title>Show Quiz</title>

<form id="quiz-form" action="{{ isset($groupId) ? route('responses.store.group', ['quizId' => $quiz->id, 'userId' => auth()->user()->id, 'groupId' => $groupId]) : route('responses.store', ['quizId' => $quiz->id, 'userId' => auth()->user()->id]) }}"  method="POST" enctype="multipart/form-data">
    @csrf
    
    <input type="hidden" name="timeTaken" id="timeTaken" value="">

    <div id="quiz-container" class="flex flex-col items-center justify-center min-h-screen bg-gray-100 overflow-hidden"> 
        @for($i = 1; $i <= count($questions); $i++)
        <div class="flex justify-center w-full">
            <div id="content{{ $i }}" class="flex-grow w-full max-w-4xl p-6 bg-gray-100 rounded-lg shadow-md mx-auto tab-content {{ $i == 1 ? 'block' : 'hidden' }} overflow-hidden">
                <label for="questionNumber" class="block text-xl mb-4 font-medium text-gray-700">Question {{ $i }}</label>        
                
                @if($questions[$i-1]->media)
                    @php 
                        $mediaPath = $questions[$i-1]->media;
                        $extension = pathinfo($mediaPath, PATHINFO_EXTENSION)
                    @endphp
                    <div class="flex items-center justify-center">
                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                            <!-- Display Image -->
                            <img src="{{ Storage::url($mediaPath) }}" alt="Image" class="flex w-64 py-2 px-2 h-64 rounded-lg items-center justify-center">
                        @elseif(in_array($extension, ['mp4', 'webm', 'ogg']))
                            <!-- Display Video -->
                            <video controls class="flex w-full h-64 py-2 px-2 items-center justify-center rounded-lg">
                                <source src="{{ Storage::url($mediaPath) }}" type="video/{{ $extension }}">
                                Your browser does not support the video tag.
                            </video>
                        @elseif(in_array($extension, ['mp3', 'wav', 'ogg']))
                            <!-- Display Audio -->
                            <audio controls class="flex w-64 rounded-lg items-center justify-center">
                                <source src="{{ Storage::url($mediaPath) }}" type="audio/{{ $extension }}">
                                Your browser does not support the audio element.
                            </audio>
                        @endif
                    </div>
                @endif
                
                <!-- Question Text -->
                <div class="mb-4">
                    <div class="sm:col-span-4">
                        <label for="questionType" class="block text-sm font-medium text-gray-700">Question</label>
                        <div class="mt-2 col-span-2">
                            <div id="questionContainer" class="flex rounded-md bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                <span id="questionText{{ $i }}"  class="flex-1 rounded-lg border-0 bg-transparent py-2 px-3 w-full text-gray-900 focus:ring-0 sm:text-base sm:leading-10" placeholder="" readonly disable>{{ $questions[$i-1]->question }}</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Hidden Inputs for Quiz and Question IDs -->
                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                <input type="hidden" name="question_id[]" value="{{ $questions[$i-1]->id }}">

                    <!-- Answer Options -->
                    <div class="sm:col-span-4" data-correct-answers="{{ $questions[$i-1]->totalCorrect }}">
                        <label for="" class="block text-sm font-medium text-gray-700">Answer Options</label>
                        @if($questions[$i-1]->totalCorrect > 1)
                        <p class="hint-text italic font-semibold mt-4 text-red-500">Please select {{ $questions[$i-1]->totalCorrect }} answers.</p>
                        @endif
                        <div class="grid grid-cols-2 gap-4">
                        @foreach($questions[$i-1]->answer as $index => $answer)
                            <div class="mt-3 relative">
                                @if (filter_var($answer, FILTER_VALIDATE_URL) || Storage::disk()->exists($answer)) 
                                    <div id="answer-option_{{$i}}" class="flex rounded-lg bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-green-500 answer-option" id="textarea-{{ $loop->index }}" data-answer="{{ $answer }}" data-tab-id="tab{{ $i }}">
                                        <img src="{{ Storage::url($answer) }}" alt="Answer Image" style="width: 150px; height: 200px;" class="flex-1 py-2 px-3 relative">
                                    </div>
                                @else
                                    <div id="answer-option_{{$i}}" class="flex rounded-lg bg-white ring-1 ring-inset ring-gray-300 focus-within:ring-2 focus-within:ring-inset focus-within:ring-green-500 answer-option" id="textarea-{{ $loop->index }}" data-answer="{{ $answer }}" data-tab-id="tab{{ $i }}">
                                        <span type="text"  class=" flex-1 rounded-lg border-0 bg-transparent py-2 px-3 w-full text-gray-900 focus:ring-0 sm:text-base sm:leading-10 relative answer-textarea" readonly>{{ $answer }}</span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                        </div>
                        <input type="hidden" id="selected-answer-{{ $questions[$i-1]->id }}" name="stuAns[{{ $questions[$i-1]->id }}][]" value="">
                    </div>

                <!-- Navigation Buttons -->
                <div class="flex items-center justify-end mt-6">
                    <div class="sm:col-span-4">
                        <div class="flex items-center justify-end gap-x-6">
                            <button type="button" id="review-checkbox-{{ $questions[$i-1]->id }}" class="review-checkbox ml-2 tooltip" data-tab2-id="tab{{$i}}" data-question-id="{{ $questions[$i-1]->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-yellow-500 font-extrabold flag-icon">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3v1.5M3 21v-6m0 0 2.77-.693a9 9 0 0 1 6.208.682l.108.054a9 9 0 0 0 6.086.71l3.114-.732a48.524 48.524 0 0 1-.005-10.499l-3.11.732a9 9 0 0 1-6.085-.711l-.108-.054a9 9 0 0 0-6.208-.682L3 4.5M3 15V4.5" />
                                </svg>
                                @if(count($questions) > 1)
                                <span class="tooltip-text">Flag this question</span>
                                @endif
                            </button>

                            @if($i == 1 && $i < count($questions))
                                <button type="button" class="block rounded-md bg-purple-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-purple-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 next-button">
                                    NEXT
                                </button>
                            @elseif($i > 1 && $i < count($questions))
                                <button type="button" class="block rounded-md bg-purple-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-purple-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 prev-button">
                                    PREVIOUS
                                </button>
                                <button type="button" class="block rounded-md bg-purple-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-purple-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 next-button">
                                    NEXT
                                </button>
                            @elseif($i > 1 && $i == count($questions))
                                <button type="button" class="block rounded-md bg-purple-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-purple-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-purple-500 prev-button">
                                    PREVIOUS
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>

</form>

    <!-- modal -->
    <div id="limitmodal" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed flex z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-red-400 w-12 h-12 dark:text-red-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Choose only 1 answer</h3>
                    <button id="modal-okay-btn" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-red-400 hover:bg-red-400 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700">Okay</button>
                </div>
            </div>
        </div>
    </div>
        
    <!-- The Modal -->
    <div id="confirmationModal" class="fixed inset-0 z-50 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
            <span class="close text-gray-500 hover:text-gray-900 cursor-pointer float-right">&times;</span>
            <h5 class="text-lg font-semibold mb-4">Confirmation</h5>
            <p id="submit-message" class="mb-6">Do you want to submit? You have <span class="font-bold text-red-600" id="time-left"></span> left.</p>
            <div class="flex justify-end space-x-4">
                <button id="noButton" type="button" class="bg-gray-400 text-white px-4 py-2 rounded-md">No</button>
                <button id="yesButton" type ="button" class="bg-red-500 text-white px-4 py-2 rounded-md">Yes</button>
            </div>
        </div>
    </div>
    

<!-- highlighted -->
<!-- <script>
    $(document).ready(function() {
        $('.sm\\:col-span-4').each(function() {
            var $questionContainer = $(this);
            var maxCorrectAnswers = parseInt($questionContainer.data('correct-answers'));
            var selectedAnswers = [];

            $questionContainer.find('.answer-option').on('click', function() {
                var $this = $(this);
                var answer = $this.data('answer');

                if (maxCorrectAnswers === 1) {
                    // Handle single-answer questions
                    $questionContainer.find('.answer-option').removeClass('bg-green-500 text-white').addClass('bg-white text-gray-900');
                    selectedAnswers = [answer]; // Only one answer can be selected
                    $this.addClass('bg-green-500 text-white');
                } else {
                    // Handle multiple-answer questions
                    if ($this.hasClass('bg-green-500')) {
                        // Deselect the answer
                        $this.removeClass('bg-green-500 text-white').addClass('bg-white text-gray-900');
                        selectedAnswers = selectedAnswers.filter(function(item) {
                            return item !== answer;
                        });
                    } else {
                        if (selectedAnswers.length < maxCorrectAnswers) {
                            $this.removeClass('bg-white text-gray-900').addClass('bg-green-500 text-white');
                            selectedAnswers.push(answer);
                        }
                    }
                }

                // Update the hidden input with selected answers
                var $selectedAnswerInput = $questionContainer.find('input[type="hidden"]');
                $selectedAnswerInput.val(selectedAnswers.join(','));
            });
        });
    });
</script> -->

<!-- single  -->
<script>
    $(document).ready(function () {
        var selectedAnswers = {}; 

        var selectedClass = 'bg-green-500 text-white border-green-700 ring-green-500';

        $('[id^=answer-option_]').on('click', function() {
            var $this = $(this);

            var tabId = $this.closest('.tab-content').attr('id').replace('content', '');
            var $questionContainer = $this.closest('.sm\\:col-span-4');
            var questionId = $questionContainer.find('input[type="hidden"]').attr('id').split('-')[2];
            var selectedAnswer = $this.data('answer');
            var maxCorrectAnswers = parseInt($questionContainer.data('correct-answers'));

            if (!selectedAnswers[tabId]) {
                selectedAnswers[tabId] = [];
            }

            if (maxCorrectAnswers === 1) {
                console.log('single');
                var index = selectedAnswers[tabId].indexOf(selectedAnswer);

                if (index > -1) {
                    // Option is already selected, remove it
                    selectedAnswers[tabId].splice(index, 1);
                    $this.removeClass(selectedClass);
                } else {
                    // Remove class from all options and add to the clicked option
                    $('[id^=answer-option_]').removeClass(selectedClass); 
                    $this.addClass(selectedClass);
                    selectedAnswers[tabId] = [selectedAnswer];
                    // console.log(selectedAnswers[tabId]);
                    // Apply the selected class to all selected answers for the current question
                    $('#content' + tabId).find('[id^=answer-option_]').each(function() {
                        var answer = $(this).data('answer');
                        if (selectedAnswers[tabId].includes(answer)) {
                            $(this).addClass(selectedClass);
                        } else {
                            $(this).removeClass(selectedClass);
                        }
                    });
                }
            } 
            else if(maxCorrectAnswers > 1){
                console.log('multi');
                var index = selectedAnswers[tabId].indexOf(selectedAnswer);

                if (index > -1) {
                    // Option is already selected, remove it
                    selectedAnswers[tabId].splice(index, 1);
                    $this.removeClass(selectedClass);
                } else {
                    // Option is not selected
                    if (selectedAnswers[tabId].length < maxCorrectAnswers) {
                        selectedAnswers[tabId].push(selectedAnswer);
                        // console.log(selectedAnswers[tabId]);
                        $this.addClass(selectedClass);
                    }
                }
                    
                    // Apply the selected class to all selected answers for the current question
                    $('#content' + tabId).find('[id^=answer-option_]').each(function() {
                        var answer = $(this).data('answer');
                        if (selectedAnswers[tabId].includes(answer)) {
                            $(this).addClass(selectedClass);
                        } else {
                            $(this).removeClass(selectedClass);
                        }
                    });
            }


            $('#selected-answer-' + questionId).val(selectedAnswers[tabId].join(','));
        });

        $('.tab-link').on('click', function() {
        var tabId = $(this).data('tab');
        if (selectedAnswers[tabId]) {
            // Highlight the selected answer option(s) in the current tab
            $('#content' + tabId).find('[id^=answer-option_]').each(function() {
                var answer = $(this).data('answer');
                if (selectedAnswers[tabId].includes(answer)) {
                    $(this).addClass(selectedClass);
                } else {
                    $(this).removeClass(selectedClass);
                }
            });
        }
         });
    });

</script>

<!-- status confirm -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
                // Get the modal
                var modal = document.getElementById("confirmationModal");
            
                // Get the button that opens the modal
                var btn = document.getElementById("statusConfirm");
            
                // Get the <span> element that closes the modal
                var span = document.getElementsByClassName("close")[0];
            
                // Get the "Yes" and "No" buttons
                var yesButton = document.getElementById("yesButton");
                var noButton = document.getElementById("noButton");
            
                // When the user clicks the button, open the modal
                btn.onclick = function() {
                    modal.classList.remove("hidden");
                }
            
                // When the user clicks on <span> (x), close the modal
                span.onclick = function() {
                    modal.classList.add("hidden");
                }
            
                // When the user clicks "No", close the modal
                noButton.onclick = function() {
                    console.log('eeee');
                    modal.classList.add("hidden");
                    // window.location.href = '';
                }
                
                @php
                    $totalDuration = ($quiz->duration * 60);
                @endphp
                const totalDuration = {{$totalDuration}}; 
                console.log('duration' ,totalDuration);
                
        yesButton.onclick = function(event) {
            event.preventDefault(); 
            console.log('click');
            // console.log(startTime);

                const timeTaken = Math.floor(Date.now() / 1000) - startTime;
                console.log('Time taken:', timeTaken); 

                const timeinminute = (timeTaken / 60);

                const whole = parseInt(timeinminute);
                console.log(whole);

                document.getElementById('timeTaken').value = whole;

            document.getElementById('quiz-form').submit();
            document.getElementById('modal').classList.add("hidden");
        }
                
            window.onclick = function(event) {
                if (event.target == modal) {
                    modal.classList.add("hidden");
                }
            }


                function updateTimeLeft() {
                  
                    const timeTaken = Math.floor(Date.now() / 1000) - startTime;
                    const timeLeft = totalDuration - timeTaken;

                    if (timeLeft < 0) {
                        document.getElementById('time-left').textContent;
                        return;
                    }

                    // Calculate hours, minutes, and seconds
                    const hours = Math.floor(timeLeft / 3600);
                    const minutes = Math.floor((timeLeft % 3600) / 60);
                    const seconds = timeLeft % 60;

                    // Create a string for the time left
                    let timeString = '';
                    if (hours > 0) {
                        timeString += hours + ' hour' + (hours > 1 ? 's' : '') + ' ';
                    }
                    if (minutes > 0 || hours > 0) {
                        timeString += minutes + ' minute' + (minutes > 1 ? 's' : '') + ' ';
                    }
                    timeString += seconds + ' second' + (seconds > 1 ? 's' : '');

                    // Update the time-left span content
                    document.getElementById('time-left').textContent = timeString;
                }

                updateTimeLeft();

                setInterval(updateTimeLeft, 1000);

                updateTimeLeft();

                setInterval(updateTimeLeft, 1000);
    });
</script>

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

<script>
    //tabs
    document.addEventListener('DOMContentLoaded', () => {
        // Hide all tab contents except the first one
        document.querySelectorAll('.tab-content').forEach((content, index) => {
            if (index !== 0) {
                content.style.display = 'none';
            }
        });

    });

    document.querySelectorAll('#tabs a').forEach(tab => {
        tab.addEventListener('click', (e) => {
            e.preventDefault();
            let tabId = e.target.getAttribute('href').substr(1);

            document.querySelectorAll('.tab-content').forEach(content => {
                content.style.display = 'none';
            });

            document.getElementById(tabId).style.display = 'block';
        });
    });
    
    //next button
    $(document).ready(function() {
    var currentIndex = 0;
    var totalTabs = $('.tab-link').length;

    // Show initial tab content
    $('.tab-content').hide();
    $('#content1').show(); // Assuming the first tab's content has an ID of 'content1'

    $('.next-button').on('click', function() {
        navigateTab(1);
    });

    $('.prev-button').on('click', function() {
        navigateTab(-1);
    });

    function navigateTab(direction) {
        $('#content' + (currentIndex + 1)).hide();

        currentIndex = (currentIndex + direction + totalTabs) % totalTabs;

        $('#content' + (currentIndex + 1)).show();

        updateActiveTab();
    }

    //track current question
    function updateActiveTab() {
        $('.active').removeClass('active-tab'); // Remove active-tab class from all tabs
        $('#tabactive' + (currentIndex + 1)).addClass('active-tab'); // Add active-tab class to current tab

        $('.tab-link').on('click', function() {
        var tab = $(this).attr('data-tab'); 
        console.log(tab);
        $('.active').removeClass('active-tab');
        $('#tabactive' + (tab)).addClass('active-tab'); 
    });
    }

    // Initial active tab highlighting
    updateActiveTab();
    });

</script>
@endsection

        