@extends('report')

@section('content')

@if ($message = Session::get('status'))
  <div id="alert" class=" alert flex items-center p-4 mb-4 text-yellow-800 rounded-lg bg-yellow-50 dark:bg-gray-800 dark:text-green-400" role="alert">
    <div class="ms-3 text-sm font-medium">
      {{$message}}
    </div>
  </div>
@endif

<div class="px-4 sm:px-6 md:px-7 py-10 lg:px-8 relative"> 

    @if(auth()->user()->id != $quiz->user->id)
        @if($review->isEmpty())
        <div class="modal-overlay fixed top-0 left-0 w-full h-full bg-black opacity-50 z-50"></div>
        @endif
    @endif

    <div class="mx-auto max-w-7xl"> 
        <div class="space-y-6"> 
            <div class="px-4 sm:px-0 sm:flex-0">
                    <h2 class="text-3xl font-bold leading-7 text-gray-900">Report</h2>

                <div class="sm:flex justify-between items-center">
                    <div>
                        <p class="py-4 font-bold text-xl leading-7">Quiz: {{$quiz->title}}</p>
                    </div>
                    <div class="flex gap-2">
                    <a  href="{{route('exports.student', ['userId'=> $user->id,'quizId' =>$quiz->id, 'attempt'=> $attemptNumber])}}" class="block text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">Export Excel</a>
                    <button id="attemptDropdownButton" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        Attempt
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                        <a  href="{{route('report.answerReview', ['quizId'=>$quiz->id, 'userId' => $user->id, 'attempt'=> $attemptNumber])}}"class="block text-white bg-yellow-500 hover:bg-yellow-600 focus:ring-4 focus:outline-none focus:ring-yellow-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-yellow-600 dark:hover:bg-yellow-700 dark:focus:ring-yellow-800" type="button">Answer Review</a>
                    </div>
                </div>

                <!-- Dropdown menu -->
                <div id="attemptDropdown" class="absolute right-24 mt-2 w-44 rounded-lg shadow-lg bg-white divide-y divide-gray-100 dark:bg-gray-700 hidden z-50">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="attemptDropdownButton">
                    @foreach ($attemptDates as $attempt)
                        <li>
                            <a href="{{ route('report.group', ['userId' => $userId, 'quizId' => $quizId, 'attempt' => $attempt->attempt]) }}" class="block px-4 py-2 hover:bg-gray-100">
                                Attempt {{ $attempt->attempt }} on {{ $attempt->created_at->format('m/d/Y') }}
                            </a>
                        </li>
                    @endforeach
                    </ul>
                </div>

                <div class="flex justify-between items-stretch w-70 space-x-4 mt-4">
                    <!-- Participant Details -->
                    <div class="flex-1 bg-white shadow-lg rounded-lg p-4 shadow flex flex-col items-center justify-center">
                        <div class="px-4 py-5 sm:px-6">
                            <h3 class="text-lg leading-6 font-medium text-gray-900">
                                Participant Details
                            </h3>
                        </div>
                        <div class="border-t border-gray-200 px-4 py-5 sm:p-0">
                            <dl class="sm:divide-y sm:divide-gray-200">
                                <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Name
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{$user->name}}
                                    </dd>
                                </div>
                                <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Gender
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{$user->gender}}
                                    </dd>
                                </div>
                                <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        School
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 sm:col-span-2">
                                        {{$user->school}}
                                    </dd>
                                </div>
                                <div class="py-3 sm:py-5 sm:grid sm:grid-cols-3 sm:gap-4 sm:px-6">
                                    <dt class="text-sm font-medium text-gray-500">
                                        Email
                                    </dt>
                                    <dd class="mt-1 text-sm text-gray-900 sm:mt-0 break-words sm:col-span-2">
                                        {{$user->email}}
                                    </dd>
                                </div>
                            </dl>
                        </div>
                    </div>

                    <!-- Overall Score and Time Taken -->
                    <div class="flex-1 bg-white shadow-lg rounded-lg p-4 shadow flex flex-col items-center justify-center text-center">
                        <div class="flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-300 h-16 w-16">
                            <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                            <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375Zm9.586 4.594a.75.75 0 0 0-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 0 0-1.06 1.06l1.5 1.5a.75.75 0 0 0 1.116-.062l3-3.75Z" clip-rule="evenodd" />
                            </svg>
                                <div class="mb-10">
                                    <p class="text-xl font-bold text-gray-900">Attempt {{$attemptNumber}}</p>
                                    <p class="text-2xl font-extrabold text-gray-900"> {{$currentAttemptDate->created_at->format('M d, Y')}}</p>
                                </div>
                        </div>

                        <div class="flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-purple-300 h-16 w-16">
                                <path fill-rule="evenodd" d="M9 1.5H5.625c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5Zm6.61 10.936a.75.75 0 1 0-1.22-.872l-3.236 4.53L9.53 14.47a.75.75 0 0 0-1.06 1.06l2.25 2.25a.75.75 0 0 0 1.14-.094l3.75-5.25Z" clip-rule="evenodd" />
                                <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                            </svg>
                            <div class="mb-10">
                                <p class="text-xl font-bold text-gray-900">Overall Score</p>
                                <p class="text-2xl font-extrabold text-gray-900">{{$formatted}}%</p>
                            </div>
                        </div>

                    
                        @php
                        //dd('time',$timeTaken);
                        $hours = floor($timeTaken / 60);
                        $minutes = $timeTaken % 60;
                        //dd('hour',$hours);
                        //dd('minute',$minutes);
                        @endphp
                        <div class="flex gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-blue-300 h-16 w-16">
                            <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z" clip-rule="evenodd" />
                            </svg>

                            <div>
                                <p class="text-xl font-bold text-gray-900">Time Taken</p>
                                <p class="text-2xl font-extrabold text-gray-900">
                                    @if($hours == 0)
                                        @if($minutes == 1)
                                            {{$minutes}} Minute
                                        @else
                                            {{$minutes}} Minutes
                                        @endif
                                    @else
                                        @if($minutes == 0)
                                            @if($hours == 1)
                                                {{$hours}} Hour
                                            @else
                                                {{$hours}} Hours
                                            @endif
                                        @else
                                            @if($hours == 1)
                                                {{$hours}} Hour {{$minutes}} Minutes
                                            @else
                                                {{$hours}} Hours {{$minutes}} Minutes
                                            @endif
                                        @endif
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Quiz Statistics -->
                    <div class="flex-1 bg-white shadow-lg rounded-lg p-4 shadow">
                        <p class="text-xl font-bold text-gray-900 mb-2 text-center">Quiz Statistics:</p>
                        <div id="pie-chart" class="mx-auto"></div>
                    </div>
                </div>

                <!-- Additional Statistics Charts -->
                <!-- <div class="mt-4 flex justify-between items-start w-full space-x-4">
                    <div class="flex-1 bg-white rounded-lg p-4 shadow">
                        <div id="performance-chart" class="h-64"></div>
                    </div>
                </div> -->

            <div class="flex justify-center mt-8">
                <!-- Score and Rank Card -->
                <div class="bg-white shadow-lg rounded-lg p-6 m-4 w-full md:w-1/2">
                    <h2 class="text-lg font-semibold mb-4">Performance</h2>
                    <p class="font-semibold">Score: <strong>{{ $userscore }} / {{ $totalpoints }}</strong></p>
                    @if($attemptNumber == 1)
                    <p class="font-semibold">Rank: <strong>{{ $currentUserRank }} / {{ $participants }}</strong></p>
                    @endif
                </div>
                
                <!-- Pass/Fail Result Card -->
                <div class="bg-white shadow-lg rounded-lg p-6 m-4 w-full md:w-1/2">
                    <h2 class="text-lg font-semibold mb-4">Result</h2>
                    @if($formatted >= $passMarkNumber)
                        <p  class="bg-green-400 text-sm text-white rounded-full px-3 py-2  text-center" >You are above the pass mark.</p>
                    @else
                        <p  class="bg-red-400 text-sm text-white rounded-full px-3 py-2 text-center" >You are below the pass mark.</p>
                    @endif
                </div>
            </div>

            @if($attemptNumber == 1)
            <div class="mt-4 relative flex flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                <div class="relative mx-4 mt-4 flex flex-col gap-4 overflow-hidden rounded-none bg-transparent bg-clip-border text-gray-700 shadow-none md:flex-row md:items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                    </svg>

                    <div>
                        <h6 class="block font-sans text-base font-semibold leading-relaxed tracking-normal text-blue-gray-900 antialiased">
                            Ranking Chart
                        </h6>
                    </div>
                </div>
                <div class="pt-6 px-2 pb-0">
                    <div id="bar-chart"></div>
                </div>
            </div>
            @endif
 
            </div>
        </div>

            <div class="mt-6 flex justify-end"> 
                <div class="mr-2 items-center sm:flex sm:items-center">
                    <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                    @if(auth()->user()->id == $quiz->user_id)
                        <a onclick="history.back();" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">Back</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">Exit</a>
                    @endif           
                    </div>
                </div>
            </div>
    
    
    </div>

    @if(auth()->user()->id != $quiz->user->id)
        @if($review->isEmpty())
            @include('review');
        @endif
    @endif
