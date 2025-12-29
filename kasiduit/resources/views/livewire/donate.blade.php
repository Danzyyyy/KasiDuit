<div class="min-h-screen bg-gray-50 font-sans text-gray-800">
    
    <div class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            @if($step < 5)
                <button wire:click="prevStep" class="flex items-center text-gray-500 hover:text-red-600 transition font-medium">
                    <svg class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </button>
            @else
                <div></div> @endif

            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-red-600" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                </svg>
                <span class="text-xl font-bold text-gray-800">KasiDuit</span>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        @if($step < 5)
        <div class="mb-12 max-w-3xl mx-auto">
            <div class="flex items-center justify-between relative">
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-0.5 bg-gray-200 -z-10"></div>
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 h-0.5 bg-red-600 -z-10 transition-all duration-500" 
                     style="width: {{ ($step - 1) * 33 }}%"></div>

                @foreach(['Nominal', 'Pembayaran', 'Identitas', 'Konfirmasi'] as $index => $label)
                    @php $stepNum = $index + 1; @endphp
                    <div class="flex flex-col items-center bg-gray-50 px-2">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold border-2 transition-colors duration-300
                            {{ $step >= $stepNum ? 'bg-red-600 border-red-600 text-white' : 'bg-white border-gray-300 text-gray-400' }}">
                            @if($step > $stepNum)
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            @else
                                {{ $stepNum }}
                            @endif
                        </div>
                        <span class="text-xs mt-2 font-medium {{ $step >= $stepNum ? 'text-red-600' : 'text-gray-400' }}">{{ $label }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            
            <div class="w-full {{ $step < 5 ? 'lg:w-2/3' : 'w-full max-w-2xl mx-auto' }}">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                    
                    {{-- STEP 1: PILIH NOMINAL --}}
                    @if($step == 1)
                        <h2 class="text-lg font-bold text-gray-900 mb-6">Pilih Nominal Donasi</h2>
                        
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            @foreach([50000, 100000, 250000, 500000] as $amount)
                                <button wire:click="setNominal({{ $amount }})" 
                                    class="py-4 px-4 rounded-xl border font-semibold text-gray-700 transition-all duration-200
                                    {{ $nominal == $amount && !$customNominal ? 'border-red-600 bg-red-50 text-red-700 ring-1 ring-red-600' : 'border-gray-200 hover:border-red-300' }}">
                                    Rp {{ number_format($amount, 0, ',', '.') }}
                                </button>
                            @endforeach
                            <button wire:click="setNominal(1000000)" 
                                class="col-span-2 py-4 px-4 rounded-xl border font-semibold text-gray-700 transition-all duration-200
                                {{ $nominal == 1000000 && !$customNominal ? 'border-red-600 bg-red-50 text-red-700 ring-1 ring-red-600' : 'border-gray-200 hover:border-red-300' }}">
                                Rp 1.000.000
                            </button>
                        </div>

                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Atau masukkan nominal lainnya</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 font-bold">Rp</span>
                                <input type="number" wire:model.live="customNominal" placeholder="0" min="10000"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition font-semibold text-gray-900">
                            </div>
                            <p class="text-xs text-gray-500 mt-2">Minimal donasi Rp 10.000</p>
                            
                            @if (session()->has('error'))
                                <div class="mt-2 text-sm text-red-600 bg-red-50 p-2 rounded-lg border border-red-100 flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    {{ session('error') }}
                                </div>
                            @endif
                        </div>

                        <button wire:click="validateStep1" class="w-full py-3.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition shadow-lg shadow-red-200">
                            Lanjutkan
                        </button>
                    @endif

                    {{-- STEP 2: METODE PEMBAYARAN --}}
                    @if($step == 2)
                        <h2 class="text-lg font-bold text-gray-900 mb-6">Pilih Metode Pembayaran</h2>
                        
                        <div class="space-y-3 mb-8">
                            @foreach([
                                ['id' => 'va', 'name' => 'Virtual Account', 'icon' => 'bank'],
                                ['id' => 'ewallet', 'name' => 'E-Wallet (GoPay, OVO, Dana)', 'icon' => 'device-mobile'],
                                ['id' => 'card', 'name' => 'Kartu Kredit/Debit', 'icon' => 'credit-card'],
                                ['id' => 'manual', 'name' => 'Transfer Bank Manual', 'icon' => 'cash']
                            ] as $method)
                                <div wire:click="selectPayment('{{ $method['id'] }}')" 
                                     class="flex items-center p-4 border rounded-xl cursor-pointer transition-all duration-200 group
                                     {{ $paymentMethod == $method['id'] ? 'border-red-600 bg-red-50 ring-1 ring-red-600' : 'border-gray-200 hover:border-red-200' }}">
                                    
                                    <div class="w-10 h-10 {{ $paymentMethod == $method['id'] ? 'bg-red-100 text-red-600' : 'bg-gray-100 text-gray-500' }} rounded-lg flex items-center justify-center mr-4 transition-colors">
                                        @if($method['icon'] == 'bank') <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 14v3m4-3v3m4-3v3M3 21h18M3 10h18M3 7l9-4 9 4M4 10h16v11H4V10z" /></svg>
                                        @elseif($method['icon'] == 'device-mobile') <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                        @elseif($method['icon'] == 'credit-card') <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                                        @else <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                                        @endif
                                    </div>
                                    
                                    <span class="font-medium text-gray-800 flex-1">{{ $method['name'] }}</span>
                                    
                                    <div class="w-5 h-5 rounded-full border-2 flex items-center justify-center
                                        {{ $paymentMethod == $method['id'] ? 'border-red-600' : 'border-gray-300' }}">
                                        @if($paymentMethod == $method['id'])
                                            <div class="w-2.5 h-2.5 rounded-full bg-red-600"></div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        @if (session()->has('error'))
                            <p class="text-sm text-red-600 mb-4 font-bold bg-red-50 p-2 rounded">{{ session('error') }}</p>
                        @endif

                        <button wire:click="validateStep2" class="w-full py-3.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition shadow-lg shadow-red-200">
                            Lanjutkan
                        </button>
                    @endif

                    {{-- STEP 3: IDENTITAS --}}
                    @if($step == 3)
                        <h2 class="text-lg font-bold text-gray-900 mb-6">Identitas Donatur</h2>
                        
                        <div class="mb-6 p-4 rounded-xl border border-gray-200 hover:border-gray-300 transition cursor-pointer flex items-center gap-3"
                             wire:click="$toggle('isAnonymous')">
                            <div class="w-5 h-5 rounded border flex items-center justify-center {{ $isAnonymous ? 'bg-gray-800 border-gray-800' : 'border-gray-300' }}">
                                @if($isAnonymous) <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" /></svg> @endif
                            </div>
                            <span class="text-gray-700 font-medium">Sembunyikan nama saya (donasi sebagai Hamba Allah)</span>
                        </div>

                        <div class="mb-8">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tulis doa atau dukungan (opsional)</label>
                            <textarea wire:model="prayer" rows="4" 
                                class="w-full p-4 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition placeholder-gray-400"
                                placeholder="Semoga lekas sembuh, semoga berkah..."></textarea>
                        </div>

                        <button wire:click="validateStep3" class="w-full py-3.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition shadow-lg shadow-red-200">
                            Lanjutkan
                        </button>
                    @endif

                    {{-- STEP 4: KONFIRMASI --}}
                    @if($step == 4)
                        <h2 class="text-lg font-bold text-gray-900 mb-6">Konfirmasi Donasi</h2>
                        
                        <div class="space-y-4 mb-8">
                            <div class="flex justify-between items-start pb-4 border-b border-gray-100">
                                <span class="text-gray-500">Campaign</span>
                                <span class="text-gray-900 font-medium text-right w-1/2">{{ $campaign['title'] }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                                <span class="text-gray-500">Nominal Donasi</span>
                                <span class="text-gray-900 font-medium">Rp {{ number_format($nominal, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-4 border-b border-gray-100">
                                <span class="text-gray-500">Biaya Admin</span>
                                <span class="text-gray-900 font-medium">Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center pt-2">
                                <span class="text-gray-800 font-bold">Total Pembayaran</span>
                                <span class="text-red-600 font-bold text-xl">Rp {{ number_format($nominal + $adminFee, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <div class="bg-gray-50 p-4 rounded-xl mb-8 space-y-3">
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Metode Pembayaran</span>
                                <span class="font-bold text-gray-900 text-sm uppercase">{{ $paymentMethod == 'ewallet' ? 'E-Wallet' : $paymentMethod }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-600 text-sm">Tampilkan Nama</span>
                                <span class="font-medium text-gray-900 text-sm">{{ $isAnonymous ? 'Hamba Allah' : Auth::user()->name }}</span>
                            </div>
                        </div>

                        <button wire:click="processDonation" class="w-full py-3.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition shadow-lg shadow-red-200">
                            Bayar Sekarang
                        </button>
                    @endif

                    {{-- STEP 5: SUKSES --}}
                    @if($step == 5)
                        <div class="text-center pt-4 pb-8">
                            <div class="w-24 h-24 bg-green-100 text-green-500 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-short">
                                <svg class="w-12 h-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <h2 class="text-xl font-bold text-gray-900 mb-2">Terima Kasih atas Kebaikan Anda! 💖</h2>
                            <p class="text-gray-500 text-sm mb-8 max-w-md mx-auto">Donasi Anda telah berhasil diproses dan akan sangat membantu mereka yang membutuhkan.</p>

                            <div class="bg-gray-50 rounded-xl p-6 mb-8 text-left max-w-md mx-auto border border-gray-100">
                                <h3 class="text-sm font-bold text-gray-900 text-center mb-6">Detail Donasi</h3>
                                
                                <div class="space-y-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Campaign</span>
                                        <span class="font-medium text-gray-900 text-right w-1/2 truncate">{{ $campaign['title'] }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Nominal</span>
                                        <span class="font-bold text-red-600">Rp {{ number_format($nominal + $adminFee, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Metode</span>
                                        <span class="font-medium text-gray-900 uppercase">{{ $paymentMethod == 'ewallet' ? 'E-Wallet' : $paymentMethod }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Tanggal</span>
                                        <span class="font-medium text-gray-900">{{ now()->format('d F Y') }}</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-gray-500">Status</span>
                                        <span class="font-bold text-green-600">Berhasil</span>
                                    </div>
                                </div>
                            </div>

                            <div class="flex flex-col sm:flex-row gap-3 justify-center mb-8">
                                <button class="px-5 py-2.5 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 flex items-center justify-center gap-2 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"></path></svg>
                                    Bagikan Campaign
                                </button>
                                <button class="px-5 py-2.5 border border-gray-300 rounded-lg font-medium text-gray-700 hover:bg-gray-50 flex items-center justify-center gap-2 text-sm">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                                    Unduh Bukti
                                </button>
                            </div>
                            
                            <div class="flex flex-col gap-3 max-w-sm mx-auto">
                                <a href="{{ route('campaign.donate', $campaignId) }}" class="block w-full py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition shadow-lg shadow-red-200">
                                    Donasi Lagi
                                </a>
                                <a href="{{ route('home') }}" class="block w-full py-3 text-gray-500 font-medium hover:text-gray-900 flex items-center justify-center gap-2">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" /></svg>
                                    Kembali ke Beranda
                                </a>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            @if($step < 5)
            <div class="w-full lg:w-1/3">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 sticky top-24">
                    <img src="{{ Str::startsWith($campaign->image_path, 'http') ? $campaign->image_path : asset('storage/'.$campaign->image_path) }}" 
                        alt="Campaign" class="w-full h-40 object-cover rounded-xl mb-4">

                    <h3 class="text-gray-900 font-bold leading-snug mb-1">{{ $campaign->title }}</h3>
                    <p class="text-xs text-gray-500 mb-4">Oleh {{ $campaign->user->name ?? 'Admin' }}</p>

                    @if($step == 1)
                        <div class="border-t border-gray-100 pt-4">
                            <p class="text-xs text-gray-500 mb-1">Target Donasi</p>
                            <p class="text-gray-900 font-bold">Rp {{ number_format($campaign->target_amount, 0, ',', '.') }}</p>
                        </div>
                    @else
                        <div class="border-t border-gray-100 pt-4 mt-2">
                            <div class="bg-gray-50 p-4 rounded-xl">
                                <p class="text-xs text-gray-500 mb-1">Total Donasi Anda</p>
                                <p class="text-xl font-bold text-red-600">
                                    Rp {{ number_format($nominal + ($step == 4 ? $adminFee : 0), 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            @endif

        </div>
    </div>
</div>