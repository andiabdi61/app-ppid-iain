@extends('layouts.public_app')

@section('title', 'Pengajuan Keberatan Berhasil')

@section('content')
<div class="bg-gray-50 min-h-[70vh] flex items-center py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex justify-center">
            <div class="w-full max-w-2xl">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-8 md:p-12 text-center">
                        
                        {{-- Icon Sukses --}}
                        <div class="mb-6 inline-flex items-center justify-center w-20 h-20 rounded-full bg-yellow-100">
                            <i class="bi bi-check2-circle text-yellow-600 text-4xl"></i>
                        </div>

                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">Pengajuan Keberatan Terkirim!</h1>
                        
                        <p class="text-gray-500 leading-relaxed max-w-md mx-auto">
                            Terima kasih, pengajuan keberatan Anda telah berhasil kami terima dan akan segera ditindaklanjuti oleh atasan PPID.
                        </p>
                        
                        {{-- Tombol Aksi --}}
                        <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-10">
                            <a href="{{ route('dashboard') }}" 
                               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-semibold bg-hijau-600 text-white hover:bg-hijau-700 transition-colors shadow-md shadow-hijau-600/20">
                                <i class="bi bi-speedometer2"></i>
                                Ke Dasbor Saya
                            </a>
                            <a href="{{ url('/') }}" 
                               class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-medium bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 transition-colors">
                                <i class="bi bi-house"></i>
                                Kembali ke Beranda
                            </a>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection