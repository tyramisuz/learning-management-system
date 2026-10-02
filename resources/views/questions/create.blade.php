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

<title>Question Form</title>

<form id="questionStore" action="{{ route('questions.store') }}" method="POST" enctype="multipart/form-data">
    <div class="px-4 sm:px-6 md:px7 py-10 lg:px-8"> 
        <div class="mx-auto max-w-7xl"> 
            
            @csrf
            <div class="space-y-15"> 
                <div class="px-4 sm:px-0 sm:flex-0">
                    <h2 class="text-3xl text-center font-bold leading-7 text-grey-900">Add Question</h2>
                    </div>

                    
                    <!-- <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-5">
                        <div class="sm:col-span-4">
                            <h2>Question: 1</h2>
                        </div>
                    </div> -->
                    
                <div id="questionsForm">
                    <div class="question-form">
                        <!-- select quest -->
                        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-5">
                            <div class="sm:col-span-4">
                                <label class="question-number"></label>
                                <div class="question sm:col-span-1 flex justify-end"></div>
                                <!-- point -->
                                <div class="mt-2">
                                    <label for="" class="mt-2 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Point <span class="font-bold text-red-500">*</span></label>
                                    <select id="" name="questions[0][point]"  class="requiredPoint bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                        <option value="" selected>Select point</option>
                                        @foreach ($points as $point)
                                        <option value="{{$point}}">{{$point}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                                
                        <div class="question-block">
                            <!-- question type  -->
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-5">
                                <div class="sm:col-span-4">
                                    <div class="mt-2">
                                        <label for="" class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Select Type <span class="font-bold text-red-500">*</span></label>
                                        <select id="questiontype" name="questions[0][questiontype]" class="questiontype requiredQtype bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                            <option value="" selected>Choose type</option>
                                            <option value="single-choice">Single-choice</option>
                                            <option value="multiple-choice">Multiple-choice</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Attach Media -->      
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-5">
                                <div class="sm:col-span-4">
                                    <label for="media" class="block text-sm font-medium leading-6 text-gray-700">Attach Media</label>
                                    <div class="mt-2">
                                        <div class="relative border-2 border-indigo-500 border-dashed rounded-lg p-8" id="dropzone-">
                                            <div class="mt-2 text-center">
                                                <svg class="w-8 h-8 mx-auto mb-4 text-gray-900 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                                </svg>
                                                <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                    <label for="file-upload-0" class="for-file relative cursor-pointer">
                                                        <span class="font-semibold text-indigo-600">Browse to upload</span>
                                                        <input id="file-upload-0" name="questions[0][media]" type="file" class="sr-only file-upload" data-index="0">
                                                    </label>
                                                </h3>
                                                <!-- <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">or drag and drop</p> -->
                                                <p class="text-xs text-gray-500 dark:text-gray-400">Video/Image/Audio(SVG, PNG, JPG, MP4, MKV, MP3)</p>
                                            </div>
                                            <div id="preview-container-0" class="mt-4 preview-container">
                                                <img id="image-preview-0" class="img-preview mx-auto w-74 w-64 h-64 rounded-lg hidden">
                                                <video id="video-preview-0" class="vd-preview mx-auto w-full h-64 rounded-lg hidden" controls>
                                                    <source id="video-source-0" src="" class="video-source">
                                                    Your browser does not support the video tag.
                                                </video>
                                                <audio id="audio-preview-0" class="au-preview hidden mx-auto mt-4" controls>
                                                    <source id="audio-source-0" src="" class="audio-source">
                                                    Your browser does not support the audio tag.
                                                </audio>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                            <!-- question -->
                            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-5">
                                <div class="sm:col-span-4">
                                    <div class="mt-2">
                                        <label for="questionType" class="block text-sm font-medium text-gray-700">Question Text <span class="font-bold text-red-500">*</span></label>
                                        <div class="mt-2 col-span-2">
                                            <div class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                <textarea type="text" name="questions[0][question]" id="questionText" autocomplete="" class="requiredQuestion flex-1 border-0 bg-transparent py-1.5 pl-1 w-full text-gray-900 focus:ring-0 sm:text-sm sm:leading-10" placeholder="Type a question..." required></textarea>
                                            </div>
                                        </div>
                                    </div> 

                                    <!-- select answer type -->
                                    <label for="" class="block mb-2 mt-5 text-sm font-medium text-gray-900 dark:text-white">Answer Type <span class="font-bold text-red-500">*</span></label>
                                    <div class="mt-2">
                                        <select id="answertype" name="questions[0][answertype]" class="requiredAtype answertype bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                                            <option value="" selected>Choose type</option>
                                            <option value="text">Text</option>
                                            <option value="image">Image</option>
                                        </select>
                                    </div>

                                    <!-- single answer Text-->
                                    <div id="single-text" class="single-text mt-7" data-question-index="0" style="display: none;">
                                        <label for="questionType" class="block text-sm font-medium text-gray-700">Create Answer Options <span class="font-bold text-red-500">*</span></label>
                                        <div class="options-container">
                                            <div class="mt-2 col-span-2 relative">
                                                <div class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                    <textarea name="questions[0][iscorrect_text]" id="" autocomplete="" class="requiredSingle flex-1 p-2 bg-gray-50 block w-full text-sm text-gray-900 border-gray-300 rounded-lg relative" placeholder="Correct Answer"></textarea>
                                                </div>
                                            </div>

                                            <div class="mt-2 col-span-2 relative">
                                                <div class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                    <textarea name="questions[0][answer_text][0]" id="" autocomplete="" class="requiredSingle flex-1 p-2 bg-gray-50  block w-full text-sm text-gray-900 border-gray-300 rounded-lg relative" placeholder="Option 2"></textarea>
                                                </div>
                                            </div>
                                            
                                            <div class="mt-2 col-span-2 relative">
                                                <div class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                    <textarea name="questions[0][answer_text][1]" id="" autocomplete="" class="requiredSingle flex-1 p-2 bg-gray-50  block w-full text-sm text-gray-900 border-gray-300 rounded-lg relative" placeholder="Option 3"></textarea>
                                                </div>
                                            </div>

                                            <div class="mt-2 col-span-2 relative">
                                                <div class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                                                    <textarea name="questions[0][answer_text][2]" id="" autocomplete="" class="requiredSingle flex-1 p-2 bg-gray-50  block w-full text-sm text-gray-900 border-gray-300 rounded-lg relative" placeholder="Option 4"></textarea>
                                                </div>
                                            </div>
                                            <button type="button" id="add-option" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg">Add Option</button>
                                        </div>
                                    </div>

                                    <!--single  answer Image-->
                                    <div id="single-image" class="single-image mt-7" data-question-index="0" style="display: none;">
                                        <label for="answer" class="block text-sm py-4 font-semibold text-gray-900">Create Answer Options <span class="font-bold text-red-500">*</span></label>
                                        <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Correct Option</label>
                                        <div class="options-container2">
                                            <div class="mt-4 add-image">
                                                <div class="relative border-2 border-green-500 border-dashed rounded-lg p-4" id="">
                                                    <div id="note1" class="mt-2 single-upload-wrapper text-center">
                                                        <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                                                        <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                            <label class="relative cursor-pointer">
                                                            <span class="text-green-600">Browse</span>
                                                            <span>to upload</span>
                                                            <input id="answer_image_0" data-index="0" name="questions[0][iscorrect_image]" type="file" class="sr-only single-upload"  data-preview-id="preview_0">
                                                            </label>
                                                        </h3>
                                                        <p class="mt-1 text-xs text-gray-500">
                                                            PNG, JPG, JPEG and GIF up to 2MB
                                                        </p>
                                                    </div>
                                                    <img src="" name="questions[0][iscorrect_image]" data-index="0" class="mx-auto w-64 h-64 rounded-lg preview-image hidden" id="preview_answer_image_0">
                                                </div>
                                            </div>
    
                                            <div class="mt-4 add-image">
                                                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option 2</label>
                                                <div class="mt-4">
                                                    <div class="relative border-2 border-red-500 border-dashed rounded-lg p-4" id="">
                                                        <div id="note2" class="mt-2 single-upload-wrapper text-center">
                                                            <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                                                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                                <label class="relative cursor-pointer">
                                                                <span class="text-red-600">Browse</span>
                                                                <span>to upload</span>
                                                                <input id="answer_image_1" data-index="1" name="questions[0][answer_image][]" type="file" class="sr-only single-upload"  data-preview-id="preview_1">
                                                                </label>
                                                            </h3>
                                                            <p class="mt-1 text-xs text-gray-500">
                                                                PNG, JPG, JPEG and GIF up to 2MB
                                                            </p>
                                                        </div>
                                                        <img src="" name="questions[0][answer_image][]" data-index="1" class="mx-auto w-64 h-64 rounded-lg preview-image hidden" id="preview_answer_image_1">
                                                    </div>
                                                </div>
                                            </div>
                                                
                                            <div class="mt-4 add-image">
                                                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option 3</label>
                                                <div class="mt-4">
                                                    <div class="relative border-2 border-red-500 border-dashed rounded-lg p-4" id="">
                                                        <div id="note3" class="mt-2 single-upload-wrapper text-center">
                                                            <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                                                        <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                            <label class="relative for-image cursor-pointer">
                                                            <span class="text-red-600">Browse</span>
                                                            <span>to upload</span>
                                                            <input id="answer_image_2" data-index="2" name="questions[0][answer_image][]" type="file" class="sr-only single-upload"  data-preview-id="preview_2">
                                                            </label>
                                                        </h3>
                                                        <p class="mt-1 text-xs text-gray-500">
                                                            PNG, JPG, JPEG and GIF up to 2MB
                                                        </p>
                                                        </div>
                                                        <img src="" name="questions[0][answer_image][]" data-index="2" class=" mx-auto w-64 h-64 rounded-lg preview-image hidden" id="preview_answer_image_2">
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="mt-4 add-image">
                                                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option 4</label>
                                                <div class="mt-4">
                                                    <div class="relative border-2 border-red-500 border-dashed rounded-lg p-4" id="">
                                                        <div id="note4" class="mt-2 single-upload-wrapper text-center">
                                                            <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                                                        <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                            <label class="relative cursor-pointer">
                                                            <span class="text-red-600">Browse</span>
                                                            <span>to upload</span>
                                                            <input id="answer_image_3" data-index="3" name="questions[0][answer_image][]" type="file" class="sr-only single-upload"  data-preview-id="preview_3">
                                                            </label>
                                                        </h3>
                                                        <p class="mt-1 text-xs text-gray-500">
                                                            PNG, JPG, JPEG and GIF up to 2MB
                                                        </p>
                                                        </div>
                                                        <img src="" name="questions[0][answer_image][]" data-index="3" class=" mx-auto w-64 h-64 rounded-lg preview-image hidden" id="preview_answer_image_3">
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="button" id="add-option2" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg">Add Option</button>
                                        </div>
                                    </div>

                                    <!-- multiple answer Text-->
                                    <div id="multiple-text" class="multiple-text mt-7" data-question-index="0" style="display: none;">
                                        <div class="options-container1">
                                            <div class="mt-4 multi">
                                                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option 1</label>
                                                <textarea  name="questions[0][multi_answer_text][0]" class="block p-2 mt-4 w-full text-sm text-gray-900 border-gray-300 rounded-lg" placeholder="Enter text answer"></textarea>
                                                <div class="mt-2">
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox" name="questions[0][correct_answers][]" value="0" class="requiredMultiple form-checkbox rounded-lg">
                                                        <span class="ml-2">Mark as correct</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mt-4 multi">
                                                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option 2</label>
                                                <textarea name="questions[0][multi_answer_text][1]" class="block p-2 w-full mt-4 text-sm text-gray-900 border-gray-300 rounded-lg" placeholder="Enter text answer"></textarea>
                                                <div class="mt-2">
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox" name="questions[0][correct_answers][]" value="1" class="requiredMultiple form-checkbox rounded-lg">
                                                        <span class="ml-2">Mark as correct</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mt-4 multi">
                                                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option 3</label>
                                                <textarea name="questions[0][multi_answer_text][2]" class="block p-2 w-full mt-4 text-sm text-gray-900 border-gray-300 rounded-lg" placeholder="Enter text answer"></textarea>
                                                <div class="mt-2">
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox" name="questions[0][correct_answers][]" value="2" class="requiredMultiple form-checkbox rounded-lg">
                                                        <span class="ml-2">Mark as correct</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="mt-4 multi">
                                                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option 4</label>
                                                <textarea name="questions[0][multi_answer_text][3]" class="block p-2 w-full mt-4 text-sm text-gray-900 border-gray-300 rounded-lg" placeholder="Enter text answer"></textarea>
                                                <div class="mt-2">
                                                    <label class="inline-flex items-center">
                                                        <input type="checkbox" name="questions[0][correct_answers][]" value="3" class="requiredMultiple form-checkbox rounded-lg">
                                                        <span class="ml-2">Mark as correct</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <button type="button" id="add-option1" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg">Add Option</button>
                                        </div>
                                    </div>
                                
                                    <!-- multiple answer Image-->
                                    <div id="multiple-image" class="multiple-image mt-7" data-question-index="0" style="display: none;">
                                        <label for="questionType" class="block text-sm py-4 font-semibold text-gray-900">Create Answer Options <span class="font-bold text-red-500">*</span></label>
                                        <div class="options-container3">
                                            <div class="mt-4 add-image1">
                                                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option 1</label>
                                                <div class="mt-4">
                                                    <div class="relative border-2 border-green-500 border-dashed rounded-lg p-4" id="">
                                                        <div id="note5" class="mt-2 text-center">
                                                            <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                                                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                                <label class="relative cursor-pointer">
                                                                <span class="text-green-600">Browse</span>
                                                                <span>to upload</span>
                                                                <input id="answer_image_0" data-index="0" name="questions[0][multi_answer_image][0]" type="file" class="sr-only multiple-upload" data-preview-id="preview_0">
                                                                </label>
                                                            </h3>
                                                            <p class="mt-1 text-xs text-gray-500">
                                                                PNG, JPG, JPEG and GIF up to 2MB
                                                            </p>
                                                        </div>
                                                        <img src="" name="questions[0][multi_answer_image][0]" data-index="0" class="mx-auto w-64 h-64 rounded-lg preview-image1 hidden" id="preview_answer_image_0">
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <input type="checkbox" name="questions[0][correct_answers][]" class="rounded-lg" value="0">
                                                    <label for="correct_option1" class="text-sm text-gray-900">Mark as correct</label>
                                                </div>
                                            </div>

                                            <div class="mt-4 add-image1">
                                                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option 2</label>
                                                <div class="mt-4">
                                                    <div class="relative border-2 border-green-500 border-dashed rounded-lg p-4" id="">
                                                        <div id="note6" class="mt-2 text-center">
                                                            <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                                                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                                <label class="relative cursor-pointer">
                                                                <span class="text-green-600">Browse</span>
                                                                <span>to upload</span>
                                                                <input id="answer_image_1" data-index="1" name="questions[0][multi_answer_image][1]" type="file" class="sr-only multiple-upload" data-preview-id="preview_1">
                                                                </label>
                                                            </h3>
                                                            <p class="mt-1 text-xs text-gray-500">
                                                                PNG, JPG, JPEG and GIF up to 2MB
                                                            </p>
                                                        </div>
                                                        <img src="" name="questions[0][multi_answer_image][1]" data-index="1" class="mx-auto w-64 h-64 rounded-lg preview-image1 hidden" id="preview_answer_image_1">
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <input type="checkbox" name="questions[0][correct_answers][]" class="rounded-lg" value="1">
                                                    <label for="correct_option1" class="text-sm text-gray-900">Mark as correct</label>
                                                </div>
                                            </div>

                                            <div class="mt-4 add-image1">
                                                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option 3</label>
                                                <div class="mt-4">
                                                    <div class="relative border-2 border-green-500 border-dashed rounded-lg p-4" id="">
                                                        <div id="note7" class="mt-2 text-center">
                                                            <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                                                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                                <label class="relative cursor-pointer">
                                                                <span class="text-green-600">Browse</span>
                                                                <span>to upload</span>
                                                                <input id="answer_image_2" data-index="2" name="questions[0][multi_answer_image][2]" type="file" class="sr-only multiple-upload" data-preview-id="preview_2">
                                                                </label>
                                                            </h3>
                                                            <p class="mt-1 text-xs text-gray-500">
                                                                PNG, JPG, JPEG and GIF up to 2MB
                                                            </p>
                                                        </div>
                                                        <img src="" name="questions[0][multi_answer_image][2]" data-index="2" class="mx-auto w-64 h-64 rounded-lg preview-image1 hidden" id="preview_answer_image_2">
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <input type="checkbox" name="questions[0][correct_answers][]" class="rounded-lg" value="2">
                                                    <label for="correct_option1" class="text-sm text-gray-900">Mark as correct</label>
                                                </div>
                                            </div>

                                            <div class="mt-4 add-image1">
                                                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option 4</label>
                                                <div class="mt-4">
                                                    <div class="relative border-2 border-green-500 border-dashed rounded-lg p-4" id="">
                                                        <div id="note8" class="mt-2 text-center">
                                                            <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                                                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                                                <label class="relative cursor-pointer">
                                                                <span class="text-green-600">Browse</span>
                                                                <span>to upload</span>
                                                                <input id="answer_image_3" data-index="3" name="questions[0][multi_answer_image][3]" type="file" class="sr-only multiple-upload" data-preview-id="preview_3">
                                                                </label>
                                                            </h3>
                                                            <p class="mt-1 text-xs text-gray-500">
                                                                PNG, JPG, JPEG and GIF up to 2MB
                                                            </p>
                                                        </div>
                                                        <img src="" name="questions[0][multi_answer_image][3]" data-index="3" class="mx-auto w-64 h-64 rounded-lg preview-image1 hidden" id="preview_answer_image_3">
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <input type="checkbox" name="questions[0][correct_answers][]" class="rounded-lg" value="3">
                                                    <label for="correct_option1" class="text-sm text-gray-900">Mark as correct</label>
                                                </div>
                                            </div>
                                            <button type="button" id="add-option3" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-lg">Add Option</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            
            <div id="clonedQuestion"></div>


            <div class="flex gap-2 mt-6">
                <button type="button" id="addQuestion" class="rounded-md bg-yellow-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-yellow-400">Add More Questions</button>
            </div>

            <div class="flex gap-2">
                <input type="hidden" name="status" id="status" value="">
                <input type="hidden" id="publish_date" name="publish_date" value="">
                <div class="mt-6 flex items-center justify-end gap-x-6 w-full">
                    <a href="{{route('quizzes.index')}}" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 sm:w-auto sm:text-sm">Cancel</a>
                    <button id="statusConfirm" type="button" class="validate-form rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                </div>
            </div>

            <!-- The Modal -->
            <div id="confirmationModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center hidden">
                <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                    <span class="close text-gray-500 hover:text-gray-900 cursor-pointer float-right">&times;</span>
                    <h5 class="text-lg font-semibold mb-4">Confirmation</h5>
                    <p class="mb-6">Do you want to publish? Once published, the quiz cannot be edited.</p>
                    <div class="flex justify-end space-x-4">
                        <button id="noButton" class="bg-gray-400 hover:text-blue-500 px-4 py-2 rounded-md">No</button>
                        <button id="yesButton" class="bg-red-500 text-white px-4 py-2 rounded-md">Yes</button>
                    </div>
                </div>
            </div>

            <script>
                var modal = document.getElementById("confirmationModal");

                // var btn = document.getElementById("statusConfirm");

                var span = document.getElementsByClassName("close")[0];

                var yesButton = document.getElementById("yesButton");
                var noButton = document.getElementById("noButton");

                // btn.onclick = function() {
                //     modal.classList.remove("hidden");
                // }

                span.onclick = function() {
                    modal.classList.add("hidden");
                }

                noButton.onclick = function() {
                    modal.classList.add("hidden");
                    document.getElementById('status').value = 'draft';
                }

                yesButton.onclick = function() {
                    var currentDate = new Date(); 
                    var formattedDate = currentDate.toISOString().split('T')[0]; 
                    document.getElementById('publish_date').value = formattedDate; 
                    document.getElementById('status').value = 'publish'; 
                    modal.classList.add("hidden"); 
                };


                window.onclick = function(event) {
                    if (event.target == modal) {
                        modal.classList.add("hidden");
                    }
                }
            </script>

        </div>
    </div>
</form>
                          
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- add question -->
<script>
    $(document).ready(function () {
        updateQuestionNumbers(); 
        var questionCount = 0; 
        let maxIndex = 0;
        let maxIndex1 = 0;
        let maxIndex2 = 0;
        let maxIndex3 = 0;
        let count = 0;
        let count1 = 0;
        let count2 = 0;
        let count3 = 0;
        let attribute = 0;
        let attribute1 = 0;
        let attribute2 = 0;
        let attribute3 = 0;
        let latest = null;

        function getCurrentMaxIndex() {
            $('#questionsForm .single-upload').each(function() {
                let index = parseInt($(this).attr('data-index'), 10);
                if (!isNaN(index) && index > maxIndex) {
                    maxIndex = index;
                } 
            });
            return maxIndex;
        }

        function getCurrentMaxIndex1() {
            $('#questionsForm .multiple-upload').each(function() {
                let index1 = parseInt($(this).attr('data-index'), 10);
                if (!isNaN(index1) && index1 > maxIndex1) {
                    maxIndex1 = index1;
                }
            });
            return maxIndex1;
        }

        function getCurrentMaxIndex2() {
            $('#questionsForm .preview-image').each(function() {
                let index2 = parseInt($(this).attr('data-index'), 10);
                if (!isNaN(index2) && index2 > maxIndex2) {
                    maxIndex2 = index2;
                }
            });
            return maxIndex2;
        }

        function getCurrentMaxIndex3() {
            $('#questionsForm .preview-image1').each(function() {
                let index3 = parseInt($(this).attr('data-index'), 10);
                if (!isNaN(index3) && index3 > maxIndex3) {
                    maxIndex3 = index3;
                }
            });
            return maxIndex3;
        }

        if(count == 0){
            let maxIndex = getCurrentMaxIndex();
            attribute += maxIndex;
            count++;
        }

        if(count1 == 0){
            let maxIndex1 = getCurrentMaxIndex1();
            attribute1 += maxIndex1;
            count1++;
        }

        if(count2 == 0){
            let maxIndex2 = getCurrentMaxIndex2();
            attribute2 += maxIndex2;
            count2++;
        }

        if(count3 == 0){
            let maxIndex3 = getCurrentMaxIndex3();
            attribute3 += maxIndex3;
            count3++;
        }
        
        

        function validateForm(container) {
            let isValid = true;
            let hasFileInput = false;

            // Check text and select inputs
            container.find('.requiredPoint, .requiredQtype, .requiredQuestion, .requiredAtype').each(function () {
                if ($(this).val().trim() === '') {
                    isValid = false;
                } else {
                    $(this).removeClass('border-red-500'); 
                }
            });

            // Check file inputs
            let singleImage = container.find('.single-upload').val().trim() !== '';
            let multipleImage = container.find('.multiple-upload').val().trim() !== '';
            let textanswer = container.find('.requiredSingle').val().trim() !=='';
            let textanswer1 = container.find('.requiredMultiple').val().trim() !=='';

            if (!singleImage && !multipleImage && !textanswer && !textanswer1) {
                isValid = false;
            } else {
                container.find('#single-image, #multiple-image').removeClass('border-red-500'); 
            }

            return isValid;
        }
        
        function addQuestionForm() {

                // let isValid = true;
                // let hasFileInput = false;

                // // Validate existing form inputs
                // $('#questionsForm').find('.question-form').each(function () {
                //         let requiredPoint = $(this).find('.requiredPoint').val().trim();
                //         let requiredQtype = $(this).find('.requiredQtype').val().trim();
                //         let requiredQuestion = $(this).find('.requiredQuestion').val().trim();
                //         let requiredAtype = $(this).find('.requiredAtype').val().trim();

                //         // Debugging logs to check if the fields are actually empty
                //         console.log('Current form values:', {
                //             requiredPoint: requiredPoint,
                //             requiredQtype: requiredQtype,
                //             requiredQuestion: requiredQuestion,
                //             requiredAtype: requiredAtype
                //         });

                //         if (requiredPoint === '' || requiredQtype === '' || requiredQuestion === '' || requiredAtype === '') {
                //             isValid = false;
                //         }

                //         let singleImage = $(this).find('.single-upload').val().trim() !== '';
                //         let multipleImage = $(this).find('.multiple-upload').val().trim() !== '';
                //         let textAnswer = $(this).find('.requiredSingle').val().trim() !== '';
                //         let textAnswer1 = $(this).find('.requiredMultiple').val().trim() !== '';

                //         if (singleImage || multipleImage || textAnswer || textAnswer1) {
                //             hasFileInput = true;
                //         }
                //     });

                //     if (!isValid || !hasFileInput) {
                //         alert('Please fill out all required fields before adding a new question.');
                //         return;
                //     }

            questionCount++; 
            let clonedQuestion = $('#questionsForm').find('.question-form').last().clone();
            clonedQuestion.find('input[type="text"], input[type="number"], textarea').val(''); 
            clonedQuestion.find('input[type="file"]').val('');  // Clear file inputs
            clonedQuestion.find('select').prop('selectedIndex', 0); // Reset select elements
            clonedQuestion.find('img, video, audio').attr('src', '').addClass('hidden');


            clonedQuestion.find('.question-number').text('Question ' + (questionCount + 1)); 
            clonedQuestion.find('select, input, textarea').each(function () {
                var name = $(this).attr('name');
                if (name) {
                    var newName = name.replace('questions[0]', 'questions[' + questionCount + ']');
                    $(this).attr('name', newName);
                }
                // var id = $(this).attr('id');
                // if (id) {
                //     console.log('this',id);
                //     var newId = id.replace('-0', '-' + questionCount);
                //     console.log('new this',$(this).attr('id', newId));
                // }
            });

            clonedQuestion.find('.file-upload').each(function(){
                var id = $(this).attr('id');
                if (id) {
                    console.log('this',id);
                    var newId = id.replace('-0', '-' + questionCount);
                    console.log('new this',$(this).attr('id', newId));
                }
            });

            clonedQuestion.find('.single-text').each(function() {
                var currentDataIndex = $(this).attr('data-question-index');
                console.log('current data-question-index:', currentDataIndex);
                var newDataIndex = questionCount; 
                $(this).attr('data-question-index', newDataIndex);
                console.log('new data-question-index:', newDataIndex);
            });

            clonedQuestion.find('.multiple-text').each(function() {
                var currentDataIndex = $(this).attr('data-question-index');
                // console.log('current data-question-index:', currentDataIndex);
                var newDataIndex = questionCount; 
                $(this).attr('data-question-index', newDataIndex);
                // console.log('new data-question-index:', newDataIndex);
            });

            clonedQuestion.find('.single-image').each(function() {
                var currentDataIndex = $(this).attr('data-question-index');
                // console.log('current data-question-index:', currentDataIndex);
                var newDataIndex = questionCount; 
                $(this).attr('data-question-index', newDataIndex);
                // console.log('new data-question-index:', newDataIndex);
            });

            clonedQuestion.find('.multiple-image').each(function() {
                var currentDataIndex = $(this).attr('data-question-index');
                // console.log('current data-question-index:', currentDataIndex);
                var newDataIndex = questionCount; 
                $(this).attr('data-question-index', newDataIndex);
                // console.log('new data-question-index:', newDataIndex);
            });


            // label for attributes
            clonedQuestion.find('.for-file').each(function () {
                var currentFor = $(this).attr('for');
                var newFor = currentFor.replace('-0', '-' + questionCount);
                $(this).attr('for', newFor);
            });
            
            // media preview containers and ids
            clonedQuestion.find('.preview-container').each(function () {
                var id = $(this).attr('id');
                $(this).attr('id', id.replace('-0', '-' + questionCount));
            });
            
            clonedQuestion.find('img, video, audio').each(function () {
                var mediaId = $(this).attr('id');
                if (mediaId) {
                    $(this).attr('id', mediaId.replace('-0', '-' + questionCount)).addClass('hidden').attr('src', '');
                }
            });
             
            clonedQuestion.find('.video-source, .audio-source').each(function(){
                var source = $(this).attr('id');
                if(source){
                    // console.log('source', $(this).attr('id', source.replace('-0', '-' + questionCount)).addClass('hidden').attr('src', ''));
                    latest = $(this).attr('id');
                    // console.log('latest', latest);
                }
            });

            // $('.single-upload').off('change');
            
            clonedQuestion.find('.single-upload').each(function () {
                attribute++;
                console.log('number',attribute);
                var currentId = $(this).attr('id');
                console.log('current single id', currentId);
                var newId = currentId.replace(/\d+$/,attribute);
                $(this).attr('id', newId);
                console.log('new single id', newId);

                var previewId = 'preview_' + newId;
                $(this).next('img.preview-image').attr('id', previewId);
                console.log('Updated file input ID:', newId);
                console.log('Updated preview image ID:', previewId);
            });
   
            clonedQuestion.find('.preview-image').each(function () {
                attribute2++;
                // console.log('number',attribute2);
                var currentId2 = $(this).attr('id');
                var newId2 = currentId2.replace(/\d+$/, function(match) { return attribute2; });
                // console.log('current',currentId);
                console.log('img preview', $(this).attr('id', newId2));
            });
            
            clonedQuestion.find('.multiple-upload').each(function () {
                attribute1++;
                console.log('number multi',attribute1);
                var currentId1 = $(this).attr('id');
                var newId1 = currentId1.replace(/\d+$/, attribute1);
                console.log('current',currentId1);
                console.log('multi preview', newId1);
                $(this).attr('id', newId1);

                var previewId = 'preview_' + newId1;
                $(this).next('img.preview-image1').attr('id', previewId);
            });

            clonedQuestion.find('.preview-image1').each(function () {
                attribute3++;
                console.log('number',attribute3);
                var currentId3 = $(this).attr('id');
                var newId3 = currentId3.replace(/\d+$/, function(match) { return attribute3; });
                // console.log('current',currentId);
                var multiPreview = $(this).attr('id', newId3).attr('data-preview-id', 'preview_', 'data-index' + attribute3);
                console.log('multi img preview', multiPreview);
            });

            // clonedQuestion.find('.for-image').each(function () {
            //     var currentFor = $(this).attr('for');
            //     var newFor = currentFor.replace('_', '_' + questionCount);
            //     $(this).attr('for', newFor);
            // });

            clonedQuestion.find('.question').last().append(
                '<div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-5"><div class="sm:col-span-4"><button type="button" class="removeQuestion text-red-600 font-semibold">Remove</button></div></div>'
            ); 

            clonedQuestion.find('.single-image').hide();
            clonedQuestion.find('.multiple-image').hide();
            clonedQuestion.find('.single-text').hide();
            clonedQuestion.find('.multiple-text').hide();

            $('#clonedQuestion').append(clonedQuestion); 
        }

        // "Add More Question" button
        $('#addQuestion').on('click', function () {
            addQuestionForm();
            updateQuestionNumbers(); 
        });
        
        $('#statusConfirm').on('click', function () {
            let allValid = true;
            $('#questionsForm').each(function () {
                if (!validateForm($(this))) {
                    allValid = false;
                }
            });

            if (!allValid) {
                alert('Please fill out all fields before submitting.');
                return false; 
            }

            $('#confirmationModal').removeClass('hidden'); 
        });

        $('#questionsForm .question-form').on('submit', function (e) {
            e.preventDefault();
            console.log($(this).serialize()); 
        });

        $(document).on('click', '.removeQuestion', function () {
            const container = $(this).closest('.question-form');
            container.remove(); 
            updateQuestionNumbers(); 
        });

        function updateQuestionNumbers() {
            $('.question-form').each(function(index) {
                $(this).find('.question-number').text('Question ' + (index + 1));
            });
        }

        $(document).on('change', '.file-upload', function () {
            var fileUploadId = $(this).attr('id'); 
            console.log('input id',fileUploadId);
            var index = fileUploadId.split('-').pop(); 
            var file = this.files[0];
            var reader = new FileReader();

            reader.onload = function (e) {
                var fileType = file.type.split('/')[0];
                var $previewContainer = $('#preview-container-' + questionCount);

                if (fileType === 'image') {
                    $('#image-preview-' + questionCount).attr('src', e.target.result).removeClass('hidden');
                    $('#video-preview-' + questionCount).addClass('hidden');
                    $('#audio-preview-' + questionCount).addClass('hidden');
                } else if (fileType === 'video') {
                    console.log($('#video-preview-' + questionCount).attr('src', e.target.result));
                    var videoElement = $('#video-preview-' + questionCount).removeClass('hidden').get(0);
                    $('#image-preview-' + questionCount).addClass('hidden');
                    $('#audio-preview-' + questionCount).addClass('hidden');
                    // console.log('vd',videoElement);
                    if (videoElement) {
                        videoElement.load();
                    }
                } else if (fileType === 'audio') {
                    $('#audio-preview-' + questionCount).attr('src', e.target.result);
                    var audioElement = $('#audio-preview-' + questionCount).removeClass('hidden').get(0);
                    if (audioElement) {
                        audioElement.load();
                    }
                    $('#image-preview-' + questionCount).addClass('hidden');
                    $('#video-preview-' + questionCount).addClass('hidden');
                }
            };

            if (file) {
                reader.readAsDataURL(file);
            }
        });

        $(document).on('change', '.single-upload', function () {
            var inputId = $(this).attr('id');
            console.log('File input changed:', inputId);
            handleImagePreview(this);
        });

        $(document).on('change', '.multiple-upload', function () {
            handleImagePreview(this);
        });
        
        function handleImagePreview(input) {
            var inputId = $(input).attr('id');
            var previewId = 'preview_' + inputId;
            var preview = $('img#' + previewId);
        
            console.log('PreviewID', previewId);
            console.log('Preview element:', preview);
    
            if (preview.length === 0) {
                console.error('Preview not found:', previewId);
                return;
            }
    
            var file = input.files[0];
            var reader = new FileReader();
    
            reader.onload = function (e) {
                preview.attr('src', e.target.result).removeClass('hidden');
            };
    
            if (file) {
                reader.readAsDataURL(file);
            }
        }
        
    });
</script>

<!-- add answer option  -->
<script>
    $(document).on('click', '#add-option', function() {
        var $questionContainer = $(this).closest('.single-text');
        var optionsContainer = $questionContainer.find('.options-container');
        var optionCount = optionsContainer.find('.col-span-2').length;
        var newOptionIndex = optionCount; 
        var questionIndex = $questionContainer.data('question-index');

        var newOptionHtml =
            `<div class="mt-2 col-span-2 relative">
                <textarea name="questions[${questionIndex}][answer_text][${newOptionIndex}]" autocomplete="" class="requiredSingle p-2 bg-gray-50 block w-full text-sm text-gray-900 border-gray-300 rounded-lg" placeholder="Option ${newOptionIndex + 1}"></textarea>
                <button class="remove-option absolute top-2 right-2 text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                        <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                    </svg>
                </button>
            </div>`;

        var $addOptionButton = $(this);
        $(newOptionHtml).insertBefore($addOptionButton);

        console.log(`Added option ${newOptionIndex + 1} for question ${questionIndex}`);
    });

    $(document).on('click', '.remove-option', function() {
        var $optionToRemove = $(this).closest('.col-span-2');
        $optionToRemove.remove();
        var $questionContainer = $(this).closest('.single-text');
        var $optionsContainer = $(this).closest('.options-container');
        var questionIndex = $questionContainer.data('question-index');
        
        $optionsContainer.find('.col-span-2').each(function(index) {
            $(this).find('textarea')
                .attr('name', `questions[${questionIndex}][answer_text][${index}]`)
                .attr('placeholder', `Option ${index + 1}`);
            
            console.log(`Updated option placeholder to: Option ${index + 1}`);
        });
    });

    $(document).on('click', '#add-option1', function() {
        var $questionContainer = $(this).closest('.multiple-text');
        var optionsContainer = $questionContainer.find('.options-container1');
        var optionCount = optionsContainer.find('.multi').length;
        console.log('length', optionCount);
        var newOptionIndex = optionCount; 
        var questionIndex = $questionContainer.data('question-index');

        var newOptionHtml =
            `<div class="mt-4 multi relative">
                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option ${newOptionIndex + 1}</label>
                <textarea name="questions[${questionIndex}][multi_answer_text][${newOptionIndex}]" class="block p-2 mt-4 w-full text-sm text-gray-900 border-gray-300 rounded-lg" placeholder="Enter text answer"></textarea>
                <button type="button" class="remove-option1 absolute top-2 right-2 text-red-600">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                        <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                    </svg>
                </button>
                <div class="mt-2">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="questions[${questionIndex}][correct_answers][]" value="${newOptionIndex}" class="requiredMultiple form-checkbox rounded-lg">
                        <span class="ml-2">Mark as correct</span>
                    </label>
                </div>
            </div>`;

        var $addOptionButton = $(this);
        $(newOptionHtml).insertBefore($addOptionButton);

        console.log(`Added option ${newOptionIndex + 1} for question ${questionIndex}`);
    });

    $(document).on('click', '.remove-option1', function() {
        var $optionToRemove = $(this).closest('.multi');
        var $questionContainer = $(this).closest('.multiple-text');
        $optionToRemove.remove();
        var $optionsContainer = $(this).closest('.options-container1');
        var questionIndex = $questionContainer.data('question-index');

        $optionsContainer.find('.multi').each(function(index) {
            $(this).find('label[for="answer"]').text(`Option ${index + 1}`);
            
            $(this).find('textarea').attr('name', `questions[${questionCount}][multi_answer_text][${index}]`);
            
            $(this).find('input[type="checkbox"]').attr('value', index);
            
            console.log(`Updated option label to: Option ${index + 1}`);
        });
    });

    // single image 
    $(document).on('click', '#add-option2', function() {
        var $questionContainer = $(this).closest('.single-image');
        var optionsContainer = $questionContainer.find('.options-container2');
        var optionCount = optionsContainer.find('.add-image').length;

        var questionIndex = $questionContainer.data('question-index');

        var nextLetter = String.fromCharCode(97 + optionCount); 
        console.log('Next letter:', nextLetter);

        var newOptionHtml =
            `<div class="mt-4 add-image">
                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option ${optionCount + 1}</label>
                <div class="mt-4">
                    <div class="relative border-2 border-red-500 border-dashed rounded-lg p-4" id="">
                        <div id="note3" class="mt-2 single-upload-wrapper text-center">
                            <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                <label class="relative for-image cursor-pointer">
                                    <span class="text-red-600">Browse</span>
                                    <span>to upload</span>
                                    <input id="answer_image_${nextLetter}" data-index="${optionCount}" name="questions[${questionIndex}][answer_image][]" type="file" class="sr-only single-upload" data-preview-id="preview_${optionCount}">
                                </label>
                            </h3>
                            <button type="button" class="remove-option2 absolute top-2 right-2 text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                                    <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                                </svg>
                            </button>
                            <p class="mt-1 text-xs text-gray-500">
                                PNG, JPG, JPEG, and GIF up to 2MB
                            </p>
                        </div>
                        <img src="" name="questions[${questionIndex}][answer_image][]" data-index="${optionCount}" class="mx-auto w-64 h-64 rounded-lg preview-image hidden" id="preview_answer_image_${nextLetter}">
                    </div>
                </div>
            </div>`;

        var $addOptionButton = $(this);
        $(newOptionHtml).insertBefore($addOptionButton);

        console.log(`Added option ${optionCount + 1} for question ${questionIndex} with ID suffix ${nextLetter}`);
    });


    $(document).on('click', '.remove-option2', function() {
        var $optionToRemove = $(this).closest('.add-image');
        $optionToRemove.remove();
        var $questionContainer = $(this).closest('.single-image');
        var $optionsContainer = $(this).closest('.options-container2');
        var questionIndex = $questionContainer.data('question-index');

        $optionsContainer.find('.add-image').each(function(index) {
            $(this).find('label[for="answer"]').text(`Option ${index + 1}`);
            
            $(this).find('input').attr('name', `questions[${questionIndex}][answer_image][${index}]`);
            
            console.log(`Updated option label to: Option ${index + 1}`);
        });
    });

    // multi image 
    $(document).on('click', '#add-option3', function() {
        var $questionContainer = $(this).closest('.multiple-image');
        var optionsContainer = $questionContainer.find('.options-container3');
        var optionCount = optionsContainer.find('.add-image1').length;

        var questionIndex = $questionContainer.data('question-index');

        var nextLetter = String.fromCharCode(97 + optionCount); 
        console.log('Next letter:', nextLetter);

        var newOptionHtml =
            `<div class="mt-4 add-image1">
                <label for="answer" class="block text-sm font-semibold leading-6 text-gray-900">Option ${optionCount + 1}</label>
                <div class="mt-4">
                    <div class="relative border-2 border-green-500 border-dashed rounded-lg p-4" id="">
                        <div id="note3" class="mt-2 single-upload-wrapper text-center">
                            <img class="mx-auto h-12 w-12" src="https://www.svgrepo.com/show/357902/image-upload.svg" alt="">
                            <h3 class="mt-2 text-sm font-medium text-gray-900">
                                <label class="relative for-image cursor-pointer">
                                    <span class="text-red-600">Browse</span>
                                    <span>to upload</span>
                                    <input id="answer_image_${nextLetter}" data-index="${optionCount}" name="questions[${questionIndex}][answer_image][]" type="file" class="sr-only single-upload" data-preview-id="preview_${optionCount}">
                                </label>
                            </h3>
                            <button type="button" class="remove-option3 absolute top-2 right-2 text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                                    <path d="M6.28 5.22a.75.75 0 0 0-1.06 1.06L8.94 10l-3.72 3.72a.75.75 0 1 0 1.06 1.06L10 11.06l3.72 3.72a.75.75 0 1 0 1.06-1.06L11.06 10l3.72-3.72a.75.75 0 0 0-1.06-1.06L10 8.94 6.28 5.22Z" />
                                </svg>
                            </button>
                            <p class="mt-1 text-xs text-gray-500">
                                PNG, JPG, JPEG and GIF up to 2MB
                            </p>
                        </div>
                        <img src="" name="questions[${questionIndex}][multi_answer_image][]" data-index="${optionCount}" class="mx-auto w-64 h-64 rounded-lg preview-image hidden" id="preview_answer_image_${nextLetter}">
                    </div>
                </div>
                <div class="mt-2">
                    <input type="checkbox" name="questions[${questionIndex}][correct_answers][]" class="rounded-lg" value="${nextLetter}">
                    <label for="correct_option${optionCount + 1}" class="text-sm text-gray-900">Mark as correct</label>
                </div>
            </div>`;

        var $addOptionButton = $(this);
        $(newOptionHtml).insertBefore($addOptionButton);

        console.log(`Added option ${optionCount + 1} for question ${questionIndex} with ID suffix ${nextLetter}`);
    });

    $(document).on('click', '.remove-option3', function() {
        var $optionToRemove = $(this).closest('.add-image1');
        $optionToRemove.remove();
        var $questionContainer = $(this).closest('.multiple-image');
        var $optionsContainer = $(this).closest('.options-container3');
        var questionIndex = $questionContainer.data('question-index');

        $optionsContainer.find('.add-image1').each(function(index) {
            $(this).find('label[for="answer"]').text(`Option ${index + 1}`);
            
            $(this).find('input').attr('name', `questions[${questionIndex}][answer_image][${index}]`);
            
            console.log(`Updated option label to: Option ${index + 1}`);
        });
    });
</script>

<!-- visibility -->
<script>
    $(document).on('change', '.answertype', function() {
    var $questionBlock = $(this).closest('.question-block'); 
    var selectedValue = $(this).val();
    var selectedQuestion = $questionBlock.find('.questiontype').val();

    if(selectedQuestion == 'single-choice'){
        if (selectedValue === 'text') {
            $questionBlock.find('.single-text').show();
            $questionBlock.find('.single-image').hide();
            $questionBlock.find('.multiple-text').hide();
            $questionBlock.find('.multiple-image').hide();
        } else if (selectedValue === 'image') {
            $questionBlock.find('.single-text').hide();
            $questionBlock.find('.single-image').show();
            $questionBlock.find('.multiple-text').hide();
            $questionBlock.find('.multiple-image').hide();
        } else {
            $questionBlock.find('.single-text').hide();
            $questionBlock.find('.single-image').hide();
            $questionBlock.find('.multiple-text').hide();
            $questionBlock.find('.multiple-image').hide();
        }
    } else if (selectedQuestion == 'multiple-choice'){
        if(selectedValue === 'text'){
            $questionBlock.find('.multiple-text').show();
            $questionBlock.find('.multiple-image').hide();
            $questionBlock.find('.single-text').hide();
            $questionBlock.find('.single-image').hide();
        } else if(selectedValue === 'image'){
            $questionBlock.find('.multiple-text').hide();
            $questionBlock.find('.multiple-image').show();
            $questionBlock.find('.single-text').hide();
            $questionBlock.find('.single-image').hide();
        } else {
            $questionBlock.find('.multiple-text').hide();
            $questionBlock.find('.multiple-image').hide();
            $questionBlock.find('.single-text').hide();
            $questionBlock.find('.single-image').hide();
        }
    }
    });

    $(document).on('change', '.questiontype', function() {
        var $questionBlock = $(this).closest('.question-block'); 
        var selectedQuestion = $(this).val();
        var selectedValue = $questionBlock.find('.answertype').val();

        if(selectedValue === 'text'){
            if (selectedQuestion == 'single-choice') {
                $questionBlock.find('.single-text').show();
                $questionBlock.find('.single-image').hide();
                $questionBlock.find('.multiple-text').hide();
                $questionBlock.find('.multiple-image').hide();
            } else if (selectedQuestion == 'multiple-choice') {
                $questionBlock.find('.multiple-text').show();
                $questionBlock.find('.multiple-image').hide();
                $questionBlock.find('.single-text').hide();
                $questionBlock.find('.single-image').hide();
            } else {
                $questionBlock.find('.single-text').hide();
                $questionBlock.find('.single-image').hide();
                $questionBlock.find('.multiple-text').hide();
                $questionBlock.find('.multiple-image').hide();
            }
        } else if (selectedValue === 'image'){
            if(selectedQuestion == 'single-choice'){
                $questionBlock.find('.multiple-image').hide();
                $questionBlock.find('.multiple-text').hide();
                $questionBlock.find('.single-text').hide();
                $questionBlock.find('.single-image').show();
            } else if(selectedQuestion == 'multiple-choice'){
                $questionBlock.find('.multiple-text').hide();
                $questionBlock.find('.multiple-image').show();
                $questionBlock.find('.single-text').hide();
                $questionBlock.find('.single-image').hide();
            } else {
                $questionBlock.find('.multiple-text').hide();
                $questionBlock.find('.multiple-image').hide();
                $questionBlock.find('.single-text').hide();
                $questionBlock.find('.single-image').hide();
            }
        }
    });

</script>

<!-- answer image preview  -->
<!-- <script>
    $(document).ready(function() {
        function handleDragOver(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function handleDragLeave(e) {
        e.preventDefault();
        e.stopPropagation();
    }

    function handleDrop(e) {
        e.preventDefault();
        e.stopPropagation();

        var files = e.originalEvent.dataTransfer.files;
        if (files.length > 0) {
            var file = files[0];
            var dropZoneId = $(e.target).attr('id');
            var inputId = $(e.target).find('input[type="file"]').attr('id');
            $('#' + inputId)[0].files = files;
            var previewId = $(e.target).find('img').attr('id');
            previewImage(file, previewId);
        }
    }

    function previewImage(file, previewId) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#' + previewId).attr('src', e.target.result).removeClass('hidden');
        };
        reader.readAsDataURL(file);
    }

    // Attach event handlers to each drop zone
    $('#dropzone1').on('dragover', handleDragOver).on('dragleave', handleDragLeave).on('drop', handleDrop);
    $('#dropzone2').on('dragover', handleDragOver).on('dragleave', handleDragLeave).on('drop', handleDrop);
    $('#dropzone3').on('dragover', handleDragOver).on('dragleave', handleDragLeave).on('drop', handleDrop);
    $('#dropzone4').on('dragover', handleDragOver).on('dragleave', handleDragLeave).on('drop', handleDrop);

        // Function to handle file upload
        function handleFileUpload(event, previewId) {
            var file = event.target.files[0];
            previewImage(file, previewId);
        }

        // Function to preview the image
        function previewImage(file, previewId) {
            var reader = new FileReader();
            reader.readAsDataURL(file);
            reader.onload = function() {
                $('#' + previewId).attr('src', reader.result).removeClass('hidden');
            };
        }

        // Attach file upload handlers
        $('#file-upload1').on('change', function(event) {
            handleFileUpload(event, 'preview1');
        });
        $('#file-upload2').on('change', function(event) {
            handleFileUpload(event, 'preview2');
        });
        $('#file-upload3').on('change', function(event) {
            handleFileUpload(event, 'preview3');
        });
        $('#file-upload4').on('change', function(event) {
            handleFileUpload(event, 'preview4');
        });
        $('#file-upload5').on('change', function(event) {
            handleFileUpload(event, 'preview5');
        });
        $('#file-upload6').on('change', function(event) {
            handleFileUpload(event, 'preview6');
        });
        $('#file-upload7').on('change', function(event) {
            handleFileUpload(event, 'preview7');
        });
        $('#file-upload8').on('change', function(event) {
            handleFileUpload(event, 'preview8');
        });
    });

