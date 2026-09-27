@extends('layouts.public_app')

@section('title', $sop->judul)

@section('content')

<x-page-hero 
    title="SOP Layanan" 
    icon="doc"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Layanan'],
        ['label' => 'SOP Layanan', 'url' => route('informasi-publik.sop')],
        ['label' => \Illuminate\Support\Str::limit($sop->judul, 40)]
    ]"
/>

<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">

    {{-- Info SOP --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-5 md:p-6 mb-6">
        <div class="flex flex-col md:flex-row md:items-start md:justify-between gap-4">
            <div class="min-w-0">
                <span class="inline-block px-3 py-1 mb-2 text-xs font-medium rounded-md border {{ $sop->isAktif() ? 'bg-green-50 text-green-700 border-green-200' : 'bg-gray-50 text-gray-500 border-gray-200' }}">
                    {{ $sop->isAktif() ? 'Aktif' : 'Tidak Berlaku' }}
                </span>
                <h1 class="text-xl md:text-2xl font-bold text-gray-800 leading-snug">{{ $sop->judul }}</h1>
                <div class="mt-3 flex flex-wrap gap-x-6 gap-y-1 text-sm text-gray-500">
                    <span><i class="bi bi-calendar-check"></i> Tanggal Efektif: {{ $sop->tanggal_efektif->translatedFormat('d F Y') }}</span>
                    <span><i class="bi bi-pen"></i> Penandatangan: {{ $sop->penandatangan }}</span>
                    @if($sop->file_size_kb)
                        <span><i class="bi bi-file-earmark-pdf"></i> {{ $sop->file_size_kb }} KB</span>
                    @endif
                </div>
            </div>

            <div class="flex gap-2 shrink-0">
                <a href="{{ $sop->file_url }}" download="{{ $sop->file_nama }}"
                   class="inline-flex items-center gap-1.5 px-4 py-2 rounded-lg text-sm font-semibold bg-hijau-600 text-white hover:bg-hijau-700 transition">
                    <i class="bi bi-download"></i> Unduh
                </a>
            </div>
        </div>
    </div>

    {{-- Pratinjau PDF (pdf.js, ukuran kertas A4) --}}
    <div id="pdf-preview" class="w-full bg-gray-100 rounded-2xl border border-gray-200 p-2 space-y-2 h-[70vh] md:h-[1123px] overflow-y-auto overscroll-contain" data-url="{{ $sop->file_url }}">
        <p id="pdf-status" class="py-10 text-center text-sm text-gray-500">Memuat pratinjau...</p>
    </div>

    <div class="mt-8 text-center">
        <a href="{{ route('informasi-publik.sop') }}" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-gray-700 rounded-xl text-sm font-medium border border-gray-200 hover:bg-gray-100 transition">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar SOP
        </a>
    </div>
</div>
@endsection

@push('scripts')
<script type="module">
    const box = document.getElementById('pdf-preview');
    const status = document.getElementById('pdf-status');

    if (box) {
        try {
            const pdfjs = await import('https://cdn.jsdelivr.net/npm/pdfjs-dist@4.10.38/build/pdf.min.mjs');
            pdfjs.GlobalWorkerOptions.workerSrc = 'https://cdn.jsdelivr.net/npm/pdfjs-dist@4.10.38/build/pdf.worker.min.mjs';

            const pdf = await pdfjs.getDocument(box.dataset.url).promise;
            const ratio = window.devicePixelRatio || 1;
            const width = box.clientWidth - 16;
            status.remove();

            for (let n = 1; n <= pdf.numPages; n++) {
                const page = await pdf.getPage(n);
                const base = page.getViewport({ scale: 1 });
                const viewport = page.getViewport({ scale: (width / base.width) * ratio });

                const canvas = document.createElement('canvas');
                canvas.width = viewport.width;
                canvas.height = viewport.height;
                canvas.style.width = '100%';
                canvas.className = 'bg-white rounded-lg shadow-sm';
                box.appendChild(canvas);

                await page.render({ canvasContext: canvas.getContext('2d'), viewport }).promise;
            }
        } catch (e) {
            status.textContent = 'Pratinjau tidak dapat ditampilkan. Silakan gunakan tombol Unduh.';
        }
    }
</script>
@endpush
