
<div class="py-2 px-4 bg-gray-200 flex justify-between items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
    <button type="button" class="text-lg text-gray-900 font-semibold sidebar-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>

    <ul class="flex gap-4 items-center">
        @include('notifications.badge')

        <li class="dropdown relative w-auto" id="dropdownMenu" >
            <button type="button" class="dropdown-toggle flex items-center" onclick="toggleDropdown()">
                <div class="flex-shrink-0 w-10 h-10 relative">
                    <div class="rounded-full focus:outline-none focus:ring">
                    @if (Auth::user()->image)
                        <img class="rounded-full" src="{{ asset(Storage::url(Auth::user()->image)) }}"  />
                    @else
                        <img class="rounded-full" src="{{ asset('images/default.jpeg') }}" alt="Profile Picture" />
                    @endif
                    </div>
                </div>
                <div class="p-2 md:block text-left">
                    <h2 class="text-sm font-semibold text-gray-800 whitespace-nowrap">{{ Auth::user()->name }}</h2>
                </div>                
            </button>

            <ul class="shadow-md shadow-black/5 z-30 hidden py-1.5 rounded-md bg-white border border-gray-100 w-full max-w-[140px] right-0 absolute" id="dropdownContent">
            @if(auth()->user()->role == 'user') 
                <li>
                    <x-responsive-nav-link :href="route('profile.edit')">
                    <div class="flex gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                    {{ __('Profile') }}
                    </div>
                    </x-responsive-nav-link>
                </li>
            @endif
                
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            <div class="flex gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline-block mr-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                                </svg>
                                {{ __('Log Out') }}
                            </div>
                        </x-responsive-nav-link>
                    </form>
                </li>

            </ul>
        </li>
    </ul>
</div>
        
        
<script>
            
    function toggleDropdown() {
        var dropdownContent = document.getElementById('dropdownContent');
        dropdownContent.classList.toggle('hidden');
    }

    document.addEventListener('click', function(event) {
        var dropdownMenu = document.getElementById('dropdownMenu');
        var dropdownContent = document.getElementById('dropdownContent');

        if (!dropdownMenu.contains(event.target)) {
            dropdownContent.classList.add('hidden');
        }
    });

        const sidebarToggle = document.querySelector('.sidebar-toggle')
        const main = document.querySelector('.main')
        document.addEventListener("DOMContentLoaded", function() {
        sidebarToggle.addEventListener('click', function (e) {
            e.preventDefault()
            main.classList.toggle('active')
            sidebarOverlay.classList.toggle('hidden')
            sidebarMenu.classList.toggle('-translate-x-full')
        });
        sidebarOverlay.addEventListener('click', function (e) {
            e.preventDefault()
            main.classList.add('active')
            sidebarOverlay.classList.add('hidden')
            sidebarMenu.classList.add('-translate-x-full')

        });
        // document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (item) {
        //     item.addEventListener('click', function (e) {
        //         e.preventDefault()
        //         const parent = item.closest('.group')
        //         if (parent.classList.contains('selected')) {
        //             parent.classList.remove('selected')
        //         } else {
        //             document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (i) {
        //                 i.closest('.group').classList.remove('selected')
        //             })
        //             parent.classList.add('selected')
        //         }
        //     })
        // })
    });
        // const fullscreenButton = document.getElementById('fullscreen-button');
    
        // fullscreenButton.addEventListener('click', toggleFullscreen);
    
        // function toggleFullscreen() {
        //     if (document.fullscreenElement) {
        //         // If already in fullscreen, exit fullscreen
        //         document.exitFullscreen();
        //     } else {
        //         // If not in fullscreen, request fullscreen
        //         document.documentElement.requestFullscreen();
        //     }
        // }

                

</script>

