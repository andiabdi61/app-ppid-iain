@extends('layouts.public_app')

@section('title', 'Beranda')

@section('content')

{{-- ============================================ --}}
{{-- HERO SLIDER (Gradient Transparan + Gambar Jelas) --}}
{{-- ============================================ --}}
{{-- ============================================ --}}
{{-- HERO SLIDER (Gradient + Gambar Tidak Terpotong) --}}
{{-- ============================================ --}}
<div x-data="{ 
    currentSlide: 0, 
    slides: [
        { 
            img_desktop: '{{ asset('images/rektor.webp') }}', 
            img_mobile: '{{ asset('images/rektor.webp') }}', 
        },
        { 
            img_desktop: '{{ asset('images/pimpinan-ppid.webp') }}', 
            img_mobile: '{{ asset('images/pimpinan-ppid.webp') }}', 
        },
        { 
            img_desktop: '{{ asset('images/mahasiswa.webp') }}', 
            img_mobile: '{{ asset('images/mahasiswa.webp') }}', 
        },
    ],
    autoplay: null,
    startAutoplay() { this.autoplay = setInterval(() => this.next(), 4000); },
    stopAutoplay() { clearInterval(this.autoplay); },
    next() { this.currentSlide = (this.currentSlide + 1) % this.slides.length; },
    prev() { this.currentSlide = (this.currentSlide - 1 + this.slides.length) % this.slides.length; }
}" x-init="startAutoplay()" @mouseenter="stopAutoplay()" @mouseleave="startAutoplay()" 
   class="relative w-full overflow-hidden
          h-56 sm:h-64 md:h-80 
          lg:h-[calc(100vh-72px)]">
    
    <!-- Slides -->
    <template x-for="(slide, index) in slides" :key="index">
        <div class="absolute inset-0 transition-opacity duration-700 ease-in-out"
             :class="currentSlide === index ? 'opacity-100 z-10' : 'opacity-0 z-0'">
            
            <!-- Gambar Desktop (object-top agar wajah tidak terpotong) -->
            <img :src="slide.img_desktop" 
                 alt="Slider PPID IAIN Bone"
                 class="hidden lg:block absolute inset-0 w-full h-full object-cover object-center">
            
            <!-- Gambar Mobile (object-top agar wajah tidak terpotong) -->
            <img :src="slide.img_mobile" 
                 alt="Slider PPID IAIN Bone"
                 class="block lg:hidden absolute inset-0 w-full h-full object-cover object-top">
        </div>
    </template>

    {{-- OVERLAY GRADIENT --}}
    {{-- <div class="absolute inset-0 z-10 bg-gradient-to-r from-hijau-900/60 via-emerald-900/40 to-transparent pointer-events-none"></div> --}}

    <!-- Navigasi Panah (Desktop) -->
    <button @click="prev()" 
            class="hidden lg:flex absolute left-4 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/40 backdrop-blur-sm text-white p-3 rounded-full transition">
        <i class="fas fa-chevron-left text-lg"></i>
    </button>
    <button @click="next()" 
            class="hidden lg:flex absolute right-4 top-1/2 -translate-y-1/2 z-20 bg-white/20 hover:bg-white/40 backdrop-blur-sm text-white p-3 rounded-full transition">
        <i class="fas fa-chevron-right text-lg"></i>
    </button>

    <!-- Navigasi Swipe (Mobile) -->
    <button @click="prev()" 
            class="lg:hidden absolute left-2 top-1/2 -translate-y-1/2 z-20 bg-black/30 hover:bg-black/50 text-white p-2 rounded-full transition">
        <i class="fas fa-chevron-left text-sm"></i>
    </button>
    <button @click="next()" 
            class="lg:hidden absolute right-2 top-1/2 -translate-y-1/2 z-20 bg-black/30 hover:bg-black/50 text-white p-2 rounded-full transition">
        <i class="fas fa-chevron-right text-sm"></i>
    </button>

    <!-- Indikator Dots -->
    <div class="absolute bottom-4 lg:bottom-8 left-1/2 -translate-x-1/2 z-20 flex space-x-2 lg:space-x-3">
        <template x-for="(slide, index) in slides" :key="'dot'+index">
            <button @click="currentSlide = index" 
                    class="h-2 lg:h-3 rounded-full transition-all duration-300"
                    :class="currentSlide === index ? 'bg-white w-6 lg:w-8' : 'bg-white/50 hover:bg-white/75 w-2 lg:w-3'">
            </button>
        </template>
    </div>
</div>

