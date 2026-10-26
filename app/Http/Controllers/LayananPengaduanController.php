<?php

namespace App\Http\Controllers;

use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use Illuminate\Http\Request;

class LayananPengaduanController extends Controller
{
    // --- Metode-metode Anda yang sudah ada ---
    // Contoh:
    public function index()
    {
        return view('layanan-pengaduan.index');
    }

    public function showPengaduan()
    {
        return view('layanan-pengaduan.pengaduan');
    }

    public function showFaqUmum()
    {
        return view('layanan-pengaduan.faq-umum');
    }

    public function showDaftarLayanan()
    {
        return view('layanan-pengaduan.daftar-layanan');
    }
    // --- Akhir metode-metode Anda yang sudah ada ---

    /**
     * Menampilkan form untuk cek status layanan/pengaduan.
     * Metode ini akan menangani tampilan awal (GET) dan juga setelah validasi (jika ada error).
     *
     * @return \Illuminate\View\View
     */
    public function showCekStatus(Request $request)
    {
        return view('layanan-pengaduan.cek-status', [
            'nomorRegistrasi' => $request->old('nomor_registrasi', $request->query('no_reg', '')),
            'email' => $request->old('email', $request->user()?->email ?? ''),
            'permohonan' => null,
            'keberatan' => collect(),
            'found' => false,
            'errorMessage' => null,
        ]);
    }

    public function processCekStatus(Request $request)
    {
        $request->validate([
            'nomor_registrasi' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ], [
            'nomor_registrasi.required' => 'Nomor Registrasi wajib diisi.',
            'nomor_registrasi.string' => 'Nomor Registrasi harus berupa teks.',
            'nomor_registrasi.max' => 'Nomor Registrasi tidak boleh lebih dari :max karakter.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
        ]);

        $nomorRegistrasi = $request->input('nomor_registrasi');
        $email = trim((string) $request->input('email'));

        $permohonan = PermohonanInformasi::with('user')
            ->where('nomor_registrasi', $nomorRegistrasi)
            ->first();

        $isOwner = $request->user() && $permohonan && $permohonan->user_id === $request->user()->id;
        $emailPemohon = $permohonan?->email_pemohon_display;
        $isEmailMatch = $emailPemohon && strcasecmp(trim($emailPemohon), $email) === 0;

        if (! $permohonan || (! $isOwner && ! $isEmailMatch)) {
            return view('layanan-pengaduan.cek-status', [
                'nomorRegistrasi' => $nomorRegistrasi,
                'email' => $email,
                'permohonan' => null,
                'keberatan' => collect(),
                'found' => false,
                'errorMessage' => 'Data tidak ditemukan atau email tidak sesuai dengan permohonan.',
            ]);
        }

        if ($permohonan->status === 'Ditolak') {
            $request->session()->put('keberatan_email_prefill', $email);
        }

        $keberatan = PengajuanKeberatan::where('nomor_registrasi_permohonan', $nomorRegistrasi)
            ->orderBy('tanggal_pengajuan')
            ->get();

        return view('layanan-pengaduan.cek-status', [
            'nomorRegistrasi' => $nomorRegistrasi,
            'email' => $email,
            'permohonan' => $permohonan,
            'keberatan' => $keberatan,
            'found' => true,
            'errorMessage' => null,
        ]);
    }
}
