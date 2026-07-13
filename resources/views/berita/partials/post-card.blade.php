{{-- Hapus class col-md-6 dll karena sudah diatur oleh parent grid --}}
<a href="{{ route('berita.show', $post->slug) }}" class="group bg-white h-full rounded-xl border border-gray-200 shadow-sm hover:shadow-lg transition-all duration-300 overflow-hidden flex flex-col">
    
    {{-- Gambar Berita --}}
    <div class="overflow-hidden h-48 sm:h-52 bg-gray-100">
        <img src="{{ $post->universal_thumb_url }}" 
             alt="{{ $post->title }}" 
             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500" 
             loading="lazy">
    </div>

    {{-- Konten Berita --}}
    <div class="p-5 flex flex-col flex-1">
        
        {{-- Kategori --}}
        @if($post->category)
            <span class="inline-block w-fit px-2.5 py-0.5 rounded-full text-xs font-medium mb-3 {{ $post->category->frontend_badge_class ?? 'bg-hijau-100 text-hijau-800' }}">
                {{ $post->category->name }}
            </span>
        @endif

        {{-- Judul --}}
        <h3 class="text-base font-bold text-gray-800 group-hover:text-hijau-700 transition mb-2 line-clamp-2">
            {{ $post->title }}
        </h3>

        {{-- Meta (Tanggal & Penulis) --}}
        <div class="flex items-center gap-3 text-xs text-gray-400 mb-3">
            <span class="flex items-center gap-1">
                <i class="bi bi-calendar3"></i> {{ $post->created_at ? $post->created_at->translatedFormat('d M Y') : '-' }}
            </span>
            <span class="flex items-center gap-1">
                <i class="bi bi-person-fill"></i> {{ $post->author->name ?? 'Admin' }}
            </span>
        </div>

        {{-- Excerpt / Ringkasan --}}
        <p class="text-sm text-gray-600 line-clamp-3 flex-1 mb-4">
            {{ Str::limit(strip_tags($post->excerpt ?: $post->content_html), 100) }}
        </p>

        {{-- Link Baca Selengkapnya --}}
        <div class="mt-auto pt-3 border-t border-gray-100">
            <span class="inline-flex items-center gap-1 text-sm font-semibold text-hijau-600 group-hover:text-hijau-700 transition">
                Baca Selengkapnya <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </span>
        </div>
    </div>
</a>