<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public const COMPANIES = ['pharma', 'meditech'];

    protected $fillable = [
        'name',
        'generic',
        'variant',
        'company',
        'category',
        'manufacturer',
        'description',
    ];

    /**
     * Shape used by the public product explorer's JS (n/g/v/co/cat/mfr/d).
     */
    public function toPublicArray(): array
    {
        return [
            'n' => $this->name,
            'g' => $this->generic,
            'v' => $this->variant,
            'co' => $this->company,
            'cat' => $this->category,
            'mfr' => $this->manufacturer,
            'd' => $this->description,
        ];
    }
}
