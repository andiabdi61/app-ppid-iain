@extends('layouts.public_app')

@section('title', 'Detail Profil ' . $pejabat->nama)

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    {{-- ============================================ --}}
    {{-- BREADCRUMB --}}
    {{-- ============================================ --}}
    <nav aria-label="breadcrumb">
        <ol class="flex items-center gap-2 text-sm text-gray-500 mb-8">
            <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
            <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
            <li><a href="{{ route('tentang-kami.profil-pejabat') }}" class="hover:text-hijau-700 transition">Profil Pejabat</a></li>
            <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
            <li class="text-hijau-800 font-medium">{{ $pejabat->nama }}</li>
        </ol>
    </nav>

    {{-- ============================================ --}}
    {{-- KONTEN UTAMA --}}
    {{-- ============================================ --}}
    <div class="flex justify-center">
        <div class="w-full max-w-4xl bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            <div class="flex flex-col md:flex-row">
                
                {{-- KOLOM FOTO (Kiri) --}}
                <div class="w-full md:w-1/3 bg-gray-100 flex items-center justify-center p-6 md:p-0">
                    @php
                        $media = $pejabat->getFirstMedia('foto_pejabat');
                        $imageExists = false;
                        if ($media) {
                            $mediaPath = $media->getPath();
                            if (file_exists($mediaPath)) {
                                $imageExists = true;
                            }
                        }
                    @endphp

                    @if($imageExists)
                        <picture class="w-full h-full block">
                            {{-- Menggunakan getSrcset untuk gambar responsif (WebP) --}}
                            <source srcset="{{ $media->getSrcset('webp-responsive') }}" type="image/webp">
                            {{-- Gambar fallback (JPG/PNG) --}}
                            <img src="{{ $media->getUrl('thumb') }}" 
                                 alt="Foto {{ $pejabat->nama }}"
                                 class="w-full h-full object-cover md:rounded-l-2xl"
                                 style="min-height: 300px;"
                                 loading="lazy">
                        </picture>
                    @else
                        {{-- Gambar placeholder jika file fisik tidak ditemukan --}}
                        <img src="https://placehold.co/400x400/E5E7EB/6B7280?text=No+Photo" 
                             alt="No Photo"
                             class="w-full h-full object-cover md:rounded-l-2xl"
                             style="min-height: 300px;"
                             loading="lazy">
                    @endif
                </div>

                {{-- KOLOM DETAIL (Kanan) --}}
                <div class="w-full md:w-2/3 p-6 md:p-8 flex flex-col justify-center">
                    <h3 class="text-2xl font-bold text-gray-800 mb-1">{{ $pejabat->nama }}</h3>
                    <p class="text-hijau-700 font-semibold mb-6">{{ $pejabat->jabatan }}</p>
                    
                    <div class="border-t border-gray-100 pt-5">
                        @if($pejabat->deskripsi_singkat)
                            {{-- Trik [&_p]:mb-3 agar paragraf dari WYSIWYG editor tidak nempel --}}
                            <div class="text-gray-600 text-sm leading-relaxed [&_p]:mb-4">
                                {!! $pejabat->deskripsi_singkat !!}
                            </div>
                        @else
                            <p class="text-gray-400 text-sm italic">Deskripsi singkat belum tersedia untuk pejabat ini.</p>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- TOMBOL NAVIGASI BAWAH --}}
    {{-- ============================================ --}}
    <div class="flex flex-col sm:flex-row gap-4 justify-center mt-10">
        <button onclick="history.back()" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition text-center">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </button>
        <a href="{{ url('/') }}" class="px-6 py-3 bg-hijau-600 hover:bg-hijau-700 text-white rounded-lg font-semibold transition text-center">
            Kembali ke Beranda
        </a>
    </div>

</div>

@endsection