@extends('layouts.public_app')

@section('title', 'Album: ' . $album->nama)

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
                <li class="text-white font-medium">{{ Str::limit($album->nama, 50) }}</li>
            </ol>
        </nav>

        {{-- Title (1 Baris di Mobile) --}}
        <div class="flex items-center gap-2 md:gap-4">
            <div class="p-1.5 md:p-3 bg-hijau-500/20 rounded-lg md:rounded-xl border border-hijau-400/30 shrink-0">
                <svg class="w-5 h-5 md:w-8 md:h-8 text-hijau-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </div>
            <div class="min-w-0"> {{-- min-w-0 agar teks panjang tidak bikin layout bug di HP --}}
                <h1 class="text-sm md:text-3xl lg:text-4xl font-bold text-white leading-tight truncate">{{ $album->nama }}</h1>
                @if($album->deskripsi)
                    <p class="text-hijau-200 mt-0.5 md:mt-1 max-w-2xl text-xs md:text-base hidden md:block">{{ $album->deskripsi }}</p>
                @endif
            </div>
        </div>
    </div>
</section>

{{-- ============================================ --}}
{{-- GRID FOTO (Dengan Padding Hack Anti Bug) --}}
{{-- ============================================ --}}
<section class="bg-gray-50 py-6 md:py-12">
    <div class="max-w-7xl mx-auto px-3 sm:px-4 md:px-6 lg:px-8">
        
        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-2 sm:gap-3 md:gap-4 lg:gap-5">
            @forelse($album->photos as $photo)
                @php
                    $imageUrl = null;
                    if (file_exists(public_path('storage')) && $photo->file_path && Storage::disk('public')->exists($photo->file_path)) {
                        $imageUrl = asset('storage/' . $photo->file_path);
                    }
                @endphp
                
                @if($imageUrl)
                    <a href="{{ $imageUrl }}"
                       class="glightbox group block relative bg-white rounded-lg md:rounded-xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden"
                       data-gallery="gallery-album"
                       data-title="{{ $photo->judul ?: Str::limit($photo->file_name, 25) }}"
                       data-description="{{ $photo->deskripsi }}">
                        
                        {{-- DIV PEMAKSA RASIO 1:1 --}}
                        <div class="w-full overflow-hidden" style="padding-bottom: 100%; position: relative;">
                            <img src="{{ $imageUrl }}" 
                                 style="position: absolute; inset: 0; width: 100%; height: 100%; object-fit: cover;"
                                 class="group-hover:scale-110 transition-transform duration-700" 
                                 alt="{{ $photo->judul ?: $photo->file_name }}">
                        </div>
                        
                        {{-- Overlay Hitam & Ikon Zoom saat Hover --}}
                        <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-colors duration-300 flex items-center justify-center z-10">
                            <div class="w-8 h-8 md:w-12 md:h-12 bg-white/90 rounded-full flex items-center justify-center scale-50 opacity-0 group-hover:scale-100 group-hover:opacity-100 transition-all duration-300 shadow-lg">
                                <svg class="w-4 h-4 md:w-6 md:h-6 text-slate-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                </svg>
                            </div>
                        </div>
                    </a>
                @else
                    {{-- Placeholder jika file rusak/hilang --}}
                    <div class="bg-white rounded-lg md:rounded-xl flex flex-col items-center justify-center gap-2 border-2 border-dashed border-slate-200" style="padding-bottom: 100%; position: relative;">
                        <div class="absolute inset-0 flex flex-col items-center justify-center">
                            <svg class="w-8 h-8 md:w-12 md:h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            <span class="text-[10px] md:text-xs text-slate-400 font-medium hidden sm:block">File tidak ditemukan</span>
                        </div>
                    </div>
                @endif
            @empty
                <div class="col-span-full text-center py-16 md:py-20">
                    <div class="inline-flex items-center justify-center w-16 h-16 md:w-20 md:h-20 bg-white rounded-full mb-4 shadow-sm">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <p class="text-slate-500 text-base md:text-lg font-medium">Album ini belum memiliki foto.</p>
                </div>
            @endforelse
        </div>

        {{-- Tombol Kembali --}}
        <div class="flex justify-center mt-8 md:mt-12">
            <a href="{{ route('galeri.index') }}" 
               class="inline-flex items-center gap-2 px-4 md:px-6 py-2.5 md:py-3 bg-white text-slate-700 rounded-lg md:rounded-xl text-sm font-medium hover:bg-gray-100 transition-colors duration-300 shadow-sm border border-slate-200">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Semua Galeri
            </a>
        </div>

    </div>
</section>

@endsection

@push('scripts')
<script>
    // Inisialisasi GLightbox
    const lightbox = GLightbox({
        selector: '.glightbox',
        touchNavigation: true,
        loop: true,
    });
</script>
@endpush