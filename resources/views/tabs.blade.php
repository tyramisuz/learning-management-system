<!-- Tabs -->
 <div class="mt-2">
    <ul id="tabs" class="flex flex-wrap rounded-lg pt-2 px-1 w-full border-b border-gray-300">
        @for($i = 1; $i <= count($questions); $i++)
            <li id="tabactive{{ $i }}" class="active tab-size relative flex-1 text-center bg-white px-4 text-gray-800 font-semibold py-2 border-t border-r border-l">
                <a id="tab{{ $i }}" href="#content{{ $i }}" class="tab-link" data-content="content{{$i}}" data-tab="{{ $i }}" onclick="{{ $i }}">{{ $i }}</a>
                <div class="circle hidden absolute top-0 right-0 bg-green-500 rounded-full w-4 h-4"></div>
                <div class="circle2 hidden absolute top-0 right-0 bg-yellow-500 rounded-full w-4 h-4"></div>
            </li>
        @endfor
    </ul>
</div>
       
<style>
    .tab-size {
        padding: 2px; /* Adjust the padding as needed */
        width: 30px; /* Adjust the width as needed */
    }

    #tabs {
        max-height: 80px; /* Adjust this value as needed */
    }
    #tabs > li {
        flex: 1 0 auto;
        min-width: calc(100% / {{ count($questions) }}); /* Distribute tabs evenly */
    }
    .circle {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background-color: green;
        position: absolute;
        top: -8px;
        
    }
    .circle2 {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background-color: #FFEB3B;
        position: absolute;
        top: -8px;
        
    }
    .active-tab {
        background-color: #9CA3AF; /* bg-gray-300 */
    }
</style>

<!-- highlight tab -->
<script>
    function switchTab(tabIndex) {
        // Remove 'active-tab' class from all tabs
        const tabs = document.querySelectorAll('.active');
        tabs.forEach(tab => tab.classList.remove('active-tab'));

        // Add 'active-tab' class to the clicked tab
        const tab = document.getElementById('tab' + tabIndex);
        tab.classList.add('active-tab');
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Highlight the initial active tab (first tab)
        const initialTab = document.querySelector('.active');
        initialTab.classList.add('active-tab');
    });
</script>

<script>
    $(document).ready(function () {
        
$('[id^=answer-option_]').on('click', function() {
    var $this = $(this);
    var tabId = $this.data('tab-id');
    var isActive = $this.hasClass('bg-green-500'); // Check if the field is already active
    var $questionContainer = $this.closest('.sm\\:col-span-4');
    var maxCorrectAnswers = parseInt($questionContainer.data('correct-answers'));
    var selectedAnswers = {};
    var selectedAnswer = $this.data('answer');

    // console.log('sini', maxCorrectAnswers);


    // Remove active class from all options within the same question
    $this.closest('.sm\\:col-span-4').find('[id^=answer-option_]').removeClass('bg-green-500 text-white border-green-500 ring-green-500');
    var circle = $('#' + tabId).siblings('.circle');

    if (isActive) {
        // If the clicked option was already active, clear the hidden input and hide the circle
        var questionId = $this.closest('.sm\\:col-span-4').find('input[type="hidden"]').attr('id').split('-')[2];
        $('#selected-answer-' + questionId).val('');

        // Hide the circle
        circle.addClass('hidden');
    } else {
        // if(selectedAnswers > )
        // Add active class to the clicked option if it was not active before
        $this.addClass('bg-green-500 text-white border-green-500 ring-green-500');

        // Store the value of the clicked option in the hidden input
        var selectedAnswer = $this.data('answer');
        var questionId = $this.closest('.sm\\:col-span-4').find('input[type="hidden"]').attr('id').split('-')[2];
        $('#selected-answer-' + questionId).val(selectedAnswer);

        // Show the circle
        circle.removeClass('hidden');
    }
});
            
        // Event delegation for review checkbox clicks
        $('.review-checkbox').on('click', function () {
            var $this = $(this);
            var tabId = $(this).data('tab2-id'); 
            $(this).find('.flag-icon').toggleClass('clicked');
            var isActive = $(this).find('.flag-icon').hasClass('clicked');
            
            console.log('Review button clicked');
            
            var questionId = $(this).data('question-id');
            var circle = $('#' +tabId).siblings('.circle');
            var circle2 = $('#' +tabId).siblings('.circle2');
            var answer= $('.answer-option').hasClass('bg-green-500')
            console.log('answer',answer);
            
            // Click flag without checking answer
            if (isActive) {
            circle.toggleClass('hidden', true); // Hide green circle
            circle2.toggleClass('hidden', false); // Show yellow circle
            } else if (answer) {
                circle.toggleClass('hidden', false); // Show green circle
                circle2.toggleClass('hidden', true); // Hide yellow circle
            } else {
                circle.toggleClass('hidden', true); // Hide green circle
                circle2.toggleClass('hidden', true); // Hide yellow circle
            }

                
        });
    });
</script>