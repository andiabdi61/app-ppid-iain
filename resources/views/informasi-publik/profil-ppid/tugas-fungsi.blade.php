@extends('layouts.public_app')

@section('title', 'Tugas & Fungsi PPID')

@section('content')

{{-- ============================================ --}}
{{-- HERO DINAMIS --}}
{{-- ============================================ --}}
<x-page-hero 
    title="Tugas & Fungsi PPID" 
    icon="target"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Informasi Publik', 'url' => route('informasi-publik.index')],
        ['label' => 'Profil PPID', 'url' => route('informasi-publik.profil-ppid.index')],
        ['label' => 'Tugas & Fungsi']
    ]" 
/>

{{-- ============================================ --}}
{{-- KONTEN --}}
{{-- ============================================ --}}
<section class="bg-gray-50 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-12">
        
        <div class="space-y-6 md:space-y-8">
            
            {{-- ========================================== --}}
            {{-- SECTION 1: TUGAS POKOK --}}
            {{-- ========================================== --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8 overflow-hidden">
                <div class="flex items-center gap-3 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-10 h-10 bg-hijau-100 text-hijau-700 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2h12a2 2 0 002 2v10a2 2 0 002-2H9a2 2 0 00-2-2h.01M9 5l5 5m0 0l-5 5m0 0l5 5M13 10V13a1 1 0 01-1 1h-1m-2 0h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-800">Tugas Pokok PPID</h2>
                </div>

                <div class="pl-2 md:pl-4 border-l-4 border-hijau-200 space-y-4">
                    <p class="text-slate-600 text-sm md:text-base leading-relaxed">
                        Melaksanakan tugas dan fungsi sebagai Pejabat Pengelola Informasi dan Dokumentasi di lingkungan IAIN Bone sesuai dengan peraturan perundang-undangan yang berlaku.
                    </p>
                </div>
            </div>

            {{-- ========================================== --}}
            {{-- SECTION 2: FUNGSI PPID --}}
            {{-- ========================================== --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6 pb-6 border-b border-slate-100">
                    <div class="w-10 h-10 bg-emerald-100 text-emerald-700 rounded-xl flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2h12a2 2 0 002 2v10a2 2 0 002-2H9a2 2 0 00-2-2h.01M9 5l5 5m0 0l-5 5m0 0l5 5M13 10V13a1 1 0 01-1 1h-1m-2 0h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <h2 class="text-xl md:text-2xl font-bold text-slate-800">Fungsi PPID</h2>
                </div>

                <div class="pl-2 md:pl-4 border-l-4 border-emerald-200 space-y-5">
                    <p class="text-slate-600 text-sm md:text-base leading-relaxed mb-4">
                        Secara umum, PPID IAIN Bone memiliki fungsi sebagai berikut:
                    </p>

                    <div class="space-y-3">
                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 font-bold text-sm">
                                1
                            </div>
                            <p class="text-slate-700 text-sm">Penyimpanan, pendokumentasian, penyediaan, dan pelayanan informasi publik.</p>
                        </div>
                        
                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 font-bold text-sm">
                                2
                            </div>
                            <p class="text-slate-700 text-sm">Pengelolaan sistem informasi dan dokumentasi yang mudah diakses oleh masyarakat.</p>
                        </div>
                        
                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-sedia-100">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 font-bold text-sm">
                                3
                            </div>
                            <p class="text-slate-700 text-sm">Penetapan standar operasional prosedur (SOP) pelayanan informasi publik.</p>
                        </div>
                        
                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 font-bold text-sm">
                                4
                            </div>
                            <p class="text-slate-700 text-sm">Melakukan pengujian konsekuensi atas informasi yang dikecualikan.</p>
                        </div>
                        
                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 font-bold text-sm">
                                5
                            </div>
                            <p class="text-slate-700 text-sm">Melakukan klasifikasi informasi publik.</p>
                        </div>
                        
                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 font-bold text-sm">
                                6
                            </div>
                            <p class="text-slate-700 text-sm">Mengelola pengajuan keberatan dan proses sengketa informasi.</p>
                        </div>
                        
                        <div class="flex items-start gap-3 p-3 bg-slate-50 rounded-xl border border-slate-100">
                            <div class="w-8 h-8 rounded-lg bg-emerald-100 text-emerald-700 flex items-center justify-center shrink-0 font-bold text-sm">
                                7
                            </div>
                            <p class="text-slate-700 text-sm">Menyusun laporan layanan informasi publik secara berkala.</p>
                        </div>
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
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-linecap="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/>
                </svg>
                Kembali ke Beranda
            </a>
        </div>

    </div>
</section>

@endsection