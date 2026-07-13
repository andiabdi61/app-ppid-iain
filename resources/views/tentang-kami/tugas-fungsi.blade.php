@extends('layouts.public_app')

@section('title', 'Tugas & Fungsi')

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION & BREADCRUMB --}}
{{-- ============================================ --}}
@extends('layouts.public_app')

@section('title', 'Tugas Pokok & Fungsi')

@section('content')

{{-- ============================================ --}}
{{-- HERO DINAMIS (Panggil Komponen 1 Baris Ini Saja) --}}
{{-- ============================================ --}}
@extends('layouts.public_app')

@section('title', 'Tugas Pokok & Fungsi')

@section('content')

{{-- ============================================ --}}
{{-- HERO DINAMIS (Panggil Komponen 1 Baris Ini Saja) --}}
{{-- ============================================ --}}
<x-page-hero 
    title="Tugas Pokok & Fungsi" 
    icon="building"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Tentang Kami', 'url' => url('/#tentang-kami')],
        ['label' => 'Tugas & Fungsi']
    ]" 
/>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col gap-8">
            
            {{-- ============================================ --}}
            {{-- CARD 1: TUGAS POKOK --}}
            {{-- ============================================ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                @php
                    $imagePath = 'storage/images/tugas-pokok-bg.webp';
                    $placeholderUrl = 'https://placehold.co/1200x600/E5E7EB/6B7280?text=Gambar+Tugas+Pokok';
                @endphp

                @if(file_exists(public_path($imagePath)))
                    <img src="{{ asset($imagePath) }}" alt="Ilustrasi Tugas Pokok" class="w-full h-64 md:h-80 object-cover">
                @else
                    <img src="{{ $placeholderUrl }}" alt="Placeholder Tugas Pokok" class="w-full h-64 md:h-80 object-cover">
                @endif                    

                <div class="p-6 md:p-8 text-center">
                    <div class="flex items-center justify-center gap-3 mb-6">
                        <div class="w-10 h-10 bg-hijau-100 rounded-xl flex items-center justify-center">
                            <i class="bi bi-bullseye text-hijau-700 text-xl"></i>
                        </div>
                        <h2 class="text-2xl md:text-3xl font-bold text-hijau-800">Tugas Pokok</h2>
                    </div>
                    
                    {{-- GANTI TEKS INI DENGAN TUGAS POKOK RESMI KAMU --}}
                    <p class="text-sm text-gray-500 italic mb-4">
                        Sesuai dengan regulasi dan pedoman pelaksanaan PPID di lingkungan IAIN Bone.
                    </p>
                    <p class="text-gray-700 leading-relaxed text-justify max-w-3xl mx-auto">
                        PPID IAIN Bone mempunyai tugas memberikan pelayanan informasi publik secara cepat, tepat waktu, biaya yang terjangkau/proposal, serta cara dan sarana yang mudah diakses oleh masyarakat, sesuai dengan peraturan perundang-undangan yang berlaku.
                    </p>
                </div>
            </div>
            
            {{-- ============================================ --}}
            {{-- CARD 2: FUNGSI --}}
            {{-- ============================================ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-hijau-100 rounded-xl flex items-center justify-center">
                        <i class="bi bi-gear-wide-connected text-hijau-700 text-xl"></i>
                    </div>
                    <h2 class="text-2xl md:text-3xl font-bold text-hijau-800">Fungsi</h2>
                </div>
                
                {{-- GANTI ISI LIST INI DENGAN FUNGSI RESMI KAMU --}}
                <ol class="space-y-4 list-decimal list-inside text-gray-700 leading-relaxed marker:text-hijau-600 marker:font-bold">
                    <li>Penyediaan, penerbitan, dan pendistribusian informasi publik yang dihasilkan oleh IAIN Bone.</li>
                    <li>Pemberian akses terhadap informasi publik bagi pemohon informasi publik sesuai dengan ketentuan peraturan perundang-undangan.</li>
                    <li>Pelaksanaan uji konsekuensi atas publikasi informasi yang bersifat terbuka dan tertutup.</li>
                    <li>Penyusunan dan pemeliharaan Daftar Informasi Publik (DIP) di lingkungan IAIN Bone.</li>
                    <li>Pelaporan pelaksanaan pelayanan informasi publik kepada Kementerian/Lembaga yang berwenang.</li>
                    <li>Pelaksanaan tugas kedinasan lainnya yang diberikan oleh atasan sesuai dengan bidang tugasnya.</li>
                </ol>
            </div>

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
</div>
@endsection