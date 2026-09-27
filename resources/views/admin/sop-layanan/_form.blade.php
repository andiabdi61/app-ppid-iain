@php $editing = isset($sop); @endphp

@if ($errors->any())
    <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 mb-6 rounded-r-lg" role="alert">
        <ul class="list-disc list-inside text-sm space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <div class="md:col-span-2">
        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul SOP <span class="text-red-500">*</span></label>
        <input type="text" name="judul" id="judul" value="{{ old('judul', $sop->judul ?? '') }}" required
               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    <div>
        <label for="tanggal_pembuatan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pembuatan <span class="text-red-500">*</span></label>
        <input type="date" name="tanggal_pembuatan" id="tanggal_pembuatan" required
               value="{{ old('tanggal_pembuatan', isset($sop) ? $sop->tanggal_pembuatan->format('Y-m-d') : '') }}"
               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    <div>
        <label for="tanggal_efektif" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Efektif <span class="text-red-500">*</span></label>
        <input type="date" name="tanggal_efektif" id="tanggal_efektif" required
               value="{{ old('tanggal_efektif', isset($sop) ? $sop->tanggal_efektif->format('Y-m-d') : '') }}"
               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    <div>
        <label for="penandatangan" class="block text-sm font-medium text-gray-700 mb-1">Penandatangan <span class="text-red-500">*</span></label>
        <input type="text" name="penandatangan" id="penandatangan" value="{{ old('penandatangan', $sop->penandatangan ?? '') }}" required
               placeholder="Contoh: Rektor IAIN Bone"
               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
    </div>

    <div>
        <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status <span class="text-red-500">*</span></label>
        <select name="status" id="status" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="aktif" @selected(old('status', $sop->status ?? 'aktif') === 'aktif')>Aktif</option>
            <option value="tidak_berlaku" @selected(old('status', $sop->status ?? 'aktif') === 'tidak_berlaku')>Tidak Berlaku</option>
        </select>
    </div>

    <div class="md:col-span-2">
        <label for="file_sop" class="block text-sm font-medium text-gray-700 mb-1">
            File SOP (PDF) @unless($editing)<span class="text-red-500">*</span>@endunless
        </label>
        <input type="file" name="file_sop" id="file_sop" accept="application/pdf" @unless($editing) required @endunless
               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
        <p class="mt-1 text-xs text-gray-500">PDF, maksimal 10MB.@if($editing) Kosongkan jika tidak ingin mengganti file.@endif</p>
        @if($editing)
            <a href="{{ $sop->file_url }}" target="_blank" class="inline-flex items-center gap-2 mt-2 text-sm text-indigo-600 hover:underline">
                <i class="bi bi-file-earmark-pdf text-red-500"></i> {{ $sop->file_nama }}
            </a>
        @endif
    </div>
</div>
