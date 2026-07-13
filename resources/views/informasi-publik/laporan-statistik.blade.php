@extends('layouts.public_app')

@section('title', 'Laporan & Statistik PPID')

@section('content')

{{-- Hero Section --}}
<x-page-hero 
    title="Laporan & Statistik" 
    icon="target"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Informasi Publik (PPID)', 'url' => route('informasi-publik.index')],
        ['label' => 'Laporan & Statistik']
    ]"
/>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">

    {{-- ============================================ --}}
    {{-- STATISTIK RINGKASAN (3 Kartu) --}}
    {{-- ============================================ --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
        
        {{-- Kartu 1: Permohonan Informasi --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 h-full flex flex-col">
            <div class="p-6 text-center flex flex-col flex-1">
                <h5 class="text-sm font-semibold text-blue-600 flex items-center justify-center gap-2">
                    <i class="bi bi-file-earmark-text"></i>
                    Total Permohonan Informasi
                </h5>
                <p class="text-4xl font-bold text-gray-900 mt-4 mb-4">{{ $totalPermohonan }}</p>
                <hr class="border-gray-200">
                <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mt-4 mb-3">Permohonan Berdasarkan Status</h6>
                <div class="divide-y divide-gray-100 text-left flex-1">
                    <div class="flex justify-between items-center py-3">
                        <span class="text-sm text-gray-600">Menunggu</span>
                        <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">{{ $permohonanStatus['Menunggu'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="text-sm text-gray-600">Diproses</span>
                        <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-cyan-100 text-cyan-800">{{ $permohonanStatus['Diproses'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="text-sm text-gray-600">Diterima</span>
                        <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">{{ $permohonanStatus['Diterima'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="text-sm text-gray-600">Ditolak</span>
                        <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-red-100 text-red-800">{{ $permohonanStatus['Ditolak'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kartu 2: Pengajuan Keberatan --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 h-full flex flex-col">
            <div class="p-6 text-center flex flex-col flex-1">
                <h5 class="text-sm font-semibold text-yellow-600 flex items-center justify-center gap-2">
                    <i class="bi bi-exclamation-triangle"></i>
                    Total Pengajuan Keberatan
                </h5>
                <p class="text-4xl font-bold text-gray-900 mt-4 mb-4">{{ $totalKeberatan }}</p>
                <hr class="border-gray-200">
                <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mt-4 mb-3">Keberatan Berdasarkan Status</h6>
                <div class="divide-y divide-gray-100 text-left flex-1">
                    <div class="flex justify-between items-center py-3">
                        <span class="text-sm text-gray-600">Menunggu Diproses</span>
                        <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">{{ $keberatanStatus['Menunggu Diproses'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="text-sm text-gray-600">Diproses</span>
                        <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-cyan-100 text-cyan-800">{{ $keberatanStatus['Diproses'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="text-sm text-gray-600">Diterima</span>
                        <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-green-100 text-green-800">{{ $keberatanStatus['Diterima'] ?? 0 }}</span>
                    </div>
                    <div class="flex justify-between items-center py-3">
                        <span class="text-sm text-gray-600">Ditolak</span>
                        <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-red-100 text-red-800">{{ $keberatanStatus['Ditolak'] ?? 0 }}</span>
                    </div>
                </div>
            </div>
        </div>

        {{-- Kartu 3: Informasi Publik --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 h-full flex flex-col">
            <div class="p-6 text-center flex flex-col flex-1">
                <h5 class="text-sm font-semibold text-cyan-600 flex items-center justify-center gap-2">
                    <i class="bi bi-info-circle"></i>
                    Total Informasi Publik
                </h5>
                <p class="text-4xl font-bold text-gray-900 mt-4 mb-4">{{ $totalInformasiPublik }}</p>
                <hr class="border-gray-200">
                <h6 class="text-xs font-bold text-gray-500 uppercase tracking-wider mt-4 mb-3">Rincian Berdasarkan Kategori</h6>
                <div class="divide-y divide-gray-100 text-left flex-1 overflow-y-auto max-h-52">
                    @forelse($informasiPublikPerKategori as $kategori)
                        <div class="flex justify-between items-center py-3">
                            <span class="text-sm text-gray-600 truncate mr-2">{{ $kategori->nama }}</span>
                            <span class="px-2.5 py-0.5 text-xs font-medium rounded-full bg-blue-100 text-blue-800 shrink-0">{{ $kategori->informasi_publik_count }}</span>
                        </div>
                    @empty
                        <p class="text-sm text-gray-400 py-4">Belum ada kategori.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- GRAFIK PERMOHONAN INFORMASI --}}
    {{-- ============================================ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-8 overflow-hidden">
        <div class="bg-blue-600 text-white px-6 py-4">
            <h5 class="text-sm font-semibold">Statistik Permohonan Informasi per Bulan (Tahun {{ date('Y') }})</h5>
        </div>
        <div class="p-6">
            <canvas id="permohonanChart"></canvas>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- GRAFIK PENGAJUAN KEBERATAN --}}
    {{-- ============================================ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-8 overflow-hidden">
        <div class="bg-yellow-500 text-gray-900 px-6 py-4">
            <h5 class="text-sm font-semibold">Statistik Pengajuan Keberatan per Bulan (Tahun {{ date('Y') }})</h5>
        </div>
        <div class="p-6">
            <canvas id="keberatanChart"></canvas>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- DAFTAR LAPORAN TAHUNAN --}}
    {{-- ============================================ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 mb-8 overflow-hidden">
        <div class="bg-cyan-600 text-white px-6 py-4">
            <h5 class="text-sm font-semibold">Laporan Akses Informasi Publik Tahunan</h5>
        </div>
        <div class="p-6">
            @if($laporanTahunanPPID->isNotEmpty())
                <div class="divide-y divide-gray-100">
                    @foreach($laporanTahunanPPID as $laporan)
                        <div class="flex flex-col sm:flex-row justify-between sm:items-center gap-3 py-4 first:pt-0 last:pb-0">
                            <div class="flex items-center gap-2">
                                <i class="bi bi-file-earmark-pdf text-red-500 shrink-0"></i>
                                <a href="{{ route('publikasi.show', $laporan->slug) }}" class="text-sm text-gray-800 hover:text-hijau-700 transition">{{ $laporan->judul }}</a>
                                <span class="text-xs text-gray-400">({{ $laporan->tanggal_publikasi ? $laporan->tanggal_publikasi->translatedFormat('d M Y') : '-' }})</span>
                            </div>
                            @if($laporan->file_path)
                                <a href="{{ asset('storage/' . $laporan->file_path) }}" target="_blank" 
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition shrink-0">
                                    <i class="bi bi-download"></i> Unduh
                                </a>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-400 text-center py-8">Belum ada laporan tahunan PPID yang tersedia.</p>
            @endif
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- TOMBOL AKSI --}}
    {{-- ============================================ --}}
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

{{-- Script untuk Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Data Permohonan
        const permohonanLabels = @json($permohonanLabels);
        const permohonanData = @json($permohonanData);
        const permohonanCtx = document.getElementById('permohonanChart').getContext('2d');
        new Chart(permohonanCtx, {
            type: 'bar',
            data: {
                labels: permohonanLabels,
                datasets: [{
                    label: 'Jumlah Permohonan',
                    data: permohonanData,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        min: 0,
                        max: 3,
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                if (value % 1 === 0) return value;
                            }
                        },
                        title: { display: true, text: 'Jumlah Permohonan' }
                    },
                    x: {
                        title: { display: true, text: 'Bulan - Tahun' }
                    }
                },
                plugins: { tooltip: { mode: 'index', intersect: false } }
            }
        });

        // Data Keberatan
        const keberatanLabels = @json($keberatanLabels);
        const keberatanData = @json($keberatanData);
        const keberatanCtx = document.getElementById('keberatanChart').getContext('2d');
        new Chart(keberatanCtx, {
            type: 'line',
            data: {
                labels: keberatanLabels,
                datasets: [{
                    label: 'Jumlah Pengajuan Keberatan',
                    data: keberatanData,
                    backgroundColor: 'rgba(255, 159, 64, 0.5)',
                    borderColor: 'rgba(255, 159, 64, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                scales: {
                    y: {
                        min: 0,
                        max: 3,
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1,
                            callback: function(value) {
                                if (value % 1 === 0) return value;
                            }
                        },
                        title: { display: true, text: 'Jumlah Keberatan' }
                    },
                    x: {
                        title: { display: true, text: 'Bulan - Tahun' }
                    }
                },
                plugins: { tooltip: { mode: 'index', intersect: false } }
            }
        });
    });
</script>
@endsection