<div class="fixed left-0 top-0 w-64 h-screen overflow-y-auto bg-green-200 p-4 z-50 quiz-menu overflow-y-auto transition-transform">

    
    <div class="container mx-auto px-2">
        <!-- Quiz Title and Duration -->
        <h1 class="text-xl font-bold mt-4 leading-7 mb-5 text-gray-900">{{ $quiz->title }}</h1>
        
        @php
        $hours = floor($quiz->duration / 60);
        $minutes = $quiz->duration % 60;
        @endphp
        
        <h2 class="text-lg font-semibold text-gray-900">Time Remaining</h2>
        <div class="flex gap-5 mb-5">
            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                <span class="countdown font-mono text-4xl">{{$hours}}</span>
                hours
            </div> 
            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                <span class="countdown font-mono text-4xl">{{$minutes}}</span>
                min
            </div> 
            <div class="flex flex-col p-2 bg-neutral rounded-box text-neutral-content">
                <span class="countdown font-mono text-4xl">00</span>
                sec
            </div>
        </div>

        <!-- Hidden Inputs for Quiz Data -->
        <input type="hidden" id="durationHours" value="{{ $hours }}">
        <input type="hidden" id="durationMinutes" value="{{ $minutes }}">
        <input type="hidden" id="quizId" value="{{ $quiz->id }}">
        
        <!-- Tabs Container -->
        <div id="tabs-container" class="flex flex-wrap gap-2">
            @include('tabs')
        </div>

        <!-- Submit Button -->
        <div class="mt-40">
                <input type="hidden" name="previous_url" value="{{ url()->previous() }}">
                <button type="button" id="statusConfirm" class="block w-full rounded-md bg-indigo-500 px-4 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">
                    Submit
                </button>
        </div>

    </div>

                        <li class="-mx-6 mt-auto">
                            <a href="#" class="flex items-center gap-x-4 px-6 py-3 text-sm font-semibold leading-6 text-black hover:bg-gray-300">
                            @if (Auth::user()->image)
                            <img class="h-8 w-8 rounded-full bg-indigo-700" src="{{ Storage::url(Auth::user()->image) }}"  /> 
                            @else
                            <img class="h-8 w-8 rounded-full bg-indigo-700" src="/images/default.jpeg" alt="">
                            @endif
                              <span class="sr-only">Your profile</span>
                              <span aria-hidden="true">{{Auth::user()->name}}</span>
                            </a>
                        </li>

            <!--time alert modal -->
            <div id="timealert" tabindex="-1" class="hidden fixed top-0 right-0 flex z-50 justify-center items-center">
                <div class="relative p-4 w-64 max-h-56">
                    <div class="relative bg-blue-300 rounded-lg shadow">
                        <div class="p-4 md:p-5 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Time remaining is less than 30 seconds!</h3>
                        </div>
                    </div>
                </div>
            </div>

            <!-- time out modal -->
            <!-- Modal Timeout Alert -->
            <div id="timeout" class="hidden fixed top-0 inset-x-0 flex z-50 flex justify-center items-center">
                <!-- Overlay -->
                <div class="fixed inset-0 bg-black opacity-50"></div>

                <!-- Modal Content -->
                <div class="relative p-4 sm:px-0 max-h-full">
                    <div class="relative bg-white rounded-lg shadow">
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-red-400 w-12 h-12 dark:text-red-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Time Out! Press Ok to submit.</h3>
                            <button id="yesButton1" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-red-400 hover:bg-red-400 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700">Ok</button>
                        </div>
                    </div>
                </div>
            </div>
</div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden quiz-overlay"></div>


