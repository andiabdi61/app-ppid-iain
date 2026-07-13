@extends('layouts.public_app')

@section('title', 'Kontak Dinas')

@section('content')

{{-- Hero Section --}}
<x-page-hero 
    title="Hubungi Kami" 
    icon="building"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Kontak']
    ]"
/>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 lg:p-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                
                {{-- ============================================ --}}
                {{-- KOLOM KIRI: INFORMASI KONTAK & PETA --}}
                {{-- ============================================ --}}
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Informasi Kontak</h3>
                    <div class="flex flex-col gap-5">
                        
                        {{-- Alamat --}}
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-hijau-50 border border-hijau-100 flex items-center justify-center shrink-0 group-hover:bg-hijau-700 transition-colors duration-300">
                                <i class="bi bi-geo-alt-fill text-hijau-600 text-lg"></i>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900">Alamat Kantor</h5>
                                <p class="text-sm text-gray-500 mt-0.5 leading-relaxed">{{ $settings['alamat_kantor'] ?? 'Alamat belum diatur' }}</p>
                            </div>
                        </div>
                        
                        {{-- Telepon --}}
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-hijau-50 border border-hijau-100 flex items-center justify-center shrink-0">
                                <i class="bi bi-telephone-fill text-hijau-600 text-lg"></i>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900">Telepon</h5>
                                <p class="text-sm text-gray-500 mt-0.5">
                                    <a href="tel:{{ $settings['telp_kontak'] ?? '' }}" class="text-hijau-600 hover:text-hijau-700 hover:underline transition">{{ $settings['telp_kontak'] ?? 'Telepon belum diatur' }}</a>
                                </p>
                            </div>
                        </div>
                        
                        {{-- Email --}}
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-hijau-50 border border-hijau-100 flex items-center justify-center shrink-0">
                                <i class="bi bi-envelope-fill text-hijau-600 text-lg"></i>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900">Email</h5>
                                <p class="text-sm text-gray-500 mt-0.5">
                                    <a href="mailto:{{ $settings['email_kontak'] ?? '' }}" class="text-hijau-600 hover:text-hijau-700 hover:underline transition">{{ $settings['email_kontak'] ?? 'Email belum diatur' }}</a>
                                </p>
                            </div>
                        </div>
                        
                        {{-- Jam Operasional --}}
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-hijau-50 border border-hijau-100 flex items-center justify-center shrink-0">
                                <i class="bi bi-clock-fill text-hijau-600 text-lg"></i>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900">Jam Operasional Kantor</h5>
                                <div class="mt-2 text-sm text-gray-500 space-y-1">
                                    <div class="flex gap-3">
                                        <span class="w-28 shrink-0">Senin - Kamis</span>
                                        <span>: 08.00 - 16.00 WIB</span>
                                    </div>
                                    <div class="flex gap-3">
                                        <span class="w-28 shrink-0">Jumat</span>
                                        <span>: 08.00 - 16.30 WIB</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                    
                    <hr class="my-8 border-gray-200">

                    {{-- Peta Lokasi --}}
                    <div class="rounded-2xl overflow-hidden shadow-sm border border-gray-200 aspect-[4/3]">
                        <iframe 
                            src="https://maps.google.com/maps?q=IAIN+Bone+Jl+Hos+Cokroaminoto+Macanang+Tanete+Riattang+Kab+Bone+Sulawesi+Selatan&t=&z=15&ie=UTF8&iwloc=&output=embed" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                {{-- ============================================ --}}
                {{-- KOLOM KANAN: FORMULIR KONTAK --}}
                {{-- ============================================ --}}
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Kirim Pesan Kepada Kami</h3>
                    
                    {{-- Alert Sukses --}}
                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl p-4 mb-6 text-sm flex items-center gap-2">
                            <i class="bi bi-check-circle-fill text-green-600"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Alert Error --}}
                    @if ($errors->any())
                        <div class="bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 mb-6">
                            <ul class="list-disc list-inside space-y-1 text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('kontak.send-mail') }}" method="POST" class="space-y-5">
                        @csrf
                        
                        {{-- Nama Lengkap --}}
                        <div>
                            <label for="nama_pengirim" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none transition" 
                                   id="nama_pengirim" name="nama_pengirim" 
                                   value="{{ old('nama_pengirim') }}" required>
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email_pengirim" class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-red-500">*</span></label>
                            <input type="email" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none transition" 
                                   id="email_pengirim" name="email_pengirim" 
                                   value="{{ old('email_pengirim') }}" required>
                        </div>

                        {{-- Subjek Pesan --}}
                        <div>
                            <label for="subjek" class="block text-sm font-medium text-gray-700 mb-1.5">Subjek Pesan <span class="text-red-500">*</span></label>
                            <input type="text" 
                                   class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none transition" 
                                   id="subjek" name="subjek" 
                                   value="{{ old('subjek') }}" required>
                        </div>

                        {{-- Pesan --}}
                        <div>
                            <label for="pesan" class="block text-sm font-medium text-gray-700 mb-1.5">Pesan Anda <span class="text-red-500">*</span></label>
                            <textarea class="w-full px-4 py-2.5 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none transition resize-y" 
                                      id="pesan" name="pesan" rows="5" required>{{ old('pesan') }}</textarea>
                        </div>

                        {{-- Tombol Kirim --}}
                        <div>
                            <button type="submit" class="w-full py-3 bg-hijau-600 text-white font-semibold rounded-xl hover:bg-hijau-700 transition-colors shadow-md shadow-hijau-600/20 flex items-center justify-center gap-2">
                                <i class="bi bi-send-fill"></i>
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    
    {{-- Tombol Aksi Bawah --}}
    <div class="flex flex-col sm:flex-row items-center justify-center gap-3 mt-8">
        <button onclick="history.back()" 
                class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-medium border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 transition-colors">
            <i class="bi bi-arrow-left"></i>
            Kembali
        </button>
        <a href="{{ url('/') }}" 
           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 rounded-xl text-sm font-medium bg-hijau-600 text-white hover:bg-hijau-700 transition-colors shadow-sm">
            <i class="bi bi-house"></i>
            Kembali ke Beranda
        </a>
    </div>
</div>
@endsection