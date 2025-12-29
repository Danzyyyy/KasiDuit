<div class="min-h-screen bg-gray-50 py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- KOLOM KIRI: FOTO & DESKRIPSI --}}
            <div class="w-full lg:w-2/3">
                <div class="rounded-2xl overflow-hidden mb-6 shadow-sm relative bg-gray-200">
                     <img src="{{ Str::startsWith($campaign->image_path, 'http') ? $campaign->image_path : asset('storage/'.$campaign->image_path) }}" 
                          alt="{{ $campaign->title }}" class="w-full h-[400px] object-cover">
                    
                    <span class="absolute top-4 left-4 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full">
                        {{ $campaign->category->name ?? 'Umum' }}
                    </span>
                </div>

                <div class="mb-8">
                    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">{{ $campaign->title }}</h1>
                    <div class="flex items-center gap-2 text-gray-600 text-sm">
                        <span>Oleh <span class="font-semibold text-gray-900">{{ $campaign->user->name ?? 'Hamba Allah' }}</span></span>
                        {{-- Logika Verifikasi (Active = Verified) --}}
                        @if($campaign->status === 'active')
                            <svg class="w-5 h-5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        @endif
                    </div>
                </div>

                {{-- TABS --}}
                <div class="border-b border-gray-200 mb-6">
                    <nav class="-mb-px flex space-x-8">
                        <button wire:click="setTab('cerita')" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'cerita' ? 'border-red-600 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">Cerita</button>
                        <button wire:click="setTab('donatur')" class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm {{ $activeTab === 'donatur' ? 'border-red-600 text-red-600' : 'border-transparent text-gray-500 hover:text-gray-700' }}">Donatur</button>
                    </nav>
                </div>

                <div class="bg-white rounded-xl p-6 border border-gray-100 text-gray-700 leading-relaxed whitespace-pre-line">
                    @if($activeTab === 'cerita')
                        {{-- Tab Cerita --}}
                        <div class="prose max-w-none text-gray-700">
                            {{ $campaign->full_description }}
                        </div>
                    @else
                        {{-- Tab Donatur (Versi Lebih Rapat/Compact) --}}
                        <div class="animate-fade-in-up">
                            {{-- Header dikurangi margin bawahnya (mb-6 jadi mb-4) --}}
                            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <span>Doa-doa Orang Baik</span>
                                <span class="bg-red-100 text-red-600 text-xs px-2 py-1 rounded-full">{{ count($donations) }} Donasi</span>
                            </h3>

                            <div class="flex flex-col">
                                @forelse($donations as $donor)
                                    {{-- Mengubah margin/padding besar (mb-6 pb-6) menjadi padding vertikal (py-3) agar lebih rapat --}}
                                    <div class="flex gap-3 py-3 border-b border-gray-100 last:border-0">
                                        {{-- Avatar diperkecil sedikit (w-12 jadi w-10) --}}
                                        <div class="shrink-0">
                                            @if($donor->is_anonymous)
                                                <div class="w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                                    <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                                    </svg>
                                                </div>
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($donor->donor_name) }}&background=fee2e2&color=dc2626" 
                                                     class="w-10 h-10 rounded-full object-cover">
                                            @endif
                                        </div>

                                        <div class="flex-1">
                                            <div class="flex justify-between items-start">
                                                <div>
                                                    {{-- Nama Donatur --}}
                                                    <h4 class="font-bold text-gray-900 text-sm">
                                                        {{ $donor->is_anonymous ? 'Hamba Allah' : $donor->donor_name }}
                                                    </h4>
                                                    {{-- Waktu --}}
                                                    <p class="text-xs text-gray-400">
                                                        {{ $donor->created_at->diffForHumans() }}
                                                    </p>
                                                </div>
                                                {{-- Nominal --}}
                                                <div class="text-right">
                                                    <span class="block font-bold text-gray-900 text-sm">
                                                        Rp {{ number_format($donor->amount, 0, ',', '.') }}
                                                    </span>
                                                </div>
                                            </div>

                                            {{-- Komentar / Doa (Margin atas diperkecil mt-3 jadi mt-2) --}}
                                            @if($donor->comment)
                                                <div class="mt-2 bg-gray-50 p-2.5 rounded-lg text-sm text-gray-600 italic">
                                                    "{{ $donor->comment }}"
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-8">
                                        <div class="w-12 h-12 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-2">
                                            <svg class="w-6 h-6 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                        </div>
                                        <p class="text-gray-500 text-sm font-medium">Belum ada donatur.</p>
                                        <p class="text-gray-400 text-xs">Jadilah yang pertama berdonasi!</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- KOLOM KANAN: DONASI --}}
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sticky top-24">
                    
                    <h3 class="text-3xl font-bold text-gray-900 mb-1">
                        Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}
                    </h3>
                    <p class="text-sm text-gray-500 mb-4">terkumpul dari Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>

                    <div class="w-full bg-gray-100 rounded-full h-2 mb-6">
                        <div class="bg-red-600 h-2 rounded-full" style="width: {{ min($percentage, 100) }}%"></div>
                    </div>

                    <div class="flex justify-between mb-8 text-sm">
                        {{-- <div><span class="block font-bold text-gray-900">0</span> <span class="text-gray-500">Donatur</span></div> --}}
                        <div class="text-right w-full"><span class="block font-bold text-gray-900">{{ $days_left }}</span> <span class="text-gray-500">Hari lagi</span></div>
                    </div>

                    {{-- Tombol Donasi --}}
                    {{-- LOGIKA TOMBOL STATUS --}}
                    @if($campaign->status === 'active')
                        
                        @if($days_left > 0)
                            {{-- STATUS: AKTIF & WAKTU MASIH ADA --}}
                            <a href="{{ route('campaign.donate', $campaign->id) }}" class="block w-full py-3.5 bg-red-600 hover:bg-red-700 text-white text-center font-bold rounded-xl transition shadow-lg shadow-red-200 mb-3">
                                Donasi Sekarang
                            </a>
                        @else
                            {{-- STATUS: AKTIF TAPI WAKTU HABIS --}}
                            <button disabled class="block w-full py-3.5 bg-gray-300 text-gray-500 text-center font-bold rounded-xl cursor-not-allowed mb-3">
                                Waktu Donasi Habis
                            </button>
                        @endif

                    @elseif($campaign->status === 'pending')
                        {{-- STATUS: PENDING --}}
                        <button disabled class="block w-full py-3.5 bg-yellow-100 text-yellow-700 text-center font-bold rounded-xl cursor-not-allowed mb-3 border border-yellow-200">
                            Menunggu Verifikasi Admin
                        </button>

                    @elseif($campaign->status === 'rejected')
                        {{-- STATUS: DITOLAK --}}
                        <button disabled class="block w-full py-3.5 bg-red-100 text-red-700 text-center font-bold rounded-xl cursor-not-allowed mb-3 border border-red-200">
                            Campaign Ditolak
                        </button>

                    @else
                        {{-- STATUS: SELESAI / FINISHED --}}
                        <button disabled class="block w-full py-3.5 bg-gray-300 text-gray-500 text-center font-bold rounded-xl cursor-not-allowed mb-3">
                            Campaign Selesai
                        </button>
                    @endif
                    
                    <button class="block w-full py-3.5 border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold rounded-xl transition flex items-center justify-center gap-2">
                        Bagikan
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>