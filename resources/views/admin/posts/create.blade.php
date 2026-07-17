<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Artikel Berita Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white text-gray-900">
                    
                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-r-md" role="alert">
                            <ul class="list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- PANEL TOMBOL AUTO TRANSLATE -->
                    <div class="mb-8 p-4 bg-indigo-50 border border-indigo-200 rounded-xl">
                        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                            <div>
                                <h3 class="text-sm font-bold text-indigo-800">✨ Auto-Translate (Google Translate)</h3>
                                <p class="text-xs text-indigo-600 mt-1">Ketik bahasa Indonesia, lalu klik tombol di bawah.</p>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" onclick="translatePostFields('en')" id="btn-en" class="px-4 py-2 bg-white border border-indigo-300 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition shadow-sm">
                                    🇬🇧 English
                                </button>
                                <button type="button" onclick="translatePostFields('ar')" id="btn-ar" class="px-4 py-2 bg-white border border-indigo-300 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition shadow-sm">
                                    🇸🇦 العربية
                                </button>
                                <button type="button" onclick="translatePostFields('all')" id="btn-all" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
                                    🌍 Generate Semua
                                </button>
                            </div>
                        </div>
                        <!-- Status Bar -->
                        <div id="post-translate-status" class="hidden mt-3 pt-3 border-t border-indigo-200">
                            <p class="text-xs text-indigo-700 font-medium">⏳ Memproses...</p>
                            <div class="w-full bg-indigo-200 rounded-full h-1.5 mt-2">
                                <div id="translate-progress" class="bg-indigo-600 h-1.5 rounded-full transition-all duration-500" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- SECTION 1: BAHASA INDONESIA (SELALU TAMPIL) -->
                        <div class="space-y-6 mb-8">
                            <div class="border-b border-gray-200 pb-2">
                                <h3 class="text-lg font-semibold text-gray-800">Bahasa Indonesia <span class="text-red-500">*</span></h3>
                            </div>

                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Judul Berita</label>
                                <input type="text" name="title" id="title" value="{{ old('title') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-1">Meta Title (SEO)</label>
                                    <input type="text" name="meta_title" id="meta_title" value="{{ old('meta_title') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <p class="mt-1 text-xs text-gray-500">Kosongkan jika ingin pakai judul.</p>
                                </div>
                                <div>
                                    <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                                    <select name="category_id" id="category_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div>
                                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-1">Meta Description (SEO)</label>
                                <textarea name="meta_description" id="meta_description" rows="2" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('meta_description') }}</textarea>
                            </div>

                            <div>
                                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-1">Ringkasan (Excerpt)</label>
                                <textarea name="excerpt" id="excerpt" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt') }}</textarea>
                            </div>

                            <div>
                                <label for="content_html" class="block text-sm font-medium text-gray-700 mb-1">Konten Berita Utama</label>
                                <textarea name="content_html" id="content_html" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 tinymce-editor" rows="10">{{ old('content_html') }}</textarea>
                            </div>
                        </div>

                        <!-- SECTION 2: TERJEMAHAN (HIDDEN DEFAULT) -->
                        <div id="post-translation-fields" class="hidden space-y-6 mb-8 p-6 bg-gray-50 border border-dashed border-gray-300 rounded-xl">
                            <div class="flex items-center justify-between border-b border-gray-300 pb-2">
                                <h3 class="text-lg font-semibold text-gray-700">Terjemahan (Bisa diedit manual)</h3>
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full font-medium">AI Generated</span>
                            </div>
                            
                            <!-- Terjemahan Judul -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="title_en" class="block text-sm font-medium text-gray-700 mb-1">🇬🇧 Judul (English)</label>
                                    <input type="text" name="title_en" id="title_en" value="{{ old('title_en') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="title_ar" class="block text-sm font-medium text-gray-700 mb-1 text-right">🇸🇦 Judul (العربية)</label>
                                    <input type="text" name="title_ar" id="title_ar" value="{{ old('title_ar') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right" dir="rtl">
                                </div>
                            </div>

                            <!-- Terjemahan Ringkasan -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="excerpt_en" class="block text-sm font-medium text-gray-700 mb-1">🇬🇧 Ringkasan (English)</label>
                                    <textarea name="excerpt_en" id="excerpt_en" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('excerpt_en') }}</textarea>
                                </div>
                                <div>
                                    <label for="excerpt_ar" class="block text-sm font-medium text-gray-700 mb-1 text-right">🇸🇦 Ringkasan (العربية)</label>
                                    <textarea name="excerpt_ar" id="excerpt_ar" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right" dir="rtl">{{ old('excerpt_ar') }}</textarea>
                                </div>
                            </div>

                            <!-- Terjemahan Konten -->
                            <div class="space-y-6">
                                <div>
                                    <label for="content_html_en" class="block text-sm font-medium text-gray-700 mb-1">🇬🇧 Konten (English)</label>
                                    <textarea name="content_html_en" id="content_html_en" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 tinymce-editor" rows="10">{{ old('content_html_en') }}</textarea>
                                </div>
                                <div>
                                    <label for="content_html_ar" class="block text-sm font-medium text-gray-700 mb-1 text-right">🇸🇦 Konten (العربية)</label>
                                    <textarea name="content_html_ar" id="content_html_ar" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 tinymce-editor" rows="10" dir="rtl">{{ old('content_html_ar') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 3: LAMPIRAN & SETTING -->
                        <div class="space-y-6">
                            <div class="border-b border-gray-200 pb-2">
                                <h3 class="text-lg font-semibold text-gray-800">Lampiran & Pengaturan</h3>
                            </div>

                            <div>
                                <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-1">Gambar Unggulan</label>
                                <input type="file" name="featured_image" id="featured_image" 
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" 
                                    accept="image/*">
                                <p class="mt-1 text-xs text-gray-500">JPG, PNG, atau WebP (Maks 2MB)</p>
                                @error('featured_image')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status Publikasi</label>
                                    <select name="status" id="status" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                        <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Simpan dulu)</option>
                                        <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Langsung tampil)</option>
                                    </select>
                                </div>
                                <div class="flex items-end pb-1">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1" class="w-5 h-5 rounded text-indigo-600 bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:ring-2" checked>
                                        <span class="ml-3 text-sm font-medium text-gray-700">Tampilkan di halaman publik</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- TOMBOL AKSI -->
                        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.posts.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition shadow-sm">
                                Simpan Berita
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT TRANSLATE LIBRARY STICHOZA (FIXED) -->
    <script>
        function setEditorContent(elementId, text) {
            if (typeof tinymce !== 'undefined' && tinymce.get(elementId)) {
                tinymce.get(elementId).setContent(text);
            } else {
                document.getElementById(elementId).value = text;
            }
        }

        function getEditorContent(elementId) {
            if (typeof tinymce !== 'undefined' && tinymce.get(elementId)) {
                return tinymce.get(elementId).getContent();
            }
            return document.getElementById(elementId).value;
        }

        async function translateWithLib(text, targetLang) {
            if (!text || text.trim() === '') return '';
            try {
                const response = await fetch(`/admin/translate-library`, {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json', 
                        // FIX: Ambil token dari input hidden @csrf, jauh lebih aman daripada meta tag
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value 
                    },
                    body: JSON.stringify({ text: text, target_lang: targetLang })
                });
                
                const data = await response.json();
                if (data.success) return data.translation;
                throw new Error(data.message || 'Gagal memproses terjemahan');
            } catch (error) {
                console.error("Translate Error:", error);
                alert('Gagal menerjemahkan. Coba cek Console (F12) untuk detail error.');
                return ''; 
            }
        }

        async function translatePostFields(target) {
            const statusEl = document.getElementById('post-translate-status');
            const progressEl = document.getElementById('translate-progress');
            const titleId = document.getElementById('title').value;
            const excerptId = document.getElementById('excerpt').value;
            const contentId = getEditorContent('content_html');

            if (!titleId && !excerptId && !contentId) {
                alert('Isi setidaknya Judul, Ringkasan, atau Konten berita dalam Bahasa Indonesia terlebih dahulu.');
                return;
            }

            // Tampilkan status & reset progress
            statusEl.classList.remove('hidden');
            progressEl.style.width = '0%';
            progressEl.classList.remove('bg-green-500');
            progressEl.classList.add('bg-indigo-600');
            
            // Nonaktifkan tombol
            document.querySelectorAll('#btn-en, #btn-ar, #btn-all').forEach(b => b.disabled = true);

            // Buka kolom terjemahan jika masih tertutup (TANPA memaksa re-init TinyMCE)
            const fields = document.getElementById('post-translation-fields');
            if (fields.classList.contains('hidden')) {
                fields.classList.remove('hidden');
            }

            const languages = target === 'all' ? ['en', 'ar'] : [target];
            let totalSteps = 0;
            let currentStep = 0;

            if(titleId) totalSteps += languages.length;
            if(excerptId) totalSteps += languages.length;
            if(contentId) totalSteps += languages.length;

            for (const lang of languages) {
                const langName = lang === 'en' ? 'English' : 'Arabic';
                
                if (titleId) {
                    statusEl.querySelector('p').innerText = `⏳ Menerjemahkan Judul ke ${langName}...`;
                    const res = await translateWithLib(titleId, lang);
                    if (res) { 
                        if (lang === 'en') document.getElementById('title_en').value = res; 
                        else document.getElementById('title_ar').value = res; 
                    }
                    currentStep++;
                    progressEl.style.width = `${(currentStep / totalSteps) * 100}%`;
                }

                if (excerptId) {
                    statusEl.querySelector('p').innerText = `⏳ Menerjemahkan Ringkasan ke ${langName}...`;
                    const res = await translateWithLib(excerptId, lang);
                    if (res) { 
                        if (lang === 'en') document.getElementById('excerpt_en').value = res; 
                        else document.getElementById('excerpt_ar').value = res; 
                    }
                    currentStep++;
                    progressEl.style.width = `${(currentStep / totalSteps) * 100}%`;
                }

                if (contentId) {
                    statusEl.querySelector('p').innerText = `⏳ Menerjemahkan Konten Utama ke ${langName}... (Mohon tunggu)`;
                    const res = await translateWithLib(contentId, lang);
                    if (res) { 
                        const targetEditorId = lang === 'en' ? 'content_html_en' : 'content_html_ar';
                        setEditorContent(targetEditorId, res); 
                    }
                    currentStep++;
                    progressEl.style.width = `${(currentStep / totalSteps) * 100}%`;
                }
            }

            statusEl.querySelector('p').innerText = '✅ Terjemahan selesai! Periksa kolom di bawah.';
            progressEl.style.width = '100%';
            progressEl.classList.remove('bg-indigo-600');
            progressEl.classList.add('bg-green-500');
            
            // Aktifkan kembali tombol
            document.querySelectorAll('#btn-en, #btn-ar, #btn-all').forEach(b => b.disabled = false);
            
            setTimeout(() => {
                statusEl.classList.add('hidden');
                progressEl.classList.remove('bg-green-500');
                progressEl.classList.add('bg-indigo-600');
            }, 4000);
        }
    </script>
</x-app-layout>