<div>
    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Kelola Campaign</h1>
            <p class="text-sm text-gray-500 mt-1">Verifikasi, pantau, dan kelola semua penggalangan dana.</p>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 w-full md:w-auto">
            <div class="relative w-full sm:w-72">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari judul campaign..." 
                    class="w-full pl-10 pr-4 py-2.5 border border-gray-200 rounded-xl focus:ring-red-500 focus:border-red-500 text-sm shadow-sm">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                </div>
            </div>

            <button wire:click="create" class="px-5 py-2.5 bg-red-600 text-white rounded-xl hover:bg-red-700 text-sm font-bold whitespace-nowrap shadow-md shadow-red-100 flex items-center justify-center gap-2 transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Baru
            </button>
        </div>
    </div>

    {{-- Tabel Data --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-white border-b border-gray-100 text-gray-400 uppercase text-xs tracking-wider font-medium">
                    <tr>
                        <th class="px-6 py-4">Info Campaign</th>
                        <th class="px-6 py-4">Pembuat</th>
                        <th class="px-6 py-4">Target & Deadline</th>
                        <th class="px-6 py-4 text-center">Status</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-sm">
                    @forelse($campaigns as $camp)
                        <tr class="hover:bg-gray-50/80 transition duration-150 group">
                            <td class="px-6 py-4 align-top max-w-xs">
                                <div class="flex gap-4">
                                    <div class="w-16 h-16 rounded-xl bg-gray-100 shrink-0 overflow-hidden border border-gray-100">
                                        @if($camp->image_path)
                                            <img src="{{ Str::startsWith($camp->image_path, 'http') ? $camp->image_path : asset('storage/'.$camp->image_path) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full flex items-center justify-center text-gray-300">
                                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd" /></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="font-bold text-gray-900 group-hover:text-red-600 transition cursor-pointer" 
                                                wire:click="viewDetail({{ $camp->id }})" 
                                                title="{{ $camp->title }}">
                                            {{ Str::limit($camp->title, 30, '...') }}
                                        </div>
                                        <span class="inline-block mt-1 px-2 py-0.5 rounded text-[10px] font-semibold bg-gray-100 text-gray-500 border border-gray-200">
                                            {{ $camp->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </div>
                                </div>
                            </td>

                            <td class="px-6 py-4 align-top">
                                <div class="text-gray-900 font-semibold text-sm">{{ $camp->user->name ?? 'Admin' }}</div>
                                <div class="text-xs text-gray-400 mt-0.5">{{ Str::limit($camp->user->email ?? '-', 15) }}</div>
                            </td>

                            <td class="px-6 py-4 align-top whitespace-nowrap">
                                <div class="font-bold text-gray-900">Rp {{ number_format($camp->target_amount, 0, ',', '.') }}</div>
                                <div class="text-xs text-gray-500 mt-0.5">
                                    <span class="text-gray-400">Deadline:</span> {{ \Carbon\Carbon::parse($camp->deadline)->format('d M Y') }}
                                </div>
                            </td>

                            <td class="px-6 py-4 align-top text-center">
                                @if($camp->status == 'pending')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-yellow-50 text-yellow-600 border border-yellow-100 mb-2">
                                        Menunggu
                                    </span>
                                    <div class="flex justify-center gap-1">
                                        <button wire:click="approve({{ $camp->id }})" class="p-1 bg-white text-green-600 border border-green-200 rounded hover:bg-green-50 transition" title="Setujui">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                        <button wire:click="reject({{ $camp->id }})" wire:confirm="Yakin tolak campaign ini?" class="p-1 bg-white text-red-600 border border-red-200 rounded hover:bg-red-50 transition" title="Tolak">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </div>
                                @elseif($camp->status == 'active')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-blue-50 text-blue-600 border border-blue-100">Active</span>
                                @elseif($camp->status == 'rejected')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-red-50 text-red-600 border border-red-100">Ditolak</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">Selesai</span>
                                @endif
                            </td>

                            <td class="px-6 py-4 align-middle text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <button wire:click="viewDetail({{ $camp->id }})" class="p-2 text-gray-400 hover:text-green-600 hover:bg-green-50 rounded-lg transition" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                                    </button>
                                    <button wire:click="edit({{ $camp->id }})" class="p-2 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </button>
                                    <button wire:click="delete({{ $camp->id }})" wire:confirm="Hapus campaign ini secara permanen?" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-10 text-center text-gray-400 text-sm">Tidak ada campaign yang ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/30">
            {{ $campaigns->links() }}
        </div>
    </div>
</div>