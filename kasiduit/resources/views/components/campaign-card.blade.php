@props(['campaign'])

<div class="bg-white rounded-xl shadow-sm border border-gray-100 hover:shadow-md transition duration-300 overflow-hidden flex flex-col h-full group">
    
    <a href="{{ route('campaign.detail', $campaign['id']) }}" class="block relative h-48 overflow-hidden">
        <img src="{{ $campaign['image'] }}" alt="{{ $campaign['title'] }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
        
        <span class="absolute top-4 right-4 bg-red-600 text-white text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wide">
            {{ $campaign['category'] }}
        </span>
    </a>

    <div class="p-5 flex flex-col flex-grow">
        
        <div class="flex items-center gap-1.5 mb-2">
            <span class="text-xs text-gray-500 font-medium truncate">{{ $campaign['organizer'] }}</span>
            @if($campaign['verified'])
                <svg class="w-3.5 h-3.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
            @endif
        </div>

        <h3 class="text-gray-900 font-semibold text-base leading-snug mb-4 line-clamp-2 group-hover:text-red-600 transition">
            <a href="{{ route('campaign.detail', $campaign['id']) }}">
                {{ $campaign['title'] }}
            </a>
        </h3>

        <div class="mt-auto">
            <div class="flex justify-between text-xs text-gray-500 mb-1.5">
                <span>Terkumpul</span>
                <span class="font-bold text-red-600">{{ $campaign['percentage'] }}%</span>
            </div>
            <div class="w-full bg-gray-100 rounded-full h-1.5 mb-3">
                <div class="bg-red-600 h-1.5 rounded-full transition-all duration-1000" style="width: {{ $campaign['percentage'] }}%"></div>
            </div>

            <div class="mb-4">
                <div class="text-sm font-bold text-gray-900">
                    Rp {{ number_format($campaign['collected'], 0, ',', '.') }}
                </div>
                <div class="text-xs text-gray-400">
                    dari Rp {{ number_format($campaign['target'], 0, ',', '.') }}
                </div>
            </div>

            <div class="flex justify-between items-center pt-3 border-t border-gray-50 text-xs text-gray-500">
                <span>{{ number_format($campaign['donors_count'], 0, ',', '.') }} Donatur</span>
                <div class="flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $campaign['days_left'] }} hari lagi
                </div>
            </div>
        </div>
    </div>
</div>