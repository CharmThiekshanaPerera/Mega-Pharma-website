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
        <x-input-label for="description" value="Description" />
        <textarea id="description" name="description" rows="4" required
            class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">{{ old('description', $product->description) }}</textarea>
        <x-input-error :messages="$errors->get('description')" class="mt-2" />
    </div>
</div>
