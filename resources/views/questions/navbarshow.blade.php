
<div class="py-2 px-6 bg-gray-200 flex justify-between items-center shadow-md shadow-black/5 sticky top-0 left-0 z-30">
    <button type="button" class="text-lg text-gray-900 font-semibold sidebar-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
    </button>
</div>
        
        
<script>
            
    // function toggleDropdown() {
    //     var dropdownContent = document.getElementById('dropdownContent');
    //     dropdownContent.classList.toggle('hidden');
    // }

    // document.addEventListener('click', function(event) {
    //     var dropdownMenu = document.getElementById('dropdownMenu');
    //     var dropdownContent = document.getElementById('dropdownContent');

    //     if (!dropdownMenu.contains(event.target)) {
    //         dropdownContent.classList.add('hidden');
    //     }
    // });

        const sidebarToggle = document.querySelector('.sidebar-toggle')
        const main = document.querySelector('.main')
        document.addEventListener("DOMContentLoaded", function() {
        sidebarToggle.addEventListener('click', function (e) {
            e.preventDefault()
            main.classList.toggle('active')
            quizOverlay.classList.toggle('hidden')
            quizMenu.classList.toggle('-translate-x-full')
        });
        quizOverlay.addEventListener('click', function (e) {
            e.preventDefault()
            main.classList.add('active')
            quizOverlay.classList.add('hidden')
            quizMenu.classList.add('-translate-x-full')

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

