@extends('layouts.public_app')

@section('title', 'Permohonan Berhasil Diajukan')

@section('content')
<div class="bg-gray-50 min-h-[70vh] flex items-center py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full">
        <div class="flex justify-center">
            <div class="w-full max-w-2xl">
                
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-8 md:p-12 text-center">
                        
                        {{-- Icon Sukses --}}
                        <div class="mb-6 inline-flex items-center justify-center w-20 h-20 rounded-full bg-green-100">
                            <i class="bi bi-check2-circle text-green-600 text-4xl"></i>
                        </div>

                        <h1 class="text-2xl md:text-3xl font-bold text-gray-900 mb-3">Permohonan Berhasil Diajukan!</h1>
                        
                        <p class="text-gray-500 leading-relaxed max-w-md mx-auto">
                            Terima kasih, permohonan informasi Anda telah berhasil kami terima dan sedang dalam antrian untuk diproses.
                        </p>
                        
                        {{-- Nomor Registrasi --}}
                        @if(session('nomor_registrasi'))
                            <div class="mt-8 bg-green-50 border border-green-200 rounded-xl p-6 max-w-sm mx-auto">
                                <p class="text-sm text-green-700 mb-1">Nomor Registrasi Anda:</p>
                                <p class="text-2xl font-bold font-mono text-green-800 select-all tracking-wide">
                                    {{ session('nomor_registrasi') }}
                                </p>
                                <p class="text-xs text-green-600 mt-3">
                                    <i class="bi bi-info-circle me-1"></i>
                                    Simpan nomor ini untuk melacak status permohonan Anda.
                                </p>
                            </div>
                        @endif
                        
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