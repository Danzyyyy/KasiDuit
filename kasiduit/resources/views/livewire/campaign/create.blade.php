<div class="min-h-screen bg-gray-50 py-12 font-sans">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        @if($isSuccess)
            @include('livewire.campaign.success')
        @else

            {{-- Progress Indicator --}}
            <div class="mb-10">
                <div class="flex items-center justify-center w-full">
                    <div class="relative flex flex-col items-center group">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full border-2 {{ $currentStep >= 1 ? 'bg-red-600 border-red-600 text-white' : 'bg-white border-gray-300 text-gray-500' }}">1</div>
                        <span class="absolute top-12 text-xs font-medium {{ $currentStep >= 1 ? 'text-red-600' : 'text-gray-500' }}">Info</span>
                    </div>
                    <div class="w-1/4 h-1 mx-2 rounded {{ $currentStep >= 2 ? 'bg-red-600' : 'bg-gray-200' }}"></div>
                    <div class="relative flex flex-col items-center group">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full border-2 {{ $currentStep >= 2 ? 'bg-red-600 border-red-600 text-white' : 'bg-white border-gray-300 text-gray-500' }}">2</div>
                        <span class="absolute top-12 text-xs font-medium {{ $currentStep >= 2 ? 'text-red-600' : 'text-gray-500' }}">Lokasi</span>
                    </div>
                    <div class="w-1/4 h-1 mx-2 rounded {{ $currentStep >= 3 ? 'bg-red-600' : 'bg-gray-200' }}"></div>
                    <div class="relative flex flex-col items-center group">
                        <div class="flex items-center justify-center w-10 h-10 rounded-full border-2 {{ $currentStep >= 3 ? 'bg-red-600 border-red-600 text-white' : 'bg-white border-gray-300 text-gray-500' }}">3</div>
                        <span class="absolute top-12 text-xs font-medium {{ $currentStep >= 3 ? 'text-red-600' : 'text-gray-500' }}">Data Diri</span>
                    </div>
                </div>
            </div>

            {{-- Form Content --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                @if($currentStep == 1)
                    @include('livewire.campaign.step1')
                @elseif($currentStep == 2)
                    @include('livewire.campaign.step2')
                @elseif($currentStep == 3)
                    @include('livewire.campaign.step3')
                @endif
            </div>

        @endif
    </div>
</div>