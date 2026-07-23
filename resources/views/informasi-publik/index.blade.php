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

<style>
    [x-cloak] { display: none !important; }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<section class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-10">
        
        {{-- ============================================ --}}
        {{-- FILTER & PENCARIAN --}}
        {{-- ============================================ --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6 mb-6 md:mb-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Filter Kategori</label>
                    <div class="flex flex-wrap gap-1.5 md:gap-2">
                        <a href="{{ route('informasi-publik.index') }}" class="inline-flex items-center gap-1 px-3 py-1.5 md:px-3.5 md:py-2 rounded-lg text-xs md:text-sm font-medium transition-all duration-200 {{ !request('kategori') || request('kategori') == 'all' ? 'bg-hijau-600 text-white shadow-sm' : 'bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100' }}">
                            Semua
                        </a>
                        @foreach($categories as $cat)
                            <a href="{{ route('informasi-publik.index', ['kategori' => $cat->slug]) }}" class="inline-flex items-center gap-1.5 px-3 py-1.5 md:px-3.5 md:py-2 rounded-lg text-xs md:text-sm font-medium transition-all duration-200 {{ request('kategori') == $cat->slug ? 'bg-hijau-600 text-white shadow-sm' : 'bg-gray-50 text-gray-600 border border-gray-200 hover:bg-gray-100' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ request('kategori') == $cat->slug ? 'bg-white' : 'bg-gray-400' }}"></span>
                                {{ $cat->nama }}
                            </a>
                        @endforeach
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Cari Informasi</label>
                    <form action="{{ route('informasi-publik.index') }}" method="GET" class="flex gap-2">
                        <div class="flex-1 flex items-center bg-gray-50 border border-gray-200 rounded-lg px-3 focus-within:ring-2 focus-within:ring-hijau-500 focus-within:border-hijau-500 transition">
                            <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            <input type="text" name="q" value="{{ request('q') }}" placeholder="Ketik kata kunci..." class="w-full py-2.5 text-sm text-gray-700 placeholder-gray-400 focus:outline-none border-0 bg-transparent">
                        </div>
                        <button type="submit" class="bg-hijau-600 hover:bg-hijau-700 text-white px-4 py-2.5 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center shrink-0">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </button>
                        @if(request('q') || (request('kategori') && request('kategori') != 'all'))
                            <a href="{{ route('informasi-publik.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-500 px-3 py-2.5 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center text-xs shrink-0" title="Reset filter">
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
            @forelse($groupedInformasi as $category)
                <div x-data="{ isOpen: false }" class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5 md:p-8 mb-6 overflow-hidden">
                    
                    {{-- ===== HEADER KATEGORI + DESKRIPSI ===== --}}
                    <div x-on:click="isOpen = !isOpen" class="cursor-pointer flex items-start justify-between gap-4 pb-4 border-b border-gray-100 mb-8">
                        <div class="flex-1">
                            <h2 class="text-lg md:text-xl font-bold text-hijau-800">{{ $category->nama }}</h2>
                            @if($category->deskripsi)
                                <p class="text-sm text-gray-500 mt-2 leading-relaxed max-w-3xl">{{ $category->deskripsi }}</p>
                            @endif
                        </div>
                        <div class="shrink-0 flex items-center gap-2">
                            <span x-show="!isOpen" class="inline-flex items-center gap-1.5 px-4 py-2 bg-hijau-600 text-white rounded-lg text-sm font-medium hover:bg-hijau-700 transition-colors shadow-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                Lihat
                            </span>
                            <span x-show="isOpen" x-cloak class="inline-flex items-center gap-1.5 px-4 py-2 bg-gray-200 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-300 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                                Sembunyikan
                            </span>
                        </div>
                    </div>

                    <div x-show="isOpen" x-cloak
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 -translate-y-2"
                         x-transition:enter-end="opacity-100 translate-y-0"
                         x-transition:leave="transition ease-in duration-200"
                         x-transition:leave-start="opacity-100 translate-y-0"
                         x-transition:leave-end="opacity-0 -translate-y-2">
                        
                        @if($category->informasiPublik->isEmpty())
                            <p class="text-gray-400 text-sm py-4 text-center">Belum ada data informasi dalam kategori ini.</p>
                        @else
                            {{-- HEADER TABLE --}}
                            <div class="hidden lg:grid grid-cols-12 gap-4 px-5 py-4 mt-2 bg-hijau-50 rounded-t-xl text-xs font-bold text-hijau-700 uppercase tracking-wider border border-hijau-100">
                                <div class="col-span-1">No</div>
                                <div class="col-span-3">Judul Informasi</div>
                                <div class="col-span-3">Ringkasan Isi</div>
                                <div class="col-span-2">Pejabat / Unit</div>
                                <div class="col-span-1">Jangka Waktu</div>
                                <div class="col-span-1">Bentuk Info</div>
                                <div class="col-span-1 text-right">Aksi</div>
                            </div>

                            <div class="space-y-4 mt-4 lg:mt-0">
                                @foreach($category->informasiPublik as $item)
                                    @php
                                        $isParentExternal = $item->jenis_tautan === 'url' && $item->tautan_eksternal;
                                        $parentLink = $isParentExternal ? $item->tautan_eksternal : route('informasi-publik.show', $item->slug);
                                        $parentTarget = $isParentExternal ? 'target="_blank" rel="noopener noreferrer"' : '';
                                    @endphp

                                    @if($item->children->isNotEmpty())
                                        {{-- CARD DENGAN SUB MENU --}}
                                        <div x-data="{ isOpen: false }" class="border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition-shadow duration-200">
                                            <div x-on:click="isOpen = !isOpen" class="flex items-center justify-between gap-4 p-5 cursor-pointer bg-gray-50/70 hover:bg-gray-50 transition-colors duration-200">
                                                <div class="flex items-start gap-4 flex-1 min-w-0">
                                                    <span class="shrink-0 w-8 h-8 rounded-full bg-hijau-600 text-white flex items-center justify-center text-sm font-bold mt-0.5">{{ $loop->iteration }}</span>
                                                    <div class="flex-1 min-w-0">
                                                        <h3 class="text-sm md:text-base font-semibold text-gray-800">{{ $item->judul }}</h3>
                                                        @if($item->konten)
                                                            <p class="text-xs text-gray-500 mt-1.5 line-clamp-2">{{ strip_tags($item->konten) }}</p>
                                                        @endif
                            @if($item->pejabat || $item->file_tipe || $item->jangka_waktu)
                            <div class="hidden lg:grid grid-cols-3 gap-4 mt-3 text-xs">
                                @if($item->pejabat)
                                <div>
                                    <span class="text-gray-400 font-medium">Pejabat: </span>
                                    <span class="text-gray-600">{{ $item->pejabat }}</span>
                                </div>
                                @endif
                                @if($item->file_tipe)
                                <div>
                                    <span class="text-gray-400 font-medium">Format: </span>
                                    <span class="text-gray-600 font-bold uppercase">{{ $item->file_tipe }}</span>
                                </div>
                                @endif
                                @if($item->jangka_waktu)
                                <div>
                                    <span class="text-gray-400 font-medium">Jangka Waktu: </span>
                                    <span class="text-gray-600">{{ $item->jangka_waktu }}</span>
                                </div>
                                @endif
                            </div>
                            @endif
                                                    </div>
                                                </div>
                                                <div class="flex items-center gap-2 shrink-0">
                                                    <span class="hidden sm:inline-flex items-center text-xs text-hijau-700 bg-hijau-50 px-2.5 py-1 rounded-full font-medium">{{ $item->children->count() }} Sub Informasi</span>
                                                    <svg class="w-5 h-5 text-gray-400 transition-transform duration-300" :class="{ 'rotate-180': isOpen }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                                </div>
                                            </div>

                                            <div x-show="isOpen" x-cloak 
                                                 x-transition:enter="transition ease-out duration-200" 
                                                 x-transition:enter-start="opacity-0 -translate-y-1" 
                                                 x-transition:enter-end="opacity-100 translate-y-0" 
                                                 x-transition:leave="transition ease-in duration-150" 
                                                 x-transition:leave-start="opacity-100 translate-y-0" 
                                                 x-transition:leave-end="opacity-0 -translate-y-1"
                                                 class="border-t border-gray-100 bg-white">
                                                
                                                <div class="hidden lg:grid grid-cols-12 gap-4 px-5 py-3 bg-gray-50 text-[11px] font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                                                    <div class="col-span-1">Huruf</div>
                                                    <div class="col-span-3">Judul Informasi</div>
                                                    <div class="col-span-3">Ringkasan Isi</div>
                                                    <div class="col-span-2">Pejabat / Unit</div>
                                                    <div class="col-span-1">Jangka Waktu</div>
                                                    <div class="col-span-1">Bentuk Info</div>
                                                    <div class="col-span-1 text-right">Aksi</div>
                                                </div>

                                                @foreach($item->children as $child)
                                                    @php
                                                        $isChildExternal = $child->jenis_tautan === 'url' && $child->tautan_eksternal;
                                                        $childLink = $isChildExternal ? $child->tautan_eksternal : route('informasi-publik.show', $child->slug);
                                                        $childTarget = $isChildExternal ? 'target="_blank" rel="noopener noreferrer"' : '';
                                                    @endphp
                                                    
                                                    {{-- DESKTOP ROW --}}
                                                    <div class="hidden lg:grid grid-cols-12 gap-4 px-5 py-4 items-start hover:bg-hijau-50/40 transition-colors border-b border-gray-50 last:border-0">
                                                        <div class="col-span-1">
                                                            <span class="inline-flex w-6 h-6 rounded-full bg-gray-100 text-gray-600 items-center justify-center text-xs font-bold">{{ strtolower(chr(96 + $loop->iteration)) }}</span>
                                                        </div>
                                                        <div class="col-span-3"><p class="text-sm font-semibold text-gray-800">{{ $child->judul }}</p></div>
                                                        <div class="col-span-3"><p class="text-xs text-gray-600 line-clamp-3">{{ $child->konten ? strip_tags($child->konten) : '-' }}</p></div>
                                                        <div class="col-span-2"><p class="text-xs text-gray-600">{{ $child->pejabat ?: '-' }}</p></div>
                                                        <div class="col-span-1"><p class="text-xs text-gray-600">{{ $child->jangka_waktu ?: '-' }}</p></div>
                                                        <div class="col-span-1">
                                                            @if($child->file_tipe)
                                                                <span class="px-1.5 py-0.5 bg-gray-100 rounded text-[10px] font-bold uppercase tracking-wider">{{ $child->file_tipe }}</span>
                                                            @else
                                                                <span class="text-xs text-gray-600">-</span>
                                                            @endif
                                                        </div>
                                                        <div class="col-span-1 text-right">
                                                            <a href="{{ $childLink }}" {!! $childTarget !!} class="inline-flex items-center gap-1 text-xs font-semibold text-hijau-600 hover:text-hijau-800 hover:underline transition">
                                                                Lihat
                                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                                            </a>
                                                        </div>
                                                    </div>

                                                    {{-- MOBILE CARD --}}
                                                    <div class="lg:hidden p-5 border-b border-gray-100 last:border-0">
                                                        <div class="flex items-start gap-3 mb-3">
                                                            <span class="shrink-0 w-6 h-6 rounded-full bg-gray-100 text-gray-600 flex items-center justify-center text-xs font-bold mt-0.5">{{ strtolower(chr(96 + $loop->iteration)) }}</span>
                                                            <h4 class="text-sm font-semibold text-gray-800 flex-1">{{ $child->judul }}</h4>
                                                        </div>
                                                        @if($child->konten)
                                                            <div class="mb-3 pl-9">
                                                                <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Ringkasan Isi</p>
                                                                <p class="text-xs text-gray-600 line-clamp-3">{{ strip_tags($child->konten) }}</p>
                                                            </div>
                                                        @endif
                                                        <div class="grid grid-cols-2 gap-3 pl-9 mb-3">
                                                            <div>
                                                                <p class="text-[10px] font-bold text-gray-400 uppercase">Pejabat / Unit</p>
                                                                <p class="text-xs text-gray-700">{{ $child->pejabat ?: '-' }}</p>
                                                            </div>
                                                            <div>
                                                                <p class="text-[10px] font-bold text-gray-400 uppercase">Bentuk Info</p>
                                                                <p class="text-xs text-gray-700">
                                                                    @if($child->file_tipe)
                                                                        <span class="font-bold uppercase">{{ $child->file_tipe }}</span>
                                                                    @else
                                                                        -
                                                                    @endif
                                                                </p>
                                                            </div>
                                                            <div class="col-span-2">
                                                                <p class="text-[10px] font-bold text-gray-400 uppercase">Jangka Waktu</p>
                                                                <p class="text-xs text-gray-700">{{ $child->jangka_waktu ?: '-' }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="pl-9">
                                                            <a href="{{ $childLink }}" {!! $childTarget !!} class="inline-flex items-center gap-1 text-xs font-semibold text-hijau-600 hover:text-hijau-800 hover:underline transition">
                                                                Lihat Detail
                                                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    @else
                                        {{-- BARIS TANPA SUB MENU --}}
                                        {{-- DESKTOP ROW --}}
                                        <div class="hidden lg:grid grid-cols-12 gap-4 px-5 py-4 items-start rounded-xl border border-transparent hover:bg-hijau-50/40 hover:border-hijau-100 transition-all duration-200">
                                            <div class="col-span-1">
                                                <span class="inline-flex w-8 h-8 rounded-full bg-hijau-600 text-white items-center justify-center text-sm font-bold">{{ $loop->iteration }}</span>
                                            </div>
                                            <div class="col-span-3"><p class="text-sm font-semibold text-gray-800">{{ $item->judul }}</p></div>
                                            <div class="col-span-3"><p class="text-xs text-gray-600 line-clamp-3">{{ $item->konten ? strip_tags($item->konten) : '-' }}</p></div>
                                            <div class="col-span-2"><p class="text-xs text-gray-600">{{ $item->pejabat ?: '-' }}</p></div>
                                            <div class="col-span-1"><p class="text-xs text-gray-600">{{ $item->jangka_waktu ?: '-' }}</p></div>
                                            <div class="col-span-1">
                                                @if($item->file_tipe)
                                                    <span class="px-1.5 py-0.5 bg-gray-100 rounded text-[10px] font-bold uppercase tracking-wider">{{ $item->file_tipe }}</span>
                                                @else
                                                    <span class="text-xs text-gray-600">-</span>
                                                @endif
                                            </div>
                                            <div class="col-span-1 text-right">
                                                <a href="{{ $parentLink }}" {!! $parentTarget !!} class="inline-flex items-center gap-1 text-sm font-semibold text-hijau-600 hover:text-hijau-800 hover:underline transition whitespace-nowrap">
                                                    Lihat
                                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                                </a>
                                            </div>
                                        </div>

                                        {{-- MOBILE CARD --}}
                                        <div class="lg:hidden p-5 rounded-xl border border-gray-100 hover:bg-gray-50 transition-all duration-200">
                                            <div class="flex items-start gap-4 mb-4">
                                                <span class="shrink-0 w-8 h-8 rounded-full bg-hijau-600 text-white flex items-center justify-center text-sm font-bold mt-0.5">{{ $loop->iteration }}</span>
                                                <h3 class="text-sm font-semibold text-gray-800 flex-1 pt-1">{{ $item->judul }}</h3>
                                            </div>
                                            @if($item->konten)
                                                <div class="mb-4 pl-12">
                                                    <p class="text-[10px] font-bold text-gray-400 uppercase mb-1">Ringkasan Isi</p>
                                                    <p class="text-xs text-gray-600 line-clamp-3">{{ strip_tags($item->konten) }}</p>
                                                </div>
                                            @endif
                                            <div class="grid grid-cols-2 gap-3 pl-12 mb-4">
                                                <div>
                                                    <p class="text-[10px] font-bold text-gray-400 uppercase">Pejabat / Unit</p>
                                                    <p class="text-xs text-gray-700">{{ $item->pejabat ?: '-' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-[10px] font-bold text-gray-400 uppercase">Bentuk Info</p>
                                                    <p class="text-xs text-gray-700">
                                                        @if($item->file_tipe)
                                                            <span class="font-bold uppercase">{{ $item->file_tipe }}</span>
                                                        @else
                                                            -
                                                        @endif
                                                    </p>
                                                </div>
                                                <div class="col-span-2">
                                                    <p class="text-[10px] font-bold text-gray-400 uppercase">Jangka Waktu</p>
                                                    <p class="text-xs text-gray-700">{{ $item->jangka_waktu ?: '-' }}</p>
                                                </div>
                                            </div>
                                            <div class="pl-12">
                                                <a href="{{ $parentLink }}" {!! $parentTarget !!} class="inline-flex items-center gap-1 text-sm font-semibold text-hijau-600 hover:text-hijau-800 hover:underline transition">
                                                    Lihat Detail
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm border border-gray-100">
                    <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Belum Ada Informasi Publik</h3>
                    <p class="text-slate-500 text-sm">Informasi publik belum ditambahkan.</p>
                </div>
            @endforelse

        @else
            {{-- MODE PENCARIAN --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="hidden lg:grid grid-cols-12 gap-4 px-5 py-4 bg-hijau-50 text-xs font-bold text-hijau-700 uppercase tracking-wider border-b border-hijau-100">
                    <div class="col-span-1">No</div>
                    <div class="col-span-3">Judul Informasi</div>
                    <div class="col-span-3">Ringkasan Isi</div>
                    <div class="col-span-2">Pejabat / Unit</div>
                    <div class="col-span-1">Penanggung Jawab</div>
                    <div class="col-span-1">Jangka Waktu</div>
                    <div class="col-span-1 text-right">Aksi</div>
                </div>

                <div class="divide-y divide-gray-100">
                    @forelse($informasiPublik as $info)
                        @php
                            if ($info->jenis_tautan === 'url' && $info->tautan_eksternal) {
                                $infoLink = $info->tautan_eksternal;
                                $infoTarget = 'target="_blank" rel="noopener noreferrer"';
                            } elseif ($info->file_path && \Illuminate\Support\Facades\Storage::disk('public')->exists($info->file_path)) {
                                $infoLink = asset('storage/' . $info->file_path);
                                $infoTarget = 'target="_blank"';
                            } else {
                                $infoLink = route('informasi-publik.show', $info->slug);
                                $infoTarget = '';
                            }
                        @endphp
                        
                        {{-- DESKTOP ROW --}}
                        <div class="hidden lg:grid grid-cols-12 gap-4 px-5 py-4 items-start hover:bg-hijau-50/40 transition group">
                            <div class="col-span-1">
                                <span class="inline-flex w-8 h-8 rounded-full bg-gray-100 group-hover:bg-hijau-600 text-gray-500 group-hover:text-white items-center justify-center text-xs font-bold transition">{{ $loop->iteration }}</span>
                            </div>
                            <div class="col-span-3">
                                @if($info->category)
                                    <span class="text-[10px] font-semibold text-hijau-600 uppercase tracking-wide">{{ $info->category->nama }}</span>
                                @endif
                                <p class="text-sm font-semibold text-gray-800 group-hover:text-hijau-700 transition line-clamp-2">{{ $info->judul }}</p>
                            </div>
                            <div class="col-span-3"><p class="text-xs text-gray-600 line-clamp-3">{{ $info->konten ? strip_tags($info->konten) : '-' }}</p></div>
                            <div class="col-span-2"><p class="text-xs text-gray-600">{{ $info->pejabat ?: '-' }}</p></div>
                            <div class="col-span-1"><p class="text-xs text-gray-600">{{ $info->penanggung_jawab ?: '-' }}</p></div>
                            <div class="col-span-1"><p class="text-xs text-gray-600">{{ $info->jangka_waktu ?: '-' }}</p></div>
                            <div class="col-span-1 text-right">
                                <a href="{{ $infoLink }}" {!! $infoTarget !!} class="inline-flex items-center gap-1 text-sm font-semibold text-hijau-600 group-hover:text-hijau-800 transition whitespace-nowrap">
                                    Lihat
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>

                        {{-- MOBILE CARD --}}
                        <div class="block lg:hidden p-5 hover:bg-gray-50 transition group">
                            <div class="flex items-start gap-4 mb-3">
                                <span class="shrink-0 w-8 h-8 rounded-full bg-gray-100 group-hover:bg-hijau-600 text-gray-500 group-hover:text-white flex items-center justify-center text-xs font-bold transition">{{ $loop->iteration }}</span>
                                <div class="flex-1 min-w-0">
                                    @if($info->category)
                                        <span class="text-[10px] font-semibold text-hijau-600 uppercase tracking-wide">{{ $info->category->nama }}</span>
                                    @endif
                                    <h3 class="text-sm font-semibold text-gray-800 group-hover:text-hijau-700 transition">{{ $info->judul }}</h3>
                                </div>
                            </div>
                            @if($info->konten)
                                <div class="mb-3 pl-12">
                                    <p class="text-xs text-gray-600 line-clamp-2">{{ strip_tags($info->konten) }}</p>
                                </div>
                            @endif
                            <div class="grid grid-cols-2 gap-3 pl-12 mb-3">
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase">Pejabat / Unit</p>
                                    <p class="text-xs text-gray-700">{{ $info->pejabat ?: '-' }}</p>
                                </div>
                                <div>
                                    <p class="text-[10px] font-bold text-gray-400 uppercase">Penanggung Jawab</p>
                                    <p class="text-xs text-gray-700">{{ $info->penanggung_jawab ?: '-' }}</p>
                                </div>
                                <div class="col-span-2">
                                    <p class="text-[10px] font-bold text-gray-400 uppercase">Jangka Waktu</p>
                                    <p class="text-xs text-gray-700">{{ $info->jangka_waktu ?: '-' }}</p>
                                </div>
                            </div>
                            <div class="pl-12">
                                <a href="{{ $infoLink }}" {!! $infoTarget !!} class="inline-flex items-center gap-1 text-sm font-semibold text-hijau-600 group-hover:text-hijau-800 transition">
                                    Lihat Detail
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-16">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-slate-100 rounded-full mb-4">
                                <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <h3 class="text-lg font-bold text-slate-800 mb-2">Informasi Tidak Ditemukan</h3>
                            <p class="text-slate-500 text-sm mb-6 max-w-md mx-auto">Maaf, tidak ada informasi publik yang cocok dengan kriteria pencarian Anda.</p>
                            <a href="{{ route('informasi-publik.index') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-hijau-600 text-white rounded-xl text-sm font-medium hover:bg-hijau-700 transition-colors">
                                Kembali ke Semua Informasi
                            </a>
                        </div>
                    @endforelse
                </div>
            </div>

            @if(isset($informasiPublik) && $informasiPublik->hasPages())
                <div class="mt-8 md:mt-10 flex justify-center">
                    {{ $informasiPublik->links('pagination.tailwind') }}
                </div>
            @endif
        @endif

        {{-- TOMBOL AKSI BAWAH --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-8 pt-8 border-t border-slate-200">
            <button onclick="history.back()" class="flex items-center gap-2 px-4 md:px-6 py-2.5 md:py-3 bg-white text-slate-700 rounded-lg md:rounded-xl text-sm font-medium hover:bg-gray-100 transition-colors duration-300 shadow-sm border border-slate-200 w-full sm:w-auto justify-center">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali
            </button>
            <a href="{{ url('/') }}" class="flex items-center gap-2 px-4 md:px-6 py-2.5 md:py-3 bg-hijau-600 text-white rounded-lg md:rounded-xl text-sm font-medium hover:bg-hijau-700 shadow-lg shadow-hijau-600/30 hover:shadow-hijau-600/50 transition-all duration-300 w-full sm:w-auto justify-center">
                <svg class="w-4 h-4 md:w-5 md:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
                Kembali ke Beranda
            </a>
        </div>

    </div>
</section>

@endsection