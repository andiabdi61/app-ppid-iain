<div class="bg-white rounded-2xl border border-gray-100 shadow-sm h-full flex flex-col hover:shadow-md transition-shadow duration-300 overflow-hidden">
    <div class="p-5 flex flex-col h-full">
        
        {{-- Judul (Nama Pejabat) --}}
        <h5 class="text-base font-bold text-gray-900 leading-snug mb-3 line-clamp-2">
            {!! highlight($item->nama, $query) !!}
        </h5>
        
        {{-- Konten (Jabatan) --}}
        <p class="text-sm text-gray-500 leading-relaxed line-clamp-3 flex-1">
            {!! highlight(generate_excerpt($item->jabatan, $query), $query) !!}
        </p>
        
        {{-- Tombol (Pemicu Modal Alpine.js) --}}
        <div class="mt-4 pt-4 border-t border-gray-100">
            <button type="button" 
                    class="inline-flex items-center gap-1.5 text-sm font-medium text-white bg-hijau-600 hover:bg-hijau-700 px-3.5 py-2 rounded-lg transition-colors shadow-sm link-pejabat"
                    data-pejabat-id="{{ $item->id }}"
                    onclick="openPejabatModal({{ $item->id }})">
                <i class="bi bi-person-badge text-xs"></i>
                Lihat Detail
            </button>
        </div>
    </div>
</div>