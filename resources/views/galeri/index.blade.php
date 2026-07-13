@extends('layouts.public_app')

@section('title', 'Galeri Foto & Video')

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION (Kompak 1 Baris di Mobile) --}}
{{-- ============================================ --}}
<x-page-hero 
    title="Galeri Foto & Video" 
    icon="image"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Galeri']
    ]" 
/>

{{-- ============================================ --}}
{{-- MAIN CONTENT --}}
{{-- ============================================ --}}
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-12">

    {{-- ============================================ --}}
    {{-- BAGIAN ALBUM FOTO --}}
    {{-- ============================================ --}}
    <div class="mb-10 md:mb-16">
        {{-- Section Header (Font Kecil di Mobile) --}}
        <div class="flex items-center gap-2 md:gap-3 mb-4 md:mb-8">
            <div class="w-1 h-5 md:h-10 bg-gradient-to-b from-hijau-500 to-hijau-700 rounded-full"></div>
            <div>
                <h2 class="text-sm md:text-2xl font-bold text-slate-800">Album Foto</h2>
                <p class="text-slate-500 text-xs md:text-sm hidden md:block">Kumpulan foto dokumentasi kegiatan</p>
            </div>
        </div>

        {{-- Grid Album --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6">
            @forelse($albums as $album)
            <a href="{{ route('galeri.album', $album->slug) }}" class="group block">
                <div class="relative overflow-hidden rounded-lg md:rounded-2xl bg-slate-100 shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                    
                    {{-- Gambar / Placeholder --}}
                    <div class="relative aspect-[4/3] overflow-hidden">
                        @if($album->thumbnail_url)
                            <img src="{{ $album->thumbnail_url }}" 
                                 alt="{{ $album->nama }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-200 to-slate-300 flex items-center justify-center">
                                <svg class="w-10 h-10 md:w-16 md:h-16 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        
                        {{-- Gradient Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-60 group-hover:opacity-80 transition-opacity duration-500"></div>
                        
                        {{-- Jumlah Foto Badge --}}
                        <div class="absolute top-2 right-2 md:top-3 md:right-3 bg-white/90 backdrop-blur-sm text-slate-700 text-[10px] md:text-xs font-semibold px-2 md:px-3 py-1 md:py-1.5 rounded-full flex items-center gap-1">
                            <svg class="w-3 h-3 md:w-3.5 md:h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            {{ $album->photos->count() }} Foto
                        </div>
                        
                        {{-- Info di Bawah --}}
                        <div class="absolute bottom-0 left-0 right-0 p-2 md:p-4 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                            <h3 class="text-white font-bold text-xs md:text-lg leading-tight mb-0.5 md:mb-1 drop-shadow-lg">
                                {{ $album->nama }}
                            </h3>
                            <div class="flex items-center gap-1 text-hijau-300 text-[10px] md:text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-500">
                                <span>Lihat Album</span>
                                <svg class="w-3 h-3 md:w-4 md:h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-slate-500 text-lg">Belum ada album foto yang tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- Divider Cantik --}}
    <div class="relative my-8 md:my-12">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t-2 border-dashed border-slate-200"></div>
        </div>
        <div class="relative flex justify-center">
            <span class="bg-gray-50 px-6 py-2 text-sm font-medium text-slate-400 uppercase tracking-wider">
                ✦
            </span>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- BAGIAN GALERI VIDEO --}}
    {{-- ============================================ --}}
    <div class="mb-8 md:mb-12">
        {{-- Section Header --}}
        <div class="flex items-center gap-2 md:gap-3 mb-4 md:mb-8">
            <div class="w-1 h-5 md:h-10 bg-gradient-to-b from-red-500 to-red-700 rounded-full"></div>
            <div>
                <h2 class="text-sm md:text-2xl font-bold text-slate-800">Galeri Video</h2>
                <p class="text-slate-500 text-xs md:text-sm hidden md:block">Kumpulan video kegiatan dan dokumentasi</p>
            </div>
        </div>

        {{-- Grid Video --}}
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 md:gap-6">
            @forelse($videos as $video)
            <a href="{{ route('galeri.video', $video->slug) }}" class="group block">
                <div class="relative overflow-hidden rounded-lg md:rounded-2xl bg-slate-100 shadow-sm hover:shadow-xl transition-all duration-500 hover:-translate-y-1">
                    
                    {{-- Thumbnail / Placeholder --}}
                    <div class="relative aspect-video overflow-hidden">
                        @if($video->thumbnail)
                            <img src="{{ $video->thumbnail }}" 
                                 alt="{{ $video->judul }}"
                                 class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-slate-800 to-slate-900 flex items-center justify-center">
                                <svg class="w-10 h-10 md:w-16 md:h-16 text-slate-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                </svg>
                            </div>
                        @endif
                        
                        {{-- Dark Overlay --}}
                        <div class="absolute inset-0 bg-black/30 group-hover:bg-black/40 transition-colors duration-500"></div>
                        
                        {{-- Play Button (Animasi Putih ke Merah) --}}
                        <div class="absolute inset-0 flex items-center justify-center">
                            <div class="w-10 h-10 md:w-16 md:h-16 bg-white/90 backdrop-blur-sm rounded-full flex items-center justify-center shadow-lg group-hover:scale-110 group-hover:bg-red-500 transition-all duration-500">
                                <svg class="w-5 h-5 md:w-7 md:h-7 text-slate-800 group-hover:text-white ml-0.5 md:ml-1 transition-colors duration-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M8 5v14l11-7z"/>
                                </svg>
                            </div>
                        </div>
                        
                        {{-- Video Info Label --}}
                        <div class="absolute bottom-0 left-0 right-0 p-2 md:p-4">
                            <div class="bg-black/60 backdrop-blur-sm rounded-md md:rounded-lg px-2 py-1 md:px-3 md:py-2">
                                <h3 class="text-white font-semibold text-[10px] md:text-sm leading-tight truncate">
                                    {{ Str::limit($video->judul, 50) }}
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-16">
                <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-4">
                    <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                    </svg>
                </div>
                <p class="text-slate-500 text-lg">Belum ada video yang tersedia.</p>
            </div>
            @endforelse
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- TOMBOL AKSI --}}
    {{-- ============================================ --}}
    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 md:gap-4 pt-6 md:pt-8 border-t border-slate-200">
        <button onclick="history.back()" 
                class="flex items-center gap-2 px-4 md:px-6 py-2.5 md:py-3 bg-slate-100 text-slate-700 rounded-lg md:rounded-xl text-sm font-medium hover:bg-slate-200 transition-colors duration-300 w-full sm:w-auto justify-center">
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

</section>

@endsection