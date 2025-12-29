<div class="min-h-screen bg-gray-50 py-12 font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-10">
            <div class="flex items-center justify-center w-full">
                <div class="relative flex flex-col items-center group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border-2 transition-colors duration-300
                        {{ $currentStep >= 1 ? 'bg-red-600 border-red-600 text-white' : 'bg-white border-gray-300 text-gray-500' }}">
                        1
                    </div>
                    <span class="absolute top-12 text-xs font-medium {{ $currentStep >= 1 ? 'text-red-600' : 'text-gray-500' }}">
                        Info Campaign
                    </span>
                </div>

                <div class="w-1/4 h-1 mx-2 rounded {{ $currentStep >= 2 ? 'bg-red-600' : 'bg-gray-200' }}"></div>

                <div class="relative flex flex-col items-center group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border-2 transition-colors duration-300
                        {{ $currentStep >= 2 ? 'bg-red-600 border-red-600 text-white' : 'bg-white border-gray-300 text-gray-500' }}">
                        2
                    </div>
                    <span class="absolute top-12 text-xs font-medium {{ $currentStep >= 2 ? 'text-red-600' : 'text-gray-500' }}">
                        Detail & Media
                    </span>
                </div>

                <div class="w-1/4 h-1 mx-2 rounded {{ $currentStep >= 3 ? 'bg-red-600' : 'bg-gray-200' }}"></div>

                <div class="relative flex flex-col items-center group">
                    <div class="flex items-center justify-center w-10 h-10 rounded-full border-2 transition-colors duration-300
                        {{ $currentStep >= 3 ? 'bg-red-600 border-red-600 text-white' : 'bg-white border-gray-300 text-gray-500' }}">
                        3
                    </div>
                    <span class="absolute top-12 text-xs font-medium {{ $currentStep >= 3 ? 'text-red-600' : 'text-gray-500' }}">
                        Verifikasi
                    </span>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            @if($currentStep == 1)
            <div class="p-8 md:p-10 animate-fade-in-up">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Informasi Campaign</h2>
                
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori Campaign *</label>
                        <select wire:model="category_id" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
                            <option value="">Pilih Kategori</option>
                            @foreach($categoriesList as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Judul Campaign *</label>
                        <input type="text" wire:model="title" placeholder="Contoh: Bantu Pengobatan Ibu Saya Melawan Kanker" 
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
                        <p class="text-xs text-gray-500 mt-1">Buat judul yang singkat dan jelas menarik perhatian.</p>
                        @error('title') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Target Dana (Rp) *</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-4 flex items-center text-gray-500 font-bold">Rp</span>
                                <input type="number" wire:model="target_amount" placeholder="0" 
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
                            </div>
                            @error('target_amount') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Batas Waktu *</label>
                            <input type="date" wire:model="deadline" 
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
                            @error('deadline') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-end">
                    <button wire:click="validateStep1" type="button" 
                        class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full shadow-lg shadow-red-200 transition transform hover:-translate-y-0.5">
                        Lanjutkan
                    </button>
                </div>
            </div>
            @endif

            @if($currentStep == 2)
            <div class="p-8 md:p-10 animate-fade-in-up">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Detail & Media Campaign</h2>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Cerita Campaign *</label>
                        <textarea wire:model="description" rows="8" placeholder="Ceritakan detail tentang campaign Anda. Jelaskan siapa yang akan dibantu, mengapa mereka membutuhkan bantuan, dan bagaimana dana akan digunakan..." 
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition"></textarea>
                        @error('description') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Foto/Video Campaign *</label>
                        
                        <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:bg-gray-50 transition relative">
                            <div class="space-y-1 text-center">
                                @if ($image)
                                    <img src="{{ $image->temporaryUrl() }}" class="mx-auto h-48 object-cover rounded-lg mb-4">
                                    <p class="text-sm text-green-600 font-semibold">Foto berhasil dipilih!</p>
                                @else
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600 justify-center">
                                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-red-600 hover:text-red-500 focus-within:outline-none">
                                            <span>Klik untuk upload foto</span>
                                            <input id="file-upload" wire:model="image" type="file" class="sr-only" accept="image/*">
                                        </label>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG hingga 5MB</p>
                                @endif
                            </div>
                            
                            <div wire:loading wire:target="image" class="absolute inset-0 bg-white/80 flex items-center justify-center">
                                <span class="text-red-600 font-semibold animate-pulse">Mengupload...</span>
                            </div>
                        </div>
                        @error('image') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between">
                    <button wire:click="previousStep" type="button" 
                        class="px-6 py-3 border border-gray-300 text-gray-600 font-bold rounded-full hover:bg-gray-50 transition">
                        Kembali
                    </button>
                    <button wire:click="validateStep2" type="button" 
                        class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full shadow-lg shadow-red-200 transition transform hover:-translate-y-0.5">
                        Lanjutkan
                    </button>
                </div>
            </div>
            @endif

            @if($currentStep == 3)
            <div class="p-8 md:p-10 animate-fade-in-up">
                <h2 class="text-2xl font-bold text-gray-900 mb-6">Data Penggalang Dana</h2>

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nama Lengkap *</label>
                        <input type="text" wire:model="organizer_name" placeholder="Nama lengkap sesuai KTP"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
                        @error('organizer_name') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nomor Telepon *</label>
                        <input type="tel" wire:model="phone_number" placeholder="+62 812 3456 7890"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring focus:ring-red-200 transition">
                        @error('phone_number') <span class="text-red-500 text-sm mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                        <input type="email" wire:model="email" readonly
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 bg-gray-100 text-gray-500 cursor-not-allowed">
                    </div>

                    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex gap-3 items-start">
                        <svg class="w-5 h-5 text-blue-600 mt-0.5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <div class="text-sm text-blue-800">
                            <span class="font-bold">Verifikasi Identitas</span>
                            <p class="mt-1">Setelah submit, tim kami akan menghubungi Anda untuk proses verifikasi identitas. Campaign akan ditampilkan setelah verifikasi selesai (1-2 hari kerja).</p>
                        </div>
                    </div>

                    <div class="flex items-start">
                        <div class="flex items-center h-5">
                            <input id="agree" wire:model="agree" type="checkbox" class="w-4 h-4 border border-gray-300 rounded text-red-600 focus:ring-red-500">
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="agree" class="text-gray-600">
                                Saya menyatakan bahwa informasi yang saya berikan adalah benar dan saya bertanggung jawab penuh atas campaign ini. Saya setuju dengan <a href="#" class="text-red-600 hover:underline">syarat dan ketentuan</a> yang berlaku.
                            </label>
                        </div>
                    </div>
                    @error('agree') <span class="text-red-500 text-sm block">{{ $message }}</span> @enderror
                </div>

                <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between">
                    <button wire:click="previousStep" type="button" 
                        class="px-6 py-3 border border-gray-300 text-gray-600 font-bold rounded-full hover:bg-gray-50 transition">
                        Kembali
                    </button>
                    <button wire:click="submit" type="button" 
                        class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full shadow-lg shadow-red-200 transition transform hover:-translate-y-0.5 flex items-center gap-2">
                        <span wire:loading.remove wire:target="submit">Submit Campaign</span>
                        <span wire:loading wire:target="submit">Memproses...</span>
                    </button>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>