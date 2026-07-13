@extends('layouts.public_app')

@section('title', 'Profil ' . $bidang->nama)

@section('content')

{{-- ============================================ --}}
{{-- ALPINE JS DATA (Modal + Accordion) --}}
{{-- ============================================ --}}
<div x-data="{ 
    showModal: false, 
    modalContent: '',
    openAccordion: {{ $bidang->seksis->isNotEmpty() ? $bidang->seksis->sortBy('urutan')->first()->id : 'null' }}
}" @keydown.escape.window="showModal = false">

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
                    <li class="text-hijau-800 font-medium">{{ $bidang->nama }}</li>
                </ol>
            </nav>
            <h1 class="text-3xl md:text-4xl font-bold text-gray-900">{{ $bidang->nama }}</h1>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="max-w-5xl mx-auto flex flex-col gap-8">

            {{-- ============================================ --}}
            {{-- 1. STRUKTUR PEJABAT --}}
            {{-- ============================================ --}}
            @if($bidang->kepala || $bidang->seksis->whereNotNull('pejabat_kepala_id')->isNotEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-hijau-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="bi bi-people-fill text-hijau-700"></i> Struktur Pejabat
                    </h3>
                </div>
                <div class="p-6">
                    
                    {{-- Kepala Unit --}}
                    @if($bidang->kepala)
                    <div class="flex flex-col sm:flex-row items-center gap-4 p-4 bg-gray-50 rounded-xl mb-6">
                        <button @click="
                            fetch(`{{ route('pejabat.showModal', ['pejabat' => $bidang->kepala->id]) }}`)
                            .then(res => res.text())
                            .then(html => { modalContent = html; showModal = true; })
                        " class="shrink-0 group cursor-pointer">
                            <img src="{{ $bidang->kepala->foto_url }}" alt="{{ $bidang->kepala->foto_alt_text }}" 
                                 class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md group-hover:scale-105 transition-transform">
                        </button>
                        <div class="text-center sm:text-left">
                            <button @click="
                                fetch(`{{ route('pejabat.showModal', ['pejabat' => $bidang->kepala->id]) }}`)
                                .then(res => res.text())
                                .then(html => { modalContent = html; showModal = true; })
                            " class="text-xl font-bold text-gray-800 hover:text-hijau-700 transition cursor-pointer">
                                {{ $bidang->kepala->nama }}
                            </button>
                            <p class="text-hijau-700 font-medium">{{ $bidang->kepala->jabatan }}</p>
                        </div>
                    </div>
                    @endif

                    {{-- Staf / Kepala Seksi --}}
                    @if($bidang->seksis->whereNotNull('pejabat_kepala_id')->isNotEmpty())
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        @foreach($bidang->seksis->whereNotNull('pejabat_kepala_id')->sortBy('urutan') as $seksi)
                        <div class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-md transition group">
                            <button @click="
                                fetch(`{{ route('pejabat.showModal', ['pejabat' => $seksi->kepala->id]) }}`)
                                .then(res => res.text())
                                .then(html => { modalContent = html; showModal = true; })
                            " class="w-full cursor-pointer">
                                <div class="overflow-hidden h-32 bg-gray-100">
                                    <img src="{{ $seksi->kepala->foto_url }}" alt="{{ $seksi->kepala->foto_alt_text }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                </div>
                                <div class="p-3 text-center">
                                    <h6 class="text-sm font-bold text-gray-800 truncate">{{ $seksi->kepala->nama }}</h6>
                                    <p class="text-xs text-gray-500 truncate">Kepala {{ $seksi->nama_seksi }}</p>
                                </div>
                            </button>
                        </div>
                        @endforeach
                    </div>
                    @endif

                </div>
            </div>
            @endif

            {{-- ============================================ --}}
            {{-- 2. TUGAS POKOK & FUNGSI --}}
            {{-- ============================================ --}}
            @if($bidang->tupoksi)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-hijau-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="bi bi-journal-text text-hijau-700"></i> Tugas Pokok & Fungsi
                    </h3>
                </div>
                <div class="p-6 text-gray-700 text-sm leading-relaxed [&_p]:mb-3 [&_ul]:list-disc [&_ul]:pl-6 [&_ol]:list-decimal [&_ol]:pl-6 [&_li]:mb-2">
                    {!! $bidang->tupoksi !!}
                </div>
            </div>
            @endif

            {{-- ============================================ --}}
            {{-- 3. UNIT DI BAWAHNYA (ALPINE ACCORDION) --}}
            {{-- ============================================ --}}
            @if($bidang->seksis->isNotEmpty())
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-hijau-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="bi bi-diagram-3-fill text-hijau-700"></i> Unit di Bawahnya
                    </h3>
                </div>
                <div class="divide-y divide-gray-100">
                    @foreach($bidang->seksis->sortBy('urutan') as $seksi)
                    <div class="overflow-hidden">
                        {{-- Tombol Accordion --}}
                        <button @click="openAccordion = (openAccordion === {{ $seksi->id }} ? null : {{ $seksi->id }})" 
                                class="w-full flex items-center justify-between px-6 py-4 text-left hover:bg-gray-50 transition">
                            <span class="font-semibold text-gray-800">{{ $seksi->nama_seksi }}</span>
                            <i class="bi bi-chevron-down text-gray-400 transition-transform duration-300"
                               :class="{ 'rotate-180': openAccordion === {{ $seksi->id }} }"></i>
                        </button>
                        
                        {{-- Isi Accordion --}}
                        <div x-show="openAccordion === {{ $seksi->id }}" 
                             x-transition:enter="transition ease-out duration-200"
                             x-transition:enter-start="opacity-0 -translate-y-2"
                             x-transition:enter-end="opacity-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-150"
                             x-transition:leave-start="opacity-100 translate-y-0"
                             x-transition:leave-end="opacity-0 -translate-y-2"
                             class="px-6 pb-5 text-sm text-gray-600 leading-relaxed [&_p]:mb-3">
                            {!! $seksi->tugas ?? '<p class="text-gray-400 italic">Belum ada tugas yang ditetapkan.</p>' !!}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif
            
            {{-- ============================================ --}}
            {{-- 4. INFORMASI TAMBAHAN (Khusus UPT/Cabang) --}}
            {{-- ============================================ --}}
            @if(($bidang->tipe === 'cabang_dinas' && $bidang->wilayah_kerja) || (($bidang->tipe === 'cabang_dinas' || $bidang->tipe === 'UPTD') && ($bidang->alamat || $bidang->map)))
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-hijau-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="bi bi-info-circle-fill text-hijau-700"></i> Informasi Tambahan
                    </h3>
                </div>
                <div class="p-6 text-gray-700 text-sm leading-relaxed [&_p]:mb-3">
                    @if($bidang->tipe === 'cabang_dinas' && $bidang->wilayah_kerja)
                        <h5 class="font-bold text-gray-800 text-base mb-2">Wilayah Kerja</h5>
                        <div class="mb-4">{!! $bidang->wilayah_kerja !!}</div>
                        <hr class="my-4 border-gray-200">
                    @endif
                    @if(($bidang->tipe === 'cabang_dinas' || $bidang->tipe === 'UPTD') && $bidang->alamat)
                        <h5 class="font-bold text-gray-800 text-base mb-2">Alamat Kantor</h5>
                        <div class="mb-4">{!! $bidang->alamat !!}</div>
                    @endif
                    @if(($bidang->tipe === 'cabang_dinas' || $bidang->tipe === 'UPTD') && $bidang->map)
                        <div class="rounded-xl overflow-hidden mt-3">{!! $bidang->map !!}</div>
                    @endif
                </div>
            </div>
            @endif
            
            {{-- ============================================ --}}
            {{-- 5. GRAFIK KINERJA --}}
            {{-- ============================================ --}}
            @if($bidang->grafik_kinerja)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="bg-hijau-50 px-6 py-4 border-b border-gray-100">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center gap-2">
                        <i class="bi bi-graph-up-arrow text-hijau-700"></i> Grafik Capaian Kinerja
                    </h3>
                </div>
                <div class="p-6">
                    {!! $bidang->grafik_kinerja !!}
                </div>
            </div>
            @endif

        </div>

        {{-- ============================================ --}}
        {{-- TOMBOL NAVIGASI BAWAH --}}
        {{-- ============================================ --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-12">
            <button onclick="history.back()" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition text-center">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </button>
            <a href="{{ url('/') }}" class="px-6 py-3 bg-hijau-600 hover:bg-hijau-700 text-white rounded-lg font-semibold transition text-center">
                Kembali ke Beranda
            </a>
        </div>
    </div>

    {{-- ============================================ --}}
    {{-- MODAL ALPINE JS (Pejabat) --}}
    {{-- ============================================ --}}
    <div x-show="showModal" 
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black/50"
         @click="showModal = false">
        
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto relative"
             @click.stop>
            <button @click="showModal = false" 
                    class="absolute top-4 right-4 z-10 w-8 h-8 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-full transition">
                <i class="bi bi-x-lg text-gray-600"></i>
            </button>
            <div x-html="modalContent" class="p-6"></div>
        </div>
    </div>

</div>

@endsection