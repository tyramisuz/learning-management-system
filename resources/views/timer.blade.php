<script>
     //timer
     function countdown(quizId) {
    const countdownElements = document.querySelectorAll('.countdown');
    const durationHours = document.getElementById('durationHours').value;
    const durationMinutes = document.getElementById('durationMinutes').value;

    const totalSeconds = parseInt(durationHours) * 3600 + parseInt(durationMinutes) * 60;
    const alertThresholdSeconds = 30; // Threshold time for showing the alert modal
    const hideModalAfterSeconds = 5; // Time to hide the modal after showing (in seconds)

    // Generate a unique key for each quiz attempt
    const countdownKey = `countdownTime_${quizId}`;

    let startTime;
    let secondsLeft;

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

        const okay = document.getElementById('okay');
        okay.addEventListener('click', function() {

            const form = document.getElementById('quiz-form');
    
            form.submit();
            window.history.back();
        });

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