<div class="min-h-screen bg-gray-50 pb-20">
    {{-- Header Background --}}
    <div class="bg-red-600 h-48 w-full relative">
        <div class="absolute inset-0 bg-gradient-to-b from-black/10 to-transparent"></div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-24 relative z-10">
        <div class="flex flex-col md:flex-row gap-8">
            
            {{-- KOLOM KIRI: Sidebar Menu & Foto --}}
            <div class="w-full md:w-1/3 lg:w-1/4 flex flex-col gap-6">
                
                {{-- Card Foto Profil --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center">
                    <div class="relative inline-block" x-data>
                        @if ($photo)
                            <img class="h-32 w-32 rounded-full border-4 border-white shadow-md mx-auto object-cover" 
                                 src="{{ $photo->temporaryUrl() }}">
                        @elseif (Auth::user()->avatar)
                            <img class="h-32 w-32 rounded-full border-4 border-white shadow-md mx-auto object-cover" 
                                 src="{{ Str::startsWith(Auth::user()->avatar, 'http') ? Auth::user()->avatar : asset('storage/' . Auth::user()->avatar) }}">
                        @else
                            <img class="h-32 w-32 rounded-full border-4 border-white shadow-md mx-auto object-cover" 
                                 src="https://ui-avatars.com/api/?name={{ urlencode($name) }}&background=fee2e2&color=dc2626&size=256">
                        @endif

                        <label for="photo-upload" class="absolute bottom-0 right-0 bg-gray-800 text-white p-2 rounded-full hover:bg-gray-700 transition border-2 border-white cursor-pointer" title="Ganti Foto">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <input type="file" id="photo-upload" wire:model="photo" class="hidden" accept="image/*">
                        </label>
                    </div>
                    
                    <div wire:loading wire:target="photo" class="text-xs text-red-500 mt-2 font-semibold">
                        Mengupload foto...
                    </div>

                    <h2 class="mt-4 text-xl font-bold text-gray-900">{{ Auth::user()->name }}</h2>
                    <p class="text-gray-500 text-sm mb-4">Bergabung sejak {{ Auth::user()->created_at->format('M Y') }}</p>
                    
                    <div class="flex justify-center gap-2">
                        @if(Auth::user()->email_verified_at)
                        <span class="px-3 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-full flex items-center gap-1">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                            Terverifikasi
                        </span>
                        @endif
                        @if(Auth::user()->google_id)
                        <span class="px-3 py-1 bg-blue-100 text-blue-700 text-xs font-bold rounded-full">User Google</span>
                        @endif
                    </div>
                </div>

                {{-- Navigasi Sidebar --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <nav class="flex flex-col">
                        <button wire:click="switchTab('edit_profile')" 
                            class="px-6 py-4 flex items-center gap-3 w-full text-left transition
                            {{ $activeTab === 'edit_profile' ? 'text-red-600 bg-red-50 font-medium border-l-4 border-red-600' : 'text-gray-600 hover:bg-gray-50 border-l-4 border-transparent' }}">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            Edit Profil
                        </button>

                        <button wire:click="switchTab('my_donations')" 
                            class="px-6 py-4 flex items-center gap-3 w-full text-left transition
                            {{ $activeTab === 'my_donations' ? 'text-red-600 bg-red-50 font-medium border-l-4 border-red-600' : 'text-gray-600 hover:bg-gray-50 border-l-4 border-transparent' }}">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                            Donasi Saya
                        </button>

                        <button wire:click="switchTab('change_password')" 
                            class="px-6 py-4 flex items-center gap-3 w-full text-left transition
                            {{ $activeTab === 'change_password' ? 'text-red-600 bg-red-50 font-medium border-l-4 border-red-600' : 'text-gray-600 hover:bg-gray-50 border-l-4 border-transparent' }}">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                            Ganti Password
                        </button>
                        
                        <div class="border-t border-gray-100 mt-1">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="px-6 py-4 flex items-center gap-3 w-full text-left text-gray-600 hover:bg-gray-50 hover:text-red-600 transition">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" /></svg>
                                    Keluar
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
            </div>

            {{-- KOLOM KANAN: Konten Utama --}}
            <div class="w-full md:w-2/3 lg:w-3/4 space-y-6">
                
                {{-- Statistik Cards --}}
                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center hover:shadow-md transition">
                        <div class="p-3 bg-red-100 text-red-600 rounded-full mb-3">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Rp {{ number_format($totalDonation, 0, ',', '.') }}</h3>
                        <p class="text-gray-500 text-sm">Total Donasi</p>
                    </div>
                    
                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center hover:shadow-md transition">
                         <div class="p-3 bg-orange-100 text-orange-600 rounded-full mb-3">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" /></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">{{ $supportedCampaigns }}</h3>
                        <p class="text-gray-500 text-sm">Campaign Didukung</p>
                    </div>

                    <div class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center hover:shadow-md transition">
                         <div class="p-3 bg-blue-100 text-blue-600 rounded-full mb-3">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800">Aktif</h3>
                        <p class="text-gray-500 text-sm">Status Donatur</p>
                    </div>
                </div>

                {{-- Konten Tab Dinamis (MENGGUNAKAN INCLUDE) --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                    
                    @if (session()->has('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" 
                             class="mb-6 flex items-center gap-2 text-sm text-green-700 font-medium bg-green-50 px-4 py-3 rounded-xl border border-green-100">
                            <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($activeTab === 'edit_profile')
                        @include('livewire.profile.partials.edit-profile')
                    
                    @elseif($activeTab === 'my_donations')
                        @include('livewire.profile.partials.my-donations')

                    @elseif($activeTab === 'change_password')
                        @include('livewire.profile.partials.change-password')
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>