<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ __('Message from :name', ['name' => $message->name]) }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-4">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4">
                <dl class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-sm">
                    <div>
                        <dt class="text-gray-500">Name</dt>
                        <dd class="text-gray-900 font-medium">{{ $message->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Email</dt>
                        <dd class="text-gray-900 font-medium"><a class="hover:underline" href="mailto:{{ $message->email }}">{{ $message->email }}</a></dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Topic</dt>
                        <dd class="text-gray-900 font-medium">{{ $message->topic }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Received</dt>
                        <dd class="text-gray-900 font-medium">{{ $message->created_at->format('d M Y, H:i') }}</dd>
                    </div>
                </dl>

                <div>
                    <dt class="text-gray-500 text-sm mb-1">Message</dt>
                    <dd class="text-gray-900 whitespace-pre-line border border-gray-200 rounded-md p-4">{{ $message->message }}</dd>
                </div>

                <div class="flex items-center gap-4 pt-2">
                    <a href="mailto:{{ $message->email }}?subject={{ rawurlencode('Re: '.$message->topic) }}">
                        <x-primary-button>{{ __('Reply by email') }}</x-primary-button>
                    </a>
                    <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" onsubmit="return confirm('Delete this message?');">
                        @csrf
                        @method('DELETE')
                        <x-danger-button>{{ __('Delete') }}</x-danger-button>
                    </form>
                    <a href="{{ route('admin.messages.index') }}" class="text-sm text-gray-500 hover:underline">Back to messages</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
