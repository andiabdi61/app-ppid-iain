<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manajemen Kategori Dokumen') }}
            </h2>
            <a href="{{ route('admin.dokumen-categories.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                <i class="bi bi-plus-lg mr-2"></i> Tambah Kategori Baru
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md" role="alert">
                            <p>{{ session('success') }}</p>
                        </div>
                    @endif
                    @if (session('error'))
                        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded-md" role="alert">
                            <p>{{ session('error') }}</p>
                        </div>
                    @endif

                    <div class="overflow-x-auto border border-gray-200 rounded-lg">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Kategori</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Deskripsi</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Tipe Tampilan</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">URL Halaman Khusus</th>
                                    <th scope="col" class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah Dokumen</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($categories as $category)
                                <tr>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $category->nama }}</div>
                                        <div class="text-sm text-gray-500 font-mono">{{ $category->slug }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <p class="text-sm text-gray-600 max-w-xs truncate" title="{{ $category->deskripsi }}">
                                            {{ $category->deskripsi ?: '-' }}
                                        </p>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-center">
                                        @php
                                            $displayType = $category->display_type ?? 'direct';
                                            $badgeClass = $displayType === 'dedicated' ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800';
                                            $label = $displayType === 'dedicated' ? 'Halaman Khusus' : 'Tampil Langsung';
                                        @endphp
                                        <span class="px-2 py-1 text-xs font-medium rounded-full {{ $badgeClass }}">
                                            {{ $label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                                        @if($category->display_type === 'dedicated')
                                            <div class="flex items-center gap-1">
                                                <input type="text" value="{{ route('publikasi.index', ['kategori' => $category->slug]) }}" 
                                                       class="text-xs text-gray-500 bg-gray-50 px-2 py-1 rounded border w-48 lg:w-64 truncate" 
                                                       id="url-{{ $category->id }}" readonly>
                                                <button onclick="copyUrl('{{ $category->id }}')" 
                                                        class="text-blue-600 hover:text-blue-800 text-sm p-1" title="Salin URL">
                                                    <i class="bi bi-clipboard"></i>
                                                </button>
                                            </div>
                                        @else
                                            <span class="text-xs text-gray-400">—</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">
                                        {{ $category->dokumen_count }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                        <a href="{{ route('admin.dokumen-categories.edit', $category) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit">
                                            <i class="bi bi-pencil-square text-lg"></i>
                                        </a>
                                        <form action="{{ route('admin.dokumen-categories.destroy', $category) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin hapus kategori ini? Ini hanya akan berhasil jika tidak ada dokumen di dalamnya.');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus">
                                                <i class="bi bi-trash3-fill text-lg"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-4 text-center text-sm text-gray-500">
                                        Tidak ada kategori dokumen yang ditemukan.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-4">
                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
function copyUrl(id) {
    var input = document.getElementById('url-' + id);
    input.select();
    input.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(input.value).then(function() {
        var btn = input.nextElementSibling;
        var originalHtml = btn.innerHTML;
        btn.innerHTML = '<i class="bi bi-check-lg text-green-600"></i>';
        setTimeout(function() {
            btn.innerHTML = originalHtml;
        }, 2000);
    });
}
</script>
</x-app-layout>