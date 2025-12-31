<div class="animate-fade-in-up">
    <h3 class="text-xl font-bold text-gray-900 mb-6">Informasi Pribadi</h3>
<<<<<<< HEAD
    
    <form wire:submit.prevent="updateProfile" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            
            {{-- Nama Lengkap --}}
=======
    <form wire:submit="updateProfile" class="space-y-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
>>>>>>> c8d26bcd46b982098099604f2029125cd2e0ff83
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                <input type="text" wire:model="name"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
<<<<<<< HEAD
                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Email (Disabled) --}}
=======
                @error('name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>

>>>>>>> c8d26bcd46b982098099604f2029125cd2e0ff83
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Email</label>
                <input type="email" wire:model="email"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed" disabled>
            </div>

<<<<<<< HEAD
            {{-- Nomor WhatsApp --}}
=======
>>>>>>> c8d26bcd46b982098099604f2029125cd2e0ff83
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor WhatsApp</label>
                <input type="text" wire:model="phone" placeholder="Contoh: 081234567890"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
<<<<<<< HEAD
                @error('phone') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>

            {{-- Domisili --}}
=======
            </div>

>>>>>>> c8d26bcd46b982098099604f2029125cd2e0ff83
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Domisili</label>
                <input type="text" wire:model="location" placeholder="Contoh: Bandung, Jawa Barat"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
<<<<<<< HEAD
                @error('location') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
        </div>

        {{-- Bio Singkat --}}
=======
            </div>
        </div>

>>>>>>> c8d26bcd46b982098099604f2029125cd2e0ff83
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Bio Singkat</label>
            <textarea wire:model="bio" rows="4" placeholder="Ceritakan sedikit tentang dirimu..."
                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition"></textarea>
<<<<<<< HEAD
            @error('bio') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- Tombol Simpan --}}
        <div class="flex justify-end pt-4">
            <button type="submit" 
                class="px-8 py-3 bg-red-600 text-white font-bold rounded-full hover:bg-red-700 transition shadow-lg shadow-red-200 transform hover:-translate-y-0.5 flex items-center gap-2">
                
                {{-- Loading Indicator --}}
                <span wire:loading wire:target="updateProfile">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </span>
                
=======
        </div>

        <div class="flex justify-end pt-4">
            <button type="submit" 
                class="px-8 py-3 bg-red-600 text-white font-bold rounded-full hover:bg-red-700 transition shadow-lg shadow-red-200 transform hover:-translate-y-0.5 flex items-center gap-2">
>>>>>>> c8d26bcd46b982098099604f2029125cd2e0ff83
                <span wire:loading.remove wire:target="updateProfile">Simpan Perubahan</span>
                <span wire:loading wire:target="updateProfile">Menyimpan...</span>
            </button>
        </div>
    </form>
</div>