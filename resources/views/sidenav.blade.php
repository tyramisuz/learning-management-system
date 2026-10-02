
<div class="fixed left-0 top-0 w-64 h-screen overflow-y-auto bg-gray-200  p-4 z-50 sidebar-menu transition-transform">
	<div class="mt-2">
        <a href="#" class="flex items-center gap-x-2 px-2 py-3 text-xl font-semibold leading-6 hover:bg-purple-500">
		@if (Auth::user()->image)
		<img class="h-8 w-8 rounded-full bg-indigo-700" src="{{ asset(Storage::url(Auth::user()->image)) }}"  /> 
		@else
		<img class="h-8 w-8 rounded-full bg-indigo-700" src="{{ asset('images/default.jpeg') }}" alt="">
		@endif
          <span class="sr-only">Your profile</span>
          <span class="text-m whitespace-nowrap" aria-hidden="true">{{Auth::user()->name}}</span>
        </a>
	</div>

        <ul class="mt-4">
			@if($userRole == 'super_admin')
				<span class="text-gray-400 font-bold">ADMIN</span>
					<li class="mb-1 mt-2 group rounded-md {{Route::is('admin.indexUser') ? 'bg-purple-900 text-white' : ''}}">
						<a href="{{route('admin.indexUser')}}" class="group hover:text-white flex gap-x-3 hover:bg-purple-700 rounded-md p-2 text-sm font-semibold">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 shrink-0">
						<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" />
						</svg>
							User Listing
						</a>
					</li>
					<li class="mb-1 group rounded-md {{ Route::is('') ? 'bg-purple-900 text-white' : '' }}" x-data="{ open: false }">
					<div class="flex items-center justify-between">
						<a @click="open = !open" class="hover:text-white hover:bg-purple-700 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 shrink-0">
						<path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
						</svg>
							Update/Amend
						</a>
						<button @click="open = !open" class="hover:text-white hover:bg-purple-700 rounded-md p-2">
							<svg :class="{ 'transform rotate-180': open }" class="h-6 w-6 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
							</svg>
						</button>
					</div>
					<ul x-show="open" x-cloak class="mt-2 space-y-1">
							<li class="mb-1 group ml-4 rounded-md {{ Route::is('admin.genre') ? 'bg-gray-200' : '' }}" x-data="{ open: false }">
								<a href="{{route('admin.genre')}}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 hover:bg-purple-700 hover:text-white">
								<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6 shrink-0">
								<path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
								</svg>	
								Genre
								</a>
							</li>
					</ul>
					
					</li>
					
			@endif

            <span class="text-gray-400 font-bold">USER</span>
				<li class="mb-1 mt-2 group rounded-md {{Route::is('dashboard') ? 'bg-purple-900 text-white' : ''}}">
					<a href="{{ route('dashboard') }}" class="group hover:text-white flex gap-x-3 hover:bg-purple-700 rounded-md p-2 text-sm font-semibold">
						<svg class="h-6 w-6 shrink-0 " fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
							<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
						</svg>
						Dashboard
					</a>
				</li>
				@php
					use App\Models\Notification;
		
					$notifications = Notification::where('user_id', auth()->user()->id)
						->where('is_read', false)
						->orderBy('created_at', 'desc')
						->get();
						//dd($notifications);
		
					$unreadCount = $notifications->count();
					//dd($unreadCount);
				@endphp

		@if($userRole == 'user')
            <span class="text-gray-400 font-bold">QUIZ</span>
            	<li class="mb-1 mt-2 group rounded-md {{Route::is('quizzes.index') ? 'bg-purple-900 text-white' : ''}}">
					<a href="{{ route('quizzes.index') }}" class="hover:text-white hover:bg-purple-700 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="M13.5 16.875h3.375m0 0h3.375m-3.375 0V13.5m0 3.375v3.375M6 10.5h2.25a2.25 2.25 0 0 0 2.25-2.25V6a2.25 2.25 0 0 0-2.25-2.25H6A2.25 2.25 0 0 0 3.75 6v2.25A2.25 2.25 0 0 0 6 10.5Zm0 9.75h2.25A2.25 2.25 0 0 0 10.5 18v-2.25a2.25 2.25 0 0 0-2.25-2.25H6a2.25 2.25 0 0 0-2.25 2.25V18A2.25 2.25 0 0 0 6 20.25Zm9.75-9.75H18a2.25 2.25 0 0 0 2.25-2.25V6A2.25 2.25 0 0 0 18 3.75h-2.25A2.25 2.25 0 0 0 13.5 6v2.25a2.25 2.25 0 0 0 2.25 2.25Z" />
						</svg>
						My Quiz
					</a>
				</li>

				<li class="mb-1 mt-2 group rounded-md {{Route::is('quizzes.history') ? 'bg-purple-900 text-white' : ''}}">
					<a href="{{ route('quizzes.history') }}" class="hover:text-white hover:bg-purple-700 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
					<path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" />
					</svg>
						Quiz History
					</a>
				</li>

            	<li class="mb-1 group rounded-md {{Route::is('bookmark.index') ? 'bg-purple-900 text-white' : ''}}">
					<a href="{{route('bookmark.index')}}" class="hover:text-white hover:bg-purple-700 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
					<path stroke-linecap="round" stroke-linejoin="round" d="M16.5 3.75V16.5L12 14.25 7.5 16.5V3.75m9 0H18A2.25 2.25 0 0 1 20.25 6v12A2.25 2.25 0 0 1 18 20.25H6A2.25 2.25 0 0 1 3.75 18V6A2.25 2.25 0 0 1 6 3.75h1.5m9 0h-9" />
					</svg>
					Favourite Quizzes
					</a>
				</li>

			<span class="text-gray-400 font-bold">GROUP</span>
				<li class="mb-1 mt-2 group rounded-md {{Route::is('groups.index') ? 'bg-purple-900 text-white' : ''}}">
					<a href="{{route('groups.index')}}" class="hover:text-white hover:bg-purple-700 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
					<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 7.125C2.25 6.504 2.754 6 3.375 6h6c.621 0 1.125.504 1.125 1.125v3.75c0 .621-.504 1.125-1.125 1.125h-6a1.125 1.125 0 0 1-1.125-1.125v-3.75ZM14.25 8.625c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v8.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-8.25ZM3.75 16.125c0-.621.504-1.125 1.125-1.125h5.25c.621 0 1.125.504 1.125 1.125v2.25c0 .621-.504 1.125-1.125 1.125h-5.25a1.125 1.125 0 0 1-1.125-1.125v-2.25Z" />
					</svg>
						My Group
					</a>
				</li>
				
				<li class="mb-1 group rounded-md {{ Route::is('groups.enroll') ? 'bg-purple-900 text-white' : '' }}" x-data="{ open: false }">
					<div class="flex items-center justify-between">
						<a href="{{ route('groups.enroll') }}" class="hover:text-white hover:bg-purple-700 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
							<svg class="h-6 w-6 shrink-0" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
							</svg>
							Enrolled Group
						</a>
						<button @click="open = !open" class="hover:text-white hover:bg-purple-700 rounded-md p-2">
							<svg :class="{ 'transform rotate-180': open }" class="h-6 w-6 transition-transform duration-200" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
								<path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
							</svg>
						</button>
					</div>
					<ul x-show="open" x-cloak class="mt-2 space-y-1">
						@foreach($groupDetails as $group)
							<li class="mb-1 group rounded-md {{ Route::is('groups.show') ? 'bg-gray-200' : '' }}" x-data="{ open: false }">
								@if($group)
								<a href="{{ route('groups.show', $group['group_id']) }}" class="group flex gap-x-3 rounded-md p-2 text-sm font-semibold leading-6 hover:bg-purple-700 hover:text-white">
									@if($group['creator_image'])
										<img src="{{ Storage::url($group['creator_image']) }}" alt="creator image" class="w-8 h-8 rounded-full object-cover">
									@else
										<img src="/images/default.jpeg" alt="default" class="w-8 h-8 rounded-full object-cover">
									@endif  
									<span class="truncate">{{$group['group_name']}}</span>
								</a>
								@endif
							</li>
						@endforeach
					</ul>

					</li>
					<span class="text-gray-400 font-bold">NOTIFICATION</span>
					<li class="mb-1 mt-2 group rounded-md {{Route::is('notifications.index') ? 'bg-purple-900 text-white' : ''}}">
						<a href="{{ route('notifications.index') }}" class="hover:text-white hover:bg-purple-700 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
							<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 0 0 5.454-1.31A8.967 8.967 0 0 1 18 9.75V9A6 6 0 0 0 6 9v.75a8.967 8.967 0 0 1-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 0 1-5.714 0m5.714 0a3 3 0 1 1-5.714 0M3.124 7.5A8.969 8.969 0 0 1 5.292 3m13.416 0a8.969 8.969 0 0 1 2.168 4.5" />
							</svg>
							Notification
							
							@if($unreadCount > 0)
							<span class="ml-auto w-9 min-w-max whitespace-nowrap rounded-full bg-indigo-600 px-2.5 py-0.5 text-center text-xs font-medium leading-5 text-white ring-1 ring-inset ring-indigo-500" aria-hidden="true">{{$unreadCount}}</span>
							@endif
						</a>
					</li> 

					<li class="mb-1 mt-2 group rounded-md {{Route::is('export.history') ? 'bg-purple-900 text-white' : ''}}">
						<a href="{{ route('export.history') }}" class="hover:text-white hover:bg-purple-700 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
						<path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 0 0-3.375-3.375h-1.5A1.125 1.125 0 0 1 13.5 7.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 0 0-9-9Z" />
						</svg>
							Export History
						</a>
					</li> 
				
				<li class="mb-1 group rounded-md {{Route::is('profile.edit') ? 'bg-purple-900 text-white' : ''}}">
					<a href="{{route('profile.edit')}}" class="hover:text-white hover:bg-purple-700 group flex gap-x-3 rounded-md p-2 text-sm leading-6 font-semibold">
						<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
							<path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 0 1 1.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.559.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.894.149c-.424.07-.764.383-.929.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 0 1-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.398.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 0 1-.12-1.45l.527-.737c.25-.35.272-.806.108-1.204-.165-.397-.506-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.108-1.204l-.526-.738a1.125 1.125 0 0 1 .12-1.45l.773-.773a1.125 1.125 0 0 1 1.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894Z" />
							<path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
						</svg>
						Setting
					</a>
				</li>
		@endif
				

        </ul>
    </div>
