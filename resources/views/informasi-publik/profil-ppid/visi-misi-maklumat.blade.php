@extends('layouts.public_app')

@section('title', 'Visi, Misi & Maklumat PPID')

@section('content')

{{-- ============================================ --}}
{{-- HERO DINAMIS --}}
{{-- ============================================ --}}
<x-page-hero 
    title="Visi, Misi & Maklumat Pelayanan" 
    icon="target"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Visi, Misi & Maklumat']
    ]" 
/>

{{-- ============================================ --}}
{{-- KONTEN --}}
{{-- ============================================ --}}
<section class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        
        <div class="space-y-6 md:space-y-8">

            {{-- ========================================== --}}
            {{-- SECTION 1: VISI (Kutipan Estetik) --}}
            {{-- ========================================== --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-10 relative overflow-hidden">
                {{-- Dekorasi Belakang Kutipan --}}
                <div class="absolute top-4 right-4 opacity-5 text-blue-600">
                    <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M14.017 21v-7.391c0-5.704 3.731-9.303 7.303-9.303 9.303-7.303 0-4.049-1.323-7.391-1.323-7.391 4.049 0 7.391 3.731 7.391 9.303 7.303 9.303 7.303 4.049 0 7.391-3.731 7.391-7.391zM14.017 3.1V1a1 1 0 00-1-1h-1a1 1 0 00-1-1h-1a1 1 0 00-1-1v1.999l5.003 5.003c0 2.761 -2.242 5.003-5.003 5.003 -2.761 0-5.003 2.242 -5.003 5.003h-1.003c-2.761 0-5.003 2.242 -5.003 5.003v-1.003c0-2.761 2.242-5.003 5.003-5.003 2.761 0 -5.003 2.242 -5.003 5.003h-1.003Z"/></svg>
                </div>

                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-xl flex items-center justify-center shrink-0">
                            <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <h2 class="text-xl md:text-2xl font-bold text-slate-800">Visi PPID</h2>
                    </div>

                    {{-- Blok Kutipan Besar --}}
                    <div class="relative pl-6 border-l-4 border-blue-500 py-6 bg-blue-50/50 rounded-r-xl">
                        <svg class="absolute -left-3 -top-0 w-6 h-6 text-blue-500 transform -translate-x-1/2 rotate-45 -translate-y-1/2 rounded-full bg-white shadow border-2 border-blue-500"></svg>
                        <blockquote class="relative z-10">
                            <p class="text-lg md:text-xl text-slate-700 leading-relaxed italic">
                                "Terwujudnya Pelayanan Informasi Publik yang Transparan, Akuntabel, dan Inklusif demi Terpenuhinya Hak Masyarakat atas Informasi."
                            </p>
                        </blockquote>
                    </div>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- SECTION 2: MISI (Daftar Checklist Modern) --}}
            {{-- ========================================== --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-10 h-10 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-start="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2h12a2 2 0 002 2v10a2 2 0 002-2H9a2 2 0 00-2-2h.01M9 5l5 5m0 0l-5 5m0 0l5 5M13 10V13a1 1 0 01-1 1h-1m-2 0h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-800">Misi PPID</h2>
                </div>

                <div class="space-y-3">
                    <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 font-bold text-sm">
                            1
                        </div>
                        <p class="text-slate-700 text-sm">Meningkatkan kualitas pengelolaan dan pelayanan informasi publik yang mudah diakses.</p>
                    </div>
                    
                    <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 font-bold text-sm">
                            2
                        </div>
                        <p class="text-slate-700 text-sm">Menyediakan informasi publik secara cepat, tepat waktu, akurat, dan biaya ringan.</p>
                    </div>
                    
                    <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 font-bold text-sm">
                            3
                        </div>
                        <p class="text-slate-700 text-sm">Membangun sistem dokumentasi dan pengarsipan informasi yang tertib dan modern.</p>
                    </div>
                    
                    <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                        <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 font-bold text-sm">
                            4
                        </div>
                        <p class="text-slate-700 text-sm">Meningkatkan kapasitas dan kompetensi petugas PPID dalam melayani masyarakat.</p>
                    </div>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- SECTION 3: MAKLUMAT (Info Box Biru Modern) --}}
            {{-- ========================================== --}}
            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-5 md:p-8">
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-10 h-10 bg-blue-600 text-white rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <h2 class="text-lg font-bold text-blue-900 mb-1">Maklumat Pelayanan PPID</h2>
                        <p class="text-blue-700 text-sm">Pernyataan resmi dari PPID IAIN Bone</p>
                    </div>
                </div>

                <div class="bg-white rounded-xl p-5 border border-blue-100 shadow-sm">
                    <p class="text-slate-700 text-sm italic leading-relaxed mb-0">
                        "Dengan ini kami menyatakan sanggup menyelenggarakan pelayanan informasi publik sesuai standar operasional prosedur yang telah ditetapkan dan apabila tidak menepati janji ini, kami siap menerima sanksi sesuai peraturan perundang-undangan yang berlaku."
                    </p>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

    </div>
</section>

@endsection