<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = database_path('seeders/data/products.json');
        $items = json_decode(file_get_contents($path), true, flags: JSON_THROW_ON_ERROR);

        $now = Carbon::now();
        $usedSlugs = [];

        $rows = array_map(function (array $p) use ($now, &$usedSlugs) {
            $base = Str::slug($p['n']) ?: 'product';
            $slug = $base;
            $suffix = 2;

            while (in_array($slug, $usedSlugs, true)) {
                $slug = $base.'-'.$suffix++;
            }

            $usedSlugs[] = $slug;

            return [
                'name' => $p['n'],
                'slug' => $slug,
                'generic' => $p['g'],
                'variant' => $p['v'],
                'company' => $p['co'],
                'category' => $p['cat'],
                'manufacturer' => $p['mfr'],
                'description' => $p['d'],
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }, $items);

        Product::truncate();

        foreach (array_chunk($rows, 50) as $chunk) {
            Product::insert($chunk);
        }
    }
}
