<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Storage; 
use App\Models\Traits\CleansHtml;
use Laravel\Scout\Searchable;

class InformasiPublik extends Model
{
    use HasFactory, LogsActivity, CleansHtml, Searchable;

    protected $table = 'informasi_publik';

    protected $fillable = [
        'category_id',
        'parent_id',
        'judul',
        'judul_en',
        'judul_ar',
        'slug',
        'konten',
        'konten_en',
        'konten_ar',
        'pejabat',
        'pejabat_en',
        'pejabat_ar',
        'penanggung_jawab',
        'penanggung_jawab_en',
        'penanggung_jawab_ar',
        'tempat',
        'tempat_en',
        'tempat_ar',
        'jangka_waktu',
        'jangka_waktu_en',
        'jangka_waktu_ar',
        'file_path',
        'file_nama',
        'file_tipe',
        'thumbnail',
        'tanggal_publikasi',
        'hits',
        'is_active',
        'sort_order',
        'jenis_tautan',
        'tautan_eksternal',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
        'is_active' => 'boolean',
    ];

    public function toSearchableArray(): array
    {
        return [
            'id' => $this->id,
            'judul' => $this->judul,
            'slug' => $this->slug,
            'konten' => strip_tags($this->konten ?? ''),
            'category_id' => $this->category_id,
            'is_active' => (bool) $this->is_active,
            'tanggal_publikasi' => $this->tanggal_publikasi?->format('Y-m-d'),
        ];
    }
    
    protected $htmlFieldsToClean = [
        'konten',
        'konten_en',
        'konten_ar',
    ];

    // Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(InformasiPublikCategory::class, 'category_id');
    }

    // Relasi ke Parent (Judul Utama)
    public function parent()
    {
        return $this->belongsTo(InformasiPublik::class, 'parent_id');
    }

    // Relasi ke Children (Sub-item a, b, c...)
    public function children()
    {
        return $this->hasMany(InformasiPublik::class, 'parent_id')->orderBy('sort_order');
    }

    protected function thumbnailUrl(): Attribute
    {
        return Attribute::make(
            get: function () {
                if (! file_exists(public_path('storage'))) {
                    return null;
                }

                $thumbnailPath = $this->attributes['thumbnail'] ?? null;
                if ($thumbnailPath && Storage::disk('public')->exists('thumbnails/' . $thumbnailPath)) {
                    return asset('storage/thumbnails/' . $thumbnailPath);
                }
                
                return null;
            }
        );
    }
        
    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly(['judul', 'category_id', 'is_active', 'thumbnail', 'file_path'])
            ->logOnlyDirty()
            ->dontSubmitEmptyLogs()
            ->setDescriptionForEvent(function(string $eventName) {
                $subjectName = $this->judul ?? 'tanpa judul';
                if ($eventName === 'updated') {
                    $changedFields = implode(', ', array_keys($this->getChanges()));
                    return "Item Info Publik \"{$subjectName}\" telah diperbarui (kolom: {$changedFields})";
                }
                return "Item Info Publik \"{$subjectName}\" telah di-{$eventName}";
            });
    }

    // ======================== LOCALE-AWARE ACCESSORS ========================

    public function getJudulAttribute($value)
    {
        if (request()->is('admin/*') || request()->is('api/admin/*')) {
            return $value;
        }
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->judul_en)) {
            return $this->judul_en;
        }
        if ($locale === 'ar' && !empty($this->judul_ar)) {
            return $this->judul_ar;
        }
        return $value;
    }

    public function getKontenAttribute($value)
    {
        if (request()->is('admin/*') || request()->is('api/admin/*')) {
            return $value;
        }
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->konten_en)) {
            return $this->konten_en;
        }
        if ($locale === 'ar' && !empty($this->konten_ar)) {
            return $this->konten_ar;
        }
        return $value;
    }

    public function getPejabatAttribute($value)
    {
        if (request()->is('admin/*') || request()->is('api/admin/*')) {
            return $value;
        }
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->pejabat_en)) {
            return $this->pejabat_en;
        }
        if ($locale === 'ar' && !empty($this->pejabat_ar)) {
            return $this->pejabat_ar;
        }
        return $value;
    }

    public function getPenanggungJawabAttribute($value)
    {
        if (request()->is('admin/*') || request()->is('api/admin/*')) {
            return $value;
        }
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->penanggung_jawab_en)) {
            return $this->penanggung_jawab_en;
        }
        if ($locale === 'ar' && !empty($this->penanggung_jawab_ar)) {
            return $this->penanggung_jawab_ar;
        }
        return $value;
    }

    public function getTempatAttribute($value)
    {
        if (request()->is('admin/*') || request()->is('api/admin/*')) {
            return $value;
        }
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->tempat_en)) {
            return $this->tempat_en;
        }
        if ($locale === 'ar' && !empty($this->tempat_ar)) {
            return $this->tempat_ar;
        }
        return $value;
    }

    public function getJangkaWaktuAttribute($value)
    {
        if (request()->is('admin/*') || request()->is('api/admin/*')) {
            return $value;
        }
        $locale = app()->getLocale();
        if ($locale === 'en' && !empty($this->jangka_waktu_en)) {
            return $this->jangka_waktu_en;
        }
        if ($locale === 'ar' && !empty($this->jangka_waktu_ar)) {
            return $this->jangka_waktu_ar;
        }
        return $value;
    }
}