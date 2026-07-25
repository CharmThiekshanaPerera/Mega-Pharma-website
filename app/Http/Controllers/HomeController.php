<?php

namespace App\Http\Controllers;

use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('company')
            ->orderBy('category')
            ->orderBy('name')
            ->get()
            ->map(fn (Product $product) => $product->toPublicArray())
            ->values();

        return view('home', [
            'products' => $products,
        ]);
    }
}
