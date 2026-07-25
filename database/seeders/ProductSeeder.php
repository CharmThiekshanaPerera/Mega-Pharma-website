<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

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

        $rows = array_map(fn (array $p) => [
            'name' => $p['n'],
            'generic' => $p['g'],
            'variant' => $p['v'],
            'company' => $p['co'],
            'category' => $p['cat'],
            'manufacturer' => $p['mfr'],
            'description' => $p['d'],
            'created_at' => $now,
            'updated_at' => $now,
        ], $items);

        Product::truncate();

        foreach (array_chunk($rows, 50) as $chunk) {
            Product::insert($chunk);
        }
    }
}
