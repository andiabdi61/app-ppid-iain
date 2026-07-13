@extends('layouts.public_app')

@section('title', 'FAQ Umum')

@section('content')

<div x-data="{ openFaq: null }" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 md:pt-8 pb-12">
    <div class="max-w-3xl mx-auto">
        
        {{-- ============================================ --}}
        {{-- BREADCRUMB & JUDUL --}}
        {{-- ============================================ --}}
        <nav aria-label="breadcrumb">
            <ol class="flex items-center gap-2 text-sm text-gray-500 mb-4">
                <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
                <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                <li><a href="{{ route('layanan-pengaduan.index') }}" class="hover:text-hijau-700 transition">Layanan & Pengaduan</a></li>
                <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                <li class="text-hijau-800 font-medium">FAQ Umum</li>
            </ol>
        </nav>
        
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Pertanyaan Umum (FAQ)</h1>
        <p class="text-gray-600 mb-10">Jawaban atas pertanyaan yang sering diajukan seputar layanan informasi publik.</p>

        {{-- ============================================ --}}
        {{-- LIST ACCORDION FAQ --}}
        {{-- ============================================ --}}
        <div class="flex flex-col gap-3 mb-10">
            
            {{-- FAQ 1 --}}
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <button @click="openFaq = (openFaq === 1 ? null : 1)" 
                        class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-800 pr-4">Apa itu PPID dan apa fungsinya di IAIN Bone?</span>
                    <i class="bi bi-chevron-down text-gray-400 transition-transform duration-300 shrink-0"
                       :class="{ 'rotate-180': openFaq === 1 }"></i>
                </button>
                <div x-show="openFaq === 1" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="px-6 pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                    PPID (Pejabat Pengelola Informasi dan Dokumentasi) adalah pejabat yang bertugas mengelola dan menyediakan akses terhadap informasi publik di lingkungan IAIN Bone. Fungsinya adalah memastikan masyarakat bisa mendapatkan informasi secara mudah, cepat, dan sesuai ketentuan UU Keterbukaan Informasi Publik.
                </div>
            </div>

            {{-- FAQ 2 --}}
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <button @click="openFaq = (openFaq === 2 ? null : 2)" 
                        class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-800 pr-4">Bagaimana cara mengajukan permohonan informasi publik?</span>
                    <i class="bi bi-chevron-down text-gray-400 transition-transform duration-300 shrink-0"
                       :class="{ 'rotate-180': openFaq === 2 }"></i>
                </button>
                <div x-show="openFaq === 2" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="px-6 pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                    Anda dapat mengajukan permohonan secara online melalui menu <a href="{{ route('informasi-publik.permohonan.form') }}" class="text-hijau-700 font-medium hover:underline">Formulir Permohonan</a> setelah melakukan login. Pastikan Anda mengisi data identitas dan detail informasi yang dibutuhkan dengan benar.
                </div>
            </div>

            {{-- FAQ 3 --}}
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <button @click="openFaq = (openFaq === 3 ? null : 3)" 
                        class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition">
                    <span class="font-semibold text-gray-800 pr-4">Berapa lama waktu yang dibutuhkan untuk memproses permohonan?</span>
                    <i class="bi bi-chevron-down text-gray-400 transition-transform duration-300 shrink-0"
                       :class="{ 'rotate-180': openFaq === 3 }"></i>
                </button>
                <div x-show="openFaq === 3" 
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 -translate-y-2"
                     x-transition:enter-end="opacity-100 translate-y-0"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 translate-y-0"
                     x-transition:leave-end="opacity-0 -translate-y-2"
                     class="px-6 pb-5 text-sm text-gray-600 leading-relaxed border-t border-gray-100 pt-4">
                    Sesuai dengan UU Keterbukaan Informasi Publik, permohonan informasi akan diproses paling lama 10 hari kerja sejak permohonan diterima. Jika ditolak, PPID wajib memberikan alasan penolakan secara tertulis.
                </div>
            </div>

            {{-- Tambahkan FAQ lainnya di sini (Copy blok di atas, ganti angka 3 jadi 4, 5, dst) --}}

        </div>

        {{-- ============================================ --}}
        {{-- CTA: TIDAK MENEMUKAN JAWABAN? --}}
        {{-- ============================================ --}}
        <div class="bg-putih-100 rounded-2xl p-8 text-center">
            <i class="bi bi-chat-dots text-4xl text-hijau-600 mb-3 block"></i>
            <p class="text-gray-700 font-medium mb-4">Tidak menemukan jawaban yang Anda cari?</p>
            <a href="{{ url('/kontak') }}" class="inline-flex items-center gap-2 bg-hijau-600 hover:bg-hijau-700 text-white px-6 py-3 rounded-lg font-semibold transition">
                <i class="bi bi-envelope"></i> Hubungi Kami
            </a>
        </div>

        {{-- ============================================ --}}
        {{-- TOMBOL NAVIGASI BAWAH --}}
        {{-- ============================================ --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-10">
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