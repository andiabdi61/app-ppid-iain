@extends('layouts.public_app')

@section('title', 'Tugas dan Fungsi')

@section('content')

{{-- ============================================ --}}
{{-- HERO DINAMIS --}}
{{-- ============================================ --}}
<x-page-hero
    title="Tugas dan Fungsi"
    icon="building"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Tentang Kami']
    ]"
/>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 md:py-16">
    <div class="max-w-4xl mx-auto">

        {{-- ============================================ --}}
        {{-- JUDUL & DASAR HUKUM --}}
        {{-- ============================================ --}}
        <div class="text-center mb-10">
            <h2 class="text-xl md:text-2xl font-bold text-hijau-800 mb-2">Tugas dan Wewenang Pejabat Pengelola Informasi dan Dokumentasi</h2>
            <p class="text-sm text-gray-500 italic">Peraturan Komisi Informasi Republik Indonesia Nomor 1 Tahun 2021 Tentang Standar Layanan Informasi Publik</p>
        </div>

        <div class="flex flex-col gap-8">

            {{-- ============================================ --}}
            {{-- ATASAN PPID --}}
            {{-- ============================================ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-hijau-100 rounded-xl flex items-center justify-center shrink-0">
                        <i class="bi bi-person-badge text-hijau-700 text-xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-hijau-800">Tugas dan Wewenang Atasan PPID</h3>
                </div>

                <div class="mb-6">
                    <h4 class="font-bold text-gray-800 mb-3">Atasan PPID Bertugas:</h4>
                    <ul class="space-y-2 list-disc list-outside pl-5 text-gray-700 leading-relaxed marker:text-hijau-600">
                        <li>Menunjuk PPID dan PPID Pelaksana;</li>
                        <li>Menyusun arah kebijakan layanan Informasi Publik di Badan Publik;</li>
                        <li>Menyelesaikan keberatan atas Permintaan Informasi Publik;</li>
                        <li>Mewakili Badan Publik di dalam proses penyelesaian sengketa di Komisi Informasi dan/atau di Pengadilan;</li>
                        <li>Melakukan pembinaan, pengawasan, evaluasi, dan monitoring atas pelaksanaan kebijakan Informasi Publik yang dilakukan oleh PPID dan PPID Pelaksana.</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800 mb-3">Atasan PPID Berwenang:</h4>
                    <ul class="space-y-2 list-disc list-outside pl-5 text-gray-700 leading-relaxed marker:text-hijau-600">
                        <li>Menetapkan dan mengangkat PPID dan PPID Pelaksana;</li>
                        <li>Menetapkan arah kebijakan layanan informasi publik di badan publik;</li>
                        <li>Memberikan tanggapan atas keberatan yang diajukan oleh pemohon informasi publik untuk ditindaklanjuti oleh PPID;</li>
                        <li>Menunjuk PPID untuk mewakili Badan Publik di dalam proses penyelesaian sengketa di Komisi Informasi dan/atau di Pengadilan;</li>
                        <li>Menetapkan strategi dan metode pembinaan, pengawasan, evaluasi, dan monitoring atas pelaksanaan kebijakan Informasi Publik yang dilakukan oleh PPID Pelaksana, Pejabat Fungsional dan/atau Petugas Pelayanan Informasi.</li>
                    </ul>
                </div>
            </div>

            {{-- ============================================ --}}
            {{-- PPID --}}
            {{-- ============================================ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-hijau-100 rounded-xl flex items-center justify-center shrink-0">
                        <i class="bi bi-diagram-3 text-hijau-700 text-xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-hijau-800">Tugas dan Wewenang PPID</h3>
                </div>

                <div class="mb-6">
                    <h4 class="font-bold text-gray-800 mb-3">PPID Bertugas:</h4>
                    <ul class="space-y-2 list-disc list-outside pl-5 text-gray-700 leading-relaxed marker:text-hijau-600">
                        <li>Menyusun dan melaksanakan kebijakan layanan Informasi Publik;</li>
                        <li>Menyusun laporan pelaksanaan kebijakan layanan Informasi Publik;</li>
                        <li>Mengoordinasikan dan mengonsolidasikan proses penyimpanan, pendokumentasian, penyediaan, dan pelayanan Informasi Publik;</li>
                        <li>Mengoordinasikan dan mengonsolidasikan pengumpulan dokumen Informasi Publik dari PPID Pelaksana dan/atau Petugas Pelayanan Informasi di Badan Publik;</li>
                        <li>Melakukan verifikasi dokumen Informasi Publik;</li>
                        <li>Menentukan Informasi Publik yang dapat diakses publik dan layak untuk dipublikasikan;</li>
                        <li>Melakukan pengujian tentang konsekuensi atas Informasi Publik yang akan dikecualikan;</li>
                        <li>Melakukan pengelolaan, pemeliharaan, dan pemutakhiran Daftar Informasi Publik;</li>
                        <li>Menyediakan Informasi Publik secara efektif dan efisien agar mudah diakses oleh publik;</li>
                        <li>Melakukan pembinaan, pengawasan, evaluasi, dan monitoring atas pelaksanaan kebijakan teknis Informasi Publik yang dilakukan oleh PPID Pelaksana dan/atau Petugas Pelayanan Informasi.</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800 mb-3">PPID Berwenang:</h4>
                    <ul class="space-y-2 list-disc list-outside pl-5 text-gray-700 leading-relaxed marker:text-hijau-600">
                        <li>Menetapkan kebijakan layanan Informasi Publik;</li>
                        <li>Menetapkan laporan pelaksanaan kebijakan layanan Informasi Publik;</li>
                        <li>Melaksanakan rapat koordinasi dan rapat kerja secara berkala dan/atau sesuai dengan kebutuhan dalam melaksanakan pelayanan Informasi Publik;</li>
                        <li>Meminta klarifikasi kepada PPID Pelaksana dan/atau Petugas Pelayanan Informasi dalam melaksanakan pelayanan Informasi Publik;</li>
                        <li>Menetapkan dan memutuskan suatu Informasi Publik dapat diakses publik atau tidak berdasarkan pengujian tentang konsekuensi atas Informasi Publik yang akan dikecualikan, dengan persetujuan Atasan PPID;</li>
                        <li>Menolak permintaan Informasi Publik dengan menyampaikan pertimbangan secara tertulis apabila Informasi Publik yang dimohon termasuk Informasi yang dikecualikan atau rahasia, dengan persetujuan Atasan PPID;</li>
                        <li>Menugaskan PPID Pelaksana dan/atau Petugas Pelayanan Informasi untuk membuat, mengelola, memelihara, dan/atau memutakhirkan Daftar Informasi Publik;</li>
                        <li>Menetapkan strategi dan metode pembinaan, pengawasan, evaluasi, dan monitoring atas pelaksanaan kebijakan teknis Informasi Publik yang dilakukan oleh PPID Pelaksana dan/atau Petugas Pelayanan Informasi.</li>
                    </ul>
                </div>
            </div>

            {{-- ============================================ --}}
            {{-- PPID PELAKSANA --}}
            {{-- ============================================ --}}
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 bg-hijau-100 rounded-xl flex items-center justify-center shrink-0">
                        <i class="bi bi-people text-hijau-700 text-xl"></i>
                    </div>
                    <h3 class="text-xl md:text-2xl font-bold text-hijau-800">Tugas dan Wewenang PPID Pelaksana</h3>
                </div>

                <div class="mb-6">
                    <h4 class="font-bold text-gray-800 mb-3">PPID Pelaksana Bertugas:</h4>
                    <ul class="space-y-2 list-disc list-outside pl-5 text-gray-700 leading-relaxed marker:text-hijau-600">
                        <li>Membantu PPID melaksanakan tanggungjawab, tugas, dan kewenangannya;</li>
                        <li>Melaksanakan kebijakan teknis layanan Informasi Publik yang telah ditetapkan PPID;</li>
                        <li>Mengonsolidasikan proses penyimpanan, pendokumentasian, penyediaan dan pelayanan Informasi Publik;</li>
                        <li>Mengumpulkan dokumen Informasi Publik dari Petugas Pelayanan Informasi di Badan Publik;</li>
                        <li>Membantu PPID melakukan verifikasi dokumen Informasi Publik;</li>
                        <li>Membantu membuat, mengelola, memelihara, dan memutakhirkan Daftar Informasi Publik;</li>
                        <li>Menjamin ketersediaan dan akselerasi layanan Informasi Publik agar mudah diakses oleh publik.</li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-gray-800 mb-3">PPID Pelaksana Berwenang:</h4>
                    <ul class="space-y-2 list-disc list-outside pl-5 text-gray-700 leading-relaxed marker:text-hijau-600">
                        <li>Meminta dokumen Informasi Publik dari Petugas Pelayanan Informasi di Badan Publik;</li>
                        <li>Meminta klarifikasi kepada Petugas Pelayanan Informasi di Badan Publik dalam melaksanakan pelayanan Informasi Publik;</li>
                        <li>Menugaskan Petugas Pelayanan Informasi untuk menyiapkan dokumen untuk membantu PPID dalam melaksanakan pengujian konsekuensi atas Informasi Publik yang akan dikecualikan atau pembuatan pertimbangan tertulis dalam hal suatu Informasi Publik dikecualikan atau Permintaan Informasi Publik ditolak.</li>
                    </ul>
                </div>
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
