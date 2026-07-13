<x-app-layout>
    <x-slot name="header">
        <div>
            <a href="{{ route('admin.informasi-publik.index') }}" class="text-sm text-gray-500 hover:text-gray-700 mb-1 inline-flex items-center gap-1">
                <i class="fas fa-arrow-left text-xs"></i> Kembali ke Daftar Judul Utama
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mt-1">
                {{ __('Edit Judul Utama') }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white text-gray-900">
                    
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

                    <form action="{{ route('admin.informasi-publik.update', $informasi_publik_item) }}" method="POST" enctype="multipart/form-data"
                          x-data="{ jenisTautan: '{{ old('jenis_tautan', $informasi_publik_item->jenis_tautan ?? 'file') }}' }">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            {{-- KOLOM KIRI --}}
                            <div class="space-y-5">
                                <div>
                                    <label for="judul" class="block text-sm font-bold text-gray-700 mb-1">Judul Utama <span class="text-red-500">*</span></label>
                                    <input type="text" name="judul" id="judul" value="{{ old('judul', $informasi_publik_item->judul) }}" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500" required>
                                </div>

                                <div>
                                    <label for="category_id" class="block text-sm font-bold text-gray-700 mb-1">Kategori <span class="text-red-500">*</span></label>
                                    <select name="category_id" id="category_id" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500" required>
                                        <option value="">-- Pilih Kategori --</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id', $informasi_publik_item->category_id) == $category->id ? 'selected' : '' }}>
                                                {{ $category->nama }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div>
                                    <label for="file_dokumen" class="block text-sm font-bold text-gray-700 mb-1">File Dokumen <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                                    <input type="file" name="file_dokumen" id="file_dokumen" 
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-gray-50 file:text-gray-700 hover:file:bg-gray-100 cursor-pointer"
                                           accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx">
                                    @if($informasi_publik_item->file_path)
                                        <p class="text-xs text-green-600 mt-1 font-medium">
                                            <i class="fa-solid fa-file-lines mr-1"></i>File saat ini: {{ $informasi_publik_item->file_nama }} 
                                            <span class="text-gray-400 font-normal">(Biarkan kosong jika tidak ingin mengganti)</span>
                                        </p>
                                    @endif
                                </div>

                                <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                                    <label for="jenis_tautan" class="block text-sm font-bold text-gray-700 mb-2">Pengaturan Tautan <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                                    <select name="jenis_tautan" id="jenis_tautan" x-model="jenisTautan"
                                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500 mb-3 text-sm">
                                        <option value="file">Standar (Buka Halaman Detail)</option>
                                        <option value="url">Langsung buka URL Eksternal</option>
                                    </select>
                                    <div x-show="jenisTautan === 'url'" x-transition>
                                        <input type="url" name="tautan_eksternal" id="tautan_eksternal" 
                                               value="{{ old('tautan_eksternal', $informasi_publik_item->tautan_eksternal) }}" 
                                               placeholder="https://link-eksternal.com"
                                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500 text-sm">
                                    </div>
                                </div>
                            </div>

                            {{-- KOLOM KANAN --}}
                            <div class="space-y-5">
                                <div>
                                    <label for="tanggal_publikasi" class="block text-sm font-bold text-gray-700 mb-1">Tanggal Publikasi <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                                    <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" 
                                           value="{{ old('tanggal_publikasi', $informasi_publik_item->tanggal_publikasi ? $informasi_publik_item->tanggal_publikasi->format('Y-m-d') : now()->format('Y-m-d')) }}" 
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500">
                                </div>

                                <div>
                                    <label for="sort_order" class="block text-sm font-bold text-gray-700 mb-1">Urutan Tampil <span class="text-gray-400 font-normal text-xs">(Opsional)</span></label>
                                    <input type="number" name="sort_order" id="sort_order" 
                                           value="{{ old('sort_order', $informasi_publik_item->sort_order) }}" min="0"
                                           class="w-full rounded-lg border-gray-300 shadow-sm focus:border-hijau-500 focus:ring-hijau-500">
                                </div>

                                <div class="pt-4">
                                    <label class="flex items-center gap-3 cursor-pointer bg-green-50 p-4 rounded-lg border border-green-200 hover:bg-green-100 transition">
                                        <input type="hidden" name="is_active" value="0">
                                        <input type="checkbox" name="is_active" value="1" id="is_active" 
                                               class="w-5 h-5 rounded border-gray-300 text-hijau-600 focus:ring-hijau-500 cursor-pointer" {{ $informasi_publik_item->is_active ? 'checked' : '' }}>
                                        <div>
                                            <span class="text-sm font-bold text-gray-700 block">Langsung Aktifkan</span>
                                            <span class="text-xs text-gray-500">Centang jika ingin langsung tampil di website publik.</span>
                                        </div>
                                    </label>
                                </div>
                            </div>
                        </div>

                        {{-- TOMBOL AKSI --}}
                        <div class="flex items-center justify-end gap-3 mt-8 pt-6 border-t border-gray-200">
                            <a href="{{ route('admin.informasi-publik.index') }}" class="px-5 py-2.5 bg-gray-100 text-gray-700 rounded-lg text-sm font-medium hover:bg-gray-200 transition">Batal</a>
                            <button type="submit" class="px-6 py-2.5 bg-hijau-600 text-white rounded-lg text-sm font-bold hover:bg-hijau-700 transition shadow-sm flex items-center gap-2">
                                <i class="fa-solid fa-floppy-disk"></i> Perbarui Judul Utama
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>