<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
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

        $this->applyImage($request, new Product, $data);

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
        $data = $this->validated($request);

        $this->applyImage($request, $product, $data);

        $product->update($data);

        return Redirect::route('admin.products.index')->with('status', 'Product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        $this->deleteImageFile($product->image_path);
        $product->delete();

        return Redirect::route('admin.products.index')->with('status', 'Product deleted.');
    }

    /**
     * Validate the form and decode `details` from its raw JSON textarea into
     * the array the model casts it to. `image` and `remove_image` are
     * consumed separately by applyImage() — strip them here so they never
     * reach Product::create()/update() as if they were columns.
     */
    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'generic' => ['required', 'string', 'max:255'],
            'variant' => ['required', 'string', 'max:255'],
            'company' => ['required', 'string', 'in:'.implode(',', Product::COMPANIES)],
            'category' => ['required', 'string', 'max:100'],
            'manufacturer' => ['required', 'string', 'max:150'],
            'description' => ['required', 'string', 'max:5000'],
            'image' => ['nullable', 'image', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
            'details' => ['nullable', 'string', function (string $attribute, mixed $value, \Closure $fail) {
                if (trim((string) $value) === '') {
                    return;
                }
                json_decode($value, true);
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $fail('The details field must be valid JSON: '.json_last_error_msg().'.');
                }
            }],
        ]);

        $data['details'] = trim((string) ($data['details'] ?? '')) === ''
            ? null
            : json_decode($data['details'], true);

        unset($data['image'], $data['remove_image']);

        return $data;
    }

    /**
     * Handles the uploaded file / removal checkbox and writes $data['image_path']
     * accordingly.
     *
     * This deliberately does NOT write into public/images/products/ (where the
     * deploy-time catalogue photos live). nginx and the app container are
     * separate images with no shared filesystem — nginx serves a static copy
     * of public/ baked in at build time, so anything the app container wrote
     * to its own public/ at runtime would be invisible to real visitors and
     * wiped on the next deploy anyway. The one thing that IS a persistent,
     * shared volume across app/queue container recreations is storage/ (see
     * docker-compose.yml's storage_data volume), so uploads go through the
     * 'public' filesystem disk (storage/app/public) and are served back out
     * via the product-images.show route in routes/web.php — nginx's
     * `try_files … /index.php` already falls through to Laravel for any path
     * it doesn't recognise as a static file, so no nginx/compose changes are
     * needed for this to work.
     */
    private function applyImage(Request $request, Product $product, array &$data): void
    {
        if ($request->boolean('remove_image')) {
            $this->deleteImageFile($product->image_path);
            $data['image_path'] = null;

            return;
        }

        if (! $request->hasFile('image')) {
            return; // leave the existing image_path untouched
        }

        $file = $request->file('image');
        $slug = $product->exists ? $product->slug : $data['slug'];
        $filename = $slug.'.'.$file->extension();
        $newPath = "product-images/{$filename}";

        // Clean up the old file if this upload replaces it under a different
        // name (e.g. the previous image was a .jpg and this one's a .png).
        if ($product->image_path && $product->image_path !== $newPath) {
            $this->deleteImageFile($product->image_path);
        }

        Storage::disk('public')->putFileAs('products', $file, $filename);
        $data['image_path'] = $newPath;
    }

    private function deleteImageFile(?string $path): void
    {
        if (! $path) {
            return;
        }

        if (str_starts_with($path, 'product-images/')) {
            Storage::disk('public')->delete('products/'.substr($path, strlen('product-images/')));
        }

        // Legacy images/products/* paths (the deploy-time catalogue photos,
        // baked into the repo and shipped in every image build) are left
        // alone: deleting from the currently-running app container's public/
        // wouldn't remove them from what nginx actually serves, and they'd
        // reappear on the next deploy regardless. Clearing image_path (done
        // by the caller) is what actually removes them from the site.
    }
}
