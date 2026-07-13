@extends('layouts.public_app')

@section('title', 'Daftar Layanan Umum')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 md:pt-8 pb-12">
    
    {{-- ============================================ --}}
    {{-- BREADCRUMB & JUDUL --}}
    {{-- ============================================ --}}
  <nav aria-label="breadcrumb">
    <ol class="flex items-center gap-2 text-sm text-gray-500 mb-4 overflow-hidden whitespace-nowrap">
        <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
        <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
        <li><a href="{{ route('layanan-pengaduan.index') }}" class="hover:text-hijau-700 transition">Layanan & Pengaduan</a></li>
        <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
        <li class="text-hijau-800 font-medium">Daftar Layanan Umum</li>
    </ol>
</nav>
    
    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Daftar Layanan Umum</h1>
    <p class="text-gray-600 mb-10">Berbagai layanan umum yang disediakan oleh unit-unit di lingkungan IAIN Bone.</p>

    {{-- ============================================ --}}
    {{-- GRID LAYANAN --}}
    {{-- ============================================ --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-12">
        
        {{-- Layanan 1 --}}
        <a href="{{ route('bidang-sektoral.show', 'akademik') }}" class="group bg-white h-full rounded-xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-hijau-300 transition-all duration-300 p-6 flex flex-col">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 bg-hijau-100 group-hover:bg-hijau-600 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                    <i class="bi bi-mortarboard-fill text-xl text-hijau-700 group-hover:text-white transition-colors"></i>
                </div>
                <div>
                    <h5 class="text-lg font-bold text-gray-800 group-hover:text-hijau-700 transition">Layanan Akademik</h5>
                    <p class="text-xs text-gray-400 mt-1">Biro Akademik</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 flex-1">Pengurusan surat keterangan, transkrip nilai, legalisir ijazah, dan layanan administrasi akademik lainnya.</p>
            <span class="inline-flex items-center gap-1 text-sm font-semibold text-hijau-600 mt-4">
                Lihat Detail Unit <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </span>
        </a>

        {{-- Layanan 2 --}}
        <a href="{{ route('bidang-sektoral.show', 'kepegawaian') }}" class="group bg-white h-full rounded-xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-hijau-300 transition-all duration-300 p-6 flex flex-col">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 bg-blue-100 group-hover:bg-blue-600 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                    <i class="bi bi-person-badge-fill text-xl text-blue-700 group-hover:text-white transition-colors"></i>
                </div>
                <div>
                    <h5 class="text-lg font-bold text-gray-800 group-hover:text-hijau-700 transition">Layanan Kepegawaian</h5>
                    <p class="text-xs text-gray-400 mt-1">Biro Kepegawaian</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 flex-1">Pengurusan cuti, kenaikan pangkat, pensiun, SK fungsional, dan administrasi kepegawaian dosen & tenaga kependidikan.</p>
            <span class="inline-flex items-center gap-1 text-sm font-semibold text-hijau-600 mt-4">
                Lihat Detail Unit <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </span>
        </a>

        {{-- Layanan 3 --}}
        <a href="{{ route('bidang-sektoral.show', 'kemahasiswaan') }}" class="group bg-white h-full rounded-xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-hijau-300 transition-all duration-300 p-6 flex flex-col">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 bg-amber-100 group-hover:bg-amber-600 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                    <i class="bi bi-people-fill text-xl text-amber-700 group-hover:text-white transition-colors"></i>
                </div>
                <div>
                    <h5 class="text-lg font-bold text-gray-800 group-hover:text-hijau-700 transition">Layanan Kemahasiswaan</h5>
                    <p class="text-xs text-gray-400 mt-1">Biro Kemahasiswaan</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 flex-1">Pengurusan KTM, surat keterangan aktif, legalisir dokumen organisasi mahasiswa, dan layanan KBM.</p>
            <span class="inline-flex items-center gap-1 text-sm font-semibold text-hijau-600 mt-4">
                Lihat Detail Unit <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </span>
        </a>

        {{-- Layanan 4 --}}
        <a href="{{ route('bidang-sektoral.show', 'perpustakaan') }}" class="group bg-white h-full rounded-xl border border-gray-200 shadow-sm hover:shadow-lg hover:border-hijau-300 transition-all duration-300 p-6 flex flex-col">
            <div class="flex items-start gap-4 mb-4">
                <div class="w-12 h-12 bg-purple-100 group-hover:bg-purple-600 rounded-xl flex items-center justify-center shrink-0 transition-colors">
                    <i class="bi bi-book-half text-xl text-purple-700 group-hover:text-white transition-colors"></i>
                </div>
                <div>
                    <h5 class="text-lg font-bold text-gray-800 group-hover:text-hijau-700 transition">Layanan Perpustakaan</h5>
                    <p class="text-xs text-gray-400 mt-1">UPT Perpustakaan</p>
                </div>
            </div>
            <p class="text-sm text-gray-600 flex-1">Peminjaman buku, akses jurnal elektronik, keanggotaan perpustakaan digital, dan layanan referensi akademik.</p>
            <span class="inline-flex items-center gap-1 text-sm font-semibold text-hijau-600 mt-4">
                Lihat Detail Unit <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </span>
        </a>

        {{-- Tambahkan layanan lain dengan format yang sama --}}
        
    </div>

    {{-- ============================================ --}}
    {{-- TOMBOL NAVIGASI BAWAH --}}
    {{-- ============================================ --}}
    <div class="flex flex-col sm:flex-row gap-4 justify-center">
        <button onclick="history.back()" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition text-center">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </button>
        <a href="{{ url('/') }}" class="px-6 py-3 bg-hijau-600 hover:bg-hijau-700 text-white rounded-lg font-semibold transition text-center">
            Kembali ke Beranda
        </a>
    </div>

</div>

@endsection