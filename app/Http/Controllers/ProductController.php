<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function show(Product $product): View
    {
        $related = Product::where('category', $product->category)
            ->where('id', '!=', $product->id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('products.show', [
            'product' => $product,
            'related' => $related,
            'metaDescription' => Str::limit($product->description, 155),
        ]);
    }
}
