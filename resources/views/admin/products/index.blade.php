<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Products') }}</h2>
            <a href="{{ route('admin.products.create') }}">
                <x-primary-button>{{ __('Add product') }}</x-primary-button>
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('status'))
                <div class="rounded-md bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            <form method="GET" action="{{ route('admin.products.index') }}" class="bg-white shadow-sm sm:rounded-lg p-4 flex flex-wrap gap-3 items-end">
                <div class="flex-1 min-w-[200px]">
                    <x-input-label for="q" value="Search" />
                    <x-text-input id="q" name="q" type="text" class="mt-1 block w-full" value="{{ $filters['q'] ?? '' }}" placeholder="Name, generic or manufacturer" />
                </div>
                <div>
                    <x-input-label for="company" value="Company" />
                    <select id="company" name="company" class="mt-1 block w-full border-gray-300 focus:border-red-500 focus:ring-red-500 rounded-md shadow-sm">
                        <option value="">All</option>
                        <option value="pharma" @selected(($filters['company'] ?? '') === 'pharma')>Mega Pharma</option>
                        <option value="meditech" @selected(($filters['company'] ?? '') === 'meditech')>Mega Meditech</option>
                    </select>
                </div>
                <x-primary-button>{{ __('Filter') }}</x-primary-button>
                @if (($filters['q'] ?? '') || ($filters['company'] ?? ''))
                    <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:underline">Clear</a>
                @endif
            </form>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Name</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Company</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Category</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Manufacturer</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($products as $product)
                            <tr>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900">{{ $product->name }}</div>
                                    <div class="text-gray-500">{{ $product->generic }}</div>
                                </td>
                                <td class="px-4 py-3">{{ $product->company === 'pharma' ? 'Mega Pharma' : 'Mega Meditech' }}</td>
                                <td class="px-4 py-3">{{ $product->category }}</td>
                                <td class="px-4 py-3">{{ $product->manufacturer }}</td>
                                <td class="px-4 py-3 text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('admin.products.edit', $product) }}" class="text-red-700 hover:underline">Edit</a>
                                    <form method="POST" action="{{ route('admin.products.destroy', $product) }}" class="inline" onsubmit="return confirm('Delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-500 hover:text-red-700 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-4 py-6 text-center text-gray-500">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
