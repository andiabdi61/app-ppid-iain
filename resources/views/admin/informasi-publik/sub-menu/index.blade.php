<x-app-layout>
   <x-slot name="header">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        
        <!-- Kiri: Navigasi & Judul -->
        <div>
            <a href="{{ route('admin.informasi-publik.index') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-hijau-600 font-medium transition mb-2">
                <i class="fa-solid fa-arrow-left text-xs"></i> Kembali ke Daftar Judul Utama
            </a>
            <h2 class="font-bold text-2xl text-gray-800 leading-tight flex items-center gap-2">
                <i class="fa-solid fa-sitemap text-hijau-600 text-xl"></i> 
                Daftar Sub-Menu
            </h2>
        </div>

        <!-- Kanan: Info Card Induk (Parent) -->
        <div class="bg-white border border-gray-200 rounded-xl p-4 shadow-sm md:min-w-[320px]">
            <div class="text-[10px] font-bold uppercase tracking-wider text-gray-400 mb-1">Induk Utama</div>
            <div class="text-base font-bold text-gray-800 mb-2 leading-tight">
                {{ $informasi_publik_item->judul }}
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                @if($informasi_publik_item->category)
                    <span class="inline-flex items-center gap-1 text-xs font-semibold bg-blue-50 text-blue-700 px-2.5 py-1 rounded-full border border-blue-100">
                        <i class="fa-solid fa-tag text-[10px]"></i> {{ $informasi_publik_item->category->nama }}
                    </span>
                @endif
                
                <span class="inline-flex items-center gap-1 text-xs font-semibold {{ $informasi_publik_item->is_active ? 'bg-green-50 text-green-700 border-green-100' : 'bg-red-50 text-red-600 border-red-100' }} px-2.5 py-1 rounded-full border">
                    <i class="fa-solid fa-circle text-[6px]"></i> {{ $informasi_publik_item->is_active ? 'Aktif' : 'Non-Aktif' }}
                </span>
            </div>
        </div>

    </div>
</x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-check"></i>
                                <p class="text-sm font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- TOMBOL TAMBAH SUB-MENU -->
                    <div class="mb-6 flex justify-end">
                        <a href="{{ route('admin.informasi-publik.sub-menu.create', $informasi_publik_item) }}" 
                           class="inline-flex items-center px-4 py-2 bg-hijau-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-hijau-700 transition">
                            <i class="fa-solid fa-plus mr-2"></i> Tambah Sub-Menu Baru
                        </a>
                    </div>

                    <!-- TABEL SUB-MENU -->
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-10">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Sub-Menu</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($subMenus as $sub)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm text-gray-500 text-center">
                                            {{ $loop->iteration }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-semibold text-gray-900">{{ $sub->judul }}</div>
                                            
                                            {{-- INFO FILE ATAU LINK --}}
                                            <div class="mt-1 flex items-center gap-2">
                                                @if($sub->file_path)
                                                    <a href="{{ asset('storage/' . $sub->file_path) }}" target="_blank" class="text-xs text-green-600 hover:text-green-800 inline-flex items-center gap-1">
                                                        <i class="fa-solid fa-file-lines"></i> {{ Str::limit($sub->file_nama, 25) }}
                                                    </a>
                                                @endif
                                                @if($sub->tautan_eksternal)
                                                    <a href="{{ $sub->tautan_eksternal }}" target="_blank" class="text-xs text-blue-600 hover:text-blue-800 inline-flex items-center gap-1">
                                                        <i class="fa-solid fa-arrow-up-right-from-square"></i> Buka Link
                                                    </a>
                                                @endif
                                                @if(!$sub->file_path && !$sub->tautan_eksternal)
                                                    <span class="text-xs text-gray-400 italic">Halaman detail kosong</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-2 py-0.5 inline-flex text-[10px] font-semibold rounded-full {{ $sub->jenis_tautan === 'url' ? 'bg-blue-50 text-blue-600' : 'bg-gray-100 text-gray-600' }}">
                                                {{ $sub->jenis_tautan === 'url' ? 'URL Eksternal' : 'Halaman Detail' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $sub->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $sub->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600 font-medium">
                                            {{ $sub->sort_order }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('admin.informasi-publik.sub-menu.edit', [$informasi_publik_item, $sub]) }}" 
                                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-md text-xs font-semibold hover:bg-indigo-100 transition border border-indigo-200">
                                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                                </a>

                                                <form action="{{ route('admin.informasi-publik.sub-menu.destroy', [$informasi_publik_item, $sub]) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus sub-menu ini?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-50 text-red-700 rounded-md text-xs font-semibold hover:bg-red-100 transition border border-red-200">
                                                        <i class="fa-solid fa-trash"></i> Hapus
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-12 text-center text-sm text-gray-500">
                                            <i class="fa-solid fa-folder-open text-3xl text-gray-300 mb-3 block"></i>
                                            Belum ada sub-menu untuk judul ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>