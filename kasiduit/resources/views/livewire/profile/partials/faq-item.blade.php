<div class="bg-white border border-gray-200 rounded-xl overflow-hidden transition-all duration-300 mb-4" 
     {{-- Perbaikan: Tambahkan tanda kutip '' di sekitar {{ $id }} --}}
     :class="activeQuestion === '{{ $id }}' ? 'shadow-md border-red-200 ring-1 ring-red-50' : 'shadow-sm hover:border-red-100'">
    
    <button @click="activeQuestion === '{{ $id }}' ? activeQuestion = null : activeQuestion = '{{ $id }}'" 
            class="w-full flex justify-between items-center px-6 py-5 text-left focus:outline-none bg-white hover:bg-gray-50 transition">
        
        <span class="font-bold text-gray-800 text-base" 
              :class="activeQuestion === '{{ $id }}' ? 'text-red-600' : ''">
            {{ $question }}
        </span>
        
        <span class="ml-4 flex-shrink-0 text-red-600 bg-red-50 p-1 rounded-full transition-transform duration-300"
              :class="activeQuestion === '{{ $id }}' ? 'rotate-180 bg-red-100' : ''">
            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </span>
    </button>

    {{-- Perbaikan: Tambahkan tanda kutip '' di sini juga --}}
    <div x-show="activeQuestion === '{{ $id }}'" x-collapse>
        <div class="px-6 pb-6 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 bg-gray-50/30">
            {{ $answer }}
        </div>
    </div>
</div>