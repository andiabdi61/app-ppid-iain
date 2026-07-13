@extends('layouts.public_app')

@section('title', 'Pengaduan Masyarakat')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 md:pt-8 pb-12">
    <div class="max-w-2xl mx-auto">
        
        {{-- BREADCRUMB & JUDUL --}}
    
        
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-10">Sistem Pengaduan Masyarakat</h1>

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 md:p-12 text-center">
            
            {{-- Logo SP4N --}}
            <div class="w-32 h-32 bg-red-50 rounded-3xl flex items-center justify-center mx-auto mb-8">
                <img src="https://www.lapor.go.id/themes/lapor/assets/images/logo.png" alt="Logo SP4N-LAPOR!" class="w-24 h-24 object-contain">
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-4">SP4N-LAPOR!</h2>
            
            <p class="text-gray-600 leading-relaxed mb-3">
                PPID IAIN Bone berkomitmen untuk menanggapi setiap pengaduan, kritik, dan saran dari masyarakat secara profesional.
            </p>
            <p class="text-sm text-gray-500 mb-8">
                Klik tombol di bawah ini untuk menuju portal resmi <strong>Sistem Pengelolaan Pengaduan Pelayanan Publik Nasional (SP4N-LAPOR!)</strong>.
            </p>
            
            {{-- Tombol CTA Besar --}}
            <a href="https://www.lapor.go.id/" target="_blank" 
               class="inline-flex items-center gap-3 bg-red-500 hover:bg-red-600 text-white px-10 py-4 rounded-xl text-lg font-bold transition shadow-lg hover:shadow-xl">
                <i class="bi bi-megaphone-fill text-xl"></i> 
                Ajukan via SP4N-LAPOR!
            </a>

        </div>

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
</div>

@endsection