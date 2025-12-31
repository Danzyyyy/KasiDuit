<h2 class="text-lg font-bold text-gray-900 mb-6">Konfirmasi Donasi</h2>
<div class="space-y-4 mb-8">
    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
        <span class="text-gray-500">Nominal</span>
        <span class="text-gray-900 font-medium">Rp {{ number_format($nominal, 0, ',', '.') }}</span>
    </div>
    <div class="flex justify-between items-center pb-4 border-b border-gray-100">
        <span class="text-gray-500">Biaya Admin</span>
        <span class="text-gray-900 font-medium">Rp {{ number_format($adminFee, 0, ',', '.') }}</span>
    </div>
    <div class="flex justify-between items-center pt-2">
        <span class="text-gray-800 font-bold">Total</span>
        <span class="text-red-600 font-bold text-xl">Rp {{ number_format($nominal + $adminFee, 0, ',', '.') }}</span>
    </div>
</div>
<button wire:click="processDonation" class="w-full py-3.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition shadow-lg shadow-red-200">
    Bayar Sekarang
</button>