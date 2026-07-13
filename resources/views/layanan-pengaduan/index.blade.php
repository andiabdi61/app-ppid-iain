@extends('layouts.public_app')

@section('title', 'Layanan & Pengaduan')

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION & BREADCRUMB --}}
{{-- ============================================ --}}
<div class="bg-putih-100 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <nav aria-label="breadcrumb">
            <ol class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
                <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                <li class="text-hijau-800 font-medium">Layanan & Pengaduan</li>
            </ol>
        </nav>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Pusat Layanan & Pengaduan</h1>
        <p class="text-gray-600 mt-2">Kami berkomitmen memberikan pelayanan terbaik dan menanggapi setiap masukan dari masyarakat.</p>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        {{-- ============================================ --}}
        {{-- Kartu 1: Pengaduan Masyarakat --}}
        {{-- ============================================ --}}
        <a href="https://www.lapor.go.id/" target="_blank" 
           class="group bg-white h-full rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-red-300 transition-all duration-300 flex flex-col items-center text-center p-6 border-t-4 border-t-red-500">
            
            <div class="w-20 h-20 bg-red-50 group-hover:bg-red-100 rounded-2xl flex items-center justify-center mb-5 transition-colors">
                <img src="https://www.lapor.go.id/themes/lapor/assets/images/logo.png" alt="Logo SP4N-LAPOR!" class="w-14 h-14 object-contain">
            </div>
            
            <h5 class="text-lg font-bold text-gray-800 mb-2">Pengaduan Masyarakat</h5>
            <p class="text-sm text-gray-500 mb-6 flex-1">Gunakan kanal pengaduan resmi pemerintah melalui SP4N-LAPOR!</p>
            
            <span class="inline-flex items-center gap-2 bg-red-500 hover:bg-red-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition">
                Ajukan di LAPOR! <i class="bi bi-box-arrow-up-right text-xs"></i>
            </span>
        </a>

        {{-- ============================================ --}}
        {{-- Kartu 2: Pertanyaan Umum (FAQ) --}}
        {{-- ============================================ --}}
        <a href="{{ route('layanan-pengaduan.faq-umum') }}" 
           class="group bg-white h-full rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-green-300 transition-all duration-300 flex flex-col items-center text-center p-6 border-t-4 border-t-green-500">
            
            <div class="w-20 h-20 bg-green-50 group-hover:bg-green-100 rounded-2xl flex items-center justify-center mb-5 transition-colors">
                <i class="bi bi-question-circle-fill text-4xl text-green-600"></i>
            </div>
            
            <h5 class="text-lg font-bold text-gray-800 mb-2">Pertanyaan Umum</h5>
            <p class="text-sm text-gray-500 mb-6 flex-1">Temukan jawaban atas pertanyaan yang sering diajukan.</p>
            
            <span class="inline-flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition">
                Lihat FAQ <i class="bi bi-arrow-right text-xs"></i>
            </span>
        </a>

        {{-- ============================================ --}}
        {{-- Kartu 3: Daftar Layanan Umum --}}
        {{-- ============================================ --}}
        <a href="{{ route('layanan-pengaduan.daftar-layanan') }}" 
           class="group bg-white h-full rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-blue-300 transition-all duration-300 flex flex-col items-center text-center p-6 border-t-4 border-t-blue-500">
            
            <div class="w-20 h-20 bg-blue-50 group-hover:bg-blue-100 rounded-2xl flex items-center justify-center mb-5 transition-colors">
                <i class="bi bi-tools text-4xl text-blue-600"></i>
            </div>
            
            <h5 class="text-lg font-bold text-gray-800 mb-2">Daftar Layanan</h5>
            <p class="text-sm text-gray-500 mb-6 flex-1">Informasi mengenai berbagai layanan non-perizinan kami.</p>
            
            <span class="inline-flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition">
                Lihat Daftar <i class="bi bi-arrow-right text-xs"></i>
            </span>
        </a>

        {{-- ============================================ --}}
        {{-- Kartu 4: Cek Status Layanan --}}
        {{-- ============================================ --}}
        <a href="{{ route('login') }}" 
           class="group bg-white h-full rounded-2xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-amber-300 transition-all duration-300 flex flex-col items-center text-center p-6 border-t-4 border-t-amber-500">
            
            <div class="w-20 h-20 bg-amber-50 group-hover:bg-amber-100 rounded-2xl flex items-center justify-center mb-5 transition-colors">
                <i class="bi bi-search text-4xl text-amber-600"></i>
            </div>
            
            <h5 class="text-lg font-bold text-gray-800 mb-2">Cek Status</h5>
            <p class="text-sm text-gray-500 mb-6 flex-1">Lacak status permohonan atau pengaduan Anda.</p>
            
            <span class="inline-flex items-center gap-2 bg-amber-500 hover:bg-amber-600 text-white px-5 py-2.5 rounded-lg text-sm font-medium transition">
                Cek Status <i class="bi bi-arrow-right text-xs"></i>
            </span>
        </a>

    </div>
</div>

@endsection