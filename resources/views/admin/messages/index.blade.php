<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Messages') }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('status'))
                <div class="rounded-md bg-green-50 border border-green-200 text-green-800 text-sm px-4 py-3">
                    {{ session('status') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">From</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Topic</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-500">Received</th>
                            <th class="px-4 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($messages as $item)
                            <tr class="{{ $item->read_at ? '' : 'bg-red-50/40' }}">
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900">
                                        @unless ($item->read_at)
                                            <span class="inline-block w-2 h-2 rounded-full bg-red-600 mr-1" title="Unread"></span>
                                        @endunless
                                        {{ $item->name }}
                                    </div>
                                    <div class="text-gray-500">{{ $item->email }}</div>
                                </td>
                                <td class="px-4 py-3">{{ $item->topic }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $item->created_at->format('d M Y, H:i') }}</td>
                                <td class="px-4 py-3 text-right space-x-3 whitespace-nowrap">
                                    <a href="{{ route('admin.messages.show', $item) }}" class="text-red-700 hover:underline">View</a>
                                    <form method="POST" action="{{ route('admin.messages.destroy', $item) }}" class="inline" onsubmit="return confirm('Delete this message?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-gray-500 hover:text-red-700 hover:underline">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-4 py-6 text-center text-gray-500">No messages yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $messages->links() }}
        </div>
    </div>
</x-app-layout>
