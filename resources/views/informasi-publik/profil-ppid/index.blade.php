@extends('layouts.public_app')

@section('title', 'Profil PPID')

@section('content')

{{-- ============================================ --}}
{{-- HERO DINAMIS --}}
{{-- ============================================ --}}
<x-page-hero 
    title="Pusat Informasi PPID" 
    icon="building"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Informasi Publik', 'url' => route('informasi-publik.index')],
        ['label' => 'Profil PPID']
    ]" 
/>

{{-- ============================================ --}}
{{-- KONTEN UTAMA (2 Kolom) --}}
{{-- ============================================ --}}
<section class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-10"
         x-data="{ activeSection: '' }" 
         x-init="
            // Fungsi mendeteksi section mana yang sedang dilihat
            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        activeSection = entry.target.id;
                    }
                });
            }, { rootMargin: '-20% 0px -70% 0px' }); // Offset atas untuk menghitung sidebar
            document.querySelectorAll('.ppid-section').forEach(s => observer.observe(s));
         ">
        
<div class="flex flex-col lg:flex-row gap-6 lg:gap-8">
            
            {{-- ========================================== --}}
            {{-- SIDEBAR DROPDOWN (Hanya Muncul di Mobile) --}}
            {{-- ========================================== --}}
            <div class="lg:hidden relative" x-data="{ open: false }" @click.away="open = false">
                <button @click="open = !open" 
                        class="w-full bg-white rounded-xl shadow-sm border border-slate-200 p-3.5 flex items-center justify-between text-sm font-medium text-slate-700">
                    <span class="flex items-center gap-2">
                        <i class="bi bi-list text-base text-hijau-600"></i>
                        Pilih Bagian:
                    </span>
                    <svg class="w-5 h-5 transition-transform duration-300" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>
                
                <div x-show="open" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="absolute left-0 right-0 top-full mt-2 bg-white rounded-xl shadow-lg border border-slate-100 p-2 z-50 space-y-1">
                    
                    <a href="#visi-misi" 
                       @click.prevent="open = false; document.getElementById('visi-misi').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-hijau-50 hover:text-hijau-700 transition-colors">
                        <i class="bi bi-bullseye text-slate-400"></i> Visi, Misi & Maklumat
                    </a>
                    <a href="#struktur" 
                       @click.prevent="open = false; document.getElementById('struktur').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-hijau-50 hover:text-hijau-700 transition-colors">
                        <i class="bi bi-diagram-3-fill text-slate-400"></i> Struktur Organisasi
                    </a>
                    <a href="#tugas-fungsi" 
                       @click.prevent="open = false; document.getElementById('tugas-fungsi').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-hijau-50 hover:text-hijau-700 transition-colors">
                        <i class="bi bi-journal-richtext text-slate-400"></i> Tugas & Fungsi
                    </a>
                    <a href="#dasar-hukum" 
                       @click.prevent="open = false; document.getElementById('dasar-hukum').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                       class="flex items-center gap-3 px-4 py-2.5 rounded-lg text-sm font-medium text-slate-600 hover:bg-hijau-50 hover:text-hijau-700 transition-colors">
                        <i class="bi bi-umbrella text-slate-400"></i> Dasar Hukum
                    </a>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- SIDEBAR VERTIKAL (Hanya Muncul di Desktop) --}}
            {{-- ========================================== --}}
            <div class="hidden lg:block w-full lg:w-72 shrink-0">
                <div class="lg:sticky lg:top-24">
                    <nav class="bg-white rounded-2xl shadow-sm border border-slate-100 p-3 flex flex-col gap-1.5">
                        
                        <a href="#visi-misi" 
                           @click.prevent="document.getElementById('visi-misi').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                           :class="activeSection === 'visi-misi' ? 'bg-hijau-50 text-hijau-700 border-l-4 border-hijau-600' : 'border-l-4 border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                           class="flex items-center gap-3 px-4 py-3 rounded-r-lg text-sm font-medium transition-all duration-200">
                            <i class="bi bi-bullseye text-base"></i>
                            <span>Visi, Misi & Maklumat</span>
                        </a>

                        <a href="#struktur" 
                           @click.prevent="document.getElementById('struktur').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                           :class="activeSection === 'struktur' ? 'bg-hijau-50 text-hijau-700 border-l-4 border-hijau-600' : 'border-l-4 border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                           class="flex items-center gap-3 px-4 py-3 rounded-r-lg text-sm font-medium transition-all duration-200">
                            <i class="bi bi-diagram-3-fill text-base"></i>
                            <span>Struktur Organisasi</span>
                        </a>

                        <a href="#tugas-fungsi" 
                           @click.prevent="document.getElementById('tugas-fungsi').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                           :class="activeSection === 'tugas-fungsi' ? 'bg-hijau-50 text-hijau-700 border-l-4 border-hijau-600' : 'border-l-4 border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                           class="flex items-center gap-3 px-4 py-3 rounded-r-lg text-sm font-medium transition-all duration-200">
                            <i class="bi bi-journal-richtext text-base"></i>
                            <span>Tugas & Fungsi</span>
                        </a>

                        <a href="#dasar-hukum" 
                           @click.prevent="document.getElementById('dasar-hukum').scrollIntoView({ behavior: 'smooth', block: 'start' })"
                           :class="activeSection === 'dasar-hukum' ? 'bg-hijau-50 text-hijau-700 border-l-4 border-hijau-600' : 'border-l-4 border-transparent text-slate-600 hover:bg-slate-50 hover:text-slate-900'"
                           class="flex items-center gap-3 px-4 py-3 rounded-r-lg text-sm font-medium transition-all duration-200">
                            <i class="bi bi-umbrella text-base"></i>
                            <span>Dasar Hukum</span>
                        </a>

                    </nav>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- KOLOM KANAN: ISI KONTEN (Diperkecil untuk Mobile) --}}
            {{-- ========================================== --}}
            <div class="flex-1 min-w-0 space-y-4 md:space-y-6">
                
                {{-- Bagian 1: Visi, Misi & Maklumat --}}
                <section id="visi-misi" class="ppid-section bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-100 p-4 md:p-8 scroll-mt-20 lg:scroll-mt-24">
                    <h2 class="text-lg md:text-2xl font-bold text-slate-800 mb-4 md:mb-6 flex items-center gap-2 md:gap-3">
                        <div class="w-1 h-5 md:h-8 bg-hijau-600 rounded-full shrink-0"></div>
                        Visi, Misi & Maklumat
                    </h2>
                    
                    <h3 class="text-sm md:text-base font-bold text-hijau-700 mb-2">Visi</h3>
                    <blockquote class="border-l-4 border-hijau-500 bg-hijau-50/50 pl-4 md:pl-5 py-3 md:py-4 mb-4 md:mb-6 italic text-slate-700 text-sm md:text-base rounded-r-lg">
                        "Terwujudnya Pelayanan Informasi Publik yang Transparan, Akuntabel, dan Inklusif demi Terpenuhinya Hak Masyarakat atas Informasi."
                    </blockquote>
                    
                    <h3 class="text-sm md:text-base font-bold text-hijau-700 mb-2 md:mb-3">Misi</h3>
                    <div class="prose prose-xs md:prose-sm max-w-none text-slate-600 list-decimal pl-4 md:pl-5 mb-4 md:mb-6 text-sm md:text-base">
                        <li>Meningkatkan kualitas pengelolaan dan pelayanan informasi publik.</li>
                        <li>Menyediakan informasi publik secara cepat, tepat, dan akurat.</li>
                        <li>Membangun sistem dokumentasi yang tertib dan modern.</li>
                        <li>Meningkatkan kapasitas dan kompetensi petugas PPID.</li>
                    </div>

                    <h3 class="text-sm md:text-base font-bold text-hijau-700 mb-2">Maklumat Pelayanan</h3>
                    <div class="bg-slate-50 border border-slate-200 p-3 md:p-4 rounded-lg md:rounded-xl">
                        <p class="italic text-slate-600 text-xs md:text-sm mb-0">"Dengan ini kami menyatakan sanggup menyelenggarakan pelayanan informasi publik sesuai standar operasional prosedur yang telah ditetapkan..."</p>
                    </div>
                </section>

                {{-- Bagian 2: Struktur Organisasi --}}
                <section id="struktur" class="ppid-section bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-100 p-4 md:p-8 scroll-mt-20 lg:scroll-mt-24">
                    <h2 class="text-lg md:text-2xl font-bold text-slate-800 mb-4 md:mb-6 flex items-center gap-2 md:gap-3">
                        <div class="w-1 h-5 md:h-8 bg-hijau-600 rounded-full shrink-0"></div>
                        Struktur Organisasi
                    </h2>
                    
                    @php
                        $strukturImagePath = 'images/struktur_ppid.png';
                        $placeholderUrl = 'https://placehold.co/1200x900/E5E7EB/6B7280?text=Bagan+Struktur+PPID';
                    @endphp

                    {{-- Gambar Dibatasi Tinggi Maksimal --}}
                    <div class="mb-4 md:mb-6 bg-slate-50 rounded-lg md:rounded-xl p-2 md:p-4 border border-slate-100 flex justify-center max-h-[250px] md:max-h-[500px]">
                        @if(file_exists(public_path($strukturImagePath)))
                            <img src="{{ asset($strukturImagePath) }}" alt="Bagan Struktur Organisasi PPID" class="max-w-full h-full object-contain rounded-lg">
                        @else
                            <img src="{{ $placeholderUrl }}" alt="Bagan Struktur Organisasi PPID tidak tersedia" class="max-w-full h-full object-contain rounded-lg opacity-75">
                        @endif
                    </div>
                    
                    <div class="prose prose-xs md:prose-sm max-w-none text-slate-600 text-sm md:text-base">
                        <p>Struktur PPID IAIN Bone menjamin alur koordinasi dan pelayanan yang efektif, terdiri dari:</p>
                        <ul class="list-none space-y-2 pl-0">
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-hijau-500 mt-2 shrink-0"></span>
                                <span><strong class="text-slate-800">Atasan PPID:</strong> Penanggung jawab tertinggi.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-hijau-500 mt-2 shrink-0"></span>
                                <span><strong class="text-slate-800">PPID:</strong> Manajer pengelolaan dan pelayanan informasi.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-hijau-500 mt-2 shrink-0"></span>
                                <span><strong class="text-slate-800">PPID Pelaksana:</strong> Tim teknis pelayanan informasi.</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="w-1.5 h-1.5 rounded-full bg-hijau-500 mt-2 shrink-0"></span>
                                <span><strong class="text-slate-800">Tim Pertimbangan:</strong> Tim ahli untuk kasus informasi kompleks.</span>
                            </li>
                        </ul>
                    </div>
                </section>
                
                {{-- Bagian 3: Tugas & Fungsi --}}
                <section id="tugas-fungsi" class="ppid-section bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-100 p-4 md:p-8 scroll-mt-20 lg:scroll-mt-24">
                    <h2 class="text-lg md:text-2xl font-bold text-slate-800 mb-4 md:mb-6 flex items-center gap-2 md:gap-3">
                        <div class="w-1 h-5 md:h-8 bg-hijau-600 rounded-full shrink-0"></div>
                        Tugas & Fungsi PPID
                    </h2>
                    
                    <h3 class="text-sm md:text-base font-bold text-hijau-700 mb-2">Tugas Pokok PPID</h3>
                    <p class="text-slate-600 text-sm mb-4 md:mb-6">Melaksanakan tugas dan fungsi sebagai Pejabat Pengelola Informasi dan Dokumentasi di lingkungan IAIN Bone sesuai dengan peraturan perundang-undangan yang berlaku.</p>

                    <h3 class="text-sm md:text-base font-bold text-hijau-700 mb-2 md:mb-3">Fungsi PPID</h3>
                    <div class="prose prose-xs md:prose-sm max-w-none text-slate-600 list-decimal pl-4 md:pl-5 text-sm md:text-base">
                        <li>Penyimpanan, pendokumentasian, penyediaan, dan pelayanan informasi publik.</li>
                        <li>Pengelolaan sistem informasi dan dokumentasi yang mudah diakses.</li>
                        <li>Penetapan standar operasional prosedur (SOP) pelayanan informasi.</li>
                        <li>Melakukan pengujian konsekuensi atas informasi yang dikecualikan.</li>
                        <li>Melakukan klasifikasi informasi publik.</li>
                        <li>Mengelola pengajuan keberatan dan proses sengketa informasi.</li>
                        <li>Menyusun laporan layanan informasi publik secara berkala.</li>
                    </div>
                </section>

                {{-- Bagian 4: Dasar Hukum --}}
                <section id="dasar-hukum" class="ppid-section bg-white rounded-xl md:rounded-2xl shadow-sm border border-slate-100 p-4 md:p-8 scroll-mt-20 lg:scroll-mt-24">
                    <h2 class="text-lg md:text-2xl font-bold text-slate-800 mb-4 md:mb-6 flex items-center gap-2 md:gap-3">
                        <div class="w-1 h-5 md:h-8 bg-hijau-600 rounded-full shrink-0"></div>
                        Dasar Hukum
                    </h2>
                    <p class="text-slate-600 text-sm mb-3 md:mb-4">Pembentukan dan operasional PPID berlandaskan pada peraturan sebagai berikut:</p>
                    
                    <div class="prose prose-xs md:prose-sm max-w-none text-slate-600 list-decimal pl-4 md:pl-5 text-sm md:text-base">
                        <li><strong class="text-slate-800">UU No. 14 Tahun 2008</strong> tentang Keterbukaan Informasi Publik.</li>
                        <li><strong class="text-slate-800">PP No. 61 Tahun 2010</strong> tentang Pelaksanaan UU No. 14 Tahun 2008.</li>
                        <li><strong class="text-slate-800">Perki No. 1 Tahun 2021</strong> tentang Standar Layanan Informasi Publik.</li>
                        <li><strong class="text-slate-800">Permendagri No. 3 Tahun 2017</strong> tentang Pedoman Pengelolaan Pelayanan Informasi.</li>
                        <li><strong class="text-slate-800">Keputusan Rektor & Kepala Biro</strong> terkait pembentukan PPID di lingkungan IAIN Bone.</li>
                    </div>
                </section>

            </div>
        </div>

        {{-- ============================================ --}}
        {{-- TOMBOL AKSI --}}
        {{-- ============================================ --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-10 pt-8 border-t border-slate-200">
            <button onclick="history.back()" 
                    class="flex items-center gap-2 px-5 py-2.5 bg-white text-slate-700 rounded-xl text-sm font-medium hover:bg-gray-100 transition-colors duration-300 shadow-sm border border-slate-200 w-full sm:w-auto justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </button>
            <a href="{{ url('/') }}" 
               class="flex items-center gap-2 px-5 py-2.5 bg-hijau-600 text-white rounded-xl text-sm font-medium hover:bg-hijau-700 shadow-lg shadow-hijau-600/30 hover:shadow-hijau-600/50 transition-all duration-300 w-full sm:w-auto justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

    </div>
</section>

@endsection