</script> -->

<!-- <script>
    $(document).ready(function() {
        // Function to handle file upload
        function handleFileUpload(input, previewId) {
            const file = input.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = $('#' + previewId);
                    img.attr('src', e.target.result);
                    img.removeClass('hidden');
                };
                reader.readAsDataURL(file);
            }
        }

        // Function to setup drag-and-drop functionality for a specific dropzone
        function setupDropzone(dropzoneId, previewId) {
            const $dropzone = $('#' + dropzoneId);
            
            $dropzone.on('dragover', function(event) {
                event.preventDefault();
                event.stopPropagation();
                $dropzone.addClass('border-blue-500');
            });

            $dropzone.on('dragleave', function(event) {
                event.preventDefault();
                event.stopPropagation();
                $dropzone.removeClass('border-blue-500');
            });

            $dropzone.on('drop', function(event) {
                event.preventDefault();
                event.stopPropagation();
                $dropzone.removeClass('border-blue-500');
                const files = event.originalEvent.dataTransfer.files;
                if (files.length > 0) {
                    const file = files[0];
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const img = $('#' + previewId);
                        img.attr('src', e.target.result);
                        img.removeClass('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle file input change
            $('#' + dropzoneId + ' input[type="file"]').on('change', function(event) {
                handleFileUpload(this, previewId);
            });
        }

        // Initialize dropzones
        setupDropzone('dropzone1', 'preview1');
        setupDropzone('dropzone2', 'preview2');
        setupDropzone('dropzone3', 'preview3');
        setupDropzone('dropzone4', 'preview4');
        setupDropzone('dropzone5', 'preview5');
        setupDropzone('dropzone6', 'preview6');
        setupDropzone('dropzone7', 'preview7');
        setupDropzone('dropzone8', 'preview8');
    });
</script> -->

<!-- <script>
    $(document).ready(function () {
        $('.single-upload').on('change', function () {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                const previewId = $(this).data('preview-id');  // Get the preview ID from data attribute
                const $previewImage = $('#' + previewId);  // Use the preview ID to select the image element
                const $imageUploadWrapper = $(this).closest('.relative').find('.image-upload-wrapper');

                // Debug: Log the preview ID and file info
                console.log('Preview ID:', previewId);
                console.log('File:', file);

                reader.onload = function (e) {
                    $previewImage.attr('src', e.target.result);
                    $previewImage.removeClass('hidden');
                    $imageUploadWrapper.addClass('hidden');
                }

                reader.readAsDataURL(file);
            }
        });
    });


</script> -->

<!-- hide notes  -->
 <!-- <script>
    $(document).ready(function(){

        $('#file-upload1').on('change', function() {
            if (this.files.length > 0) {
                $('#note1').addClass('hidden');
            }
        });
        $('#file-upload2').on('change', function() {
            if (this.files.length > 0) {
                $('#note2').addClass('hidden');
            }
        });
        $('#file-upload3').on('change', function() {
            if (this.files.length > 0) {
                $('#note3').addClass('hidden');
            }
        });
        $('#file-upload4').on('change', function() {
            if (this.files.length > 0) {
                $('#note4').addClass('hidden');
            }
        });
        $('#file-upload5').on('change', function() {
            if (this.files.length > 0) {
                $('#note5').addClass('hidden');
            }
        });
        $('#file-upload6').on('change', function() {
            if (this.files.length > 0) {
                $('#note6').addClass('hidden');
            }
        });
        $('#file-upload7').on('change', function() {
            if (this.files.length > 0) {
                $('#note7').addClass('hidden');
            }
        });
        $('#file-upload8').on('change', function() {
            if (this.files.length > 0) {
                $('#note8').addClass('hidden');
            }
        });
    });
 </script> -->

@endsection