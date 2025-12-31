<div>
    {{-- Flash Message --}}
    @if (session()->has('message'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 text-green-700 rounded-xl flex items-center gap-3 animate-fade-in-up shadow-sm">
            <div class="bg-green-100 p-1 rounded-full">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <span class="font-medium">{{ session('message') }}</span>
        </div>
    @endif

    {{-- LOGIKA TOGGLE TAMPILAN --}}
    @if($showForm)
        @include('livewire.admin.campaign.form')
        
    @elseif($showDetail)
        @include('livewire.admin.campaign.detail')

    @else
        @include('livewire.admin.campaign.table')
    @endif
</div>