<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Edit product') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.products.update', $product) }}" class="space-y-6">
                    @csrf
                    @method('PUT')
                    @include('admin.products._form')

                    <div class="flex items-center gap-4">
                        <x-primary-button>{{ __('Save changes') }}</x-primary-button>
                        <a href="{{ route('admin.products.index') }}" class="text-sm text-gray-500 hover:underline">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