<div class="fixed top-0 left-0 w-full h-full bg-black/50 z-40 md:hidden sidebar-overlay"></div>
    
<script>

  
        const sidebarOverlay = document.querySelector('.sidebar-overlay')
        const sidebarMenu = document.querySelector('.sidebar-menu')
        // const main = document.querySelector('.main')
        // sidebarToggle.addEventListener('click', function (e) {
        //     e.preventDefault()
        //     main.classList.toggle('active')
        //     sidebarOverlay.classList.toggle('hidden')
        //     sidebarMenu.classList.toggle('-translate-x-full')
        // })
        // sidebarOverlay.addEventListener('click', function (e) {
        //     e.preventDefault()
        //     main.classList.add('active')
        //     sidebarOverlay.classList.add('hidden')
        //     sidebarMenu.classList.add('-translate-x-full')

        // })
        // document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (item) {
        //     item.addEventListener('click', function (e) {
        //         e.preventDefault()
        //         const parent = item.closest('.group')
        //         if (parent.classList.contains('selected')) {
        //             parent.classList.remove('selected')
        //         } else {
        //             // document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (i) {
        //             //     i.closest('.group').classList.remove('selected')
        //             // })
        //             parent.classList.add('selected')
        //         }
        //     })
        // })

        
</script>

<script src="//unpkg.com/alpinejs" defer></script>