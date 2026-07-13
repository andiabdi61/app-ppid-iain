@extends('layouts.public_app')

@section('title', 'Video: ' . $video->judul)

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION (Kompak 1 Baris di Mobile) --}}
{{-- ============================================ --}}
<section class="relative bg-gradient-to-br from-hijau-900 via-emerald-900 to-gray-900 py-3 md:py-16 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-hijau-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        {{-- Breadcrumb (HIDDEN di Mobile) --}}
        <nav aria-label="breadcrumb" class="mb-4 md:mb-6 hidden md:block">
            <ol class="flex items-center gap-2 text-sm flex-wrap">
                <li>
                    <a href="{{ url('/') }}" class="text-hijau-300 hover:text-white transition-colors flex items-center gap-1">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
                        Beranda
                    </a>
                </li>
                <li>
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </li>
                <li>
                    <a href="{{ route('galeri.index') }}" class="text-hijau-300 hover:text-white transition-colors">Galeri</a>
                </li>
                <li>
                    <svg class="w-4 h-4 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </li>
                <li class="text-white font-medium">{{ Str::limit($video->judul, 50) }}</li>
            </ol>
        </nav>

        {{-- Title (1 Baris di Mobile) --}}
        <div class="flex items-center gap-2 md:gap-4">
            <div class="p-1.5 md:p-3 bg-red-500/20 rounded-lg md:rounded-xl border border-red-400/30 shrink-0">
                <svg class="w-5 h-5 md:w-8 md:h-8 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                </svg>
            </div>
            <div class="min-w-0">
                <h1 class="text-sm md:text-3xl lg:text-4xl font-bold text-white leading-tight truncate">{{ $video->judul }}</h1>
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- VIDEO PLAYER & DESKRIPSI --}}
{{-- ============================================ --}}
<div class="bg-gray-50">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-12">
        
        {{-- CSS Hack Untuk Memaksa Iframe Youtube/Drive Full Responsive --}}
        <style>
            .video-responsive {
                position: relative;
                padding-bottom: 56.25%; /* Rasio 16:9 */
                height: 0;
                overflow: hidden;
                border-radius: 0.5rem; /* rounded-lg untuk mobile */
                background-color: #0f172a; /* slate-900 */
                box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1); /* shadow lebih kecil di default */
            }
            .video-responsive iframe {
                position: absolute;
                top: 0;
                left: 0;
                width: 100% !important;
                height: 100% !important;
                border: 0;
            }
            @media (min-width: 768px) {
                .video-responsive {
                    border-radius: 1rem; /* rounded-2xl untuk desktop */
                    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25); /* shadow besar di desktop */
                }
            }
        </style>

        {{-- Video Wrapper --}}
        <div class="video-responsive">
            {!! $video->embed_code !!}
        </div>
        
        {{-- Deskripsi Video --}}
        @if($video->deskripsi)
        <div class="mt-6 md:mt-8 bg-white border border-slate-200 rounded-lg md:rounded-2xl p-4 sm:p-6 md:p-8 shadow-sm">
            <h3 class="text-base md:text-lg font-bold text-slate-800 mb-2 md:mb-3 flex items-center gap-2">
                <div class="w-1 h-5 md:h-6 bg-hijau-600 rounded-full"></div>
                Deskripsi Video
            </h3>
            <div class="prose max-w-none text-slate-600 text-sm md:text-base">
                {!! $video->deskripsi !!}
            </div>
        </div>
        @endif

        {{-- Tombol Aksi --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 md:gap-4 mt-8 md:mt-10 pt-6 md:pt-8 border-t border-slate-200">
            <button onclick="history.back()" 
                    class="flex items-center gap-2 px-4 md:px-6 py-2.5 md:py-3 bg-white text-slate-700 rounded-lg md:rounded-xl text-sm font-medium hover:bg-gray-100 transition-colors duration-300 shadow-sm border border-slate-200 w-full sm:w-auto justify-center">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </button>
            <a href="{{ url('/') }}" 
               class="flex items-center gap-2 px-4 md:px-6 py-2.5 md:py-3 bg-hijau-600 text-white rounded-lg md:rounded-xl text-sm font-medium hover:bg-hijau-700 shadow-lg shadow-hijau-600/30 hover:shadow-hijau-600/50 transition-all duration-300 w-full sm:w-auto justify-center">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

    </div>
</div>

@endsection