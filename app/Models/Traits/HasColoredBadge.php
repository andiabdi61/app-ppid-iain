<?php // app/Models/Traits/HasColoredBadge.php
namespace App\Models\Traits;
use Illuminate\Database\Eloquent\Casts\Attribute;

trait HasColoredBadge
{
    protected function badgeClass(): Attribute
    {
        return Attribute::make(
            get: function () {
                $baseClasses = 'px-2 inline-flex text-xs leading-5 font-semibold rounded-full';
                $color = $this->badgeColor;
                return "{$baseClasses} bg-{$color}-100 text-{$color}-800";
            }
        );
    }

    protected function badgeColor(): Attribute
    {
        return Attribute::make(
            get: function () {
                $categoryName = $this->name ?? $this->nama ?? 'default';
                return getUniqueBadgeColor($categoryName); // Panggil helper baru kita
            }
        );
    }
}