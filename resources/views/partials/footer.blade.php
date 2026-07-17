<footer class="relative bg-gradient-to-b from-hijau-900 to-gray-900 text-white pt-16 pb-8 border-t border-hijau-800 overflow-hidden">
    
    {{-- Dekorasi Background Belakang --}}
    <div class="absolute top-0 left-0 w-96 h-96 bg-hijau-600/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-hijau-600/5 rounded-full blur-3xl translate-x-1/2 translate-y-1/2"></div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-12 gap-12 mb-16">

            {{-- ============================================ --}}
            {{-- KOLOM KIRI: Identitas & Deskripsi --}}
            {{-- ============================================ --}}
            <div class="lg:col-span-5">
                <div class="mb-6">
                    @php
                        $logoPath = $settings['app_logo'] ?? null;
                        $logoExists = $logoPath && file_exists(public_path('storage/' . $logoPath));
                    @endphp
                    @if($logoExists)
                        <img src="{{ asset('storage/' . $logoPath) }}" alt="Logo PPID IAIN Bone" class="h-20 w-auto brightness-0 invert">
                    @else
                        <h3 class="text-2xl font-bold text-white">PPID IAIN BONE</h3>
                    @endif
                </div>

                <p class="text-hijau-100/70 mb-8 font-light leading-relaxed max-w-sm" @if(app()->getLocale() === 'ar') dir="rtl"@endif>
                    {{ __('footer.desc') }}
                </p>

                {{-- Social Media Icons --}}
                <div class="flex items-center gap-3">
                    <a href="{{ $settings['facebook_url'] ?? '#' }}" target="_blank" 
                       class="w-10 h-10 rounded-lg bg-hijau-800/50 border border-hijau-700/50 flex items-center justify-center text-hijau-300 hover:bg-blue-600 hover:border-blue-500 hover:text-white transition-all duration-300">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="{{ $settings['instagram_url'] ?? '#' }}" target="_blank" 
                       class="w-10 h-10 rounded-lg bg-hijau-800/50 border border-hijau-700/50 flex items-center justify-center text-hijau-300 hover:bg-pink-600 hover:border-pink-500 hover:text-white transition-all duration-300">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="{{ $settings['twitter_url'] ?? '#' }}" target="_blank" 
                       class="w-10 h-10 rounded-lg bg-hijau-800/50 border border-hijau-700/50 flex items-center justify-center text-hijau-300 hover:bg-sky-500 hover:border-sky-400 hover:text-white transition-all duration-300">
                        <i class="fab fa-twitter text-sm"></i>
                    </a>
                    <a href="{{ $settings['youtube_url'] ?? '#' }}" target="_blank" 
                       class="w-10 h-10 rounded-lg bg-hijau-800/50 border border-hijau-700/50 flex items-center justify-center text-hijau-300 hover:bg-red-600 hover:border-red-500 hover:text-white transition-all duration-300">
                        <i class="fab fa-youtube text-sm"></i>
                    </a>
                </div>
            </div>

            {{-- ============================================ --}}
            {{-- KOLOM TENGAH: Link Navigasi --}}
            {{-- ============================================ --}}
            <div class="lg:col-span-4 flex flex-row gap-12 sm:gap-16">
                
                {{-- List 1: Tautan Cepat --}}
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-hijau-400 mb-6">{{ __('footer.quick_links') }}</h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('informasi-publik.index') }}" class="group flex items-center gap-2 text-sm text-hijau-100/70 hover:text-white transition-colors duration-300">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-hijau-400 transition-all duration-300"></span>
                                {{ __('footer.info_pub') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('publikasi.index') }}" class="group flex items-center gap-2 text-sm text-hijau-100/70 hover:text-white transition-colors duration-300">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-hijau-400 transition-all duration-300"></span>
                                {{ __('footer.pub_docs') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('berita.index') }}" class="group flex items-center gap-2 text-sm text-hijau-100/70 hover:text-white transition-colors duration-300">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-hijau-400 transition-all duration-300"></span>
                                {{ __('footer.latest_news') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('/#services') }}" class="group flex items-center gap-2 text-sm text-hijau-100/70 hover:text-white transition-colors duration-300">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-hijau-400 transition-all duration-300"></span>
                                {{ __('footer.services') }}
                            </a>
                        </li>
                    </ul>
                </div>
                
                {{-- List 2: Informasi Penting --}}
                <div>
                    <h4 class="text-sm font-bold uppercase tracking-wider text-hijau-400 mb-6">{{ __('footer.info') }}</h4>
                    <ul class="space-y-4">
                        <li>
                            <a href="{{ route('kontak.index') }}" class="group flex items-center gap-2 text-sm text-hijau-100/70 hover:text-white transition-colors duration-300">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-hijau-400 transition-all duration-300"></span>
                                {{ __('footer.contact_us') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('static-pages.show', 'kebijakan-privasi') }}" class="group flex items-center gap-2 text-sm text-hijau-100/70 hover:text-white transition-colors duration-300">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-hijau-400 transition-all duration-300"></span>
                                {{ __('footer.privacy') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('static-pages.show', 'disclaimer') }}" class="group flex items-center gap-2 text-sm text-hijau-100/70 hover:text-white transition-colors duration-300">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-hijau-400 transition-all duration-300"></span>
                                {{ __('footer.disclaimer') }}
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('galeri.index') }}" class="group flex items-center gap-2 text-sm text-hijau-100/70 hover:text-white transition-colors duration-300">
                                <span class="w-0 group-hover:w-3 h-0.5 bg-hijau-400 transition-all duration-300"></span>
                                {{ __('footer.gallery') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            {{-- ============================================ --}}
            {{-- KOLOM KANAN: Informasi Kontak --}}
            {{-- ============================================ --}}
            <div class="lg:col-span-3">
                <h4 class="text-sm font-bold uppercase tracking-wider text-hijau-400 mb-6">{{ __('footer.contact') }}</h4>
                <div class="flex flex-col gap-5">
                    
                    {{-- Alamat --}}
                    <div class="flex items-start gap-3 group">
                        <div class="w-9 h-9 rounded-lg bg-hijau-800/50 border border-hijau-700/50 flex items-center justify-center shrink-0 group-hover:bg-hijau-700 transition-colors duration-300">
                            <i class="fas fa-map-marker-alt text-sm text-hijau-400 group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <p class="text-sm text-hijau-100/70 leading-relaxed pt-1.5" @if(app()->getLocale() === 'ar') dir="rtl"@endif>
                            {{ $settings['alamat_kantor'] ?? 'Alamat belum diatur' }}
                        </p>
                    </div>

                    {{-- Telepon --}}
                    <div class="flex items-center gap-3 group">
                        <div class="w-9 h-9 rounded-lg bg-hijau-800/50 border border-hijau-700/50 flex items-center justify-center shrink-0 group-hover:bg-hijau-700 transition-colors duration-300">
                            <i class="fas fa-phone-alt text-sm text-hijau-400 group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <p class="text-sm text-hijau-100/70">
                            {{ $settings['telp_kontak'] ?? 'Telp belum diatur' }}
                        </p>
                    </div>

                    {{-- Email --}}
                    <div class="flex items-center gap-3 group">
                        <div class="w-9 h-9 rounded-lg bg-hijau-800/50 border border-hijau-700/50 flex items-center justify-center shrink-0 group-hover:bg-hijau-700 transition-colors duration-300">
                            <i class="fas fa-envelope text-sm text-hijau-400 group-hover:text-white transition-colors duration-300"></i>
                        </div>
                        <p class="text-sm text-hijau-100/70">
                            {{ $settings['email_kontak'] ?? 'Email belum diatur' }}
                        </p>
                    </div>

                </div>
            </div>

        </div>

        {{-- ============================================ --}}
        {{-- COPYRIGHT --}}
        {{-- ============================================ --}}
        <div class="border-t border-hijau-800/50 pt-8 flex flex-col md:flex-row justify-between items-center text-xs text-hijau-200/40 gap-2">
            <p>&copy; {{ date('Y') }} {{ config('app.name', 'PPID IAIN BONE') }}. {{ __('footer.copyright')}}</p>
            <p class="flex items-center gap-1.5">
                {{ __('footer.dev_with_love') }}  <i class="fas fa-heart text-red-500/70 text-[10px]"></i>{{ __('footer.dev_team') }}
            </p>
        </div>
    </div>
</footer>