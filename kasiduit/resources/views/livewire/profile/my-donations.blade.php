<div class="min-h-screen bg-gray-50 pb-24 md:pb-12">
    
    {{-- ============================================================== --}}
    {{--                    HEADER KHUSUS MOBILE                        --}}
    {{-- ============================================================== --}}
    <div class="sticky top-0 z-30 bg-white border-b border-gray-200 px-4 h-16 flex items-center gap-3 shadow-sm md:hidden">
        {{-- Tombol Kembali --}}
        <a href="{{ route('home') }}" class="p-2 -ml-2 text-gray-600 hover:bg-gray-50 rounded-full transition">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
        </a>
        <h1 class="text-lg font-bold text-gray-900">Riwayat Kebaikan</h1>
    </div>

    {{-- ============================================================== --}}
    {{--                        LIST DONASI                             --}}
    {{-- ============================================================== --}}
    <div class="max-w-2xl mx-auto px-4 py-4 md:py-8">
        
        {{-- Judul untuk Desktop (Optional, karena fokus HP) --}}
        <div class="hidden md:block mb-6">
            <h2 class="text-2xl font-bold text-gray-900">Riwayat Donasi Saya</h2>
            <div class="w-16 h-1 bg-red-600 mt-2 rounded-full"></div>
        </div>

        <div class="space-y-4">
            @forelse($donations as $donation)
                {{-- CARD DONASI --}}
                <div class="bg-white rounded-xl p-4 shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 flex gap-4 transition hover:shadow-md">
                    
                    {{-- Gambar Campaign (Kiri) --}}
                    <div class="flex-shrink-0 relative">
                        <img src="{{ $donation->campaign->image_path ? (Str::startsWith($donation->campaign->image_path, 'http') ? $donation->campaign->image_path : asset('storage/'.$donation->campaign->image_path)) : 'https://via.placeholder.com/150' }}" 
                             class="w-20 h-20 rounded-xl object-cover bg-gray-100 shadow-sm">
                        
                        {{-- Kategori Badge Kecil (Opsional) --}}
                        <div class="absolute -bottom-1 -right-1 bg-white p-0.5 rounded-full">
                            <span class="block w-2.5 h-2.5 bg-red-500 rounded-full"></span>
                        </div>
                    </div>

                    {{-- Info Donasi (Kanan) --}}
                    <div class="flex-1 flex flex-col justify-between min-w-0">
                        <div>
                            {{-- Header Card: Status & Tanggal --}}
                            <div class="flex justify-between items-start mb-1">
                                <p class="text-[10px] text-gray-400 font-medium truncate">
                                    {{ \Carbon\Carbon::parse($donation->created_at)->format('d M Y, H:i') }}
                                </p>
                                
                                {{-- Status Badge --}}
                                @if($donation->status == 'paid')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-green-50 text-green-700 border border-green-100">
                                        Berhasil
                                    </span>
                                @elseif($donation->status == 'pending')
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-yellow-50 text-yellow-700 border border-yellow-100 animate-pulse">
                                        Menunggu
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-[10px] font-bold bg-red-50 text-red-700 border border-red-100">
                                        Gagal
                                    </span>
                                @endif
                            </div>

                            {{-- Judul Campaign --}}
                            <h3 class="text-sm font-bold text-gray-900 line-clamp-2 leading-snug mb-1">
                                <a href="{{ route('campaign.detail', $donation->campaign_id) }}" class="hover:text-red-600 transition">
                                    {{ $donation->campaign->title }}
                                </a>
                            </h3>
                        </div>

                        {{-- Footer Card: Nominal & Aksi --}}
                        <div class="flex justify-between items-end mt-2">
                            <div>
                                <p class="text-[10px] text-gray-400">Donasi Kamu</p>
                                <p class="text-sm font-bold text-gray-900">
                                    Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                </p>
                            </div>

                            {{-- Tombol Bayar (Hanya jika Pending) --}}
                            @if($donation->status == 'pending')
                                <a href="{{ route('donation.check', ['order_id' => $donation->order_id]) }}" class="px-3 py-1.5 bg-red-600 text-white text-[10px] font-bold rounded-full hover:bg-red-700 shadow-sm transition transform active:scale-95 flex items-center gap-1">
                                    Bayar
                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                {{-- EMPTY STATE (Jika Kosong) --}}
                <div class="flex flex-col items-center justify-center py-16 px-4 text-center mt-10">
                    <div class="w-24 h-24 bg-red-50 rounded-full flex items-center justify-center mb-6 shadow-sm">
                        <svg class="w-10 h-10 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Belum ada donasi</h3>
                    <p class="text-sm text-gray-500 max-w-xs mx-auto mb-8 leading-relaxed">
                        Jejak kebaikanmu akan muncul di sini. Yuk, mulai bantu mereka yang membutuhkan sekarang!
                    </p>
                    <a href="{{ route('campaigns.index') }}" class="px-8 py-3 bg-red-600 text-white font-bold text-sm rounded-full shadow-lg shadow-red-200 hover:bg-red-700 hover:shadow-xl transition transform hover:-translate-y-1">
                        Mulai Berbagi
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>