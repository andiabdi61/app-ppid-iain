<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengajuanKeberatanRequest;
use App\Http\Requests\StorePermohonanInformasiRequest;
use App\Models\PengajuanKeberatan;
use App\Models\PermohonanInformasi;
use App\Models\SopLayanan;

class LayananInformasiController extends Controller
{
    // --- Permohonan Informasi ---

    public function showSop()
    {
        $sopList = SopLayanan::orderBy('judul')->get();

        return view('informasi-publik.sop', compact('sopList'));
    }

    public function showSopDetail(SopLayanan $sopLayanan)
    {
        return view('informasi-publik.sop-detail', ['sop' => $sopLayanan]);
    }

    public function showTataCaraLayanan()
    {
        return view('informasi-publik.tata-cara-layanan');
    }

    public function showFormPermohonan()
    {
        return view('informasi-publik.form-permohonan');
    }

    public function storePermohonan(StorePermohonanInformasiRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();

        $identitasPath = null;
        if ($request->hasFile('identitas_pemohon')) {
            $identitasPath = $request->file('identitas_pemohon')->store('identitas_pemohon', 'public');
        }

        $permohonan = PermohonanInformasi::create([
            'user_id' => $user?->id,
            'nama_pemohon' => $user?->name ?? $validated['nama_pemohon'] ?? null,
            'email_pemohon' => $user?->email ?? $validated['email_pemohon'] ?? null,
            'telp_pemohon' => $user?->telp ?? $validated['telp_pemohon'] ?? null,
            'alamat_pemohon' => $user?->alamat ?? $validated['alamat_pemohon'] ?? null,
            'jenis_pemohon' => $validated['jenis_pemohon'],
            'pekerjaan_pemohon' => $validated['pekerjaan_pemohon'] ?? null,
            'identitas_pemohon' => $identitasPath,
            'rincian_informasi' => $validated['rincian_informasi'],
            'tujuan_penggunaan_informasi' => $validated['tujuan_penggunaan_informasi'] ?? null,
            'cara_mendapatkan_informasi' => $validated['cara_mendapatkan_informasi'],
            'cara_mendapatkan_salinan' => $validated['cara_mendapatkan_salinan'] ?? null,
            'tanggal_permohonan' => now(),
            'status' => 'Menunggu Diproses',
        ]);

        activity()
            ->causedBy($user)
            ->performedOn($permohonan)
            ->log('Mengajukan permohonan informasi baru');

        return redirect()->route('informasi-publik.permohonan.sukses')->with('nomor_registrasi', $permohonan->nomor_registrasi);
    }

    public function showPermohonanSukses()
    {
        return view('informasi-publik.permohonan-sukses');
    }

    // --- Pengajuan Keberatan ---

    public function showFormKeberatan()
    {
        return view('informasi-publik.form-keberatan');
    }

    public function storeKeberatan(StorePengajuanKeberatanRequest $request)
    {
        $validated = $request->validated();
        $user = $request->user();

        $keberatan = PengajuanKeberatan::create([
            'user_id' => $user?->id,
            'nomor_registrasi_permohonan' => $validated['nomor_registrasi_permohonan'],
            'alasan_keberatan' => $validated['alasan_keberatan'],
            'jenis_keberatan' => $validated['jenis_keberatan'],
            'kasus_posisi' => $validated['kasus_posisi'] ?? null,
            'tanggal_pengajuan' => now(),
            'status' => 'Menunggu Diproses',
        ]);

        activity()
            ->causedBy($user)
            ->performedOn($keberatan)
            ->log('Mengajukan keberatan informasi');

        return redirect()->route('informasi-publik.keberatan.sukses')
            ->with('nomor_registrasi_permohonan', $keberatan->nomor_registrasi_permohonan);
    }

    public function showKeberatanSukses()
    {
        return view('informasi-publik.keberatan-sukses');
    }
}
