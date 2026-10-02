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

<x-app-layout>
    <div class="bg-green-100 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex px-4 justify-between">
            <h2 class="mt-10 ml-2mx-auto max-w-2xl text-base font-semibold leading-6 text-gray-900 lg:mx-0 lg:max-w-none">Recent Notifications</h2>
            <div class="flex flex-col items-end">
                <a onclick="history.back();" class="mt-10 tooltip" style="margin-right: 2rem;">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M9 15 3 9m0 0 6-6M3 9h12a6 6 0 0 1 0 12h-3" />
                    </svg>
                    <span class="tooltip-text">Back</span>
                </a>
                @if($groupedNotifications->isNotEmpty())
                    <span class="mt-10 read-all-button font-bold text-blue-600 hover:underline">Mark all as read</span>
                @endif
            </div>
        </div>
        <div class="mt-6 overflow-hidden border-t border-gray-100">
                <div id="notifications-container" class="rounded-lg">
                    <table class="w-full text-left overflow-x-auto ">   
                        <tbody class="" id="notification-list">
                            @forelse($groupedNotifications as $date => $notifications)
                                <tr class="text-sm leading-6 text-gray-900">
                                    <th scope="colgroup" colspan="3" class="relative isolate py-2 font-semibold">
                                        @if ($date === 'Today')
                                            Today
                                        @elseif ($date === 'Yesterday')
                                            Yesterday
                                        @else
                                            <time datetime="{{$date}}">{{$date}}</time>
                                        @endif
                                    </th>
                                </tr>
                                @foreach($notifications as $notification)
                                    @php
                                        $time = $notification->created_at->format('H:i');
                                        //dd($notification->sender->name);
                                    @endphp
                                    <tr class="notification-item notification-row {{$notification->is_read ? 'bg-white' : 'bg-gray-300'}}">
                                        <td class="relative py-5 pr-6">
                                            <div class="flex gap-x-6">
                                                <div class="flex">
                                                    <div class="ml-2 flex items-start gap-x-3">
                                                        @if($notification->sender && $notification->sender->image)
                                                        <img class="h-12 w-12 rounded-full" src="{{ Storage::url($notification->sender->image) }}" alt="Sender Image">
                                                        @elseif($notification->sender && !($notification->sender->image))
                                                        <img class="h-12 w-12 rounded-full" src="/images/default.jpeg" alt="profile">
                                                        @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-12 w-12">
                                                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                                        </svg>
                                                        @endif
                                                    </div>
                                                    <div class="ml-2 text-xs font-medium leading-6 text-gray-900">
                                                        @if($notification->sender)
                                                            <span class="font-bold text-l">{{$notification->sender->name}}</span> {{$notification->message}}<span class="text-blue-900 text-l font-bold"> {{$notification->group_name}}</span>
                                                        @else
                                                            <span class="font-bold text-l">{{$notification->message}}<span class="text-blue-900 text-l font-bold"> {{$notification->group_name}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="absolute bottom-0 right-full h-px w-screen bg-gray-100"></div>
                                            <div class="absolute bottom-0 left-0 h-px w-screen bg-gray-100"></div>
                                        </td>
                                        <td class="py-5 pr-6">
                                            <div class="flex gap-2">
                                                <div>
                                                    <div class="mt-1 text-xs leading-5 text-gray-500">{{$notification->time_ago}}</div>
                                                </div>
                                            </div>
                                        </td>
                                        @if($notification->type == 'invite')
                                            @if($notification->status == 'pending')
                                                <td class="py-5 text-right">
                                                    <div class="flex gap-2 justify-end items-center">
                                                        <form action="{{ route('groups.accept', $notification->invitation_id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="block rounded-md bg-blue-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500">Accept</button>
                                                        </form>
                                                        <form action="{{ route('groups.reject', $notification->invitation_id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <button type="submit" class="block rounded-md bg-red-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-red-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">Reject</button>
                                                        </form>
                                                    </div>
                                                </td>
                                            @elseif($notification->status == 'accepted')
                                                <td class="py-5 text-center">
                                                    <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Joined</span>
                                                </td>
                                            @else
                                                <td class="py-5 text-center">
                                                    <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-sm font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Declined</span>
                                                </td>
                                            @endif
                                        @else
                                        <td class="hidden py-5 pr-6 sm:table-cell"></td>
                                        @endif
                                    </tr>
                                @endforeach
                            @empty
                                <tr class="text-sm leading-6 text-gray-900">
                                    <td colspan="3" class="py-5 text-center">No notifications.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div id="loading-indicator" class="text-center" style="display:none;">Loading...</div>
        </div>
    </div>
</x-app-layout>

<!-- waterfall paginate  -->
<script>
    let currentPage = 1;
    let nextPage = true;

    function appendNotifications(notifications) {
        let currentDate = null;

        notifications.forEach(notification => {
            var profile = '';
            if (notification.sender && notification.sender.image) {
                profile = '<img class="h-12 w-12 rounded-full" src="' + notification.sender.image + '" alt="Sender Image">';
            } else if (notification.sender && notification.sender.image == null) {
                profile = '<img class="h-12 w-12 rounded-full" src="/images/default.jpeg" alt="profile">';
            } else {
                profile = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="h-12 w-12">' +
                          '<path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12ZM12 8.25a.75.75 0 0 1 .75.75v3.75a.75.75 0 0 1-1.5 0V9a.75.75 0 0 1 .75-.75Zm0 8.25a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />' +
                          '</svg>';
            }

            var status = '';
            if (notification.type == 'invite') {
                if (notification.status == 'pending') {
                    var accept = "{{ route('groups.accept', '') }}/" + notification.invitation_id;
                    var reject = "{{ route('groups.reject', '') }}/" + notification.invitation_id;

                    status = `
                        <td class="py-5 text-right">
                            <div class="flex gap-2 justify-end items-center">
                                <form action="${accept}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <button type="submit" class="block rounded-md bg-blue-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-blue-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-blue-500">Accept</button>
                                </form>
                                <form action="${reject}" method="POST">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="PUT">
                                    <button type="submit" class="block rounded-md bg-red-500 px-3 py-2 text-center text-sm font-semibold text-white hover:bg-red-400 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-red-500">Reject</button>
                                </form>
                            </div>
                        </td>
                    `;
                } else if (notification.status == 'accepted') {
                    status = `
                        <td class="py-5 text-center">
                            <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-sm font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Joined</span>
                        </td>
                    `;
                } else {
                    status = `
                        <td class="py-5 text-center">
                            <span class="inline-flex items-center rounded-md bg-red-50 px-2 py-1 text-sm font-medium text-red-700 ring-1 ring-inset ring-red-600/20">Declined</span>
                        </td>
                    `;
                }
            } else {
                status = '<td class="hidden py-5 pr-6 sm:table-cell"></td>';
            }

            if (currentDate !== notification.created_at.split('T')[0]) {
                currentDate = notification.created_at.split('T')[0];
                $('#notification-list').append(`
                    <tr class="text-sm leading-6 text-gray-900">
                        <th scope="colgroup" colspan="3" class="relative isolate py-2 font-semibold">
                            ${currentDate === new Date().toISOString().split('T')[0] ? 'Today' : currentDate}
                        </th>
                    </tr>
                `);
            }

            var message = notification.sender ? 
                '<span class="font-bold text-l">' + notification.sender.name + '</span> ' + notification.message + '<span class="text-blue-900 text-l font-bold"> ' + notification.group.name + '</span>' :
                '<span class="font-bold text-l">' + notification.message + '<span class="text-blue-900 text-l font-bold"> ' + notification.group.name + '</span>';

            var rowClass = notification.is_read ? 'bg-white' : 'bg-gray-300';

            $('#notification-list').append(`
                <tr class="notification-row ${rowClass}">
                    <td class="relative py-5 pr-6">
                        <div class="flex gap-x-6">
                            <div class="flex">
                                <div class="ml-2 flex items-start gap-x-3">
                                    ${profile}
                                </div>
                                <div class="ml-2 text-xs font-medium leading-6 text-gray-900">
                                    ${message}
                                </div>
                            </div>
                        </div>
                        <div class="absolute bottom-0 right-full h-px w-screen bg-gray-100"></div>
                        <div class="absolute bottom-0 left-0 h-px w-screen bg-gray-100"></div>
                    </td>
                    <td class="hidden py-5 pr-6 sm:table-cell">
                        <div class="flex gap-2">
                            <div>
                                <div class="mt-1 text-xs leading-5 text-gray-500">${notification.time_ago}</div>
                            </div>
                        </div>
                    </td>
                    ${status}
                </tr>
            `);
        });
    }

    // Scroll Pagination
    $(window).scroll(function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() && nextPage) {
            currentPage++;
            $('#loading-indicator').show();
            $.ajax({
                url: '/group/notification?page=' + currentPage,
                type: 'GET',
                success: function(response) {
                    if (response.notifications && response.notifications.length > 0) {
                        appendNotifications(response.notifications);
                        nextPage = response.next_page !== null;
                    } else {
                        nextPage = false; 
                    }
                    $('#loading-indicator').hide();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error("Error fetching data:", textStatus, errorThrown);
                    nextPage = false; 
                    $('#loading-indicator').hide();
                }
            });
        }
    });

    let lastFetchedId = null;

    setInterval(function() {
        console.log('Fetching');

        $.ajax({
            url: '/new/notifications',
            type: 'GET',
            data: { last_fetched: lastFetchedId },
            success: function(response) {
                console.log('Response received:', response);

                if (response.notifications.length > 0) {
                    lastFetchedId = response.notifications[response.notifications.length - 1].id;
                    console.log('Last Fetched ID:', lastFetchedId);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error("Error fetching new notifications:", textStatus, errorThrown);
            }
        });
    }, 10000);
</script>



@endsection
