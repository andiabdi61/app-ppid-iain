@extends('layouts.public_app')

@section('title', 'Alur Pengajuan Keberatan Informasi')

@section('content')

{{-- Hero Section --}}
<x-page-hero 
    title="Alur Pengajuan Keberatan" 
    icon="target"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Informasi Publik', 'url' => route('informasi-publik.index')],
        ['label' => 'Alur Pengajuan Keberatan']
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
                <div class="relative flex flex-col md:flex-row md:items-center mb-8 group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pr-10 md:text-right">
                        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm group-hover:shadow-md group-hover:border-hijau-200 transition-all duration-300">
                            <p class="text-sm text-gray-700 leading-relaxed">Pemohon keberatan mengisi formulir pengajuan keberatan secara online atau datang langsung ke Kantor PPID.</p>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-hijau-600 border-4 border-white shadow-sm flex items-center justify-center">
                        <span class="text-[9px] font-bold text-white">1</span>
                    </div>
                    <div class="hidden md:block md:w-1/2 md:pl-10"></div>
                </div>

                {{-- LANGKAH 2 --}}
                <div class="relative flex flex-col md:flex-row-reverse md:items-center mb-8 group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pl-10">
                        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm group-hover:shadow-md group-hover:border-hijau-200 transition-all duration-300">
                            <p class="text-sm text-gray-700 leading-relaxed">Melengkapi nomor registrasi permohonan informasi sebelumnya dan alasan keberatan yang jelas.</p>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-hijau-600 border-4 border-white shadow-sm flex items-center justify-center">
                        <span class="text-[9px] font-bold text-white">2</span>
                    </div>
                    <div class="hidden md:block md:w-1/2 md:pr-10"></div>
                </div>

                {{-- LANGKAH 3 --}}
                <div class="relative flex flex-col md:flex-row md:items-center mb-8 group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pr-10 md:text-right">
                        <div class="bg-white rounded-xl border border-gray-200 p-4 shadow-sm group-hover:shadow-md group-hover:border-hijau-200 transition-all duration-300">
                            <p class="text-sm text-gray-700 leading-relaxed">Petugas PPID menerima dan memverifikasi pengajuan keberatan.</p>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-hijau-600 border-4 border-white shadow-sm flex items-center justify-center">
                        <span class="text-[9px] font-bold text-white">3</span>
                    </div>
                    <div class="hidden md:block md:w-1/2 md:pl-10"></div>
                </div>

                {{-- LANGKAH 4 (Highlight) --}}
                <div class="relative flex flex-col md:flex-row-reverse md:items-center mb-8 group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pl-10">
                        <div class="bg-hijau-50/50 rounded-xl border border-hijau-200 p-4 shadow-sm group-hover:shadow-md transition-all duration-300">
                            <p class="text-sm text-gray-700 leading-relaxed">PPID akan memberikan tanggapan atas keberatan paling lambat <strong class="text-hijau-700">30 hari kerja</strong> sejak permohonan keberatan diterima.</p>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-hijau-600 border-4 border-white shadow-sm flex items-center justify-center ring-4 ring-hijau-100">
                        <span class="text-[9px] font-bold text-white">4</span>
                    </div>
                    <div class="hidden md:block md:w-1/2 md:pr-10"></div>
                </div>

                {{-- LANGKAH 5 (Dua kondisi) --}}
                <div class="relative flex flex-col md:flex-row md:items-center group">
                    <div class="ml-12 md:ml-0 md:w-1/2 md:pr-10 md:text-right">
                        <div class="space-y-3">
                            {{-- Kondisi Diterima --}}
                            <div class="bg-white rounded-xl border border-green-200 p-4 shadow-sm group-hover:shadow-md transition-all duration-300">
                                <div class="flex items-start gap-2">
                                    <i class="bi bi-check-circle-fill text-green-500 mt-0.5 shrink-0"></i>
                                    <p class="text-sm text-gray-700 leading-relaxed">Jika keberatan <strong class="text-green-700">diterima</strong>, informasi akan diberikan.</p>
                                </div>
                            </div>
                            {{-- Kondisi Ditolak --}}
                            <div class="bg-white rounded-xl border border-red-200 p-4 shadow-sm group-hover:shadow-md transition-all duration-300">
                                <div class="flex items-start gap-2">
                                    <i class="bi bi-x-circle-fill text-red-500 mt-0.5 shrink-0"></i>
                                    <p class="text-sm text-gray-700 leading-relaxed">Jika <strong class="text-red-700">ditolak</strong>, pemohon berhak mengajukan sengketa informasi ke <strong class="text-red-700">Komisi Informasi</strong>.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute left-3 md:left-1/2 md:-translate-x-1/2 w-5 h-5 rounded-full bg-gray-800 border-4 border-white shadow-sm flex items-center justify-center">
                        <span class="text-[9px] font-bold text-white">5</span>
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