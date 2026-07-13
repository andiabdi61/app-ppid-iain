@extends('layouts.public_app')

@section('title', 'Publikasi & Dokumen Resmi')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 md:pt-8 pb-12">
    
    {{-- BREADCRUMB & JUDUL --}}
    <nav aria-label="breadcrumb">
        <ol class="flex items-center gap-2 text-sm text-gray-500 mb-4 overflow-hidden whitespace-nowrap">
            <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
            <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
            <li class="text-hijau-800 font-medium">Publikasi & Dokumen</li>
        </ol>
    </nav>
    
    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Publikasi & Dokumen</h1>
    <p class="text-gray-600 mb-8">Akses dokumen perencanaan, regulasi, dan laporan kinerja IAIN Bone.</p>

    {{-- ============================================ --}}
    {{-- FORM PENCARIAN (MOBILE FRIENDLY) --}}
    {{-- ============================================ --}}
    <div class="max-w-4xl mx-auto mb-10">
        <form action="{{ route('publikasi.index') }}" method="GET">
            {{-- Baris 1: Input & Tombol Cari (Selalu sejajar) --}}
            <div class="flex gap-2 mb-2">
                <input type="text" name="q" 
                       class="flex-1 px-4 py-3 text-sm border border-gray-300 focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none rounded-xl placeholder-gray-400 transition" 
                       placeholder="Cari nama dokumen..." 
                       value="{{ request('q') }}">
                <button type="submit" class="px-5 py-3 bg-hijau-600 hover:bg-hijau-700 text-white rounded-xl text-sm font-medium transition flex items-center gap-2 justify-center shrink-0">
                    <i class="bi bi-search"></i> <span class="hidden sm:inline">Cari</span>
                </button>
            </div>
            
            {{-- Baris 2: Filter & Reset --}}
            <div class="flex gap-2">
                <select name="kategori" 
                        class="flex-1 px-4 py-2.5 text-sm border border-gray-300 focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none rounded-xl text-gray-600 transition">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('kategori') == $cat->slug ? 'selected' : '' }}>
                            {{ $cat->nama }}
                        </option>
                    @endforeach
                </select>

                @if(request('q') || request('kategori') != 'all')
                    <a href="{{ route('publikasi.index') }}" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-medium transition flex items-center gap-1 justify-center shrink-0 border border-gray-300">
                        <i class="bi bi-x-lg text-xs"></i> Reset
                    </a>
                @endif
            </div>
        </form>
    </div>

    {{-- ============================================ --}}
    {{-- GRID DOKUMEN --}}
    {{-- ============================================ --}}
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
                {{-- Tombol Lihat: Hanya muncul di Desktop (HP sudah bisa klik judulnya) --}}
                <a href="{{ route('publikasi.show', $doc->slug) }}" 
                   class="hidden sm:flex items-center gap-1 px-2.5 py-1.5 sm:px-3 sm:py-2 text-xs font-medium border border-gray-300 rounded-lg text-gray-600 hover:bg-hijau-50 hover:text-hijau-700 hover:border-hijau-500 transition">
                    <i class="bi bi-eye text-xs"></i> <span class="hidden md:inline">Lihat</span>
                </a>
                
                {{-- Tombol Unduh: Selalu muncul, tapi lebih kecil di HP --}}
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
                <p class="text-gray-500 mb-6">Maaf, tidak ada dokumen yang cocok dengan pencarian Anda.</p>
                <a href="{{ route('publikasi.index') }}" class="text-hijau-600 hover:text-hijau-700 font-medium text-sm">Kembali ke Semua Publikasi</a>
            </div>
        @endforelse
    </div>

    {{-- ============================================ --}}
    {{-- PAGINASI (PANGGIL FILE CUSTOM) --}}
    {{-- ============================================ --}}
    @if ($dokumen->hasPages())
        {{ $dokumen->withQueryString()->links('vendor.pagination.tailwind-list') }}
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