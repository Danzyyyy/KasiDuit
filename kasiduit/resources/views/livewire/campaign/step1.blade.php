<div class="p-8 md:p-10 animate-fade-in-up">
    <div class="flex items-center gap-4 mb-6">
        <a href="{{ route('home') }}" class="group p-2 -ml-2 rounded-full hover:bg-red-50 transition duration-200">
            <svg class="w-6 h-6 text-gray-500 group-hover:text-red-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <h2 class="text-2xl font-bold text-gray-900">Informasi Campaign</h2>
    </div>
    
    <div class="space-y-6">
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori *</label>
            <select wire:model="category_id" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring-red-200">
                <option value="">Pilih Kategori</option>
                @foreach($categoriesList as $cat)
                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                @endforeach
            </select>
            @error('category_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Campaign *</label>
            <input type="text" wire:model="title" placeholder="Contoh: Bantu Pengobatan..." class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring-red-200">
            @error('title') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Target Dana (Rp) *</label>
                <input type="number" wire:model="target_amount" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring-red-200">
                @error('target_amount') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Batas Waktu *</label>
                <input type="date" wire:model="deadline" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring-red-200">
                @error('deadline') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
            </div>
        </div>
    </div>

    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
        <button wire:click="validateStep1" class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full shadow-lg transition">Lanjutkan</button>
    </div>
</div>