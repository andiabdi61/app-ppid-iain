<?php

namespace App\Http\Requests\Admin;

use App\Models\SopLayanan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SopLayananRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $fileRule = $this->isMethod('POST') ? 'required' : 'nullable';

        return [
            'judul' => ['required', 'string', 'max:255'],
            'tanggal_pembuatan' => ['required', 'date'],
            'tanggal_efektif' => ['required', 'date', 'after_or_equal:tanggal_pembuatan'],
            'penandatangan' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in([SopLayanan::STATUS_AKTIF, SopLayanan::STATUS_TIDAK_BERLAKU])],
            'file_sop' => [$fileRule, 'file', 'mimes:pdf', 'max:10240'],
        ];
    }

    public function attributes(): array
    {
        return [
            'tanggal_pembuatan' => 'tanggal pembuatan',
            'tanggal_efektif' => 'tanggal efektif',
            'file_sop' => 'file SOP',
        ];
    }
}
