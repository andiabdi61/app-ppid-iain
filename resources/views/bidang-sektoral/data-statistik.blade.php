@extends('layouts.public_app')

@section('title', 'Data & Statistik')

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION & BREADCRUMB --}}
{{-- ============================================ --}}
<div class="bg-putih-100 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <nav aria-label="breadcrumb">
            <ol class="flex items-center gap-2 text-sm text-gray-500 mb-3">
                <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
                <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                <li><a href="{{ route('bidang-sektoral.index') }}" class="hover:text-hijau-700 transition">Unit & Organisasi</a></li>
                <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                <li class="text-hijau-800 font-medium">Data & Statistik</li>
            </ol>
        </nav>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900">Data & Statistik</h1>
    </div>
</div>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    
    <div class="text-center mb-12">
        <h2 class="text-2xl font-bold text-gray-800 mb-3">Statistik Kinerja PPID IAIN Bone</h2>
        <p class="text-gray-600 max-w-2xl mx-auto">Berikut adalah ringkasan data dan statistik penting terkait layanan informasi publik dan kinerja unit di lingkungan IAIN Bone.</p>
    </div>

    {{-- ============================================ --}}
    {{-- KARTU STATISTIK UTAMA --}}
    {{-- ============================================ --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        
        {{-- Statistik 1 --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center border-l-4 border-l-green-500">
            <div class="w-16 h-16 bg-green-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-file-earmark-check-fill text-green-600 text-3xl"></i>
            </div>
            <h5 class="text-gray-700 font-medium mb-2">Permohonan Diproses</h5>
            {{-- GANTI ANGKA INI --}}
            <p class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-1">1,245</p>
            <p class="text-sm text-gray-400">Sejak tahun 2022</p>
        </div>

        {{-- Statistik 2 --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center border-l-4 border-l-blue-500">
            <div class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-check-circle-fill text-blue-600 text-3xl"></i>
            </div>
            <h5 class="text-gray-700 font-medium mb-2">Tingkat Keberhasilan</h5>
            {{-- GANTI ANGKA INI --}}
            <p class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-1">98.5%</p>
            <p class="text-sm text-gray-400">Permohonan yang disetujui</p>
        </div>

        {{-- Statistik 3 --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 text-center border-l-4 border-l-amber-500">
            <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                <i class="bi bi-clock-history text-amber-600 text-3xl"></i>
            </div>
            <h5 class="text-gray-700 font-medium mb-2">Rata-rata Respon</h5>
            {{-- GANTI ANGKA INI --}}
            <p class="text-4xl md:text-5xl font-extrabold text-gray-800 mb-1">2 Hari</p>
            <p class="text-sm text-gray-400">Waktu penyelesaian rata-rata</p>
        </div>

    </div>

    {{-- ============================================ --}}
    {{-- GRAFIK CHART --}}
    {{-- ============================================ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-10">
        <div class="bg-hijau-700 text-white px-6 py-4">
            <h5 class="text-lg font-bold">Tren Permohonan Informasi Per Tahun</h5>
        </div>
        <div class="p-6">
            <div class="h-[400px]">
                <canvas id="trendChart"></canvas>
            </div>
            <script>
                document.addEventListener('DOMContentLoaded', function () {
                    const ctx = document.getElementById('trendChart').getContext('2d');
                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            // GANTI LABEL & DATA DI BAWAH INI SESUAI DATA REAL KAMU
                            labels: ['2019', '2020', '2021', '2022', '2023', '2024'],
                            datasets: [{
                                label: 'Jumlah Permohonan',
                                data: [120, 150, 210, 280, 350, 420],
                                backgroundColor: 'rgba(22, 163, 74, 0.1)', // Warna hijau transparan (sesuai tema)
                                borderColor: 'rgba(22, 163, 74, 1)',    // Warna hijau solid
                                borderWidth: 2,
                                pointBackgroundColor: 'rgba(22, 163, 74, 1)',
                                pointRadius: 4,
                                fill: true,
                                tension: 0.4 // Membuat garis melengkung
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: { 
                                y: { 
                                    beginAtZero: true,
                                    grid: { color: 'rgba(0,0,0,0.05)' }
                                },
                                x: {
                                    grid: { display: false }
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top',
                                    labels: { usePointStyle: true }
                                }
                            }
                        }
                    });
                });
            </script>
        </div>
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