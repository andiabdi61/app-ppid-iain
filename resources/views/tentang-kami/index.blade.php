@extends('layouts.public_app')

@section('title', 'Tentang Kami')

@section('content')

{{-- ============================================ --}}
{{-- BREADCRUMB --}}
{{-- ============================================ --}}
<div class="bg-putih-100 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <nav aria-label="breadcrumb">
            <ol class="flex items-center gap-2 text-sm text-gray-500">
                <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
                <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                <li class="text-hijau-800 font-medium">Tentang Kami</li>
            </ol>
        </nav>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    
    <div class="text-center mb-12">
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Tentang PPID IAIN BONE</h1>
        <p class="text-gray-600 max-w-2xl mx-auto">Pelajari profil, arah kebijakan, struktur organisasi, dan siapa saja yang bertanggung jawab di balik layanan informasi publik kampus ini.</p>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 max-w-4xl mx-auto">
        
        {{-- Card 1: Visi, Misi & Tujuan --}}
        <a href="{{ route('tentang-kami.visi-misi') }}" class="group bg-white rounded-2xl border border-gray-200 p-6 hover:border-hijau-500 hover:shadow-lg transition-all duration-300 flex flex-col">
            <div class="w-14 h-14 bg-hijau-100 group-hover:bg-hijau-600 rounded-2xl flex items-center justify-center mb-5 transition-colors duration-300">
                <i class="bi bi-bullseye text-2xl text-hijau-600 group-hover:text-white transition-colors duration-300"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-hijau-700 transition">Visi, Misi & Tujuan</h3>
            <p class="text-sm text-gray-500 flex-1">Pahami arah dan tujuan strategis PPID dalam mewujudkan keterbukaan informasi.</p>
            <div class="mt-4 text-sm font-semibold text-hijau-600 flex items-center gap-1">
                Lihat Detail <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </div>
        </a>

        {{-- Card 2: Struktur Organisasi --}}
        <a href="{{ route('tentang-kami.struktur-organisasi') }}" class="group bg-white rounded-2xl border border-gray-200 p-6 hover:border-hijau-500 hover:shadow-lg transition-all duration-300 flex flex-col">
            <div class="w-14 h-14 bg-blue-100 group-hover:bg-blue-600 rounded-2xl flex items-center justify-center mb-5 transition-colors duration-300">
                <i class="bi bi-diagram-3 text-2xl text-blue-600 group-hover:text-white transition-colors duration-300"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-hijau-700 transition">Struktur Organisasi</h3>
            <p class="text-sm text-gray-500 flex-1">Pelajari bagan dan susunan organisasi pengelola informasi publik.</p>
            <div class="mt-4 text-sm font-semibold text-hijau-600 flex items-center gap-1">
                Lihat Detail <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </div>
        </a>

        {{-- Card 3: Tugas & Fungsi --}}
        <a href="{{ route('tentang-kami.tugas-fungsi') }}" class="group bg-white rounded-2xl border border-gray-200 p-6 hover:border-hijau-500 hover:shadow-lg transition-all duration-300 flex flex-col">
            <div class="w-14 h-14 bg-amber-100 group-hover:bg-amber-600 rounded-2xl flex items-center justify-center mb-5 transition-colors duration-300">
                <i class="bi bi-clipboard-check text-2xl text-amber-600 group-hover:text-white transition-colors duration-300"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-hijau-700 transition">Tugas & Fungsi</h3>
            <p class="text-sm text-gray-500 flex-1">Ketahui peran, tugas pokok, dan fungsi layanan PPID IAIN Bone.</p>
            <div class="mt-4 text-sm font-semibold text-hijau-600 flex items-center gap-1">
                Lihat Detail <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </div>
        </a>

        {{-- Card 4: Profil Pejabat --}}
        <a href="{{ route('tentang-kami.profil-pejabat') }}" class="group bg-white rounded-2xl border border-gray-200 p-6 hover:border-hijau-500 hover:shadow-lg transition-all duration-300 flex flex-col">
            <div class="w-14 h-14 bg-purple-100 group-hover:bg-purple-600 rounded-2xl flex items-center justify-center mb-5 transition-colors duration-300">
                <i class="bi bi-people text-2xl text-purple-600 group-hover:text-white transition-colors duration-300"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-hijau-700 transition">Profil Pejabat</h3>
            <p class="text-sm text-gray-500 flex-1">Kenali para pejabat dan petugas yang bertanggung jawab atas pelayanan informasi.</p>
            <div class="mt-4 text-sm font-semibold text-hijau-600 flex items-center gap-1">
                Lihat Detail <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </div>
        </a>

    </div>
</div>

@endsection