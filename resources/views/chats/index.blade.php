<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('My Chats') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @forelse ($chats as $chat)
                        <a href="{{ route('chats.show', $chat) }}" class="block hover:bg-gray-50 dark:hover:bg-gray-700 p-4 rounded-lg transition duration-150 ease-in-out border-b border-gray-200 dark:border-gray-700 last:border-0">
                            <div class="flex justify-between items-center">
                                <div>
                                    <h3 class="text-lg font-semibold">
                                        @if (Auth::id() === $chat->buyer_id)
                                            {{ $chat->seller->name }} (Seller)
                                        @else
                                            {{ $chat->buyer->name }} (Buyer)
                                        @endif
                                    </h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400 truncate">
                                        {{ $chat->messages->first()?->message ?? 'No messages yet' }}
                                    </p>
                                </div>
                                <div class="text-xs text-gray-400">
                                    {{ $chat->messages->first()?->created_at->diffForHumans() ?? $chat->created_at->diffForHumans() }}
                                </div>
                            </div>
                        </a>
                    @empty
                        <p class="text-center text-gray-500 dark:text-gray-400">No chats found.</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
