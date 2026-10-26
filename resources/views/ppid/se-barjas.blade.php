@extends('layouts.public_app')

@section('title', 'Pengadaan Barang & Jasa')

@section('content')

{{-- HERO SECTION --}}
<x-page-hero
  title="Sistem Elektronik Pengadaan Barang dan Jasa"
  icon="briefcase"
  :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')]
    ]" />

{{-- MAIN CONTENT --}}
<section class="bg-gray-50 min-h-screen">
  <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-10 md:py-16">

    {{-- Grid List Sistem --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 md:gap-8">

      {{-- 1. SiRUP --}}
      <a href="https://sirup.inaproc.id/sirup/loginctr/index" target="_blank" rel="noopener noreferrer"
        class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-blue-200 transition-all duration-300 overflow-hidden flex flex-col">

        <div class="h-2 bg-gradient-to-r from-blue-500 to-blue-700"></div>

        <div class="p-6 md:p-8 flex flex-col flex-1 text-center">
          {{-- Area Gambar Full Size --}}
          <div class="w-full h-48 flex items-center justify-center bg-blue-50 rounded-2xl mb-6 overflow-hidden group-hover:bg-blue-100 transition-colors">
            <img src="{{ asset('images/sirup.png') }}" alt="Logo SiRUP" class="max-h-full w-auto object-contain p-4 group-hover:scale-110 transition-transform duration-300" loading="lazy">
          </div>

          <h3 class="text-lg font-bold text-gray-800 mb-1 group-hover:text-blue-700 transition-colors">
            SiRUP
          </h3>
          <p class="text-xs text-blue-500 font-semibold mb-3">Sistem Informasi Rencana Umum Pengadaan</p>
          <p class="text-sm text-gray-500 mb-6 flex-1">Merencanakan paket pengadaan barang dan jasa secara transparan dan akuntabel.</p>

          <div class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-blue-50 text-blue-700 rounded-xl text-sm font-semibold group-hover:bg-blue-100 transition-colors">
            <span>Kunjungi Situs</span>
            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
          </div>
        </div>
      </a>

      {{-- 2. INAPROC (Sesuaikan jika Anda juga mengganti icon INAPROC dengan gambar) --}}
      <a href="https://spse.inaproc.id/kemenag/lelang" target="_blank" rel="noopener noreferrer"
        class="group bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:border-red-200 transition-all duration-300 overflow-hidden flex flex-col">

        <div class="h-2 bg-gradient-to-r from-red-500 to-red-700"></div>

        <div class="p-6 md:p-8 flex flex-col flex-1 text-center">
          {{-- Area Gambar Full Size --}}
          <div class="w-full h-48 flex items-center justify-center bg-red-50 rounded-2xl mb-6 overflow-hidden group-hover:bg-red-100 transition-colors">
            {{-- Ganti path image INAPROC sesuai dengan file Anda --}}
            <img src="{{ asset('images/logo-inaproc.webp') }}" alt="Logo INAPROC" class="max-h-full w-auto object-contain p-4 group-hover:scale-110 transition-transform duration-300" loading="lazy">
          </div>

          <h3 class="text-lg font-bold text-gray-800 mb-1 group-hover:text-red-700 transition-colors">
            INAPROC SPSE
          </h3>
          <p class="text-xs text-red-500 font-semibold mb-3">Sistem Pengadaan Secara Elektronik</p>
          <p class="text-sm text-gray-500 mb-6 flex-1">Portal nasional untuk pelaksanaan tender pengadaan barang dan jasa secara elektronik.</p>

          <div class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-red-50 text-red-700 rounded-xl text-sm font-semibold group-hover:bg-red-100 transition-colors">
            <span>Kunjungi Situs</span>
            <i class="fa-solid fa-arrow-up-right-from-square text-xs"></i>
          </div>
        </div>
      </a>

    </div>
  </div>
</section>

@endsection