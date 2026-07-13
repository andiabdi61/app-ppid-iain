@if ($paginator->hasPages())
    <nav class="flex items-center gap-1">
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="px-3 py-2 rounded-lg bg-gray-100 text-gray-400 text-sm">«</span>
        @else
            <a href="{{ $paginator->previousPageUrl() }}" class="px-3 py-2 rounded-lg bg-white border text-sm hover:bg-gray-50 text-slate-700">«</a>
        @endif

        {{-- Numbers --}}
        @foreach ($elements as $element)
            @if (is_string($element))
                <span class="px-3 py-2 text-slate-500 text-sm">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="px-3 py-2 rounded-lg bg-hijau-600 text-white text-sm font-medium">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="px-3 py-2 rounded-lg bg-white border text-sm hover:bg-gray-50 text-slate-700">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}" class="px-3 py-2 rounded-lg bg-white border text-sm hover:bg-gray-50 text-slate-700">»</a>
        @else
            <span class="px-3 py-2 rounded-lg bg-gray-100 text-gray-400 text-sm">»</span>
        @endif
    </nav>
@endif