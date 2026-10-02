
<head>
    <link rel="icon" type="image/x-icon" href="{{ asset('odyssey.png') }}">
</head>

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

       <!-- Gender -->
<div class="mt-4">
    <x-input-label for="gender" :value="__('Gender')" />
    <select id="gender" name="gender" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
        <option value="" class="text-gray-500" disabled selected>Select gender</option>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
    <x-input-error :messages="$errors->get('gender')" class="mt-2" />
</div>


        <!-- Birthday -->
 <div class="mt-4 w-full">  
    <x-input-label for="dob" :value="__('Birthday')" />
    <div class="relative max-w-sm">
    <!-- Icon Container -->
    <div class="absolute inset-y-0 start-0 flex items-center px-3">
        <!-- <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z"/>
        </svg> -->
    </div>
    <!-- Input Field -->
    <x-text-input id="dobInput" type="text" name="dob" class="block w-full pl-10 mt-1" placeholder="Select date" />
    <x-input-error :messages="$errors->get('Birthday')" class="mt-2" />
</div>

</div>


         <!-- School -->
         <div class="mt-4">
            <x-input-label for="school" :value="__('School')" />
            <x-text-input id="school" class="block mt-1 w-full" type="text" name="school" :value="old('school')" required />
            <x-input-error :messages="$errors->get('school')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />

           <!-- Show Password Checkbox -->
           <label for="showPassword1" class="items-center pr-3 mt-1 gap-2">
            <input id="showPassword1" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" onclick="togglePasswordVisibility('password')">
            <span class="ml-2 text-sm text-gray-600">Show Password</span>
         </label>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <!-- Confirm Password -->
        <div class="mt-6">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />

           <!-- Show Password Checkbox -->
           <label for="showPassword2" class="items-center pr-3 mt-1 gap-2">
            <input id="showPassword2" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" onclick="togglePasswordVisibility('password_confirmation')">
            <span class="ml-2 text-sm text-gray-600">Show Password</span>
         </label>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>


        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
    
    <script>
        function togglePasswordVisibility(inputId) {
            var passwordInput = document.getElementById(inputId);
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
            } else {
                passwordInput.type = 'password';
            }
        }
        
        $(document).ready(function(){
            $("#dobInput").flatpickr({
                enableTime: false,
                dateFormat: "Y-m-d",
                // Additional options as needed
            });
        });
    </script>

</x-guest-layout>

