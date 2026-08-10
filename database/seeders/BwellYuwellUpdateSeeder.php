<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

/**
 * One-off content update: real copy + real photos for the Yuwell Anytime CT3
 * and B.Well ranges already in the catalog, sourced from docs/. Upserts by
 * name so it only ever touches these 11 rows — the rest of the catalog (and
 * any manual admin edits made to it) is left untouched. Does not add any
 * product that wasn't already in the catalog; the 2 combined rows are split
 * into their existing individual models. Safe to re-run.
 */
class BwellYuwellUpdateSeeder extends Seeder
{
    private const TOUCHED_NAMES = [
        'Yuwell CT302 CGM Sensor',
        'Yuwell CT-300D Transmitter',
        'B.Well PRO-33',
        'B.Well PRO-35',
        'B.Well MED-62',
        'B.Well MED-63',
        'B.Well PRO-04 Thermometer',
        'B.Well NEB Basic PRO-110',
        'B.Well NEB Smart MED-120',
        'B.Well MED-420 Cushion Massager',
        'B.Well MED-440 Neck Massager',
    ];

    /**
     * Combined rows replaced by the per-model splits above, plus the 4
     * B.Well models that were briefly added but weren't actually part of
     * the existing catalog — this site only carries its existing range,
     * not every model documented in docs/.
     */
    private const RETIRED_NAMES = [
        'B.Well PRO-33 / PRO-35',
        'B.Well MED-62 / MED-63',
        'B.Well MED-55 (G.IV)',
        'B.Well TH-75',
        'B.Well NEB Junior PRO-115',
        'B.Well WT-04 Thermometer',
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
                'details' => $p['details'] ?? null,
            ]);

            if (! $product->exists) {
                $product->slug = Product::uniqueSlug($p['n']);
            }

            $product->save();
        }

        Product::whereIn('name', self::RETIRED_NAMES)->delete();
    }
}
