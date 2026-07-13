@extends('layouts.public_app')

@section('title', 'Kontak PPID')

@section('content')

{{-- Hero Section (Menggunakan Component yang sudah ada) --}}
<x-page-hero 
    title="Hubungi Kami" 
    icon="building"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Informasi Publik', 'url' => route('informasi-publik.index')],
        ['label' => 'Kontak PPID']
    ]"
/>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="p-6 lg:p-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-12">
                
                {{-- Kolom Kiri: Informasi Kontak --}}
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Informasi Kontak</h3>
                    <div class="flex flex-col gap-5">
                        
                        {{-- Alamat --}}
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-hijau-50 border border-hijau-100 flex items-center justify-center shrink-0">
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
                        
                        {{-- Jam Pelayanan --}}
                        <div class="flex items-start gap-4">
                            <div class="w-11 h-11 rounded-xl bg-hijau-50 border border-hijau-100 flex items-center justify-center shrink-0">
                                <i class="bi bi-clock-fill text-hijau-600 text-lg"></i>
                            </div>
                            <div>
                                <h5 class="text-sm font-semibold text-gray-900">Jam Pelayanan</h5>
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
                </div>

                {{-- Kolom Kanan: Peta --}}
                <div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Peta Lokasi</h3>
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
                
            </div>
        </div>
    </div>
    
    {{-- Tombol Aksi --}}
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