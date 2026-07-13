@props([
    'title' => '',             // Judul halaman (Wajib)
    'breadcrumbs' => [],        // Array nested breadcrumb
    'icon' => 'doc'            // Tipe icon: doc, image, home, users, dll
])

{{-- ============================================ --}}
{{-- HERO SECTION (Super Kompak Dinamis) --}}
{{-- ============================================ --}}
<section class="relative bg-gradient-to-br from-hijau-900 via-emerald-900 to-gray-900 py-3 md:py-5 overflow-hidden">
    {{-- Background Blur Dekor --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-10 left-10 w-72 h-72 bg-hijau-400 rounded-full blur-3xl"></div>
        <div class="absolute bottom-10 right-10 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        {{-- Breadcrumb (Hidden di Mobile) --}}
        @if($breadcrumbs)
        <nav aria-label="breadcrumb" class="mb-3 md:mb-2 hidden md:block">
            <ol class="flex items-center gap-2 text-xs flex-wrap">
                @foreach($breadcrumbs as $item)
                    @if(isset($item['url']))
                        <li>
                            <a href="{{ $item['url'] }}" class="text-hijau-300 hover:text-white transition-colors flex items-center gap-1">
                                @if($loop->first)
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-4 0a1 1 0 01-1-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 01-1 1"/></svg>
                                @endif
                                {{ $item['label'] }}
                            </a>
                        </li>
                    @else
                        <li class="text-white font-medium">{{ $item['label'] }}</li>
                    @endif
                    
                    @if(!$loop->last && isset($item['url']))
                    <li>
                        <svg class="w-3 h-3 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </li>
                    @endif
                @endforeach
            </ol>
        </nav>
        @endif

        {{-- Icon & Teks --}}
        <div class="flex items-center gap-2 md:gap-3">
            
            {{-- Icon Dinamis --}}
            <div class="p-1.5 md:p-2 bg-hijau-500/30 md:bg-hijau-500/20 rounded-md md:rounded-lg border border-hijau-400/40 md:border-hijau-400/30 shrink-0">
                @switch($icon)
                    @case('doc')
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-hijau-300 md:text-hijau-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    @break
                    @case('image')
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-hijau-300 md:text-hijau-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    @break
                    @case('eye')
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-hijau-300 md:text-hijau-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    @break
                    @case('target')
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-hijau-300 md:text-hijau-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    @break
                    @case('building')
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-hijau-300 md:text-hijau-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                    @break
                    @default
                        {{-- Icon Default (Bulat) --}}
                        <svg class="w-5 h-5 md:w-6 md:h-6 text-hijau-300 md:text-hijau-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @endswitch
            </div>

            <h1 class="text-sm md:text-xl lg:text-2xl font-bold text-white leading-tight text-left truncate md:whitespace-normal min-w-0">
                {{ $title }}
            </h1>
        </div>
    </div>
</section>