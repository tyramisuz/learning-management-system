@extends('layout')

@section('content')

<style>
    #alert {
        transition: opacity 0.5s ease-out;
    }
</style>
@if ($message = Session::get('status'))
  <div id="alert" class=" alert flex items-center p-4 mb-4 text-yellow-500 rounded-lg bg-yellow-50" role="alert">
    <div class="ms-3 text-sm font-medium">
      {{$message}}
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


<div class="px-4 sm:px-6 md:px7 lg:px-8"> 
    <div class="mx-auto max-w-7xl"> 

        <div class="space-y-15"> 
            <div class="px-4 sm:px-0 py-14 sm:flex-0">
                <div class="sm:flex">
                    <h2 class="sm:flex-auto text-3xl font-bold leading-7 text-gray-900">Report</h2>
                    <div class="mt-4 sm:ml-16 sm:mt-0 flex gap-2 justify-end">
                        <a  href="{{route('exports.quiz', $quiz->id)}}" class="block text-white bg-green-500 hover:bg-green-600 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800" type="button">Export Excel</a>
                        <a type="button" class="block rounded-md bg-indigo-500 px-3 py-2  text-sm font-semibold text-white items-center text-center hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" href="{{ route('quizzes.index') }}">Back</a>
                    </div>
                </div>

                <div class="p-4 sm:flex-auto">
                <h1 class="text-base font-bold leading-6 text-xl text-slate-950">Quiz: {{$quiz->title}}</h1>
                </div>
                
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <!-- Scores Container -->
                    <div class="col-span-2 rounded-lg p-4 mt-4">
                        <div class="grid grid-rows-4 grid-flow-col gap-4">
                            <div class="row-span-2 grid grid-cols-3 gap-4">
                                <!-- Average Score -->
                                <div class="rounded-lg p-4 text-center bg-white shadow">
                                    <p class="text-l font-bold text-blue-900">Average Score</p>
                                    <p class="text-xl font-extrabold text-blue-900">{{$aveScore}}</p>
                                </div>
                                <!-- Highest Score -->
                                <div class="rounded-lg p-4 text-center bg-white shadow">
                                    <p class="text-l font-bold text-blue-900">Highest Score</p>
                                    <p class="text-xl font-extrabold text-blue-900">{{$highestScore}}</p>
                                </div>
                                <!-- Lowest Score -->
                                <div class="rounded-lg p-4 text-center bg-white shadow">
                                    <p class="text-l font-bold text-blue-900">Lowest Score</p>
                                    <p class="text-xl font-extrabold text-blue-900">{{$lowestScore}}</p>
                                </div>
                            </div>
                            <div class="row-span-2 grid grid-cols-3 gap-4">
                                <!-- Average Score -->
                                <div class="rounded-lg p-4 text-center bg-white shadow">
                                    <p class="text-l font-bold text-blue-900">Duration</p>
                                    <p class="text-xl font-extrabold text-blue-900">
                                    @if($hours == 0)
                                        @if($minutes == 1)
                                            {{$minutes}} min
                                        @else
                                            {{$minutes}} mins
                                        @endif
                                    @else
                                        @if($minutes == 0)
                                            @if($hours == 1)
                                            {{$hours}} hour
                                            @else
                                            {{$hours}} hours
                                            @endif
                                        @else
                                            @if($hours == 1)
                                                {{$hours}} hour {{$minutes}} mins
                                            @else
                                                {{$hours}} hours {{$minutes}} mins
                                            @endif
                                        @endif
                                    @endif
                                    </p>
                                </div>
                                <!-- Highest Score -->
                                <div class="rounded-lg p-4 text-center bg-white shadow">
                                    <p class="text-xl font-bold text-blue-900">Total Score</p>
                                    <p class="text-2xl font-extrabold text-blue-900">{{$totalpoints}}</p>
                                </div>
                                <!-- Lowest Score -->
                                <div class="rounded-lg p-4 text-center bg-white shadow">
                                    <p class="text-l font-bold break-words text-blue-900">Participants</p>
                                    <p class="text-xl font-extrabold text-blue-900">{{$quiz->participants}}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Quiz Statistics Container -->
                    <div class="col-span-2 rounded-lg p-4 mt-4">
                        <p class="text-lg font-bold text-center text-green-900 mb-2">Quiz Statistics:</p>
                        <div class="flex gap-5 items-center mb-1">
                            <canvas id="quizChart"></canvas>
                        </div>
                    </div>
                </div>

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
    
                </div>
            </div>
                <h2 class="text-xl font-bold leading-7 text-gray-900">List Participants</h2>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                <table class="w-full text-sm text-left rtl:text-right text-gray-900">
                    <thead class="text-xs bg-gray-400 text-gray-900 uppercase dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                No
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Name
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Score
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Time Taken
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Percentage
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($userScores as $userScore)
                        <tr class="bg-white dark:bg-gray-800">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ ++$i }}
                            </th>
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $userScore['user']->name }}
                            </th>
                            <td class="px-6 py-4">
                                {{ $userScore['score'] }} / {{ $userScore['totalpoints'] }}
                            </td>

                        @php
                        $hours = floor($userScore['timeTaken'] / 60);
                        $minutes = $userScore['timeTaken'] % 60;
                        @endphp

                            <td class="px-6 py-4">
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
                            </td>
                            <td class="px-6 py-4">
                                {{ $userScore['percentage'] }}%
                            </td>
                        </tr>
                        @endforeach                    
                    </tbody>
                </table>
            </div>
            


        </div>   
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- bar chart -->
<script>
    var ctx = document.getElementById('quizChart').getContext('2d');
    var quizChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Passed', 'Failed'],
            datasets: [{
                label: 'Grade Statistic',
                data: [{{$passCount}}, {{$failCount}}],
                backgroundColor: [
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(255, 99, 132, 0.2)'
                ],
                borderColor: [
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>     

<link rel="preload" href="https://cdn.jsdelivr.net/npm/apexcharts" as="script">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<!-- ranking chart -->
<script>
    const scores = @json($rankedScores);

    const participantNames = scores.map(score => score.user_name);
    const participantScores = scores.map(score => score.total_score);

    // const colors = scores.map(score => score.is_current_user ? '#1C64F2' : '#020617')

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
        colors: ['#020617'],  // Set the colors array
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
        },
    };

    const chart = new ApexCharts(document.querySelector("#bar-chart"), chartConfig);

    chart.render();
</script>

@endsection