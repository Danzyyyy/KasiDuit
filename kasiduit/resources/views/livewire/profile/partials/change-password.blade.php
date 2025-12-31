<div class="animate-fade-in-up">
    <h3 class="text-xl font-bold text-gray-900 mb-6">Ganti Password</h3>
    <form wire:submit="updatePassword" class="space-y-6 max-w-lg">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
            <input type="password" wire:model="current_password"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
            @error('current_password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
            <input type="password" wire:model="new_password"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
            @error('new_password') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
            <input type="password" wire:model="new_password_confirmation"
                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" 
                class="px-8 py-3 bg-red-600 text-white font-bold rounded-full hover:bg-red-700 transition shadow-lg shadow-red-200 transform hover:-translate-y-0.5 flex items-center gap-2">
                <span wire:loading.remove wire:target="updatePassword">Ubah Password</span>
                <span wire:loading wire:target="updatePassword">Memproses...</span>
            </button>
        </div>
    </form>
</div>