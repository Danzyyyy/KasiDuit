<div class="min-h-screen bg-gray-50 py-12 px-4 sm:px-6 lg:px-8 flex items-center justify-center">

    {{-- LOGIKA: Cek Status Realtime setiap 3 detik jika status masih pending --}}
    @if($donation->status == 'pending')
    
        <div wire:poll.3s class="w-full max-w-xl">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden animate-fade-in-up">
                
                {{-- Header Pending --}}
                <div class="bg-yellow-50 p-8 text-center border-b border-yellow-100">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4 animate-pulse">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Menunggu Pembayaran</h2>
                    <p class="text-yellow-800 text-sm mt-2 px-6">
                        Selesaikan pembayaran Anda sebelum waktu habis.
                    </p>
                </div>
                
                <div class="p-8 space-y-6">
                    <div class="text-center border-b border-gray-100 pb-6">
                        <p class="text-gray-500 text-sm">Nominal Donasi</p>
                        <h3 class="text-3xl font-bold text-gray-900 mt-2">
                            Rp {{ number_format($donation->amount, 0, ',', '.') }}
                        </h3>
                    </div>

                    {{-- TOMBOL AKSI PENDING --}}
                    <div class="space-y-3">
                        {{-- 1. Tombol Bayar --}}
                        <button id="pay-button" class="w-full py-4 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-center transition shadow-lg shadow-red-200 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            Bayar Sekarang
                        </button>
                        
                        {{-- 2. Tombol Kembali ke Campaign (Secondary) --}}
                        <a href="{{ route('campaign.detail', $donation->campaign_id) }}" class="block w-full py-3 bg-white border border-gray-300 hover:bg-gray-50 text-gray-700 font-bold rounded-xl text-center transition">
                            Kembali ke Campaign
                        </a>

                        {{-- 3. Link Text ke Beranda --}}
                        <a href="{{ route('home') }}" class="block text-center text-xs text-gray-400 hover:text-gray-600 transition pt-2">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>

    @elseif($donation->status == 'paid')

        {{-- TAMPILAN SUKSES (STRUK) --}}
        <div class="w-full max-w-xl">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden animate-fade-in-up">
                
                <div class="bg-green-50 p-8 text-center border-b border-green-100">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Pembayaran Berhasil!</h2>
                    <p class="text-green-800 text-sm mt-2">Terima kasih, donasi Anda telah diterima.</p>
                </div>

                <div class="p-8">
                    {{-- DETAIL STRUK --}}
                    <div class="bg-gray-50 rounded-xl p-5 border border-gray-100 mb-6 space-y-3">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-500">Nominal</span>
                            <span class="font-bold text-gray-900 text-lg">Rp {{ number_format($donation->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="border-t border-gray-200 border-dashed my-2"></div>
                        
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-500">Metode Bayar</span>
                            <span class="font-bold text-gray-800 uppercase bg-white border border-gray-200 px-2 py-0.5 rounded">
                                {{ $donation->payment_method ?? '-' }}
                            </span>
                        </div>

                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-500">ID Transaksi</span>
                            <span class="font-mono text-gray-700">{{ $donation->order_id }}</span>
                        </div>
                        <div class="flex justify-between items-center text-xs">
                            <span class="text-gray-500">Waktu</span>
                            <span class="text-gray-700">{{ $donation->updated_at->format('d M Y, H:i') }}</span>
                        </div>
                    </div>

                    {{-- TOMBOL AKSI SUKSES --}}
                    <div class="space-y-3">
                        {{-- 1. Download Invoice --}}
                        <a href="{{ route('invoice.download', $donation->id) }}" target="_blank" class="flex items-center justify-center gap-2 w-full py-3 bg-white border border-gray-300 text-gray-700 font-bold rounded-xl hover:bg-gray-50 transition">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download Invoice
                        </a>

                        {{-- 2. Kembali ke Campaign --}}
                        <a href="{{ route('campaign.detail', $donation->campaign_id) }}" class="block w-full py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-center transition">
                            Kembali ke Campaign
                        </a>

                        {{-- 3. Kembali ke Beranda --}}
                        <a href="{{ route('home') }}" class="block text-center text-xs text-gray-400 hover:text-gray-600 transition pt-2">
                            Kembali ke Beranda
                        </a>
                    </div>
                </div>
            </div>
        </div>

    @else
        {{-- TAMPILAN GAGAL/CANCELLED --}}
        <div class="w-full max-w-xl">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden animate-fade-in-up">
                <div class="bg-red-50 p-8 text-center border-b border-red-100">
                    <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold text-gray-900">Pembayaran Gagal</h2>
                    <p class="text-red-800 text-sm mt-2">Maaf, transaksi dibatalkan atau kadaluarsa.</p>
                </div>
                 
                {{-- TOMBOL AKSI GAGAL --}}
                <div class="p-8 space-y-3">
                    {{-- 1. Coba Lagi --}}
                    <a href="{{ route('campaign.donate', $donation->campaign_id) }}" class="block w-full py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl text-center transition">
                        Coba Donasi Lagi
                    </a>
                    
                    {{-- 2. Kembali ke Campaign --}}
                    <a href="{{ route('campaign.detail', $donation->campaign_id) }}" class="block w-full py-3 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-bold rounded-xl text-center transition">
                        Lihat Campaign
                    </a>

                    {{-- 3. Kembali ke Beranda --}}
                    <a href="{{ route('home') }}" class="block w-full py-3 text-gray-400 hover:text-gray-600 text-sm font-bold text-center transition">
                        Kembali ke Beranda
                    </a>
                </div>
            </div>
        </div>
    @endif

</div>

{{-- SCRIPT SNAP JS (Hanya dimuat jika status Pending) --}}
@if($donation->status == 'pending')
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
    <script>
        const payButton = document.getElementById('pay-button');
        if(payButton) {
            payButton.addEventListener('click', function () {
                window.snap.pay('{{ $donation->snap_token }}', {
                    onSuccess: function(result){ console.log('success'); },
                    onPending: function(result){ console.log('pending'); },
                    onError: function(result){ console.log('error'); },
                    onClose: function(){ console.log('closed'); }
                });
            });
        }
    </script>
@endif