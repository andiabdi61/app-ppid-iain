<x-app-layout>
    <x-slot name="header">
        <div>
            <a href="{{ route('admin.informasi-publik.sub-menu.index', $informasi_publik_item) }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-hijau-600 font-medium transition mb-2">
                <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Daftar Sub-Menu
            </a>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight mt-1 flex items-center gap-2">
                <i class="fa-solid fa-pen-to-square text-indigo-600 text-xl"></i> 
                Edit Sub-Menu
            </h2>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white text-gray-900">
                    
                    {{-- Notifikasi Error --}}
                    @if ($errors->any())
                        <div class="bg-red-50 border-l-4 border-red-400 text-red-700 p-4 mb-6 rounded-r-lg" role="alert">
                            <div class="flex items-center gap-2 font-bold text-sm mb-2">
                                <i class="fa-solid fa-circle-exclamation"></i> Gagal Menyimpan
                            </div>
                            <ul class="list-disc list-inside text-sm space-y-1">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- FORM EDIT MENGGUNAKAN METHOD PUT --}}
                    <form action="{{ route('admin.informasi-publik.sub-menu.update', [$informasi_publik_item, $subMenu]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- WAJIB ADA UNTUK EDIT --}}
                        
                        {{-- INFO INDUK --}}
                        <div class="mb-6 bg-blue-50 border border-blue-200 rounded-lg p-4 flex items-center gap-3">
                            <i class="fa-solid fa-link text-blue-500"></i>
                            <div class="text-sm text-blue-800">
                                Mengubah sub-menu untuk: <span class="font-bold">{{ $informasi_publik_item->judul }}</span> 
                                <span class="text-xs bg-white px-2 py-0.5 rounded-full border border-blue-200 ml-1">{{ $informasi_publik_item->category->nama ?? '-' }}</span>
                            </div>
                        </div>

                        {{-- ======================== 3 KOLOM UTAMA ======================== --}}
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            {{-- ======================== KOLOM KIRI ======================== --}}
                            <div class="space-y-5">
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-100 pb-2">Data Utama</h4>
                                
                                {{-- Judul Sub-Menu --}}
                                <div>
                                    <label for="judul" class="block text-sm font-bold text-gray-700 mb-1">Judul Sub-Menu <span class="text-red-500">*</span></label>
                                    <input type="text" name="judul" id="judul" value="{{ old('judul', $subMenu->judul) }}" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500" required>
                                </div>

                                {{-- Kategori (Readonly) --}}
                                <div>
                                    <label for="category_display" class="block text-sm font-bold text-gray-700 mb-1">Kategori (Mengikuti Induk)</label>
                                    <input type="text" id="category_display" 
                                           value="{{ $informasi_publik_item->category->nama ?? '-' }}" 
                                           class="w-full rounded-lg border-gray-200 bg-gray-50 text-gray-500 shadow-sm cursor-not-allowed" disabled>
                                </div>

                                {{-- Upload File --}}
                                <div>
                                    <label for="file_dokumen" class="block text-sm font-bold text-gray-700 mb-1">File Dokumen <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                                    <input type="file" name="file_dokumen" id="file_dokumen" 
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 cursor-pointer"
                                           accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                                    @if($subMenu->file_path)
                                        <p class="text-xs text-green-600 mt-1 font-medium">
                                            <i class="fa-solid fa-file-lines mr-1"></i>File saat ini: {{ $subMenu->file_nama }} 
                                            <span class="text-gray-400 font-normal">(Biarkan kosong jika tidak ingin mengganti)</span>
                                        </p>
                                    @endif
                                    @error('file_dokumen')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            {{-- ======================== KOLOM TENGAH ======================== --}}
                            <div class="space-y-5">
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-100 pb-2">Metadata & Tautan</h4>

                                {{-- Pejabat --}}
                                <div>
                                    <label for="pejabat" class="block text-sm font-bold text-gray-700 mb-1">Pejabat <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                                    <input type="text" name="pejabat" id="pejabat" value="{{ old('pejabat', $subMenu->pejabat) }}" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500" 
                                           placeholder="Nama pejabat">
                                </div>

                                {{-- Penanggung Jawab --}}
                                <div>
                                    <label for="penanggung_jawab" class="block text-sm font-bold text-gray-700 mb-1">Penanggung Jawab <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                                    <input type="text" name="penanggung_jawab" id="penanggung_jawab" value="{{ old('penanggung_jawab', $subMenu->penanggung_jawab) }}" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500" 
                                           placeholder="Nama penanggung jawab">
                                </div>

                                {{-- Tempat --}}
                                <div>
                                    <label for="tempat" class="block text-sm font-bold text-gray-700 mb-1">Tempat <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                                    <input type="text" name="tempat" id="tempat" value="{{ old('tempat', $subMenu->tempat) }}" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500" 
                                           placeholder="Lokasi pembuatan/dokumen">
                                </div>

                                {{-- Jangka Waktu --}}
                                <div>
                                    <label for="jangka_waktu" class="block text-sm font-bold text-gray-700 mb-1">Jangka Waktu <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                                    <input type="text" name="jangka_waktu" id="jangka_waktu" value="{{ old('jangka_waktu', $subMenu->jangka_waktu) }}" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500" 
                                           placeholder="Contoh: Tahun 2023">
                                </div>

                                {{-- Pengaturan Tautan/Link --}}
                                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200 mt-2" x-data="{ jenisTautan: '{{ old('jenis_tautan', $subMenu->jenis_tautan ?? 'file') }}' }">
                                    <label for="jenis_tautan" class="block text-sm font-bold text-gray-700 mb-2">Pengaturan Tautan</label>
                                    <select name="jenis_tautan" id="jenis_tautan" x-model="jenisTautan"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500 mb-3 text-sm">
                                        <option value="file" {{ $subMenu->jenis_tautan == 'file' ? 'selected' : '' }}>Standar (Buka Detail)</option>
                                        <option value="url" {{ $subMenu->jenis_tautan == 'url' ? 'selected' : '' }}>Langsung buka URL Eksternal</option>
                                    </select>
                                    <div x-show="jenisTautan === 'url'" x-transition>
                                        <input type="url" name="tautan_eksternal" id="tautan_eksternal" 
                                               value="{{ old('tautan_eksternal', $subMenu->tautan_eksternal) }}" 
                                               placeholder="https://link-eksternal.com"
                                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500 text-sm">
                                    </div>
                                </div>
                            </div>

                            {{-- ======================== KOLOM KANAN ======================== --}}
                            <div class="space-y-5">
                                <h4 class="text-xs font-bold text-gray-400 uppercase tracking-wider border-b border-gray-100 pb-2">Pengaturan</h4>

                                {{-- Tanggal Publikasi --}}
                                <div>
                                    <label for="tanggal_publikasi" class="block text-sm font-bold text-gray-700 mb-1">Tanggal Publikasi <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                                    <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" 
                                           value="{{ old('tanggal_publikasi', $subMenu->tanggal_publikasi ? $subMenu->tanggal_publikasi->format('Y-m-d') : now()->format('Y-m-d')) }}" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500">
                                </div>

                                {{-- Urutan Tampil --}}
                                <div>
                                    <label for="sort_order" class="block text-sm font-bold text-gray-700 mb-1">Urutan Tampil <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                                    <input type="number" name="sort_order" id="sort_order" 
                                           value="{{ old('sort_order', $subMenu->sort_order) }}" min="0"
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500">
                                </div>

                                {{-- Upload Thumbnail --}}
                                <div>
                                    <label for="thumbnail" class="block text-sm font-bold text-gray-700 mb-1">Upload Thumbnail <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                                    <input type="file" name="thumbnail" id="thumbnail" 
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 cursor-pointer"
                                           accept="image/jpeg,image/png,image/gif,image/svg+xml">
                                    @if($subMenu->thumbnail)
                                        <p class="text-xs text-green-600 mt-1 font-medium">
                                            <i class="fa-solid fa-image mr-1"></i>Sudah ada thumbnail. (Biarkan kosong jika tidak ingin mengganti)
                                        </p>
                                    @endif
                                    @error('thumbnail')
                                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                {{-- Status Aktif --}}
                                <div>
                                    <label class="flex items-center gap-3 cursor-pointer bg-green-50 p-4 rounded-lg border border-green-200 hover:bg-green-100 transition">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1" id="is_active" 
                                               class="w-5 h-5 rounded border-gray-300 text-hijau-600 focus:ring-hijau-500 cursor-pointer" {{ $subMenu->is_active ? 'checked' : '' }}>
                                        <div>
                                            <span class="text-sm font-bold text-gray-700 block">Aktifkan</span>
                                            <span class="text-xs text-gray-500">Centang jika ingin tampil di website publik.</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- ======================== KONTEN (FULL WIDTH) ======================== --}}
                        <div class="mt-8 pt-6 border-t border-gray-100">
                            <label for="konten" class="block text-sm font-bold text-gray-700 mb-2">
                                Konten Detail 
                                <span class="text-gray-400 font-normal text-xs">(Opsional)</span>
                            </label>
                            <textarea name="konten" id="konten" rows="8" 
                                      class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500 transition tinymce-editor">{{ old('konten', $subMenu->konten) }}</textarea>
                        </div>

                        {{-- ======================== TOMBOL AKSI ======================== --}}
                        <div class="flex items-center justify-end gap-3 mt-6 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.informasi-publik.sub-menu.index', $informasi_publik_item) }}" 
                               class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition">
                                Batal
                            </a>
                            <button type="submit" 
                                    class="px-6 py-2.5 bg-hijau-600 text-white rounded-lg text-sm font-bold hover:bg-hijau-700 transition shadow-sm flex items-center gap-2">
                                <i class="fa-solid fa-floppy-disk"></i> Perbarui Sub-Menu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>