{{-- ============================================ --}}
{{-- TENTANG KAMI SECTION --}}
{{-- ============================================ --}}
<section id="tentang-kami" class="py-16 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">
            
            <div>
                <p class="text-hijau-600 font-semibold text-sm uppercase tracking-wider mb-3">{{ __('messages.about_us') }}</p>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6 leading-tight">
                    {!! __('messages.about_title', ['highlight' => '<span class="text-hijau-600">' . __('messages.about_highlight') . '</span>']) !!}
                </h2>
                <p class="text-gray-600 leading-relaxed mb-8">
                    {{ __('messages.about_description') }}
                </p>
                <a href="{{ route('informasi-publik.profil-ppid.index') }}" class="inline-flex items-center gap-2 text-hijau-700 font-semibold hover:gap-3 transition-all">
                    {{ __('messages.view_full_profile') }} <i class="fas fa-arrow-right text-sm"></i>
                </a>
            </div>

            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 md:gap-4">
                @php
                    $menuItems = [
                        ['icon' => 'fa-handshake', 'title' => __('messages.visi_misi'), 'url' => '/tentang-kami/visi-misi'],
                        ['icon' => 'fa-tasks', 'title' => __('messages.tugas_fungsi'), 'url' => '/tentang-kami/tugas-fungsi'],
                        ['icon' => 'fa-crown', 'title' => __('messages.profil_pejabat'), 'url' => '/tentang-kami/profil-pejabat'],
                        ['icon' => 'fa-sitemap', 'title' => __('messages.struktur_organisasi'), 'url' => '/tentang-kami/struktur-organisasi'],
                        ['icon' => 'fa-puzzle-piece', 'title' => __('messages.profil_bidang'), 'url' => route('bidang-sektoral.index')],
                    ];
                @endphp
                @foreach($menuItems as $item)
                    <a href="{{ $item['url'] }}" class="group p-4 md:p-5 border border-gray-200 rounded-2xl hover:border-hijau-500 hover:shadow-sm transition-all duration-300 flex flex-col items-center text-center">
                        <div class="w-11 h-11 md:w-12 md:h-12 bg-hijau-50 group-hover:bg-hijau-100 rounded-xl flex items-center justify-center mb-3 transition-colors">
                            <i class="fas {{ $item['icon'] }} text-hijau-600 text-sm md:text-base"></i>
                        </div>
                        <span class="text-xs md:text-sm font-semibold text-gray-700 group-hover:text-hijau-700 transition-colors">{{ $item['title'] }}</span>
                    </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- SECTION PENCARIAN --}}
{{-- ============================================ --}}
<section class="py-12 md:py-16 bg-gray-50">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-6 md:mb-8">
            <p class="text-hijau-600 font-semibold text-sm uppercase tracking-wider mb-2">{{ __('messages.search') }}</p>
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900">{{ __('messages.find_information') }}</h2>
        </div>
        <form action="{{ route('search') }}" method="GET" class="flex">
            <div class="flex-1 flex items-center bg-white border border-e-0 border-gray-300 rounded-s-xl px-4 focus-within:ring-2 focus-within:ring-hijau-500 focus-within:border-hijau-500 transition">
                <i class="fa-solid fa-magnifying-glass text-gray-400 me-3 text-sm"></i>
                <input type="search" name="q" placeholder="{{ __('messages.search_placeholder') }}" value="{{ request('q') }}"
                       class="w-full py-3 text-sm placeholder-gray-400 focus:outline-none border-0 bg-transparent">
            </div>
            <button type="submit" class="px-6 py-3 bg-hijau-600 hover:bg-hijau-700 text-white rounded-e-xl transition text-sm font-medium">
                {{ __('messages.search_button') }}
            </button>
        </form>
    </div>
</section>