<script>
     //timer
     
        let startTime;
        let secondsLeft;
        
     function countdown(quizId) {
        const countdownElements = document.querySelectorAll('.countdown');
        const durationHours = document.getElementById('durationHours').value;
        const durationMinutes = document.getElementById('durationMinutes').value;

        const totalSeconds = parseInt(durationHours) * 3600 + parseInt(durationMinutes) * 60;
        const alertThresholdSeconds = 30; // Threshold time for showing the alert modal
        const hideModalAfterSeconds = 5; // Time to hide the modal after showing (in seconds)

        // Generate a unique key for each quiz attempt
        const countdownKey = `countdownTime_${quizId}`;


        // Check if countdown data exists in sessionStorage for this quiz
        if (sessionStorage.getItem(countdownKey)) {
            const storedData = JSON.parse(sessionStorage.getItem(countdownKey));
            startTime = storedData.startTime;
            const elapsedTime = Math.floor(Date.now() / 1000) - startTime;
            secondsLeft = Math.max(0, totalSeconds - elapsedTime);
        } else {
            // Start a new countdown for this quiz
            startTime = Math.floor(Date.now() / 1000);
            secondsLeft = totalSeconds;
        }

        const interval = setInterval(() => {
            if (secondsLeft == alertThresholdSeconds && !isModalVisible) {
                showCountdownAlert();
                setTimeout(hideCountdownAlert, hideModalAfterSeconds * 1000);
            }

            if (secondsLeft === 0) {
                clearInterval(interval);
                // Handle countdown timeout for this quiz
                handleCountdownTimeout(quizId);
                // Clear countdown data from sessionStorage
                sessionStorage.removeItem(countdownKey);
            } else {
                let hoursLeft = Math.floor(secondsLeft / 3600);
                let minutesLeft = Math.floor((secondsLeft % 3600) / 60);
                let secondsLeftAdjusted = secondsLeft % 60;
                secondsLeft--;

                countdownElements[0].textContent = hoursLeft < 10 ? '0' + hoursLeft : hoursLeft;
                countdownElements[1].textContent = minutesLeft < 10 ? '0' + minutesLeft : minutesLeft;
                countdownElements[2].textContent = secondsLeftAdjusted < 10 ? '0' + secondsLeftAdjusted : secondsLeftAdjusted;

                // Update countdown data in sessionStorage for this quiz
                sessionStorage.setItem(countdownKey, JSON.stringify({ startTime }));
            }
        }, 1000);

        // Save the interval ID in sessionStorage to pause the countdown on page exit
        sessionStorage.setItem('countdownInterval', interval);
    }
    
    var yesButton1 = document.getElementById("yesButton1");

    @php
        $totalDuration = ($quiz->duration * 60);
    @endphp
    const totalDuration = {{$totalDuration}}; 
    console.log('duration' ,totalDuration);

    yesButton1.onclick = function(event) {
            event.preventDefault(); 
            console.log('click');

                const timeTaken = totalDuration;

                console.log('Time taken dur:', timeTaken); 

                const timeinminute = (timeTaken / 60);

                const whole = parseInt(timeinminute);
                console.log(whole);

                document.getElementById('timeTaken').value = whole;
            
            // submit timeout
            document.getElementById('quiz-form').submit();
            document.getElementById('modal').classList.add("hidden");
    }

    let isModalVisible = false; 

    function showCountdownAlert() {
        if (!isModalVisible) {
            const modal = document.getElementById('timealert');
            modal.classList.remove('hidden');
            isModalVisible = true;

            setTimeout(hideCountdownAlert, 5000); 
        }
    }

    function hideCountdownAlert() {
        const modal = document.getElementById('timealert');
        console.log('hide');
        modal.classList.add('hidden');
        isModalVisible = false;
    }

    function handleCountdownTimeout(quizId) {
        // Show the timeout modal and handle okay button click
        showTimeoutModal(quizId);
    }

    function showTimeoutModal(quizId) {
        console.log('0');
        const timeoutModal = document.getElementById('timeout');
        timeoutModal.classList.remove('hidden');

        const okayBtn = document.getElementById('modal-okay-btn');
        okayBtn.addEventListener('click', function() {
            window.history.back();
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        const quizId = document.getElementById('quizId').value;
        const intervalId = sessionStorage.getItem('countdownInterval');

        if (intervalId) {
            // If a countdown was previously running, clear the interval
            clearInterval(intervalId);
        }

        countdown(quizId);
    });

    // Pause the countdown and store the interval ID on page exit
    window.addEventListener('beforeunload', () => {
        const intervalId = sessionStorage.getItem('countdownInterval');
        if (intervalId) {
            clearInterval(intervalId);
        }
    });

</script>

<script>

    const quizOverlay = document.querySelector('.quiz-overlay')
    const quizMenu = document.querySelector('.quiz-menu')

    function showModal() {
        document.getElementById('timeout').classList.add('active');
        document.body.style.overflow = 'hidden'; // Prevent scrolling on body
    }

    // Function to hide the modal and overlay
    function hideModal() {
        document.getElementById('timeout').classList.remove('active');
        document.body.style.overflow = ''; // Enable scrolling on body
    }

    // Event listener for the "Ok" button
    document.getElementById('yesButton1').addEventListener('click', function() {
        hideModal();
        // Add logic to submit the form or take appropriate action
    });

</script>
<script src="//unpkg.com/alpinejs" defer></script>

