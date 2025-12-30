<div class="animate-fade-in-up">
    <h3 class="text-xl font-bold text-gray-900 mb-6">Informasi Pribadi</h3>
    <form wire:submit="updateProfile" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" wire:model="name"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
                @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                <input type="email" wire:model="email"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed" disabled>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp</label>
                <input type="text" wire:model="phone" placeholder="Contoh: 081234567890"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Domisili</label>
                <input type="text" wire:model="location" placeholder="Contoh: Bandung, Jawa Barat"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
            </div>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Bio Singkat</label>
            <textarea wire:model="bio" rows="4" placeholder="Ceritakan sedikit tentang dirimu..."
                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition"></textarea>
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" 
                class="px-8 py-3 bg-red-600 text-white font-bold rounded-full hover:bg-red-700 transition shadow-lg shadow-red-200 transform hover:-translate-y-0.5 flex items-center gap-2">
                <span wire:loading.remove wire:target="updateProfile">Simpan Perubahan</span>
                <span wire:loading wire:target="updateProfile">Menyimpan...</span>
            </button>
        </div>
    </form>
</div>