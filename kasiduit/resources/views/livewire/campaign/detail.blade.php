<div class="min-h-screen bg-gray-50 py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- KOLOM KIRI: FOTO & DESKRIPSI --}}
            <div class="w-full lg:w-2/3">
                
                {{-- GAMBAR UTAMA --}}
                <div class="rounded-2xl overflow-hidden mb-6 shadow-sm relative bg-gray-200 group">
                     <img src="{{ Str::startsWith($campaign->image_path, 'http') ? $campaign->image_path : asset('storage/'.$campaign->image_path) }}" 
                          alt="{{ $campaign->title }}" class="w-full h-[300px] md:h-[450px] object-cover">
                    
                    {{-- TOMBOL KEMBALI --}}
                    <a href="{{ route('home') }}" class="absolute top-4 left-4 bg-white/90 hover:bg-white text-gray-600 hover:text-red-600 p-2.5 rounded-full shadow-md backdrop-blur-sm transition-all duration-300 transform hover:scale-105 flex items-center justify-center" title="Kembali ke Beranda">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                    </a>

                    {{-- LABEL KATEGORI --}}
                    <span class="absolute top-4 right-4 bg-red-600/90 backdrop-blur-sm text-white text-xs font-bold px-4 py-1.5 rounded-full shadow-sm">
                        {{ $campaign->category->name ?? 'Umum' }}
                    </span>
                </div>

                {{-- JUDUL & INFO --}}
                <div class="mb-6">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">{{ $campaign->title }}</h1>
                    
                    {{-- Container Flex agar User & Lokasi sejajar --}}
                    <div class="flex flex-wrap items-center gap-y-2 gap-x-3 text-sm text-gray-600">
                        
                        {{-- 1. BAGIAN USER --}}
                        <div class="flex items-center gap-1">
                            <span>Oleh <span class="font-semibold text-gray-900">{{ $campaign->user->name ?? 'Hamba Allah' }}</span></span>
                            @if($campaign->status === 'active')
                                {{-- Icon Verified --}}
                                <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                            @endif
                        </div>

                        {{-- 2. BAGIAN LOKASI (Hanya muncul jika ada data) --}}
                        @if($campaign->regency_name)
                            {{-- Pembatas Garis (Hanya tampil di layar lebar) --}}
                            <span class="text-gray-300 hidden sm:inline">|</span>

                            <div class="flex items-center gap-1">
                                {{-- Icon Map Pin --}}
                                <svg class="w-4 h-4 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                
                                <span class="text-gray-700 font-medium">
                                    {{ $campaign->district_name }}, {{ $campaign->regency_name }}
                                </span>
                            </div>
                        @endif

                    </div>
                </div>

                {{-- NAVIGASI TABS --}}
                <div class="border-b border-gray-200 mb-4">
                    <nav class="-mb-px flex space-x-8">
                        <button wire:click="setTab('cerita')" class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition {{ $activeTab === 'cerita' ? 'border-red-600 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">Cerita</button>
                        <button wire:click="setTab('donatur')" class="whitespace-nowrap py-3 px-1 border-b-2 font-medium text-sm transition {{ $activeTab === 'donatur' ? 'border-red-600 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">Donatur</button>
                    </nav>
                </div>

                {{-- ISI KONTEN TABS --}}
                {{-- PERBAIKAN: Hapus min-h-[200px], gunakan h-fit, dan padding responsive --}}
                <div class="bg-white rounded-xl p-4 md:p-6 border border-gray-100 text-gray-700 leading-relaxed shadow-sm w-full h-fit">
                    
                    @if($activeTab === 'cerita')
                        
                        {{-- === BAGIAN CERITA === --}}
                        <div x-data="{ expanded: false }" class="w-full">
                            
                            {{-- PERBAIKAN: break-all agar teks 'aaaaa' tidak bablas keluar --}}
                            <div class="prose max-w-none text-gray-700 text-sm md:text-base leading-relaxed text-justify w-full overflow-hidden break-words break-all">
                                
                                @if(strlen($campaign->full_description) > 100)
                                    
                                    {{-- Tampilan Pendek --}}
                                    <span x-show="!expanded">
                                        {{ Str::limit($campaign->full_description, 100, '...') }}
                                    </span>

                                    {{-- Tampilan Penuh --}}
                                    <span x-show="expanded" x-cloak class="animate-fade-in block w-full">
                                        {!! nl2br(e($campaign->full_description)) !!}
                                    </span>

                                @else
                                    {{-- Jika teks pendek --}}
                                    <span class="block w-full">
                                        {!! nl2br(e($campaign->full_description)) !!}
                                    </span>
                                @endif
                            </div>

                            {{-- Tombol Read More --}}
                            @if(strlen($campaign->full_description) > 100)
                                <button @click="expanded = !expanded" 
                                        class="mt-4 text-red-600 font-bold text-sm hover:underline focus:outline-none flex items-center gap-1 transition-colors">
                                    <span x-text="expanded ? 'Sembunyikan' : 'Baca Selengkapnya'"></span>
                                    <svg x-show="!expanded" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                                    <svg x-show="expanded" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="display: none;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" /></svg>
                                </button>
                            @endif
                        </div>

                    @else
                        {{-- === TAB DONATUR === --}}
                        <div class="animate-fade-in-up w-full">
                            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <span>Doa-doa Orang Baik</span>
                                <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full font-bold">{{ count($donations) }} Donasi</span>
                            </h3>

                            <div class="flex flex-col space-y-4">
                                @forelse($donations as $donor)
                                    <div class="flex gap-4 border-b border-gray-50 pb-4 last:border-0 last:pb-0">
                                        <div class="shrink-0">
                                            @if($donor->is_anonymous)
                                                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                                                </div>
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($donor->donor_name) }}&background=fee2e2&color=dc2626" class="w-10 h-10 rounded-full object-cover border border-gray-100">
                                            @endif
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <div class="flex justify-between items-start mb-1">
                                                <div>
                                                    <h4 class="font-bold text-gray-900 text-sm truncate">
                                                        {{ $donor->is_anonymous ? 'Hamba Allah' : $donor->donor_name }}
                                                    </h4>
                                                    <p class="text-xs text-gray-400 mt-0.5">{{ $donor->created_at->diffForHumans() }}</p>
                                                </div>
                                                <div class="text-right">
                                                    <span class="block font-bold text-gray-900 text-sm">Rp {{ number_format($donor->amount, 0, ',', '.') }}</span>
                                                </div>
                                            </div>
                                            @if($donor->comment)
                                                <div class="mt-2 bg-gray-50 p-3 rounded-lg text-sm text-gray-600 italic border border-gray-100 break-words break-all">
                                                    "{{ $donor->comment }}"
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-10">
                                        <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-3">
                                            <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                                        </div>
                                        <p class="text-gray-500 text-sm font-medium">Belum ada donatur.</p>
                                        <p class="text-gray-400 text-xs mt-1">Jadilah yang pertama berdonasi!</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- KOLOM KANAN: KARTU DONASI (STICKY) --}}
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</h3>
                    <p class="text-sm text-gray-500 mb-4">terkumpul dari Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                    <div class="w-full bg-gray-100 rounded-full h-2 mb-6 overflow-hidden">
                        <div class="bg-red-600 h-2 rounded-full transition-all duration-1000 ease-out" style="width: {{ min($percentage, 100) }}%"></div>
                    </div>
                    <div class="flex justify-between mb-8 text-sm">
                        <div class="text-right w-full">
                            <span class="block font-bold text-gray-900 text-lg">{{ $days_left }}</span> 
                            <span class="text-gray-500">Hari lagi</span>
                        </div>
                    </div>

                    @if($campaign->status === 'active')
                        @if($days_left > 0)
                            <a href="{{ route('campaign.donate', $campaign->id) }}" class="block w-full py-3.5 bg-red-600 hover:bg-red-700 text-white text-center font-bold rounded-xl transition shadow-lg shadow-red-200 mb-3 transform hover:-translate-y-0.5">Donasi Sekarang</a>
                        @else
                            <button disabled class="block w-full py-3.5 bg-gray-300 text-gray-500 text-center font-bold rounded-xl cursor-not-allowed mb-3">Waktu Donasi Habis</button>
                        @endif
                    @elseif($campaign->status === 'pending')
                        <button disabled class="block w-full py-3.5 bg-yellow-100 text-yellow-700 text-center font-bold rounded-xl cursor-not-allowed mb-3 border border-yellow-200">Menunggu Verifikasi Admin</button>
                    @elseif($campaign->status === 'rejected')
                        <button disabled class="block w-full py-3.5 bg-red-100 text-red-700 text-center font-bold rounded-xl cursor-not-allowed mb-3 border border-red-200">Campaign Ditolak</button>
                    @else
                        <button disabled class="block w-full py-3.5 bg-gray-300 text-gray-500 text-center font-bold rounded-xl cursor-not-allowed mb-3">Campaign Selesai</button>
                    @endif
                    
                    {{-- TOMBOL SHARE / BAGIKAN (DENGAN ALPINE.JS) --}}
                    <div x-data="{
                        copied: false,
                        shareData: {
                            title: '{{ $campaign->title }}',
                            text: 'Ayo bantu donasi untuk: {{ $campaign->title }}. Cek selengkapnya di sini:',
                            url: '{{ url()->current() }}'
                        },
                        async share() {
                            if (navigator.share) {
                                try {
                                    await navigator.share(this.shareData);
                                } catch (err) {
                                    console.log('Share dibatalkan');
                                }
                            } else {
                                navigator.clipboard.writeText(this.shareData.url);
                                this.copied = true;
                                setTimeout(() => this.copied = false, 2000);
                            }
                        }
                    }" class="w-full">
                    
                        <button @click="share" 
                                :class="copied ? 'bg-green-50 border-green-200 text-green-700' : 'bg-white border-gray-300 hover:bg-gray-50 text-gray-700'"
                                class="block w-full py-3.5 border font-bold rounded-xl transition flex items-center justify-center gap-2">
                            
                            {{-- Ikon Share (Default) --}}
                            <svg x-show="!copied" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                            </svg>
                    
                            {{-- Ikon Check (Copied) --}}
                            <svg x-show="copied" style="display: none;" class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                    
                            <span x-text="copied ? 'Link Tersalin!' : 'Bagikan'"></span>
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>