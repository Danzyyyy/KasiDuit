<div class="min-h-screen bg-gray-50 flex">
    
    {{-- 1. SIDEBAR ADMIN --}}
    {{-- Menggunakan class 'fixed' agar sidebar tetap diam saat konten di-scroll --}}
    <aside class="w-64 bg-white border-r border-gray-200 hidden md:block min-h-screen fixed left-0 top-0 bottom-0 overflow-y-auto z-10 pt-20">
        {{-- Header Sidebar (Opsional jika sudah ada Navbar di atas) --}}
        {{-- <div class="p-6 border-b border-gray-100">
            <h2 class="text-2xl font-bold text-red-600 flex items-center gap-2">
                <span class="text-3xl">🛡️</span> Admin
            </h2>
        </div> --}}

        <nav class="p-4 space-y-1">
            {{-- MENU 1: DASHBOARD (Sedang Aktif) --}}
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 bg-red-50 text-red-700 font-medium rounded-lg transition shadow-sm border border-red-100">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>

            {{-- MENU 2: KELOLA KATEGORI --}}
            <a href="{{ route('admin.categories') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                Kelola Kategori
            </a>

            {{-- MENU 3: KELOLA CAMPAIGN (Baru) --}}
            <a href="{{ route('admin.campaigns') }}" class="flex items-center gap-3 px-4 py-3 text-gray-600 hover:bg-gray-50 hover:text-gray-900 font-medium rounded-lg transition">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                Kelola Campaign
            </a>
        </nav>
    </aside>

    {{-- 2. KONTEN UTAMA --}}
    {{-- Tambahkan margin-left (md:ml-64) karena sidebar sekarang fixed --}}
    <main class="flex-1 p-8 md:ml-64">
        
        <div class="mb-8 flex justify-between items-center">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Dashboard Overview</h1>
                <p class="text-gray-500">Selamat datang kembali, Admin!</p>
            </div>
            <div class="text-sm text-gray-500 bg-white px-4 py-2 rounded-lg border shadow-sm">
                {{ now()->format('l, d F Y') }}
            </div>
        </div>

        {{-- STATS CARDS --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            
            {{-- Card 1: Total Donasi --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="p-3 bg-green-100 text-green-600 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Donasi</p>
                    <h3 class="text-xl font-bold text-gray-900">Rp {{ number_format($stats['total_donasi'], 0, ',', '.') }}</h3>
                </div>
            </div>

            {{-- Card 2: Perlu Approval --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4 relative overflow-hidden cursor-pointer hover:shadow-md transition" onclick="window.location='{{ route('admin.campaigns') }}'">
                @if($stats['pending_campaign'] > 0)
                    <span class="absolute top-2 right-2 flex h-3 w-3">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-3 w-3 bg-red-500"></span>
                    </span>
                @endif
                
                <div class="p-3 bg-yellow-100 text-yellow-600 rounded-full">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Perlu Verifikasi</p>
                    <h3 class="text-xl font-bold text-gray-900">{{ $stats['pending_campaign'] }} Campaign</h3>
                </div>
            </div>

            {{-- Card 3: Total Campaign --}}
            <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="p-3 bg-blue-100 text-blue-600 rounded-full">
                     <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total Campaign</p>
                    <h3 class="text-xl font-bold text-gray-900">{{ $stats['total_campaign'] }}</h3>
                </div>
            </div>

             {{-- Card 4: Total User --}}
             <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="p-3 bg-purple-100 text-purple-600 rounded-full">
                     <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <div>
                    <p class="text-sm text-gray-500 font-medium">Total User</p>
                    <h3 class="text-xl font-bold text-gray-900">{{ $stats['total_user'] }}</h3>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- TABEL CAMPAIGN TERBARU --}}
            <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="font-bold text-gray-800">Campaign Terbaru</h3>
                    {{-- Pesan Sukses --}}
                    @if (session()->has('success'))
                        <span class="text-xs text-green-600 bg-green-50 px-2 py-1 rounded-full border border-green-200 animate-pulse">
                            {{ session('success') }}
                        </span>
                    @endif
                    <a href="{{ route('admin.campaigns') }}" class="text-sm text-red-600 hover:underline">Lihat Semua</a>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left text-sm">
                        <thead class="bg-gray-50 text-gray-500">
                            <tr>
                                <th class="px-6 py-3 font-medium">Judul</th>
                                <th class="px-6 py-3 font-medium">Oleh</th>
                                <th class="px-6 py-3 font-medium">Status</th>
                                <th class="px-6 py-3 font-medium text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($recentCampaigns as $camp)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-3 max-w-xs truncate font-medium text-gray-900" title="{{ $camp->title }}">
                                        {{ Str::limit($camp->title, 30) }}
                                    </td>
                                    <td class="px-6 py-3 text-gray-500">{{ $camp->user->name ?? 'Admin' }}</td>
                                    
                                    {{-- STATUS --}}
                                    <td class="px-6 py-3">
                                        @if($camp->status == 'active')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">Aktif</span>
                                        @elseif($camp->status == 'pending')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-yellow-100 text-yellow-800">Menunggu</span>
                                        @elseif($camp->status == 'rejected')
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-red-100 text-red-800">Ditolak</span>
                                        @else
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-gray-100 text-gray-800">Selesai</span>
                                        @endif
                                    </td>

                                    {{-- AKSI --}}
                                    <td class="px-6 py-3 text-center">
                                        @if($camp->status == 'pending')
                                            <div class="flex items-center justify-center gap-2">
                                                <button wire:click="approve({{ $camp->id }})" wire:confirm="Yakin setujui campaign ini?" class="p-1.5 bg-green-50 text-green-600 rounded hover:bg-green-100 border border-green-200 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </button>
                                                <button wire:click="reject({{ $camp->id }})" wire:confirm="Yakin tolak campaign ini?" class="p-1.5 bg-red-50 text-red-600 rounded hover:bg-red-100 border border-red-200 transition">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-gray-500">Belum ada campaign baru.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- LIST USER TERBARU --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-100">
                    <h3 class="font-bold text-gray-800">User Baru</h3>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($recentUsers as $user)
                        <div class="flex items-center gap-3 px-6 py-3 hover:bg-gray-50 transition">
                            <div class="h-8 w-8 rounded-full bg-red-100 flex items-center justify-center text-red-600 font-bold text-xs">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">{{ $user->name }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ $user->email }}</p>
                            </div>
                            <span class="text-xs text-gray-400">{{ $user->created_at->diffForHumans() }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>

    </main>
</div>