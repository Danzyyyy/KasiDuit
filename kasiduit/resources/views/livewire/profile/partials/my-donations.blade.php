<div class="animate-fade-in-up">
    <h3 class="text-xl font-bold text-gray-900 mb-6">Riwayat Donasi</h3>
    
    @if(count($myDonations) > 0)
        <div class="space-y-4">
            @foreach($myDonations as $donation)
                <div class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-gray-50 transition">
                    <div class="flex items-center gap-4">
                        <div class="p-3 bg-red-50 text-red-600 rounded-full">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-900">{{ $donation->campaign->title }}</h4>
                            <p class="text-xs text-gray-500">{{ $donation->created_at->format('d M Y, H:i') }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="font-bold text-red-600">Rp {{ number_format($donation->amount, 0, ',', '.') }}</p>
                        <span class="text-xs px-2 py-0.5 bg-green-100 text-green-700 rounded-full font-medium">Berhasil</span>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="text-center py-12 text-gray-500">
            <div class="bg-gray-50 rounded-full w-20 h-20 flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                </svg>
            </div>
            <p>Belum ada riwayat donasi.</p>
            <a href="{{ route('home') }}" class="text-red-600 font-semibold hover:underline mt-2 inline-block">Mulai Berdonasi</a>
        </div>
    @endif
</div>