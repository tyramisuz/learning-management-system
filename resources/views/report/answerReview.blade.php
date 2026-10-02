@extends('layout')

@section('content')

<div class="px-4 sm:px-6 md:px-7 py-10 lg:px-8 relative"> 

<h2 class="text-xl font-bold leading-7 py-6 text-gray-900">Answer Reviews</h2>
        @foreach($reportData as $data)
            <div class="mb-4 p-4 border bg-white shadow-lg rounded-lg">
                <p class="font-bold">{{ $loop->iteration }}. {{ $data['question'] }}</p>
                <ul>
                    @foreach($data['options'] as $option)
                        <li class="mt-2">
                            <label class="flex items-center gap-3 
                                {{ in_array($option, explode(',', $data['correctAnswer'])) ? 'text-green-500' : 
                                (in_array($option, explode(',', $data['studentAnswer'])) ? 'text-red-500' : '') }}">
                                <input class="rounded-lg" type="checkbox" disabled {{ in_array($option, explode(',', $data['studentAnswer'])) ? 'checked' : '' }}>
                                @if(str_ends_with($option, '.jpg') || str_ends_with($option, '.jpeg') || str_ends_with($option, '.png') || str_ends_with($option, '.gif'))
                                    <img src="{{ Storage::url($option) }}" alt="Option Image" class="w-64 h-64 rounded-lg object-cover">
                                @else
                                    <span>{{ $option }}</span>
                                @endif
                            </label>
                        </li>
                    @endforeach
                </ul>
                @if($data['studentAnswer'] === null)
                    <p class="mt-6 text-yellow-500">You did not answer this question.</p>
                @elseif($data['studentAnswer'] != $data['correctAnswer'])
                    <p class="mt-6 text-red-500">
                        @if($data['totalCorrect'] == 1)
                            Your answer is incorrect. The correct answer is:
                        @else
                            Your answer is incorrect. The correct answers are:
                        @endif
                    </p>

                    <div class="flex gap-2">
                        @if($data['questionType'] == 'image')
                            @foreach(explode(',', $data['correctAnswer']) as $correctOption)
                                    <img src="{{ Storage::url($correctOption) }}" alt="Correct Answer Image" class="ml-6 mt-6 w-64 h-64 rounded-lg object-cover">
                            @endforeach
                        @else
                        <span class="font-bold text-green-500">{{ $data['correctAnswer'] }}</span>
                        @endif
                    </div>
                @else
                    <p class="mt-2 text-green-500">Your answer is correct!</p>
                @endif
            </div>
        @endforeach

    <div class="mt-6 flex justify-end"> 
        <div class="mr-2 items-center sm:flex sm:items-center">
            <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a type="button" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" onclick="history.back();">Back</a>
            </div>
        </div>
    </div>
</div>

@endsection