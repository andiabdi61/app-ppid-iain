@extends('layouts.public_app')

@section('title', 'Detail Pengajuan Keberatan')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    
    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb" class="mb-6">
        <ol class="flex items-center gap-2 text-sm text-gray-500 flex-wrap">
            <li><a href="{{ url('/') }}" class="hover:text-hijau-600 transition-colors">Beranda</a></li>
            <li><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
            <li><a href="{{ route('dashboard') }}" class="hover:text-hijau-600 transition-colors">Dasbor Saya</a></li>
            <li><svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg></li>
            <li class="text-gray-900 font-medium">Detail Keberatan</li>
        </ol>
    </nav>

    <h2 class="text-2xl font-bold text-gray-900 mb-1">Detail Pengajuan Keberatan</h2>
    <p class="text-gray-500 mb-8">Untuk Permohonan No. Reg: <span class="font-semibold text-gray-700 font-mono">{{ $keberatan->nomor_registrasi_permohonan }}</span></p>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        
        {{-- Konten Utama --}}
        <div class="p-6 lg:p-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                
                {{-- Kolom Kiri: Data Pengajuan --}}
                <div>
                    <h5 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-4">Data Pengajuan</h5>
                    <div class="space-y-4">
                        <div class="flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-4">
                            <span class="text-sm text-gray-500 sm:w-40 shrink-0">Tanggal Pengajuan</span>
                            <span class="text-sm text-gray-900 font-medium">{{ $keberatan->tanggal_pengajuan->isoFormat('dddd, D MMMM YYYY') }}</span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-4">
                            <span class="text-sm text-gray-500 sm:w-40 shrink-0">Status</span>
                            <span>
                                @if($keberatan->status == 'Diterima' || $keberatan->status == 'Selesai')
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">{{ $keberatan->status }}</span>
                                @elseif($keberatan->status == 'Ditolak')
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">{{ $keberatan->status }}</span>
                                @elseif($keberatan->status == 'Diproses')
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">{{ $keberatan->status }}</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">{{ $keberatan->status }}</span>
                                @endif
                            </span>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:items-start gap-1 sm:gap-4">
                            <span class="text-sm text-gray-500 sm:w-40 shrink-0">Jenis Keberatan</span>
                            <span class="text-sm text-gray-900 font-medium">{{ $keberatan->jenis_keberatan }}</span>
                        </div>
                    </div>
                </div>

                {{-- Kolom Kanan: Rincian Keberatan --}}
                <div>
                    <h5 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-4">Rincian Keberatan</h5>
                    <div class="mb-5">
                        <p class="text-sm font-semibold text-gray-800 mb-1">Alasan Pengajuan:</p>
                        <p class="text-sm text-gray-600 leading-relaxed bg-gray-50 rounded-xl p-4">{{ $keberatan->alasan_keberatan }}</p>
                    </div>
                    @if($keberatan->kasus_posisi)
                    <div>
                        <p class="text-sm font-semibold text-gray-800 mb-1">Kasus Posisi:</p>
                        <p class="text-sm text-gray-600 leading-relaxed bg-gray-50 rounded-xl p-4">{{ $keberatan->kasus_posisi }}</p>
                    </div>
                    @endif
                </div>

            </div>

            {{-- Catatan Admin --}}
            @if($keberatan->catatan_admin)
            <div class="mt-8 pt-8 border-t border-gray-200">
                <h5 class="text-sm font-bold uppercase tracking-wider text-gray-400 mb-3 flex items-center gap-2">
                    <i class="bi bi-chat-left-text-fill text-blue-600"></i>
                    Tanggapan / Catatan dari Admin
                </h5>
                <div class="bg-blue-50 border border-blue-200 text-blue-800 rounded-xl p-5 text-sm leading-relaxed">
                    {{ $keberatan->catatan_admin }}
                </div>
            </div>
            @endif
        </div>

        {{-- Footer Card --}}
        <div class="px-6 lg:px-8 py-4 bg-gray-50 border-t border-gray-100 flex justify-center">
            <a href="{{ route('dashboard') }}" 
               class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 transition-colors">
                <i class="bi bi-arrow-left"></i>
                Kembali ke Dasbor
            </a>
        </div>

    </div>
</div>
@endsection