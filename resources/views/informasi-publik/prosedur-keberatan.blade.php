@extends('layouts.public_app')

@section('title', 'Alur Pengajuan Keberatan Informasi')

@section('content')

{{-- Hero Section --}}
<x-page-hero 
    title="Alur Pengajuan Keberatan" 
    icon="target"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Layanan']
    ]"
/>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
    <div class="flex justify-center">
        <div class="w-full max-w-4xl">

            {{-- ============================================ --}}
            {{-- INFOGRAFIS --}}
            {{-- ============================================ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 text-center p-5 mb-10">
                <h4 class="text-sm font-semibold text-gray-400 uppercase tracking-wider">Infografis Alur Keberatan</h4>
                @php
                    $infografisPath = 'images/infografis-keberatan.png';
                    $placeholderUrl = 'https://placehold.co/1200x600/E5E7EB/6B7280?text=Infografis+Alur+Keberatan';
                @endphp
                @if(file_exists(public_path($infografisPath)))
                    <img src="{{ asset($infografisPath) }}" alt="Infografis Alur Pengajuan Keberatan" class="w-full rounded-xl mt-4">
                @else
                    <img src="{{ $placeholderUrl }}" alt="Placeholder Infografis" class="w-full rounded-xl mt-4">
                @endif
            </div>
            
            {{-- ============================================ --}}
            {{-- FLOWCHART / TIMELINE --}}
            {{-- ============================================ --}}
            <div class="relative">
                
                {{-- Garis Vertikal --}}
                <div class="absolute left-5 md:left-1/2 md:-translate-x-px top-0 bottom-0 w-0.5 bg-gray-200"></div>

                {{-- LANGKAH 1 --}}
                <div class="relative flex flex-col md:flex-row md:items-center mb-5 group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pr-10 md:text-right">
                        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm group-hover:shadow-md group-hover:border-hijau-200 transition-all duration-300">
                            <p class="text-sm font-bold text-hijau-800 mb-1">Pemohon Mengajukan Permohonan Informasi</p>
                            <p class="text-sm text-gray-700 leading-snug">Pemohon mengajukan permohonan informasi ke PPID melalui berbagai layanan (loket, surat, email, atau online).</p>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-hijau-600 border-4 border-white shadow-sm flex items-center justify-center">
                        <span class="text-[9px] font-bold text-white">1</span>
                    </div>
                    <div class="hidden md:block md:w-1/2 md:pl-10"></div>
                </div>

                {{-- LANGKAH 2 --}}
                <div class="relative flex flex-col md:flex-row-reverse md:items-center mb-5 group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pl-10">
                        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm group-hover:shadow-md group-hover:border-hijau-200 transition-all duration-300">
                            <p class="text-sm font-bold text-hijau-800 mb-1">Petugas Menerima dan Memeriksa Permohonan</p>
                            <p class="text-sm text-gray-700 leading-snug">Petugas Layanan Informasi melakukan pemeriksaan awal atas permohonan yang diajukan oleh Pemohon.</p>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-hijau-600 border-4 border-white shadow-sm flex items-center justify-center">
                        <span class="text-[9px] font-bold text-white">2</span>
                    </div>
                    <div class="hidden md:block md:w-1/2 md:pr-10"></div>
                </div>

                {{-- LANGKAH 3 --}}
                <div class="relative flex flex-col md:flex-row md:items-center mb-5 group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pr-10 md:text-right">
                        <div class="bg-white rounded-xl border border-amber-200 bg-amber-50/40 p-4 shadow-sm group-hover:shadow-md transition-all duration-300">
                            <p class="text-sm font-bold text-amber-700 mb-1">Pemeriksaan Kelengkapan Permohonan</p>
                            <p class="text-sm text-gray-700 leading-snug">Jika berkas permohonan belum memenuhi syarat, petugas akan memberikan catatan atas kekurangan berkas yang harus dilengkapi/diperbaiki.</p>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-amber-500 border-4 border-white shadow-sm flex items-center justify-center">
                        <span class="text-[9px] font-bold text-white">3</span>
                    </div>
                    <div class="hidden md:block md:w-1/2 md:pl-10"></div>
                </div>

                {{-- LANGKAH 4 --}}
                <div class="relative flex flex-col md:flex-row-reverse md:items-center mb-5 group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pl-10">
                        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm group-hover:shadow-md group-hover:border-hijau-200 transition-all duration-300">
                            <p class="text-sm font-bold text-hijau-800 mb-1">Pencatatan Permohonan yang Memenuhi Syarat</p>
                            <p class="text-sm text-gray-700 leading-snug">Permohonan yang telah memenuhi syarat dicatatkan dalam register permohonan informasi dan diteruskan kepada PPID.</p>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-hijau-600 border-4 border-white shadow-sm flex items-center justify-center">
                        <span class="text-[9px] font-bold text-white">4</span>
                    </div>
                    <div class="hidden md:block md:w-1/2 md:pr-10"></div>
                </div>

                {{-- LANGKAH 5 --}}
                <div class="relative flex flex-col md:flex-row md:items-center mb-5 group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pr-10 md:text-right">
                        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm group-hover:shadow-md group-hover:border-hijau-200 transition-all duration-300">
                            <p class="text-sm font-bold text-hijau-800 mb-1">Pengelolaan Permohonan oleh PPID</p>
                            <p class="text-sm text-gray-700 leading-snug">PPID menganalisis berkas permohonan dengan mengacu pada Daftar Informasi Publik (DIP) dan Daftar Informasi yang Dikecualikan (DIK) untuk menentukan jenis informasi.</p>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-hijau-600 border-4 border-white shadow-sm flex items-center justify-center">
                        <span class="text-[9px] font-bold text-white">5</span>
                    </div>
                    <div class="hidden md:block md:w-1/2 md:pl-10"></div>
                </div>

                {{-- LANGKAH 6 --}}
                <div class="relative flex flex-col md:flex-row-reverse md:items-center mb-5 group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pl-10">
                        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm group-hover:shadow-md group-hover:border-hijau-200 transition-all duration-300">
                            <p class="text-sm font-bold text-hijau-800 mb-1">Penentuan Status Informasi</p>
                            <p class="text-sm text-gray-700 leading-snug">Jika informasi termasuk yang dikecualikan, PPID berkoordinasi dengan PPID Unit terkait untuk menyiapkan informasi yang dapat diberikan kepada pemohon.</p>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-hijau-600 border-4 border-white shadow-sm flex items-center justify-center">
                        <span class="text-[9px] font-bold text-white">6</span>
                    </div>
                    <div class="hidden md:block md:w-1/2 md:pr-10"></div>
                </div>

                {{-- LANGKAH 7 --}}
                <div class="relative flex flex-col md:flex-row md:items-center mb-5 group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pr-10 md:text-right">
                        <div class="bg-white rounded-xl border border-hijau-200 bg-hijau-50/50 p-4 shadow-sm group-hover:shadow-md transition-all duration-300">
                            <p class="text-sm font-bold text-hijau-800 mb-1">Penyusunan Jawaban oleh PPID</p>
                            <p class="text-sm text-gray-700 leading-snug">PPID memiliki waktu maksimal 10 hari kerja untuk memberikan jawaban. Jika diperlukan, dapat diperpanjang maksimal 7 hari kerja dengan pemberitahuan tertulis kepada pemohon.</p>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-hijau-600 border-4 border-white shadow-sm flex items-center justify-center ring-4 ring-hijau-100">
                        <span class="text-[9px] font-bold text-white">7</span>
                    </div>
                    <div class="hidden md:block md:w-1/2 md:pl-10"></div>
                </div>

                {{-- LANGKAH 8 --}}
                <div class="relative flex flex-col md:flex-row-reverse md:items-center mb-5 group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pl-10">
                        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm group-hover:shadow-md group-hover:border-hijau-200 transition-all duration-300">
                            <p class="text-sm font-bold text-hijau-800 mb-1">Penyampaian Jawaban kepada Pemohon</p>
                            <p class="text-sm text-gray-700 leading-snug">PPID menyampaikan surat jawaban berikut informasi yang diminta kepada Pemohon melalui Petugas Layanan Informasi.</p>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-hijau-600 border-4 border-white shadow-sm flex items-center justify-center">
                        <span class="text-[9px] font-bold text-white">8</span>
                    </div>
                    <div class="hidden md:block md:w-1/2 md:pr-10"></div>
                </div>

                {{-- LANGKAH 9 --}}
                <div class="relative flex flex-col md:flex-row md:items-center group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pr-10 md:text-right">
                        <div class="bg-white rounded-xl border border-hijau-200 bg-hijau-50/50 p-4 shadow-sm group-hover:shadow-md transition-all duration-300">
                            <p class="text-sm font-bold text-hijau-800 mb-1">Penyampaian Jawaban oleh Petugas Layanan Informasi</p>
                            <p class="text-sm text-gray-700 leading-snug">Petugas Layanan Informasi mencatatkan surat jawaban dalam register, menyampaikan informasi kepada pemohon dan mengarsipkan dokumen sebagai arsip Pengelolaan Dokumen.</p>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-hijau-600 border-4 border-white shadow-sm flex items-center justify-center">
                        <span class="text-[9px] font-bold text-white">9</span>
                    </div>
                    <div class="hidden md:block md:w-1/2 md:pl-10"></div>
                </div>

            </div>

            {{-- ============================================ --}}
            {{-- TOMBOL CTA --}}
            {{-- ============================================ --}}
            <div class="text-center mt-12">
                <a href="{{ route('informasi-publik.keberatan.form') }}" 
                   class="inline-flex items-center gap-2 px-8 py-3.5 rounded-xl text-sm font-semibold bg-hijau-600 text-white hover:bg-hijau-700 transition-all shadow-md shadow-hijau-600/20 hover:shadow-lg hover:shadow-hijau-600/30">
                    <i class="bi bi-send-fill"></i>
                    Ajukan Keberatan Sekarang
                </a>
            </div>

        </div>
    </div>
</div>
@endsection