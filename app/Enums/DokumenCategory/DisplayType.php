<?php

namespace App\Enums\DokumenCategory;

enum DisplayType: string
{
    case Direct = 'direct';
    case Dedicated = 'dedicated';

    public function label(): string
    {
        return match ($this) {
            self::Direct => 'Tampil Langsung',
            self::Dedicated => 'Halaman Khusus',
        };
    }

    public function description(): string
    {
        return match ($this) {
            self::Direct => 'Kategori dan dokumen ditampilkan langsung pada halaman Publikasi',
            self::Dedicated => 'Kategori hanya tampil pada halaman khusus kategori',
        };
    }
}
