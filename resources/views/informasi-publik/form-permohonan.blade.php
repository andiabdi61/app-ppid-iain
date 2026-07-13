@extends('layouts.public_app')

@section('title', 'Formulir Permohonan Informasi')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    

    <h2 class="text-2xl font-bold text-gray-900 text-center mb-8">Formulir Permohonan Informasi Publik</h2>

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
                Anda mengajukan permohonan sebagai <strong>{{ Auth::user()->name }}</strong>. 
                Pastikan data profil Anda (telepon & alamat) sudah lengkap dan benar. 
                <a href="{{ route('profile.edit.public') }}" class="font-medium underline hover:text-blue-900 transition-colors">Edit Profil di sini</a>.
            </div>

            <form action="{{ route('informasi-publik.permohonan.store') }}" method="POST" enctype="multipart/form-data" class="mt-6 space-y-8">
                @csrf

                {{-- ============================================ --}}
                {{-- FIELDSET 1: DATA TAMBAHAN PEMOHON --}}
                {{-- ============================================ --}}
                <fieldset class="border border-gray-200 rounded-xl p-5 md:p-6">
                    <legend class="text-base font-bold text-gray-800 px-2">Data Tambahan Pemohon</legend>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mt-4">
                        
                        {{-- Pekerjaan --}}
                        <div>
                            <label for="pekerjaan_pemohon" class="block text-sm font-medium text-gray-700 mb-1.5">Pekerjaan</label>
                            <input type="text" 
                                   class="w-full px-4 py-2.5 rounded-lg border @error('pekerjaan_pemohon') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-hijau-500 focus:border-hijau-500 @enderror text-sm outline-none transition" 
                                   id="pekerjaan_pemohon" name="pekerjaan_pemohon" 
                                   value="{{ old('pekerjaan_pemohon') }}">
                            @error('pekerjaan_pemohon') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Jenis Pemohon --}}
                        <div>
                            <label for="jenis_pemohon" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Mengajukan Atas Nama <span class="text-red-500">*</span>
                            </label>
                            <select class="w-full px-4 py-2.5 rounded-lg border @error('jenis_pemohon') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-hijau-500 focus:border-hijau-500 @enderror text-sm outline-none transition bg-white" 
                                    id="jenis_pemohon" name="jenis_pemohon" required>
                                <option value="">-- Pilih Jenis --</option>
                                <option value="Perorangan" {{ old('jenis_pemohon') == 'Perorangan' ? 'selected' : '' }}>Perorangan (Diri Sendiri)</option>
                                <option value="Kelompok Masyarakat" {{ old('jenis_pemohon') == 'Organisasi' ? 'selected' : '' }}>Organisasi</option>
                            </select>
                            @error('jenis_pemohon') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Upload Identitas --}}
                        <div class="md:col-span-2">
                            <label for="identitas_pemohon" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Upload Identitas Pendukung (KTP/SK Organisasi) 
                                <span class="text-xs font-normal text-gray-400">(JPG/PNG/PDF, Max 2MB)</span>
                            </label>
                            <input type="file" 
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2.5 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 file:transition @error('identitas_pemohon') border border-red-500 @else border border-gray-300 @enderror rounded-lg cursor-pointer" 
                                   id="identitas_pemohon" name="identitas_pemohon" 
                                   accept=".jpg,.jpeg,.png,.pdf">
                            <p class="text-xs text-gray-400 mt-1.5">Unggah KTP jika mengajukan sebagai perorangan, atau Akta Pendirian jika sebagai Badan Hukum/Kelompok.</p>
                            @error('identitas_pemohon') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </fieldset>

                {{-- ============================================ --}}
                {{-- FIELDSET 2: RINCIAN INFORMASI --}}
                {{-- ============================================ --}}
                <fieldset class="border border-gray-200 rounded-xl p-5 md:p-6">
                    <legend class="text-base font-bold text-gray-800 px-2">Rincian Informasi yang Dimohon</legend>
                    <div class="space-y-5 mt-4">
                        
                        {{-- Rincian Informasi --}}
                        <div>
                            <label for="rincian_informasi" class="block text-sm font-medium text-gray-700 mb-1.5">
                                Rincian Informasi yang Dibutuhkan <span class="text-red-500">*</span>
                            </label>
                            <textarea class="w-full px-4 py-2.5 rounded-lg border @error('rincian_informasi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-hijau-500 focus:border-hijau-500 @enderror text-sm outline-none transition resize-y" 
                                      id="rincian_informasi" name="rincian_informasi" rows="5" required>{{ old('rincian_informasi') }}</textarea>
                            @error('rincian_informasi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        {{-- Tujuan Penggunaan --}}
                        <div>
                            <label for="tujuan_penggunaan_informasi" class="block text-sm font-medium text-gray-700 mb-1.5">Tujuan Penggunaan Informasi</label>
                            <textarea class="w-full px-4 py-2.5 rounded-lg border @error('tujuan_penggunaan_informasi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-hijau-500 focus:border-hijau-500 @enderror text-sm outline-none transition resize-y" 
                                      id="tujuan_penggunaan_informasi" name="tujuan_penggunaan_informasi" rows="3">{{ old('tujuan_penggunaan_informasi') }}</textarea>
                            @error('tujuan_penggunaan_informasi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </fieldset>

                {{-- ============================================ --}}
                {{-- FIELDSET 3: CARA MEMPEROLEH INFORMASI --}}
                {{-- ============================================ --}}
                <fieldset class="border border-gray-200 rounded-xl p-5 md:p-6">
                    <legend class="text-base font-bold text-gray-800 px-2">Cara Memperoleh Informasi</legend>
                    <div class="mt-4">
                        
                        <p class="text-sm font-medium text-gray-700 mb-3">Cara Memperoleh Informasi <span class="text-red-500">*</span></p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                            <label class="flex items-center gap-3 p-3 rounded-xl border @error('cara_mendapatkan_informasi') border-red-300 @else border-gray-200 @enderror cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:bg-hijau-50 has-[:checked]:border-hijau-500">
                                <input type="radio" name="cara_mendapatkan_informasi" id="caraMelihat" value="Melihat" class="w-4 h-4 text-hijau-600 focus:ring-hijau-500 border-gray-300" {{ old('cara_mendapatkan_informasi') == 'Melihat' ? 'checked' : '' }} required>
                                <span class="text-xs text-gray-700">Melihat/Membaca/Mendengar</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-xl border @error('cara_mendapatkan_informasi') border-red-300 @else border-gray-200 @enderror cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:bg-hijau-50 has-[:checked]:border-hijau-500">
                                <input type="radio" name="cara_mendapatkan_informasi" id="caraSalinanSoftcopy" value="Mendapatkan Salinan Softcopy" class="w-4 h-4 text-hijau-600 focus:ring-hijau-500 border-gray-300" {{ old('cara_mendapatkan_informasi') == 'Mendapatkan Salinan Softcopy' ? 'checked' : '' }} required>
                                <span class="text-sm text-gray-700">Salinan Softcopy</span>
                            </label>
                            <label class="flex items-center gap-3 p-3 rounded-xl border @error('cara_mendapatkan_informasi') border-red-300 @else border-gray-200 @enderror cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:bg-hijau-50 has-[:checked]:border-hijau-500">
                                <input type="radio" name="cara_mendapatkan_informasi" id="caraSalinanHardcopy" value="Mendapatkan Salinan Hardcopy" class="w-4 h-4 text-hijau-600 focus:ring-hijau-500 border-gray-300" {{ old('cara_mendapatkan_informasi') == 'Mendapatkan Salinan Hardcopy' ? 'checked' : '' }} required>
                                <span class="text-sm text-gray-700">Salinan Hardcopy</span>
                            </label>
                        </div>
                        @error('cara_mendapatkan_informasi') <p class="text-red-600 text-xs mt-2">{{ $message }}</p> @enderror

                        {{-- Opsi Salinan (Kondisional) --}}
                        <div class="mt-5" id="caraSalinanOptions" style="display: {{ old('cara_mendapatkan_informasi') && (old('cara_mendapatkan_informasi') == 'Mendapatkan Salinan Softcopy' || old('cara_mendapatkan_informasi') == 'Mendapatkan Salinan Hardcopy') ? 'block' : 'none' }};">
                            <p class="text-sm font-medium text-gray-700 mb-3">Cara Mendapatkan Salinan</p>
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-3">
                                <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:bg-hijau-50 has-[:checked]:border-hijau-500">
                                    <input type="radio" name="cara_mendapatkan_salinan" id="salinanAmbil" value="Mengambil Langsung" class="w-4 h-4 text-hijau-600 focus:ring-hijau-500 border-gray-300" {{ old('cara_mendapatkan_salinan') == 'Mengambil Langsung' ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700">Mengambil Langsung</span>
                                </label>
                                <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:bg-hijau-50 has-[:checked]:border-hijau-500">
                                    <input type="radio" name="cara_mendapatkan_salinan" id="salinanPos" value="Pos" class="w-4 h-4 text-hijau-600 focus:ring-hijau-500 border-gray-300" {{ old('cara_mendapatkan_salinan') == 'Pos' ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700">Dikirim Lewat Pos</span>
                                </label>
                                <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:bg-hijau-50 has-[:checked]:border-hijau-500">
                                    <input type="radio" name="cara_mendapatkan_salinan" id="salinanEmail" value="Email" class="w-4 h-4 text-hijau-600 focus:ring-hijau-500 border-gray-300" {{ old('cara_mendapatkan_salinan') == 'Email' ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700">Dikirim Lewat Email</span>
                                </label>
                                <label class="flex items-center gap-3 p-3 rounded-xl border border-gray-200 cursor-pointer hover:bg-gray-50 transition-colors has-[:checked]:bg-hijau-50 has-[:checked]:border-hijau-500">
                                    <input type="radio" name="cara_mendapatkan_salinan" id="salinanFax" value="Fax" class="w-4 h-4 text-hijau-600 focus:ring-hijau-500 border-gray-300" {{ old('cara_mendapatkan_salinan') == 'Fax' ? 'checked' : '' }}>
                                    <span class="text-sm text-gray-700">Dikirim Lewat Fax</span>
                                </label>
                            </div>
                            @error('cara_mendapatkan_salinan') <p class="text-red-600 text-xs mt-2">{{ $message }}</p> @enderror
                        </div>
                    </div>
                </fieldset>

                {{-- ============================================ --}}
                {{-- TOMBOL SUBMIT --}}
                {{-- ============================================ --}}
                <div class="grid gap-3 pt-2">
                    <button type="submit" class="w-full py-3.5 bg-hijau-600 text-white font-semibold rounded-xl hover:bg-hijau-700 transition-colors shadow-md shadow-hijau-600/20 flex items-center justify-center gap-2">
                        <i class="bi bi-send-fill"></i>
                        Kirim Permohonan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Script Toggle Opsi Salinan --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const radios = document.querySelectorAll('input[name="cara_mendapatkan_informasi"]');
        const salinanOptions = document.getElementById('caraSalinanOptions');

        function toggle() {
            const selected = document.querySelector('input[name="cara_mendapatkan_informasi"]:checked');
            if (selected && (selected.value === 'Mendapatkan Salinan Softcopy' || selected.value === 'Mendapatkan Salinan Hardcopy')) {
                salinanOptions.style.display = 'block';
                salinanOptions.querySelectorAll('input[type="radio"]').forEach(r => r.required = true);
            } else {
                salinanOptions.style.display = 'none';
                salinanOptions.querySelectorAll('input[type="radio"]').forEach(r => { r.required = false; r.checked = false; });
            }
        }

        radios.forEach(r => r.addEventListener('change', toggle));
        toggle();
    });
</script>
@endsection