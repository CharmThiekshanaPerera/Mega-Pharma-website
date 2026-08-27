@php
    $companies = ['pharma' => 'Mega Pharma', 'meditech' => 'Mega Meditech'];
@endphp

<div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
    <div>
        <x-input-label for="name" value="Product name" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $product->name)" required autofocus />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="generic" value="Generic / composition" />
        <x-text-input id="generic" name="generic" type="text" class="mt-1 block w-full" :value="old('generic', $product->generic)" required />
        <x-input-error :messages="$errors->get('generic')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="variant" value="Variant / pack size" />
        <x-text-input id="variant" name="variant" type="text" class="mt-1 block w-full" :value="old('variant', $product->variant)" required />
        <x-input-error :messages="$errors->get('variant')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="company" value="Company" />
        <select id="company" name="company" required
            class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
            @foreach ($companies as $value => $label)
                <option value="{{ $value }}" @selected(old('company', $product->company) === $value)>{{ $label }}</option>
            @endforeach
        </select>
        <x-input-error :messages="$errors->get('company')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="category" value="Category" />
        <x-text-input id="category" name="category" type="text" class="mt-1 block w-full" :value="old('category', $product->category)" required />
        <x-input-error :messages="$errors->get('category')" class="mt-2" />
    </div>

    <div>
        <x-input-label for="manufacturer" value="Manufacturer / principal" />
        <x-text-input id="manufacturer" name="manufacturer" type="text" class="mt-1 block w-full" :value="old('manufacturer', $product->manufacturer)" required />
        <x-input-error :messages="$errors->get('manufacturer')" class="mt-2" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="image" value="Product image" />
        @if ($product->imageUrl)
            <img src="{{ $product->imageUrl }}" alt="" class="mt-1 h-24 w-24 object-cover rounded border border-gray-200">
        @else
            <p class="mt-1 text-sm text-gray-500">No image set.</p>
        @endif
        <input id="image" name="image" type="file" accept="image/png,image/jpeg,image/webp,image/gif"
            class="mt-2 block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-red-50 file:text-red-700 hover:file:bg-red-100" />
        <p class="mt-1 text-xs text-gray-400">JPG, PNG, WebP or GIF, up to 5MB. Uploading a new image replaces the current one.</p>
        <x-input-error :messages="$errors->get('image')" class="mt-2" />
        @if ($product->exists && $product->imageUrl)
            <label class="mt-2 flex items-center gap-2 text-sm text-gray-600">
                <input type="checkbox" name="remove_image" value="1" class="rounded border-gray-300 text-red-600 focus:ring-red-500">
                Remove the current image (leave the card without a photo)
            </label>
        @endif
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="description" value="Description" />
        <textarea id="description" name="description" rows="4" required
            class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">{{ old('description', $product->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>

    <div class="sm:col-span-2">
        <x-input-label for="details" value="Extra details (advanced)" />
        <p class="mt-1 text-xs text-gray-500">
            Optional, raw JSON — powers the product's brochure page beyond the fields above: a <code>tagline</code> quote,
            <code>components</code>/<code>highlights</code> lists (with an image-in-<code>details/products/icons</code> icon per point), a
            <code>specs</code> table (grouped rows), <code>award</code> and <code>manufacturer_info</code> blocks, and a two-colour
            <code>theme</code> for the product page's backdrop. Leave empty for a plain product with no brochure sections.
            Must be valid JSON or the whole form will be rejected.
        </p>
        <textarea id="details" name="details" rows="12" spellcheck="false"
            class="mt-2 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm font-mono text-xs"
            placeholder='{"tagline": "A short pull-quote for the hero.", "specs": [{"group": "Overview", "rows": [{"label": "Weight", "value": "180 g"}]}]}'
        >{{ old('details', $product->details ? json_encode($product->details, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) : '') }}</textarea>
        <x-input-error :messages="$errors->get('details')" class="mt-2" />
    </div>
</div>
