@extends('layouts.public_app')

@section('title', 'Profil Pejabat')

@section('content')

{{-- ============================================ --}}
{{-- ALPINE JS DATA UNTUK MODAL --}}
{{-- ============================================ --}}
<div x-data="{ show: false, content: '' }" @keydown.escape.window="show = false">

    {{-- ============================================ --}}
    {{-- HERO SECTION & BREADCRUMB --}}
    {{-- ============================================ --}}
    <div class="bg-putih-100 border-b border-gray-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <nav aria-label="breadcrumb">
                <ol class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                    <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
                    <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                    <li class="text-hijau-800 font-medium">Profil Pejabat</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Profil Pejabat</h1>
            <p class="text-gray-600 mt-2">Mengenal para pejabat pengelola informasi dan dokumentasi di lingkungan PPID IAIN Bone.</p>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        {{-- ============================================ --}}
        {{-- GRID PEJABAT --}}
        {{-- ============================================ --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($pejabat as $p)
                {{-- Kartu Pejabat --}}
                <button @click="
                    fetch(`{{ route('pejabat.showModal', ['pejabat' => $p->id]) }}`)
                    .then(res => res.text())
                    .then(html => { content = html; show = true; })
                " 
                class="group block bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all duration-300 text-left w-full">
                    
                    {{-- Gambar dengan efek Zoom saat Hover --}}
                    <div class="overflow-hidden h-64 bg-gray-100">
                        <img src="{{ $p->foto_url }}" 
                             alt="{{ $p->foto_alt_text }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
                             loading="lazy">
                    </div>

                    {{-- Info Nama & Jabatan --}}
                    <div class="p-4">
                        <h5 class="text-base font-bold text-gray-800 group-hover:text-hijau-700 transition mb-1 truncate">
                            {{ $p->nama }}
                        </h5>
                        <p class="text-sm text-gray-500 truncate mb-1">{{ $p->jabatan }}</p>
                        @if($p->nip)
                            <p class="text-xs text-gray-400 font-mono">NIP: {{ $p->nip }}</p>
                        @endif
                    </div>
                </button>
            @empty
                {{-- Jika Data Kosong --}}
                <div class="col-span-full text-center py-16">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-person-x text-3xl text-gray-400"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-700 mb-2">Data Pejabat Belum Tersedia</h4>
                    <p class="text-gray-500">Saat ini belum ada data pejabat yang dapat ditampilkan.</p>
                </div>
            @endforelse
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

    {{-- ============================================ --}}
    {{-- MODAL ALPINE JS --}}
    {{-- ============================================ --}}
    <div x-show="show" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
         @click="show = false">
        
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto relative"
             @click.stop>
            
            <button @click="show = false" 
                    class="absolute top-4 right-4 z-10 w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-full transition">
                <i class="bi bi-x-lg text-gray-600"></i>
            </button>

            <div x-html="content" class="p-6"></div>
        </div>
    </div>

</div>

@endsection