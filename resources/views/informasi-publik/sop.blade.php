@extends('layouts.public_app')

@section('title', 'SOP Layanan')

@section('content')

{{-- Hero Section --}}
<x-page-hero 
    title="SOP Layanan" 
    icon="doc"
    :breadcrumbs="[
        ['label' => 'Beranda', 'url' => url('/')],
        ['label' => 'Layanan']
    ]"
/>

@php
    $items = $sopList->map(fn ($sop) => ['id' => $sop->id, 'judul' => $sop->judul, 'status' => $sop->status])->values();
@endphp

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12"
     x-data="{
        q: '',
        status: 'all',
        items: @js($items),
        get shown() {
            const q = this.q.toLowerCase();
            return this.items
                .filter(i => (this.status === 'all' || i.status === this.status) && i.judul.toLowerCase().includes(q))
                .map(i => i.id);
        }
     }">

    {{-- Header: judul, jumlah, pencarian & filter --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-5">
        <div class="flex items-center gap-3">
            <h2 class="text-xl font-bold text-gray-800">Daftar SOP</h2>
            <span class="px-3 py-1.5 text-xs font-semibold text-gray-700 bg-white border border-gray-200 rounded-lg" x-text="shown.length + ' SOP'"></span>
        </div>

        <div class="flex flex-col sm:flex-row gap-3">
            <div class="relative">
                <i class="bi bi-search absolute left-3.5 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                <input type="text" x-model="q" placeholder="Cari SOP..."
                       class="w-full sm:w-56 pl-10 pr-4 py-2.5 text-sm bg-white border border-gray-200 rounded-xl focus:ring-2 focus:ring-hijau-500 focus:border-hijau-500 outline-none">
            </div>
            <div class="relative" x-data="{ open: false, labels: { all: 'Semua Status', aktif: 'Aktif', tidak_berlaku: 'Tidak Berlaku' } }" @click.away="open = false">
                <button type="button" @click="open = !open"
                        class="w-full sm:w-auto flex items-center justify-between gap-3 px-4 py-2.5 text-sm bg-white border border-gray-200 rounded-xl text-gray-700 hover:border-hijau-300 transition">
                    <span class="flex items-center gap-2"><i class="bi bi-funnel text-gray-400"></i> <span x-text="labels[status]"></span></span>
                    <svg class="w-4 h-4 transition-transform duration-200" :class="{ 'rotate-180': open }" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div x-show="open" x-cloak
                     x-transition:enter="transition ease-out duration-200"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-150"
                     x-transition:leave-start="opacity-100 scale-100"
                     x-transition:leave-end="opacity-0 scale-95"
                     class="absolute right-0 top-full mt-1 w-56 bg-white rounded-xl shadow-lg border border-gray-100 py-2 z-30">
                    <button type="button" @click="status = 'all'; open = false"
                            :class="status === 'all' ? 'text-hijau-700 bg-hijau-50' : 'text-gray-700'"
                            class="block w-full text-left px-3 py-2 mx-0 text-sm hover:bg-hijau-50 hover:text-hijau-700 transition">Semua Status</button>
                    <div class="my-1 border-t border-gray-200"></div>
                    <button type="button" @click="status = 'aktif'; open = false"
                            :class="status === 'aktif' ? 'text-hijau-700 bg-hijau-50' : 'text-gray-700'"
                            class="block w-full text-left px-3 py-2 text-sm hover:bg-hijau-50 hover:text-hijau-700 transition">Aktif</button>
                    <button type="button" @click="status = 'tidak_berlaku'; open = false"
                            :class="status === 'tidak_berlaku' ? 'text-hijau-700 bg-hijau-50' : 'text-gray-700'"
                            class="block w-full text-left px-3 py-2 text-sm hover:bg-hijau-50 hover:text-hijau-700 transition">Tidak Berlaku</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Tabel --}}
    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full">
                <thead>
                    <tr class="border-b border-gray-200 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                        <th class="px-6 py-4">Nama SOP</th>
                        <th class="hidden md:table-cell px-6 py-4 whitespace-nowrap">Tanggal Efektif</th>
                        <th class="hidden md:table-cell px-6 py-4">Penandatangan</th>
                        <th class="hidden md:table-cell px-6 py-4">Status</th>
                        <th class="px-6 py-4 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @foreach($sopList as $sop)
                        <tr x-show="shown.includes({{ $sop->id }})" class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm font-semibold text-gray-800 min-w-[220px]">
                                <a href="{{ route('informasi-publik.sop.show', $sop) }}" class="hover:text-hijau-700 transition-colors">{{ $sop->judul }}</a>
                            </td>
                            <td class="hidden md:table-cell px-6 py-4 text-sm text-gray-600 whitespace-nowrap">{{ $sop->tanggal_efektif->translatedFormat('d F Y') }}</td>
                            <td class="hidden md:table-cell px-6 py-4 text-sm text-gray-600">{{ $sop->penandatangan }}</td>
                            <td class="hidden md:table-cell px-6 py-4">
                                <span class="inline-block px-3 py-1 text-xs font-medium rounded-md border whitespace-nowrap {{ $sop->isAktif() ? 'bg-green-50 text-green-700 border-green-200' : 'bg-gray-50 text-gray-500 border-gray-200' }}">
                                    {{ $sop->isAktif() ? 'Aktif' : 'Tidak Berlaku' }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('informasi-publik.sop.show', $sop) }}" title="Lihat Detail"
                                       class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-hijau-50 hover:text-hijau-700 hover:border-hijau-200 transition">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ $sop->file_url }}" download="{{ $sop->file_nama }}" title="Unduh"
                                       class="w-9 h-9 flex items-center justify-center rounded-lg border border-gray-200 text-gray-500 hover:bg-hijau-50 hover:text-hijau-700 hover:border-hijau-200 transition">
                                        <i class="bi bi-download"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <p x-show="shown.length === 0" x-cloak class="px-6 py-10 text-center text-sm text-gray-500">
            {{ $sopList->isEmpty() ? 'Belum ada SOP Layanan yang dipublikasikan.' : 'Tidak ada SOP yang cocok dengan pencarian.' }}
        </p>
    </div>

</div>
@endsection