{{-- ============================================ --}}
{{-- BERITA & PUBLIKASI --}}
{{-- ============================================ --}}
<section class="py-16 md:py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 md:mb-14">
            <p class="text-hijau-600 font-semibold text-sm uppercase tracking-wider mb-2">{{ __('messages.latest') }}</p>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">{{ __('messages.info_publications') }}</h2>
        </div>

        <div class="grid lg:grid-cols-2 gap-6 md:gap-8">
            
            <div class="bg-gray-50 rounded-2xl border border-gray-200 p-5 md:p-6 flex flex-col">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-8 h-1 bg-hijau-600 rounded-full"></span> {{ __('messages.latest_news') }}
                    </h3>
                    <a href="{{ route('berita.index') }}" class="text-sm text-hijau-600 hover:text-hijau-700 font-medium">{{ __('messages.view_all') }}</a>
                </div>
                
                <div class="flex-1 divide-y divide-gray-200">
                    @forelse($posts as $post)
                    <a href="{{ route('berita.show', $post->slug) }}" class="flex items-center justify-between py-3.5 first:pt-0 last:pb-0 group">
                        <span class="text-gray-700 group-hover:text-hijau-700 transition text-sm pe-4 line-clamp-2">{{ $post->title }}</span>
                        <i class="fas fa-chevron-right text-xs text-gray-300 group-hover:text-hijau-50 transition shrink-0 rtl:rotate-180"></i>
                    </a>
                    @empty
                    <p class="text-sm text-gray-400 py-4">{{ __('messages.no_news') }}</p>
                    @endforelse
                </div>
            </div>
            
            <div class="bg-gray-50 rounded-2xl border border-gray-200 p-5 md:p-6 flex flex-col">
                <div class="flex items-center justify-between mb-5">
                    <h3 class="text-lg md:text-xl font-bold text-gray-800 flex items-center gap-2">
                        <span class="w-8 h-1 bg-hijau-600 rounded-full"></span> {{ __('messages.official_publications') }}
                    </h3>
                    <a href="{{ route('publikasi.index') }}" class="text-sm text-hijau-600 hover:text-hijau-700 font-medium">{{ __('messages.view_all') }}</a>
                </div>
                
                <div class="flex-1 divide-y divide-gray-200">
                    @forelse($dokumen as $doc)
                    <a href="{{ route('publikasi.show', $doc->slug) }}" class="flex items-center justify-between py-3.5 first:pt-0 last:pb-0 group">
                        <span class="text-gray-700 group-hover:text-hijau-700 transition text-sm pe-4 line-clamp-2">{{ $doc->judul }}</span>
                        <i class="fas fa-chevron-right text-xs text-gray-300 group-hover:text-hijau-50 transition shrink-0 rtl:rotate-180"></i>
                    </a>
                    @empty
                    <p class="text-sm text-gray-400 py-4">{{ __('messages.no_publications') }}</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- PUSAT LAYANAN --}}
{{-- ============================================ --}}
<section id="layanan" class="py-16 md:py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 md:mb-14">
            <p class="text-hijau-600 font-semibold text-sm uppercase tracking-wider mb-2">{{ __('messages.our_services') }}</p>
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-gray-900">{{ __('messages.service_complaint_center') }}</h2>
        </div>
        
        <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            
            <a href="https://www.lapor.go.id/" target="_blank" class="group p-5 md:p-6 border border-gray-200 rounded-2xl hover:border-red-300 hover:shadow-lg transition-all duration-300 flex flex-col items-center text-center">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-red-50 group-hover:bg-red-100 rounded-2xl flex items-center justify-center mb-4 transition-colors">
                    <img src="https://www.lapor.go.id/themes/lapor/assets/images/logo.png" alt="LAPOR" class="w-9 h-9 md:w-10 md:h-10 object-contain">
                </div>
                <h5 class="text-base md:text-lg font-bold text-gray-800 mb-1.5">{{ __('messages.public_complaints') }}</h5>
                <p class="text-xs md:text-sm text-gray-500">{{ __('messages.public_complaints_desc') }}</p>
            </a>

            <a href="{{ route('layanan-pengaduan.faq-umum') }}" class="group p-5 md:p-6 border border-gray-200 rounded-2xl hover:border-green-300 hover:shadow-lg transition-all duration-300 flex flex-col items-center text-center">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-green-50 group-hover:bg-green-100 rounded-2xl flex items-center justify-center mb-4 transition-colors">
                    <i class="fa-solid fa-circle-question text-2xl md:text-3xl text-green-600"></i>
                </div>
                <h5 class="text-base md:text-lg font-bold text-gray-800 mb-1.5">{{ __('messages.faq') }}</h5>
                <p class="text-xs md:text-sm text-gray-500">{{ __('messages.faq_desc') }}</p>
            </a>

            <a href="{{ route('layanan-pengaduan.daftar-layanan') }}" class="group p-5 md:p-6 border border-gray-200 rounded-2xl hover:border-blue-300 hover:shadow-lg transition-all duration-300 flex flex-col items-center text-center">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-blue-50 group-hover:bg-blue-100 rounded-2xl flex items-center justify-center mb-4 transition-colors">
                    <i class="fa-solid fa-screwdriver-wrench text-2xl md:text-3xl text-blue-600"></i>
                </div>
                <h5 class="text-base md:text-lg font-bold text-gray-800 mb-1.5">{{ __('messages.service_list') }}</h5>
                <p class="text-xs md:text-sm text-gray-500">{{ __('messages.service_list_desc') }}</p>
            </a>

            <a href="{{ route('layanan-pengaduan.cek-status') }}" class="group p-5 md:p-6 border border-gray-200 rounded-2xl hover:border-amber-300 hover:shadow-lg transition-all duration-300 flex flex-col items-center text-center">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-amber-50 group-hover:bg-amber-100 rounded-2xl flex items-center justify-center mb-4 transition-colors">
                    <i class="fa-solid fa-magnifying-glass text-2xl md:text-3xl text-amber-600"></i>
                </div>
                <h5 class="text-base md:text-lg font-bold text-gray-800 mb-1.5">{{ __('messages.check_status') }}</h5>
                <p class="text-xs md:text-sm text-gray-500">{{ __('messages.check_status_desc') }}</p>
            </a>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- CTA SECTION --}}
{{-- ============================================ --}}
<section class="relative py-20 md:py-24 bg-hijau-800 overflow-hidden">
    <div class="absolute top-0 left-0 w-72 h-72 bg-hijau-700 rounded-full mix-blend-multiply filter blur-3xl opacity-30 -translate-x-1/2 -translate-y-1/2"></div>
    <div class="absolute bottom-0 right-0 w-72 h-72 bg-hijau-900 rounded-full mix-blend-multiply filter blur-3xl opacity-30 translate-x-1/2 translate-y-1/2"></div>

    <div class="relative max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-white mb-6">{{ __('messages.cta_title') }}</h2>
        <p class="text-base md:text-lg text-hijau-200 mb-8 md:mb-10 max-w-2xl mx-auto">{{ __('messages.cta_desc') }}</p>
        <a href="{{ route('kontak.index') }}" class="inline-flex items-center gap-2 bg-white text-hijau-800 hover:bg-hijau-50 px-8 md:px-10 py-3.5 md:py-4 rounded-xl font-bold text-base md:text-lg transition shadow-xl">
            <i class="fas fa-headset"></i> {{ __('messages.contact_us_now') }}
        </a>
    </div>
