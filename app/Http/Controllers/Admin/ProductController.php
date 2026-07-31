<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $products = Product::query()
            ->when($request->string('q')->trim()->toString(), function ($query, $q) {
                $query->where(function ($query) use ($q) {
                    $query->where('name', 'like', "%{$q}%")
                        ->orWhere('generic', 'like', "%{$q}%")
                        ->orWhere('manufacturer', 'like', "%{$q}%");
                });
            })
            ->when($request->string('company')->trim()->toString(), fn ($query, $company) => $query->where('company', $company))
            ->orderBy('company')
            ->orderBy('category')
            ->orderBy('name')
            ->paginate(20)
            ->withQueryString();

        return view('admin.products.index', [
            'products' => $products,
            'filters' => $request->only(['q', 'company']),
        ]);
    }

    public function create(): View
    {
        return view('admin.products.create', [
            'product' => new Product,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $data['slug'] = Product::uniqueSlug($data['name']);

        Product::create($data);

        return Redirect::route('admin.products.index')->with('status', 'Product created.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.edit', [
            'product' => $product,
        ]);
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $product->update($this->validated($request));

        return Redirect::route('admin.products.index')->with('status', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return Redirect::route('admin.products.index')->with('status', 'Product deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'generic' => ['required', 'string', 'max:255'],
            'variant' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'in:'.implode(',', Product::COMPANIES)],
            'category' => ['required', 'string', 'max:100'],
            'manufacturer' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:5000'],
        ]);
    }
}
