@extends('layouts.public_app')

@section('title', $post->title)

@section('content')

<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 md:pt-8 pb-12">
    
    {{-- ============================================ --}}
    {{-- BREADCRUMB --}}
    {{-- ============================================ --}}
    <nav aria-label="breadcrumb">
        <ol class="flex items-center gap-2 text-sm text-gray-500 mb-4 overflow-hidden whitespace-nowrap">
            <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
            <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
            <li><a href="{{ route('berita.index') }}" class="hover:text-hijau-700 transition">Berita</a></li>
            @if($post->category)
                <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                <li><a href="{{ route('berita.index', ['kategori' => $post->category->slug]) }}" class="hover:text-hijau-700 transition">{{ $post->category->name }}</a></li>
            @endif
            <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
            <li class="text-hijau-800 font-medium truncate max-w-[200px]">{{ Str::limit($post->title, 30) }}</li>
        </ol>
    </nav>

    <article>
        {{-- ============================================ --}}
        {{-- HEADER ARTIKEL --}}
        {{-- ============================================ --}}
        <header class="mb-8">
            <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900 leading-tight mb-4">{{ $post->title }}</h1>
            
            <div class="flex flex-wrap items-center gap-x-4 gap-y-2 text-sm text-gray-500">
                <span class="flex items-center gap-1.5">
                    <i class="bi bi-person-fill text-hijau-600"></i> {{ $post->author->name ?? 'Admin' }}
                </span>
                <span class="flex items-center gap-1.5">
                    <i class="bi bi-calendar3 text-hijau-600"></i> {{ $post->created_at ? $post->created_at->translatedFormat('d F Y') : '-' }}
                </span>
                <span class="flex items-center gap-1.5">
                    <i class="bi bi-eye-fill text-hijau-600"></i> {{ $post->hits }} kali
                </span>
            </div>
        </header>

        {{-- ============================================ --}}
        {{-- GAMBAR FEATURED --}}
        {{-- ============================================ --}}
        @if($post->universal_preview_url)
            <div class="mb-10 rounded-2xl overflow-hidden shadow-md bg-gray-100">
                <img src="{{ $post->universal_preview_url }}" 
                     class="w-full object-cover max-h-[500px]" 
                     alt="{{ $post->title }}" loading="lazy">
            </div>
        @endif

        {{-- ============================================ --}}
        {{-- KONTEN ARTIKEL --}}
        {{-- ============================================ --}}
        <div class="prose prose-sm sm:prose-base max-w-none text-gray-700 
                    prose-headings:font-bold prose-headings:text-gray-900 
                    prose-a:text-hijau-700 prose-a:no-underline  
                    prose-img:rounded-xl prose-img:shadow-md mb-10">
            {!! $post->content_html !!}
        </div>

        {{-- ============================================ --}}
        <!-- TOMBOL SHARE -->
        {{-- ============================================ --}}
        <div class="border-t border-gray-200 py-6 my-10">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <span class="font-bold text-gray-800">Bagikan Artikel Ini:</span>
                <div class="flex gap-2">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" 
                       class="w-10 h-10 bg-blue-600 hover:bg-blue-700 text-white rounded-full flex items-center justify-center transition">
                        <i class="bi bi-facebook text-lg"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?text={{ urlencode($post->title) }}&url={{ url()->current() }}" target="_blank" 
                       class="w-10 h-10 bg-sky-500 hover:bg-sky-600 text-white rounded-full flex items-center justify-center transition">
                        <i class="bi bi-twitter-x text-lg"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($post->title) }} - {{ url()->current() }}" target="_blank" 
                       class="w-10 h-10 bg-green-500 hover:bg-green-600 text-white rounded-full flex items-center justify-center transition">
                        <i class="bi bi-whatsapp text-lg"></i>
                    </a>
                </div>
            </div>
        </div>

    </article>

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
@endsection