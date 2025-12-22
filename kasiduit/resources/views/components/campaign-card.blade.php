@props(['campaign'])

<div 
    wire:click="$dispatch('openDonationModal', { campaignId: {{ $campaign['id'] }} })"
    class="group bg-white rounded-[32px] shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 flex flex-col h-full cursor-pointer active:scale-[0.98]"
>
    <div class="relative h-56 overflow-hidden">
        <img src="{{ $campaign['image'] }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-all"></div>
        <span class="absolute top-5 right-5 bg-white/95 backdrop-blur-sm text-brand-red text-[10px] font-black px-4 py-1.5 rounded-full shadow-lg uppercase">
            {{ $campaign['category'] }}
        </span>
    </div>

    <div class="p-7 flex flex-col flex-1">
        <div class="flex items-center gap-2 mb-3">
            <span class="text-[11px] text-gray-400 font-bold uppercase tracking-widest">{{ $campaign['organizer'] }}</span>
            @if($campaign['verified'] ?? false)
                <div class="bg-blue-500 p-0.5 rounded-full">
                    <svg class="w-2.5 h-2.5 text-white" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" /></svg>
                </div>
            @endif
        </div>

        <h3 class="font-extrabold text-gray-900 leading-tight mb-5 line-clamp-2 h-12 group-hover:text-brand-red transition-colors">
            {{ $campaign['title'] }}
        </h3>

        <div class="mt-auto">
            <div class="relative w-full h-2.5 bg-gray-100 rounded-full mb-4 overflow-hidden">
                @php
                    $percentage = $campaign['target'] > 0 ? ($campaign['collected'] / $campaign['target']) * 100 : 0;
                    $percentage = $percentage > 100 ? 100 : $percentage;
                @endphp
                <div class="absolute top-0 left-0 h-full bg-brand-red rounded-full transition-all duration-1000" 
                     style="width: {{ $percentage }}%">
                </div>
            </div>

            <div class="flex justify-between items-center mb-6">
                <div>
                    <p class="text-[10px] uppercase text-gray-400 font-bold">Terkumpul</p>
                    <p class="text-brand-red font-black text-xl">Rp {{ number_format($campaign['collected'], 0, ',', '.') }}</p>
                </div>
                <div class="bg-red-50 px-3 py-1 rounded-lg">
                    <p class="text-[11px] text-brand-red font-black">{{ round($percentage) }}%</p>
                </div>
            </div>

            <div class="w-full bg-gray-900 text-white py-4 rounded-[18px] font-black text-center group-hover:bg-brand-red transition-all shadow-lg">
                Lihat Detail & Donasi
            </div>
        </div>
    </div>
</div>