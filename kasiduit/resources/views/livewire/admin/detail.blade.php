<div
    class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 overflow-hidden max-w-5xl mx-auto animate-fade-in-up">

    {{-- Header Detail --}}
    <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
        <div>
            <h2 class="text-xl font-bold text-gray-900 tracking-tight">Detail Campaign</h2>
            <p class="text-sm text-gray-500 mt-1">Informasi lengkap mengenai campaign ini.</p>
        </div>
        <div class="flex gap-2">
            <button wire:click="edit({{ $campaignId }})"
                class="px-4 py-2 bg-blue-50 text-blue-600 text-sm font-bold rounded-lg hover:bg-blue-100 transition">
                Edit
            </button>
            <button wire:click="cancel"
                class="p-2 text-gray-400 hover:text-gray-600 hover:bg-gray-100 rounded-full transition">
                <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <div class="p-8">
        <div class="flex flex-col md:flex-row gap-8">
            {{-- Gambar --}}
            <div class="w-full md:w-1/3">
                <div class="rounded-xl overflow-hidden shadow-sm border border-gray-100">
                    @if($old_image)
                        <img src="{{ Str::startsWith($old_image, 'http') ? $old_image : asset('storage/' . $old_image) }}"
                            class="w-full h-auto object-cover">
                    @else
                        <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">No Image</div>
                    @endif
                </div>

                <div class="mt-4 p-4 bg-gray-50 rounded-xl border border-gray-100">
                    <h4 class="text-sm font-bold text-gray-900 mb-2">Informasi Pembuat</h4>
                    <p class="text-sm text-gray-600"><span class="font-medium">Nama:</span>
                        {{ $campaign->user->name ?? 'Admin' }}</p>
                    <p class="text-sm text-gray-600"><span class="font-medium">Email:</span>
                        {{ $campaign->user->email ?? '-' }}</p>
                    <p class="text-sm text-gray-600"><span class="font-medium">Dibuat:</span>
                        {{ $campaign->created_at->format('d M Y') }}</p>
                </div>
            </div>

            {{-- Informasi Detail --}}
            <div class="w-full md:w-2/3 space-y-6">
                <div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2 break-words break-all">{{ $title }}</h3>
                    <div class="flex items-center gap-3">
                        <span
                            class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">
                            {{ $campaign->category->name ?? 'Uncategorized' }}
                        </span>
                        @if($status == 'active')
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 border border-green-200">Active</span>
                        @elseif($status == 'pending')
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-700 border border-yellow-200">Pending</span>
                        @elseif($status == 'rejected')
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 border border-red-200">Rejected</span>
                        @else
                            <span
                                class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-600 border border-gray-200">Finished</span>
                        @endif
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div class="p-4 bg-white border border-gray-100 rounded-xl shadow-sm">
                        <p class="text-xs text-gray-500 mb-1">Target Dana</p>
                        <p class="text-lg font-bold text-gray-900">Rp {{ number_format($target_amount, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="p-4 bg-white border border-gray-100 rounded-xl shadow-sm">
                        <p class="text-xs text-gray-500 mb-1">Batas Waktu</p>
                        <p class="text-lg font-bold text-gray-900">
                            {{ \Carbon\Carbon::parse($deadline)->format('d F Y') }}</p>
                    </div>
                </div>

                {{-- === BAGIAN CERITA === --}}
                <div x-data="{ expanded: false }">
                    <h4 class="text-sm font-bold text-gray-900 mb-2">Cerita Lengkap</h4>
                    <div
                        class="bg-gray-50 px-3 py-1.5 rounded-xl border border-gray-100 text-sm text-gray-600 whitespace-pre-line overflow-hidden break-words break-all w-fit max-w-full leading-normal">
                        @if(strlen($full_description) > 100)
                            <span x-show="!expanded">{{ Str::limit(trim($full_description), 100, '...') }}</span><span
                                x-show="expanded" x-cloak class="animate-fade-in block">{{ trim($full_description) }}</span>
                        @else
                            <span>{{ trim($full_description) }}</span>
                        @endif
                    </div>

                    @if(strlen($full_description) > 100)
                        <button @click="expanded = !expanded"
                            class="mt-2 text-red-600 font-bold text-sm hover:underline focus:outline-none flex items-center gap-1 transition-colors">
                            <span x-text="expanded ? 'Sembunyikan' : 'Baca Selengkapnya'"></span>
                            <svg x-show="!expanded" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                            <svg x-show="expanded" class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                style="display: none;">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7" />
                            </svg>
                        </button>
                    @endif
                </div>

                {{-- Tombol Verifikasi --}}
                @if($status == 'pending')
                    <div class="pt-6 border-t border-gray-100 flex gap-3">
                        <button wire:click="approve({{ $campaignId }}); $set('showDetail', false)"
                            class="flex-1 py-3 bg-green-600 text-white font-bold rounded-xl hover:bg-green-700 transition">
                            Setujui Campaign
                        </button>
                        <button wire:click="reject({{ $campaignId }}); $set('showDetail', false)"
                            class="flex-1 py-3 bg-red-600 text-white font-bold rounded-xl hover:bg-red-700 transition">
                            Tolak Campaign
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>