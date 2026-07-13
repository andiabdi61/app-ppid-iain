<div class="bg-white rounded-2xl border border-gray-100 shadow-sm h-full flex flex-col hover:shadow-md transition-shadow duration-300 overflow-hidden">
    <div class="p-5 flex flex-col h-full">
        
        {{-- Judul --}}
        <h5 class="text-base font-bold text-gray-900 leading-snug mb-2 line-clamp-2">
            {!! highlight($item->nama_seksi, $query) !!}
        </h5>

        {{-- Meta: Induk Bidang --}}
        @if ($item->bidang)
            <p class="text-xs text-gray-400 italic mb-3">
                <i class="bi bi-diagram-2 text-[10px] mr-1"></i>
                Bagian dari: <span class="text-gray-500 not-italic font-medium">{{ $item->bidang->nama }}</span>
            </p>
        @endif
        
        {{-- Konten --}}
        <p class="text-sm text-gray-500 leading-relaxed line-clamp-3 flex-1">
            {!! highlight(generate_excerpt($item->tugas, $query), $query) !!}
        </p>
        
        {{-- Tombol --}}
        @if ($item->bidang)
        <div class="mt-4 pt-4 border-t border-gray-100">
            <a href="{{ route('bidang-sektoral.show', $item->bidang->slug) }}" 
               class="inline-flex items-center gap-1.5 text-sm font-medium text-hijau-600 hover:text-hijau-700 transition-colors group">
                <i class="bi bi-box-arrow-up-right text-xs"></i>
                Lihat Bidang Induk
                <i class="bi bi-arrow-right text-xs transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>
        @endif
    </div>
</div>