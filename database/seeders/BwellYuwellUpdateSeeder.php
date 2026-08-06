<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * One-off content update: real copy + real photos for the Yuwell Anytime CT3
 * and B.Well ranges, sourced from docs/. Upserts by name so it only ever
 * touches these ~15 rows — the rest of the 129-product catalog (and any
 * manual admin edits made to it) is left untouched. Safe to re-run.
 */
class BwellYuwellUpdateSeeder extends Seeder
{
    private const TOUCHED_NAMES = [
        'Yuwell CT302 CGM Sensor',
        'Yuwell CT-300D Transmitter',
        'B.Well PRO-33',
        'B.Well PRO-35',
        'B.Well MED-55 (G.IV)',
        'B.Well TH-75',
        'B.Well MED-62',
        'B.Well MED-63',
        'B.Well PRO-04 Thermometer',
        'B.Well WT-04 Thermometer',
        'B.Well NEB Basic PRO-110',
        'B.Well NEB Smart MED-120',
        'B.Well NEB Junior PRO-115',
        'B.Well MED-420 Cushion Massager',
        'B.Well MED-440 Neck Massager',
    ];

    /**
     * Combined rows replaced by the per-model splits above.
     */
    private const RETIRED_NAMES = [
        'B.Well PRO-33 / PRO-35',
        'B.Well MED-62 / MED-63',
    ];

    public function run(): void
    {
        $path = database_path('seeders/data/products.json');
        $items = json_decode(file_get_contents($path), true, flags: JSON_THROW_ON_ERROR);

        $byName = collect($items)->keyBy('n');

        foreach (self::TOUCHED_NAMES as $name) {
            $p = $byName->get($name);

            if (! $p) {
                continue;
            }

            $product = Product::firstOrNew(['name' => $p['n']]);
            $product->fill([
                'generic' => $p['g'],
                'variant' => $p['v'],
                'company' => $p['co'],
                'category' => $p['cat'],
                'manufacturer' => $p['mfr'],
                'description' => $p['d'],
                'image_path' => $p['img'] ?? null,
            ]);

            if (! $product->exists) {
                $product->slug = Product::uniqueSlug($p['n']);
            }

            $product->save();
        }

        Product::whereIn('name', self::RETIRED_NAMES)->delete();
    }
}
