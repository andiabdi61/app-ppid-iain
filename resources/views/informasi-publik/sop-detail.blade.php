@extends('layouts.public_app')

@section('title', $sop->judul)

@section('content')

<div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 md:pt-8 pb-12">

    {{-- Breadcrumb --}}
    <nav aria-label="breadcrumb">
        <ol class="flex items-center gap-2 text-sm text-gray-500 mb-4 overflow-hidden whitespace-nowrap">
            <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
            <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
            <li>Layanan</li>
            <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
            <li><a href="{{ route('informasi-publik.sop') }}" class="hover:text-hijau-700 transition">SOP Layanan</a></li>
        </ol>
    </nav>

    <h1 class="text-2xl md:text-4xl font-extrabold text-gray-900 leading-tight mb-8">{{ $sop->judul }}</h1>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8 items-start">

        {{-- Informasi SOP --}}
        <aside class="order-1 lg:order-2 lg:col-span-4 lg:sticky lg:top-24">
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6">
                <h2 class="text-lg font-bold text-gray-800 mb-5">Informasi SOP</h2>

                <dl class="space-y-4">
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Status</dt>
                        <dd>
                            <span class="inline-block px-3 py-0.5 text-xs font-semibold rounded-md border {{ $sop->isAktif() ? 'bg-green-50 text-green-700 border-green-200' : 'bg-gray-50 text-gray-500 border-gray-200' }}">
                                {{ $sop->isAktif() ? 'Aktif' : 'Tidak Berlaku' }}
                            </span>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tanggal Efektif</dt>
                        <dd class="font-semibold text-gray-800">{{ $sop->tanggal_efektif->translatedFormat('d F Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Tanggal Pembuatan</dt>
                        <dd class="font-semibold text-gray-800">{{ $sop->tanggal_pembuatan->translatedFormat('d F Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-1">Penandatangan</dt>
                        <dd class="font-semibold text-gray-800">{{ $sop->penandatangan }}</dd>
                    </div>
                </dl>

                <a href="{{ $sop->file_url }}" download="{{ $sop->file_nama }}"
                   class="mt-6 w-full inline-flex items-center justify-center gap-1.5 px-4 py-2.5 rounded-lg text-sm font-semibold bg-hijau-600 text-white hover:bg-hijau-700 transition">
                    <i class="bi bi-download"></i> Unduh
                </a>
            </div>
        </aside>

        {{-- Pratinjau PDF --}}
        <div class="order-2 lg:order-1 lg:col-span-8 min-w-0">
            <div id="pdf-preview" class="w-full bg-gray-100 rounded-2xl border border-gray-200 p-2 space-y-2 h-[70vh] md:h-[1123px] overflow-y-auto overscroll-contain" data-url="{{ $sop->file_url }}">
                <p id="pdf-status" class="py-10 text-center text-sm text-gray-500">Memuat pratinjau...</p>
            </div>
        </div>
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
