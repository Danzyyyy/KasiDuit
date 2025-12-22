@props(['campaign'])

<<<<<<< HEAD
<div 
    wire:click="$dispatch('openDonationModal', { campaignId: {{ $campaign['id'] }} })"
    class="group bg-white rounded-[32px] shadow-sm hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 flex flex-col h-full cursor-pointer active:scale-[0.98]"
>
    <div class="relative h-56 overflow-hidden">
        <img src="{{ $campaign['image'] }}" class="w-full h-full object-cover transform group-hover:scale-110 transition duration-700">
        <div class="absolute inset-0 bg-black/20 group-hover:bg-transparent transition-all"></div>
        <span class="absolute top-5 right-5 bg-white/95 backdrop-blur-sm text-brand-red text-[10px] font-black px-4 py-1.5 rounded-full shadow-lg uppercase">
=======
<div class="group bg-white rounded-xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden border border-gray-100 flex flex-col h-full">
    <div class="relative h-48 overflow-hidden">
        <img src="{{ $campaign['image'] }}" alt="{{ $campaign['title'] }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-500">
        
        <span class="absolute top-4 right-4 bg-brand-red text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
>>>>>>> 3b05a1277d1ccccd91955fb64f6cd2a4a4015374
            {{ $campaign['category'] }}
        </span>
    </div>

<<<<<<< HEAD
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
=======
    <div class="p-5 flex flex-col flex-1">
        <div class="flex items-center gap-1 mb-2">
            <span class="text-xs text-gray-500 font-medium truncate">{{ $campaign['organizer'] }}</span>
            @if($campaign['verified'])
                <svg class="w-3 h-3 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            @endif
        </div>

        <h3 class="text-lg font-bold text-gray-900 mb-4 line-clamp-2 leading-snug group-hover:text-brand-red transition">
>>>>>>> 3b05a1277d1ccccd91955fb64f6cd2a4a4015374
            {{ $campaign['title'] }}
        </h3>

        <div class="mt-auto">
<<<<<<< HEAD
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
=======
            <div class="w-full bg-gray-200 rounded-full h-2 mb-3">
                <div class="bg-brand-red h-2 rounded-full transition-all duration-1000" style="width: {{ $campaign['percentage'] }}%"></div>
            </div>

            <div class="flex justify-between items-end mb-1">
                <div>
                    <p class="text-xs text-gray-500 mb-0.5">Terkumpul</p>
                    <p class="text-brand-red font-bold">Rp {{ number_format($campaign['collected'], 0, ',', '.') }}</p>
                </div>
                <div class="text-right">
                    <p class="text-xs text-gray-400">dari Rp {{ number_format($campaign['target'], 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="flex justify-between items-center mt-4 pt-3 border-t border-gray-50">
                <div class="flex items-center gap-1 text-xs text-gray-500">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    {{ $campaign['donors_count'] }} Donatur
                </div>
                <div class="flex items-center gap-1 text-xs text-gray-500">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $campaign['days_left'] }} hari lagi
                </div>
>>>>>>> 3b05a1277d1ccccd91955fb64f6cd2a4a4015374
            </div>
        </div>
    </div>
</div>