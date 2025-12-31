<div class="min-h-screen bg-gray-50 pb-20 md:pb-12">
    
    {{-- Container Utama --}}
    <div class="max-w-3xl mx-auto px-4 py-6 md:py-8 animate-fade-in-up">
        
        {{-- Header Halaman --}}
        <div class="mb-6 flex flex-col md:flex-row md:items-center justify-between border-b border-gray-200 pb-4 gap-2">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">Riwayat Donasi</h1>
                <p class="text-xs md:text-sm text-gray-500 mt-1">Jejak kebaikan yang telah Anda tanam.</p>
            </div>
            {{-- Opsional: Bisa tambah filter di sini nanti --}}
        </div>
        
        <div class="space-y-3 md:space-y-4">
            @forelse($myDonations as $donation)
                
                {{-- CARD DONASI --}}
                <div class="bg-white rounded-xl p-3 md:p-5 shadow-[0_2px_8px_rgba(0,0,0,0.04)] border border-gray-100 flex gap-3 md:gap-5 transition hover:shadow-md hover:border-red-100 relative overflow-hidden group">
                    
                    {{-- 1. Gambar Campaign (Ukuran Responsif) --}}
                    <div class="flex-shrink-0 relative">
                        <img src="{{ $donation->campaign->image_path ? (Str::startsWith($donation->campaign->image_path, 'http') ? $donation->campaign->image_path : asset('storage/'.$donation->campaign->image_path)) : 'https://via.placeholder.com/150' }}" 
                             class="w-16 h-16 md:w-24 md:h-24 rounded-lg md:rounded-xl object-cover bg-gray-100 shadow-sm">
                        
                        {{-- Indikator Status (Dot) - Hanya muncul di mobile untuk hemat tempat --}}
                        <div class="md:hidden absolute -bottom-1 -right-1 bg-white p-0.5 rounded-full">
                            <span class="block w-2.5 h-2.5 {{ $donation->status == 'paid' ? 'bg-green-500' : ($donation->status == 'pending' ? 'bg-yellow-400' : 'bg-red-500') }} rounded-full ring-2 ring-white"></span>
                        </div>
                    </div>

                    {{-- 2. Konten Tengah --}}
                    <div class="flex-1 flex flex-col justify-between min-w-0">
                        
                        {{-- Bagian Atas: Meta & Judul --}}
                        <div>
                            <div class="flex justify-between items-start mb-1">
                                {{-- Tanggal --}}
                                <p class="text-[10px] md:text-xs text-gray-400 font-medium flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    {{ \Carbon\Carbon::parse($donation->created_at)->translatedFormat('d M Y') }}
                                </p>

                                {{-- Status Badge (Tampil text lengkap di Desktop, Icon/Warna di Mobile dihandle di gambar) --}}
                                <div class="hidden md:block">
                                    @if($donation->status == 'paid')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-green-50 text-green-700 border border-green-100">Berhasil</span>
                                    @elseif($donation->status == 'pending')
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-yellow-50 text-yellow-700 border border-yellow-100 animate-pulse">Menunggu</span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-100">Gagal</span>
                                    @endif
                                </div>
                            </div>

                            {{-- Judul Campaign --}}
                            <h3 class="text-sm md:text-base font-bold text-gray-900 line-clamp-2 leading-tight mb-2 group-hover:text-red-600 transition">
                                <a href="{{ route('campaign.detail', $donation->campaign_id) }}" class="focus:outline-none">
                                    {{ $donation->campaign->title }}
                                    <span class="absolute inset-0 md:hidden"></span> {{-- Trik UX: Klik area kosong di mobile masuk ke detail --}}
                                </a>
                            </h3>
                        </div>

                        {{-- Bagian Bawah: Nominal & Action --}}
                        <div class="flex items-end justify-between mt-auto relative z-10"> {{-- z-10 agar tombol bisa diklik di atas link absolute --}}
                            <div>
                                <p class="text-[10px] md:text-xs text-gray-400">Total Donasi</p>
                                <p class="text-sm md:text-lg font-bold text-gray-900">
                                    Rp {{ number_format($donation->amount, 0, ',', '.') }}
                                </p>
                            </div>

                            {{-- Tombol Bayar (Hanya jika Pending) --}}
                            @if($donation->status == 'pending')
                                <a href="{{ route('donation.check', ['order_id' => $donation->order_id]) }}" 
                                   class="px-3 py-1.5 md:px-4 md:py-2 bg-red-600 text-white text-[10px] md:text-sm font-bold rounded-lg hover:bg-red-700 shadow-md shadow-red-100 transition transform active:scale-95 flex items-center gap-1">
                                    Bayar
                                    <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

            @empty
                {{-- EMPTY STATE --}}
                <div class="py-12 flex flex-col items-center justify-center text-center">
                    <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-1">Belum ada donasi</h3>
                    <p class="text-sm text-gray-500 mb-6 px-6">Yuk mulai berbagi kebaikan hari ini!</p>
                    <a href="{{ route('campaigns.index') }}" class="px-6 py-2.5 bg-red-600 text-white text-sm font-bold rounded-full shadow-lg shadow-red-200 hover:bg-red-700 transition">
                        Cari Donasi
                    </a>
                </div>
            @endforelse
        </div>
    </div>
</div>