@extends('layouts.public_app')

@section('title', 'Halaman Tidak Ditemukan')

@section('content')
<div class="min-h-[70vh] flex items-center py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex justify-center">
            <div class="w-full max-w-lg text-center">
                
                {{-- Icon Error --}}
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-blue-50 border border-blue-100 mb-6">
                    <i class="fas fa-question text-blue-300 text-4xl"></i>
                </div>

                {{-- Kode Error --}}
                <h1 class="text-7xl sm:text-8xl font-extrabold text-blue-200 tracking-tighter">404</h1>
                
                {{-- Judul --}}
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-4 mb-3">Halaman Tidak Ditemukan</h2>
                
                {{-- Deskripsi --}}
                <p class="text-gray-500 leading-relaxed max-w-md mx-auto mb-8">
                    Maaf, halaman yang Anda cari mungkin telah dihapus, namanya diubah, atau sementara tidak tersedia.
                </p>

                {{-- Debug Info --}}
                @if(app()->bound('debug') && config('app.debug'))
                    <div class="bg-yellow-50 border border-yellow-200 text-yellow-800 rounded-xl p-4 mb-8 text-left">
                        <p class="text-sm font-semibold flex items-center gap-2 mb-1">
                            <i class="fas fa-bug"></i>
                            Pesan Error (Debug Mode):
                        </p>
                        <p class="text-sm text-yellow-700">{{ $exception->getMessage() ?: 'Tidak ada pesan error spesifik.' }}</p>
                    </div>
                @endif

                {{-- Tombol Aksi --}}
                <div class="flex flex-col sm:flex-row items-center justify-center gap-3">
                    <button onclick="history.back()" 
                            class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-medium border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 transition-colors">
                        <i class="bi bi-arrow-left"></i>
                        Kembali
                    </button>
                    <a href="{{ url('/') }}" 
                       class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-medium bg-hijau-600 text-white hover:bg-hijau-700 transition-colors shadow-sm">
                        <i class="bi bi-house-door-fill"></i>
                        Kembali ke Beranda
                    </a>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection