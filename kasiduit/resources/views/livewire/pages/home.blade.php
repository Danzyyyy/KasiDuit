<div>
    {{-- HERO SECTION --}}
    <x-hero :stats="$stats" />

    {{-- KATEGORI DONASI SECTION --}}
    <section class="py-16 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-10">
                <h2 class="text-2xl font-bold text-gray-900">Kategori Donasi</h2>
                <div class="w-16 h-1 bg-red-600 mx-auto mt-2 rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-7 gap-4">
                @foreach($categories as $cat)
                <a href="{{ route('campaigns.index', ['category' => $cat->name]) }}" class="group flex flex-col items-center justify-center p-4 bg-white border border-gray-100 rounded-xl shadow-sm hover:shadow-lg hover:border-red-100 transition-all duration-300 cursor-pointer h-36">
                    <div class="text-4xl mb-3 transition-transform duration-300 group-hover:scale-110 filter drop-shadow-sm">
                        {{ $cat->icon }}
                    </div>
                    <span class="text-sm font-bold text-gray-700 text-center group-hover:text-red-600 transition-colors px-1 leading-tight">
                        {{ $cat->name }}
                    </span>
                    <span class="text-[10px] text-gray-400 mt-1 font-medium">
                        {{ $cat->campaigns_count }} campaign
                    </span>
                </a>
                @endforeach
            </div>
        </div>
    </section>

    {{-- CAMPAIGN TERBARU SECTION --}}
    {{-- PERUBAHAN: Background diganti jadi Putih (bg-white) dan ditambah border atas --}}
    <section class="py-16 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">Campaign Terbaru</h2>
                    <p class="text-gray-500 mt-1 text-sm md:text-base">Bantuan yang sangat dibutuhkan oleh kita semua</p>
                </div>
                <a href="{{ route('campaigns.index', ['sort' => 'Terbaru']) }}" class="text-red-600 font-bold hover:text-red-700 flex items-center gap-1 transition text-sm md:text-base">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($campaigns as $campaign)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-300 group flex flex-col h-full">
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ Str::startsWith($campaign->image_path, 'http') ? $campaign->image_path : asset('storage/'.$campaign->image_path) }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <span class="absolute top-3 left-3 bg-red-600 text-white text-[10px] uppercase font-bold px-2.5 py-1 rounded shadow-sm">
                                {{ $campaign->category->name ?? 'Umum' }}
                            </span>
                        </div>
                        
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 leading-tight group-hover:text-red-600 transition">
                                <a href="{{ route('campaign.detail', $campaign->id) }}">
                                    {{ $campaign->title }}
                                </a>
                            </h3>
                            
                            <div class="flex items-center gap-1.5 mb-4 text-xs text-gray-500">
                                <span class="font-medium truncate max-w-[150px]">{{ $campaign->user->name ?? 'Anonim' }}</span>
                                @if($campaign->status === 'active')
                                    <svg class="w-3.5 h-3.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                @endif
                            </div>

                            @php
                                $percent = $campaign->target_amount > 0 ? ($campaign->collected_amount / $campaign->target_amount) * 100 : 0;
                            @endphp
                            <div class="w-full bg-gray-100 rounded-full h-2 mb-2">
                                <div class="bg-red-600 h-2 rounded-full" style="width: {{ min($percent, 100) }}%"></div>
                            </div>
                            
                            <div class="flex justify-between text-xs mb-5">
                                <div>
                                    <p class="text-gray-400 mb-0.5">Terkumpul</p>
                                    <p class="font-bold text-gray-900">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-gray-400 mb-0.5">Sisa Waktu</p>
                                    <p class="font-bold text-gray-900">
                                        @php
                                            $deadline = \Carbon\Carbon::parse($campaign->deadline)->endOfDay();
                                            $sisaHari = $deadline->isPast() ? 0 : (int) ceil(now()->floatDiffInDays($deadline));
                                        @endphp
                                        {{ $sisaHari }} Hari
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('campaign.detail', $campaign->id) }}" class="mt-auto w-full py-2.5 bg-white border border-red-600 text-red-600 font-bold rounded-lg text-sm hover:bg-red-50 transition text-center">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <div class="bg-white rounded-xl border border-dashed border-gray-300 p-8 max-w-lg mx-auto">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                            <h3 class="text-gray-900 font-medium mb-1">Belum ada campaign aktif</h3>
                            <p class="text-gray-500 text-sm">Nantikan campaign-campaign kebaikan selanjutnya.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- CAMPAIGN MENDESAK SECTION --}}
    <section class="py-16 bg-white border-t border-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center mb-8">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 flex items-center gap-2">
                        Campaign Mendesak
                    </h2>
                    <p class="text-gray-500 mt-1 text-sm md:text-base">Waktu semakin sedikit, bantuanmu sangat dinanti.</p>
                </div>
                <a href="{{ route('campaigns.index', ['sort' => 'Mendesak (Sisa Waktu Sedikit)']) }}" class="text-red-600 font-bold hover:text-red-700 flex items-center gap-1 transition text-sm md:text-base">
                    Lihat Semua
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($urgentCampaigns as $campaign)
                    <div class="bg-white rounded-xl shadow-sm border border-red-100 overflow-hidden hover:shadow-xl hover:-translate-y-1 transition duration-300 group flex flex-col h-full relative">
                        
                        {{-- Badge Mendesak --}}
                        <div class="absolute top-0 right-0 bg-red-600 text-white text-[10px] font-bold px-3 py-1 rounded-bl-xl z-10 shadow-sm animate-pulse">
                            MENDESAK
                        </div>

                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ Str::startsWith($campaign->image_path, 'http') ? $campaign->image_path : asset('storage/'.$campaign->image_path) }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                            <span class="absolute top-3 left-3 bg-white/90 text-gray-800 text-[10px] uppercase font-bold px-2.5 py-1 rounded shadow-sm">
                                {{ $campaign->category->name ?? 'Umum' }}
                            </span>
                        </div>
                        
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 leading-tight group-hover:text-red-600 transition">
                                <a href="{{ route('campaign.detail', $campaign->id) }}">
                                    {{ $campaign->title }}
                                </a>
                            </h3>
                            
                            <div class="flex items-center gap-1.5 mb-4 text-xs text-gray-500">
                                <span class="font-medium truncate max-w-[150px]">{{ $campaign->user->name ?? 'Anonim' }}</span>
                                @if($campaign->status === 'active')
                                    <svg class="w-3.5 h-3.5 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                @endif
                            </div>

                            @php
                                $percent = $campaign->target_amount > 0 ? ($campaign->collected_amount / $campaign->target_amount) * 100 : 0;
                                $deadline = \Carbon\Carbon::parse($campaign->deadline)->endOfDay();
                                $sisaHari = $deadline->isPast() ? 0 : (int) ceil(now()->floatDiffInDays($deadline));
                            @endphp

                            <div class="w-full bg-gray-100 rounded-full h-2 mb-2">
                                <div class="bg-red-600 h-2 rounded-full" style="width: {{ min($percent, 100) }}%"></div>
                            </div>
                            
                            <div class="flex justify-between text-xs mb-5">
                                <div>
                                    <p class="text-gray-400 mb-0.5">Terkumpul</p>
                                    <p class="font-bold text-gray-900">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-red-500 font-bold mb-0.5 animate-pulse">Sisa Waktu</p>
                                    <p class="font-bold text-red-600 text-lg">
                                        {{ $sisaHari }} Hari
                                    </p>
                                </div>
                            </div>

                            <a href="{{ route('campaign.detail', $campaign->id) }}" class="mt-auto w-full py-2.5 bg-red-600 border border-red-600 text-white font-bold rounded-lg text-sm hover:bg-red-700 transition text-center shadow-lg shadow-red-200">
                                Donasi Sekarang
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center">
                        <div class="bg-white rounded-xl border border-dashed border-gray-300 p-8 max-w-lg mx-auto">
                            <svg class="w-12 h-12 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <h3 class="text-gray-900 font-medium mb-1">Tidak ada campaign mendesak</h3>
                            <p class="text-gray-500 text-sm">Semua campaign masih memiliki waktu yang cukup panjang.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    {{-- TESTIMONI SECTION --}}
    <section class="py-20 bg-white" x-data="{ 
        activeSlide: 0,
        testimonials: [
            {
                name: 'Shin Soo Hyun',
                role: 'Mahasiswa UNPAS',
                image: 'https://asianwiki.com/images/0/03/Shin_Soo-Hyun-1996-pr1.jpg',
                quote: 'Aplikasi KasiDuit cepat dan stabil. Para donatur dapat dengan mudah berdonasi melalui smartphone.'
            },
            {
                name: 'Jeong Lee-an',
                role: 'Relawan Kemanusiaan',
                image: 'https://i.pinimg.com/736x/db/88/72/db8872df86277470cdc11ad7903640f2.jpg',
                quote: 'Aplikasi KasiDuit sangat membantu saya dalam mengelola donasi.'
            },
            {
                name: 'Kim Min-jeong',
                role: 'Ibu Rumah Tangga',
                image: 'https://i.pinimg.com/736x/c6/bb/6e/c6bb6e01b7ec231436161b4860a7d006.jpg',
                quote: 'Dengan KasiDuit saya lebih mudah mengumpulkan dana untuk campaign saya. Jadi saya dapat lebih cepat menyalurkan bantuan.'
            },
            {
                name: 'Go Yoon Jung',
                role: 'Guru Sekolah Dasar',
                image: 'https://i.pinimg.com/736x/8c/63/47/8c6347b85301fa856f5c21f654e85c0c.jpg',
                quote: 'Platform yang sangat transparan. Saya merasa aman menyalurkan donasi di sini.'
            }
        ],
        next() {
            let maxIndex = window.innerWidth >= 768 ? this.testimonials.length - 2 : this.testimonials.length - 1;
            if (this.activeSlide >= maxIndex) {
                this.activeSlide = 0;
            } else {
                this.activeSlide++;
            }
        },
        prev() {
            if (this.activeSlide <= 0) {
                let maxIndex = window.innerWidth >= 768 ? this.testimonials.length - 2 : this.testimonials.length - 1;
                this.activeSlide = maxIndex;
            } else {
                this.activeSlide--;
            }
        }
    }">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative">
            <div class="text-center mb-12">
                <span class="text-blue-600 font-bold tracking-wider text-sm uppercase mb-2 block">Testimoni</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Apa Kata Mereka?</h2>
                <p class="text-gray-600 mt-3 max-w-2xl mx-auto">
                    Mereka adalah #SobatKasiDuit yang telah menggunakan KasiDuit dan berbuat baik untuk sesama.
                </p>
            </div>

            <div class="relative overflow-hidden">
                <div class="flex transition-transform duration-500 ease-out"
                     :style="'transform: translateX(-' + (activeSlide * (window.innerWidth >= 768 ? 50 : 100)) + '%)'">
                    <template x-for="(item, index) in testimonials" :key="index">
                        <div class="w-full md:w-1/2 flex-shrink-0 px-4">
                            <div class="flex flex-col items-start h-full">
                                <div class="mb-6">
                                    <img :src="item.image" class="w-20 h-20 rounded-full object-cover border-4 border-gray-100 shadow-sm" :alt="item.name">
                                </div>
                                <div class="relative mb-6">
                                    <span class="absolute -top-6 -left-4 text-7xl text-red-200 font-serif leading-none opacity-50">“</span>
                                    <p class="text-gray-600 text-lg leading-relaxed relative z-10 pl-2" x-text="item.quote"></p>
                                </div>
                                <div class="mt-auto pl-2">
                                    <h4 class="font-bold text-gray-900 text-xl" x-text="item.name"></h4>
                                    <p class="text-gray-500 text-sm" x-text="item.role"></p>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>

            <div class="flex justify-center gap-4 mt-12">
                <button @click="prev()" class="w-12 h-12 bg-white border border-gray-200 hover:border-red-500 hover:text-red-600 text-gray-400 rounded-lg flex items-center justify-center transition shadow-sm hover:shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                </button>
                <button @click="next()" class="w-12 h-12 bg-white border border-gray-200 hover:border-red-500 hover:text-red-600 text-gray-400 rounded-lg flex items-center justify-center transition shadow-sm hover:shadow-md">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </button>
            </div>
        </div>
    </section>

    {{-- FEATURES SECTION --}}
    <section class="py-20 bg-red-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-2xl font-bold text-gray-900 mb-12">Transparansi & Keamanan Terjamin</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($features as $feature)
                <div class="flex flex-col items-center group cursor-default">
                    <div class="w-20 h-20 bg-white rounded-full flex items-center justify-center text-red-600 mb-6 shadow-md group-hover:scale-110 transition duration-300">
                        @if($feature['icon'] == 'shield-check')
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        @elseif($feature['icon'] == 'badge-check')
                             <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        @else
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 12l3-3 3 3 4-4M8 21l4-4 4 4M3 4h18M4 4h16v12a1 1 0 01-1 1H5a1 1 0 01-1-1V4z"></path></svg>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">{{ $feature['title'] }}</h3>
                    <p class="text-gray-600 max-w-xs mx-auto leading-relaxed">{{ $feature['desc'] }}</p>
                </div>
                @endforeach
            </div>
        </div>
    </section>
</div>