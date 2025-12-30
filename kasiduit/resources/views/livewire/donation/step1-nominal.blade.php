<h2 class="text-lg font-bold text-gray-900 mb-6">Pilih Nominal Donasi</h2>
<div class="grid grid-cols-2 gap-4 mb-6">
    @foreach([50000, 100000, 250000, 500000] as $amount)
        <button wire:click="setNominal({{ $amount }})" 
            class="py-4 px-4 rounded-xl border font-semibold text-gray-700 transition-all 
            {{ $nominal == $amount && !$customNominal ? 'border-red-600 bg-red-50 text-red-700 ring-1 ring-red-600' : 'border-gray-200 hover:border-red-300' }}">
            Rp {{ number_format($amount, 0, ',', '.') }}
        </button>
    @endforeach
</div>
<div class="mb-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">Atau masukkan nominal lainnya</label>
    <div class="relative">
        <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 font-bold">Rp</span>
        <input type="number" wire:model.live="customNominal" placeholder="0" min="10000"
            class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 transition font-semibold">
    </div>
    @if (session()->has('error'))
        <div class="mt-2 text-sm text-red-600">{{ session('error') }}</div>
    @endif
</div>
<button wire:click="validateStep1" class="w-full py-3.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg shadow-red-200">
    Lanjutkan
</button>