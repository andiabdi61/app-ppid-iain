@php
    $item = $item ?? null;
    $hasTranslation = $item && (
        $item->nama_en || $item->nama_ar ||
        $item->deskripsi_en || $item->deskripsi_ar
    );
@endphp

<div id="category-translation-fields" class="{{ $hasTranslation ? '' : 'hidden' }} mt-8 p-6 bg-gray-50 border border-dashed border-gray-300 rounded-xl">
    <div class="flex items-center justify-between border-b border-gray-300 pb-2 mb-6">
        <h3 class="text-lg font-semibold text-gray-700">Terjemahan (Bisa diedit manual)</h3>
        <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full font-medium">AI Generated</span>
    </div>

    <div class="mb-6">
        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Nama Kategori</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="nama_en" class="block text-sm font-bold text-gray-700 mb-1">🇬🇧 Nama (English)</label>
                <input type="text" name="nama_en" id="nama_en" value="{{ old('nama_en', $item?->nama_en) }}"
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="Category name...">
            </div>
            <div>
                <label for="nama_ar" class="block text-sm font-bold text-gray-700 mb-1 text-right">🇸🇦 Nama (العربية)</label>
                <input type="text" name="nama_ar" id="nama_ar" value="{{ old('nama_ar', $item?->nama_ar) }}"
                       class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right" dir="rtl"
                       placeholder="...اسم الفئة">
            </div>
        </div>
    </div>

    <div>
        <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-3">Deskripsi</h4>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="deskripsi_en" class="block text-sm font-bold text-gray-700 mb-1">🇬🇧 Deskripsi (English)</label>
                <textarea name="deskripsi_en" id="deskripsi_en" rows="4"
                          class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                          placeholder="Category description...">{{ old('deskripsi_en', $item?->deskripsi_en) }}</textarea>
            </div>
            <div>
                <label for="deskripsi_ar" class="block text-sm font-bold text-gray-700 mb-1 text-right">🇸🇦 Deskripsi (العربية)</label>
                <textarea name="deskripsi_ar" id="deskripsi_ar" rows="4"
                          class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right" dir="rtl"
                          placeholder="...وصف الفئة">{{ old('deskripsi_ar', $item?->deskripsi_ar) }}</textarea>
            </div>
        </div>
    </div>
</div>
