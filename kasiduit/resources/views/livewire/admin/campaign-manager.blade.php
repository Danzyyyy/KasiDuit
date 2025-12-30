<div class="min-h-screen bg-gray-50 flex">
    
    {{-- 1. SIDEBAR ADMIN (Konsisten dengan Dashboard) --}}
    <aside class="w-64 bg-white border-r border-gray-200 hidden md:block min-h-screen fixed left-0 top-0 bottom-0 overflow-y-auto z-10 pt-20">
        <nav class="p-4 space-y-1">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            <a href="{{ route('admin.categories') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Kelola Kategori
            </a>
            {{-- Menu Aktif --}}
            <a href="{{ route('admin.campaigns') }}" class="flex items-center gap-3 px-4 py-3 bg-red-50 text-red-700 font-medium rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Kelola Campaign
            </a>
        </nav>
    </aside>

    {{-- 2. KONTEN UTAMA --}}
    <main class="flex-1 p-8 md:ml-64">
        
        {{-- Flash Message --}}
        @if (session()->has('message'))
            <div class="p-4 mb-6 text-green-700 bg-green-100 border border-green-200 rounded-lg flex items-center gap-2 animate-fade-in-up">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                {{ session('message') }}
            </div>
        @endif

        {{-- LOGIKA TOGGLE: FORM vs TABEL --}}
        @if($showForm)
            
            {{-- A. MODE FORM (CREATE / EDIT) --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden max-w-4xl mx-auto">
                <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center bg-gray-50">
                    <h2 class="text-lg font-bold text-gray-800">{{ $isEditMode ? 'Edit Campaign' : 'Buat Campaign Baru' }}</h2>
                    <button wire:click="cancel" class="text-gray-400 hover:text-gray-600">✕</button>
                </div>
                
                <form wire:submit.prevent="{{ $isEditMode ? 'update' : 'store' }}" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        {{-- Judul --}}
                        <div class="md:col-span-2">
                            <label class="block mb-2 text-sm font-semibold text-gray-700">Judul Campaign</label>
                            <input type="text" wire:model="title" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500">
                            @error('title') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- Kategori --}}
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700">Kategori</label>
                            <select wire:model="category_id" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- Status (Admin Only) --}}
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700">Status Campaign</label>
                            <select wire:model="status" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500">
                                <option value="pending">Pending (Menunggu)</option>
                                <option value="active">Active (Tayang)</option>
                                <option value="rejected">Rejected (Ditolak)</option>
                                <option value="finished">Finished (Selesai)</option>
                            </select>
                            <p class="text-xs text-gray-500 mt-1">Admin dapat mengubah status secara manual.</p>
                            @error('status') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        {{-- Target --}}
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700">Target Dana (Rp)</label>
                            <input type="number" wire:model="target_amount" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500">
                            @error('target_amount') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>

                        {{-- Deadline --}}
                        <div>
                            <label class="block mb-2 text-sm font-semibold text-gray-700">Batas Waktu</label>
                            <input type="date" wire:model="deadline" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500">
                            @error('deadline') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    {{-- Deskripsi (Full) --}}
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Cerita Lengkap</label>
                        <textarea wire:model="full_description" rows="6" class="w-full border-gray-300 rounded-lg shadow-sm focus:border-red-500 focus:ring-red-500"></textarea>
                        @error('full_description') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                    </div>

                    {{-- Upload Gambar --}}
                    <div class="mb-6">
                        <label class="block mb-2 text-sm font-semibold text-gray-700">Gambar Utama</label>
                        <div class="flex items-start gap-4">
                            <div class="w-full">
                                <input type="file" wire:model="image" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100 transition">
                                <p class="text-xs text-gray-500 mt-1">Format: JPG, PNG. Maks: 2MB.</p>
                            </div>
                            
                            {{-- Preview --}}
                            <div class="shrink-0">
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" class="h-24 w-24 object-cover rounded-lg border border-gray-200">
                                @elseif ($old_image)
                                    <img src="{{ Str::startsWith($old_image, 'http') ? $old_image : asset('storage/'.$old_image) }}" class="h-24 w-24 object-cover rounded-lg border border-gray-200">
                                @endif
                            </div>
                        </div>
                        @error('image') <span class="text-red-500 text-xs mt-1">{{ $message }}</span> @enderror
                        <div wire:loading wire:target="image" class="text-xs text-red-500 mt-1">Mengupload...</div>
                    </div>

                    {{-- Footer Form --}}
                    <div class="flex justify-end gap-3 pt-6 border-t border-gray-100">
                        <button type="button" wire:click="cancel" class="px-5 py-2.5 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-50">
                            Batal
                        </button>
                        <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-red-600 rounded-lg hover:bg-red-700 shadow-sm flex items-center gap-2">
                            <span wire:loading.remove wire:target="image">
                                {{ $isEditMode ? 'Simpan Perubahan' : 'Buat Campaign' }}
                            </span>
                            <span wire:loading wire:target="image">Mengupload...</span>
                        </button>
                    </div>
                </form>
            </div>

        @else
            
            {{-- B. MODE TABEL (LIST DATA) --}}
            <div class="flex flex-col md:flex-row justify-between items-center mb-6 gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-800">Manajemen Campaign</h2>
                    <p class="text-sm text-gray-500">Verifikasi, pantau, dan kelola penggalangan dana.</p>
                </div>

                <div class="flex gap-3 w-full md:w-auto">
                    {{-- Search Bar --}}
                    <div class="relative w-full md:w-64">
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari judul campaign..." 
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-red-500 focus:border-red-500 text-sm">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </div>
                    </div>

                    {{-- Tombol Buat Baru --}}
                    <button wire:click="create" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 text-sm font-bold whitespace-nowrap shadow-sm flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        Buat Baru
                    </button>
                </div>
            </div>

            {{-- Tabel Data --}}
            <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                            <tr>
                                <th class="p-4 border-b">Info Campaign</th>
                                <th class="p-4 border-b">Pembuat</th>
                                <th class="p-4 border-b">Target & Deadline</th>
                                <th class="p-4 border-b text-center">Status</th>
                                <th class="p-4 border-b text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 text-sm">
                            @forelse($campaigns as $camp)
                                <tr class="hover:bg-gray-50 transition">
                                    {{-- Kolom Info --}}
                                    <td class="p-4 align-top max-w-xs">
                                        <div class="flex gap-3">
                                            <img src="{{ Str::startsWith($camp->image_path, 'http') ? $camp->image_path : asset('storage/'.$camp->image_path) }}" class="w-16 h-16 object-cover rounded-md bg-gray-100 shrink-0">
                                            <div>
                                                <div class="font-bold text-gray-900 line-clamp-2" title="{{ $camp->title }}">{{ $camp->title }}</div>
                                                <span class="text-xs text-gray-500">{{ $camp->category->name ?? 'Tanpa Kategori' }}</span>
                                            </div>
                                        </div>
                                    </td>

                                    {{-- Kolom Pembuat --}}
                                    <td class="p-4 align-top">
                                        <div class="text-gray-900 font-medium">{{ $camp->user->name ?? 'Admin' }}</div>
                                        <div class="text-xs text-gray-500">{{ $camp->user->email ?? '-' }}</div>
                                    </td>

                                    {{-- Kolom Target --}}
                                    <td class="p-4 align-top whitespace-nowrap">
                                        <div class="font-semibold text-gray-900">Rp {{ number_format($camp->target_amount, 0, ',', '.') }}</div>
                                        <div class="text-xs text-red-500">Deadline: {{ \Carbon\Carbon::parse($camp->deadline)->format('d M Y') }}</div>
                                    </td>

                                    {{-- Kolom Status --}}
                                    <td class="p-4 align-top text-center">
                                        @if($camp->status == 'pending')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800 mb-2">
                                                Menunggu
                                            </span>
                                            <div class="flex flex-col gap-1">
                                                <button wire:click="verify({{ $camp->id }})" class="text-xs bg-green-50 text-green-700 border border-green-200 px-2 py-1 rounded hover:bg-green-100 transition">
                                                    ✓ Setujui
                                                </button>
                                                <button wire:click="reject({{ $camp->id }})" wire:confirm="Yakin tolak campaign ini?" class="text-xs bg-red-50 text-red-700 border border-red-200 px-2 py-1 rounded hover:bg-red-100 transition">
                                                    ✕ Tolak
                                                </button>
                                            </div>
                                        @elseif($camp->status == 'active')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Active (Tayang)
                                            </span>
                                        @elseif($camp->status == 'rejected')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                                Selesai
                                            </span>
                                        @endif
                                    </td>

                                    {{-- Kolom Aksi --}}
                                    <td class="p-4 align-middle text-center">
                                        <div class="flex items-center justify-center gap-2">
                                            {{-- Detail Link --}}
                                            <a href="{{ route('campaign.detail', $camp->id) }}" target="_blank" class="p-1.5 text-gray-500 hover:bg-gray-100 rounded border border-gray-200" title="Lihat Detail">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                            </a>

                                            {{-- Edit --}}
                                            <button wire:click="edit({{ $camp->id }})" class="p-1.5 text-blue-600 hover:bg-blue-50 rounded border border-blue-200" title="Edit">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </button>
                                            
                                            {{-- Delete --}}
                                            <button wire:click="delete({{ $camp->id }})" wire:confirm="Hapus campaign ini secara permanen?" class="p-1.5 text-red-600 hover:bg-red-50 rounded border border-red-200" title="Hapus">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-8 text-center text-gray-500">
                                        Tidak ada campaign yang ditemukan.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $campaigns->links() }}
                </div>
            </div>

        @endif

    </main>
</div>