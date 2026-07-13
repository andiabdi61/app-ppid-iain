@extends('layouts.public_app')

@section('title', $informasi->judul)

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION (Super Kompak Desktop & Mobile) --}}
{{-- ============================================ --}}
<x-page-hero 
    title="{{ $informasi->judul }}" 
    icon="doc"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Informasi Publik', 'url' => route('informasi-publik.index')],
        ['label' => $informasi->category->nama ?? 'Kategori', 'url' => route('informasi-publik.index', ['kategori' => $informasi->category->slug ?? ''])],
        ['label' => Str::limit($informasi->judul, 30)]
    ]" 
/>


{{-- ============================================ --}}
{{-- MAIN CONTENT (2 Kolom) --}}
{{-- ============================================ --}}
<section class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-10">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            
            {{-- ========================================== --}}
            {{-- KOLOM KIRI: MURNI PREVIEW DOKUMEN --}}
            {{-- ========================================== --}}
            <div class="lg:col-span-2 order-2 lg:order-1">
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden border border-slate-100 flex flex-col" style="height: 80vh; min-height: 500px;">
                    
                    @php
                        $fileExists = $informasi->file_path && Storage::disk('public')->exists($informasi->file_path);
                        $fileExtension = strtolower(pathinfo($informasi->file_path, PATHINFO_EXTENSION));
                        $canPreview = in_array($fileExtension, ['pdf', 'jpg', 'jpeg', 'png', 'gif', 'webp', 'txt']);
                    @endphp

                    @if($fileExists && $canPreview)
                        {{-- HEADER PREVIEW --}}
                        <div class="px-4 md:px-6 py-3 bg-slate-50 border-b border-slate-200 flex items-center justify-between shrink-0">
                            <div class="flex items-center gap-2 text-slate-500 text-sm font-medium">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                </svg>
                                Preview Dokumen
                            </div>
                            <a href="{{ asset('storage/' . $informasi->file_path) }}" target="_blank" 
                               class="text-xs text-hijau-600 hover:text-hijau-700 font-semibold flex items-center gap-1 hover:underline">
                                Buka di Tab Baru
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                            </a>
                        </div>

                        {{-- AREA IFRAME PREVIEW --}}
                        <div class="flex-1 w-full bg-gray-100 relative">
                            <iframe 
                                src="{{ asset('storage/' . $informasi->file_path) }}" 
                                class="w-full h-full border-0"
                                loading="lazy"
                                title="Preview {{ $informasi->judul }}">
                                Browser Anda tidak mendukung iframe.
                            </iframe>
                        </div>

                    @else
                        {{-- FALLBACK: JIKA TIDAK ADA FILE ATAU TIDAK BISA DI-PREVIEW --}}
                        <div class="flex-1 flex items-center justify-center p-10 text-center">
                            <div>
                                <div class="w-24 h-24 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <svg class="w-12 h-12 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                    </svg>
                                </div>
                                <h3 class="text-lg font-bold text-slate-700 mb-2">Preview Tidak Tersedia</h3>
                                <p class="text-slate-500 text-sm max-w-sm mx-auto mb-6">File ini tidak dapat ditampilkan langsung di browser. Silakan unduh dokumen melalui tombol di samping, atau baca deskripsi singkatnya di bawah.</p>
                                
                                @if($informasi->file_path)
                                    <a href="{{ asset('storage/' . $informasi->file_path) }}" target="_blank" class="inline-flex items-center gap-2 bg-hijau-600 text-white px-5 py-2.5 rounded-xl text-sm font-medium hover:bg-hijau-700 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                        </svg>
                                        Unduh Dokumen
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            {{-- ========================================== --}}
            {{-- KOLOM KANAN: Detail, Download & KONTEN --}}
            {{-- ========================================== --}}
            <div class="lg:col-span-1 order-1 lg:order-2">
                <div class="lg:sticky lg:top-24 space-y-4 max-h-[90vh] lg:overflow-y-auto pr-1">
                    
                    {{-- Widget Detail Informasi --}}
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                        <div class="px-5 py-4 border-b border-slate-100 bg-slate-50/50">
                            <h3 class="font-bold text-slate-800 flex items-center gap-2">
                                <svg class="w-5 h-5 text-hijau-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Detail Informasi
                            </h3>
                        </div>
                        
                        <div class="p-5 space-y-4">
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Kategori</p>
                                @if($informasi->category)
                                    <span class="inline-block bg-hijau-50 text-hijau-700 text-sm font-medium px-3 py-1 rounded-full">
                                        {{ $informasi->category->nama }}
                                    </span>
                                @else
                                    <span class="text-sm text-slate-500">Tanpa Kategori</span>
                                @endif
                            </div>
                            
                            <div class="border-t border-slate-100"></div>
                            
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Dipublikasi</p>
                                <p class="text-sm text-slate-700 font-medium">{{ $informasi->updated_at ? $informasi->updated_at->translatedFormat('d F Y, H:i') : '-' }}</p>
                            </div>
                            
                            <div class="border-t border-slate-100"></div>
                            
                            <div>
                                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Dilihat</p>
                                <p class="text-sm text-slate-700 font-medium">{{ $informasi->hits }} kali</p>
                            </div>

                            @if($fileExists)
                            <div class="border-t border-slate-100"></div>
                            <div class="flex gap-4">
                                <div>
                                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Format</p>
                                    <p class="text-sm text-slate-700 font-bold uppercase">{{ $fileExtension }}</p>
                                </div>
                                <div>
                                    <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider mb-1">Ukuran</p>
                                    <p class="text-sm text-slate-700 font-bold">{{ number_format(Storage::disk('public')->size($informasi->file_path) / 1024, 1) }} KB</p>
                                </div>
                            </div>
                            @endif
                        </div>

                        @if($informasi->file_path)
                        <div class="p-4 border-t border-slate-100 bg-slate-50/30 space-y-2">
                            <a href="{{ asset('storage/' . $informasi->file_path) }}" target="_blank" 
                               class="flex items-center justify-center gap-2 w-full bg-hijau-600 hover:bg-hijau-700 text-white font-semibold py-3 rounded-xl transition-colors duration-200 shadow-sm hover:shadow-md">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Unduh Lampiran
                            </a>
                            <p class="text-[10px] text-slate-400 text-center">Simpan file ke perangkat Anda</p>
                        </div>
                        @endif
                    </div>

                    {{-- ========================================== --}}
                    {{-- KONTEN INFORMASI (PINDAH KE SINI) --}}
                    {{-- ========================================== --}}
                    @if($informasi->konten)
                    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-5">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2 mb-4">
                            <svg class="w-5 h-5 text-hijau-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Keterangan
                        </h3>
                        
                        <div class="prose prose-sm max-w-none text-slate-600
                                    prose-headings:text-slate-800 prose-headings:font-bold
                                    prose-a:text-hijau-600 hover:prose-a:text-hijau-700
                                    prose-img:rounded-xl prose-img:shadow-md prose-img:w-full">
                            {!! $informasi->konten !!}
                        </div>
                    </div>
                    @endif

                    {{-- Tombol Kembali (Mobile) --}}
                    <div class="lg:hidden">
                        <a href="{{ route('informasi-publik.index') }}" 
                           class="flex items-center justify-center gap-2 w-full bg-white text-slate-700 border border-slate-200 font-medium py-3 rounded-xl transition-colors hover:bg-gray-50 shadow-sm text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                            </svg>
                            Kembali ke Daftar Informasi
                        </a>
                    </div>

                </div>
            </div>

        </div>

        {{-- Tombol Aksi (Hanya Desktop) --}}
        <div class="hidden lg:flex flex-col sm:flex-row items-center justify-center gap-3 mt-10 pt-8 border-t border-slate-200">
            <button onclick="history.back()" 
                    class="flex items-center gap-2 px-6 py-3 bg-white text-slate-700 rounded-xl font-medium hover:bg-gray-100 transition-colors duration-300 shadow-sm border border-slate-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali
            </button>
            <a href="{{ url('/') }}" 
               class="flex items-center gap-2 px-6 py-3 bg-hijau-600 text-white rounded-xl font-medium hover:bg-hijau-700 shadow-lg shadow-hijau-600/30 hover:shadow-hijau-600/50 transition-all duration-300">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

    </div>
</section>

@endsection