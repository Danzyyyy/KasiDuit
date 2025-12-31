<div class="p-8 md:p-10 animate-fade-in-up">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Detail & Lokasi</h2>
    
    <div class="space-y-6">
        
        {{-- 1. Cerita Campaign --}}
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Cerita Campaign *</label>
            <textarea wire:model="description" rows="6" 
                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:border-red-600 focus:ring-red-200 focus:outline-none transition" 
                placeholder="Ceritakan detailnya secara lengkap..."></textarea>
            @error('description') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
        </div>

        {{-- 2. Foto Utama (Custom UI agar tidak muncul fakepath) --}}
        <div class="mb-6">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Foto Utama *</label>
            
            <div class="flex items-center justify-center w-full">
                <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-48 border-2 border-gray-300 border-dashed rounded-xl cursor-pointer bg-gray-50 hover:bg-gray-100 transition relative overflow-hidden group">
                    
                    @if ($image)
                        {{-- Jika gambar sudah dipilih, tampilkan preview penuh --}}
                        <img src="{{ $image->temporaryUrl() }}" class="absolute inset-0 w-full h-full object-cover">
                        
                        {{-- Overlay saat hover --}}
                        <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center opacity-0 group-hover:opacity-100 transition duration-300">
                            <span class="text-white font-bold text-sm flex items-center gap-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                Ganti Foto
                            </span>
                        </div>
                    @else
                        {{-- Tampilan Default (Belum ada gambar) --}}
                        <div class="flex flex-col items-center justify-center pt-5 pb-6">
                            <svg class="w-10 h-10 mb-3 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                            </svg>
                            <p class="mb-2 text-sm text-gray-500"><span class="font-semibold text-red-600">Klik untuk upload</span> atau drag and drop</p>
                            <p class="text-xs text-gray-400">JPG, PNG, JPEG, WEBP (Maks. 5MB)</p>
                        </div>
                    @endif

                    {{-- Input Asli (Disembunyikan dengan class="hidden") --}}
                    <input id="dropzone-file" type="file" wire:model="image" accept="image/png, image/jpeg, image/jpg, image/webp" class="hidden" />
                </label>
            </div>

            {{-- Loading Indicator --}}
            <div wire:loading wire:target="image" class="text-xs text-red-500 mt-2 flex items-center gap-1">
                <svg class="animate-spin h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                Sedang memproses gambar...
            </div>

            @error('image') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
        </div>
        <div class="border-t border-gray-100 my-4"></div>

        {{-- 3. Wilayah Administrasi --}}
        <div class="bg-gray-50 p-6 rounded-xl border border-gray-200">
            <h3 class="text-gray-800 font-bold mb-4 flex items-center gap-2">
                Wilayah Administrasi
            </h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                
                {{-- Provinsi --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Provinsi</label>
                    <div class="relative">
                        <select wire:model.live="selectedProvince" class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:border-red-600 focus:outline-none bg-white">
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach($provinces as $prov) 
                                {{-- KEMBALIKAN KE 'code' --}}
                                <option value="{{ $prov['code'] }}">{{ $prov['name'] }}</option> 
                            @endforeach
                        </select>
                    </div>
                    @error('selectedProvince') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Kota/Kabupaten --}}
                <div class="relative">
                    <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Kota/Kabupaten</label>
                    <select wire:model.live="selectedRegency" class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:border-red-600 focus:outline-none bg-white disabled:bg-gray-100" @if(empty($regencies)) disabled @endif>
                        <option value="">-- Pilih Kota --</option>
                        @foreach($regencies as $reg) 
                            {{-- KEMBALIKAN KE 'code' --}}
                            <option value="{{ $reg['code'] }}">{{ $reg['name'] }}</option> 
                        @endforeach
                    </select>
                    
                    {{-- Loading Indicator --}}
                    <div wire:loading wire:target="selectedProvince" class="absolute right-3 top-8">
                        <svg class="animate-spin h-4 w-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </div>
                    @error('selectedRegency') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Kecamatan --}}
                <div class="relative">
                    <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Kecamatan</label>
                    <select wire:model.live="selectedDistrict" class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:border-red-600 focus:outline-none bg-white disabled:bg-gray-100" @if(empty($districts)) disabled @endif>
                        <option value="">-- Pilih Kecamatan --</option>
                        @foreach($districts as $dist) 
                            {{-- KEMBALIKAN KE 'code' --}}
                            <option value="{{ $dist['code'] }}">{{ $dist['name'] }}</option> 
                        @endforeach
                    </select>
                    <div wire:loading wire:target="selectedRegency" class="absolute right-3 top-8">
                        <svg class="animate-spin h-4 w-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </div>
                    @error('selectedDistrict') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>

                {{-- Desa --}}
                <div class="relative">
                    <label class="block text-xs font-bold text-gray-500 mb-1 uppercase">Desa/Kelurahan</label>
                    <select wire:model="selectedVillage" class="w-full px-3 py-2.5 rounded-lg border border-gray-300 focus:border-red-600 focus:outline-none bg-white disabled:bg-gray-100" @if(empty($villages)) disabled @endif>
                        <option value="">-- Pilih Desa --</option>
                        @foreach($villages as $vill) 
                            {{-- KEMBALIKAN KE 'code' --}}
                            <option value="{{ $vill['code'] }}">{{ $vill['name'] }}</option> 
                        @endforeach
                    </select>
                    <div wire:loading wire:target="selectedDistrict" class="absolute right-3 top-8">
                        <svg class="animate-spin h-4 w-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
                    </div>
                    @error('selectedVillage') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

    </div>

    {{-- Tombol Navigasi --}}
    <div class="mt-8 pt-6 border-t border-gray-100 flex justify-between">
        <button wire:click="previousStep" class="px-6 py-3 border border-gray-300 text-gray-600 font-bold rounded-full hover:bg-gray-50 transition">Kembali</button>
        <button wire:click="validateStep2" class="px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-full shadow-lg transition">Lanjutkan</button>
    </div>
</div>