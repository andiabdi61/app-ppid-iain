<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Informasi Publik') }}
            </h2>
            <a href="{{ route('admin.informasi-publik.create') }}" class="inline-flex items-center px-4 py-2 bg-hijau-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-hijau-700 transition">
                <i class="fa-solid fa-plus mr-2"></i> Tambah Judul Utama
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                                        @if (session('error'))
                        <div class="bg-red-50 border border-red-200 text-red-700 p-4 mb-6 rounded-lg" role="alert">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-xmark text-lg"></i>
                                <p class="text-sm font-medium">{!! session('error') !!}</p>
                            </div>
                        </div>
                    @endif

                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-check"></i>
                                <p class="text-sm font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="bg-green-50 border border-green-200 text-green-700 p-4 mb-6 rounded-lg" role="alert">
                            <div class="flex items-center gap-2">
                                <i class="fa-solid fa-circle-check"></i>
                                <p class="text-sm font-medium">{{ session('success') }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- FILTER KATEGORI -->
                    <div class="mb-6 bg-gray-50 p-4 rounded-lg border flex flex-col sm:flex-row items-start sm:items-center gap-3">
                        <div class="flex items-center gap-2 text-sm font-semibold text-gray-600 shrink-0">
                            <i class="fa-solid fa-filter text-gray-400"></i> Filter:
                        </div>
                        <form action="{{ route('admin.informasi-publik.index') }}" method="GET" class="flex items-center gap-3 w-full">
                            <select name="filter_category" class="w-full sm:w-auto rounded-lg border-gray-300 shadow-sm text-sm focus:border-hijau-500 focus:ring-hijau-500">
                                <option value="">Semua Kategori</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ request('filter_category') == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nama }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="px-4 py-2 bg-gray-800 text-white rounded-lg hover:bg-gray-700 text-sm font-semibold transition shrink-0">
                                Terapkan
                            </button>
                            @if(request()->filled('filter_category'))
                                <a href="{{ route('admin.informasi-publik.index') }}" class="text-sm text-red-600 hover:text-red-800 font-medium shrink-0">
                                    Reset Filter
                                </a>
                            @endif
                        </form>
                    </div>

                    <!-- TABEL -->
                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                           <!-- Ganti bagian <thead> ini: -->
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-10">No</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul Utama & Kategori</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Sub-menu</th> <!-- DITAMBAHKAN -->
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($informasiPublik as $item)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4 text-sm text-gray-500 text-center">
                                            {{ $informasiPublik->firstItem() + $loop->index }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-gray-900">{{ $item->judul }}</div>
                                            @if($item->category)
                                                <span class="inline-block mt-1 text-xs font-medium bg-blue-50 text-blue-700 px-2.5 py-0.5 rounded-full">
                                                    {{ $item->category->nama }}
                                                </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <span class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full {{ $item->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                                {{ $item->is_active ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-600 font-medium">
                                            {{ $item->sort_order }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            @if($item->children->count() > 0)
                                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-hijau-100 text-hijau-700 text-sm font-bold">
                                                    {{ $item->children->count() }}
                                                </span>
                                            @else
                                                <span class="text-sm text-gray-400 font-medium">0</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <div class="flex items-center justify-center gap-2 flex-wrap">
                                                
                                                {{-- TOMBOL SUB-MENU (WARNA KUNING/AMBER) --}}
                                                <a href="{{ route('admin.informasi-publik.sub-menu.index', $item) }}" 
                                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-amber-50 text-amber-700 rounded-md text-xs font-semibold hover:bg-amber-100 transition border border-amber-200">
                                                    <i class="fa-solid fa-list-check"></i> Sub-menu
                                                </a>

                                                {{-- TOMBOL EDIT --}}
                                                <a href="{{ route('admin.informasi-publik.edit', $item) }}" 
                                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-indigo-50 text-indigo-700 rounded-md text-xs font-semibold hover:bg-indigo-100 transition border border-indigo-200">
                                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                                </a>

                                                {{-- TOMBOL HAPUS --}}
                                                <form action="{{ route('admin.informasi-publik.destroy', $item) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus judul utama ini?');">
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
                                        <td colspan="5" class="px-6 py-12 text-center text-sm text-gray-500">
                                            <i class="fa-solid fa-inbox text-3xl text-gray-300 mb-3 block"></i>
                                            Tidak ada data informasi publik untuk kategori ini.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $informasiPublik->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>