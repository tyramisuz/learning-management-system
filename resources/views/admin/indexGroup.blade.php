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

<title>Groups</title>

<x-app-layout>
<div class="px-4 bg-gray-100 sm:px-6 md:px7 py-2 lg:px-8"> 

    <div class="border-b mt-6 border-gray-200 pb-5 sm:flex sm:items-center sm:justify-between">
        <div class="text-left">
            <h3 class="text-base font-semibold leading-6 text-gray-900">Groups by: <span class="font-bold">{{$name}}</span></h3>
            <p class="mt-2 text-sm text-gray-700">Learning Odyssey</p>
        </div>
        <div class="mt-3 sm:ml-4 sm:mt-0">
            <label for="mobile-search-candidate" class="sr-only">Search</label>
            <label for="desktop-search-candidate" class="sr-only">Search</label>
            <div class="flex rounded-md shadow-sm">
            <div class="relative flex-grow focus-within:z-10">
                <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3">
                <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
                </div>
                <input type="text" name="search" id="searchGroup" class="hidden w-full rounded-none rounded-l-md border-0 py-1.5 pl-10 text-sm leading-6 text-gray-900 ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:block" placeholder="Search Groups">
                <button id="clearSearch" class="absolute inset-y-0 right-0 flex items-center pr-3 cursor-pointer outline-none" style="display: none;">
                    <svg class="w-4 h-4 text-gray-500 hover:text-gray-700 transition duration-150 ease-in-out" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 12.586l-4.293 4.293-1.414-1.414L8.586 11 4.293 6.707l1.414-1.414L10 9.172l4.293-4.293 1.414 1.414L11.414 11l4.293 4.293-1.414 1.414L10 12.586z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
            </div>
        </div>
    </div>

    <div class="mt-8 flow-root">
        <div class="-mx-4 -my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
        <div class="inline-block min-w-full py-2 align-middle sm:px-6 lg:px-8">
            <table class="min-w-full mb-6 divide-y divide-gray-300">
                <thead>
                    <tr>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Name</th>
                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold text-gray-900 sm:pl-0">Created On</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Description</th>
                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Action</th>
                    <th scope="col" class="px-3 py-3.5 text-center text-sm font-semibold text-gray-900"></th>
                    <!-- <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900"></th> -->
                    <!-- <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold text-gray-900">Role</th> -->
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white" id="group-list">
                    @if($groups->isNotEmpty())
                        @foreach($groups as $group)
                    <tr>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">{{ $group->name }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $group->created_at->format('M d, Y') }}</td>
                        <td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">{{ $group->description }}</td>
                                
                        <td class="gap-2 relative whitespace-nowrap py-4 text-left text-sm font-medium sm:pr-6 lg:pr-8 flex">
                            <a href="{{route('groups.edit', $group->id)}}" class="tooltip">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-blue-600">
                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                            </svg>
                              <span class="tooltip-text">Edit Group</span>
                            </a>
                        </td>
                        <td>
                              <a data-group_id="{{$group->id}}" class="confirmGroup ms-3 inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 transition ease-in-out duration-150">Remove Group</a>
                        </td>
                    </tr>
                        <!-- delete group modal -->
                        <form action="{{ route('groups.destroy', $group->id)}}" id="removeGroupForm" method="POST" enctype="multipart/form-data">
                           @csrf
                           @method('DELETE')
                           <div id="removeGroupModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">
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
                                               <p class="text-m font-normal text-gray-500 mb-2 dark:text-gray-400">You cannot undo your action</p>
                                               <p class="text-m font-normal text-gray-500 mb-4 dark:text-gray-400">Sure want to remove?</p>
                                               <button id="removeGroup" type="button" form="removeGroupForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                               Remove
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

                        @endforeach
                    @else
                    <tr class="text-sm leading-6 text-gray-900">
                        <td colspan="3" class="py-5 text-center">No groups.</td>
                    </tr>
                    @endif
                </tbody>
            </table>
            <div class="pagination mt-4">
                {{$groups->links('pagination.custom')}}
            </div>
        </div>
        </div>
    </div>

    <div class="mt-6 flex justify-end"> 
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

