<nav class="bg-white border-b border-gray-200 sticky top-0 z-40"
     x-data="{ mobileOpen: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            
            {{-- ============================================ --}}
            {{-- KIRI: Logo + Menu Desktop --}}
            {{-- ============================================ --}}
            <div class="flex">
                {{-- Logo --}}
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2">
                        @php
                            $logoPath = $settings['app_logo'] ?? null;
                            $logoExists = $logoPath && file_exists(public_path('storage/' . $logoPath));
                        @endphp
                        @if($logoExists)
                            <img src="{{ asset('storage/' . $logoPath) }}" alt="PPID Admin" class="h-8 w-auto">
                        @else
                            <span class="font-bold text-lg text-gray-800">PPID <span class="text-hijau-600">Admin</span></span>
                        @endif
                    </a>
                </div>

                {{-- Desktop Menu --}}
                <div class="hidden lg:flex lg:items-center lg:gap-1 lg:ml-8">
                    
                    {{-- Dashboard --}}
                    <a href="{{ route('dashboard') }}" 
                       class="px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200 
                              {{ request()->routeIs('dashboard') ? 'bg-hijau-50 text-hijau-700' : 'text-gray-600 hover:text-gray-900 hover:bg-gray-50' }}">
                        Dashboard
                    </a>

                    {{-- DROPDOWN: Pengaturan (Super Admin) --}}
                    @if(Auth::user()->role === 'super_admin')
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" 
                                class="flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200">
                            Pengaturan
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95"
                             class="absolute left-0 top-full mt-1 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <p class="px-4 py-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Sistem</p>
                            <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Manajemen Pengguna</a>
                            <a href="{{ route('admin.settings.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Pengaturan Global Web</a>
                            <a href="{{ route('admin.activity-log.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Activity Log</a>
                            <div class="my-1 border-t border-gray-100"></div>
                            <a href="{{ route('admin.static-pages.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Halaman Statis</a>
                        </div>
                    </div>
                    @endif

                    {{-- DROPDOWN: Media Center (Super Admin & Editor) --}}
                    @if(in_array(Auth::user()->role, ['super_admin', 'editor']))
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" 
                                class="flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200">
                            Media Center
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition (samakan seperti di atas) class="absolute left-0 top-full mt-1 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <p class="px-4 py-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Berita</p>
                            @if(Auth::user()->role === 'super_admin')
                            <a href="{{ route('admin.categories.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Kategori Berita</a>
                            @endif
                            <a href="{{ route('admin.posts.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Berita</a>
                            <a href="{{ route('admin.comments.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Moderasi Komentar</a>
                            
                            @if(Auth::user()->role === 'super_admin')
                            <div class="my-1 border-t border-gray-100"></div>
                            <p class="px-4 py-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Lainnya</p>
                            <a href="{{ route('admin.dokumen-categories.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Kategori Dokumen</a>
                            <a href="{{ route('admin.dokumen.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Dokumen</a>
                            <a href="{{ route('admin.albums.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Album Foto</a>
                            <a href="{{ route('admin.videos.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Video</a>
                            @endif
                        </div>
                    </div>
                    @endif

                    {{-- DROPDOWN: PPID (Super Admin & PPID Admin) --}}
                    @if(in_array(Auth::user()->role, ['super_admin', 'ppid_admin']))
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" 
                                class="flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200">
                            PPID
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition class="absolute left-0 top-full mt-1 w-60 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <p class="px-4 py-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Informasi Publik</p>
                            <a href="{{ route('admin.informasi-publik-categories.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Kategori Info Publik</a>
                            <a href="{{ route('admin.informasi-publik.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Informasi Publik</a>
                            <div class="my-1 border-t border-gray-100"></div>
                            <p class="px-4 py-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Permohonan & Keberatan</p>
                            <a href="{{ route('admin.permohonan.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Permohonan Informasi</a>
                            <a href="{{ route('admin.keberatan.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Pengajuan Keberatan</a>
                        </div>
                    </div>
                    @endif

                    {{-- DROPDOWN: OPD (Super Admin) --}}
                    @if(Auth::user()->role === 'super_admin')
                    <div class="relative" x-data="{ open: false }" @click.away="open = false">
                        <button @click="open = !open" 
                                class="flex items-center gap-1 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:text-gray-900 hover:bg-gray-50 transition-colors duration-200">
                            Struktur Organisasi
                            <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                        </button>
                        <div x-show="open" x-transition class="absolute left-0 top-full mt-1 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                            <a href="{{ route('admin.pejabat.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Manajemen Pejabat</a>
                            <a href="{{ route('admin.bidang.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Manajemen Bidang</a>
                            <div class="my-1 border-t border-gray-100"></div>
                            <p class="px-4 py-1 text-xs font-semibold text-gray-400 uppercase tracking-wider">Kinerja</p>
                            <a href="{{ route('admin.sasaran-strategis.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Sasaran Strategis</a>
                            <a href="{{ route('admin.indikator-kinerja.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Indikator Kinerja</a>
                            <a href="{{ route('admin.kinerja.index') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">Capaian Kinerja</a>
                        </div>
                    </div>
                    @endif

                </div>
            </div>

            {{-- ============================================ --}}
            {{-- KANAN: Profil User & Hamburger --}}
            {{-- ============================================ --}}
            <div class="flex items-center gap-2">
                
                {{-- Dropdown Profil (Desktop) --}}
                <div class="hidden lg:relative lg:block" x-data="{ open: false }" @click.away="open = false">
                    <button @click="open = !open" 
                            class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium text-gray-600 hover:bg-gray-50 transition">
                        <div class="w-8 h-8 rounded-full bg-hijau-100 text-hijau-700 flex items-center justify-center font-bold text-xs">
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        </div>
                        <span class="hidden xl:inline">{{ Auth::user()->name }}</span>
                        <svg class="w-4 h-4 transition-transform" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    
                    <div x-show="open" x-transition class="absolute right-0 top-full mt-1 w-48 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-50">
                        <div class="px-4 py-2 border-b border-gray-100">
                            <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                            <p class="text-xs text-gray-500">{{ Auth::user()->email }}</p>
                        </div>
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-2 px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition">
                            <i class="bi bi-gear text-gray-400"></i> Profil
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition">
                                <i class="bi bi-box-arrow-right"></i> Keluar
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Tombol Hamburger (Mobile) --}}
                <button @click="mobileOpen = !mobileOpen" class="lg:hidden p-2 rounded-lg text-gray-500 hover:bg-gray-100 transition">
                    <svg x-show="!mobileOpen" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                    <svg x-show="mobileOpen" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- MENU MOBILE (RESPONSIF) --}}
    {{-- ============================================ --}}
    <div x-show="mobileOpen" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 -translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-cloak
         class="lg:hidden bg-white border-t border-gray-200 max-h-[80vh] overflow-y-auto">
        
        <div class="p-4 space-y-4">
            
            {{-- Info User Mobile --}}
            <div class="flex items-center gap-3 p-3 bg-gray-50 rounded-xl mb-4">
                <div class="w-10 h-10 rounded-full bg-hijau-100 text-hijau-700 flex items-center justify-center font-bold">
                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                </div>
                <div>
                    <p class="text-sm font-semibold text-gray-800">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-gray-500">{{ Auth::user()->role }}</p>
                </div>
            </div>

            <a href="{{ route('dashboard') }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-hijau-50 hover:text-hijau-700 transition">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="block px-3 py-2.5 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-50 transition">Profil Saya</a>

            @if(Auth::user()->role === 'super_admin')
            <div class="pt-2 border-t border-gray-100">
                <p class="px-3 py-1 text-xs font-bold text-gray-400 uppercase">Pengaturan</p>
                <a href="{{ route('admin.users.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Manajemen Pengguna</a>
                <a href="{{ route('admin.settings.edit') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Pengaturan Global Web</a>
                <a href="{{ route('admin.activity-log.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Activity Log</a>
                <a href="{{ route('admin.static-pages.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Halaman Statis</a>
            </div>
            @endif

            @if(in_array(Auth::user()->role, ['super_admin', 'editor']))
            <div class="pt-2 border-t border-gray-100">
                <p class="px-3 py-1 text-xs font-bold text-gray-400 uppercase">Media Center</p>
                @if(Auth::user()->role === 'super_admin')
                <a href="{{ route('admin.categories.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Kategori Berita</a>
                @endif
                <a href="{{ route('admin.posts.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Berita</a>
                <a href="{{ route('admin.comments.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Moderasi Komentar</a>
                @if(Auth::user()->role === 'super_admin')
                <a href="{{ route('admin.dokumen-categories.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Kategori Dokumen</a>
                <a href="{{ route('admin.dokumen.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Dokumen</a>
                <a href="{{ route('admin.albums.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Album Foto</a>
                <a href="{{ route('admin.videos.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Video</a>
                @endif
            </div>
            @endif

            @if(in_array(Auth::user()->role, ['super_admin', 'ppid_admin']))
            <div class="pt-2 border-t border-gray-100">
                <p class="px-3 py-1 text-xs font-bold text-gray-400 uppercase">PPID</p>
                <a href="{{ route('admin.informasi-publik-categories.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Kategori Info Publik</a>
                <a href="{{ route('admin.informasi-publik.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Informasi Publik</a>
                <a href="{{ route('admin.permohonan.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Permohonan Informasi</a>
                <a href="{{ route('admin.keberatan.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Pengajuan Keberatan</a>
            </div>
            @endif

            @if(Auth::user()->role === 'super_admin')
            <div class="pt-2 border-t border-gray-100">
                <p class="px-3 py-1 text-xs font-bold text-gray-400 uppercase">OPD</p>
                <a href="{{ route('admin.pejabat.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Manajemen Pejabat</a>
                <a href="{{ route('admin.bidang.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Manajemen Bidang</a>
                <a href="{{ route('admin.sasaran-strategis.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Sasaran Strategis</a>
                <a href="{{ route('admin.indikator-kinerja.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Indikator Kinerja</a>
                <a href="{{ route('admin.kinerja.index') }}" class="block px-3 py-2.5 rounded-lg text-sm text-gray-700 hover:bg-gray-50 transition">Capaian Kinerja</a>
            </div>
            @endif

            <div class="pt-2 border-t border-gray-100">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left flex items-center gap-2 px-3 py-2.5 rounded-lg text-sm font-medium text-red-600 hover:bg-red-50 transition">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </div>

        </div>
    </div>
</nav>