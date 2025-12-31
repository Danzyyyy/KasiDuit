<div class="min-h-screen bg-gray-50 font-sans text-gray-800">
    
    {{-- HEADER --}}
    <div class="bg-white border-b border-gray-200 sticky top-0 z-50">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            
            {{-- PERBAIKAN LOGIKA TOMBOL KEMBALI --}}
            @if($step == 1)
                {{-- KASUS 1: Jika masih di Step 1, link kembali ke Halaman Detail Campaign --}}
                <a href="{{ route('campaign.detail', $campaign->id) }}" class="flex items-center text-gray-500 hover:text-red-600 transition font-medium cursor-pointer">
                    <svg class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </a>
            @elseif($step > 1 && $step < 4) 
                {{-- KASUS 2: Jika di Step 2 atau 3, tombol mundur ke step sebelumnya --}}
                <button wire:click="prevStep" class="flex items-center text-gray-500 hover:text-red-600 transition font-medium">
                    <svg class="w-5 h-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                    Kembali
                </button>
            @else
                {{-- KASUS 3: Jika sudah sukses (Step 4), kosongkan kiri --}}
                <div></div> 
            @endif

            <div class="flex items-center gap-2">
                <span class="text-xl font-bold text-gray-800">KasiDuit</span>
            </div>
        </div>
    </div>

    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- PROGRESS BAR (Updated: 3 Steps Only) --}}
        @if($step < 4)
        <div class="mb-12 max-w-2xl mx-auto">
            <div class="flex items-center justify-between relative">
                {{-- Garis Background --}}
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 w-full h-0.5 bg-gray-200 -z-10"></div>
                
                {{-- Garis Merah (Active) - Width calculation adjusted for 3 steps (50% per step) --}}
                <div class="absolute left-0 top-1/2 transform -translate-y-1/2 h-0.5 bg-red-600 -z-10 transition-all duration-500" 
                     style="width: {{ ($step - 1) * 50 }}%"></div>

                {{-- Labels: Nominal, Identitas, Konfirmasi (Pembayaran removed) --}}
                @foreach(['Nominal', 'Identitas', 'Konfirmasi'] as $index => $label)
                    @php $stepNum = $index + 1; @endphp
                    <div class="flex flex-col items-center bg-gray-50 px-2">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold border-2 transition-colors duration-300
                            {{ $step >= $stepNum ? 'bg-red-600 border-red-600 text-white' : 'bg-white border-gray-300 text-gray-400' }}">
                            {{ $stepNum }}
                        </div>
                        <span class="text-xs mt-2 font-medium {{ $step >= $stepNum ? 'text-red-600' : 'text-gray-400' }}">{{ $label }}</span>
                    </div>
                @endforeach
            </div>
        </div>
        @endif

        <div class="flex flex-col lg:flex-row gap-8">
            
            {{-- KONTEN UTAMA (PARTIALS) --}}
            {{-- Layout logic: if success (step 4), full width. Else 2/3 width --}}
            <div class="w-full {{ $step < 4 ? 'lg:w-2/3' : 'w-full max-w-2xl mx-auto' }}">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                    @if($step == 1)
                        {{-- Step 1: Input Nominal --}}
                        @include('livewire.donation.step1-nominal')
                    
                    @elseif($step == 2)
                        {{-- Step 2: Langsung ke Identitas (Skip Pembayaran Manual) --}}
                        @include('livewire.donation.step2-identity')
                    
                    @elseif($step == 3)
                        {{-- Step 3: Konfirmasi --}}
                        @include('livewire.donation.step3-confirmation')
                    @endif
                </div>
            </div>

            {{-- SIDEBAR (Hanya tampil jika belum sukses) --}}
            @if($step < 4)
            <div class="w-full lg:w-1/3">
                @include('livewire.donation.sidebar')
            </div>
            @endif

        </div>
    </div>
</div>

{{-- SCRIPT INTEGRASI MIDTRANS + LIVEWIRE --}}
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    document.addEventListener('livewire:initialized', () => {
        Livewire.on('open-payment-popup', (event) => {
            let snapToken = event.token; 
            
            window.snap.pay(snapToken, {
                // Sukses
                onSuccess: function(result){
                    @this.call('finishPayment', result);
                },
                // Pending
                onPending: function(result){
                    @this.call('finishPayment', result);
                },
                // Error
                onError: function(result){
                    @this.call('finishPayment', result);
                },
                // === PERBAIKAN DI SINI ===
                // Ketika tombol X (Close) diklik
                onClose: function(){
                    // Panggil finishPayment agar user tetap diarahkan ke halaman Check Status
                    // Walaupun belum bayar, statusnya sudah 'Pending' di database
                    @this.call('finishPayment'); 
                }
            });
        });
    });
</script>