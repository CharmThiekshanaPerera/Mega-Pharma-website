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
        'image_path',
        'details',
    ];

    protected $casts = [
        'details' => 'array',
    ];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getCompanyLabelAttribute(): string
    {
        return $this->company === 'pharma' ? 'Mega Pharma' : 'Mega Meditech';
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image_path ? asset($this->image_path) : null;
    }

    /**
     * The two-stop gradient used behind the product page's WebGL world.
     * Defaults to the house colour (pharma red / meditech navy) so every
     * page at least matches its own brand; a specific product can override
     * with its real brand colour via details.theme = ["#paper","#accent"].
     */
    public function getThemeColorsAttribute(): array
    {
        $theme = $this->details['theme'] ?? null;

        if (is_array($theme) && count($theme) === 2) {
            return array_values($theme);
        }

        return $this->company === 'pharma'
            ? ['#f6e9e4', '#b5121b']
            : ['#eef2f8', '#1d3e7e'];
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
            'img' => $this->imageUrl,
        ];
    }
}
