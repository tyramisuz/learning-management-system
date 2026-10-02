<div class="flex flex-wrap mt-2">
        @foreach ($quizzes as $quiz)
        @if ($quiz->visibility == 'public' && $quiz->status == 'publish')
        <div class="p-4 w-1/3 max-w-sm">
            
            <div class="flex rounded-lg h-full w-full p-8 flex-col" style="{{ $quiz->icon ? 'background-image: url(' . Storage::url($quiz->icon) . ');' : 'background-color: #ADD8E6;' }}" >
                <div class="flex items-center justify-between mb-3">

                    <h2 class="text-gray-800 text-lg font-extrabold truncate overflow-hidden text-ellipsis break-words w-full">{{$quiz->title}}</h2>
                    @php
                        $bookmark = $quiz->bookmarks()->where('user_id', auth()->user()->id)->first();
                        $isSaved = $bookmark && $bookmark->status === 'saved';
                        //dd($isSaved);
                    @endphp
                            <button id="" class="saveajax tooltip save saved-icon" data-quiz_id="{{$quiz->id}}" data-status="{{$isSaved ? 'saved' : 'unsaved'}}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="{{ $isSaved ? 'yellow' : 'none' }}" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-8 h-8 save-icon quiz-icon-{{$quiz->id}}">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.593 3.322c1.1.128 1.907 1.077 1.907 2.185V21L12 17.25 4.5 21V5.507c0-1.108.806-2.057 1.907-2.185a48.507 48.507 0 0 1 11.186 0Z" />
                                </svg>
                                @if($isSaved == true)
                                    <span class="tooltip-text">Unsave</span>
                                @else
                                    <span class="tooltip-text">Save</span>
                                @endif
                            </button>
                            <input type="hidden" name="status" value="">
                    
                </div>

                <div class="flex-grow">
                    <div class="mt-2">
                        <p class="leading-relaxed text-base font-bold text-gray-800 break-words">
                            Genre: <span class="font-medium">{{$quiz->genre}}</span>
                        </p>
                        <p class="leading-relaxed text-base font-bold text-gray-800 break-words">
                            @php
                            $hours = floor($quiz->duration / 60);
                            $minutes = $quiz->duration % 60;
                            @endphp

                            @if($hours == 0)
                                @if($minutes == 1)
                                    Duration: <span class="font-medium">{{$minutes}} Minute</span>
                                @else
                                    Duration: <span class="font-medium">{{$minutes}} Minutes</span>
                                @endif
                            @else
                                @if($minutes == 0)
                                    @if($hours == 1)
                                        Duration: <span class="font-medium">{{$hours}} Hour</span>
                                    @else
                                        Duration: <span class="font-medium">{{$hours}} Hours</span>
                                    @endif
                                @else
                                    @if($hours == 1)
                                        Duration: <span class="font-medium">{{$hours}} Hour {{$minutes}} Minutes</span>
                                    @else
                                        Duration: <span class="font-medium">{{$hours}} Hours {{$minutes}} Minutes</span>
                                    @endif
                                @endif
                            @endif
                        </p>
                        <p class="leading-relaxed text-base font-bold text-gray-800 break-words">
                            Total Score: <span class="font-medium">{{$quiz->total_points}}</span>
                        </p>
                        <p class="leading-relaxed text-base font-bold text-gray-800 break-words">
                            Pass Grade: <span class="font-medium">{{$quiz->passgrade}}</span>
                        </p>
                        <p class="leading-relaxed text-base font-bold text-gray-800 break-words">
                            Total Questions: <span class="font-medium">{{$quiz->questions}}</span>
                        </p>
                        <p class="leading-relaxed text-base font-bold text-gray-800 break-words">
                            Created at : <span class="font-medium">{{$quiz->created_at}}</span>
                        </p>
                        <p class="leading-relaxed text-base font-bold text-gray-800 break-words">
                            Created by : <span class="bg-purple-400 text-sm text-white rounded-full px-3 py-2"><strong>{{$quiz->user->name}}</strong></span>
                        </p>
                        <p class="leading-relaxed text-base font-bold text-gray-800 break-words mt-4">
                            @php
                                $rating = $quiz->average ?? 0;
                                $filledStars = floor($rating);
                                $halfStar = ($rating - $filledStars) >= 0.5;
                                $emptyStars = 5 - $filledStars - ($halfStar ? 1 : 0);
                            @endphp
                            Review :<div class="flex items-center">
                                        @for ($i = 0; $i < $filledStars; $i++)
                                            <svg class="w-6 h-6 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                            </svg>
                                        @endfor

                                        @if ($halfStar)
                                            <svg class="w-6 h-6 text-yellow-300 ms-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                            </svg>
                                        @endif

                                        @for ($i = 0; $i < $emptyStars; $i++)
                                            <svg class="w-6 h-6 ms-1 text-gray-300 dark:text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                                <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z"/>
                                            </svg>
                                        @endfor
                                    </div>
                        </p>
                    </div>

                    <div class="mt-6 flex items-center justify-end gap-x-6">
                        @if($quiz->action == 'take' )
                        <a type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 leading-7" href="{{ route('questions.show', $quiz->id)  }}">TAKE</a>
                        @else
                        <a type="button" class="block rounded-md bg-indigo-600 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-700 leading-7" href="{{ route('questions.show', $quiz->id)  }}">RETAKE</a>
                        <a type="button" class="block rounded-md bg-green-600 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-green-700 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-green-700 leading-7" href="{{ route('report.view', $quiz->id) }}">REPORT</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>