<section>
    <form method="POST" action="{{ route('profile.image.upload') }}" enctype="multipart/form-data" class="mt-6 space-y-6">
        @csrf
        @method('post')
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Picture') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Update your account\'s profile picture.') }}
        </p>
    </header>

 

  <div class="flex items-center space-x-6">
    <div class="shrink-0">
        <div class="flex items-center gap-4">
        @if (Auth::user()->image)
          <img id='preview_img' class="h-16 w-16 object-cover rounded-full" src="{{ Storage::url(Auth::user()->image) }}"  />
        @else
          <img id='preview_img' class="h-16 w-16 object-cover rounded-full" src="/images/default.jpeg" alt="Profile Picture" />
        @endif
        <div class="mt-2 flex items-center">
       <label for="file-upload" class="flex justify-center items-center w-25 px-3 py-2 bg-gray-400 rounded-md border border-gray-500 text-white cursor-pointer hover:bg-gray-600 focus-within:outline-none focus-within:ring-2 focus-within:ring-indigo-500 focus-within:border-transparent">
          <span class="text-sm">Upload</span>
          <input id="file-upload" name="image" type="file" class="hidden" onchange="loadFile(event)">
        </label>
      <!-- </form> -->
    </div>
    </div>
  </div>
</div>


   
<script>
        var loadFile = function(event) {
            
            var input = event.target;
            var file = input.files[0];
            var type = file.type;

           var output = document.getElementById('preview_img');


            output.src = URL.createObjectURL(event.target.files[0]);
            output.onload = function() {
                URL.revokeObjectURL(output.src) // free memory
            }
        };
</script>


    <div class="flex items-center py-10 gap-4">
        
        <x-primary-button>{{ __('Save') }}</x-primary-button>

    </div>
</form>
</section>
