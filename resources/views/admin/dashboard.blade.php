<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Total products</p>
                    <p class="text-3xl font-semibold text-gray-900">{{ $productCount }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Mega Pharma</p>
                    <p class="text-3xl font-semibold text-gray-900">{{ $pharmaCount }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Mega Meditech</p>
                    <p class="text-3xl font-semibold text-gray-900">{{ $meditechCount }}</p>
                </div>
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <p class="text-sm text-gray-500">Unread messages</p>
                    <p class="text-3xl font-semibold {{ $unreadCount > 0 ? 'text-red-600' : 'text-gray-900' }}">{{ $unreadCount }}</p>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-900">Recent enquiries</h3>
                        <a href="{{ route('admin.messages.index') }}" class="text-sm text-red-700 hover:underline">View all</a>
                    </div>

                    @if ($recentMessages->isEmpty())
                        <p class="text-sm text-gray-500">No enquiries yet.</p>
                    @else
                        <ul class="divide-y divide-gray-100">
                            @foreach ($recentMessages as $item)
                                <li class="py-3 flex items-center justify-between">
                                    <a href="{{ route('admin.messages.show', $item) }}" class="min-w-0">
                                        <p class="text-sm font-medium text-gray-900 truncate">
                                            {{ $item->name }}
                                            @unless ($item->read_at)
                                                <span class="ml-2 inline-block w-2 h-2 rounded-full bg-red-600" title="Unread"></span>
                                            @endunless
                                        </p>
                                        <p class="text-sm text-gray-500 truncate">{{ $item->topic }} &middot; {{ $item->email }}</p>
                                    </a>
                                    <span class="text-xs text-gray-400 shrink-0 ml-4">{{ $item->created_at->diffForHumans() }}</span>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
