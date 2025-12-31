@props(['stats'])

<section class="relative bg-gray-900 h-[600px] flex items-center">
    <div class="absolute inset-0 overflow-hidden">
        <img src="https://images.unsplash.com/photo-1488521787991-ed7bbaae773c?ixlib=rb-1.2.1&auto=format&fit=crop&w=1950&q=80" alt="Hero Background" class="w-full h-full object-cover">
    </div>
    
    <div class="absolute inset-0 bg-gradient-to-r from-brand-red/95 via-brand-red/80 to-transparent"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full pt-10">
        <div class="max-w-2xl">
            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-tight mb-6">
                Berbagi Kebaikan, <br/>Wujudkan Harapan.
            </h1>
            <p class="text-lg md:text-xl text-red-50 mb-8 font-light leading-relaxed">
                Platform crowdfunding terpercaya untuk membantu sesama secara cepat, aman, dan transparan. #OrangBaik
            </p>
            
            <div class="flex flex-col sm:flex-row gap-4 mb-12">
                <a href="{{ route('campaigns.index', 1) }}" class="bg-white text-brand-red px-8 py-3.5 rounded-full font-bold shadow-lg hover:bg-gray-100 transition text-center">
                    Donasi Sekarang
                </a>

                <a href="{{ route('campaigns.create') }}" class="bg-red-800/40 backdrop-blur-sm border border-white/20 text-white px-8 py-3.5 rounded-full font-bold hover:bg-red-800/60 transition text-center">
                    Galang Dana
                </a>
            </div>

            <div class="flex gap-8 border-t border-white/20 pt-8">
                @foreach($stats as $stat)
                <div>
                    <div class="text-2xl font-bold text-white">{{ $stat['value'] }}</div>
                    <div class="text-sm text-red-100">{{ $stat['label'] }}</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</section>