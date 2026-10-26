<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePermohonanInformasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $guest = $this->user() === null;

        return [
            'nama_pemohon' => [Rule::requiredIf($guest), 'nullable', 'string', 'max:255'],
            'email_pemohon' => [Rule::requiredIf($guest), 'nullable', 'email', 'max:255'],
            'telp_pemohon' => [Rule::requiredIf($guest), 'nullable', 'string', 'max:30'],
            'alamat_pemohon' => [Rule::requiredIf($guest), 'nullable', 'string', 'max:1000'],
            'pekerjaan_pemohon' => ['nullable', 'string', 'max:255'],
            'identitas_pemohon' => ['nullable', 'file', 'mimes:jpg,jpeg,png,pdf', 'max:2048'],
            'jenis_pemohon' => ['required', 'string', 'in:Perorangan,Badan Hukum,Kelompok Masyarakat'],
            'tujuan_penggunaan_informasi' => ['nullable', 'string'],
            'rincian_informasi' => ['required', 'string'],
            'cara_mendapatkan_informasi' => ['required', 'string', 'in:Melihat,Membaca,Mendengar,Mendapatkan Salinan Softcopy,Mendapatkan Salinan Hardcopy'],
            'cara_mendapatkan_salinan' => ['nullable', 'string', 'in:Mengambil Langsung,Pos,Email,Fax'],
        ];
    }

    public function attributes(): array
    {
        return [
            'nama_pemohon' => 'nama lengkap',
            'email_pemohon' => 'email',
            'telp_pemohon' => 'nomor telepon',
            'alamat_pemohon' => 'alamat',
            'pekerjaan_pemohon' => 'pekerjaan',
            'identitas_pemohon' => 'dokumen identitas',
            'jenis_pemohon' => 'jenis pemohon',
            'tujuan_penggunaan_informasi' => 'tujuan penggunaan informasi',
            'rincian_informasi' => 'rincian informasi',
            'cara_mendapatkan_informasi' => 'cara memperoleh informasi',
            'cara_mendapatkan_salinan' => 'cara mendapatkan salinan',
        ];
    }
}
