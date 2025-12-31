<div> {{-- 1. INI ADALAH SINGLE ROOT ELEMENT WAJIB --}}
    
    {{-- HEADER SECTION (DISESUAIKAN DENGAN DESIGN FAQ) --}}
    <section class="relative bg-gray-900 h-[300px] flex items-center justify-center overflow-hidden">
        {{-- Background Image Overlay --}}
        <div class="absolute inset-0 opacity-40">
            {{-- Menggunakan gambar tim/kantor yang elegan --}}
            {{-- object-[center_30%] akan memposisikan gambar sedikit lebih ke bawah dari tengah --}}
            <img src="https://cdn.prod.website-files.com/66fa83270953cacf7e26d1b6/673ee645d3a5a5dba9376bd5_apcf-charity-asia-orphanages-indonesia.jpg" 
                 alt="About Background" 
                 class="w-full h-full object-cover object-[center_35%]"> 
        </div>
        
        {{-- Gradient Overlay (Sama persis dengan FAQ: Merah ke Abu Gelap) --}}
        <div class="absolute inset-0 bg-gradient-to-r from-red-900/80 to-gray-900/80"></div>
        
        <div class="relative z-10 text-center max-w-4xl px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Tentang KasiDuit</h1>
            <p class="text-gray-300 text-lg font-medium">
                Home <span class="mx-2 text-red-500">/</span> Tentang Kami
            </p>
            <p class="text-gray-300/80 text-sm mt-2 font-light max-w-2xl mx-auto">
                Platform crowdfunding terpercaya untuk membantu sesama secara cepat, aman, dan transparan. #OrangBaik
            </p>
        </div>
    </section>

    <div class="bg-gray-50 pb-20">
        
        {{-- MISI KAMI --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 mb-16">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8 md:p-12 max-w-4xl mx-auto">
                <h2 class="text-2xl font-bold text-gray-900 mb-6 border-b border-gray-100 pb-4">Misi Kami</h2>
                <div class="space-y-4 text-gray-600 leading-relaxed text-base">
                    <p>
                        KasiDuit adalah platform penggalangan dana online yang berdedikasi untuk memfasilitasi aksi kebaikan dan solidaritas di Indonesia. Kami percaya bahwa setiap orang memiliki potensi untuk membuat perubahan positif dalam kehidupan orang lain.
                    </p>
                    <p>
                        Dengan teknologi yang mudah digunakan dan proses yang transparan, kami menghubungkan donatur dengan mereka yang membutuhkan bantuan, menciptakan dampak nyata bagi masyarakat Indonesia.
                    </p>
                </div>
            </div>
        </section>

        {{-- VALUE KAMI --}}
        <section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 mb-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                {{-- Card 1 --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-red-50 rounded-lg flex items-center justify-center text-red-600 mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Empati</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Memahami kesulitan dengan hati dan berkomitmen memberikan bantuan penuh kepedulian.
                    </p>
                </div>
                
                {{-- Card 2 --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-blue-50 rounded-lg flex items-center justify-center text-blue-600 mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Transparansi</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Setiap transaksi tercatat jelas dan laporan dana diberikan secara berkala demi kepercayaan.
                    </p>
                </div>

                {{-- Card 3 --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-green-50 rounded-lg flex items-center justify-center text-green-600 mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Kolaborasi</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Percaya pada kekuatan gotong royong untuk memperluas dampak kebaikan bagi sesama.
                    </p>
                </div>

                {{-- Card 4 --}}
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition duration-300 hover:-translate-y-1">
                    <div class="w-12 h-12 bg-purple-50 rounded-lg flex items-center justify-center text-purple-600 mb-4">
                        <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138z" /></svg>
                    </div>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Integritas</h3>
                    <p class="text-gray-500 text-sm leading-relaxed">
                        Menjunjung tinggi kejujuran dan tanggung jawab penuh dalam setiap aspek layanan.
                    </p>
                </div>
            </div>
        </section>

        {{-- DAMPAK KAMI --}}
        <section class="bg-white border-y border-gray-100 py-16 mb-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
                <h2 class="text-gray-900 font-bold mb-12 uppercase tracking-wider text-sm">Dampak Kebaikan Kita</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 divide-y md:divide-y-0 md:divide-x divide-gray-100">
                    <div class="py-4">
                        <div class="text-4xl md:text-5xl font-extrabold text-red-600 mb-2">12,000+</div>
                        <div class="text-gray-500 font-medium">Campaign Berhasil</div>
                    </div>
                    <div class="py-4">
                        <div class="text-4xl md:text-5xl font-extrabold text-red-600 mb-2">500k+</div>
                        <div class="text-gray-500 font-medium">Donatur Aktif</div>
                    </div>
                    <div class="py-4">
                        <div class="text-4xl md:text-5xl font-extrabold text-red-600 mb-2">Rp 50M+</div>
                        <div class="text-gray-500 font-medium">Dana Tersalurkan</div>
                    </div>
                </div>
            </div>
        </section>

        {{-- TIM KAMI --}}
        <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Tim Kami</h2>
            <p class="text-gray-500 mb-12">Orang-orang di balik KasiDuit</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 justify-center">
                
                {{-- Anggota 1 --}}
                <div class="bg-white rounded-xl border border-gray-100 p-8 hover:shadow-lg transition duration-300 flex flex-col items-center group">
                    <div class="w-24 h-24 rounded-full overflow-hidden shadow-sm border-2 border-gray-50 mb-4 group-hover:scale-105 transition duration-300">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" 
                             alt="Tubagus" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Tubagus</h3>
                    <p class="text-xs text-indigo-600 font-bold uppercase tracking-wide mt-1">Project Manager</p>
                </div>

                {{-- Anggota 2 --}}
                <div class="bg-white rounded-xl border border-gray-100 p-8 hover:shadow-lg transition duration-300 flex flex-col items-center group">
                    <div class="w-24 h-24 rounded-full overflow-hidden shadow-sm border-2 border-gray-50 mb-4 group-hover:scale-105 transition duration-300">
                        <img src="https://i.ibb.co.com/q3crJWGC/Whats-App-Image-2025-12-26-at-18-18-16.jpg" 
                             alt="Valdric" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Valdric</h3>
                    <p class="text-xs text-pink-600 font-bold uppercase tracking-wide mt-1">Frontend Developer</p>
                </div>

                {{-- Anggota 3 --}}
                <div class="bg-white rounded-xl border border-gray-100 p-8 hover:shadow-lg transition duration-300 flex flex-col items-center group">
                    <div class="w-24 h-24 rounded-full overflow-hidden shadow-sm border-2 border-gray-50 mb-4 group-hover:scale-105 transition duration-300">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2.25&w=256&h=256&q=80" 
                             alt="Akbar" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Akbar</h3>
                    <p class="text-xs text-blue-600 font-bold uppercase tracking-wide mt-1">Backend Developer</p>
                </div>

                {{-- Anggota 4 --}}
                <div class="bg-white rounded-xl border border-gray-100 p-8 hover:shadow-lg transition duration-300 flex flex-col items-center group">
                    <div class="w-24 h-24 rounded-full overflow-hidden shadow-sm border-2 border-gray-50 mb-4 group-hover:scale-105 transition duration-300">
                        <img src="https://images.unsplash.com/photo-1519345182560-3f2917c472ef?ixlib=rb-1.2.1&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" 
                             alt="Zeina" class="w-full h-full object-cover">
                    </div>
                    <h3 class="text-lg font-bold text-gray-900">Zeina</h3>
                    <p class="text-xs text-green-600 font-bold uppercase tracking-wide mt-1">Frontend Developer</p>
                </div>

            </div>
        </section>

    </div>

</div>