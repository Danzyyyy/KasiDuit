<div class="max-w-xl mx-auto bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden animate-fade-in-up">
    
    {{-- Header Sukses --}}
    <div class="bg-green-50 p-8 text-center border-b border-green-100">
        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 ring-4 ring-white shadow-sm">
            <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-900">Berhasil Terkirim!</h2>
        <p class="text-green-700 text-sm mt-1">Campaign Anda sedang dalam peninjauan.</p>
    </div>

    {{-- Detail Ringkasan --}}
    <div class="p-8 space-y-6">
        
        {{-- Preview Kartu Campaign --}}
        <div class="flex gap-4 items-start bg-gray-50 p-4 rounded-xl border border-gray-200">
            {{-- Gambar --}}
            <div class="w-20 h-20 flex-shrink-0">
                @if($image)
                    <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover rounded-lg shadow-sm">
                @else
                    <div class="w-full h-full bg-gray-200 rounded-lg"></div>
                @endif
            </div>
            
            {{-- Info Utama --}}
            <div class="flex-1 min-w-0">
                <h3 class="font-bold text-gray-900 text-sm leading-tight line-clamp-2 mb-1">{{ $title }}</h3>
                <p class="text-xs text-gray-500 mb-2">{{ $category_id ? \App\Models\Category::find($category_id)->name : 'Kategori' }}</p>
                <div class="flex items-center gap-1 text-red-600 font-bold text-sm">
                    <span>Rp {{ number_format($target_amount, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>

        {{-- Detail Tambahan --}}
        <div class="space-y-4 text-sm">
            <div class="flex justify-between border-b border-gray-100 pb-2">
                <span class="text-gray-500">Batas Waktu</span>
                <span class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($deadline)->format('d F Y') }}</span>
            </div>
            <div class="flex justify-between border-b border-gray-100 pb-2">
                <span class="text-gray-500">Penggalang Dana</span>
                <span class="font-medium text-gray-900">{{ $organizer_name }}</span>
            </div>
            
            {{-- Lokasi & Status Pending --}}
            <div class="flex justify-between items-start pt-1">
                <span class="text-gray-500 flex-shrink-0 mt-1">Lokasi</span>
                <div class="text-right pl-4">
                    <span class="font-medium text-gray-900 block">
                        {{ $selectedRegencyName ?? 'Kota' }}, {{ $selectedProvinceName ?? 'Provinsi' }}
                    </span>
                    {{-- Status Pending di Bawah Lokasi --}}
                    <span class="inline-flex items-center gap-1 mt-1.5 px-2 py-0.5 rounded text-[10px] font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">
                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Menunggu Verifikasi
                    </span>
                </div>
            </div>
        </div>

        {{-- Tombol Aksi --}}
        <div class="pt-4 space-y-3">
            {{-- 1. Tombol Lihat Campaign (Utama) --}}
            <a href="{{ route('campaign.detail', $createdCampaignId) }}" class="flex items-center justify-center gap-2 w-full py-3.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition shadow-lg shadow-red-200 transform hover:-translate-y-0.5">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                Lihat Campaign Saya
            </a>

            {{-- 2. Tombol Kelola (Opsional) --}}
            <a href="{{ route('profile', ['tab' => 'my_campaigns']) }}" class="block w-full py-3 bg-white border border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition text-center">
                Kelola Campaign
            </a>

            {{-- 3. Kembali ke Beranda --}}
            <a href="{{ route('home') }}" class="block w-full py-2 text-gray-400 hover:text-gray-600 font-medium text-sm text-center">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>