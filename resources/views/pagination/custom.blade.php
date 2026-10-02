@if ($paginator->hasPages())
    <nav class="flex items-center bg-gray-100 justify-between bg-white px-4 py-3 sm:px-6" aria-label="Pagination">
        {{-- Previous Page Link --}}
        @if (!$paginator->onFirstPage())
            <a href="{{ $paginator->previousPageUrl() }}" class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-100 focus-visible:outline-offset-0" rel="prev" aria-label="@lang('pagination.previous')">Previous</a>
        @endif

        {{-- Spacer for alignment --}}
        <div class="flex-grow flex items-center gap-2"></div>

        {{-- Showing Message --}}
        <span class="text-sm text-gray-700">Showing <span class="font-medium">{{ $paginator->firstItem() }}</span> to <span class="font-medium">{{ $paginator->lastItem() }}</span> of <span class="font-medium ">{{ $paginator->total() }}</span> results</span>

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-100 focus-visible:outline-offset-0" rel="next" aria-label="@lang('pagination.next')">Next</a>
        @else
            <span class="relative inline-flex items-center rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-100 focus-visible:outline-offset-0 cursor-default" aria-disabled="true" aria-label="@lang('pagination.next')">Next</span>
        @endif
    </nav>
@endif
