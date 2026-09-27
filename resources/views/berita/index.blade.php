@extends('layouts.public_app')

@section('title', $title)

@section('content')

{{-- ============================================ --}}
{{-- HERO SECTION --}}
{{-- ============================================ --}}
<x-page-hero 
    :title="$title" 
    icon="doc"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Informasi Publik']
    ]" 
/>

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-8 md:pt-10 pb-12">

    <p class="text-gray-600 mb-8 text-center">Temukan informasi dan perkembangan terbaru dari PPID IAIN Bone.</p>

    {{-- ============================================ --}}
    {{-- FORM PENCARIAN (MOBILE FRIENDLY) --}}
    {{-- ============================================ --}}
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-4 md:p-6 mb-8">
        @php
            $activeCategory = $categories->firstWhere('slug', request('kategori'));
            $itemClass = 'block w-full text-left px-3 py-2 text-sm hover:bg-hijau-50 hover:text-hijau-700 transition';
        @endphp
        <form action="{{ route('berita.index') }}" method="GET"
              x-data="{ open: false, kategori: @js(request('kategori', 'all')) }"
              class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <input type="hidden" name="kategori" :value="kategori">

            {{-- Filter Kategori --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Filter Kategori</label>
                <div class="relative" @click.away="open = false">
                    <button type="button" @click="open = !open"
                            class="w-full flex items-center justify-between gap-3 px-4 py-2.5 text-sm bg-white border border-gray-200 rounded-xl text-gray-700 hover:border-hijau-300 transition"
                            :class="{ 'border-hijau-400 ring-1 ring-hijau-200': open }">
                        <span class="flex items-center gap-2 min-w-0">
                            <i class="bi bi-funnel text-gray-400"></i>
                            <span class="truncate">{{ $activeCategory->name ?? 'Semua Kategori' }}</span>
                        </span>
                        <svg class="w-4 h-4 shrink-0 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>

                    <div x-show="open" x-cloak
                         x-transition:enter="transition ease-out duration-200"
                         x-transition:enter-start="opacity-0 scale-95"
                         x-transition:enter-end="opacity-100 scale-100"
                         x-transition:leave="transition ease-in duration-150"
                         x-transition:leave-start="opacity-100 scale-100"
                         x-transition:leave-end="opacity-0 scale-95"
                         class="absolute left-0 right-0 top-full mt-1 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-30">
                        <button type="button" @click="kategori = 'all'; $nextTick(() => $root.submit())"
                                class="{{ $itemClass }} {{ $activeCategory ? 'text-gray-700' : 'text-hijau-700 bg-hijau-50' }}">Semua Kategori</button>
                        <div class="my-1 border-t border-gray-200"></div>
                        @foreach($categories as $cat)
                            <button type="button" @click="kategori = @js($cat->slug); $nextTick(() => $root.submit())"
                                    class="{{ $itemClass }} {{ $activeCategory && $activeCategory->id === $cat->id ? 'text-hijau-700 bg-hijau-50' : 'text-gray-700' }}">{{ $cat->name }}</button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Cari Informasi --}}
            <div>
                <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-3">Cari Informasi</label>
                <div class="flex gap-2">
                    <div class="flex-1 flex items-center bg-gray-50 border border-gray-200 rounded-lg px-3 focus-within:ring-2 focus-within:ring-hijau-500 focus-within:border-hijau-500 transition">
                        <svg class="w-4 h-4 text-gray-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        <input type="text" name="q" value="{{ request('q') }}" placeholder="Ketik kata kunci..." class="w-full py-2.5 text-sm text-gray-700 placeholder-gray-400 focus:outline-none border-0 bg-transparent focus:ring-0">
                    </div>
                    <button type="submit" class="bg-hijau-600 hover:bg-hijau-700 text-white px-4 py-2.5 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </button>
                    @if(request('q') || (request('kategori') && request('kategori') != 'all'))
                        <a href="{{ route('berita.index') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-500 px-3 py-2.5 rounded-lg transition-colors duration-200 flex items-center justify-center shrink-0" title="Reset filter">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    {{-- ============================================ --}}
    {{-- GRID BERITA --}}
    {{-- ============================================ --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="post-container">
        @forelse($posts as $post)
            {{-- Panggil partial untuk setiap post --}}
            @include('berita.partials.post-card', ['post' => $post])
        @empty
            {{-- EMPTY STATE --}}
            <div class="col-span-full text-center py-16">
                <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-journal-x text-3xl text-gray-400"></i>
                </div>
                <h4 class="text-xl font-bold text-gray-700 mb-2">Informasi Tidak Ditemukan</h4>
                <p class="text-gray-500 mb-6">Maaf, tidak ada informasi yang cocok dengan kriteria pencarian Anda.</p>
                <a href="{{ route('berita.index') }}" class="text-hijau-600 hover:text-hijau-700 font-medium text-sm">Kembali ke Semua Informasi</a>
            </div>
        @endforelse
    </div>

    {{-- ============================================ --}}
    {{-- TOMBOL "MUAT LEBIH BANYAK" (AJAX) --}}
    {{-- ============================================ --}}
    <div class="text-center mt-10" id="load-more-container">
        @if ($posts->nextPageUrl())
            <button type="button" 
                    id="load-more-btn" 
                    data-url="{{ $posts->nextPageUrl() }}"
                    class="inline-flex items-center gap-2 bg-white border-2 border-hijau-600 text-hijau-700 hover:bg-hijau-600 hover:text-white px-8 py-3 rounded-xl font-semibold text-sm transition">
                <svg id="load-spinner" class="animate-spin h-5 w-5 text-current hidden" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Muat Lebih Banyak
            </button>
        @endif
    </div>

    {{-- ============================================ --}}
    {{-- TOMBOL NAVIGASI BAWAH --}}
    {{-- ============================================ --}}
    <div class="flex flex-col sm:flex-row gap-4 justify-center mt-10">
        <button onclick="history.back()" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition text-center">
            <i class="bi bi-arrow-left me-2"></i> Kembali
        </button>
        <a href="{{ url('/') }}" class="px-6 py-3 bg-hijau-600 hover:bg-hijau-700 text-white rounded-lg font-semibold transition text-center">
            Kembali ke Beranda
        </a>
    </div>

</div>

{{-- ============================================ --}}
{{-- SCRIPT UNTUK LOAD MORE (AJAX) --}}
{{-- ============================================ --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const loadMoreBtn = document.getElementById('load-more-btn');
    const postContainer = document.getElementById('post-container');
    const loadSpinner = document.getElementById('load-spinner');

    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function () {
            const url = this.getAttribute('data-url');
            if (!url) return;

            // Tampilkan spinner, sembunyikan teks
            const btnText = loadMoreBtn.childNodes[loadMoreBtn.childNodes.length - 1];
            loadSpinner.classList.remove('hidden');
            if(btnText) btnText.textContent = 'Memuat...';

            // Kirim request AJAX
            fetch(url, {
                headers: { 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(response => response.text())
            .then(html => {
                // Buat elemen sementara untuk parse HTML
                const tempDiv = document.createElement('div');
                tempDiv.innerHTML = html;
                
                // Ambil semua kartu post yang baru
                const newPosts = tempDiv.querySelectorAll('#post-container > *');
                
                if (newPosts.length > 0) {
                    newPosts.forEach(post => postContainer.appendChild(post));
                    
                    // Update URL tombol untuk halaman berikutnya
                    const nextUrl = tempDiv.querySelector('#load-more-btn');
                    if (nextUrl && nextUrl.getAttribute('data-url')) {
                        loadMoreBtn.setAttribute('data-url', nextUrl.getAttribute('data-url'));
                    } else {
                        // Jika tidak ada halaman lagi, sembunyikan tombol
                        document.getElementById('load-more-container').remove();
                    }
                } else {
                    document.getElementById('load-more-container').remove();
                }
            })
            .catch(() => {
                if(btnText) btnText.textContent = 'Muat Lebih Banyak';
                loadSpinner.classList.add('hidden');
                alert('Terjadi kesalahan saat memuat berita.');
            })
            .finally(() => {
                if(btnText) btnText.textContent = 'Muat Lebih Banyak';
                loadSpinner.classList.add('hidden');
            });
        });
    }
});
</script>
@endpush

@endsection