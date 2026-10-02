<div class="">
    <div class="relative">
        <!-- Notification Icon -->
        <div class="noti relative cursor-pointer">
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
            @php
                use App\Models\Notification;
                use App\Models\Invitation;
                use App\Models\User;

                $notifications = Notification::where('user_id', auth()->user()->id)
                ->where('is_read', false)
                ->orderBy('created_at', 'desc')
                ->get();

                //foreach ($notifications as $notification) {
                    //$invitation = Invitation::find($notification->invitation_id);

                    //if ($invitation) {
                        //$senderId = $invitation->user_id;
                        //$sender = User::select('name', 'image', 'email')
                            //->where('id', $senderId)
                            //->first();
                        //$notification->sender = $sender;
                    //}
                //}

                $unreadCount = Notification::where('user_id', auth()->user()->id)->where('is_read', false)->count();
                //dd($unreadCount);
            @endphp
            @if($unreadCount > 0)
                <span class="absolute top-0 right-0 inline-block w-4 h-4 bg-red-600 text-white text-xs font-bold text-center rounded-full">{{ $unreadCount }}</span>
            @endif
        </div>
        <!-- Notification Dropdown -->
        <div id="notification-dropdown" class="hidden z-50 absolute right-0 mt-2 w-64 bg-white border border-gray-200 rounded-lg shadow-lg">
            @forelse($notifications as $notification)
                <div class="px-4 py-3 border-b border-gray-100 {{ $notification->is_read ? 'bg-gray-100' : '' }}">
                    <div class="flex items-center">
                        @if($notification->sender && $notification->sender->image)
                        <img class="h-8 w-8 rounded-full" src="{{ Storage::url($notification->sender->image) }}" alt="Sender Image">
                        @else
                        <img class="h-8 w-8 rounded-full" src="/images/default.jpeg" alt="profile">
                        @endif
                        <div class="ml-3">
                        @if($notification->sender)
                            <span class="font-bold text-l">{{$notification->sender->name}}</span> {{$notification->message}}<span class="text-blue-900 text-l font-bold"> {{$notification->group_name}}</span>
                        @else
                            <span class="font-bold text-l">{{$notification->message}}<span class="text-blue-900 text-l font-bold"> {{$notification->group_name}}</span>
                        @endif
                        </div>
                    </div>
                    <div class="mt-2 text-sm text-right">
                        <a href="{{ route('notifications.read', $notification->id) }}" class="text-blue-500 hover:underline">View</a>
                    </div>
                </div>
            @empty
                <div class="px-4 py-3">
                    <p class="text-sm text-gray-500">No notifications.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.noti').click(function(event) {
        event.stopPropagation(); // Stop the event from bubbling up
        $('#notification-dropdown').toggleClass('hidden');
    });

    $(document).click(function(event) {
        if (!$(event.target).closest('#notification-dropdown').length && !$(event.target).closest('.noti').length) {
            $('#notification-dropdown').addClass('hidden');
        }
    });
});
</script>
