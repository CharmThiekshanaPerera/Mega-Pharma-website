<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    public const COMPANIES = ['pharma', 'meditech'];

    protected $fillable = [
        'name',
        'slug',
        'generic',
        'variant',
        'company',
        'category',
        'manufacturer',
        'description',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getCompanyLabelAttribute(): string
    {
        return $this->company === 'pharma' ? 'Mega Pharma' : 'Mega Meditech';
    }

    /**
     * Slugify $name, disambiguating with a numeric suffix against any
     * existing product slugs (so "Aclin Gel" -> "aclin-gel", "aclin-gel-2"…).
     */
    public static function uniqueSlug(string $name): string
    {
        $base = Str::slug($name) ?: 'product';
        $slug = $base;
        $suffix = 2;

        while (static::where('slug', $slug)->exists()) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }

    /**
     * Shape used by the public product explorer's JS (n/g/v/co/cat/mfr/d).
     */
    public function toPublicArray(): array
    {
        return [
            'n' => $this->name,
            'slug' => $this->slug,
            'g' => $this->generic,
            'v' => $this->variant,
            'co' => $this->company,
            'cat' => $this->category,
            'mfr' => $this->manufacturer,
            'd' => $this->description,
        ];
    }
}
