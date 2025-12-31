<div>
    {{-- HEADER & DATE PICKER --}}
    <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-8">
        <div>
            <h1 class="text-3xl font-bold text-gray-900 tracking-tight">Dashboard</h1>
            <p class="text-sm text-gray-500 mt-1">Ringkasan aktivitas dan statistik platform donasi.</p>
        </div>
        <div>
            <button class="bg-white border border-gray-200 text-gray-700 px-4 py-2.5 rounded-lg shadow-sm text-sm font-medium flex items-center gap-2 hover:bg-gray-50 transition">
                <svg class="w-5 h-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                {{ now()->format('d F Y') }}
            </button>
        </div>
    </div>

    {{-- STATS CARDS --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
        {{-- Card 1: Total Donasi --}}
        <div class="bg-white p-6 rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 relative overflow-hidden">
            <div class="flex justify-between items-start mb-4">
                <div class="p-3 bg-red-50 text-red-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <span class="bg-green-100 text-green-700 text-xs font-bold px-2.5 py-1 rounded-full">+12%</span>
            </div>
            <p class="text-sm text-gray-500 font-medium mb-1">Total Donasi</p>
            <h3 class="text-2xl font-extrabold text-gray-900">Rp {{ number_format($stats['total_donasi'] ?? 0, 0, ',', '.') }}</h3>
        </div>

        {{-- Card 2: Menunggu Verifikasi --}}
        <div class="bg-white p-6 rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100">
            <div class="mb-4">
                <div class="w-12 h-12 flex items-center justify-center bg-yellow-50 text-yellow-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                </div>
            </div>
            <p class="text-sm text-gray-500 font-medium mb-1">Menunggu Verifikasi</p>
            <h3 class="text-2xl font-extrabold text-gray-900 flex items-baseline gap-2">
                {{ $stats['pending_campaign'] ?? 0 }} <span class="text-sm font-normal text-gray-400">Campaign</span>
            </h3>
        </div>

        {{-- Card 3: Campaign Aktif --}}
        <div class="bg-white p-6 rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100">
            <div class="mb-4">
                <div class="w-12 h-12 flex items-center justify-center bg-blue-50 text-blue-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" /></svg>
                </div>
            </div>
            <p class="text-sm text-gray-500 font-medium mb-1">Campaign Aktif</p>
            <h3 class="text-2xl font-extrabold text-gray-900">{{ $stats['total_campaign'] ?? 0 }}</h3>
        </div>

        {{-- Card 4: Total Pengguna --}}
        <div class="bg-white p-6 rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100">
            <div class="mb-4">
                <div class="w-12 h-12 flex items-center justify-center bg-purple-50 text-purple-600 rounded-xl">
                    <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                </div>
            </div>
            <p class="text-sm text-gray-500 font-medium mb-1">Total Pengguna</p>
            <h3 class="text-2xl font-extrabold text-gray-900">{{ $stats['total_user'] ?? 0 }}</h3>
        </div>
    </div>

    {{-- MAIN CONTENT SPLIT --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        {{-- LEFT: CAMPAIGN TERBARU TABLE --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 p-6 h-full flex flex-col">
                <div class="flex justify-between items-center mb-6">
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg">Campaign Terbaru</h3>
                        <p class="text-xs text-gray-400 mt-1">Data penggalangan dana yang baru masuk.</p>
                    </div>
                    <a href="{{ route('admin.campaigns') }}" class="text-sm font-bold text-red-600 hover:text-red-700 flex items-center gap-1 group">
                        Lihat Semua
                        <svg class="w-4 h-4 transition-transform group-hover:translate-x-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="overflow-x-auto flex-1">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="text-xs text-gray-400 uppercase tracking-wider border-b border-gray-50">
                                <th class="pb-3 font-medium">Detail Campaign</th>
                                <th class="pb-3 font-medium">Target</th>
                                <th class="pb-3 font-medium text-center">Status</th>
                                <th class="pb-3 font-medium text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($recentCampaigns as $camp)
                            <tr class="group hover:bg-gray-50 transition-colors">
                                <td class="py-4 pr-4">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-xl bg-gray-100 overflow-hidden flex-shrink-0">
                                            @if($camp->image_path)
                                                <img src="{{ Str::startsWith($camp->image_path, 'http') ? $camp->image_path : asset('storage/'.$camp->image_path) }}" class="w-full h-full object-cover">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($camp->title) }}&background=random" class="w-full h-full object-cover">
                                            @endif
                                        </div>
                                        <div>
                                            <h4 class="font-bold text-gray-900 text-sm line-clamp-1 group-hover:text-red-600 transition">
                                                <a href="{{ route('admin.campaigns', ['id' => $camp->id]) }}">{{ $camp->title }}</a>
                                            </h4>
                                            <p class="text-xs text-gray-400 mt-0.5">Oleh: <span class="text-gray-500">{{ explode(' ', $camp->user->name)[0] }}</span></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="py-4 align-middle">
                                    <div class="text-sm font-bold text-gray-900">Rp {{ number_format($camp->target_amount, 0, ',', '.') }}</div>
                                    <div class="text-[10px] text-gray-400 mt-0.5">Deadline: {{ \Carbon\Carbon::parse($camp->deadline)->format('d M') }}</div>
                                </td>
                                <td class="py-4 align-middle text-center">
                                    @if($camp->status === 'active')
                                        <span class="inline-block px-2.5 py-1 rounded-md text-xs font-bold bg-green-50 text-green-600">Aktif</span>
                                    @elseif($camp->status === 'pending')
                                        <span class="inline-block px-2.5 py-1 rounded-md text-xs font-bold bg-yellow-50 text-yellow-600">Pending</span>
                                    @else
                                        <span class="inline-block px-2.5 py-1 rounded-md text-xs font-bold bg-gray-100 text-gray-600 capitalize">{{ $camp->status }}</span>
                                    @endif
                                </td>
                                <td class="py-4 align-middle text-right">
                                    <a href="{{ route('admin.campaigns', ['id' => $camp->id]) }}" class="text-gray-300 hover:text-gray-600 p-2 rounded-full hover:bg-gray-100 transition inline-block">
                                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr><td colspan="4" class="py-12 text-center text-sm text-gray-400">Belum ada data campaign terbaru.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- RIGHT: PENGGUNA BARU LIST --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded-2xl shadow-[0_2px_15px_-3px_rgba(0,0,0,0.07),0_10px_20px_-2px_rgba(0,0,0,0.04)] border border-gray-100 p-6 sticky top-6">
                <div class="mb-6 flex justify-between items-center">
                    <div>
                        <h3 class="font-bold text-gray-900 text-lg">Pengguna Baru</h3>
                        <p class="text-xs text-gray-400 mt-1">User yang baru mendaftar.</p>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-md bg-red-50 text-red-600 text-xs font-bold">{{ $recentUsers->count() }}</span>
                </div>

                <div class="space-y-4">
                    @forelse($recentUsers as $user)
                    <div class="flex items-center gap-3 p-3 border border-gray-50 rounded-xl hover:bg-gray-50 hover:border-gray-100 transition duration-150 group cursor-default">
                        
                        {{-- Avatar --}}
                        <div class="shrink-0 relative">
                            @if($user->avatar)
                                <img src="{{ Str::startsWith($user->avatar, 'http') ? $user->avatar : asset('storage/'.$user->avatar) }}" 
                                     class="w-10 h-10 rounded-full object-cover border border-gray-100 group-hover:border-red-200 transition">
                            @else
                                <div class="w-10 h-10 rounded-full bg-red-50 text-red-600 flex items-center justify-center font-bold text-sm shrink-0 border border-transparent group-hover:bg-red-600 group-hover:text-white transition-colors">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        {{-- Info --}}
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-gray-900 text-sm truncate group-hover:text-red-600 transition">{{ $user->name }}</h4>
                            <div class="flex items-center gap-2 mt-0.5">
                                <span class="inline-flex items-center px-1.5 py-0.5 rounded text-[10px] font-medium bg-gray-100 text-gray-600">
                                    {{ $user->role ?? 'User' }}
                                </span>
                                <span class="text-[10px] text-gray-400 whitespace-nowrap">&bull; {{ $user->created_at->diffForHumans(null, true) }}</span>
                            </div>
                        </div>

                        {{-- Action Button (CLICKABLE EYE ICON) --}}
                        <button wire:click="viewUser({{ $user->id }})" class="p-2 text-gray-300 hover:text-blue-600 hover:bg-blue-50 rounded-full transition" title="Lihat Profil">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </button>
                    </div>
                    @empty
                    <div class="text-center py-4 text-gray-400 text-sm">Belum ada user baru.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- MODAL DETAIL USER (OVERLAY) --}}
    @if($showUserModal && $selectedUser)
    <div class="fixed inset-0 z-[100] flex items-center justify-center px-4" 
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0">
        
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="closeUserModal"></div>

        {{-- Modal Content --}}
        <div class="bg-white rounded-3xl shadow-2xl w-full max-w-lg relative overflow-hidden z-10 animate-fade-in-up">
            
            {{-- Header with Background --}}
            <div class="relative h-32 bg-red-600">
                <div class="absolute inset-0 bg-gradient-to-b from-black/20 to-transparent"></div>
                <button wire:click="closeUserModal" class="absolute top-4 right-4 bg-white/20 hover:bg-white/40 text-white p-2 rounded-full transition backdrop-blur-md">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>

            <div class="px-8 pb-8 -mt-12 relative">
                {{-- Avatar --}}
                <div class="flex justify-center mb-4">
                    <div class="p-1.5 bg-white rounded-full shadow-md">
                        @if($selectedUser->avatar)
                            <img src="{{ Str::startsWith($selectedUser->avatar, 'http') ? $selectedUser->avatar : asset('storage/'.$selectedUser->avatar) }}" 
                                 class="w-24 h-24 rounded-full object-cover border-2 border-gray-100">
                        @else
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($selectedUser->name) }}&background=fee2e2&color=dc2626&size=256" 
                                 class="w-24 h-24 rounded-full object-cover border-2 border-gray-100">
                        @endif
                    </div>
                </div>

                {{-- Name & Role --}}
                <div class="text-center mb-8">
                    <h3 class="text-2xl font-bold text-gray-900">{{ $selectedUser->name }}</h3>
                    <div class="flex items-center justify-center gap-2 mt-2">
                        <span class="px-3 py-1 bg-red-50 text-red-600 text-xs font-bold rounded-full uppercase tracking-wide">
                            {{ $selectedUser->role ?? 'User' }}
                        </span>
                        <span class="text-sm text-gray-500">Bergabung {{ $selectedUser->created_at->format('d M Y') }}</span>
                    </div>
                </div>

                {{-- Info Grid --}}
                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-400 font-bold uppercase mb-1">Email</p>
                        <p class="text-sm font-semibold text-gray-800 break-all">{{ $selectedUser->email }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                        <p class="text-xs text-gray-400 font-bold uppercase mb-1">WhatsApp</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $selectedUser->phone ?? '-' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 col-span-2">
                        <p class="text-xs text-gray-400 font-bold uppercase mb-1">Domisili</p>
                        <p class="text-sm font-semibold text-gray-800">{{ $selectedUser->location ?? '-' }}</p>
                    </div>
                </div>

                {{-- Bio --}}
                @if($selectedUser->bio)
                <div class="mb-8">
                    <p class="text-xs text-gray-400 font-bold uppercase mb-2">Bio Singkat</p>
                    <p class="text-sm text-gray-600 leading-relaxed italic">"{{ $selectedUser->bio }}"</p>
                </div>
                @endif

                {{-- Stats Footer --}}
                <div class="grid grid-cols-2 gap-4 border-t border-gray-100 pt-6">
                    <div class="text-center">
                        <p class="text-2xl font-bold text-gray-900">{{ $selectedUser->donations_count ?? 0 }}</p>
                        <p class="text-xs text-gray-500">Total Donasi</p>
                    </div>
                    <div class="text-center border-l border-gray-100">
                        <p class="text-2xl font-bold text-gray-900">{{ $selectedUser->campaigns_count ?? 0 }}</p>
                        <p class="text-xs text-gray-500">Campaign Dibuat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif

</div>