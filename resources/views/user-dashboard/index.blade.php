@extends('layouts.public_app')

@section('title', 'Dasbor Saya')

@section('content')
<div class="bg-gray-50 min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- ============================================ --}}
        {{-- HEADER DASBOR --}}
        {{-- ============================================ --}}
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-8">
            <div>
                <h2 class="text-2xl font-bold text-gray-900">Dasbor Saya</h2>
                <p class="text-sm text-gray-500 mt-1">Selamat Datang Kembali, {{ $user->name }}!</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('informasi-publik.permohonan.form') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium bg-hijau-600 text-white hover:bg-hijau-700 transition-colors shadow-sm">
                    <i class="bi bi-file-earmark-plus-fill"></i> Ajukan Permohonan
                </a>
                <a href="{{ route('profile.edit.public') }}" 
                   class="inline-flex items-center gap-2 px-5 py-2.5 rounded-xl text-sm font-medium bg-white text-gray-700 border border-gray-300 hover:bg-gray-50 transition-colors">
                    <i class="bi bi-person-fill-gear"></i> Pengaturan Akun
                </a>
            </div>
        </div>

        {{-- ============================================ --}}
        {{-- RIWAYAT PERMOHONAN INFORMASI --}}
        {{-- ============================================ --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden mb-6">
            
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-gray-100">
                <h5 class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                    <i class="bi bi-journal-text text-blue-600"></i>
                    Riwayat Permohonan Informasi Anda
                </h5>
            </div>
            
            {{-- TAMPILAN MOBILE (Card Layout) --}}
            <div class="md:hidden divide-y divide-gray-100">
                @forelse($permohonan as $item)
                <div class="p-4 space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <span class="font-bold font-mono text-xs text-gray-900">{{ $item->nomor_registrasi }}</span>
                        @if($item->status == 'Diterima' || $item->status == 'Selesai')
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 shrink-0">{{ $item->status }}</span>
                        @elseif($item->status == 'Ditolak')
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700 shrink-0">{{ $item->status }}</span>
                        @elseif($item->status == 'Diproses')
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700 shrink-0">{{ $item->status }}</span>
                        @else
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700 shrink-0">{{ $item->status }}</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $item->rincian_informasi }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400">{{ $item->tanggal_permohonan->format('d M Y') }}</span>
                        <a href="{{ route('user-dashboard.permohonan.show', $item) }}" 
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-blue-600 border border-blue-200 rounded-lg hover:bg-blue-50 transition-colors">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </div>
                </div>
                @empty
                    <div class="px-6 py-12 text-center text-gray-400">
                        <i class="bi bi-inbox text-3xl block mb-2"></i>
                        Anda belum pernah mengajukan permohonan informasi.
                    </div>
                @endforelse
            </div>

            {{-- TAMPILAN DESKTOP (Tabel) --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                            <th class="px-6 py-3 font-semibold">No. Registrasi</th>
                            <th class="px-6 py-3 font-semibold">Rincian Informasi</th>
                            <th class="px-6 py-3 font-semibold text-center">Tanggal</th>
                            <th class="px-6 py-3 font-semibold text-center">Status</th>
                            <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($permohonan as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold font-mono text-xs text-gray-900">{{ $item->nomor_registrasi }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ Str::limit($item->rincian_informasi, 60) }}</td>
                            <td class="px-6 py-4 text-center text-gray-400 text-xs">{{ $item->tanggal_permohonan->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($item->status == 'Diterima' || $item->status == 'Selesai')
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">{{ $item->status }}</span>
                                @elseif($item->status == 'Ditolak')
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">{{ $item->status }}</span>
                                @elseif($item->status == 'Diproses')
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">{{ $item->status }}</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('user-dashboard.permohonan.show', $item) }}" 
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-blue-600 border border-blue-200 rounded-lg hover:bg-blue-50 transition-colors">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <i class="bi bi-inbox text-3xl block mb-2"></i>
                                Anda belum pernah mengajukan permohonan informasi.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-gray-100">
                <div class="flex justify-center">
                    {{ $permohonan->links() }}
                </div>
            </div>
        </div>

        {{-- ============================================ --}}
        {{-- RIWAYAT PENGAJUAN KEBERATAN --}}
        {{-- ============================================ --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            
            {{-- Header --}}
            <div class="px-6 py-4 border-b border-gray-100">
                <h5 class="text-sm font-semibold text-gray-900 flex items-center gap-2">
                    <i class="bi bi-shield-exclamation text-red-500"></i>
                    Riwayat Pengajuan Keberatan Anda
                </h5>
            </div>
            
            {{-- TAMPILAN MOBILE (Card Layout) --}}
            <div class="md:hidden divide-y divide-gray-100">
                @forelse($keberatan as $item)
                <div class="p-4 space-y-3">
                    <div class="flex items-start justify-between gap-2">
                        <span class="font-bold font-mono text-xs text-gray-900">{{ $item->nomor_registrasi_permohonan }}</span>
                        @if($item->status == 'Diterima' || $item->status == 'Selesai')
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700 shrink-0">{{ $item->status }}</span>
                        @elseif($item->status == 'Ditolak')
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700 shrink-0">{{ $item->status }}</span>
                        @elseif($item->status == 'Diproses')
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700 shrink-0">{{ $item->status }}</span>
                        @else
                            <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700 shrink-0">{{ $item->status }}</span>
                        @endif
                    </div>
                    <p class="text-sm text-gray-600 leading-relaxed">{{ $item->alasan_keberatan }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-xs text-gray-400">{{ $item->tanggal_pengajuan->format('d M Y') }}</span>
                        <a href="{{ route('user-dashboard.keberatan.show', $item) }}" 
                           class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-blue-600 border border-blue-200 rounded-lg hover:bg-blue-50 transition-colors">
                            <i class="bi bi-eye"></i> Detail
                        </a>
                    </div>
                </div>
                @empty
                    <div class="px-6 py-12 text-center text-gray-400">
                        <i class="bi bi-inbox text-3xl block mb-2"></i>
                        Anda belum pernah mengajukan keberatan.
                    </div>
                @endforelse
            </div>

            {{-- TAMPILAN DESKTOP (Tabel) --}}
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-sm text-left">
                    <thead>
                        <tr class="bg-gray-50 text-gray-500 uppercase text-xs tracking-wider">
                            <th class="px-6 py-3 font-semibold">No. Reg Permohonan</th>
                            <th class="px-6 py-3 font-semibold">Alasan Keberatan</th>
                            <th class="px-6 py-3 font-semibold text-center">Tanggal</th>
                            <th class="px-6 py-3 font-semibold text-center">Status</th>
                            <th class="px-6 py-3 font-semibold text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($keberatan as $item)
                        <tr class="hover:bg-gray-50/50 transition-colors">
                            <td class="px-6 py-4">
                                <span class="font-bold font-mono text-xs text-gray-900">{{ $item->nomor_registrasi_permohonan }}</span>
                            </td>
                            <td class="px-6 py-4 text-gray-600">{{ Str::limit($item->alasan_keberatan, 60) }}</td>
                            <td class="px-6 py-4 text-center text-gray-400 text-xs">{{ $item->tanggal_pengajuan->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-center">
                                @if($item->status == 'Diterima' || $item->status == 'Selesai')
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-green-100 text-green-700">{{ $item->status }}</span>
                                @elseif($item->status == 'Ditolak')
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-red-100 text-red-700">{{ $item->status }}</span>
                                @elseif($item->status == 'Diproses')
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-700">{{ $item->status }}</span>
                                @else
                                    <span class="px-2.5 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-700">{{ $item->status }}</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-right">
                                <a href="{{ route('user-dashboard.keberatan.show', $item) }}" 
                                   class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs font-medium text-blue-600 border border-blue-200 rounded-lg hover:bg-blue-50 transition-colors">
                                    <i class="bi bi-eye"></i> Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center text-gray-400">
                                <i class="bi bi-inbox text-3xl block mb-2"></i>
                                Anda belum pernah mengajukan keberatan.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            {{-- Pagination --}}
            <div class="px-6 py-4 border-t border-gray-100">
                <div class="flex justify-center">
                    {{ $keberatan->links() }}
                </div>
            </div>
        </div>

    </div>
</div>
@endsection