</section>

{{-- ============================================ --}}
{{-- KONTAK & PETA --}}
{{-- ============================================ --}}
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 lg:p-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6">{{ __('messages.contact_info') }}</h3>
                    <div class="flex flex-col gap-5">
                        
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-hijau-50 border border-hijau-100 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-location-dot text-hijau-600 text-lg"></i>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900">{{ __('messages.office_address') }}</h5>
                                <p class="text-sm text-gray-500 mt-0.5 leading-relaxed">{{ $settings['alamat_kantor'] ?? 'Alamat belum diatur' }}</p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-hijau-50 border border-hijau-100 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-phone text-hijau-600 text-lg"></i>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900">{{ __('messages.phone') }}</h5>
                                <p class="text-sm text-gray-500 mt-0.5">
                                    <a href="tel:{{ $settings['telp_kontak'] ?? '' }}" class="text-hijau-600 hover:text-hijau-700 hover:underline transition">{{ $settings['telp_kontak'] ?? 'Telepon belum diatur' }}</a>
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-hijau-50 border border-hijau-100 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-envelope text-hijau-600 text-lg"></i>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900">{{ __('messages.email') }}</h5>
                                <p class="text-sm text-gray-500 mt-0.5">
                                    <a href="mailto:{{ $settings['email_kontak'] ?? '' }}" class="text-hijau-600 hover:text-hijau-700 hover:underline transition">{{ $settings['email_kontak'] ?? 'Email belum diatur' }}</a>
                                </p>
                            </div>
                        </div>
                        
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-hijau-50 border border-hijau-100 flex items-center justify-center shrink-0">
                                <i class="fa-solid fa-clock text-hijau-600 text-lg"></i>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900">{{ __('messages.service_hours') }}</h5>
                                <div class="mt-2 text-sm text-gray-500 space-y-1">
                                    <div class="flex gap-3">
                                        <span class="w-28 shrink-0">{{ __('messages.mon_thu') }}</span>
                                        <span>: 07.30 - 16.00 WIB</span>
                                    </div>
                                    <div class="flex gap-3">
                                        <span class="w-28 shrink-0">{{ __('messages.fri') }}</span>
                                        <span>: 07.30 - 16.30 WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6">{{ __('messages.location_map') }}</h3>
                    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-200 aspect-[4/3]">
                        <iframe 
                            src="https://maps.google.com/maps?q=IAIN+Bone+Jl+Hos+Cokroaminoto+Macanang+Tanete+Riattang+Kab+Bone+Sulawesi+Selatan&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection