@extends('layout')

@section('content')

<style>
    #alert {
        transition: opacity 0.5s ease-out;
    }
</style>
@if ($errors->any())
  <div id="alert" class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
    <div>
      <span class="font-medium">There were some problems with your input:</span>
      <ul class="mt-1.5 list-disc list-inside">
        @foreach($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
      </ul>
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

<title>Edit Question</title>

<form action="{{ route('questions.update', $question->id) }}" method="POST"  enctype="multipart/form-data">
    <div class="px-4 sm:px-6 md:px7 lg:px-8"> 
        <div class="mx-auto max-w-7xl"> 
            @csrf
            @method('PUT')

            <div class="space-y-15"> 
                    <div class="px-4 sm:px-0 sm:flex-0">
                        <h2 class="text-3xl text-center font-bold leading-7 py-6 text-grey-900">Edit Question</h2>
                    </div>
                    
            <div id="questionsForm">
                <div class="px-4 py-4 mx-auto lg:py-6">
                <div class="grid gap-4 mb-4 sm:grid-cols-2 sm:gap-6 sm:mb-5">

                <div class="w-full">
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Question Type</label>
                    <select id="questiontype" name="questiontype" class="questiontype bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" required>
                        <option value="{{ $question->type }}" selected>{{ ucfirst($question->type) }}</option>
                        
                        @if ($question->type !== 'single-choice')
                            <option value="single-choice">Single-choice</option>
                        @endif
                        @if ($question->type !== 'multiple-choice')
                            <option value="multiple-choice">Multiple-choice</option>
                        @endif
                    </select>
                </div>


                    <div>
                        <label for="item-weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Point</label>
                        <select id="" name="point" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" required>
                            <option selected>{{$question->point}}</option>
                            @foreach ($points as $point)
                            <option value="{{$point}}">{{$point}}</option>
                            @endforeach
                        </select>
                    </div> 
                    
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">


                    <div class="sm:col-span-2">
                        <label for="media" class="block text-sm font-medium leading-6 text-gray-700">Attach Media</label>
                        <div class="mt-2">
                            <div class="relative border-2 border-indigo-500 border-dashed rounded-lg p-8" id="dropzone">
                                <div class="mt-2 text-center">
                                    <svg class="w-8 h-8 mx-auto mb-4 text-gray-900 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                    </svg>
                                    <h3 class="mt-2 text-sm font-medium text-gray-900">
                                        <label for="file-upload" class="for-file relative cursor-pointer">
                                            <span class="font-semibold text-indigo-600">Browse to upload</span>
                                            <input id="file-upload" name="media" type="file" class="sr-only file-upload" onchange="handleFileUpload(event)">
                                        </label>
                                    </h3>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">Video/Image/Audio (SVG, PNG, JPG, MP4, MKV, MP3)</p>
                                </div>

                                <!-- Media Preview Section -->
                                <div id="media-preview" class="flex items-center justify-center">
                                    @if($question->media)
                                        @php
                                            $extension = pathinfo(Storage::url($question->media), PATHINFO_EXTENSION);
                                        @endphp

                                        @if(in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg']))
                                            <img id="image-preview" src="{{ Storage::url($question->media) }}" alt="Image" class="flex w-64 py-2 px-2 h-64 rounded-lg items-center justify-center">
                                        @elseif(in_array($extension, ['mp4', 'webm', 'ogg']))
                                            <video controls id="video-preview" class="flex w-full h-64 py-2 px-2 items-center justify-center rounded-lg">
                                                <source id="video-source" src="{{ Storage::url($question->media) }}" type="video/{{ $extension }}">
                                            </video>
                                        @elseif(in_array($extension, ['mp3', 'wav', 'ogg']))
                                            <audio controls id="audio-preview" class="flex w-64 rounded-lg items-center justify-center">
                                                <source id="audio-source" src="{{ Storage::url($question->media) }}" type="audio/{{ $extension }}">
                                            </audio>
                                        @endif
                                    @else
                                        <p class="mt-1 text-center text-sm text-red-500 font-semibold">
                                            No media attached, click browse to upload
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="sm:col-span-2">
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type a question</label>
                            <div class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                <input type="text" name="question" id="" autocomplete="" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" contenteditable="true" placeholder="Type a question..." required value="{{$question->question}}">
                            </div>
                    </div>
                </div>
                        <div class="w-full">
                            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer Type</label>
                            <select id="answertype" name="answertype" class=" answertype bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" value="" required>
                            <option selected value="{{ $question->answertype}}">{{ ucfirst($question->answertype) }}</option>
                            @if($question->answertype != 'text')
                                <option value="text">Text</option>
                            @endif
                            @if($question->answertype != 'image')
                                <option value="image">Image</option>
                            @endif
                            </select>
                        </div>

                        <!-- answer -->
                        <div class="mt-7 w-full">
                            <div id="single-text" style="display: none;">
                                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer Options</label>
                                    @foreach($answers as $index => $option)
                                        <div class="mt-2 flex items-center">
                                            <input type="checkbox" name="correct_answers" value="{{ $index }}" 
                                            @if($index == array_search(trim($correctAnswers[0]), array_map('trim', $answers))) checked @endif 
                                            class="mr-2 rounded-lg text-primary-500 focus:ring-primary-500">
                                            <textarea name="answer_text[]" 
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                                placeholder="Option {{ $index + 1 }}">{{ trim($option) ?? '' }}
                                            </textarea>
                                        </div>
                                    @endforeach
                            </div>
                            <div id="single-image" style="display: none;">
                                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer Options</label>
                                @foreach($answers as $index => $option)
                                    <h3 class="font-semibold ml-10 mt-4 mb-2">Option {{$index+1}}</h3>
                                    <div class="mt-2 flex items-center space-x-4 w-full">
                                        <input type="radio" name="correct_answers" value="{{ $index }}" 
                                            @if(in_array($option, $correctAnswers)) checked @endif 
                                            class="mr-2 rounded-lg text-primary-500 focus:ring-primary-500">
                                        <div class="relative border-2 border-green-500 border-dashed rounded-lg p-4 w-full">
                                            <div class="text-center mt-2">
                                                <svg class="w-8 h-8 mx-auto mb-4 text-gray-900 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                                </svg>
                                                <label for="image-upload-single-{{ $index }}" class="cursor-pointer text-green-600">
                                                    Browse to upload
                                                </label>
                                                <input id="image-upload-single-{{ $index }}" type="file" name="answer_image[]" class="sr-only image-upload" data-index="{{ $index }}" data-preview-id="image-preview-single-{{ $index }}">
                                                <p class="mt-1 text-xs text-gray-500">
                                                    PNG, JPG, JPEG, and GIF up to 2MB
                                                </p>
                                            </div>
                                            <img src="{{ Storage::url($option) ?? '' }}" alt="Option {{ $index + 1 }}" class="w-64 h-64 object-cover rounded-lg border mx-auto border-gray-300" id="image-preview-single-{{ $index }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <div id="multiple-text" style="display: none;">
                                    <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer Options</label>
                                    @foreach($answers as $index => $option)
                                        <div class="mt-2 flex items-center">
                                            <input type="checkbox" name="correct_answers[]" value="{{ $index }}" 
                                                @if(in_array($option, $correctAnswers)) checked @endif 
                                                class="mr-2 rounded-lg text-primary-500 focus:ring-primary-500">
                                            <textarea name="multi_answer_text[]" 
                                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-primary-500 focus:border-primary-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" 
                                                placeholder="Option {{ $index + 1 }}">{{ trim($option) ?? '' }}</textarea>
                                        </div>
                                    @endforeach
                            </div>
                            <div id="multiple-image" style="display: none;">
                                <label for="" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Answer Options</label>
                                @foreach($answers as $index => $option)
                                    <h3 class="font-semibold ml-10 mt-4 mb-2">Option {{$index+1}}</h3>
                                    <div class="mt-2 flex items-center space-x-4 w-full">
                                        <input type="checkbox" name="correct_answers[]" value="{{ $index }}" 
                                            @if(in_array($option, $correctAnswers)) checked @endif 
                                            class="mr-2 rounded-lg text-primary-500 focus:ring-primary-500">
                                        <div class="relative border-2 border-green-500 border-dashed rounded-lg p-4 w-full">
                                            <div class="text-center mt-2">
                                                <svg class="w-8 h-8 mx-auto mb-4 text-gray-900 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                                </svg>
                                                <label for="image-upload-multiple-{{ $index }}" class="cursor-pointer text-green-600">
                                                    Browse to upload
                                                </label>
                                                <input id="image-upload-multiple-{{ $index }}" type="file" name="multi_answer_image[]" class="sr-only image-upload" data-index="{{ $index }}" data-preview-id="image-preview-multiple-{{ $index }}">
                                                <p class="mt-1 text-xs text-gray-500">
                                                    PNG, JPG, JPEG, and GIF up to 2MB
                                                </p>
                                            </div>
                                            <img src="{{ Storage::url($option) ?? '' }}" alt="Option {{ $index + 1 }}" class="w-64 h-64 object-cover rounded-lg border mx-auto border-gray-300" id="image-preview-multiple-{{ $index }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                </div>
                </div>
            </div>

            <div class="flex gap-1 items-center justify-end gap-x-6 w-full">
                <a type="button" class="block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500" href="{{ route('questions.index', $quiz->id) }}">Back</a>
                <button  type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
            </div>

        </div>
    </div>
</form>

<!-- upload image attach media -->
<script>
    var dropzone = document.getElementById('dropzone');
    var fileInput = document.getElementById('file-upload');

    dropzone.addEventListener('dragover', e => {
        e.preventDefault();
        dropzone.classList.add('border-indigo-600');
    });

    dropzone.addEventListener('dragleave', e => {
        e.preventDefault();
        dropzone.classList.remove('border-indigo-600');
    });

    dropzone.addEventListener('drop', e => {
        e.preventDefault();
        dropzone.classList.remove('border-indigo-600');
        var file = e.dataTransfer.files[0];
        fileInput.files = e.dataTransfer.files;
        handleFileUpload({ target: { files: e.dataTransfer.files } });
    });

    function handleFileUpload(event) {
        var file = event.target.files[0];
        var extension = file.name.split('.').pop().toLowerCase();
        previewMedia(file, extension);
    }

    function previewMedia(file, extension) {
        var reader = new FileReader();
        var mediaPreview = document.getElementById('media-preview');

        reader.onload = function(e) {
            mediaPreview.innerHTML = ''; // Clear previous preview
            if (['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg'].includes(extension)) {
                var img = document.createElement('img');
                img.src = e.target.result;
                img.classList.add('w-64', 'h-64', 'rounded-lg');
                mediaPreview.appendChild(img);
            } else if (['mp4', 'webm', 'ogg'].includes(extension)) {
                var video = document.createElement('video');
                video.controls = true;
                video.classList.add('w-full', 'h-64', 'rounded-lg');
                var source = document.createElement('source');
                source.src = e.target.result;
                source.type = 'video/' + extension;
                video.appendChild(source);
                mediaPreview.appendChild(video);
            } else if (['mp3', 'wav', 'ogg'].includes(extension)) {
                var audio = document.createElement('audio');
                audio.controls = true;
                audio.classList.add('w-64', 'rounded-lg');
                var source = document.createElement('source');
                source.src = e.target.result;
                source.type = 'audio/' + extension;
                audio.appendChild(source);
                mediaPreview.appendChild(audio);
            }
        };

        reader.readAsDataURL(file);
    }

</script>


<script>
    $(document).ready(function() {
        function enableSingleSelection(containerId) {
            $('#' + containerId + ' input[name="correct_answers"]').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#' + containerId + ' input[name="correct_answers"]').not(this).prop('checked', false);
                }
            });
        }

        // Apply the single-selection behavior to specific containers
        enableSingleSelection('single-text');
        enableSingleSelection('single-image');
    });
