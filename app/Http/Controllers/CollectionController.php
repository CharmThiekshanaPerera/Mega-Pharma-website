<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\View\View;

class CollectionController extends Controller
{
    /** All 15 collections at a glance, grouped by house, with live product counts. */
    public function index(): View
    {
        $counts = Product::query()->selectRaw('category, count(*) as n')->groupBy('category')->pluck('n', 'category');

        $collections = collect(config('collections'))
            ->map(fn (array $c, string $slug) => $c + ['slug' => $slug, 'count' => (int) ($counts[$c['name']] ?? 0)])
            ->groupBy('company');

        return view('collections.index', [
            'collections' => $collections,
            'total' => $counts->sum(),
            'themeColors' => ['#f6e9e4', '#8c0e15'],
        ]);
    }

    public function show(string $slug): View
    {
        $all = config('collections');
        abort_unless(isset($all[$slug]), 404);

        $collection = $all[$slug] + ['slug' => $slug];

        $products = Product::where('category', $collection['name'])->orderBy('manufacturer')->orderBy('name')->get();

        // Other collections in the same house, for cross-navigation.
        $siblings = collect($all)
            ->filter(fn (array $c, string $s) => $c['company'] === $collection['company'] && $s !== $slug)
            ->map(fn (array $c, string $s) => $c + ['slug' => $s]);

        return view('collections.show', [
            'collection' => $collection,
            'products' => $products,
            'principals' => $products->pluck('manufacturer')->unique()->values(),
            'siblings' => $siblings,
            'houseLabel' => $collection['company'] === 'pharma' ? 'Mega Pharma' : 'Mega Meditech',
            'themeColors' => $collection['company'] === 'pharma' ? ['#f6e9e4', '#b5121b'] : ['#eef2f8', '#1d3e7e'],
        ]);
    }
}
