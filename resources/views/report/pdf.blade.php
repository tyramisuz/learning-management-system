<!DOCTYPE html>
<html>

<head>
    <title>Learning Odyssey</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


    <!-- Include Tailwind CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.15/tailwind.min.css">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.3/dist/tailwind.min.css" rel="stylesheet">

    <!-- Include Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <style>
        .clock-dropdown {
            display: none;
        }

        select {
            width: 100%;
        }
        
        select option {
            word-wrap: break-word; 
            white-space: nowrap; 
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .page-break {
            page-break-before: always;
            break-before: page;
        }
        /* Additional styles */
        .content {
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .content p {
            max-width: 100%;
            text-align: center;
        }
    </style>

    <!-- Include jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <!-- Include Flatpickr JS -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <link rel="icon" type="image/x-icon" href="{{ asset('odyssey.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    
    
    <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    
    <script src="https://unpkg.com/@popperjs/core@2"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

    <body>
        <div class="px-4 sm:px-6 md:px-7 py-10 lg:px-8 relative"> 

            <div class="mx-auto max-w-7xl"> 
                <div class="space-y-6"> 
                    <div class="px-4 sm:px-0 sm:flex-0">
                            <h2 class="text-3xl font-bold leading-7 text-gray-900">Student Report</h2>

                        <div class="sm:flex justify-between items-center">
                            <p class="font-bold py-4 justify-center text-xl leading-7">Quiz: {{$quiz->title}}</p>
                        </div>                    
                            <!-- Participant Details -->
                            <div class="w-full">
                                <h2 class="text-l leading-6 text-gray-900"><strong>Name: </strong><span class="text-m ">{{$user->name}}</span></h2>
                                <h2 class="text-l leading-6 text-gray-900"><strong>Gender: </strong><span class="text-m">{{$user->gender}}</span></h2>
                                <h2 class="text-l leading-6 text-gray-900"><strong>School: </strong><span class="text-m">{{$user->school}}</span></h2>
                                <h2 class="text-l leading-6 text-gray-900"><strong>Email: </strong><span class="text-m">{{$user->email}}</span></h2>
                            </div>
                
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">                 
                            <!-- Overall Score and Time Taken -->
                            <div class="flex-1 bg-white shadow-lg rounded-lg p-4 shadow flex flex-col items-center justify-center text-center">
                                <div class="flex gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="text-yellow-300 h-16 w-16">
                                    <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                                    <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375Zm9.586 4.594a.75.75 0 0 0-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 0 0-1.06 1.06l1.5 1.5a.75.75 0 0 0 1.116-.062l3-3.75Z" clip-rule="evenodd" />
                                    </svg>
                                        <div class="mb-10">
                                            <p class="text-xl font-bold text-gray-900">Attempt Date</p>
                                            <p class="text-2xl font-extrabold text-gray-900">{{$createdAt->format('M d, Y')}}</p>
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
                            <div class="flex-1 bg-white rounded-lg p-4 shadow">
                                <p class="text-xl font-bold text-gray-900 mb-2 text-center">Quiz Statistics:</p>
                                <div id="pie-chart" class="mx-auto"></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-4">
                            <!-- Score and Rank Card -->
                            <div class="bg-white shadow-lg rounded-lg p-4 mt-4 w-full">
                                <h2 class="text-lg font-semibold mb-4">Performance</h2>
                                <p class="font-semibold">Score: <strong>{{ $userscore }} / {{ $totalpoints }}</strong></p>
                                <p class="font-semibold">Rank: <strong>{{ $currentUserRank }} / {{ $participants }}</strong></p>
                            </div>
                            
                            <!-- Pass/Fail Result Card -->
                            <div class="bg-white shadow-lg rounded-lg p-4 mt-4 w-full">
                                <h2 class="text-lg font-semibold mb-4">Result</h2>
                                @if($formatted >= $passMarkNumber)
                                    <p  class="text-green-700 font-bold text-sm rounded-full px-3 py-2  text-center" >You are above the pass mark.</p>
                                @else
                                    <p  class="text-red-700 text-sm font-bold rounded-full px-3 py-2 text-center" >You are below the pass mark.</p>
                                @endif
                            </div>
                        </div>

                    <div class="page-break"></div>

                    <div class="content">
                    <div class="mt-4 relative flex flex-col rounded-xl bg-white bg-clip-border text-gray-700 shadow-md">
                        <div class="relative mx-4 mt-4 flex flex-col gap-4 overflow-hidden rounded-none bg-transparent bg-clip-border text-gray-700 shadow-none md:flex-row md:items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" />
                            </svg>

                            <div>
                                <h6 class="block font-sans text-base font-semibold leading-relaxed tracking-normal text-blue-gray-900 antialiased">
                                    Ranking Chart
                                </h6>
                            </div>
                        </div>
                        <div class="pt-6 px-2 pb-0 mt-10">
                            <div id="bar-chart"></div>
                        </div>
                    </div>
                    </div>
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

        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>

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

        <!-- capture as image -->
        <!-- <script>
            $(document).ready(function() {
                $('form').on('submit', function(event) {
                    event.preventDefault();  

                    const pieChartElement = document.getElementById('pie-chart');
                    const barChartElement = document.getElementById('bar-chart');

                    html2canvas(pieChartElement).then(function(pieCanvas) {
                        const pieChartImage = pieCanvas.toDataURL('image/png');
                        
                        html2canvas(barChartElement).then(function(barCanvas) {
                            const barChartImage = barCanvas.toDataURL('image/png');

                            $.ajax({
                                url: $(event.target).attr('action'),
                                method: 'POST',
                                data: {
                                    _token: $('meta[name="csrf-token"]').attr('content'),
                                    pieChartImage: pieChartImage,
                                    barChartImage: barChartImage
                                },
                                success: function(response) {
                                    window.location.href = response.redirect_url; 
                                },
                                error: function(xhr, status, error) {
                                    console.error('Error:', error);
                                }
                            });
                        });
                    });
                });
            });
        </script> -->
    </body>

</html>