</script>

<!-- image option upload  -->
<script>
    $(document).ready(function() {
        $('.image-upload').on('change', function() {
            var index = $(this).data('index');
            var file = $(this)[0].files[0];
            var reader = new FileReader();
            var previewId = $(this).data('preview-id');

            reader.onload = function(e) {
                $('#' + previewId).attr('src', e.target.result).show();
            };

            if (file) {
                reader.readAsDataURL(file);
            } else {
                $('#' + previewId).attr('src', '').hide();
            }
        });
    });
</script>

<!-- visibility -->
<script>
    $(document).ready(function() {
        var singleTextSection = $('#single-text');
        var singleImageSection = $('#single-image');
        var multiTextSection = $('#multiple-text');
        var multiImageSection = $('#multiple-image');

        var initialQuestionType = '{{$question->type}}'; 
        var initialAnswerType = '{{$question->answertype}}'; 

        function clearInputs(section) {
            section.find('textarea').val(''); 
            section.find('input[type="radio"], input[type="checkbox"]').prop('checked', false);
            section.find('input[type="file"]').val(''); 
            section.find('img').attr('src', '').hide(); 
        }

        function toggleSections() {
            var questionType = $('#questiontype').val(); 
            var answerType = $('#answertype').val(); 

            singleTextSection.hide();
            singleImageSection.hide();
            multiTextSection.hide();
            multiImageSection.hide();

            if (questionType !== initialQuestionType || answerType !== initialAnswerType) {
                clearInputs(singleTextSection);
                clearInputs(singleImageSection);
                clearInputs(multiTextSection);
                clearInputs(multiImageSection);
            }

            if (questionType === 'single-choice') {
                if (answerType === 'text') {
                    singleTextSection.show();
                } else if (answerType === 'image') {
                    singleImageSection.show();
                }
            } else if (questionType === 'multiple-choice') {
                if (answerType === 'text') {
                    multiTextSection.show();
                } else if (answerType === 'image') {
                    multiImageSection.show();
                }
            }
        }

        toggleSections(); 

        $('#questiontype, #answertype').on('change', function() {
            toggleSections(); 
        });
    });
</script>
<!-- close button -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const closeButton = document.querySelector("[data-dismiss-target='#alert']");

        if (closeButton) {
            closeButton.addEventListener("click", function() {
                const alert = document.querySelector("#alert");
                if (alert) {
                    alert.classList.add("hidden");
                }
            });
        }
    });
</script>





@endsection