<h2 class="text-lg font-bold text-gray-900 mb-6">Identitas Donatur</h2>

{{-- Pilihan Anonim --}}
<div class="mb-6 p-4 rounded-xl border border-gray-200 cursor-pointer flex items-center gap-3 transition hover:border-red-200" wire:click="$toggle('isAnonymous')">
    <div class="w-5 h-5 rounded border flex items-center justify-center transition-colors {{ $isAnonymous ? 'bg-gray-800 border-gray-800' : 'border-gray-300' }}">
        @if($isAnonymous) 
            <svg class="w-3 h-3 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
            </svg> 
        @endif
    </div>
    <span class="text-gray-700 font-medium">Sembunyikan nama saya (Hamba Allah)</span>
</div>

{{-- Input Doa --}}
<div class="mb-8">
    <label class="block text-sm font-medium text-gray-700 mb-2">Doa / Dukungan</label>
    <textarea wire:model="prayer" rows="4" 
        class="w-full p-4 rounded-xl border border-gray-300 focus:border-red-600 focus:ring-1 focus:ring-red-600 transition outline-none" 
        placeholder="Tulis doa atau dukungan Anda untuk campaign ini..."></textarea>
</div>

{{-- Tombol Lanjut --}}
{{-- PERHATIAN: Pastikan nama fungsi ini sama dengan di Donate.php (validateIdentity) --}}
<button wire:click="validateIdentity" class="w-full py-3.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl shadow-lg shadow-red-200 transition transform hover:-translate-y-0.5">
    Lanjutkan Ke Konfirmasi
</button>