@extends('layout')
@section('content')
  
<style>
    #alert {
        transition: opacity 0.5s ease-out;
    }
</style>
@if ($errors->any())
  <div id="alert" class="flex p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
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
  <div id="alert" class=" alert flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50" role="alert">
    <div class="ms-3 text-sm font-medium">
      {{$message}}
    </div>
  </div>
@endif
<x-app-layout>

<title>Edit Group</title>

<div class="px-4 bg-gray-100 sm:px-6 md:px7 py-2 lg:px-8"> 
  <div class="mx-auto max-w-7xl"> 
        <div class="space-y-15"> 
        <form action="{{ route('groups.update', $id) }}" method="POST" enctype="multipart/form-data">
                <div class="px-4 sm:px-0 sm:flex-0">
                    <h2 class="text-2xl text-center font-bold leading-7 py-8 text-grey-900">Edit Group</h2>
                </div>
                            
                    @csrf
                    @method('PUT')
            
                    <div class="bg-white shadow-lg rounded-lg p-4">
                    <div class="ml-5 mt-2 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-5">
                        <div class="sm:col-span-4">
                        <label for="name" class="block text-sm font-semibold leading-6 text-gray-900">Name</label>
                        <div class="relative mt-2">
                            <div class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                            <input type="text" name="name" id="name" autocomplete="" class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 focus:ring-0 sm:text-sm sm:leading-8 outline: none box-shadow: none" placeholder="Mars" value="{{$group->name}}" >
                            </div>
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-800 absolute right-0 mt-2 cursor-pointer" id="edit-name">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="ml-5 mt-10 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-5">
                        <div class="sm:col-span-4">
                        <label for="description" class="block text-sm font-semibold leading-6 text-gray-900">Description</label>
                        <div class="relative mt-2">
                            <div class="flex rounded-md bg-white/5 ring-1 ring-inset ring-white/10 focus-within:ring-2 focus-within:ring-inset focus-within:ring-indigo-500">
                            <textarea name="description" id="description" class="flex-1 border-0 bg-transparent py-1.5 pl-1 text-gray-900 focus:ring-0 sm:text-sm sm:leading-8" placeholder="Upcoming Exams Practices">{{$group->description}}</textarea>
                            </div>
                            <div>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-blue-800 absolute right-0 mt-2 cursor-pointer" id="edit-description">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                            </svg>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="ml-5 mt-4 flex gap-2 justify-end">
                        <!-- <a href="{{route('groups.index')}}" class="inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:w-auto sm:text-sm">Cancel</a> -->
                        <button type="submit" class="rounded-md bg-indigo-500 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Save</button>
                    </div>
                    </div>
        </form>
        <div class="mt-6 flex justify-end"> 
          <div class="mr-2 items-center sm:flex sm:items-center">
              <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
                <a type="button" class="w-auto px-6 py-2 rounded-lg mb-4 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 block border-b border-purple-300 hover:bg-purple-300 text-purple-700 rounded-lg" style="background-color: {{$group->color}};"
                onclick="history.back();">
                Back
                </a>
              </div>
          </div>
      </div>
        </div>
    </div>
</div>

</x-app-layout>

@endsection