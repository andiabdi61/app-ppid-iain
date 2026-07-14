@extends('layouts.public_app')

@section('title', 'PPID Pelaksana')

@section('content')

{{-- HERO SECTION --}}
<x-page-hero 
    title="PPID Pelaksana" 
    icon="users"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'PPID Pelaksana']
    ]" 
/>

{{-- MAIN CONTENT --}}
<section class="bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">
        
        {{-- Penjelasan Singkat --}}
        <div class="text-center max-w-2xl mx-auto mb-12">
            <p class="text-gray-500 text-sm md:text-base leading-relaxed">
                Pejabat Pengelola Informasi dan Dokumentasi (PPID) Pelaksana di lingkungan IAIN Sultan Amaullah Gorontalo berada di tingkat Fakultas. Klik tombol di bawah untuk mengakses layanan informasi publik masing-masing fakultas.
            </p>
        </div>

        {{-- Grid List Fakultas --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">
            
            {{-- 1. Fakultas Tarbiyah --}}
            <a href="https://tarbiyah.iain-bone.ac.id/ppid" target="_blank" rel="noopener noreferrer" 
               class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-hijau-200 transition-all duration-300 overflow-hidden flex flex-col">
                <div class="h-2 bg-gradient-to-r from-blue-500 to-blue-600"></div>
                <div class="p-6 md:p-8 flex flex-col flex-1 text-center">
                    <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-graduation-cap text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-hijau-700 transition-colors">
                        Fakultas Tarbiyah
                    </h3>
                    <p class="text-sm text-gray-500 mb-6 flex-1">Mengelola informasi publik terkait program studi pendidikan dan keguruan.</p>
                    <div class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-50 text-blue-700 rounded-xl text-sm font-semibold group-hover:bg-blue-100 transition-colors">
                        <span>Kunjungi PPID</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    </div>
                </div>
            </a>

            {{-- 2. Fakultas Syariah dan Hukum Islam --}}
            <a href="https://syariah.iain-bone.ac.id/ppid" target="_blank" rel="noopener noreferrer" 
               class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-hijau-200 transition-all duration-300 overflow-hidden flex flex-col">
                <div class="h-2 bg-gradient-to-r from-emerald-500 to-emerald-600"></div>
                <div class="p-6 md:p-8 flex flex-col flex-1 text-center">
                    <div class="w-16 h-16 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-scale-balanced text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-hijau-700 transition-colors">
                        Fak. Syariah & Hukum Islam
                    </h3>
                    <p class="text-sm text-gray-500 mb-6 flex-1">Mengelola informasi publik terkait hukum, syariah, dan peradilan agama.</p>
                    <div class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-emerald-50 text-emerald-700 rounded-xl text-sm font-semibold group-hover:bg-emerald-100 transition-colors">
                        <span>Kunjungi PPID</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    </div>
                </div>
            </a>

            {{-- 3. Fakultas Ekonomi & Bisnis Islam --}}
            <a href="https://febi.iain-bone.ac.id/ppid" target="_blank" rel="noopener noreferrer" 
               class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-hijau-200 transition-all duration-300 overflow-hidden flex flex-col">
                <div class="h-2 bg-gradient-to-r from-amber-500 to-amber-600"></div>
                <div class="p-6 md:p-8 flex flex-col flex-1 text-center">
                    <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-chart-line text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-hijau-700 transition-colors">
                        Fak. Ekonomi & Bisnis Islam
                    </h3>
                    <p class="text-sm text-gray-500 mb-6 flex-1">Mengelola informasi publik terkait ekonomi syariah, akuntansi, dan bisnis islam.</p>
                    <div class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-amber-50 text-amber-700 rounded-xl text-sm font-semibold group-hover:bg-amber-100 transition-colors">
                        <span>Kunjungi PPID</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    </div>
                </div>
            </a>

            {{-- 4. Fakultas Ushuluddin dan Dakwah --}}
            <a href="https://fud.iain-bone.ac.id/ppid" target="_blank" rel="noopener noreferrer" 
               class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-hijau-200 transition-all duration-300 overflow-hidden flex flex-col">
                <div class="h-2 bg-gradient-to-r from-purple-500 to-purple-600"></div>
                <div class="p-6 md:p-8 flex flex-col flex-1 text-center">
                    <div class="w-16 h-16 bg-purple-50 text-purple-600 rounded-2xl flex items-center justify-center mx-auto mb-5 group-hover:scale-110 transition-transform duration-300">
                        <i class="fa-solid fa-mosque text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-bold text-gray-800 mb-2 group-hover:text-hijau-700 transition-colors">
                        Fak. Ushuluddin & Dakwah
                    </h3>
                    <p class="text-sm text-gray-500 mb-6 flex-1">Mengelola informasi publik terkait aqidah, studi islam, dan dakwah.</p>
                    <div class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-purple-50 text-purple-700 rounded-xl text-sm font-semibold group-hover:bg-purple-100 transition-colors">
                        <span>Kunjungi PPID</span>
                        <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
                    </div>
                </div>
            </a>

        </div>
    </div>
</section>

@endsection