@extends('layout')

@section('content')

<style>
    #alert {
        transition: opacity 0.5s ease-out;
    }

    .dropdown {
    width: 200px; 
    }
    .tooltip {
            position: relative;
            display: inline-block;
        }

        .tooltip .tooltip-text {
            visibility: hidden;
            width: 100px;
            background-color: black;
            color: #fff;
            text-align: center;
            border-radius: 4px;
            padding: 2px 0;
            position: absolute;
            z-index: 1;
            bottom: 125%; /* Position the tooltip above the text */
            left: 50%;
            margin-left: -60px;
            opacity: 0;
            transition: opacity 0.3s;
        }

        .tooltip:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
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

<x-app-layout>
<title>Inventory</title>
<div class="px-4 sm:px-6 md:px7 py-8 lg:px-8">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-base font-bold leading-6 text-xl text-slate-950">Genres Available</h1>
      <p class="mt-2 text-sm text-gray-700">Learning Odyssey</p>
    </div>
      <div class="mt-4 sm:ml-16 sm:mt-0 flex gap-2">
            <a type="button" class="addGenre block rounded-md bg-indigo-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-indigo-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-500">Add Genre</a>
      </div>
  </div>

  <div class="mt-8 flow-root">
    <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
      <div class="inline-block min-w-full py-2 align-middle">
        @if($genres->isNotEmpty())
          <table class="min-w-full divide-y divide-gray-300">
              <thead>
                <tr>
                  <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-6 lg:pl-8">No</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Name</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Created On</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Status</th>
                  <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"></th>
                </tr>
              </thead>
              
              <tbody class="divide-y divide-gray-200 bg-white">
                @foreach ($genres as $genre)
                      <tr>
                        <td class="whitespace-nowrap py-4 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6 lg:pl-8">{{ ++$i }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $genre->name }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $genre->created_at->format('M d, Y') }}</td>
                        <td class="whitespace-nowrap py-5 pl-4 font-bold pr-3 text-sm sm:pl-0">
                            @if($genre->status == 'active')
                            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">{{$genre->status}}</span>
                            @else 
                            <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-sm font-medium text-red-700 ring-1 ring-inset ring-red-600/20">{{$genre->status}}</span>
                            @endif
                        </td>
                        <td class="whitespace-nowrap text-center py-4">
                          @if($genre->status == 'active')
                            <a data-genre_id="{{$genre->id}}" class="removeGenre ms-3 inline-flex justify-end px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 transition ease-in-out duration-150">Archive</a>
                          @else
                            <a data-genre2_id="{{$genre->id}}" class="unarchiveGenre ms-3 inline-flex justify-end px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-600 focus:bg-yellow-600 active:bg-yellow-700 focus:outline-none focus:ring-2 focus:ring-yellow-600 focus:ring-offset-2 transition ease-in-out duration-150">Unarchive</a>
                          @endif
                        </td>
                      </tr>
                @endforeach
              </tbody>
          </table>
        @else
          <p class="text-center">No genre created, Create New.</p>
        @endif
        <!-- genre Modal -->
        <div id="genre-modal" tabindex="-1" aria-hidden="true" class="hidden fixed inset-0 z-50 flex items-center justify-center p-4 overflow-y-auto">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div id="modal-overlay" class="fixed inset-0 transition-opacity bg-gray-500 bg-opacity-50" aria-hidden="true"></div>
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900">
                            Add new genre<span class="font-extrabold italic"></span>
                        </h3>
                        <button type="button" class="close end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form id="genreForm" class="space-y-4" action="{{ route('admin.storeGenre') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div>
                                <label for="message" class="block mb-4 text-sm font-medium text-gray-900">Genre</label>
                                <input type="text" name="genre" id="genre" class="py-2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5" placeholder=" Fundamental of Database" required />
                            </div>
                            <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add Genre</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>        

         <!-- archive genre modal -->
        <form action="{{ route('admin.archiveGenre', $genre->id)}}" id="archiveForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div id="archiveModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
                <div class="modal-content relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Close button aligned to the right -->
                            <button type="button" class="close absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                            <svg class="w-3 h-3 close" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>            
                            <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                <p class="text-m font-normal text-gray-500 mb-2 dark:text-gray-400">Archive will disable genre in the system.You can unarchive this genre again.</p>
                                <button id="removeGenre" type="submit" form="archiveForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Archive
                                </button>
                                <button id="no" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700">
                                No, cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
         <!-- unarchive genre modal -->
         <form action="{{ route('admin.unarchiveGenre', $genre->id)}}" id="unarchiveForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div id="unarchiveModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
                <div class="modal-content relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Close button aligned to the right -->
                            <button type="button" class="close absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">
                            <svg class="w-3 h-3 close" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>            
                            <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                                    </svg>
                                <p class="text-m font-normal text-gray-500 mb-2 dark:text-gray-400">Unarchive the genre will make it accessible in the system.</p>
                                <button id="unarchiveGenre" type="submit" form="unarchiveForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Unarchive
                                </button>
                                <button id="noUnarchive" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700">
                                No, cancel
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        {{$genres->links('pagination.custom')}}
      </div>
    </div>
  </div>

  <div class="mt-2 flex justify-end"> 
    <div class="mr-2 items-center sm:flex sm:items-center">
        <div class="mt-4 sm:ml-16 sm:mt-0 sm:flex-none">
            <a type="button" class="w-auto px-6 py-2 mb-4 text-base font-semibold focus:ring-2 focus:ring-offset-2 focus:ring-offset-white focus:ring-gray-900 focus:outline-none transition-colors duration-200 block border-b border-purple-300 hover:bg-purple-600 hover:text-white rounded-lg bg-purple-500" 
            href="{{route('admin.indexUser')}}">
            Back
            </a>
        </div>
    </div>
  </div>

</div>
</x-app-layout>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        // Handle click event on the anchor element
        $('a[data-modal-toggle="popup-modal"]').click(function (e) {
            e.preventDefault(); // Prevent default anchor behavior
            // Get the modal target from data attribute
            var modalTarget = $(this).data('modal-target');
            // Show the modal corresponding to the target
            $('#' + modalTarget).show(); // Assuming your modal has an ID matching the modal target
        });
    });
