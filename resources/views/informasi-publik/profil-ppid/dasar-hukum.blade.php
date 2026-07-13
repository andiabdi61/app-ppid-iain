@extends('layouts.public_app')

@section('title', 'Dasar Hukum PPID')

@section('content')

{{-- ============================================ --}}
{{-- HERO DINAMIS --}}
{{-- ============================================ --}}
<x-page-hero 
    title="Dasar Hukum" 
    icon="doc"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Informasi Publik', 'url' => route('informasi-publik.index')],
        ['label' => 'Profil PPID', 'url' => route('informasi-publik.profil-ppid.index')],
        ['label' => 'Dasar Hukum']
    ]" 
/>

{{-- ============================================ --}}
{{-- KONTEN --}}
{{-- ============================================ --}}
<section class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-10">
            
            {{-- Header Halaman --}}
            <div class="text-center mb-8 pb-8 border-b border-slate-100">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-hijau-50 rounded-2xl mb-4">
                    <svg class="w-8 h-8 text-hijau-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <h1 class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight">Dasar Hukum Pembentukan PPID</h1>
                <p class="text-slate-500 mt-2 text-sm md:text-base">Landasan hukum operasional PPID IAIN Bone dalam memberikan pelayanan informasi publik.</p>
            </div>

            {{-- Daftar Dasar Hukum (Menggunakan Prose) --}}
            <div class="prose prose-sm md:prose-base max-w-none
                        prose-headings:text-slate-800 prose-headings:font-bold
                        prose-li:text-slate-600
                        prose-strong:text-slate-800
                        prose-p:text-slate-600 prose-p:leading-relaxed">
                
                <p>Pembentukan dan operasional PPID IAIN Bone berlandaskan pada peraturan perundang-undangan sebagai berikut:</p>
                
                <ol>
                    <li><strong>Undang-Undang Nomor 14 Tahun 2008</strong> tentang Keterbukaan Informasi Publik.</li>
                    <li><strong>Peraturan Pemerintah Nomor 61 Tahun 2010</strong> tentang Pelaksanaan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan Informasi Publik.</li>
                    <li><strong>Peraturan Komisi Informasi Pusat Republik Indonesia Nomor 1 Tahun 2021</strong> tentang Standar Layanan Informasi Publik.</li>
                    <li><strong>Peraturan Menteri Dalam Negeri Republik Indonesia Nomor 3 Tahun 2017</strong> tentang Pedoman Pengelolaan Pelayanan Informasi dan Dokumentasi Kementerian Dalam Negeri dan Pemerintahan Daerah.</li>
                    <li><strong>Keputusan Rektor IAIN Bone</strong> tentang Pembentukan Pejabat Pengelola Informasi dan Dokumentasi di Lingkungan IAIN Bone.</li>
                    <li><strong>Keputusan Kepala Biro AUPPK IAIN Bone</strong> tentang Pembentukan Tim Pelaksana dan Atasan Pejabat Pengelola Informasi dan Dokumentasi di Lingkungan IAIN Bone.</li>
                </ol>

                <p>Peraturan-peraturan ini menjamin hak setiap warga negara untuk memperoleh informasi publik sesuai dengan ketentuan yang berlaku.</p>

            </div>

        </div>

        {{-- Tombol Aksi --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-8">
            <a href="{{ route('informasi-publik.profil-ppid.index') }}" 
               class="flex items-center gap-2 px-5 py-2.5 bg-white text-slate-700 rounded-xl text-sm font-medium hover:bg-gray-100 transition-colors duration-300 shadow-sm border border-slate-200 w-full sm:w-auto justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                </svg>
                Kembali ke Profil PPID
            </a>
            <a href="{{ url('/') }}" 
               class="flex items-center gap-2 px-5 py-2.5 bg-hijau-600 text-white rounded-xl text-sm font-medium hover:bg-hijau-700 shadow-lg shadow-hijau-600/30 hover:shadow-hijau-600/50 transition-all duration-300 w-full sm:w-auto justify-center">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

    </div>
</section>

@endsection