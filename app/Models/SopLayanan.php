<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SopLayanan extends Model
{
    public const STATUS_AKTIF = 'aktif';
    public const STATUS_TIDAK_BERLAKU = 'tidak_berlaku';

    protected $table = 'sop_layanan';

    protected $fillable = [
        'judul',
        'slug',
        'tanggal_pembuatan',
        'tanggal_efektif',
        'penandatangan',
        'file_path',
        'file_nama',
        'status',
    ];

    protected $casts = [
        'tanggal_pembuatan' => 'date',
        'tanggal_efektif' => 'date',
    ];

    protected static function booted(): void
    {
        static::saving(function (self $sop) {
            if ($sop->slug === null || $sop->isDirty('judul')) {
                $sop->slug = $sop->generateUniqueSlug();
            }
        });
    }

    protected function generateUniqueSlug(): string
    {
        $base = Str::slug($this->judul) ?: 'sop';
        $slug = $base;
        $i = 2;

        while (static::where('slug', $slug)->where('id', '!=', $this->id ?? 0)->exists()) {
            $slug = $base . '-' . $i++;
        }

        return $slug;
    }

    public function isAktif(): bool
    {
        return $this->status === self::STATUS_AKTIF;
    }

    public function getFileUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }

    public function getFileSizeKbAttribute(): ?float
    {
        if (! Storage::disk('public')->exists($this->file_path)) {
            return null;
        }

        return round(Storage::disk('public')->size($this->file_path) / 1024, 1);
    }
}
