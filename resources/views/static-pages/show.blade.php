@extends('layouts.public_app')

@section('title', $page->title)

@section('content')

{{-- Hero Section --}}
<x-page-hero 
    title="{{ $page->title }}" 
    icon="doc"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => $page->title]
    ]"
/>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
    <div class="flex justify-center">
        <div class="w-full max-w-5xl">
            
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="p-6 lg:p-10">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12">
                        
                        {{-- ============================================ --}}
                        {{-- KOLOM KIRI: KONTEN UTAMA --}}
                        {{-- ============================================ --}}
                        <div class="lg:col-span-8">
                            {{-- Wrapper untuk styling konten WYSIWYG --}}
                            <div class="prose prose-sm sm:prose-base max-w-none
                                        prose-headings:font-bold prose-headings:text-gray-900
                                        prose-p:text-gray-600 prose-p:leading-relaxed
                                        prose-a:text-hijau-600 prose-a:no-underline hover:prose-a:underline
                                        prose-img:rounded-xl prose-img:shadow-sm
                                        prose-li:text-gray-600
                                        prose-strong:text-gray-800
                                        prose-table:text-sm prose-th:bg-gray-50 prose-th:px-4 prose-th:py-2 prose-th:text-left prose-th:font-semibold prose-td:px-4 prose-td:py-2 prose-td:border-gray-200">
                                {!! $page->content !!}
                            </div>
                        </div>

                        {{-- ============================================ --}}
                        {{-- KOLOM KANAN: SIDEBAR --}}
                        {{-- ============================================ --}}
                        <div class="lg:col-span-4">
                            <div class="lg:sticky lg:top-24">
                                <div class="bg-gray-50 rounded-xl p-5 border border-gray-100">
                                    <h5 class="text-sm font-bold text-gray-900 flex items-center gap-2 mb-4">
                                        <i class="bi bi-clock-history text-hijau-600"></i>
                                        Informasi Halaman
                                    </h5>
                                    <hr class="border-gray-200 mb-4">
                                    <p class="text-xs font-medium text-gray-500 uppercase tracking-wider mb-1">Terakhir diperbarui:</p>
                                    <p class="text-sm text-gray-700 font-medium">{{ $page->updated_at->translatedFormat('d F Y, H:i') }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
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
    </div>
</div>
@endsection