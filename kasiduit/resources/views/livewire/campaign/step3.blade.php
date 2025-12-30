<div class="p-8 md:p-10 animate-fade-in-up">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Data Penggalang Dana</h2>
    
    <div class="space-y-6">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap</label>
            <input type="text" wire:model="organizer_name" readonly class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
            <input type="email" wire:model="email" readonly class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed">
        </div>

        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon / WA</label>
            <input type="tel" wire:model="phone_number" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring-red-200">
            @error('phone_number') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-start bg-blue-50 p-4 rounded-xl border border-blue-100">
            <input id="agree" wire:model="agree" type="checkbox" class="w-4 h-4 mt-1 border-gray-300 rounded text-red-600 focus:ring-red-500">
            <label for="agree" class="ml-3 text-sm text-gray-600">
                Saya menyatakan bahwa data yang diisi adalah benar dan dapat dipertanggungjawabkan.
            </label>
        </div>
        @error('agree') <span class="text-red-500 text-sm block">{{ $message }}</span> @enderror
    </div>

    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between">
        <button wire:click="previousStep" class="px-6 py-3 border border-gray-300 text-gray-600 font-bold rounded-full hover:bg-gray-50 transition">Kembali</button>
        <button wire:click="submit" class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full shadow-lg flex items-center gap-2">
            <span wire:loading.remove wire:target="submit">Buat Campaign</span>
            <span wire:loading wire:target="submit">Memproses...</span>
        </button>
    </div>
</div>