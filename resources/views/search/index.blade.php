@extends('layouts.public_app')

@section('title', 'Hasil Pencarian')

@section('content')

{{-- Hero Section --}}
<x-page-hero 
    title="Hasil Pencarian" 
    icon="doc"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Hasil Pencarian']
    ]"
/>

{{-- Query Info Bar --}}
@if ($query)
<div class="bg-gray-50 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <p class="text-sm text-gray-500 text-center md:text-left">
            Menampilkan hasil untuk: <span class="font-semibold text-gray-800">"{{ $query }}"</span>
        </p>
    </div>
</div>
@endif

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    {{-- FORM PENCARIAN ULANG --}}
    <div class="flex justify-center mb-8">
        <div class="w-full max-w-3xl">
            <form action="{{ route('search') }}" method="GET" class="flex">
                <input type="search" name="q" 
                       class="flex-1 px-4 py-3 rounded-l-xl border border-gray-300 border-r-0 text-sm placeholder-gray-400 focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none transition" 
                       placeholder="Cari berita, dokumen, atau informasi lainnya..." 
                       value="{{ $query }}" aria-label="Cari Ulang">
                <button class="px-6 py-3 bg-hijau-600 hover:bg-hijau-700 text-white rounded-r-xl transition-colors" type="submit">
                    <i class="bi bi-search"></i>
                </button>
            </form>
        </div>
    </div>
    
    @php
        $totalResults = $results->sum(fn($group) => $group['items']->count());
    @endphp

    @if ($totalResults > 0)
        
        {{-- Info Jumlah Hasil --}}
        <div class="mb-8 pb-6 border-b border-gray-200">
            <p class="text-sm text-gray-500">
                Ditemukan total <span class="font-semibold text-gray-800">{{ $totalResults }}</span> hasil yang relevan.
            </p>
        </div>

        {{-- Loop Hasil Per Kategori --}}
        @foreach ($results as $resultGroup)
            @if ($resultGroup['items']->isNotEmpty())
                <div class="{{ !$loop->first ? 'mt-10' : '' }}">
                    
                    {{-- Label Kategori --}}
                    <h3 class="text-lg font-bold text-gray-900 mb-5 flex items-center gap-2.5">
                        <span class="w-1.5 h-6 bg-hijau-600 rounded-full"></span>
                        {{ $resultGroup['label'] }} 
                        <span class="text-sm font-normal text-gray-400">({{ $resultGroup['items']->count() }})</span>
                    </h3>
                    
                    {{-- Grid Kartu Hasil --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach ($resultGroup['items'] as $item)
                            @php
                                $itemType = match (get_class($item)) {
                                    App\Models\Post::class => 'post',
                                    App\Models\Dokumen::class => 'dokumen',
                                    App\Models\InformasiPublik::class => 'informasi_publik',
                                    App\Models\Bidang::class => 'bidang',
                                    App\Models\Seksi::class => 'seksi',
                                    App\Models\Pejabat::class => 'pejabat',
                                    default => ''
                                };
                            @endphp
                            
                            @if ($itemType)
                                @include('search.partials.' . $itemType, ['item' => $item, 'query' => $query])
                            @endif
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    @else
        {{-- EMPTY STATE --}}
        <div class="text-center py-16">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 mb-6">
                <i class="bi bi-folder-x text-gray-400 text-3xl"></i>
            </div>
            <h3 class="text-xl font-semibold text-gray-900 mb-2">Tidak Ada Hasil Ditemukan</h3>
            <p class="text-gray-500 max-w-md mx-auto leading-relaxed">
                Kami tidak dapat menemukan apa pun untuk pencarian "<span class="font-medium text-gray-700">{{ $query }}</span>".<br>
                Silakan coba dengan kata kunci yang berbeda.
            </p>
        </div>
    @endif

    {{-- ============================================ --}}
    {{-- MODAL PEJABAT (Alpine.js) --}}
    {{-- ============================================ --}}
    <div x-data="{ open: false }" 
         x-show="open" 
         x-cloak
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         class="fixed inset-0 z-[100] flex items-center justify-center p-4"
         @keydown.escape.window="open = false"
         id="pejabatModal">
        
        {{-- Backdrop --}}
        <div class="absolute inset-0 bg-black/50 backdrop-blur-sm" @click="open = false"></div>
        
        {{-- Modal Content --}}
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-4xl w-full max-h-[90vh] overflow-y-auto z-10"
             x-show="open"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95 translate-y-4"
             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100 translate-y-0"
             x-transition:leave-end="opacity-0 scale-95 translate-y-4">
            
            {{-- Tombol Close --}}
            <button @click="open = false" 
                    class="absolute top-4 right-4 z-20 w-8 h-8 rounded-full bg-gray-100 hover:bg-gray-200 flex items-center justify-center text-gray-500 transition-colors">
                <i class="bi bi-x-lg text-sm"></i>
            </button>

            <div id="pejabatModalContent"></div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openPejabatModal(pejabatId) {
    const modal = document.getElementById('pejabatModal');
    if (!modal) return;

    // 1. Aktifkan state Alpine.js
    const alpineData = Alpine.$data(modal);
    alpineData.open = true;

    // 2. Ambil URL dari atribut body
    const baseUrl = document.body.getAttribute('data-pejabat-modal-url');
    const url = baseUrl.replace('PEJABAT_ID_PLACEHOLDER', pejabatId);

    // 3. Fetch data via AJAX
    const contentEl = document.getElementById('pejabatModalContent');
    contentEl.innerHTML = `
        <div class="flex justify-center items-center py-16">
            <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-hijau-600"></div>
        </div>
    `;

    fetch(url)
        .then(response => response.text())
        .then(html => {
            contentEl.innerHTML = html;
        })
        .catch(() => {
            contentEl.innerHTML = `
                <div class="text-center py-16 text-red-500">
                    <i class="bi bi-exclamation-triangle text-2xl block mb-2"></i>
                    Gagal memuat data pejabat.
                </div>
            `;
        });
}
</script>
@endpush