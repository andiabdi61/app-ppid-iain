@extends('layouts.public_app')

@section('title', 'Kesalahan Server')

@section('content')
<div class="min-h-[70vh] flex items-center py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex justify-center">
            <div class="w-full max-w-lg text-center">
                
                {{-- Icon Error --}}
                <div class="inline-flex items-center justify-center w-24 h-24 rounded-full bg-yellow-50 border border-yellow-100 mb-6">
                    <i class="fas fa-exclamation-triangle text-yellow-300 text-4xl"></i>
                </div>

                {{-- Kode Error --}}
                <h1 class="text-7xl sm:text-8xl font-extrabold text-yellow-200 tracking-tighter">500</h1>
                
                {{-- Judul --}}
                <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mt-4 mb-3">Terjadi Kesalahan Server</h2>
                
                {{-- Deskripsi --}}
                <p class="text-gray-500 leading-relaxed max-w-md mx-auto mb-8">
                    Maaf, terjadi masalah pada server kami. Tim kami telah diberitahu dan sedang menanganinya. Silakan coba lagi nanti.
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