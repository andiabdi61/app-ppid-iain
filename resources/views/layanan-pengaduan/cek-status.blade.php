@extends('layouts.public_app')

@section('title', 'Cek Status Layanan')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-6 md:pt-8 pb-12">
    <div class="max-w-2xl mx-auto">
        
        {{-- ============================================ --}}
        {{-- BREADCRUMB & JUDUL --}}
        {{-- ============================================ --}}
        <nav aria-label="breadcrumb">
            <ol class="flex items-center gap-2 text-sm text-gray-500 mb-4 overflow-hidden whitespace-nowrap">
                <li><a href="{{ url('/') }}" class="hover:text-hijau-700 transition">Beranda</a></li>
                <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                <li><a href="{{ route('layanan-pengaduan.index') }}" class="hover:text-hijau-700 transition">Layanan & Pengaduan</a></li>
                <li><i class="bi bi-chevron-right text-xs text-gray-400"></i></li>
                <li class="text-hijau-800 font-medium">Cek Status Layanan</li>
            </ol>
        </nav>
        
        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-3">Cek Status Layanan</h1>
        <p class="text-gray-600 mb-10">Lacak progres permohonan informasi dan keberatan tanpa perlu masuk ke akun.</p>

        {{-- ============================================ --}}
        {{-- FORM PENCARIAN --}}
        {{-- ============================================ --}}
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8">
            <div class="flex items-start gap-4 mb-6">
                <div class="w-12 h-12 bg-hijau-100 rounded-xl flex items-center justify-center shrink-0">
                    <i class="bi bi-search text-xl text-hijau-700"></i>
                </div>
                <div>
                    <h2 class="text-lg font-bold text-gray-800">Lacak Status</h2>
                    <p class="text-sm text-gray-500 mt-1">Masukkan nomor registrasi dan email yang digunakan saat mengajukan.</p>
                </div>
            </div>

            <form action="{{ route('layanan-pengaduan.cek-status.process') }}" method="POST" class="space-y-5">
                @csrf

                <div>
                    <label for="nomor_registrasi" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nomor Registrasi <span class="text-red-500">*</span>
                    </label>
                    <input type="text"
                           class="w-full px-4 py-2.5 rounded-lg border @error('nomor_registrasi') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-hijau-500 focus:border-hijau-500 @enderror text-sm outline-none transition font-mono"
                           id="nomor_registrasi" name="nomor_registrasi"
                           value="{{ $nomorRegistrasi }}" placeholder="Contoh: 20250814001" maxlength="255" required>
                    @error('nomor_registrasi') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1.5">
                        Email Pemohon <span class="text-red-500">*</span>
                    </label>
                    <input type="email"
                           class="w-full px-4 py-2.5 rounded-lg border @error('email') border-red-500 focus:ring-red-500 focus:border-red-500 @else border-gray-300 focus:ring-hijau-500 focus:border-hijau-500 @enderror text-sm outline-none transition"
                           id="email" name="email"
                           value="{{ $email }}" placeholder="nama@email.com" maxlength="255" required autocomplete="email">
                    @error('email') <p class="text-red-600 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                @if($errorMessage)
                    <div class="flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl p-4 text-sm">
                        <i class="bi bi-exclamation-circle-fill mt-0.5"></i>
                        <span>{{ $errorMessage }}</span>
                    </div>
                @endif

                <button type="submit" class="w-full py-3 bg-hijau-600 text-white font-semibold rounded-xl hover:bg-hijau-700 transition-colors shadow-md shadow-hijau-600/20 flex items-center justify-center gap-2">
                    <i class="bi bi-search"></i>
                    Cek Status
                </button>
            </form>
        </div>

        {{-- ============================================ --}}
        {{-- HASIL PENCARIAN --}}
        {{-- ============================================ --}}
        @if($found && $permohonan)
            @php
                $statusClass = match ($permohonan->status) {
                    'Diterima', 'Selesai' => 'bg-green-100 text-green-800',
                    'Ditolak' => 'bg-red-100 text-red-800',
                    'Diproses' => 'bg-blue-100 text-blue-800',
                    default => 'bg-yellow-100 text-yellow-800',
                };
            @endphp

            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 md:p-8 mt-6">
                <div class="flex items-center justify-between gap-4 pb-5 border-b border-gray-100">
                    <div>
                        <p class="text-xs uppercase tracking-wide text-gray-400 font-semibold">Permohonan Informasi</p>
                        <p class="text-lg font-bold text-gray-800 font-mono mt-1">{{ $permohonan->nomor_registrasi }}</p>
                    </div>
                    <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-semibold {{ $statusClass }}">
                        {{ $permohonan->status }}
                    </span>
                </div>

                <dl class="grid grid-cols-1 gap-4 pt-5 text-sm">
                    <div>
                        <dt class="text-gray-500">Tanggal Permohonan</dt>
                        <dd class="font-medium text-gray-800 mt-1">{{ $permohonan->tanggal_permohonan?->translatedFormat('d F Y') }}</dd>
                    </div>
                </dl>

                @if($permohonan->status === 'Ditolak')
                    <div class="mt-6 rounded-xl border border-red-200 bg-red-50 p-5">
                        <div class="flex items-start gap-3">
                            <div class="w-10 h-10 rounded-lg bg-red-100 text-red-600 flex items-center justify-center shrink-0">
                                <i class="bi bi-shield-exclamation text-lg"></i>
                            </div>
                            <div>
                                <h3 class="text-sm font-bold text-red-800">Permohonan Ditolak</h3>
                                <p class="text-sm text-red-700 mt-1">
                                    Jika Anda tidak setuju dengan keputusan ini, Anda dapat mengajukan keberatan.
                                </p>
                                <a href="{{ route('informasi-publik.keberatan.form', ['no_reg' => $permohonan->nomor_registrasi]) }}"
                                   class="mt-4 inline-flex items-center justify-center gap-2 rounded-lg bg-red-600 px-4 py-2.5 text-sm font-semibold text-white transition-colors hover:bg-red-700">
                                    <i class="bi bi-pencil-square"></i>
                                    Ajukan Keberatan
                                </a>
                            </div>
                        </div>
                    </div>
                @endif

                @if($keberatan->isNotEmpty())
                    <div class="mt-6 pt-5 border-t border-gray-100">
                        <h3 class="text-sm font-bold text-gray-800 mb-3">Riwayat Keberatan</h3>
                        <div class="space-y-3">
                            @foreach($keberatan as $item)
                                @php
                                    $keberatanStatusClass = match ($item->status) {
                                        'Diterima', 'Selesai' => 'bg-green-100 text-green-800',
                                        'Ditolak' => 'bg-red-100 text-red-800',
                                        'Diproses' => 'bg-blue-100 text-blue-800',
                                        default => 'bg-yellow-100 text-yellow-800',
                                    };
                                @endphp
                                <div class="flex items-center justify-between gap-3 rounded-xl border border-gray-100 bg-gray-50 px-4 py-3">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">Pengajuan Keberatan</p>
                                        <p class="text-xs text-gray-500 mt-0.5">{{ $item->tanggal_pengajuan?->translatedFormat('d F Y') }}</p>
                                    </div>
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-semibold {{ $keberatanStatusClass }}">
                                        {{ $item->status }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <p class="text-xs text-gray-400 mt-6">
                    <i class="bi bi-info-circle me-1"></i>
                    Untuk informasi lebih rinci, silakan hubungi petugas PPID.
                </p>
            </div>
        @endif

        {{-- ============================================ --}}
        {{-- TOMBOL NAVIGASI BAWAH --}}
        {{-- ============================================ --}}
        <div class="flex flex-col sm:flex-row gap-4 justify-center mt-10">
            <button onclick="history.back()" class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-800 rounded-lg font-semibold transition text-center">
                <i class="bi bi-arrow-left me-2"></i> Kembali
            </button>
            <a href="{{ url('/') }}" class="px-6 py-3 bg-hijau-600 hover:bg-hijau-700 text-white rounded-lg font-semibold transition text-center">
                Kembali ke Beranda
            </a>
        </div>

    </div>
</div>

@endsection