@extends('layouts.public_app')

@section('title', 'Visi, Misi & Tujuan')

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION & BREADCRUMB --}}
{{-- ============================================ --}}
<x-page-hero 
    title="Visi, Misi & Tujuan Strategis" 
    icon="target"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Tentang Kami', 'url' => url('/#tentang-kami')],
        ['label' => 'Visi, Misi & Tujuan']
    ]" 
/>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col gap-8">
            
            {{-- ============================================ --}}
            {{-- CARD VISI UTAMA --}}
            {{-- ============================================ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                @php
                    $imagePath = 'storage/images/visi-misi.webp';
                    $placeholderUrl = 'https://placehold.co/1200x600/E5E7EB/6B7280?text=Gambar+Visi+PPID';
                @endphp

                <div class="relative">
                    @if(file_exists(public_path($imagePath)))
                        <img src="{{ asset($imagePath) }}" alt="Visi PPID IAIN BONE" class="w-full h-64 md:h-80 object-cover">
                    @else
                        <img src="{{ $placeholderUrl }}" alt="Placeholder Visi" class="w-full h-64 md:h-80 object-cover">
                    @endif
                </div>

                <div class="p-6 md:p-8 text-center">
                    <p class="text-hijau-600 font-semibold uppercase tracking-wider text-sm mb-4">Visi PPID IAIN BONE</p>
                    
                    {{-- GANTI TEKS INI DENGAN VISI RESMI KAMU --}}
                    <blockquote class="text-2xl md:text-4xl font-extrabold text-hijau-800 my-6 leading-tight">
                        "MENJADI PPID YANG <br>TRANSPARAN DAN AKUNTABEL"
                    </blockquote>
                    
                    <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">
                        Mewujudkan pelayanan informasi publik yang cepat, tepat, dan akuntabel sesuai dengan amanat Undang-Undang Keterbukaan Informasi Publik.
                    </p>
                </div>
            </div>

            {{-- ============================================ --}}
            {{-- CARD MISI (Pilar Strategis) --}}
            {{-- ============================================ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <h3 class="text-xl font-bold text-hijau-700 flex items-center gap-3 mb-5">
                    <span class="w-8 h-8 bg-hijau-600 text-white rounded-full flex items-center justify-center text-sm font-bold shrink-0">1</span>
                    MISI PERTAMA
                </h3>
                
                {{-- GANTI TEKS INI DENGAN MISI RESMI KAMU --}}
                <p class="text-lg text-gray-700 mb-6 leading-relaxed">
                    Meningkatkan kualitas pelayanan informasi publik yang cepat, tepat, dan mudah diakses oleh seluruh pemangku kepentingan di lingkungan IAIN Bone.
                </p>

                <div class="flex flex-col gap-4">
                    {{-- Tujuan --}}
                    <div class="bg-gray-50 rounded-xl p-5">
                        <h6 class="flex items-center gap-2 font-bold text-gray-800 mb-2">
                            <i class="bi bi-check-circle-fill text-green-500"></i> Tujuan
                        </h6>
                        <p class="text-gray-600 text-sm leading-relaxed">Tersedianya layanan informasi publik yang berkualitas dan berorientasi pada kepuasan masyarakat.</p>
                    </div>

                    {{-- Sasaran Strategis --}}
                    <div class="bg-gray-50 rounded-xl p-5">
                        <h6 class="flex items-center gap-2 font-bold text-gray-800 mb-2">
                            <i class="bi bi-bullseye text-blue-500"></i> Sasaran Strategis
                        </h6>
                        <p class="text-gray-600 text-sm leading-relaxed">Meningkatnya indeks keterbukaan informasi publik di lingkungan IAIN Bone setiap tahunnya.</p>
                    </div>

                    {{-- Strategi --}}
                    <div class="bg-gray-50 rounded-xl p-5">
                        <h6 class="flex items-center gap-2 font-bold text-gray-800 mb-3">
                            <i class="bi bi-flag-fill text-amber-500"></i> Strategi
                        </h6>
                        <ul class="space-y-2.5">
                            <li class="flex items-start gap-2 text-sm text-gray-600">
                                <i class="bi bi-caret-right-fill text-hijau-600 mt-1 shrink-0"></i>
                                <span>Mengoptimalkan pengelolaan dan pelayanan informasi publik secara digital.</span>
                            </li>
                            <li class="flex items-start gap-2 text-sm text-gray-600">
                                <i class="bi bi-caret-right-fill text-hijau-600 mt-1 shrink-0"></i>
                                <span>Melaksanakan sosialisasi UU Keterbukaan Informasi Publik secara berkala.</span>
                            </li>
                            <li class="flex items-start gap-2 text-sm text-gray-600">
                                <i class="bi bi-caret-right-fill text-hijau-600 mt-1 shrink-0"></i>
                                <span>Membangun sistem dokumentasi yang terstruktur dan mudah diakses.</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            {{-- ============================================ --}}
            {{-- TAMBAHKAN MISI KEDUA, KETIGA, DLL DI BAWAH SINI --}}
            {{-- (Copy paste saja blok "CARD MISI" di atas, lalu ganti angkanya) --}}
            

        </div>

        {{-- ============================================ --}}
        {{-- TOMBOL NAVIGASI BAWAH --}}
        {{-- ============================================ --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-12">
            <button onclick="history.back()" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition text-center">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </button>
            <a href="{{ url('/') }}" class="px-6 py-3 bg-hijau-600 hover:bg-hijau-700 text-white rounded-lg font-semibold transition text-center">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection