<footer class="w-full bg-gray-900 text-gray-300 pt-12 pb-28 md:py-12 border-t border-gray-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Grid Layout: Center di HP, Kiri di Desktop --}}
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8 text-center md:text-left">
            
            {{-- BRAND SECTION --}}
            <div class="col-span-1 md:col-span-1 flex flex-col items-center md:items-start">
                <div class="flex items-center gap-3 mb-4">
                    <img src="https://i.ibb.co.com/VpL5Nk6j/Desain-tanpa-judul-20.png" 
                         alt="KasiDuit Logo" 
                         class="w-10 h-10 rounded-full border-2 border-white/20 p-0.5 object-cover">
                    <span class="text-xl font-bold text-white">KasiDuit</span>
                </div>
                <p class="text-sm text-gray-400 mb-4 leading-relaxed max-w-xs mx-auto md:mx-0">
                    Sedikit dari kita, besar untuk mereka. Platform donasi karya anak bangsa.
                </p>
            </div>
            
            {{-- TAUTAN CEPAT --}}
            <div>
                <h4 class="text-white font-bold text-lg mb-4">Tautan Cepat</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('campaigns.index') }}" class="hover:text-red-500 transition">Donasi Sekarang</a></li>
                    <li><a href="{{ route('campaigns.create') }}" class="hover:text-red-500 transition">Galang Dana</a></li>
                    <li><a href="{{ route('campaigns.index') }}" class="hover:text-red-500 transition">Campaign Populer</a></li>
                </ul>
            </div>

            {{-- INFORMASI --}}
            <div>
                <h4 class="text-white font-bold text-lg mb-4">Informasi</h4>
                <ul class="space-y-3 text-sm">
                    <li><a href="{{ route('about') }}" class="hover:text-red-500 transition">Tentang Kami</a></li>
                    <li><a href="{{ route('faq') }}" class="hover:text-red-500 transition">FAQ</a></li>
                    <li><a href="{{ route('privacy-policy') }}" class="hover:text-red-500 transition">Kebijakan Privasi</a></li>
                    <li><a href="{{ route('contact') }}" class="hover:text-red-500 transition">Kontak Kami</a></li>
                </ul>
            </div>

            {{-- KONTAK --}}
            <div class="flex flex-col items-center md:items-start">
                <h4 class="text-white font-bold text-lg mb-4">Hubungi Kami</h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-center gap-2 justify-center md:justify-start">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        <a href="mailto:support@kasiduit.my.id" class="hover:text-white transition">support@kasiduit.my.id</a>
                    </li>
                    <li class="flex items-center gap-2 justify-center md:justify-start">
                        <svg class="w-5 h-5 text-red-600 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        <span>Bandung, Indonesia</span>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="border-t border-gray-800 pt-8 text-center">
            <p class="text-xs text-gray-500">
                &copy; {{ date('Y') }} KasiDuit. All rights reserved.
            </p>
        </div>
    </div>
</footer>