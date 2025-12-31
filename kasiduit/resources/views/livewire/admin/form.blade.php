<div
    class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden max-w-5xl mx-auto">
    <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <div>
            <h2 class="text-xl font-bold text-gray-900 tracking-tight">
                {{ $isEditMode ? 'Edit Campaign' : 'Buat Campaign Baru' }}</h2>
            <p class="text-sm text-gray-500 mt-1">Lengkapi detail penggalangan dana di bawah ini.</p>
        </div>
        <button wire:click="cancel"
            class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition">
            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-8">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            {{-- Judul --}}
            <div class="md:col-span-2">
                <label class="block mb-2 text-sm font-semibold text-gray-700">Judul Campaign</label>
                <input type="text" wire:model="title" placeholder="Contoh: Bantu Pembangunan Masjid..."
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 transition text-sm">
                @error('title') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Kategori --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Kategori</label>
                <select wire:model="category_id"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 transition text-sm bg-white">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                @error('category_id') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Status (Admin Only) --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Status Campaign</label>
                <select wire:model="status"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 transition text-sm bg-white">
                    <option value="pending">Pending (Menunggu)</option>
                    <option value="active">Active (Tayang)</option>
                    <option value="rejected">Rejected (Ditolak)</option>
                    <option value="finished">Finished (Selesai)</option>
                </select>
                @error('status') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Target --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Target Dana (Rp)</label>
                <div class="relative">
                    <span
                        class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 text-sm font-bold">Rp</span>
                    <input type="number" wire:model="target_amount"
                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 transition text-sm">
                </div>
                @error('target_amount') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span>
                @enderror
            </div>

            {{-- Deadline --}}
            <div>
                <label class="block mb-2 text-sm font-semibold text-gray-700">Batas Waktu</label>
                <input type="date" wire:model="deadline"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 transition text-sm">
                @error('deadline') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span>
                @enderror
            </div>
        </div>

        {{-- Deskripsi (Full) --}}
        <div class="mb-8">
            <label class="block mb-2 text-sm font-semibold text-gray-700">Cerita Lengkap</label>
            <textarea wire:model="full_description" rows="6"
                placeholder="Tuliskan cerita lengkap mengenai penggalangan dana ini..."
                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 transition text-sm"></textarea>
            @error('full_description') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span>
            @enderror
        </div>

        {{-- Upload Gambar --}}
        <div class="mb-8">
            <label class="block mb-2 text-sm font-semibold text-gray-700">Gambar Utama</label>
            <div class="flex items-center gap-6 p-4 border border-dashed border-gray-300 rounded-xl bg-gray-50">
                <div class="shrink-0">
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}"
                            class="h-24 w-24 object-cover rounded-lg shadow-sm border border-gray-200">
                    @elseif ($old_image)
                        <img src="{{ Str::startsWith($old_image, 'http') ? $old_image : asset('storage/' . $old_image) }}"
                            class="h-24 w-24 object-cover rounded-lg shadow-sm border border-gray-200">
                    @else
                        <div class="h-24 w-24 rounded-lg bg-gray-200 flex items-center justify-center text-gray-400">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                </path>
                            </svg>
                        </div>
                    @endif
                </div>
                <div class="flex-1">
                    <input type="file" wire:model="image"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition cursor-pointer">
                    <p class="text-xs text-gray-400 mt-2">Format: JPG, PNG. Maksimal ukuran: 2MB.</p>
                    @error('image') <span class="text-red-500 text-xs mt-1 font-medium block">{{ $message }}</span>
                    @enderror
                    <div wire:loading wire:target="image" class="text-xs text-red-500 mt-1 font-medium animate-pulse">
                        Sedang mengupload...</div>
                </div>
            </div>
        </div>

        {{-- Footer Form --}}
        <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
            <button type="button" wire:click="cancel"
                class="px-6 py-3 text-sm font-bold text-gray-600 bg-white border border-gray-300 rounded-xl hover:bg-gray-50 transition">
                Batal
            </button>
            <button type="submit"
                class="px-6 py-3 text-sm font-bold text-white bg-red-600 rounded-xl hover:bg-red-700 shadow-lg shadow-red-200 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                <span wire:loading.remove wire:target="image">
                    {{ $isEditMode ? 'Simpan Perubahan' : 'Buat Campaign' }}
                </span>
                <span wire:loading wire:target="image">Memproses...</span>
            </button>
        </div>
    </form>
</div>