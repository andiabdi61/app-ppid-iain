@extends('layouts.public_app')

@section('title', 'Profil Unit & Organisasi')

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION & BREADCRUMB --}}
{{-- ============================================ --}}
<div class="bg-putih-100 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <nav aria-label="breadcrumb">
            <ol class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
                <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                <li class="text-hijau-800 font-medium">Profil Unit & Organisasi</li>
            </ol>
        </nav>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Profil Unit & Organisasi</h1>
        <p class="text-gray-600 mt-2">Struktur unit kerja, fakultas, biro, dan lembaga di lingkungan IAIN Bone.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    @php
        // Cek apakah data memiliki variasi tipe atau semuanya kosong/null
        $hasTypes = $bidangs->pluck('tipe')->filter()->unique()->count() > 0;
        
        // Peta ikon (bisa ditambah jika ada tipe lain seperti 'Lembaga', 'UPT', dll)
        $iconMap = [
            'fakultas' => 'bi-mortarboard-fill',
            'biro' => 'bi-building-fill',
            'lembaga' => 'bi-puzzle-fill',
            'upt' => 'bi-gear-wide-connected',
            'bidang' => 'bi-briefcase-fill',
            'uptd' => 'bi-building-gear',
            'cabang_dinas' => 'bi-geo-alt-fill',
        ];
    @endphp

    {{-- ============================================ --}}
    {{-- JIKA ADA PEMBAGIAN TIPE (Fakultas, Biro, Lembaga) --}}
    {{-- ============================================ --}}
    @if($hasTypes)
        @foreach($bidangs->groupBy('tipe') as $tipe => $units)
            
            <div @if(!$loop->first) class="mt-16 pt-10 border-t border-gray-200" @endif>
                
                {{-- Header Grup (Nama tipe otomatis diambil dari DB) --}}
                <div class="text-center mb-10">
                    <div class="inline-flex items-center justify-center w-14 h-14 bg-hijau-100 rounded-2xl mb-4">
                        <i class="bi {{ $iconMap[Str::lower($tipe)] ?? 'bi-folder-fill' }} text-2xl text-hijau-700"></i>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">{{ ucfirst($tipe) }}</h2>
                    <p class="text-sm text-gray-500">Daftar unit di bawah {{ ucfirst($tipe) }} IAIN Bone.</p>
                </div>

                {{-- Grid Kartu Unit --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($units as $unit)
                        <a href="{{ route('bidang-sektoral.show', $unit->slug) }}" 
                           class="group bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-hijau-300 transition-all duration-300 flex flex-col h-full">
                            
                            <div class="p-6 flex flex-col flex-1">
                                <h3 class="text-lg font-bold text-gray-800 group-hover:text-hijau-700 transition mb-3 line-clamp-2">
                                    {{ $unit->nama }}
                                </h3>
                                
                                @if($unit->tupoksi)
                                    <p class="text-sm text-gray-500 flex-1 mb-4 line-clamp-3">
                                        {{ Str::limit(strip_tags($unit->tupoksi), 120) }}
                                    </p>
                                @else
                                    <p class="text-sm text-gray-400 flex-1 mb-4 italic">Belum ada deskripsi tersedia.</p>
                                @endif
                                
                                <div class="mt-auto pt-4 border-t border-gray-100">
                                    @if($unit->kepala)
                                        <p class="text-xs text-gray-500 mb-3">
                                            <span class="font-semibold text-gray-700">Kepala:</span> {{ $unit->kepala->nama }}
                                        </p>
                                    @else
                                        <p class="text-xs text-gray-400 mb-3">Kepala: <span class="italic">Belum ditugaskan</span></p>
                                    @endif
                                    
                                    <span class="inline-flex items-center gap-1 text-sm font-semibold text-hijau-600 group-hover:text-hijau-700">
                                        Lihat Profil <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                                    </span>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>

            </div>
        @endforeach

    {{-- ============================================ --}}
    {{-- JIKA TIDAK ADA TIPE (Tampil Rata Semua) --}}
    {{-- ============================================ --}}
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($bidangs as $unit)
                <a href="{{ route('bidang-sektoral.show', $unit->slug) }}" 
                   class="group bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-hijau-300 transition-all duration-300 flex flex-col h-full">
                    
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-lg font-bold text-gray-800 group-hover:text-hijau-700 transition mb-3 line-clamp-2">
                            {{ $unit->nama }}
                        </h3>
                        
                        @if($unit->tupoksi)
                            <p class="text-sm text-gray-500 flex-1 mb-4 line-clamp-3">
                                {{ Str::limit(strip_tags($unit->tupoksi), 120) }}
                            </p>
                        @else
                            <p class="text-sm text-gray-400 flex-1 mb-4 italic">Belum ada deskripsi tersedia.</p>
                        @endif
                        
                        <div class="mt-auto pt-4 border-t border-gray-100">
                            @if($unit->kepala)
                                <p class="text-xs text-gray-500 mb-3">
                                    <span class="font-semibold text-gray-700">Kepala:</span> {{ $unit->kepala->nama }}
                                </p>
                            @else
                                <p class="text-xs text-gray-400 mb-3">Kepala: <span class="italic">Belum ditugaskan</span></p>
                            @endif
                            
                            <span class="inline-flex items-center gap-1 text-sm font-semibold text-hijau-600 group-hover:text-hijau-700">
                                Lihat Profil <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
    @endif

    {{-- ============================================ --}}
    {{-- EMPTY STATE --}}
    {{-- ============================================ --}}
    @if($bidangs->isEmpty())
        <div class="mt-10 bg-blue-50 border border-blue-200 text-blue-700 rounded-xl p-8 text-center">
            <i class="bi bi-inbox text-4xl mb-3 block"></i>
            <h4 class="text-lg font-bold mb-1">Data Belum Tersedia</h4>
            <p class="text-sm">Belum ada unit organisasi yang aktif untuk ditampilkan saat ini.</p>
        </div>
    @endif

    {{-- ============================================ --}}
    {{-- TOMBOL NAVIGASI BAWAH --}}
    {{-- ============================================ --}}
    <hr class="my-12 border-gray-200">
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <button onclick="history.back()" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition text-center">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </button>
        <a href="{{ url('/') }}" class="px-6 py-3 bg-hijau-600 hover:bg-hijau-700 text-white rounded-lg font-semibold transition text-center">
            Kembali ke Beranda
        </a>
    </div>
</div>

@endsection