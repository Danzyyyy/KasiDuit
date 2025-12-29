<div> {{-- SINGLE ROOT ELEMENT --}}
    
    {{-- HEADER SECTION (SAMA DENGAN ABOUT US) --}}
    <section class="relative bg-gray-900 h-[300px] flex items-center justify-center overflow-hidden">
        {{-- Background Image Overlay --}}
        <div class="absolute inset-0 opacity-40">
            <img src="https://cdn.prod.website-files.com/66fa83270953cacf7e26d1b6/673ee645d3a5a5dba9376bd5_apcf-charity-asia-orphanages-indonesia.jpg" 
                 alt="Privacy Policy Background" 
                 class="w-full h-full object-cover object-[center_35%]"> 
        </div>
        
        {{-- Gradient Overlay --}}
        <div class="absolute inset-0 bg-gradient-to-r from-red-900/80 to-gray-900/80"></div>
        
        <div class="relative z-10 text-center max-w-4xl px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Kebijakan Privasi</h1>
            <p class="text-gray-300 text-lg font-medium">
                Home <span class="mx-2 text-red-500">/</span> Kebijakan Privasi
            </p>
            <p class="text-gray-300/80 text-sm mt-2 font-light max-w-2xl mx-auto">
                Komitmen kami untuk melindungi data pribadi dan menjaga kepercayaan Anda.
            </p>
        </div>
    </section>

    <div class="bg-gray-50 pb-20">
        
        {{-- KONTEN KEBIJAKAN PRIVASI --}}
        <section class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 -mt-16 relative z-20 mb-16">
            <div class="bg-white rounded-xl shadow-lg border border-gray-100 p-8 md:p-12">
                
                {{-- Tanggal Update --}}
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-8 border-b border-gray-100 pb-6">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span>Terakhir diperbarui: {{ now()->format('d F Y') }}</span>
                </div>

                {{-- Isi Konten --}}
                <div class="space-y-10 text-gray-600 leading-relaxed text-base">
                    
                    {{-- Poin 1 --}}
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center text-sm font-bold">1</span>
                            Pendahuluan
                        </h3>
                        <p class="pl-11">
                            KasiDuit ("kami") menghormati privasi Anda dan berkomitmen untuk melindungi data pribadi yang Anda bagikan kepada kami. Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, mengungkapkan, dan menjaga keamanan informasi Anda saat menggunakan situs web dan layanan kami.
                        </p>
                    </div>

                    {{-- Poin 2 --}}
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center text-sm font-bold">2</span>
                            Informasi yang Kami Kumpulkan
                        </h3>
                        <div class="pl-11 space-y-3">
                            <p>Kami dapat mengumpulkan informasi berikut dari Anda:</p>
                            <ul class="list-disc pl-5 space-y-2 text-gray-600">
                                <li><strong>Data Identitas:</strong> Nama lengkap, alamat email, nomor telepon, dan foto profil.</li>
                                <li><strong>Data Verifikasi:</strong> KTP/Identitas resmi dan foto selfie dengan KTP (khusus untuk penggalang dana).</li>
                                <li><strong>Data Transaksi:</strong> Rincian pembayaran donasi, riwayat pencairan dana, dan informasi rekening bank.</li>
                                <li><strong>Data Teknis:</strong> Alamat IP, jenis browser, dan data penggunaan perangkat saat mengakses platform kami.</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Poin 3 --}}
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center text-sm font-bold">3</span>
                            Penggunaan Informasi
                        </h3>
                        <div class="pl-11 space-y-3">
                            <p>Informasi yang kami kumpulkan digunakan untuk:</p>
                            <ul class="list-disc pl-5 space-y-2 text-gray-600">
                                <li>Memproses donasi dan pencairan dana secara akurat.</li>
                                <li>Memverifikasi identitas penggalang dana demi keamanan platform.</li>
                                <li>Mengirimkan notifikasi terkait status campaign atau transaksi Anda.</li>
                                <li>Meningkatkan layanan, keamanan, dan pengalaman pengguna di KasiDuit.</li>
                                <li>Mencegah aktivitas penipuan atau penyalahgunaan layanan.</li>
                            </ul>
                        </div>
                    </div>

                    {{-- Poin 4 --}}
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center text-sm font-bold">4</span>
                            Perlindungan Data
                        </h3>
                        <p class="pl-11">
                            Kami menerapkan langkah-langkah keamanan teknis dan organisasi yang sesuai untuk melindungi data pribadi Anda dari akses, penggunaan, atau pengungkapan yang tidak sah. Transaksi pembayaran diproses melalui gateway pembayaran yang aman dan terenkripsi (SSL).
                        </p>
                    </div>

                    {{-- Poin 5 --}}
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center text-sm font-bold">5</span>
                            Berbagi Informasi
                        </h3>
                        <p class="pl-11">
                            Kami tidak menjual atau menyewakan data pribadi Anda kepada pihak ketiga. Kami hanya membagikan informasi jika diwajibkan oleh hukum, atau kepada mitra penyedia layanan (seperti bank atau payment gateway) yang terikat kewajiban kerahasiaan untuk memproses transaksi Anda.
                        </p>
                    </div>

                    {{-- Poin 6 --}}
                    <div>
                        <h3 class="text-xl font-bold text-gray-900 mb-3 flex items-center gap-3">
                            <span class="w-8 h-8 rounded-full bg-red-50 text-red-600 flex items-center justify-center text-sm font-bold">6</span>
                            Hubungi Kami
                        </h3>
                        <p class="pl-11">
                            Jika Anda memiliki pertanyaan mengenai Kebijakan Privasi ini, silakan hubungi kami melalui:
                        </p>
                        <div class="pl-11 mt-4 grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-red-600 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" /></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 font-bold uppercase">Email</p>
                                    <p class="font-bold text-gray-900">support@kasiduit.com</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-3 p-4 bg-gray-50 rounded-xl border border-gray-100">
                                <div class="w-10 h-10 bg-white rounded-full flex items-center justify-center text-red-600 shadow-sm">
                                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                                </div>
                                <div>
                                    <p class="text-xs text-gray-400 font-bold uppercase">Lokasi</p>
                                    <p class="font-bold text-gray-900">Jakarta Selatan, ID</p>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- FOOTER NOTE --}}
        <div class="max-w-4xl mx-auto px-4 text-center">
            <p class="text-gray-400 text-sm">
                Dengan menggunakan layanan KasiDuit, Anda dianggap telah membaca dan menyetujui Kebijakan Privasi ini.
            </p>
        </div>

    </div>

</div>