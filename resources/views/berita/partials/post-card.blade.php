{{-- Hapus class col-md-6 dll karena sudah diatur oleh parent grid --}}
<a href="{{ route('berita.show', $post->slug) }}" class="group bg-white h-full rounded-2xl border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 overflow-hidden flex flex-col">

    {{-- Gambar Informasi (hanya tampil jika ada gambar) --}}
    @if($post->universal_preview_url)
        <div class="overflow-hidden h-48 sm:h-52 bg-gray-100">
            <img src="{{ $post->universal_thumb_url }}"
                 alt="{{ $post->title }}"
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 loading="lazy">
        </div>
    @endif

    {{-- Konten Informasi --}}
    <div class="p-4 flex flex-col flex-1">

        {{-- Baris Atas: Tanggal & Kategori --}}
        <div class="flex items-center justify-between gap-2 mb-2">
            <span class="flex items-center gap-1 text-xs font-medium text-gray-400">
                <i class="bi bi-calendar3"></i>
                {{ ($post->published_at ?? $post->created_at) ? ($post->published_at ?? $post->created_at)->translatedFormat('d F Y') : '-' }}
            </span>
            @if($post->category)
                <span class="inline-block w-fit px-2.5 py-1 rounded-full text-[11px] font-bold shrink-0 {{ $post->category->badge_class ?? 'bg-hijau-100 text-hijau-800' }}">
                    {{ $post->category->name }}
                </span>
            @endif
        </div>

        {{-- Judul --}}
        <h3 class="text-[15px] leading-tight font-bold text-gray-800 group-hover:text-hijau-700 transition mb-1.5 line-clamp-2">
            {{ $post->title }}
        </h3>

        {{-- Excerpt / Ringkasan --}}
        <p class="text-sm text-gray-500 leading-normal line-clamp-2 flex-1">
            {{ Str::limit(strip_tags($post->excerpt ?: $post->content_html), 90) }}
        </p>

        {{-- Link Baca Selengkapnya --}}
        <div class="mt-3 pt-2.5 border-t border-gray-100">
            <span class="inline-flex items-center gap-1 text-sm font-semibold text-hijau-600 group-hover:gap-2 transition-all">
                Baca Selengkapnya <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </span>
        </div>
    </div>
</a>