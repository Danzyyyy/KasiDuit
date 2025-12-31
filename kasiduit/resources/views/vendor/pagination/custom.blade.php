@if ($paginator->hasPages())
    <div class="flex flex-col md:flex-row items-center justify-between w-full gap-4">
        
        {{-- BAGIAN KIRI: Info "Showing X to Y of Z results" --}}
        <div class="text-sm text-gray-500">
            Showing 
            <span class="font-bold text-gray-900">{{ $paginator->firstItem() }}</span> 
            to 
            <span class="font-bold text-gray-900">{{ $paginator->lastItem() }}</span> 
            results
            {{-- <span class="font-bold text-gray-900">{{ $paginator->total() }}</span> 
            results --}}
        </div>

        {{-- BAGIAN KANAN: Tombol Navigasi --}}
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-2">
            
            {{-- Tombol Previous --}}
            @if ($paginator->onFirstPage())
                <span class="flex items-center justify-center w-10 h-10 text-gray-300 bg-white border border-gray-200 rounded-lg cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </span>
            @else
                <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" 
                    class="flex items-center justify-center w-10 h-10 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md focus:outline-none">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            @endif

            {{-- Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <span class="flex items-center justify-center w-10 h-10 text-gray-400 bg-gray-50 border border-gray-100 rounded-lg">
                        {{ $element }}
                    </span>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <span aria-current="page">
                                <span class="flex items-center justify-center w-10 h-10 text-sm font-bold text-white bg-red-600 border border-red-600 rounded-lg shadow-md shadow-red-200 transform scale-105 transition-all duration-300">
                                    {{ $page }}
                                </span>
                            </span>
                        @else
                            <button wire:click="gotoPage({{ $page }})" 
                                class="flex items-center justify-center w-10 h-10 text-sm font-medium text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md focus:outline-none">
                                {{ $page }}
                            </button>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Tombol Next --}}
            @if ($paginator->hasMorePages())
                <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" 
                    class="flex items-center justify-center w-10 h-10 text-gray-600 bg-white border border-gray-200 rounded-lg hover:bg-red-50 hover:text-red-600 hover:border-red-200 transition-all duration-300 hover:-translate-y-0.5 hover:shadow-md focus:outline-none">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </button>
            @else
                <span class="flex items-center justify-center w-10 h-10 text-gray-300 bg-white border border-gray-200 rounded-lg cursor-not-allowed">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                    </svg>
                </span>
            @endif
        </nav>
    </div>
@endif