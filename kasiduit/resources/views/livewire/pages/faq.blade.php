<div>
    {{-- DATA FAQ --}}
    @php
        $faqs = [
            'umum' => [
                ['q' => 'Apa itu KasiDuit?', 'a' => 'KasiDuit adalah platform penggalangan dana online (crowdfunding) yang memfasilitasi individu, komunitas, dan organisasi untuk menggalang dana bagi berbagai tujuan sosial, kesehatan, pendidikan, bencana alam, dan lainnya secara transparan dan aman.'],
                ['q' => 'Apakah KasiDuit aman dan terpercaya?', 'a' => 'Ya, KasiDuit berkomitmen menjaga keamanan data dan transaksi pengguna. Kami menggunakan enkripsi SSL untuk setiap transaksi dan melakukan verifikasi ketat terhadap setiap penggalang dana.'],
                ['q' => 'Apakah ada biaya administrasi?', 'a' => 'KasiDuit mengenakan biaya administrasi sebesar 5% dari total donasi terkumpul untuk operasional platform.']
            ],
            'donasi' => [
                ['q' => 'Bagaimana cara berdonasi?', 'a' => 'Pilih campaign yang ingin Anda bantu, klik tombol "Donasi Sekarang", masukkan nominal donasi, pilih metode pembayaran, dan selesaikan pembayaran sesuai instruksi.'],
                ['q' => 'Apakah bisa berdonasi tanpa login?', 'a' => 'Saat ini, untuk berdonasi Anda perlu membuat akun dan login terlebih dahulu demi keamanan dan kemudahan pelacakan donasi Anda.'],
                ['q' => 'Apa saja metode pembayaran yang tersedia?', 'a' => 'Kami mendukung berbagai metode pembayaran, termasuk transfer bank, e-wallet (OVO, GoPay, Dana), dan kartu kredit.'],
                ['q' => 'Bagaimana jika salah transfer?', 'a' => 'Hubungi support@kasiduit.my.id dengan bukti transfer untuk bantuan verifikasi manual.']
            ],
            'galang_dana' => [
                ['q' => 'Bagaimana cara membuat campaign?', 'a' => 'Klik menu "Galang Dana", login, isi formulir detail campaign, upload foto pendukung, dan lakukan verifikasi identitas (KTP).'],
                ['q' => 'Berapa lama batas waktu campaign?', 'a' => 'Bebas, mulai dari 30 hari hingga 90 hari. Dana tetap bisa dicairkan meski target tidak tercapai (sistem donasi fleksibel).']
            ],
            'akun' => [
                ['q' => 'Bagaimana cara mereset password?', 'a' => 'Klik "Lupa Password" di halaman login, masukkan email, dan ikuti instruksi di email Anda.'],
                ['q' => 'Apakah data saya aman?', 'a' => 'Sangat aman. Kami tidak membagikan data pribadi kepada pihak ketiga tanpa izin.']
            ],
        ];
        
        $categories = [
            'umum' => 'Umum',
            'donasi' => 'Donasi',
            'galang_dana' => 'Galang Dana',
            'akun' => 'Akun & Keamanan',
        ];
    @endphp

    {{-- HERO HEADER (SAMA PERSIS DENGAN TENTANG KAMI) --}}
    <section class="relative bg-gray-900 h-[300px] flex items-center justify-center overflow-hidden">
        {{-- Background Image Overlay --}}
        <div class="absolute inset-0 opacity-40">
            {{-- Menggunakan gambar yang sama agar konsisten, dengan posisi di tengah agak bawah --}}
            <img src="https://theprakarsa.org/wp-content/uploads/2024/11/antarafoto-peningkatan-jumlah-warga-miskin-jakarta-160721-app-15_ratio-16x9-1.jpg" 
                 alt="FAQ Background" 
                 class="w-full h-full object-cover object-[center_35%]"> 
        </div>
        
        {{-- Gradient Overlay (Merah ke Abu Gelap) --}}
        <div class="absolute inset-0 bg-gradient-to-r from-red-900/80 to-gray-900/80"></div>
        
        <div class="relative z-10 text-center max-w-4xl px-4">
            <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">Frequently Asked Question</h1>
            <p class="text-gray-300 text-lg font-medium">
                Home <span class="mx-2 text-red-500">/</span> FAQ
            </p>
        </div>
    </section>

    {{-- CONTENT SECTION --}}
    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 bg-gray-50 min-h-screen" 
             x-data="{ activeCategory: 'umum', activeQuestion: null }">
        
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
            
            {{-- SIDEBAR KIRI --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden sticky top-24">
                    <div class="p-4 bg-white border-b border-gray-100 font-bold text-gray-900 text-lg">
                        Kategori Bantuan
                    </div>
                    <nav class="flex flex-col py-2">
                        @foreach($categories as $key => $label)
                        <button 
                            @click="activeCategory = '{{ $key }}'; activeQuestion = null" 
                            :class="activeCategory === '{{ $key }}' ? 'text-red-600 bg-red-50 border-red-600 font-bold' : 'text-gray-600 hover:bg-gray-50 hover:text-red-600 border-transparent hover:border-red-100 font-medium'"
                            class="px-4 py-3 text-sm text-left border-l-4 transition w-full focus:outline-none">
                            {{ $label }}
                        </button>
                        @endforeach
                    </nav>
                </div>
            </div>

            {{-- KONTEN KANAN (ACCORDION) --}}
            <div class="lg:col-span-3 space-y-4">
                
                {{-- Loop Render Kategori --}}
                @foreach($faqs as $category => $items)
                <div x-show="activeCategory === '{{ $category }}'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     style="display: none;">
                    
                    <h2 class="text-2xl font-bold text-gray-900 mb-6 capitalize">
                        {{ $categories[$category] }}
                    </h2>
                    
                    {{-- Loop Item Pertanyaan --}}
                    @foreach($items as $index => $item)
                    @php $uniqueId = $category . '_' . $index; @endphp

                    <div class="bg-white border border-gray-200 rounded-xl overflow-hidden transition-all duration-300 mb-4" 
                         :class="activeQuestion === '{{ $uniqueId }}' ? 'shadow-md border-red-200 ring-1 ring-red-50' : 'shadow-sm hover:border-red-100'">
                        
                        <button @click="activeQuestion === '{{ $uniqueId }}' ? activeQuestion = null : activeQuestion = '{{ $uniqueId }}'" 
                                class="w-full flex justify-between items-center px-6 py-5 text-left focus:outline-none bg-white hover:bg-gray-50 transition">
                            
                            <span class="font-bold text-gray-800 text-base" 
                                  :class="activeQuestion === '{{ $uniqueId }}' ? 'text-red-600' : ''">
                                {{ $item['q'] }}
                            </span>
                            
                            <span class="ml-4 flex-shrink-0 text-red-600 bg-red-50 p-1 rounded-full transition-transform duration-300"
                                  :class="activeQuestion === '{{ $uniqueId }}' ? 'rotate-180 bg-red-100' : ''">
                                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </span>
                        </button>

                        <div x-show="activeQuestion === '{{ $uniqueId }}'" x-collapse>
                            <div class="px-6 pb-6 text-gray-600 text-sm leading-relaxed border-t border-gray-100 pt-4 bg-gray-50/30">
                                {{ $item['a'] }}
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
                @endforeach

            </div>
        </div>
    </section>
</div>