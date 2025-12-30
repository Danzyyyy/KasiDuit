<div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 sticky top-24">
    <img src="{{ Str::startsWith($campaign->image_path, 'http') ? $campaign->image_path : asset('storage/'.$campaign->image_path) }}" 
        class="w-full h-40 object-cover rounded-xl mb-4">
    <h3 class="text-gray-900 font-bold leading-snug mb-1">{{ $campaign->title }}</h3>
    <div class="border-t border-gray-100 pt-4 mt-4">
        <p class="text-xs text-gray-500 mb-1">Total yang akan dibayar</p>
        <p class="text-xl font-bold text-red-600">
            Rp {{ number_format($nominal + ($step == 4 ? $adminFee : 0), 0, ',', '.') }}
        </p>
    </div>
</div>