</div>


<link rel="preload" href="https://cdn.jsdelivr.net/npm/apexcharts" as="script">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<!-- pie chart -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const totalCorrect = {{ $totalCorrect }};
        const totalIncorrect = {{ $totalIncorrect }};
        const totalUnanswered = {{ $totalUnanswered }};
        const quizTitle = "{{ $quiz->title }}";

        const totalResponses = totalCorrect + totalIncorrect;
        const correctPercentage = ((totalCorrect / totalResponses) * 100).toFixed(2);
        const incorrectPercentage = ((totalIncorrect / totalResponses) * 100).toFixed(2);
        const unansweredPercentage = ((totalUnanswered) * 100).toFixed(2);

        const getChartOptions = () => {
            return {
                series: [parseFloat(correctPercentage), parseFloat(incorrectPercentage),parseFloat(totalUnanswered)],
                chart: {
                    type: 'pie',
                    height: 420,
                    width: '100%',
                },
                labels: ['Correct', 'Incorrect','Not Answered'],
                colors: ['#1C64F2', '#16BDCA', '#9061F9'],
                plotOptions: {
                    pie: {
                        dataLabels: {
                            offset: -25,
                        },
                    },
                },
                dataLabels: {
                    enabled: true,
                    formatter: function (val) {
                        return val.toFixed() + '%';
                    },
                    style: {
                        fontFamily: 'Inter, sans-serif',
                    },
                },
                tooltip: {
                    y: {
                        formatter: function(val, opts) {
                            const seriesIndex = opts.seriesIndex;
                            if (seriesIndex === 0) {
                                return totalCorrect + ' correct';
                            } else if (seriesIndex === 1) {
                                return totalIncorrect + ' incorrect';
                            } else if (seriesIndex === 2) {
                                return totalUnanswered + ' not answer';
                            }
                        }
                    }
                },
                legend: {
                    position: 'bottom',
                    fontFamily: 'Inter, sans-serif',
                },
                title: {
                    text: 'Score Chart',
                    align: 'center'
                }
            };
        };

        if (document.getElementById('pie-chart') && typeof ApexCharts !== 'undefined') {
            const chart = new ApexCharts(document.getElementById('pie-chart'), getChartOptions());
            chart.render().then(() => {
                console.log('Chart rendered successfully.');
            }).catch(error => {
                console.error('Error rendering chart:', error);
            });
        } else {
            console.error('Chart element not found or ApexCharts not loaded.');
        }
    });
