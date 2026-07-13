@extends('layouts.public_app')

@section('title', 'Cek Status Layanan')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 md:pt-8 pb-12">
    <div class="max-w-2xl mx-auto">
        
        {{-- ============================================ --}}
        {{-- BREADCRUMB & JUDUL --}}
        {{-- ============================================ --}}
        <nav aria-label="breadcrumb">
            <ol class="flex items-center gap-2 text-sm text-gray-500 mb-4 overflow-hidden whitespace-nowrap">
                <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
                <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                <li><a href="{{ route('layanan-pengaduan.index') }}" class="hover:text-hijau-700 transition">Layanan & Pengaduan</a></li>
                <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                <li class="text-hijau-800 font-medium">Cek Status Layanan</li>
            </ol>
        </nav>
        
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Cek Status Layanan</h1>
        <p class="text-gray-600 mb-10">Lacak progres permohonan atau pengaduan Anda di sini.</p>

        {{-- ============================================ --}}
        {{-- KONTEN UTAMA --}}
        {{-- ============================================ --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12 text-center">
            
            {{-- Ikon --}}
            <div class="w-20 h-20 bg-hijau-100 rounded-3xl flex items-center justify-center mx-auto mb-6">
                <i class="bi bi-clipboard-data text-3xl text-hijau-700"></i>
            </div>

            <h2 class="text-xl font-bold text-gray-800 mb-3">Masuk untuk Melacak Status</h2>
            <p class="text-gray-600 mb-8">Untuk melihat status permohonan atau pengaduan Anda, silakan masuk ke dasbor personal terlebih dahulu.</p>
            
            {{-- Tombol CTA --}}
            <a href="{{ route('login') }}" class="inline-flex items-center gap-2 bg-hijau-600 hover:bg-hijau-700 text-white px-8 py-3.5 rounded-xl font-semibold text-lg transition shadow-md hover:shadow-lg">
                <i class="bi bi-box-arrow-in-right text-xl"></i> 
                Masuk ke Dasbor
            </a>

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
</div>

@endsection