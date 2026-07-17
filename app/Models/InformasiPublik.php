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
        'parent_id',        // ← DITAMBAHKAN
        'judul',
        'slug',
        'konten',
        'pejabat',           // ← DITAMBAHKAN
        'penanggung_jawab',  // ← DITAMBAHKAN
        'tempat',            // ← DITAMBAHKAN
        'jangka_waktu',      // ← DITAMBAHKAN
        'file_path',
        'file_nama',
        'file_tipe',
        'thumbnail',
        'tanggal_publikasi',
        'hits',
        'is_active',
        'sort_order',       // ← DITAMBAHKAN
        'jenis_tautan',     // ← DITAMBAHKAN (file / url)
        'tautan_eksternal', // ← DITAMBAHKAN
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
    ];

    // Relasi ke Kategori
    public function category()
    {
        return $this->belongsTo(InformasiPublikCategory::class, 'category_id');
    }

    // ← DITAMBAHKAN: Relasi ke Parent (Judul Utama)
    public function parent()
    {
        return $this->belongsTo(InformasiPublik::class, 'parent_id');
    }

    // ← DITAMBAHKAN: Relasi ke Children (Sub-item a, b, c...)
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
}