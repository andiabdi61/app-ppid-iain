@extends('layouts.public_app')

@section('title', 'Struktur Organisasi')

@section('content')

{{-- ============================================ --}}
{{-- ALPINE JS DATA (Mengganti Bootstrap Modal JS) --}}
{{-- ============================================ --}}
<div x-data="{ 
    show: false, 
    content: '' 
}" @keydown.escape.window="show = false">

    {{-- ============================================ --}}
    {{-- HERO SECTION & BREADCRUMB --}}
    {{-- ============================================ --}}
    <div class="bg-putih-100 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <nav aria-label="breadcrumb">
                <ol class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                    <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
                    <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                    <li class="text-hijau-800 font-medium">Struktur Organisasi</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Struktur Organisasi</h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        {{-- Deskripsi Atas --}}
        <div class="text-center mb-12 max-w-3xl mx-auto">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">PPID IAIN BONE</h2>
            {{-- Ganti kalimat di bawah ini sesuai regulasi IAIN Bone kamu --}}
            <p class="text-sm text-gray-500 italic leading-relaxed">
                Struktur Organisasi Pejabat Pengelola Informasi dan Dokumentasi IAIN Bone 
                berdasarkan regulasi internal kampus.
            </p>
        </div>

        {{-- ============================================ --}}
        {{-- KEPALA (PIMPINAN TERTINGGI) --}}
        {{-- ============================================ --}}
        @if($kepalaDinas)
        <div class="flex justify-center mb-12">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 w-full max-w-xs text-center hover:shadow-md transition-shadow">
                <img src="{{ $kepalaDinas->foto_url }}" alt="{{ $kepalaDinas->foto_alt_text }}" 
                     class="w-32 h-32 rounded-full object-cover mx-auto mb-4 shadow-sm" loading="lazy">
                
                <button @click="
                    fetch(`{{ route('pejabat.showModal', ['pejabat' => $kepalaDinas->id]) }}`)
                    .then(res => res.text())
                    .then(html => { content = html; show = true; })
                " class="text-lg font-bold text-gray-800 hover:text-hijau-700 transition cursor-pointer">
                    {{ $kepalaDinas->nama }}
                </button>
                <p class="text-sm text-gray-500 mt-1">{{ $kepalaDinas->jabatan }}</p>
            </div>
        </div>
        @endif

        {{-- ============================================ --}}
        {{-- BIDANG (GRID 3 KOLOM) --}}
        {{-- ============================================ --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-16">
            @foreach($bidangs as $bidang)
            <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex flex-col h-full">
                
                {{-- Nama Bidang --}}
                <h3 class="text-center font-bold text-hijau-700 mb-4 truncate" title="{{ $bidang->nama }}">
                    <a href="{{ route('bidang-sektoral.show', $bidang->slug) }}" class="hover:underline">
                        {{ $bidang->nama }}
                    </a>
                </h3>

                {{-- Kepala Bidang --}}
                @if($bidang->kepala)
                <div class="bg-gray-50 rounded-lg p-3 mb-4 flex items-center gap-3">
                    <img src="{{ $bidang->kepala->foto_url }}" alt="{{ $bidang->kepala->foto_alt_text }}" 
                         class="w-12 h-12 rounded-full object-cover shrink-0" loading="lazy">
                    <div class="overflow-hidden">
                        <button @click="
                            fetch(`{{ route('pejabat.showModal', ['pejabat' => $bidang->kepala->id]) }}`)
                            .then(res => res.text())
                            .then(html => { content = html; show = true; })
                        " class="block text-sm font-bold text-gray-800 hover:text-hijau-700 truncate w-full text-left cursor-pointer">
                            {{ $bidang->kepala->nama }}
                        </button>
                        <p class="text-xs text-gray-500 truncate">{{ $bidang->kepala->jabatan }}</p>
                    </div>
                </div>
                @endif

                {{-- Daftar Seksi --}}
                @if($bidang->seksis->count() > 0)
                <div class="border-t border-gray-100 pt-4 mt-auto space-y-2">
                    @foreach($bidang->seksis as $seksi)
                    <div class="bg-gray-50 rounded-lg p-2.5 flex items-center gap-3">
                        @if($seksi->kepala)
                            <img src="{{ $seksi->kepala->foto_url }}" alt="{{ $seksi->kepala->foto_alt_text }}" 
                                 class="w-9 h-9 rounded-full object-cover shrink-0" loading="lazy">
                            <div class="overflow-hidden">
                                <button @click="
                                    fetch(`{{ route('pejabat.showModal', ['pejabat' => $seksi->kepala->id]) }}`)
                                    .then(res => res.text())
                                    .then(html => { content = html; show = true; })
                                " class="block text-xs font-bold text-gray-800 hover:text-hijau-700 truncate w-full text-left cursor-pointer">
                                    {{ $seksi->kepala->nama }}
                                </button>
                                <p class="text-xs text-gray-500 truncate">{{ $seksi->kepala->jabatan }}</p>
                            </div>
                        @else
                            <div class="w-9 h-9 bg-gray-200 rounded-full flex items-center justify-center shrink-0">
                                <i class="bi bi-person text-gray-400"></i>
                            </div>
                            <div>
                                <p class="text-xs font-bold text-gray-600">{{ $seksi->nama_seksi }}</p>
                                <p class="text-xs text-gray-400">Belum ditugaskan</p>
                            </div>
                        @endif
                    </div>
                    @endforeach
                </div>
                @endif
            </div>
            @endforeach
        </div>

        @if(isset($uptds) && count($uptds) > 0)
        <hr class="my-10 border-gray-200">
        
        {{-- ============================================ --}}
        {{-- UPTD (GRID 1 KOLOM TENGAH) --}}
        {{-- ============================================ --}}
        <div class="max-w-4xl mx-auto mb-16">
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Unit Pelaksana Teknis</h2>
            <p class="text-sm text-gray-500 text-center mb-8 italic">
                {{-- Ganti kalimat ini sesuai regulasi kamu --}}
                Struktur Unit Pelaksana Teknis Dinas
            </p>

            <div class="space-y-6">
                @foreach($uptds as $uptd)
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-6">
                    <h3 class="text-center font-bold text-hijau-700 mb-4 truncate" title="{{ $uptd->nama }}">
                        <a href="{{ route('bidang-sektoral.show', $uptd->slug) }}" class="hover:underline">{{ $uptd->nama }}</a>
                    </h3>

                    @if($uptd->kepala)
                    <div class="flex justify-center mb-4">
                        <div class="bg-gray-50 rounded-lg p-3 flex items-center gap-3 w-full max-w-sm">
                            <img src="{{ $uptd->kepala->foto_url }}" alt="{{ $uptd->kepala->foto_alt_text }}" 
                                 class="w-12 h-12 rounded-full object-cover shrink-0" loading="lazy">
                            <div class="overflow-hidden">
                                <button @click="
                                    fetch(`{{ route('pejabat.showModal', ['pejabat' => $uptd->kepala->id]) }}`)
                                    .then(res => res.text())
                                    .then(html => { content = html; show = true; })
                                " class="block text-sm font-bold text-gray-800 hover:text-hijau-700 truncate w-full text-left cursor-pointer">
                                    {{ $uptd->kepala->nama }}
                                </button>
                                <p class="text-xs text-gray-500 truncate">{{ $uptd->kepala->jabatan }}</p>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($uptd->seksis->count() > 0)
                    <div class="border-t border-gray-100 pt-4 grid grid-cols-1 md:grid-cols-3 gap-3">
                        @foreach($uptd->seksis as $seksi)
                        <div class="bg-gray-50 rounded-lg p-3 flex items-center gap-3">
                            @if($seksi->kepala)
                                <img src="{{ $seksi->kepala->foto_url }}" alt="{{ $seksi->kepala->foto_alt_text }}" 
                                     class="w-10 h-10 rounded-full object-cover shrink-0" loading="lazy">
                                <div class="overflow-hidden">
                                    <button @click="
                                        fetch(`{{ route('pejabat.showModal', ['pejabat' => $seksi->kepala->id]) }}`)
                                        .then(res => res.text())
                                        .then(html => { content = html; show = true; })
                                    " class="block text-xs font-bold text-gray-800 hover:text-hijau-700 truncate w-full text-left cursor-pointer">
                                        {{ $seksi->kepala->nama }}
                                    </button>
                                    <p class="text-xs text-gray-500 truncate">{{ $seksi->kepala->jabatan }}</p>
                                </div>
                            @else
                                <div class="w-10 h-10 bg-gray-200 rounded-full flex items-center justify-center shrink-0">
                                    <i class="bi bi-person text-gray-400"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-600">{{ $seksi->nama_seksi }}</p>
                                    <p class="text-xs text-gray-400">Belum ditugaskan</p>
                                </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

        @if(isset($cabangDinas) && count($cabangDinas) > 0)
        <hr class="my-10 border-gray-200">
        
        {{-- ============================================ --}}
        {{-- CABANG DINAS (GRID 4 KOLOM) --}}
        {{-- ============================================ --}}
        <div>
            <h2 class="text-2xl font-bold text-gray-800 text-center mb-2">Cabang Dinas</h2>
            <p class="text-sm text-gray-500 text-center mb-8 italic">
                {{-- Ganti kalimat ini sesuai regulasi kamu --}}
                Struktur Cabang Dinas
            </p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($cabangDinas as $cabang)
                <div class="bg-white rounded-xl border border-gray-200 shadow-sm p-5 flex flex-col h-full">
                    <h3 class="text-center font-bold text-hijau-700 mb-4 truncate" title="{{ $cabang->nama }}">
                        <a href="{{ route('bidang-sektoral.show', $cabang->slug) }}" class="hover:underline">{{ $cabang->nama }}</a>
                    </h3>

                    @if($cabang->kepala)
                    <div class="bg-gray-50 rounded-lg p-3 mb-4 flex items-center gap-3">
                        <img src="{{ $cabang->kepala->foto_url }}" alt="{{ $cabang->kepala->foto_alt_text }}" 
                             class="w-10 h-10 rounded-full object-cover shrink-0" loading="lazy">
                        <div class="overflow-hidden">
                            <button @click="
                                fetch(`{{ route('pejabat.showModal', ['pejabat' => $cabang->kepala->id]) }}`)
                                .then(res => res.text())
                                .then(html => { content = html; show = true; })
                            " class="block text-xs font-bold text-gray-800 hover:text-hijau-700 truncate w-full text-left cursor-pointer">
                                {{ $cabang->kepala->nama }}
                            </button>
                            <p class="text-xs text-gray-500 truncate">{{ $cabang->kepala->jabatan }}</p>
                        </div>
                    </div>
                    @endif

                    @if($cabang->seksis->count() > 0)
                    <div class="border-t border-gray-100 pt-4 mt-auto space-y-2">
                        @foreach($cabang->seksis as $seksi)
                        <div class="bg-gray-50 rounded-lg p-2.5 flex items-center gap-3">
                            @if($seksi->kepala)
                                <img src="{{ $seksi->kepala->foto_url }}" alt="{{ $seksi->kepala->foto_alt_text }}" 
                                     class="w-9 h-9 rounded-full object-cover shrink-0" loading="lazy">
                                <div class="overflow-hidden">
                                    <button @click="
                                        fetch(`{{ route('pejabat.showModal', ['pejabat' => $seksi->kepala->id]) }}`)
                                        .then(res => res.text())
                                        .then(html => { content = html; show = true; })
                                    " class="block text-xs font-bold text-gray-800 hover:text-hijau-700 truncate w-full text-left cursor-pointer">
                                        {{ $seksi->kepala->nama }}
                                    </button>
                                    <p class="text-xs text-gray-500 truncate">{{ $seksi->kepala->jabatan }}</p>
                                </div>
                            @else
                                <div class="w-9 h-9 bg-gray-200 rounded-full flex items-center justify-center shrink-0">
                                    <i class="bi bi-person text-gray-400"></i>
                                </div>
                                <div>
                                    <p class="text-xs font-bold text-gray-600">{{ $seksi->nama_seksi }}</p>
                                    <p class="text-xs text-gray-400">Belum ditugaskan</p>
                                </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif

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

    {{-- ============================================ --}}
    {{-- MODAL ALPINE JS (Pengganti Bootstrap Modal) --}}
    {{-- ============================================ --}}
    <div x-show="show" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
         @click="show = false">
        
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto relative"
             @click.stop>
            
            {{-- Tombol Close --}}
            <button @click="show = false" 
                    class="absolute top-4 right-4 z-10 w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-full transition">
                <i class="bi bi-x-lg text-gray-600"></i>
            </button>

            {{-- Tempat konten di-load dari Route --}}
            <div x-html="content" class="p-6"></div>
        </div>
    </div>

</div>

@endsection