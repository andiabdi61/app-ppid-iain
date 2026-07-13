@extends('layouts.public_app')

@section('title', 'Peta Situs')

@section('content')

{{-- Hero Section --}}
<x-page-hero 
    title="Peta Situs" 
    icon="doc"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Peta Situs']
    ]"
/>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
    <div class="flex justify-center">
        <div class="w-full max-w-4xl">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 lg:p-10">
                    
                    <ul class="space-y-2">

                        {{-- ============================================ --}}
                        {{-- BERANDA --}}
                        {{-- ============================================ --}}
                        <li>
                            <a href="{{ url('/') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-gray-900 hover:bg-hijau-50 hover:text-hijau-700 transition-colors group">
                                <i class="bi bi-house-door-fill text-hijau-600 group-hover:scale-110 transition-transform"></i>
                                Beranda
                            </a>
                        </li>

                        {{-- ============================================ --}}
                        {{-- TENTANG KAMI --}}
                        {{-- ============================================ --}}
                        <li>
                            <div class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-800">
                                <i class="bi bi-info-circle-fill text-hijau-600"></i>
                                Tentang Kami
                            </div>
                            <ul class="relative ml-5 border-l-2 border-gray-200 pl-6 space-y-1 my-1">
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('tentang-kami.visi-misi') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Visi, Misi & Tujuan
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('tentang-kami.struktur-organisasi') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Struktur Organisasi
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('tentang-kami.tugas-fungsi') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Tugas & Fungsi
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('tentang-kami.profil-pejabat') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Profil Pejabat
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('bidang-sektoral.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Profil Bidang & Unit
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('kinerja.publik') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Capaian Kinerja
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- ============================================ --}}
                        {{-- INFORMASI PUBLIK (PPID) --}}
                        {{-- ============================================ --}}
                        <li>
                            <div class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-800">
                                <i class="bi bi-journals text-hijau-600"></i>
                                Informasi Publik (PPID)
                            </div>
                            <ul class="relative ml-5 border-l-2 border-gray-200 pl-6 space-y-1 my-1">
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('informasi-publik.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Daftar Informasi Publik
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('informasi-publik.profil-ppid.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Profil PPID
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('informasi-publik.permohonan.prosedur') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Alur Permohonan
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('informasi-publik.keberatan.prosedur') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Alur Keberatan
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('login') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Formulir Online (Wajib Login)
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- ============================================ --}}
                        {{-- MEDIA CENTER --}}
                        {{-- ============================================ --}}
                        <li>
                            <div class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-800">
                                <i class="bi bi-file-earmark-ruled-fill text-hijau-600"></i>
                                Media Center
                            </div>
                            <ul class="relative ml-5 border-l-2 border-gray-200 pl-6 space-y-1 my-1">
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('publikasi.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Publikasi & Dokumen
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('berita.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Berita
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('galeri.index') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Galeri
                                    </a>
                                </li>
                            </ul>
                        </li>
                        
                        {{-- ============================================ --}}
                        {{-- LAYANAN & PENGADUAN --}}
                        {{-- ============================================ --}}
                        <li>
                            <div class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-800">
                                <i class="bi bi-headset text-hijau-600"></i>
                                Layanan & Pengaduan
                            </div>
                            <ul class="relative ml-5 border-l-2 border-gray-200 pl-6 space-y-1 my-1">
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ url('/#services') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Pusat Layanan
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="https://www.lapor.go.id/" target="_blank" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Pengaduan Masyarakat <i class="bi bi-box-arrow-up-right text-xs text-gray-400"></i>
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('layanan-pengaduan.daftar-layanan') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Daftar Layanan Umum
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('layanan-pengaduan.faq-umum') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> FAQ Umum
                                    </a>
                                </li>
                            </ul>
                        </li>

                        {{-- ============================================ --}}
                        {{-- KONTAK --}}
                        {{-- ============================================ --}}
                        <li>
                            <a href="{{ route('kontak.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-semibold text-gray-900 hover:bg-hijau-50 hover:text-hijau-700 transition-colors group">
                                <i class="bi bi-telephone-fill text-hijau-600 group-hover:scale-110 transition-transform"></i>
                                Kontak
                            </a>
                        </li>
                        
                        {{-- ============================================ --}}
                        {{-- LAIN-LAIN --}}
                        {{-- ============================================ --}}
                        <li>
                            <div class="flex items-center gap-3 px-4 py-3 text-sm font-bold text-gray-800">
                                <i class="bi bi-three-dots text-hijau-600"></i>
                                Lain-lain
                            </div>
                            <ul class="relative ml-5 border-l-2 border-gray-200 pl-6 space-y-1 my-1">
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('static-pages.show', 'kebijakan-privasi') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Kebijakan Privasi
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('static-pages.show', 'disclaimer') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Disclaimer
                                    </a>
                                </li>
                                <li class="relative">
                                    <span class="absolute -left-[31px] top-1/2 -translate-y-1/2 w-3 h-3 rounded-full border-2 border-gray-300 bg-white"></span>
                                    <a href="{{ route('static-pages.show', 'aksesibilitas') }}" class="flex items-center gap-2 px-3 py-2 rounded-lg text-sm text-gray-600 hover:text-hijau-700 hover:bg-hijau-50/50 transition-colors">
                                        <i class="bi bi-caret-right-fill text-xs text-gray-400"></i> Halaman Aksesibilitas
                                    </a>
                                </li>
                            </ul>
                        </li>

                    </ul>

                </div>
            </div>

            {{-- ============================================ --}}
            {{-- TOMBOL AKSI --}}
            {{-- ============================================ --}}
            <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-8">
                <button onclick="history.back()" 
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-medium border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                    <i class="bi bi-arrow-left"></i>
                    Kembali
                </button>
                <a href="{{ url('/') }}" 
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-medium bg-hijau-600 text-white hover:bg-hijau-700 transition-colors shadow-sm">
                    <i class="bi bi-house"></i>
                    Kembali ke Beranda
                </a>
            </div>

        </div>
    </div>
</div>
@endsection