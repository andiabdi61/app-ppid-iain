@extends('layouts.public_app')

@section('title', 'Formulir Pengajuan Keberatan')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    

    <h2 class="text-2xl font-bold text-gray-900 text-center mb-8">Formulir Pengajuan Keberatan Informasi Publik</h2>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-5 md:p-8">

            {{-- Alert Error --}}
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">
                    <h5 class="font-semibold text-red-800 mb-2 flex items-center gap-2">
                        <i class="bi bi-exclamation-circle-fill"></i> Terjadi Kesalahan!
                    </h5>
                    <ul class="list-disc list-inside space-y-1 text-sm">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{-- Alert Info User --}}
            <div class="bg-blue-50 border border-blue-200 text-blue-800 rounded-xl p-4 mb-6 text-sm">
                Anda mengajukan keberatan sebagai <strong>{{ Auth::user()->name }}</strong>.
            </div>

            <form action="{{ route('informasi-publik.keberatan.store') }}" method="POST" class="mt-6 space-y-8">
                @csrf

                {{-- ============================================ --}}
                {{-- FIELDSET 1: DATA PERMOHONAN --}}
                {{-- ============================================ --}}
                <fieldset class="border border-gray-200 rounded-xl p-5 md:p-6">
                    <legend class="text-base font-bold text-gray-800 px-2">Data Permohonan yang Dikeberatan</legend>
                    <div class="mt-4">
                        <label for="nomor_registrasi_permohonan" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Nomor Registrasi Permohonan Informasi <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               class="w-full px-4 py-2.5 rounded-lg border @error('nomor_registrasi_permohonan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-hijau-500 focus:border-hijau-500 @enderror text-sm outline-none transition font-mono" 
                               id="nomor_registrasi_permohonan" name="nomor_registrasi_permohonan" 
                               value="{{ old('nomor_registrasi_permohonan', request('no_reg')) }}" 
                               placeholder="Contoh: 20250814001" required>
                        <p class="text-xs text-gray-400 mt-1.5">Masukkan nomor registrasi dari permohonan yang ingin Anda ajukan keberatan. Pastikan permohonan tersebut diajukan oleh akun Anda.</p>
                        @error('nomor_registrasi_permohonan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </fieldset>

                {{-- ============================================ --}}
                {{-- FIELDSET 2: RINCIAN KEBERATAN --}}
                {{-- ============================================ --}}
                <fieldset class="border border-gray-200 rounded-xl p-5 md:p-6">
                    <legend class="text-base font-bold text-gray-800 px-2">Rincian Keberatan</legend>
                    <div class="space-y-5 mt-4">
                        
                        {{-- Jenis Keberatan --}}
                        <div>
                            <label for="jenis_keberatan" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Jenis Keberatan <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-4 py-2.5 rounded-lg border @error('jenis_keberatan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-hijau-500 focus:border-hijau-500 @enderror text-sm outline-none transition bg-white" 
                                    id="jenis_keberatan" name="jenis_keberatan" required>
                                <option value="">-- Pilih Jenis Keberatan --</option>
                                <option value="Info Ditolak" {{ old('jenis_keberatan') == 'Info Ditolak' ? 'selected' : '' }}>Permohonan Informasi Ditolak</option>
                                <option value="Info Tidak Disediakan" {{ old('jenis_keberatan') == 'Info Tidak Disediakan' ? 'selected' : '' }}>Informasi Tidak Disediakan</option>
                                <option value="Info Tidak Ditanggapi" {{ old('jenis_keberatan') == 'Info Tidak Ditanggapi' ? 'selected' : '' }}>Permohonan Informasi Tidak Ditanggapi</option>
                                <option value="Info Tidak Sesuai" {{ old('jenis_keberatan') == 'Info Tidak Sesuai' ? 'selected' : '' }}>Informasi yang Diberikan Tidak Sesuai</option>
                                <option value="Biaya Tidak Wajar" {{ old('jenis_keberatan') == 'Biaya Tidak Wajar' ? 'selected' : '' }}>Biaya yang Diminta Tidak Wajar</option>
                                <option value="Info Terlambat" {{ old('jenis_keberatan') == 'Info Terlambat' ? 'selected' : '' }}>Informasi yang Diminta Terlambat Diberikan</option>
                            </select>
                            @error('jenis_keberatan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Alasan Keberatan --}}
                        <div>
                            <label for="alasan_keberatan" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Alasan Pengajuan Keberatan <span class="text-red-500">*</span>
                            </label>
                            <textarea class="w-full px-4 py-2.5 rounded-lg border @error('alasan_keberatan') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-hijau-500 focus:border-hijau-500 @enderror text-sm outline-none transition resize-y" 
                                      id="alasan_keberatan" name="alasan_keberatan" rows="5" required>{{ old('alasan_keberatan') }}</textarea>
                            @error('alasan_keberatan') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Kasus Posisi --}}
                        <div>
                            <label for="kasus_posisi" class="block text-sm font-medium text-gray-700 mb-1.5">Kasus Posisi (Kronologi Singkat)</label>
                            <textarea class="w-full px-4 py-2.5 rounded-lg border @error('kasus_posisi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-hijau-500 focus:border-hijau-500 @enderror text-sm outline-none transition resize-y" 
                                      id="kasus_posisi" name="kasus_posisi" rows="3">{{ old('kasus_posisi') }}</textarea>
                            @error('kasus_posisi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </fieldset>

                {{-- ============================================ --}}
                {{-- TOMBOL SUBMIT --}}
                {{-- ============================================ --}}
                <div class="grid gap-3 pt-2">
                    <button type="submit" class="w-full py-3.5 bg-yellow-500 text-gray-900 font-semibold rounded-xl hover:bg-yellow-600 transition-colors shadow-md shadow-yellow-500/20 flex items-center justify-center gap-2">
                        <i class="bi bi-shield-exclamation"></i>
                        Kirim Pengajuan Keberatan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection