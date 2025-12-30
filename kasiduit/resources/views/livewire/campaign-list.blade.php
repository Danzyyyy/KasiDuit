<div class="min-h-screen bg-gray-50 py-8 font-sans">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <p class="text-gray-500 text-sm">Menampilkan {{ $campaigns->total() }} campaign peduli</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- SIDEBAR FILTER --}}
            <div class="w-full lg:w-1/4">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 sticky top-24">
                    <div class="flex items-center gap-2 mb-6 pb-4 border-b border-gray-100">
                        <span class="font-bold text-gray-900">Filter Kategori</span>
                    </div>

                    <div class="space-y-1 mb-8">
                        @foreach($categoriesList as $cat)
                            <button wire:click="setCategory('{{ $cat }}')"
                                class="w-full text-left px-4 py-2.5 rounded-lg text-sm font-medium transition-colors flex items-center gap-3
                                {{ $category === $cat ? 'bg-red-50 text-red-600' : 'text-gray-600 hover:bg-gray-50 hover:text-gray-900' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $category === $cat ? 'bg-red-600' : 'bg-gray-300' }}"></span>
                                {{ $cat }}
                            </button>
                        @endforeach
                    </div>

                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Urutkan</p>
                        <select wire:model.live="sort" class="w-full pl-4 pr-10 py-2.5 bg-gray-50 border border-gray-200 rounded-lg text-sm text-gray-700 focus:ring-red-500 focus:border-red-500">
                            <option>Paling Relevan</option>
                            <option>Terbaru</option>
                            <option>Dana Terkumpul Terbesar</option>
                            <option>Mendesak (Sisa Waktu Sedikit)</option>
                        </select>
                    </div>
                </div>
            </div>

            {{-- LIST CAMPAIGN --}}
            <div class="w-full lg:w-3/4">
                
                @if($campaigns->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach($campaigns as $campaign)
                           {{-- CODE CARD LANGSUNG DISINI (Agar tidak perlu file terpisah dulu) --}}
                           <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition group flex flex-col h-full">
                                <div class="relative h-48 overflow-hidden">
                                    {{-- Cek apakah gambar URL (dummy) atau File Storage (real) --}}
                                    <img src="{{ Str::startsWith($campaign->image_path, 'http') ? $campaign->image_path : asset('storage/'.$campaign->image_path) }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-500">
                                    
                                    <span class="absolute top-3 left-3 bg-white/90 backdrop-blur text-xs font-bold px-2.5 py-1 rounded-md text-gray-700">
                                        {{ $campaign->category->name ?? 'Umum' }}
                                    </span>
                                </div>
                                
                                <div class="p-5 flex flex-col flex-grow">
                                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 leading-tight">
                                        <a href="{{ route('campaign.detail', $campaign->id) }}" class="hover:text-red-600 transition">
                                            {{ $campaign->title }}
                                        </a>
                                    </h3>
                                    
                                    <div class="flex items-center gap-2 mb-4 text-xs text-gray-500">
                                        <span class="font-medium text-gray-700">{{ $campaign->user->name ?? 'Anonim' }}</span>
                                        @if($campaign->status === 'active')
                                            <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                                        @endif
                                    </div>

                                    {{-- Progress Bar --}}
                                    @php
                                        $percent = $campaign->target_amount > 0 ? ($campaign->collected_amount / $campaign->target_amount) * 100 : 0;
                                    @endphp
                                    <div class="w-full bg-gray-100 rounded-full h-2 mb-2">
                                        <div class="bg-red-600 h-2 rounded-full" style="width: {{ min($percent, 100) }}%"></div>
                                    </div>
                                    
                                    <div class="flex justify-between text-xs mb-4">
                                        <div>
                                            <p class="text-gray-500">Terkumpul</p>
                                            <p class="font-bold text-gray-900">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</p>
                                        </div>
                                        <div class="text-right">
                                            <p class="text-gray-500">Sisa Waktu</p>
                                            <p class="font-bold text-gray-900">
                                                @php
                                                    // 1. Ambil deadline dan set ke AKHIR HARI (23:59:59)
                                                    // Ini penting agar jika deadline adalah hari ini, tetap dihitung sisa 1 hari, bukan 0.
                                                    $deadline = \Carbon\Carbon::parse($campaign->deadline)->endOfDay();
                                                    
                                                    // 2. Logika Penentuan Hari
                                                    if ($deadline->isPast()) {
                                                        // Jika waktu sudah lewat, paksa jadi 0
                                                        $sisaHari = 0;
                                                    } else {
                                                        // Jika belum lewat:
                                                        // a. Hitung selisih desimal (misal 2.6 hari)
                                                        // b. Ceil: Bulatkan ke atas (2.6 jadi 3.0)
                                                        // c. (int): Ubah jadi integer murni (3)
                                                        $sisaHari = (int) ceil(now()->floatDiffInDays($deadline));
                                                    }
                                                @endphp

                                                {{ $sisaHari }} Hari
                                            </p>
                                        </div>
                                    </div>

                                    <a href="{{ route('campaign.detail', $campaign->id) }}" class="mt-auto w-full py-2.5 bg-white border border-red-600 text-red-600 font-semibold rounded-lg text-sm hover:bg-red-50 transition text-center">
                                        Donasi Sekarang
                                    </a>
                                </div>
                           </div>
                        @endforeach
                    </div>

                    {{-- Pagination Link --}}
                    <div class="mt-10">
                        {{ $campaigns->links() }}
                    </div>

                @else
                    <div class="flex flex-col items-center justify-center py-20 bg-white rounded-xl border border-gray-100 border-dashed">
                        <h3 class="text-gray-900 font-medium mb-1">Belum ada campaign</h3>
                        <p class="text-gray-500 text-sm">Jadilah yang pertama membuat perubahan!</p>
                        <a href="{{ route('campaigns.create') }}" class="mt-4 px-6 py-2 bg-red-600 text-white rounded-full text-sm font-bold">
                            Buat Campaign
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>