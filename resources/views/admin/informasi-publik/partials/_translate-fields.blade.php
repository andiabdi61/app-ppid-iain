{{-- 
    Partial: Field Terjemahan untuk Informasi Publik
    @param $item (nullable) — model InformasiPublik saat edit, null saat create
--}}

@php
    $item = $item ?? null;
    $hasTranslation = $item && (
        $item->judul_en || $item->judul_ar || 
        $item->konten_en || $item->konten_ar ||
        $item->pejabat_en || $item->pejabat_ar ||
        $item->penanggung_jawab_en || $item->penanggung_jawab_ar ||
        $item->tempat_en || $item->tempat_ar ||
        $item->jangka_waktu_en || $item->jangka_waktu_ar
    );
@endphp

<div id="info-translation-fields" class="{{ $hasTranslation ? '' : 'hidden' }} mt-8 p-6 bg-gray-50 border border-dashed border-gray-300 rounded-xl">
    <div class="flex items-center justify-between border-b border-gray-300 pb-2 mb-6">
        <h3 class="text-lg font-semibold text-gray-700">Terjemahan (Bisa diedit manual)</h3>
        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full font-medium">AI Generated</span>
    </div>
    
    {{-- ========== TERJEMAHAN JUDUL ========== --}}
    <div class="mb-6">
        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Judul</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="judul_en" class="block text-sm font-bold text-gray-700 mb-1">🇬🇧 Judul (English)</label>
                <input type="text" name="judul_en" id="judul_en" value="{{ old('judul_en', $item?->judul_en) }}" 
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="English title...">
            </div>
            <div>
                <label for="judul_ar" class="block text-sm font-bold text-gray-700 mb-1 text-right">🇸🇦 Judul (العربية)</label>
                <input type="text" name="judul_ar" id="judul_ar" value="{{ old('judul_ar', $item?->judul_ar) }}" 
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right" dir="rtl"
                       placeholder="...العنوان بالعربية">
            </div>
        </div>
    </div>

    {{-- ========== TERJEMAHAN PEJABAT ========== --}}
    <div class="mb-6">
        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Pejabat</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="pejabat_en" class="block text-sm font-bold text-gray-700 mb-1">🇬🇧 Pejabat (English)</label>
                <input type="text" name="pejabat_en" id="pejabat_en" value="{{ old('pejabat_en', $item?->pejabat_en) }}" 
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="Official name...">
            </div>
            <div>
                <label for="pejabat_ar" class="block text-sm font-bold text-gray-700 mb-1 text-right">🇸🇦 Pejabat (العربية)</label>
                <input type="text" name="pejabat_ar" id="pejabat_ar" value="{{ old('pejabat_ar', $item?->pejabat_ar) }}" 
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right" dir="rtl"
                       placeholder="...المسؤول">
            </div>
        </div>
    </div>

    {{-- ========== TERJEMAHAN PENANGGUNG JAWAB ========== --}}
    <div class="mb-6">
        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Penanggung Jawab</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="penanggung_jawab_en" class="block text-sm font-bold text-gray-700 mb-1">🇬🇧 Penanggung Jawab (English)</label>
                <input type="text" name="penanggung_jawab_en" id="penanggung_jawab_en" value="{{ old('penanggung_jawab_en', $item?->penanggung_jawab_en) }}" 
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="Person in charge...">
            </div>
            <div>
                <label for="penanggung_jawab_ar" class="block text-sm font-bold text-gray-700 mb-1 text-right">🇸🇦 Penanggung Jawab (العربية)</label>
                <input type="text" name="penanggung_jawab_ar" id="penanggung_jawab_ar" value="{{ old('penanggung_jawab_ar', $item?->penanggung_jawab_ar) }}" 
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right" dir="rtl"
                       placeholder="...المسؤول">
            </div>
        </div>
    </div>

    {{-- ========== TERJEMAHAN TEMPAT ========== --}}
    <div class="mb-6">
        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Tempat</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="tempat_en" class="block text-sm font-bold text-gray-700 mb-1">🇬🇧 Tempat (English)</label>
                <input type="text" name="tempat_en" id="tempat_en" value="{{ old('tempat_en', $item?->tempat_en) }}" 
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="Location...">
            </div>
            <div>
                <label for="tempat_ar" class="block text-sm font-bold text-gray-700 mb-1 text-right">🇸🇦 Tempat (العربية)</label>
                <input type="text" name="tempat_ar" id="tempat_ar" value="{{ old('tempat_ar', $item?->tempat_ar) }}" 
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right" dir="rtl"
                       placeholder="...المكان">
            </div>
        </div>
    </div>

    {{-- ========== TERJEMAHAN JANGKA WAKTU ========== --}}
    <div class="mb-6">
        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Jangka Waktu</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="jangka_waktu_en" class="block text-sm font-bold text-gray-700 mb-1">🇬🇧 Jangka Waktu (English)</label>
                <input type="text" name="jangka_waktu_en" id="jangka_waktu_en" value="{{ old('jangka_waktu_en', $item?->jangka_waktu_en) }}" 
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="Time period...">
            </div>
            <div>
                <label for="jangka_waktu_ar" class="block text-sm font-bold text-gray-700 mb-1 text-right">🇸🇦 Jangka Waktu (العربية)</label>
                <input type="text" name="jangka_waktu_ar" id="jangka_waktu_ar" value="{{ old('jangka_waktu_ar', $item?->jangka_waktu_ar) }}" 
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right" dir="rtl"
                       placeholder="...المدة الزمنية">
            </div>
        </div>
    </div>

    {{-- ========== TERJEMAHAN KONTEN ========== --}}
    <div>
        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Konten Detail</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="konten_en" class="block text-sm font-bold text-gray-700 mb-1">🇬🇧 Konten (English)</label>
                <textarea name="konten_en" id="konten_en" rows="6" 
                          class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 tinymce-editor">{{ old('konten_en', $item?->konten_en) }}</textarea>
            </div>
            <div>
                <label for="konten_ar" class="block text-sm font-bold text-gray-700 mb-1 text-right">🇸🇦 Konten (العربية)</label>
                <textarea name="konten_ar" id="konten_ar" rows="6" 
                          class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 tinymce-editor" dir="rtl">{{ old('konten_ar', $item?->konten_ar) }}</textarea>
            </div>
        </div>
    </div>
</div>
