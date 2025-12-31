<div class="py-12 bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($campaigns as $campaign)
                @if($activeCategory == 'Semua' || $campaign['category'] == $activeCategory)
                    <x-campaign-card :campaign="$campaign" />
                @endif
            @endforeach
        </div>
    </div>

    @if($showModal && $selectedCampaign)
    <div class="fixed inset-0 z-[100] flex items-center justify-center p-4 bg-black/70 backdrop-blur-md">
        <div class="bg-white rounded-[40px] w-full max-w-xl overflow-hidden shadow-2xl relative animate-in fade-in zoom-in duration-300">
            
            <button wire:click="closeModal" class="absolute top-6 right-6 z-20 bg-black/20 text-white w-10 h-10 rounded-full flex items-center justify-center text-3xl hover:bg-black transition">&times;</button>

            @if($this->step == 1)
                <div class="h-48 overflow-hidden"><img src="{{ $selectedCampaign['image'] }}" class="w-full h-full object-cover"></div>
                <div class="p-8">
                    <h2 class="text-2xl font-black text-gray-900 mb-2">{{ $selectedCampaign['title'] }}</h2>
                    <p class="text-gray-500 mb-6 text-sm italic">"{{ $selectedCampaign['description'] }}"</p>
                    
                    <div class="grid grid-cols-2 gap-3 mb-8">
                        @foreach([50000, 100000, 250000, 500000] as $v)
                            <button wire:click="$set('amount', {{ $v }})" class="py-4 border-2 rounded-2xl font-black {{ $amount == $v ? 'border-brand-red bg-red-50 text-brand-red' : 'border-gray-100 text-gray-400' }}">Rp {{ number_format($v/1000) }}K</button>
                        @endforeach
                    </div>
                    <button wire:click="goToPayment" @disabled($amount < 10000) class="w-full bg-brand-red text-white py-5 rounded-3xl font-black shadow-xl shadow-red-100 disabled:bg-gray-200">Lanjut Pembayaran</button>
                </div>

            @elseif($this->step == 2)
                <div class="p-10">
                    <button wire:click="$set('step', 1)" class="text-brand-red font-bold text-xs mb-6 uppercase tracking-widest">← Kembali</button>
                    <h2 class="text-2xl font-black text-gray-900 mb-8">Pilih Pembayaran</h2>
                    <div class="space-y-3 mb-10">
                        @foreach(['Gopay', 'OVO', 'ShopeePay', 'Bank Transfer'] as $m)
                            <label class="flex items-center justify-between p-5 border-2 rounded-3xl cursor-pointer {{ $paymentMethod == $m ? 'border-brand-red bg-red-50' : 'border-gray-100' }}">
                                <span class="font-bold text-gray-700">{{ $m }}</span>
                                <input type="radio" wire:model.live="paymentMethod" value="{{ $m }}" class="accent-brand-red w-5 h-5">
                            </label>
                        @endforeach
                    </div>
                    <button wire:click="confirmPayment" @disabled(!$paymentMethod) class="w-full bg-brand-red text-white py-5 rounded-3xl font-black shadow-xl">Bayar Rp {{ number_format($amount) }}</button>
                </div>

            @elseif($this->step == 3)
                <div class="p-12 text-center">
                    <div class="w-20 h-20 bg-green-100 text-green-600 rounded-full flex items-center justify-center mx-auto mb-6 text-4xl">✓</div>
                    <h2 class="text-3xl font-black text-gray-900 mb-2">Donasi Berhasil!</h2>
                    <p class="text-gray-500 mb-8 italic">"Terima kasih atas kebaikan Anda."</p>
                    <div class="bg-gray-50 p-6 rounded-[32px] border border-dashed border-gray-300 text-left mb-8 shadow-inner">
                        <div class="flex justify-between text-xs font-bold mb-2 text-gray-400 uppercase"><span>Invoice ID</span><span>#DON-{{ rand(100,999) }}</span></div>
                        <div class="flex justify-between text-xl font-black text-brand-red mt-4 border-t pt-4 border-gray-200"><span>Total</span><span>Rp {{ number_format($amount) }}</span></div>
                    </div>
                    <button wire:click="closeModal" class="w-full bg-gray-900 text-white py-5 rounded-3xl font-black">Tutup</button>
                </div>
            @endif
        </div>
    </div>
    @endif
</div>