</script>

<script>
    $(document).ready(function() {
        $('#attemptDropdownButton').click(function() {
            $('#attemptDropdown').toggleClass('hidden');
        });

        // Hide the dropdown if clicked outside
        $(document).click(function(event) {
            if (!$(event.target).closest('#attemptDropdownButton, #attemptDropdown').length) {
                $('#attemptDropdown').addClass('hidden');
            }
        });
    });
</script>

<!-- ranking chart -->
<script>
    const scores = @json($rankedScores);

    const participantNames = scores.map(score => score.user_name);
    const participantScores = scores.map(score => score.total_score);

    const colors = scores.map(score => score.is_current_user ? '#1C64F2' : '#020617');

    const chartConfig = {
        series: [
            {
                name: "Score",
                data: participantScores,
            },
        ],
        chart: {
            type: "bar",
            height: 240,
            toolbar: {
                show: false,
            },
        },
        title: {
            show: "",
        },
        dataLabels: {
            enabled: false,
        },
        plotOptions: {
            bar: {
                columnWidth: "40%",
                borderRadius: 2,
                distributed: true,  // Enable distributed colors
            },
        },
        colors: colors,  // Set the colors array
        xaxis: {
            axisTicks: {
                show: false,
            },
            axisBorder: {
                show: false,
            },
            labels: {
                style: {
                    colors: "#616161",
                    fontSize: "12px",
                    fontFamily: "inherit",
                    fontWeight: 400,
                },
            },
            categories: participantNames,
        },
        yaxis: {
            labels: {
                style: {
                    colors: "#616161",
                    fontSize: "12px",
                    fontFamily: "inherit",
                    fontWeight: 400,
                },
            },
        },
        grid: {
            show: true,
            borderColor: "#dddddd",
            strokeDashArray: 5,
            xaxis: {
                lines: {
                    show: true,
                },
            },
            padding: {
                top: 5,
                right: 20,
            },
        },
        fill: {
            opacity: 0.8,
        },
        tooltip: {
            theme: "dark",
        },
        legend: {
            show: false,
        }
    };

    const chart = new ApexCharts(document.querySelector("#bar-chart"), chartConfig);

    chart.render();
</script>

@endsection
