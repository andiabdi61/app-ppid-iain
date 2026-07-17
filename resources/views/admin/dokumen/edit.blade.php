<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Dokumen: ' . Str::limit($dokuman->judul, 50)) }}
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
                                <p class="text-xs text-indigo-600 mt-1">Ubah teks Indonesia, lalu klik tombol untuk generate ulang terjemahan.</p>
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <button type="button" onclick="translateDocFields('en')" id="btn-en" class="px-4 py-2 bg-white border border-indigo-300 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition shadow-sm">
                                    🇬🇧 English
                                </button>
                                <button type="button" onclick="translateDocFields('ar')" id="btn-ar" class="px-4 py-2 bg-white border border-indigo-300 text-indigo-700 rounded-lg text-sm font-medium hover:bg-indigo-100 transition shadow-sm">
                                    🇸🇦 العربية
                                </button>
                                <button type="button" onclick="translateDocFields('all')" id="btn-all" class="px-4 py-2 bg-indigo-600 text-white rounded-lg text-sm font-medium hover:bg-indigo-700 transition shadow-sm">
                                    🌍 Generate Semua
                                </button>
                            </div>
                        </div>
                        <!-- Status Bar -->
                        <div id="doc-translate-status" class="hidden mt-3 pt-3 border-t border-indigo-200">
                            <p class="text-xs text-indigo-700 font-medium">⏳ Memproses...</p>
                            <div class="w-full bg-indigo-200 rounded-full h-1.5 mt-2">
                                <div id="translate-progress" class="bg-indigo-600 h-1.5 rounded-full transition-all duration-500" style="width: 0%"></div>
                            </div>
                        </div>
                    </div>

                    <form action="{{ route('admin.dokumen.update', $dokuman) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') 
                        
                        <!-- SECTION 1: BAHASA INDONESIA -->
                        <div class="space-y-6 mb-8">
                            <div class="border-b border-gray-200 pb-2">
                                <h3 class="text-lg font-semibold text-gray-800">Bahasa Indonesia <span class="text-red-500">*</span></h3>
                            </div>

                            <div>
                                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Dokumen</label>
                                <input type="text" name="judul" id="judul" value="{{ old('judul', $dokuman->getRawOriginal('judul') ?: $dokuman->judul) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            </div>

                            <div>
                                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori Dokumen</label>
                                <select name="category_id" id="category_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                    <option value="">-- Pilih Kategori --</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $dokuman->category_id) == $category->id ? 'selected' : '' }}>{{ $category->nama }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi Dokumen (Opsional)</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi', $dokuman->getRawOriginal('deskripsi') ?: $dokuman->deskripsi) }}</textarea>
                            </div>
                        </div>

                        <!-- SECTION 2: TERJEMAHAN (HIDDEN DEFAULT) -->
                        <div id="doc-translation-fields" class="hidden space-y-6 mb-8 p-6 bg-gray-50 border border-dashed border-gray-300 rounded-xl">
                            <div class="flex items-center justify-between border-b border-gray-300 pb-2">
                                <h3 class="text-lg font-semibold text-gray-700">Terjemahan (Bisa diedit manual)</h3>
                                <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-full font-medium">AI Generated</span>
                            </div>
                            
                            <!-- Terjemahan Judul -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="judul_en" class="block text-sm font-medium text-gray-700 mb-1">🇬🇧 Judul (English)</label>
                                    <input type="text" name="judul_en" id="judul_en" value="{{ old('judul_en', $dokuman->judul_en) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div>
                                    <label for="judul_ar" class="block text-sm font-medium text-gray-700 mb-1 text-right">🇸🇦 Judul (العربية)</label>
                                    <input type="text" name="judul_ar" id="judul_ar" value="{{ old('judul_ar', $dokuman->judul_ar) }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right" dir="rtl">
                                </div>
                            </div>

                            <!-- Terjemahan Deskripsi -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="deskripsi_en" class="block text-sm font-medium text-gray-700 mb-1">🇬🇧 Deskripsi (English)</label>
                                    <textarea name="deskripsi_en" id="deskripsi_en" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('deskripsi_en', $dokuman->deskripsi_en) }}</textarea>
                                </div>
                                <div>
                                    <label for="deskripsi_ar" class="block text-sm font-medium text-gray-700 mb-1 text-right">🇸🇦 Deskripsi (العربية)</label>
                                    <textarea name="deskripsi_ar" id="deskripsi_ar" rows="3" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-right" dir="rtl">{{ old('deskripsi_ar', $dokuman->deskripsi_ar) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- SECTION 3: LAMPIRAN & SETTING -->
                        <div class="space-y-6">
                            <div class="border-b border-gray-200 pb-2">
                                <h3 class="text-lg font-semibold text-gray-800">Lampiran & Pengaturan</h3>
                            </div>

                            <div>
                                <label for="file_dokumen" class="block text-sm font-medium text-gray-700 mb-1">Ganti File Dokumen</label>
                                <input type="file" name="file_dokumen" id="file_dokumen" 
                                    class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100"
                                    accept="application/pdf,application/msword,.doc,.docx,application/vnd.ms-excel,.xls,.xlsx,application/vnd.ms-powerpoint,.ppt,.pptx">
                                <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ingin mengubah file lama. Format: PDF, DOCX, XLSX, PPTX (Maks 5MB)</p>
                                
                                @error('file_dokumen')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror

                                @if($dokuman->file_path)
                                    <div class="mt-3 p-3 bg-gray-50 rounded-lg inline-block">
                                        <p class="text-sm font-medium text-gray-700 mb-1">File Saat Ini:</p>
                                        <a href="{{ asset('storage/' . $dokuman->file_path) }}" target="_blank" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium underline">
                                            📄 {{ $dokuman->file_nama }}
                                        </a>
                                    </div>
                                @endif
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="tanggal_publikasi" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Publikasi (Opsional)</label>
                                    <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" value="{{ old('tanggal_publikasi', $dokuman->tanggal_publikasi ? $dokuman->tanggal_publikasi->format('Y-m-d') : '') }}" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                </div>
                                <div class="flex items-end pb-1">
                                    <label class="inline-flex items-center cursor-pointer">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1" class="w-5 h-5 rounded text-indigo-600 bg-gray-100 border-gray-300 focus:ring-indigo-500 focus:ring-2" {{ $dokuman->is_active ? 'checked' : '' }}>
                                        <span class="ml-3 text-sm font-medium text-gray-700">Tampilkan di halaman publik</span>
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- TOMBOL AKSI -->
                        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.dokumen.index') }}" class="px-5 py-2.5 bg-white border border-gray-300 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-50 transition">
                                Batal
                            </a>
                            <button type="submit" class="px-6 py-2.5 bg-indigo-600 text-white rounded-lg text-sm font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition shadow-sm">
                                Update Dokumen
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- SCRIPT TRANSLATE DOKUMEN (SAMA DENGAN CREATE) -->
    <script>
        async function translateWithLib(text, targetLang) {
            if (!text || text.trim() === '') return '';
            try {
                const response = await fetch(`/admin/translate-library`, {
                    method: 'POST',
                    headers: { 
                        'Content-Type': 'application/json', 
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

        async function translateDocFields(target) {
            const statusEl = document.getElementById('doc-translate-status');
            const progressEl = document.getElementById('translate-progress');
            const judulId = document.getElementById('judul').value;
            const deskripsiId = document.getElementById('deskripsi').value;

            if (!judulId && !deskripsiId) {
                alert('Isi setidaknya Judul atau Deskripsi dokumen dalam Bahasa Indonesia terlebih dahulu.');
                return;
            }

            statusEl.classList.remove('hidden');
            progressEl.style.width = '0%';
            progressEl.classList.remove('bg-green-500');
            progressEl.classList.add('bg-indigo-600');
            
            document.querySelectorAll('#btn-en, #btn-ar, #btn-all').forEach(b => b.disabled = true);

            const fields = document.getElementById('doc-translation-fields');
            if (fields.classList.contains('hidden')) {
                fields.classList.remove('hidden');
            }

            const languages = target === 'all' ? ['en', 'ar'] : [target];
            let totalSteps = 0;
            let currentStep = 0;

            if(judulId) totalSteps += languages.length;
            if(deskripsiId) totalSteps += languages.length;

            for (const lang of languages) {
                const langName = lang === 'en' ? 'English' : 'Arabic';
                
                if (judulId) {
                    statusEl.querySelector('p').innerText = `⏳ Menerjemahkan Judul ke ${langName}...`;
                    const res = await translateWithLib(judulId, lang);
                    if (res) { 
                        if (lang === 'en') document.getElementById('judul_en').value = res; 
                        else document.getElementById('judul_ar').value = res; 
                    }
                    currentStep++;
                    progressEl.style.width = `${(currentStep / totalSteps) * 100}%`;
                }

                if (deskripsiId) {
                    statusEl.querySelector('p').innerText = `⏳ Menerjemahkan Deskripsi ke ${langName}...`;
                    const res = await translateWithLib(deskripsiId, lang);
                    if (res) { 
                        if (lang === 'en') document.getElementById('deskripsi_en').value = res; 
                        else document.getElementById('deskripsi_ar').value = res; 
                    }
                    currentStep++;
                    progressEl.style.width = `${(currentStep / totalSteps) * 100}%`;
                }
            }

            statusEl.querySelector('p').innerText = '✅ Terjemahan selesai! Periksa kolom di bawah.';
            progressEl.style.width = '100%';
            progressEl.classList.remove('bg-indigo-600');
            progressEl.classList.add('bg-green-500');
            
            document.querySelectorAll('#btn-en, #btn-ar, #btn-all').forEach(b => b.disabled = false);
            
            setTimeout(() => {
                statusEl.classList.add('hidden');
                progressEl.classList.remove('bg-green-500');
                progressEl.classList.add('bg-indigo-600');
            }, 4000);
        }
    </script>
</x-app-layout>