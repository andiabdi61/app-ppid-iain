<div class="bg-white rounded-2xl border border-gray-100 shadow-sm h-full flex flex-col hover:shadow-md transition-shadow duration-300 overflow-hidden">
    <div class="p-5 flex flex-col h-full">
        
        {{-- Judul --}}
        <h5 class="text-base font-bold text-gray-900 leading-snug mb-3 line-clamp-2">
            {!! highlight($item->nama, $query) !!}
        </h5>
        
        {{-- Konten --}}
        <p class="text-sm text-gray-500 leading-relaxed line-clamp-3 flex-1">
            {!! highlight(generate_excerpt($item->tupoksi, $query), $query) !!}
        </p>

        {{-- Tombol --}}
        <div class="mt-4 pt-4 border-t border-gray-100">
            <a href="{{ route('bidang-sektoral.show', $item->slug) }}" 
               class="inline-flex items-center gap-1.5 text-sm font-medium text-hijau-600 hover:text-hijau-700 transition-colors group">
                Lihat Detail 
                <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>
    </div>
</div>