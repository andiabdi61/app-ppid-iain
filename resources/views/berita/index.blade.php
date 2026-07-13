@extends('layouts.public_app')

@section('title', $title)

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 md:pt-8 pb-12">
    
    {{-- ============================================ --}}
    {{-- BREADCRUMB & JUDUL --}}
    {{-- ============================================ --}}
    <nav aria-label="breadcrumb">
        <ol class="flex items-center gap-2 text-sm text-gray-500 mb-4 overflow-hidden whitespace-nowrap">
            <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
            <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
            <li class="text-hijau-800 font-medium">Berita</li>
        </ol>
    </nav>
    
    <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">{{ $title }}</h1>
    <p class="text-gray-600 mb-8">Temukan informasi dan perkembangan terbaru dari PPID IAIN Bone.</p>

    {{-- ============================================ --}}
    {{-- FORM PENCARIAN (MOBILE FRIENDLY) --}}
    {{-- ============================================ --}}
    <div class="max-w-4xl mx-auto mb-10">
        <form action="{{ route('berita.index') }}" method="GET">
            {{-- Baris 1: Input & Tombol Cari --}}
            <div class="flex gap-2 mb-2">
                <input type="text" name="q" 
                       class="flex-1 px-4 py-3 text-sm border border-gray-300 focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none rounded-xl placeholder-gray-400 transition" 
                       placeholder="Ketik kata kunci berita..." 
                       value="{{ request('q') }}">
                <button type="submit" class="px-5 py-3 bg-hijau-600 hover:bg-hijau-700 text-white rounded-xl text-sm font-medium transition flex items-center gap-2 justify-center shrink-0">
                    <i class="bi bi-search"></i> <span class="hidden sm:inline">Cari</span>
                </button>
            </div>
            
            {{-- Baris 2: Filter Kategori & Reset --}}
            <div class="flex gap-2">
                <select name="kategori" 
                        class="flex-1 px-4 py-2.5 text-sm border border-gray-300 focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none rounded-xl text-gray-600 transition">
                    <option value="all">Semua Kategori</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->slug }}" {{ request('kategori') == $cat->slug ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>

                @if(request('q') || request('kategori') != 'all')
                    <a href="{{ route('berita.index') }}" class="px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-xl text-sm font-medium transition flex items-center gap-1 justify-center shrink-0 border border-gray-300">
                        <i class="bi bi-x-lg text-xs"></i> Reset
                    </a>
                @endif
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
                <h4 class="text-xl font-bold text-gray-700 mb-2">Berita Tidak Ditemukan</h4>
                <p class="text-gray-500 mb-6">Maaf, tidak ada berita yang cocok dengan kriteria pencarian Anda.</p>
                <a href="{{ route('berita.index') }}" class="text-hijau-600 hover:text-hijau-700 font-medium text-sm">Kembali ke Semua Berita</a>
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