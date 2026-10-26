<?php

namespace App\Http\Requests;

use App\Models\PermohonanInformasi;
use Illuminate\Foundation\Http\FormRequest;

class StorePengajuanKeberatanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nomor_registrasi_permohonan' => ['required', 'string', 'max:255'],
            'email_pemohon' => ['required', 'email', 'max:255'],
            'alasan_keberatan' => ['required', 'string'],
            'jenis_keberatan' => ['required', 'string', 'in:Info Ditolak,Info Tidak Disediakan,Info Tidak Ditanggapi,Info Tidak Sesuai,Biaya Tidak Wajar,Info Terlambat'],
            'kasus_posisi' => ['nullable', 'string'],
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($validator->errors()->isNotEmpty()) {
                return;
            }

            $permohonan = PermohonanInformasi::with('user')
                ->where('nomor_registrasi', $this->input('nomor_registrasi_permohonan'))
                ->first();

            if (! $permohonan) {
                $validator->errors()->add('nomor_registrasi_permohonan', 'Nomor registrasi permohonan tidak ditemukan.');

                return;
            }

            $user = $this->user();
            $isOwner = $user && $permohonan->user_id === $user->id;
            $emailPemohon = $permohonan->email_pemohon_display;
            $emailInput = trim((string) $this->input('email_pemohon'));
            $isEmailMatch = $emailPemohon && strcasecmp(trim($emailPemohon), $emailInput) === 0;

            if (! $isOwner && ! $isEmailMatch) {
                $validator->errors()->add('nomor_registrasi_permohonan', 'Nomor registrasi atau email tidak sesuai dengan data permohonan.');
            }
        });
    }

    public function attributes(): array
    {
        return [
            'nomor_registrasi_permohonan' => 'nomor registrasi permohonan',
            'email_pemohon' => 'email',
            'alasan_keberatan' => 'alasan keberatan',
            'jenis_keberatan' => 'jenis keberatan',
            'kasus_posisi' => 'kasus posisi',
        ];
    }
}