<script>

        var modal = $('#removeGroupModal');
        let groupId = null;

        $('.confirmGroup').on('click', function(){
            groupId = $(this).data('group_id');
            modal.removeClass('hidden');
        });

        $('#removeGroup').on('click', function(){
            if(groupId)
            {
                let url = '{{route("groups.destroy", ":id")}}'.replace(":id", groupId);
                $('#removeGroupForm').attr('action', url);
                $('#removeGroupForm').submit();
            }
        });

        $('.modal-content').on('click', function(){
          modal.addClass('hidden');
        });
        $('#no').on('click', function(){
            modal.addClass('hidden');
        });

        $('.close').on('click', function(){
            modal.addClass('hidden');
        });

        let currentPage = 1;

        $('#clearSearch').on('click', function(){
            $('#searchGroup').val('').focus();
            fetchUsers();
            $('#clearSearch').hide();
        });

        $('#searchGroup').on('keyup', function () {
            
            let search = $(this).val();
            currentPage = 1;
            if (search.trim() !== '') {
                console.log('in'); 
                $('#clearSearch').show();
                fetchGroups(search);
            } else {
                $('#clearSearch').hide();
                fetchGroups(); // Fetch data without any filters
            }

        });

        $(document).on('click', '.pagination a', function(e) {
            e.preventDefault();
            
            // Extract the page number from the href attribute
            var page = $(this).attr('href').split('page=')[1];
            console.log('Page number:', page);

            
            // Get the current search query
            var searchQuery = $('searchGroup').val();
            
            // Fetch users with the current search query and page number
            fetchGroups(searchQuery, page);
        });

        function fetchGroups(query = '', page = 1){
            $.ajax({
                url: "{{ route('group.search') }}",
                type: 'GET',
                data: { query: query, page: page },
                success: function(data) {
                    let groupList = $('#group-list');
                    groupList.empty(); 
                    console.log('groups', data.groups);
                    if (data.groups) {
                        console.log(data.groups);
                        data.groups.forEach((group) => {
                            var destroy = "{{route('groups.destroy','')}}/"+group.id;
                            let groupContent = '';
                            if(group.user_id != null)
                            {
                                groupContent +=
                                '<tr>'+
                                    '<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-900">'+group.name+'</td>'+
                                    '<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">'+group.created_on+'</td>'+
                                    '<td class="whitespace-nowrap px-3 py-4 text-sm text-gray-500">'+group.description+'</td>'+
                                            
                                    '<td class="gap-2 relative whitespace-nowrap py-4 text-left text-sm font-medium sm:pr-6 lg:pr-8 flex">'+
                                        '<a href="/groups/edit/'+group.id+'/" class="tooltip">'+
                                        '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 text-blue-600">'+
                                        '<path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />'+
                                        '<path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />'+
                                        '</svg>'+
                                        '<span class="tooltip-text">Edit Group</span>'+
                                        '</a>'+
                                    '</td>'+
                                    '<td>'+
                                        '<a data-group_id="'+group.id+'" class="confirmGroup ms-3 inline-flex items-center px-4 py-2 bg-red-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-600 focus:bg-red-600 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-600 focus:ring-offset-2 transition ease-in-out duration-150">Remove Group</a>'+
                                    '</td>'+
                                    '<form action="'+destroy+'" id="removeGroupForm" method="POST" enctype="multipart/form-data">'+
                                        '@csrf'+
                                        '@method('DELETE')'+
                                        '<div id="removeGroupModal" class="hidden overflow-y-auto overflow-x-hidden fixed inset-0 bg-gray-900 bg-opacity-50 flex items-center justify-center h-full w-full md:inset-0 h-[calc(100%-1rem)] max-h-full z-50">'+
                                            '<div class="modal-content relative p-4 w-full max-w-md max-h-full">'+
                                                '<div class="relative bg-white rounded-lg shadow dark:bg-gray-700">'+
                                                        '<button type="button" class="close absolute top-3 right-3 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="popup-modal">'+
                                                        '<svg class="w-3 h-3 close" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">'+
                                                            '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>'+
                                                        '</svg>'+            
                                                        '<span class="sr-only">Close modal</span>'+
                                                        '</button>'+
                                                        '<div class="p-4 md:p-5 text-center">'+
                                                                '<svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">'+
                                                                    '<path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>'+
                                                                '</svg>'+
                                                            '<p class="text-m font-normal text-gray-500 mb-2 dark:text-gray-400">You cannot undo your action</p>'+
                                                            '<p class="text-m font-normal text-gray-500 mb-4 dark:text-gray-400">Sure want to remove?</p>'+
                                                            '<button id="removeGroup" type="button" form="removeGroupForm" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">'+
                                                            'Remove'+
                                                            '</button>'+
                                                            '<button id="no" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700">'+
                                                            'No, cancel'+
                                                            '</button>'+
                                                        '</div>'+
                                                    '</div>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</form>'+
                                '</tr>'
                                            
                            }
                            groupList.append(groupContent);
                        });
                    } else {
                        $('#group-list').html('<tr><td colspan="4" class="text-center text-gray-500">No Group found</td></tr>');
                    }
                    $('.pagination').html(data.links);
                },
                error: function() {
                    alert('Failed to fetch data');
                }
            });
        }

</script>
  @endsection