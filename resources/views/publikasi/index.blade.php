@extends('layouts.public_app')

@section('title', 'Publikasi & Dokumen Resmi')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 md:pt-8 pb-12">

    @if($category)
        <div class="mb-6">
            <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-1">{{ $category->nama }}</h1>
            @if($category->deskripsi)
                <p class="text-gray-600">{{ $category->deskripsi }}</p>
            @endif
        </div>
    @endif

    {{-- ============================================ --}}
    {{-- LIST DOKUMEN --}}
    {{-- ============================================ --}}
    <div class="flex flex-col gap-2 sm:gap-3">
        @forelse($dokumen as $doc)
        <div class="group bg-white rounded-xl border border-gray-200 shadow-sm hover:shadow-md hover:border-hijau-300 transition-all duration-300 flex items-center gap-3 sm:gap-4 p-3 sm:p-4 overflow-hidden">
            
            {{-- Ikon Tipe File --}}
            <a href="{{ route('publikasi.show', $doc->slug) }}" class="w-11 h-11 sm:w-14 sm:h-14 shrink-0 bg-gray-50 rounded-lg flex items-center justify-center border border-gray-100">
                @php
                    $iconClass = 'bi-file-earmark-text text-gray-400'; 
                    if (Str::contains($doc->file_tipe, 'pdf')) $iconClass = 'bi-file-earmark-pdf text-red-400';
                    elseif (Str::contains($doc->file_tipe, ['word', 'doc'])) $iconClass = 'bi-file-earmark-word text-blue-400';
                    elseif (Str::contains($doc->file_tipe, ['excel', 'xls'])) $iconClass = 'bi-file-earmark-excel text-green-500';
                @endphp
                <i class="bi {{ $iconClass }} text-xl sm:text-2xl"></i>
            </a>

            {{-- Detail Dokumen --}}
            <a href="{{ route('publikasi.show', $doc->slug) }}" class="flex-1 min-w-0 flex flex-col justify-center">
                <h5 class="text-sm font-bold text-gray-800 group-hover:text-hijau-700 transition truncate mb-0.5 sm:mb-1">
                    {{ $doc->judul }}
                </h5>
                <div class="flex items-center gap-2 sm:gap-3 text-xs text-gray-400 truncate">
                    @if($doc->category)
                        <span class="hidden xs:inline shrink-0 px-1.5 py-0.5 rounded text-[10px] font-medium {{ $doc->category->frontend_badge_class ?? 'bg-hijau-100 text-hijau-800' }}">
                            {{ Str::limit($doc->category->nama, 8) }}
                        </span>
                    @endif
                    <span class="shrink-0">{{ $doc->tanggal_publikasi ? $doc->tanggal_publikasi->format('d M Y') : '-' }}</span>
                </div>
            </a>

            {{-- Tombol Aksi Kanan --}}
            <div class="flex items-center gap-1.5 sm:gap-2 shrink-0">
                <a href="{{ route('publikasi.show', $doc->slug) }}" 
                   class="hidden sm:flex items-center gap-1 px-2.5 py-1.5 sm:px-3 sm:py-2 text-xs font-medium border border-gray-300 rounded-lg text-gray-600 hover:bg-hijau-50 hover:text-hijau-700 hover:border-hijau-500 transition">
                    <i class="bi bi-eye text-xs"></i> <span class="hidden md:inline">Lihat</span>
                </a>
                
                @if($doc->file_path)
                    <a href="{{ asset('storage/' . $doc->file_path) }}" target="_blank" 
                       class="flex items-center gap-1 px-2.5 py-1.5 sm:px-3 sm:py-2 text-xs font-medium bg-hijau-600 hover:bg-hijau-700 text-white rounded-lg transition shrink-0">
                        <i class="bi bi-download text-xs"></i> <span class="hidden xs:inline sm:inline">Unduh</span>
                    </a>
                @endif
            </div>
        </div>
        @empty
            {{-- EMPTY STATE --}}
            <div class="text-center py-16">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-journal-x text-3xl text-gray-400"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-700 mb-2">Dokumen Tidak Ditemukan</h4>
                <p class="text-gray-500 mb-6">Maaf, belum ada dokumen yang tersedia.</p>
                <a href="{{ url('/') }}" class="text-hijau-600 hover:text-hijau-700 font-medium text-sm">Kembali ke Beranda</a>
            </div>
        @endforelse
    </div>

    {{-- PAGINASI --}}
    @if ($dokumen->hasPages())
        {{ $dokumen->links('vendor.pagination.tailwind-list') }}
    @endif

    {{-- TOMBOL NAVIGASI BAWAH --}}
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