</script>

<script>

    var modal1 = $('#genre-modal');
    $('.addGenre').on('click', function(){
      modal1.removeClass('hidden');
      $('#announcement-modal').addClass('flex');
      $('#announcement-modal').attr('aria-hidden', 'false');
    });

    $('.close').on('click', function(){
      modal1.addClass('hidden');
      $('#announcement-modal').removeClass('flex');
      $('#announcement-modal').attr('aria-hidden', 'true');
    });

    $('#modal-overlay').on('click', function(){
      modal1.addClass('hidden');
    });


        var modal2 = $('#archiveModal');
        let genreId = null;

        $('.removeGenre').on('click', function(){
            genreId = $(this).data('genre_id');
            modal2.removeClass('hidden');
        });

        $('#removeGenre').on('click', function(){
            if(genreId)
            {
                let url = '{{route("admin.archiveGenre", ":id")}}'.replace(":id", genreId);
                $('#archiveForm').attr('action', url);
                $('#archiveForm').submit();
                console.log('Genre ID:', genreId);
            } else {
                console.error('Genre ID not set');
            }
        });

        $('.modal-content').on('click', function(){
          modal2.addClass('hidden');
        });

        $('#no').on('click', function(){
            modal2.addClass('hidden');
        });

        $('.close').on('click', function(){
            modal2.addClass('hidden');
        });

        var modal3 = $('#unarchiveModal');
        let genreId2 = null;

        $('.unarchiveGenre').on('click', function(){
            genreId2 = $(this).data('genre2_id');
            console.log(genreId2);
            modal3.removeClass('hidden');
        });

        $('#unarchiveGenre').on('click', function(){
            if(genreId2)
            {
                let url = '{{route("admin.unarchiveGenre", ":id")}}'.replace(":id", genreId2);
                $('#unarchiveForm').attr('action', url);
                $('#unarchiveForm').submit();
                console.log('Genre ID:', genreId2);
            } else {
                console.error('Genre ID not set');
            }
        });
        
        $('#noUnarchive').on('click', function(){
            modal3.addClass('hidden');
        });

        $('.close').on('click', function(){
            modal3.addClass('hidden');
        });
</script>  

<script>
  function confirmDelete(quizId) {
    if (confirm('Are You Sure Want Delete?')) {
            // Get the form element by ID
            var form = document.getElementById('delete_form_' + quizId);
            if (form) {
                form.submit(); 
            } else {
                console.error("Form not found");
            }
        }
    }
    
    function duplicate(quizId) {

            var form = document.getElementById('duplicate_quiz_' + quizId);
            if (form) {
                form.submit(); 
            } else {
                console.error("Form not found");
            }
    }

    //close button
    document.addEventListener("DOMContentLoaded", function() {
    const closeButton = document.querySelector("[data-dismiss-target='#alert']");

    if (closeButton) {
      console.log('click');
      $('#closeButton').on('click', function (event) {
        // closeButton.addEventListener("click", function() {
            const alert = document.querySelector("#alert");
            if (alert) {
                alert.classList.add("hidden");
            }
        });
    }
});
</script>

@endsection
