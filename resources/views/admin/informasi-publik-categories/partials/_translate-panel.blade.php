<div class="mb-8 p-4 bg-indigo-50 border border-indigo-200 rounded-xl">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h3 class="text-sm font-bold text-indigo-800">✨ Auto-Translate (Google Translate)</h3>
            <p class="text-xs text-indigo-600 mt-1">Ketik bahasa Indonesia, lalu klik tombol di bawah untuk generate terjemahan otomatis.</p>
        </div>
        <div class="flex flex-wrap gap-2">
            <button type="button" onclick="translateCategoryFields('en')" id="cat-btn-en" class="px-4 py-2 bg-white border border-indigo-300 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition shadow-sm">
                🇬🇧 English
            </button>
            <button type="button" onclick="translateCategoryFields('ar')" id="cat-btn-ar" class="px-4 py-2 bg-white border border-indigo-300 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition shadow-sm">
                🇸🇦 العربية
            </button>
            <button type="button" onclick="translateCategoryFields('all')" id="cat-btn-all" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
                🌍 Generate Semua
            </button>
        </div>
    </div>
    <div id="category-translate-status" class="hidden mt-3 pt-3 border-t border-indigo-200">
        <p class="text-xs text-indigo-700 font-medium">⏳ Memproses...</p>
        <div class="w-full bg-indigo-200 rounded-full h-1.5 mt-2">
            <div id="category-translate-progress" class="bg-indigo-600 h-1.5 rounded-full transition-all duration-500" style="width: 0%"></div>
        </div>
    </div>
</div>
