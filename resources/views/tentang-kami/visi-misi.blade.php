@extends('layouts.public_app')

@section('title', 'Visi Misi')

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION & BREADCRUMB --}}
{{-- ============================================ --}}
<x-page-hero
    title="Visi Misi"
    icon="target"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Tentang Kami']
    ]"
/>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="max-w-4xl mx-auto">
        <div class="flex flex-col gap-8">

            {{-- ============================================ --}}
            {{-- CARD VISI --}}
            {{-- ============================================ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                @php $imagePath = 'storage/images/visi-misi.webp'; @endphp

                @if(file_exists(public_path($imagePath)))
                    <img src="{{ asset($imagePath) }}" alt="Visi PPID IAIN Bone" class="w-full h-64 md:h-80 object-cover">
                @endif

                <div class="p-6 md:p-8 text-center">
                    <p class="text-hijau-600 font-semibold uppercase tracking-wider text-sm mb-4">Visi PPID IAIN BONE</p>

                    <blockquote class="text-2xl md:text-4xl font-extrabold text-hijau-800 my-6 leading-tight">
                        "MENJADI PPID YANG <br>TRANSPARAN DAN AKUNTABEL"
                    </blockquote>

                    <p class="text-gray-600 max-w-2xl mx-auto leading-relaxed">
                        Mewujudkan pelayanan informasi publik yang cepat, tepat, dan akuntabel sesuai dengan amanat Undang-Undang Keterbukaan Informasi Publik.
                    </p>
                </div>
            </div>

            {{-- ============================================ --}}
            {{-- CARD MISI --}}
            {{-- ============================================ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <h3 class="text-xl font-bold text-hijau-700 mb-6 text-center uppercase tracking-wider">Misi</h3>

                <ol class="flex flex-col gap-4">
                    <li class="flex items-start gap-4 bg-gray-50 rounded-xl p-5">
                        <span class="w-8 h-8 bg-hijau-600 text-white rounded-full flex items-center justify-center text-sm font-bold shrink-0">1</span>
                        <p class="text-gray-700 leading-snug pt-1">Meningkatkan layanan informasi yang cepat, tepat, dan transparan</p>
                    </li>
                    <li class="flex items-start gap-4 bg-gray-50 rounded-xl p-5">
                        <span class="w-8 h-8 bg-hijau-600 text-white rounded-full flex items-center justify-center text-sm font-bold shrink-0">2</span>
                        <p class="text-gray-700 leading-snug pt-1">Mengelola informasi dan dokumentasi berdasarkan Undang Undang Nomor 14 Tahun 2018</p>
                    </li>
                    <li class="flex items-start gap-4 bg-gray-50 rounded-xl p-5">
                        <span class="w-8 h-8 bg-hijau-600 text-white rounded-full flex items-center justify-center text-sm font-bold shrink-0">3</span>
                        <p class="text-gray-700 leading-snug pt-1">Mendukung visi dan misi IAIN Bone</p>
                    </li>
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
