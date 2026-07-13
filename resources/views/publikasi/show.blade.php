@extends('layouts.public_app')

@section('title', $dokumen->judul)

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 md:pt-8 pb-12">
    
    {{-- ============================================ --}}
    {{-- BREADCRUMB & JUDUL --}}
    {{-- ============================================ --}}
    <nav aria-label="breadcrumb">
        <ol class="flex items-center gap-2 text-sm text-gray-500 mb-4 overflow-hidden whitespace-nowrap">
            <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
            <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
            <li><a href="{{ route('publikasi.index') }}" class="hover:text-hijau-700 transition">Publikasi</a></li>
            @if($dokumen->category)
                <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                <li><a href="{{ route('publikasi.index', ['kategori' => $dokumen->category->slug]) }}" class="hover:text-hijau-700 transition">{{ $dokumen->category->nama }}</a></li>
            @endif
            <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
            <li class="text-hijau-800 font-medium truncate max-w-[200px]">{{ Str::limit($dokumen->judul, 30) }}</li>
        </ol>
    </nav>
    
    <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-8 leading-tight">{{ $dokumen->judul }}</h1>

    {{-- ============================================ --}}
    {{-- KONTEN 2 KOLOM --}}
    {{-- ============================================ --}}
    <div class="flex flex-col lg:flex-row gap-8">
        
        {{-- KOLOM KIRI: ISI KONTEN --}}
                {{-- KOLOM KIRI: ISI KONTEN --}}
        <div class="w-full lg:w-2/3 min-w-0">
            @if($dokumen->deskripsi)
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-6 md:p-8 text-gray-700 text-sm leading-relaxed [&_p]:mb-4 [&_ul]:list-disc [&_ul]:pl-6 [&_ol]:list-decimal [&_ol]:pl-6 [&_li]:mb-2">
                    {!! nl2br(e($dokumen->deskripsi)) !!}
                </div>
            @else
                {{-- TAMPILAN JIKA DESKRIPSI KOSONG --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm p-10 md:p-16 text-center">
                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="bi bi-file-earmark-text text-4xl text-gray-300"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-700 mb-2">Tidak Ada Deskripsi</h3>
                    <p class="text-sm text-gray-500 max-w-md mx-auto">Dokumen ini tidak dilengkapi dengan deskripsi isi. Silakan unduh file langsung untuk melihat isinya.</p>
                </div>
            @endif
        </div>

        {{-- KOLOM KANAN: SIDEBAR DETAIL & UNDUH --}}
        <div class="w-full lg:w-1/3">
            <div class="lg:sticky lg:top-24 space-y-6">
                
                {{-- Kartu Detail Dokumen --}}
                <div class="bg-white rounded-2xl border border-gray-100 shadow-sm overflow-hidden">
                    <div class="px-5 py-4 border-b border-gray-100 bg-gray-50">
                        <h4 class="text-sm font-bold text-gray-800 flex items-center gap-2">
                            <i class="bi bi-info-circle-fill text-hijau-700"></i> Detail Dokumen
                        </h4>
                    </div>
                    
                    <div class="p-5 space-y-4 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Kategori</span>
                            @if($dokumen->category)
                                <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-medium {{ $dokumen->category->frontend_badge_class ?? 'bg-hijau-100 text-hijau-800' }}">
                                    {{ $dokumen->category->nama }}
                                </span>
                            @else
                                <span class="text-gray-400">-</span>
                            @endif
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-500">Dipublikasi</span>
                            <span class="font-medium text-gray-800">{{ $dokumen->tanggal_publikasi ? $dokumen->tanggal_publikasi->translatedFormat('d F Y') : '-' }}</span>
                        </div>
                        
                        <div class="flex justify-between">
                            <span class="text-gray-500">Dilihat</span>
                            <span class="font-medium text-gray-800">{{ $dokumen->hits }} kali</span>
                        </div>

                        @if($dokumen->file_path && Storage::disk('public')->exists($dokumen->file_path))
                            <div class="border-t border-gray-100 pt-4 space-y-4">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Format File</span>
                                    <span class="font-medium text-gray-800 uppercase">{{ $dokumen->file_tipe }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Ukuran File</span>
                                    <span class="font-medium text-gray-800">{{ number_format(Storage::disk('public')->size($dokumen->file_path) / 1024, 1) }} KB</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Tombol Unduh --}}
                @if($dokumen->file_path)
                    <a href="{{ asset('storage/' . $dokumen->file_path) }}" target="_blank" 
                       class="flex items-center justify-center gap-2 bg-hijau-600 hover:bg-hijau-700 text-white px-6 py-4 rounded-xl font-bold text-base transition shadow-md hover:shadow-lg w-full">
                        <i class="bi bi-download text-xl"></i> Unduh Dokumen
                    </a>
                @endif

            </div>
        </div>

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

@endsection