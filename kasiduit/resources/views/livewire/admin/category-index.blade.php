<div class="space-y-6">

    {{-- Header --}}
    <div class="flex justify-between items-center">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Kategori</h1>
            <p class="text-sm text-gray-500 mt-1">Buat, edit, dan hapus kategori donasi.</p>
        </div>

        {{-- Alert Sukses (Hijau) --}}
        @if (session()->has('message'))
            <div
                class="px-4 py-2 bg-green-100 text-green-700 rounded-lg text-sm font-medium animate-fade-in-up border border-green-200 mb-4">
                {{ session('message') }}
            </div>
        @endif

        {{-- Alert Error (Merah) - TAMBAHKAN INI --}}
        @if (session()->has('error'))
            <div
                class="px-4 py-2 bg-red-100 text-red-700 rounded-lg text-sm font-medium animate-fade-in-up border border-red-200 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- KOLOM KIRI: TABEL DATA --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 border-b border-gray-50 flex justify-between items-center bg-gray-50/30">
                    <h3 class="font-bold text-gray-900">Daftar Kategori</h3>
                    <span
                        class="bg-white border border-gray-200 text-gray-600 text-xs font-bold px-2.5 py-1 rounded-md shadow-sm">
                        {{ count($categories) }} Kategori
                    </span>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr
                                class="bg-gray-50 text-gray-500 text-xs uppercase tracking-wider border-b border-gray-100">
                                <th class="p-4 font-semibold">Nama Kategori</th>
                                <th class="p-4 font-semibold">Campaign</th>
                                <th class="p-4 font-semibold text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($categories as $cat)
                                <tr class="hover:bg-gray-50 transition duration-150 group">
                                    <td class="p-4">
                                        <span class="font-bold text-gray-900 block">{{ $cat->name }}</span>
                                        <span class="text-xs text-gray-400 font-mono">{{ $cat->slug }}</span>
                                    </td>
                                    <td class="p-4">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-50 text-blue-700">
                                            {{ $cat->campaigns_count }} Aktif
                                        </span>
                                    </td>
                                    <td class="p-4 text-right space-x-2">
                                        <button wire:click="edit({{ $cat->id }})"
                                            class="p-2 rounded-lg text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button wire:click="delete({{ $cat->id }})"
                                            wire:confirm="Apakah Anda yakin ingin menghapus kategori '{{ $cat->name }}'?"
                                            class="p-2 rounded-lg text-gray-400 hover:text-red-600 hover:bg-red-50 transition">
                                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-8 text-center text-gray-400 text-sm">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-10 h-10 text-gray-300 mb-2" fill="none" viewBox="0 0 24 24"
                                                stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            Belum ada kategori.
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- KOLOM KANAN: FORM INPUT --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 sticky top-8 overflow-hidden">
                <div class="p-6 border-b border-gray-50 bg-gray-50/50">
                    <h3 class="font-bold text-gray-900">
                        {{ $editMode ? 'Edit Kategori' : 'Tambah Baru' }}
                    </h3>
                </div>

                <div class="p-6 space-y-5">

                    {{-- Input Nama --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Kategori</label>
                        <input type="text" wire:model.live="name" placeholder="Contoh: Kesehatan"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-500 focus:ring focus:ring-red-200 transition text-sm">
                        @error('name') <span class="text-red-500 text-xs mt-1 block font-medium">{{ $message }}</span>
                        @enderror
                    </div>

                    {{-- Input Slug --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Slug (URL)</label>
                        <div class="relative">
                            <span
                                class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400 text-xs pointer-events-none">/</span>
                            <input type="text" wire:model="slug" readonly
                                class="w-full pl-6 pr-4 py-3 rounded-xl border border-gray-300 bg-gray-50 text-gray-500 text-sm cursor-not-allowed">
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="pt-4 flex gap-3">
                        @if($editMode)
                            <button wire:click="resetForm" type="button"
                                class="flex-1 py-3 border border-gray-300 text-gray-600 font-bold rounded-xl hover:bg-gray-50 transition text-sm">
                                Batal
                            </button>
                        @endif

                        <button wire:click="{{ $editMode ? 'update' : 'store' }}" type="button"
                            class="flex-1 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg shadow-red-200 transition transform hover:-translate-y-0.5 text-sm flex justify-center items-center gap-2">
                            @if($editMode)
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Simpan
                            @else
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                                </svg>
                                Tambah
                            @endif
                        </button>
                    </div>

                </div>
            </div>
        </div>

    </div>
</div>