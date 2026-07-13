<header class="bg-white/95 backdrop-blur-sm shadow-sm sticky top-0 z-50 transition-shadow duration-300"
        x-data="{ 
            mobileOpen: false, 
            isMobile: window.innerWidth < 1024,
            scrolled: false 
        }" 
        @resize.window="isMobile = window.innerWidth < 1024"
        @scroll.window="scrolled = (window.pageYOffset > 20)"
        :class="scrolled ? 'shadow-lg' : 'shadow-sm'">
    
    <nav class="w-full">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 lg:h-[72px]">

                {{-- ============================================ --}}
                {{-- BAGIAN LOGO --}}
                {{-- ============================================ --}}
                <a class="flex items-center gap-2 shrink-0" href="{{ url('/') }}">
                    @php
                        $logoPath = $settings['app_logo'] ?? null;
                        $logoExists = $logoPath && file_exists(public_path('storage/' . $logoPath));
                    @endphp
                    @if($logoExists)
                        <img src="{{ asset('storage/' . $logoPath) }}" alt="PPID IAIN BONE" class="h-12 w-auto">
                    @else
                        <span class="font-bold text-lg text-hijau-700">PPID IAIN BONE</span>
                    @endif
                </a>

                {{-- ============================================ --}}
                {{-- TOMBOL HAMBURGER (Hanya muncul di Mobile) --}}
                {{-- ============================================ --}}
                <button @click="mobileOpen = !mobileOpen" 
                        x-show="isMobile"
                        x-cloak
                        class="p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition"
                        aria-label="Toggle navigation">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>

                {{-- ============================================ --}}
                {{-- MENU UTAMA (Desktop & Mobile) --}}
                {{-- ============================================ --}}
                <div x-show="!isMobile || mobileOpen" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     :class="isMobile ? 'absolute top-16 left-0 right-0 bg-white shadow-lg border-t border-gray-100 p-4 flex flex-col gap-1 z-50 max-h-[85vh] overflow-y-auto' : 'hidden lg:flex lg:items-center lg:gap-1'">

                    {{-- Beranda --}}
                    <a href="{{ url('/') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-hijau-700 hover:bg-hijau-50 transition">
                        Beranda
                    </a>

                    {{-- ======================================== --}}
                    {{-- DROPDOWN: TENTANG KAMI --}}
                    {{-- ======================================== --}}
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" 
                                class="flex items-center justify-between lg:justify-start gap-1 px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-hijau-700 hover:bg-hijau-50 transition w-full lg:w-auto">
                            Tentang Kami
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200" 
                             x-transition:enter-start="opacity-0 scale-95" 
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150" 
                             x-transition:leave-start="opacity-100 scale-100" 
                             x-transition:leave-end="opacity-0 scale-95"
                             :class="isMobile ? 'bg-gray-50 rounded-xl p-3 mt-1 border border-gray-100 space-y-1' : 'lg:absolute lg:left-0 lg:top-full lg:mt-1 lg:w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50'">
                            
                            <a href="{{ route('informasi-publik.profil-ppid.index') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Profil PPID</a>
                            <a href="{{ route('tentang-kami.visi-misi') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Visi & Misi</a>
                            <a href="{{ route('tentang-kami.tugas-fungsi') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Tugas & Fungsi</a>
                            <a href="{{ route('tentang-kami.profil-pejabat') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Profil Pejabat</a>
                            <a href="{{ route('tentang-kami.struktur-organisasi') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Struktur Organisasi</a>
                        </div>
                    </div>

                    {{-- ======================================== --}}
                    {{-- DROPDOWN: INFORMASI PUBLIK (DIPERBAIKI) --}}
                    {{-- ======================================== --}}
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" 
                                class="flex items-center justify-between lg:justify-start gap-1 px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-hijau-700 hover:bg-hijau-50 transition w-full lg:w-auto">
                            Informasi Publik
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" 
                            x-transition:enter="transition ease-out duration-200" 
                            x-transition:enter-start="opacity-0 scale-95" 
                            x-transition:enter-end="opacity-100 scale-100"
                            x-transition:leave="transition ease-in duration-150" 
                            x-transition:leave-start="opacity-100 scale-100" 
                            x-transition:leave-end="opacity-0 scale-95"
                            :class="isMobile ? 'bg-gray-50 rounded-xl p-3 mt-1 border border-gray-100 space-y-1' : 'lg:absolute lg:left-0 lg:top-full lg:mt-1 lg:w-64 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50'">
                            
                            <a href="{{ route('informasi-publik.index') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Daftar Informasi Publik</a>
                            
                            <div class="my-1 border-t border-gray-200"></div>
                            
                            {{-- ✅ DIPERBAIKI: Mengarah ke halaman list + filter kategori --}}
                            <a href="{{ route('informasi-publik.index', ['kategori' => 'informasi-berkala']) }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Informasi Berkala</a>
                            <a href="{{ route('informasi-publik.index', ['kategori' => 'informasi-serta-merta']) }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Informasi Serta Merta</a>
                            <a href="{{ route('informasi-publik.index', ['kategori' => 'informasi-setiap-saat']) }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Informasi Setiap Saat</a>
                            <a href="{{ route('informasi-publik.index', ['kategori' => 'informasi-dikecualikan']) }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Informasi Dikecualikan</a>
                            <a href="{{ route('informasi-publik.index', ['kategori' => 'barang-dan-jasa']) }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Barang dan Jasa</a>
                            
                            <div class="my-1 border-t border-gray-200"></div>
                            
                            <a href="{{ route('publikasi.index') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Dokumen</a>
                        </div>
                    </div>

                    {{-- ======================================== --}}
                    {{-- DROPDOWN: MEDIA CENTER --}}
                    {{-- ======================================== --}}
                    {{-- <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" 
                                class="flex items-center justify-between lg:justify-start gap-1 px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-hijau-700 hover:bg-hijau-50 transition w-full lg:w-auto">
                            Media Center
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200" 
                             x-transition:enter-start="opacity-0 scale-95" 
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150" 
                             x-transition:leave-start="opacity-100 scale-100" 
                             x-transition:leave-end="opacity-0 scale-95"
                             :class="isMobile ? 'bg-gray-50 rounded-xl p-3 mt-1 border border-gray-100 space-y-1' : 'lg:absolute lg:left-0 lg:top-full lg:mt-1 lg:w-52 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50'">
                            <a href="{{ route('publikasi.index') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Dokumen</a>
                            <a href="{{ route('berita.index') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Berita</a>
                            <a href="{{ route('galeri.index') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Galeri</a>
                        </div>
                    </div> --}}
                    <a href="{{ route('berita.index') }}"  
                       class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-hijau-700 hover:bg-hijau-50 transition">
                        Berita
                    </a>
                    {{-- ======================================== --}}
                    {{-- DROPDOWN: LAYANAN --}}
                    {{-- ======================================== --}}
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" 
                                class="flex items-center justify-between lg:justify-start gap-1 px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-hijau-700 hover:bg-hijau-50 transition w-full lg:w-auto">
                            Layanan
                            <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <div x-show="open" 
                             x-transition:enter="transition ease-out duration-200" 
                             x-transition:enter-start="opacity-0 scale-95" 
                             x-transition:enter-end="opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-150" 
                             x-transition:leave-start="opacity-100 scale-100" 
                             x-transition:leave-end="opacity-0 scale-95"
                             :class="isMobile ? 'bg-gray-50 rounded-xl p-3 mt-1 border border-gray-100 space-y-1' : 'lg:absolute lg:left-0 lg:top-full lg:mt-1 lg:w-72 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50'">
                            
                            <p class="px-3 py-1 text-xs font-bold text-hijau-800 uppercase tracking-wider">Layanan Informasi</p>
                            
                            <a href="{{ route('informasi-publik.permohonan.prosedur') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Alur Permohonan Informasi</a>
                            <a href="{{ route('informasi-publik.permohonan.form') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Formulir Permohonan Informasi</a>
                            
                            <div class="my-1 border-t border-gray-200"></div>
                            
                            <p class="px-3 py-1 text-xs font-bold text-hijau-800 uppercase tracking-wider">Pengajuan Keberatan</p>
                            
                            <a href="{{ route('informasi-publik.keberatan.prosedur') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Alur Pengajuan Keberatan</a>
                            <a href="{{ route('informasi-publik.keberatan.form') }}" class="block px-3 py-2 text-sm text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 rounded-lg transition">Formulir Pengajuan Keberatan</a>
                        </div>
                    </div>

                    {{-- Laporan & Statistik --}}
                    <a href="{{ route('informasi-publik.laporan-statistik') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-hijau-700 hover:bg-hijau-50 transition">
                        Laporan & Statistik
                    </a>

                    <a href="#" 
                       class="px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:text-hijau-700 hover:bg-hijau-50 transition">
                        PPID Pelaksana
                    </a>

                    {{-- PEMISAH (Mobile) --}}
                    <div class="lg:hidden my-2 border-t border-gray-200"></div>

                    {{-- ======================================== --}}
                    {{-- LOGIKA USER (Auth/Guest) --}}
                    {{-- ======================================== --}}
                    @auth
                        <div class="relative" x-data="{ open: false }" @click.away="open = false">
                            <button @click="open = !open" 
                                    class="flex items-center justify-between lg:justify-start gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition w-full lg:w-auto">
                                <div class="flex items-center gap-2">
                                    <i class="bi bi-person-circle text-lg"></i>
                                    <span>{{ Auth::user()->name }}</span>
                                </div>
                                <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-200" 
                                 x-transition:enter-start="opacity-0 scale-95" 
                                 x-transition:enter-end="opacity-100 scale-100"
                                 x-transition:leave="transition ease-in duration-150" 
                                 x-transition:leave-start="opacity-100 scale-100" 
                                 x-transition:leave-end="opacity-0 scale-95"
                                 :class="isMobile ? 'bg-gray-50 rounded-xl p-3 mt-1 border border-gray-100 space-y-1' : 'lg:absolute lg:right-0 lg:top-full lg:mt-1 lg:w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50'">
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition">
                                    <i class="bi bi-speedometer2"></i>Dasbor Saya
                                </a>
                                <a href="{{ route('profile.edit.public') }}" class="flex items-center gap-2 px-3 py-2 text-sm text-gray-700 hover:bg-gray-100 rounded-lg transition">
                                    <i class="bi bi-pencil"></i>Edit Profil
                                </a>
                                <div class="my-1 border-t border-gray-200"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="flex items-center gap-2 w-full text-left px-3 py-2 text-sm text-red-600 hover:bg-red-50 rounded-lg transition">
                                        <i class="bi bi-box-arrow-right"></i>Keluar
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <div class="lg:hidden flex flex-col gap-2">
                            <a href="{{ route('login') }}" 
                               class="block text-center px-4 py-2.5 rounded-lg text-sm font-medium border border-hijau-600 text-hijau-700 hover:bg-hijau-50 transition">
                                Masuk
                            </a>
                            <a href="{{ route('register') }}" 
                               class="block text-center px-4 py-2.5 rounded-lg text-sm font-medium bg-hijau-600 text-white hover:bg-hijau-700 transition">
                                Daftar
                            </a>
                        </div>
                        
                        {{-- Tombol Login Desktop --}}
                        <a href="{{ route('login') }}" 
                           class="hidden lg:flex items-center gap-2 ml-2 px-4 py-2 rounded-lg text-sm font-medium border border-hijau-600 text-hijau-700 hover:bg-hijau-50 transition">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    @endguest

                </div>

            </div>
        </div>
    </nav>
</header>