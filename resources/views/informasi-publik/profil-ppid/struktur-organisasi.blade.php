@extends('layouts.public_app')

@section('title', 'Struktur Organisasi PPID')

@section('content')

{{-- ============================================ --}}
{{-- HERO DINAMIS --}}
{{-- ============================================ --}}
<x-page-hero 
    title="Struktur Organisasi PPID" 
    icon="building"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Informasi Publik', 'url' => route('informasi-publik.index')],
        ['label' => 'Profil PPID', 'url' => route('informasi-publik.profil-ppid.index')],
        ['label' => 'Struktur Organisasi']
    ]" 
/>

{{-- ============================================ --}}
{{-- KONTEN --}}
{{-- ============================================ --}}
<section class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            
            {{-- Wrapper Gambar Bagan --}}
            <div class="bg-slate-100 p-4 md:p-8 flex justify-center">
                {{-- Container Gambar dengan Batas Maksimal --}}
                <div class="w-full max-w-3xl" style="max-height: 600px; overflow: auto;">
                    <img src="{{ asset('images/struktur_ppid.png') }}" 
                         alt="Bagan Struktur Organisasi PPID IAIN Bone" 
                         class="w-full h-auto object-contain rounded-lg shadow-md">
                </div>
            </div>
            
            {{-- Penjelasan Struktur --}}
            <div class="p-6 md:p-10">
                
                <h2 class="text-xl md:text-2xl font-bold text-slate-800 mb-2 flex items-center gap-3">
                    <div class="w-1.5 h-8 bg-hijau-600 rounded-full"></div>
                    Penjelasan Struktur
                </h2>
                <p class="text-slate-600 text-sm md:text-base mb-6 leading-relaxed">
                    Struktur PPID IAIN Bone dirancang untuk menjamin alur koordinasi dan pelayanan informasi publik yang efektif, terdiri dari:
                </p>

                <div class="prose prose-sm md:prose-base max-w-none text-slate-600
                            prose-li:text-slate-600
                            prose-strong:text-slate-800">
                    <ul class="list-none space-y-4 pl-0">
                        <li class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-hijau-100 text-hijau-700 flex items-center justify-center shrink-0 font-bold text-sm">
                                1
                            </div>
                            <div>
                                <strong class="text-slate-800">Atasan PPID:</strong> 
                                <p class="text-slate-600 text-sm mt-1 mb-0">Pejabat yang bertanggung jawab tertinggi dalam pelaksanaan tugas PPID.</p>
                            </div>
                        </li>
                        
                        <li class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-hijau-100 text-hijau-700 flex items-center justify-center shrink-0 font-bold text-sm">
                                2
                            </div>
                            <div>
                                <strong class="text-slate-800">PPID:</strong> 
                                <p class="text-slate-600 text-sm mt-1 mb-0">Pejabat yang bertanggung jawab atas pengelolaan dan pelayanan informasi dan dokumentasi.</p>
                            </div>
                        </li>
                        
                        <li class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-hijau-100 text-hijau-700 flex items-center justify-center shrink-0 font-bold text-sm">
                                3
                            </div>
                            <div>
                                <strong class="text-slate-800">PPID Pelaksana:</strong> 
                                <p class="text-slate-600 text-sm mt-1 mb-0">Staf atau unit yang bertugas melaksanakan pelayanan informasi secara langsung.</p>
                            </div>
                        </li>
                        
                        <li class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-hijau-100 text-hijau-700 flex items-center justify-center shrink-0 font-bold text-sm">
                                4
                            </div>
                            <div>
                                <strong class="text-slate-800">Tim Pertimbangan:</strong> 
                                <p class="text-slate-600 text-sm mt-1 mb-0">Tim yang memberikan masukan dan pertimbangan terkait permohonan informasi yang kompleks atau berpotensi dikecualikan.</p>
                            </div>
                        </li>
                    </ul>
                </div>

                <div class="mt-6 p-4 bg-hijau-50 border border-hijau-100 rounded-xl">
                    <div class="flex items-start gap-3">
                        <svg class="w-5 h-5 text-hijau-600 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <p class="text-sm text-hijau-700 font-medium mb-0">Setiap komponen struktur memiliki peran vital dalam menjamin hak masyarakat atas informasi.</p>
                    </div>
                </div>

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