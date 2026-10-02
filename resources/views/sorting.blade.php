<div class="flex justify-center gap-2">
    <div class="">

        <div class="w-full max-w-lg lg:max-w-xs relative">
                <label for="search" class="sr-only">Search</label>
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                </div>
                <input id="searchInput" name="search" class="block w-full rounded-md border-0 bg-white py-1.5 pl-10 pr-3 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6" placeholder="Search" type="search">
            </div>
        </div>
        

        <div class="relative flex gap-2">
            <div class="relative">
                <button type="button" class="flex items-center justify-between bg-white px-2 py-3 text-sm text-gray-400" aria-controls="filter-section-0" aria-expanded="false">
                    <span class="font-medium text-gray-900">Genre</span>
                    <span class="ml-6 flex items-center">
                        <svg class="h-5 w-5 rotate-0 transform cursor-pointer genre-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="false">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                <div class="absolute right-0 mt-2 z-50 w-48 bg-white border border-gray-200 divide-y divide-gray-200 rounded-md shadow-lg hidden z-top genre-dropdown" id="filter-section-0">
                    <div class="p-2 space-y-2">
                        <div class="flex items-center">
                            <input id="m" name="genre[]" value="new-arrivals" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 genre-filter">
                            <label for="m" class="ml-3 text-sm text-gray-500">Mathematics</label>
                        </div>
                        <div class="flex items-center">
                            <input id="e" name="genre[]" value="tees" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 genre-filter">
                            <label for="e" class="ml-3 text-sm text-gray-500">English</label>
                        </div>
                        <div class="flex items-center">
                            <input id="h" name="genre[]" value="objects" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 genre-filter">
                            <label for="h" class="ml-3 text-sm text-gray-500">History</label>
                        </div>
                        <div class="flex items-center">
                            <input id="s" name="genre[]" value="objects" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 genre-filter">
                            <label for="s" class="ml-3 text-sm text-gray-500">Science</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <button type="button" class="flex items-center justify-between bg-white px-2 py-3 text-sm text-gray-400" aria-controls="filter-section-1" aria-expanded="false">
                    <span class="font-medium text-gray-900">Duration</span>
                    <span class="ml-6 flex items-center">
                        <svg class="h-5 w-5 rotate-0 transform cursor-pointer duration-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="false">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                <div class="absolute right-0 mt-2 z-50 w-48 bg-white border border-gray-200 divide-y divide-gray-200 rounded-md shadow-lg hidden z-top duration-dropdown" id="filter-section-1">
                    <div class="p-2 space-y-2">
                        <div class="flex items-center">
                            <input id="less" name="duration[]" value="Less than 1 hour" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 duration-filter">
                            <label for="less" class="ml-3 text-sm text-gray-500">Less than 1 hour</label>
                        </div>
                        <div class="flex items-center">
                            <input id="equal" name="duration[]" value="1 hour" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 duration-filter">
                            <label for="equal" class="ml-3 text-sm text-gray-500">1 hour</label>
                        </div>
                        <div class="flex items-center">
                            <input id="more" name="duration[]" value="more than 1 hour" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 duration-filter">
                            <label for="more" class="ml-3 text-sm text-gray-500">more than 1 hour</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="relative">
                <button type="button" class="mr-5 flex items-center justify-between bg-white px-2 py-3 text-sm text-gray-400" aria-controls="filter-section-2" aria-expanded="false">
                    <span class="font-medium text-gray-900">Pass Grade</span>
                    <span class="ml-6 flex items-center">
                        <svg class="h-5 w-5 rotate-0 transform cursor-pointer passgrade-icon" viewBox="0 0 20 20" fill="currentColor" aria-hidden="false">
                            <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                        </svg>
                    </span>
                </button>
                <div class="absolute right-0 mt-2 z-50 w-48 bg-white border border-gray-200 divide-y divide-gray-200 rounded-md shadow-lg hidden z-top passgrade-dropdown" id="filter-section-2">
                <div class="p-2 space-y-2">
                        <div class="flex items-center">
                            <input id="below" name="passgrade[]" value="new-arrivals" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 passgrade-filter">
                            <label for="below" class="ml-3 text-sm text-gray-500">below 50%</label>
                        </div>
                        <div class="flex items-center">
                            <input id="above" name="passgrade[]" value="tees" type="checkbox" class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500 passgrade-filter">
                            <label for="above" class="ml-3 text-sm text-gray-500">above 50%</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="quizContainer">
            @include('quiz-card', ['quizzes' => $quizzes])
        </div>

    </div>
<script>
    $(document).ready(function(){
            // Show/Hide dropdowns
        $('.genre-icon').click(function() {
            $('.genre-dropdown').toggle();
        });
        $('.duration-icon').click(function() {
            $('.duration-dropdown').toggle();
        });
        $('.passgrade-icon').click(function() {
            $('.passgrade-dropdown').toggle();
        });

            function fetchQuizzes() {
            let selectedGenres = $('.genre-filter:checked').map(function() { return $(this).val(); }).get();
            let selectedDurations = $('.duration-filter:checked').map(function() { return $(this).val(); }).get();
            let selectedPassGrades = $('.passgrade-filter:checked').map(function() { return $(this).val(); }).get();

            $.ajax({
                url: '{{route("sorting")}}', 
                method: 'POST',
                dataType: 'json',
                data: {
                    _token: '{{ csrf_token() }}',
                    genres: selectedGenres,
                    durations: selectedDurations,
                    passgrades: selectedPassGrades
                },
                success: function(response) {

                    $('#quizzes-container').html(response.html);
                }
            });
        }

        // Attach change event to filters
        $('.genre-filter, .duration-filter, .passgrade-filter').change(function() {
            fetchQuizzes();
        });

        // Initial fetch
        fetchQuizzes();
    });
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#searchInput').on('keyup', function() {
            let query = $(this).val();
            $.ajax({
                url: '{{ route("quizzes.search") }}',
                method: 'GET',
                data: { query: query },
                dataType: 'json', // Expect JSON response
                success: function(response) {
                    // Update HTML with filtered quizzes
                    $('#quizContainer').html(response.quizzes);
                },
                error: function(xhr) {
                    console.log('An error occurred:', xhr);
                }
            });
        });
    });

</script>









 

