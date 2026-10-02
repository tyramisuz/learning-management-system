@extends('report')

@section('content')

<div class="px-4 sm:px-6 md:px7 py-10 lg:px-8"> 
  <div class="mx-auto max-w-7xl"> 

  <div class="space-y-6"> 
    <div class="px-4 sm:px-0 sm:flex-0">
        <div class="sm:flex justify-between items-center">
            <h2 class="text-3xl font-bold leading-7 text-gray-900">Report</h2>
            <div class="mt-4 sm:mt-0">
                <a href="{{ route('dashboard') }}" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus:outline focus:outline-2 focus:outline-offset-2 focus:outline-indigo-500">Exit</a>
            </div>
        </div>

        <div class="flex justify-between items-stretch w-full space-x-4 mt-4">
            <!-- Participant Details -->
            <div class="flex-1 bg-white rounded-lg p-4 shadow flex flex-col items-center justify-center">
                    <div class="text-l  text-centeritems-centertext-gray-900">
                        <p class="font-bold justify-center text-cnter items-centerleading-7">Quiz: {{$quiz->title}}</p>
                        <p class="font-bold">Participant Details:</p>
                    </div>
                    <div class="text-sm mt-4 text-gray-700">
                        <p><span class="font-bold">Name:</span> {{$user->name}}</p>
                        <p><span class="font-bold">Gender:</span> {{$user->gender}}</p>
                        <p><span class="font-bold">School:</span> {{$user->school}}</p>
                    </div>
            </div>

            <!-- Overall Score and Time Taken -->
            <div class="flex-1 bg-white rounded-lg p-4 shadow flex flex-col items-center justify-center text-center">
                <div class="mb-4">
                    <p class="text-2xl font-bold text-gray-900">Overall Score</p>
                    <p class="text-5xl font-extrabold text-gray-900">{{$formatted}}%</p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">Time Taken</p>
                    <p class="text-5xl font-extrabold text-gray-900">{{$timeTaken}} Minutes</p>
                </div>
            </div>

            <!-- Quiz Statistics -->
            <div class="flex-1 bg-white rounded-lg p-4 shadow">
                <p class="text-xl font-bold text-gray-900 mb-2 text-center">Quiz Statistics:</p>
                <div id="pie-chart" class="mx-auto"></div>
            </div>
        </div>

        <!-- Additional Statistics Charts -->
        <div class="mt-4 flex justify-between items-start w-full space-x-4">
            <div class="flex-1 bg-white rounded-lg p-4 shadow">
                <div id="performance-chart" class="h-64"></div>
            </div>
        </div>
    </div>
</div>



    @foreach($reportData as $data)
    <div class="mb-4 p-4 border bg-gray-150 rounded-lg">
            <p class="font-bold">{{ $loop->iteration }}. {{ $data['question'] }}</p>
            <ul>
                @foreach($data['options'] as $option)
                    <li class="mt-2">
                        <label class="flex items-center gap-3 {{ $option == $data['correctAnswer'] ? 'text-green-500' : ($data['studentAnswer'] == $option ? 'text-red-500' : '') }}">
                            <!-- {{ $data['studentAnswer'] }} -->
                            <input type="radio" class="" disabled {{ $data['studentAnswer'] == $option ? 'checked' : '' }} class="mr-2">
                            <span>
                                {{ $option }}
                            </span>
                        </label>
                    </li>
                @endforeach
            </ul>
            @if($data['studentAnswer'] && $data['studentAnswer'] != $data['correctAnswer'])
                <p class="mt-2 text-red-500">Your answer is incorrect. The correct answer is: <span class="font-bold text-green-500">{{ $data['correctAnswer'] }}</span></p>
            @elseif($data['studentAnswer'] == $data['correctAnswer'])
                <p class="mt-2 text-green-500">Your answer is correct!</p>
            @else
                <p class="mt-2 text-yellow-500">You did not answer this question.</p>
            @endif
        
    </div>
@endforeach


  </div>
</div>

  </div>
</div>


<link rel="preload" href="https://cdn.jsdelivr.net/npm/apexcharts" as="script">
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>


<!-- pie chart -->
<script>
        document.addEventListener("DOMContentLoaded", function() {
        const totalCorrect = {{ $totalCorrect }};
        const totalIncorrect = {{ $totalIncorrect }};
        const quizTitle = "{{ $quiz->title }}";

        const totalResponses = totalCorrect + totalIncorrect;
        const correctPercentage = ((totalCorrect / totalResponses) * 100).toFixed(2);
        const incorrectPercentage = ((totalIncorrect / totalResponses) * 100).toFixed(2);

        console.log('Total Correct:', totalCorrect);
        console.log('Total Incorrect:', totalIncorrect);
        console.log('Correct Percentage:', correctPercentage);
        console.log('Incorrect Percentage:', incorrectPercentage);

        const getChartOptions = () => {
            return {
                series: [parseFloat(correctPercentage), parseFloat(incorrectPercentage)],
                chart: {
                    type: 'pie',
                    height: 420,
                    width: '100%',
                },
                labels: ['Correct', 'Incorrect'],
                colors: ['#1C64F2', '#16BDCA'],
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
                        return val.toFixed(2) + '%';
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

<!-- bar chart -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const questions = @json($questions);
        const performance = @json($performance);

        console.log('Questions:', questions); // Debugging statement
        console.log('Performance:', performance); // Debugging statement

        if (typeof ApexCharts === 'undefined') {
            console.error('ApexCharts library not loaded!');
            return;
        }

        const transformedPerformance = performance.map(val => ({ y: val })); // Transform performance data

        const getPerformanceOptions = () => {
            return {
                series: [{
                    name: 'Performance',
                    data: performance
                }],
                colors: ['#00FFFF'],
                chart: {
                    type: 'bar',
                    height: 350,
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                    },
                },
                xaxis: {
                    categories: questions,
                    title: {
                        text: 'Question Number'
                    }
                },
                yaxis: {
                    title: {
                        text: 'Score'
                    },
                    max: 1,
                    min: 0,
                    tickAmount: 0
                },
                title: {
                    text: 'Question Performance',
                    align: 'center'
                }
            };
        };

        const chartElement = document.getElementById('performance-chart');
        if (chartElement) {
            const chart = new ApexCharts(chartElement, getPerformanceOptions());
            chart.render();
        } else {
            console.error('Performance chart element not found!');
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    var ctx = document.getElementById('quizChart').getContext('2d');
    var quizChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Attempted', 'Correct', 'Incorrect'],
            datasets: [{
                label: 'Quiz Statistics',
                data: [{{$attemptedQuestions}}, {{$totalCorrect}}, {{$totalIncorrect}}],
                backgroundColor: [
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)'
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

@endsection