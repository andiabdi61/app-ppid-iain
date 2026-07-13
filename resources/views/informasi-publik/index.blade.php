@extends('layouts.public_app')

@section('title', 'Daftar Informasi Publik (DIP)')

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION --}}
{{-- ============================================ --}}
<x-page-hero 
    title="Daftar Informasi Publik (DIP)" 
    icon="doc"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Informasi Publik']
    ]" 
/>

{{-- ============================================ --}}
{{-- MAIN CONTENT --}}
{{-- ============================================ --}}
<section class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-10">
        
        {{-- ============================================ --}}
        {{-- FILTER & PENCARIAN (2 KOLOM) --}}
        {{-- ============================================ --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6 mb-6 md:mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                
                {{-- KOLOM KIRI: Filter Kategori Cepat --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Filter Kategori</label>
                    <div class="flex flex-wrap gap-1.5 md:gap-2">
                        <a href="{{ route('informasi-publik.index') }}" 
                           class="inline-flex items-center gap-1 px-3 py-1.5 md:px-3.5 md:py-2 rounded-lg text-xs md:text-sm font-medium transition-all duration-200 
                                  {{ !request('kategori') || request('kategori') == 'all' ? 'bg-hijau-600 text-white shadow-sm' : 'bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100' }}">
                            Semua
                        </a>
                        @foreach($categories as $cat)
                        <a href="{{ route('informasi-publik.index', ['kategori' => $cat->slug]) }}" 
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 md:px-3.5 md:py-2 rounded-lg text-xs md:text-sm font-medium transition-all duration-200 
                                  {{ request('kategori') == $cat->slug ? 'bg-hijau-600 text-white shadow-sm' : 'bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100' }}">
                            <span class="w-1.5 h-1.5 rounded-full {{ request('kategori') == $cat->slug ? 'bg-white' : 'bg-gray-400' }}"></span>
                            {{ $cat->nama }}
                        </a>
                        @endforeach
                    </div>
                </div>

                {{-- KOLOM KANAN: Pencarian --}}
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Cari Informasi</label>
                    <form action="{{ route('informasi-publik.index') }}" method="GET" class="flex gap-2">
                        <div class="flex-1 flex items-center bg-gray-50 border border-gray-200 rounded-lg px-3 focus-within:ring-2 focus-within:ring-hijau-500 focus-within:border-hijau-500 transition">
                            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            <input type="text" name="q" value="{{ request('q') }}" 
                                   placeholder="Ketik kata kunci..." 
                                   class="w-full py-2.5 text-sm text-gray-700 placeholder-gray-400 focus:outline-none border-0 bg-transparent">
                        </div>
                        <button type="submit" 
                                class="bg-hijau-600 hover:bg-hijau-700 text-white px-4 py-2.5 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                        @if(request('q') || (request('kategori') && request('kategori') != 'all'))
                            <a href="{{ route('informasi-publik.index') }}" 
                               class="bg-gray-100 hover:bg-gray-200 text-gray-500 px-3 py-2.5 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center text-xs shrink-0"
                               title="Reset filter">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                        @endif
                    </form>
                </div>
            </div>
        </div>

        {{-- ============================================ --}}
        {{-- LIST INFORMASI PUBLIK --}}
        {{-- ============================================ --}}
        
        @if(isset($groupedInformasi))
            {{-- ========================================== --}}
            {{-- MODE NORMAL: GROUPED BERDASARKAN KATEGORI --}}
            {{-- ========================================== --}}
            @forelse($groupedInformasi as $category)
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-8 mb-6">
                    
                    {{-- Nama Kategori --}}
                    <h2 class="text-lg md:text-xl font-bold text-hijau-800 mb-6 pb-3 border-b border-gray-100">
                        {{ $category->nama }}
                    </h2>
                    
                    @if($category->informasiPublik->isEmpty())
                        <p class="text-gray-400 text-sm py-4 text-center">Belum ada data informasi dalam kategori ini.</p>
                    @else
                        <div class="space-y-2">
                            @foreach($category->informasiPublik as $item)
                                
                                {{-- @if digunakan untuk menandai apakah ini punya sub-menu atau tidak --}}
                                @if($item->children->isNotEmpty())
                                    
                                    <!-- ========================================== -->
                                    <!-- CARD JUDUL UTAMA YANG PUNYA SUB-MENU -->
                                    <!-- ========================================== -->
                                    <div x-data="{ isOpen: false }" class="border border-gray-100 rounded-xl overflow-hidden hover:shadow-md transition-shadow duration-200">
                                        
                                        {{-- HEADER JUDUL UTAMA (BISA DITEKAN UNTUK BUKA TUTUP) --}}
                                        <div @click="isOpen = !isOpen" 
                                             class="flex items-center justify-between gap-4 p-4 cursor-pointer bg-gray-50/50 hover:bg-gray-50 transition-colors duration-200">
                                            <div class="flex items-start gap-3">
                                                <span class="shrink-0 w-7 h-7 rounded-full bg-hijau-100 text-hijau-700 flex items-center justify-center text-sm font-bold mt-0.5">
                                                    {{ $loop->iteration }}
                                                </span>
                                                <h3 class="text-sm md:text-base font-semibold text-gray-800 pt-0.5">{{ $item->judul }}</h3>
                                            </div>
                                            
                                            {{-- IKON PANAH DROPDOWN --}}
                                            <svg class="w-5 h-5 text-gray-400 shrink-0 transition-transform duration-300" 
                                                 :class="isOpen && 'rotate-180'" 
                                                 fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                            </svg>
                                        </div>

                                        {{-- DROPDOWN SUB-ITEM (HURUF a, b, c...) --}}
                                        <div x-show="isOpen" x-cloak x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-1"
                                             class="border-t border-gray-100 bg-white p-4">
                                            <ol class="space-y-3 list-none">
                                                @foreach($item->children as $child)
                                                    <li class="flex items-start justify-between gap-4 py-2 {{ !$loop->last ? 'border-b border-dashed border-gray-100' : '' }}">
                                                        <div class="flex items-start gap-3">
                                                            {{-- HURUF a, b, c --}}
                                                            <span class="shrink-0 w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold mt-0.5">
                                                                {{ strtolower(chr(96 + $loop->iteration)) }}
                                                            </span>
                                                            <span class="text-sm text-gray-700 pt-0.5">{{ $child->judul }}</span>
                                                        </div>
                                                        
                                                        {{-- TOMBOL LIHAT SUB-ITEM --}}
                                                        @php
                                                            if ($child->jenis_tautan === 'url' && $child->tautan_eksternal) {
                                                                $childLink = $child->tautan_eksternal;
                                                                $childTarget = 'target="_blank" rel="noopener noreferrer"';
                                                            } else {
                                                                // SELALU ARAHKAN KE HALAMAN SHOW (BAIK ADA FILE ATAU TIDAK)
                                                                $childLink = route('informasi-publik.show', $child->slug);
                                                                $childTarget = '';
                                                            }
                                                        @endphp
                                                        <a href="{{ $childLink }}" {{ $childTarget }} class="shrink-0 text-sm font-semibold text-hijau-600 hover:text-hijau-800 hover:underline transition">
                                                            Lihat
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ol>
                                        </div>
                                    </div>

                                @else
                                    
                                    <!-- ========================================== -->
                                    <!-- BARIS JUDUL UTAMA TANPA SUB-MENU (LANGSUNG LIHAT) -->
                                    <!-- ========================================== -->
                                    <div class="flex items-center justify-between gap-4 p-4 rounded-xl border border-transparent hover:bg-gray-50 hover:border-gray-100 transition-all duration-200">
                                        <div class="flex items-start gap-3">
                                            <span class="shrink-0 w-7 h-7 rounded-full bg-hijau-100 text-hijau-700 flex items-center justify-center text-sm font-bold mt-0.5">
                                                {{ $loop->iteration }}
                                            </span>
                                            <h3 class="text-sm md:text-base font-semibold text-gray-800 pt-0.5">{{ $item->judul }}</h3>
                                        </div>
                                        
                                        {{-- TOMBOL LIHAT JUDUL UTAMA --}}
                                        @php
                                            if ($item->jenis_tautan === 'url' && $item->tautan_eksternal) {
                                                $link = $item->tautan_eksternal;
                                                $target = 'target="_blank" rel="noopener noreferrer"';
                                            } else {
                                                // SELALU ARAHKAN KE HALAMAN SHOW (BAIK ADA FILE ATAU TIDAK)
                                                $link = route('informasi-publik.show', $item->slug);
                                                $target = '';
                                            }
                                        @endphp
                                        <a href="{{ $link }}" {{ $target }} class="shrink-0 text-sm font-semibold text-hijau-600 hover:text-hijau-800 hover:underline transition">
                                            Lihat
                                        </a>
                                    </div>

                                @endif

                            @endforeach
                        </div>
                    @endif
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Belum Ada Informasi Publik</h3>
                    <p class="text-slate-500 text-sm">Informasi publik belum ditambahkan.</p>
                </div>
            @endforelse

        @else
            {{-- ========================================== --}}
            {{-- MODE PENCARIAN: FLAT LIST --}}
            {{-- ========================================== --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 divide-y divide-gray-100">
                @forelse($informasiPublik as $info)
                <a href="{{ $info->jenis_tautan === 'url' && $info->tautan_eksternal ? $info->tautan_eksternal : ($info->file_path && Storage::disk('public')->exists($info->file_path) ? asset('storage/' . $info->file_path) : route('informasi-publik.show', $info->slug)) }}" 
                   @if($info->jenis_tautan === 'url' || ($info->file_path && Storage::disk('public')->exists($info->file_path))) target="_blank" @endif
                   class="flex items-center justify-between p-4 md:p-5 hover:bg-gray-50 transition group">
                    <div class="flex items-center gap-4 min-w-0">
                        <span class="shrink-0 w-8 h-8 rounded-full bg-gray-100 text-gray-500 flex items-center justify-center text-xs font-bold">
                            {{ $loop->iteration }}
                        </span>
                        <div class="min-w-0">
                            @if($info->category)
                                <span class="text-[10px] font-semibold text-hijau-600 uppercase tracking-wide">{{ $info->category->nama }}</span>
                            @endif
                            <h3 class="text-sm font-semibold text-gray-800 group-hover:text-hijau-700 transition line-clamp-1">{{ $info->judul }}</h3>
                        </div>
                    </div>
                    <span class="shrink-0 text-sm font-semibold text-hijau-600 group-hover:text-hijau-800 transition">Lihat</span>
                </a>
                @empty
                    <div class="text-center py-16">
                        <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-4">
                            <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-slate-800 mb-2">Informasi Tidak Ditemukan</h3>
                        <p class="text-slate-500 text-sm mb-6 max-w-md mx-auto">Maaf, tidak ada informasi publik yang cocok dengan kriteria pencarian Anda.</p>
                        <a href="{{ route('informasi-publik.index') }}" 
                           class="inline-flex items-center gap-2 px-5 py-2.5 bg-hijau-600 text-white rounded-xl text-sm font-medium hover:bg-hijau-700 transition-colors">
                            Kembali ke Semua Informasi
                        </a>
                    </div>
                @endforelse
            </div>

            {{-- PAGINASI HANYA MUNCUL DI MODE PENCARIAN --}}
            @if(isset($informasiPublik) && $informasiPublik->hasPages())
            <div class="mt-8 md:mt-10 flex justify-center">
                {{ $informasiPublik->links('vendor.pagination.tailwind') }}
            </div>
            @endif
        @endif

        {{-- ============================================ --}}
        {{-- TOMBOL AKSI BAWAH --}}
        {{-- ============================================ --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-8 pt-8 border-t border-slate-200">
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
</section>

@endsection