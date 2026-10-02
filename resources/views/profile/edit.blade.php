@extends('layout')

@section('content')

<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('odyssey.png') }}">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
</head>

<x-app-layout>
    <div name="header">
        <div class="flex justify-between">
        <h2 class="ml-10 mt-10 font-opensans font-semibold  text-xl text-gray-800 leading-tight bg-taupe-50 p-4 rounded-md shadow-lg">
        {{ __('Profile') }}
        </h2>

        <a href="{{route('dashboard')}}" class="mt-10" style="margin-right: 2rem;">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
        </svg>
        </a>
        </div>

    <div class="py-12 grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.profile-image')
        </div>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
        <div class="max-w-xl">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>

</x-app-layout>

@endsection
