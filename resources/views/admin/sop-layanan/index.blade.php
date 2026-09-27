<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Manajemen SOP Layanan') }}</h2>
            <a href="{{ route('admin.sop-layanan.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-700">
                <i class="bi bi-plus-lg mr-2"></i> Tambah SOP
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

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Judul SOP</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Penandatangan</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="relative px-6 py-3"><span class="sr-only">Aksi</span></th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($sopList as $sop)
                                    <tr>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <div class="h-10 w-10 flex items-center justify-center rounded-lg bg-red-100 text-red-600 shrink-0">
                                                    <i class="bi bi-file-earmark-pdf-fill text-2xl"></i>
                                                </div>
                                                <div class="ml-4 text-sm font-medium text-gray-900">{{ $sop->judul }}</div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div>Dibuat: {{ $sop->tanggal_pembuatan->isoFormat('D MMM YYYY') }}</div>
                                            <div>Efektif: {{ $sop->tanggal_efektif->isoFormat('D MMM YYYY') }}</div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500">{{ $sop->penandatangan }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $sop->isAktif() ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $sop->isAktif() ? 'Aktif' : 'Tidak Berlaku' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                            <a href="{{ $sop->file_url }}" target="_blank" class="text-green-600 hover:text-green-900" title="Lihat File"><i class="bi bi-download text-lg"></i></a>
                                            <a href="{{ route('admin.sop-layanan.edit', $sop) }}" class="text-indigo-600 hover:text-indigo-900" title="Edit"><i class="bi bi-pencil-square text-lg"></i></a>
                                            <form action="{{ route('admin.sop-layanan.destroy', $sop) }}" method="POST" class="inline-block" onsubmit="return confirm('Yakin ingin menghapus SOP ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" title="Hapus"><i class="bi bi-trash3-fill text-lg"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Belum ada SOP Layanan.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">{{ $sopList->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
