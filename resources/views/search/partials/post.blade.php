<div class="bg-white rounded-2xl border border-gray-100 shadow-sm h-full flex flex-col hover:shadow-md transition-shadow duration-300 overflow-hidden">
    <div class="p-5 flex flex-col h-full">
        
        {{-- Judul --}}
        <h5 class="text-base font-bold text-gray-900 leading-snug mb-3 line-clamp-2">
            {!! highlight($item->title, $query) !!}
        </h5>

        {{-- Meta: Kategori & Tanggal --}}
        <div class="flex items-center gap-2 mb-3">
            @if($item->category)
                <span class="px-2.5 py-0.5 text-xs font-medium rounded-full {{ str_replace('bg-', 'bg-', str_replace('text-', 'text-', $item->category->frontend_badge_class ?? 'bg-gray-100 text-gray-600')) }}">
                    {{ $item->category->name }}
                </span>
            @endif
            <span class="text-xs text-gray-400">{{ $item->created_at->translatedFormat('d M Y') }}</span>
        </div>
        
        {{-- Konten --}}
        <p class="text-sm text-gray-500 leading-relaxed line-clamp-3 flex-1">
            {!! highlight(generate_excerpt($item->excerpt ?: $item->content_html, $query), $query) !!}
        </p>

        {{-- Tombol --}}
        <div class="mt-4 pt-4 border-t border-gray-100">
            <a href="{{ route('berita.show', $item->slug) }}" 
               class="inline-flex items-center gap-1.5 text-sm font-medium text-hijau-600 hover:text-hijau-700 transition-colors group">
                Lihat Detail 
                <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</div>