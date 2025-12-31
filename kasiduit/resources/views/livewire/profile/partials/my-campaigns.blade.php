<div class="animate-fade-in-up">
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-xl font-bold text-gray-900">Campaign Saya</h2>
            <p class="text-sm text-gray-500">Kelola campaign yang telah Anda buat.</p>
        </div>
        <a href="{{ route('campaigns.create') }}" class="px-4 py-2 bg-red-600 text-white text-sm font-bold rounded-lg hover:bg-red-700 transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
            Buat Baru
        </a>
    </div>

    <div class="space-y-4">
        @forelse($myCampaigns as $campaign)
            <div class="bg-white border border-gray-100 rounded-xl p-4 hover:shadow-md transition flex flex-col sm:flex-row gap-4">
                
                {{-- Gambar --}}
                <div class="w-full sm:w-32 h-24 flex-shrink-0 bg-gray-200 rounded-lg overflow-hidden">
                    <img src="{{ Str::startsWith($campaign->image_path, 'http') ? $campaign->image_path : asset('storage/'.$campaign->image_path) }}" 
                         class="w-full h-full object-cover">
                </div>

                {{-- Info Campaign --}}
                <div class="flex-1">
                    <div class="flex justify-between items-start">
                        <div>
                            {{-- Status Badge --}}
                            @if($campaign->status == 'active')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800 mb-1">
                                    Aktif
                                </span>
                            @elseif($campaign->status == 'pending')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800 mb-1">
                                    Menunggu Verifikasi
                                </span>
                            @elseif($campaign->status == 'rejected')
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800 mb-1">
                                    Ditolak
                                </span>
                            @else
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800 mb-1">
                                    Selesai
                                </span>
                            @endif

                            <h3 class="text-base font-bold text-gray-900 hover:text-red-600 transition">
                                <a href="{{ route('campaign.detail', $campaign->id) }}">{{ $campaign->title }}</a>
                            </h3>
                            <p class="text-xs text-gray-500 mt-0.5">Dibuat: {{ $campaign->created_at->format('d M Y') }}</p>
                        </div>
                    </div>
                    
                    {{-- Progress Bar Kecil --}}
                    <div class="mt-3">
                        <div class="flex justify-between text-xs mb-1">
                            <span class="text-gray-600">Terkumpul: <span class="font-bold text-gray-900">Rp {{ number_format($campaign->collected_amount, 0, ',', '.') }}</span></span>
                            <span class="text-gray-400">Target: Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="w-full bg-gray-100 rounded-full h-1.5">
                            <div class="bg-red-600 h-1.5 rounded-full" style="width: {{ min(($campaign->collected_amount / $campaign->target_amount) * 100, 100) }}%"></div>
                        </div>
                    </div>
                </div>

                {{-- Tombol Aksi (Opsional) --}}
                <div class="flex sm:flex-col justify-end gap-2 sm:border-l sm:border-gray-100 sm:pl-4">
                    <a href="{{ route('campaign.detail', $campaign->id) }}" class="text-xs font-bold text-gray-600 hover:text-red-600 border border-gray-200 hover:border-red-200 px-3 py-2 rounded-lg text-center transition">
                        Lihat
                    </a>
                </div>
            </div>
        @empty
            <div class="text-center py-10">
                <div class="bg-gray-50 rounded-full w-16 h-16 flex items-center justify-center mx-auto mb-3">
                    <svg class="w-8 h-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                </div>
                <h3 class="text-gray-900 font-medium">Belum ada campaign</h3>
                <p class="text-gray-500 text-sm mt-1 mb-4">Mulai galang dana untuk membantu sesama.</p>
                <a href="{{ route('campaigns.create') }}" class="text-red-600 font-bold text-sm hover:underline">Buat Campaign Sekarang</a>
            </div>
        @endforelse
    </div>
</div>