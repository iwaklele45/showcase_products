<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Chat with 
            @if (Auth::id() === $chat->buyer_id)
                {{ $chat->seller->name }}
            @else
                {{ $chat->buyer->name }}
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex flex-col h-[600px]">
                <!-- Chat Messages -->
                <div class="flex-1 p-6 overflow-y-auto flex flex-col space-y-4" id="chat-container">
                    @foreach ($chat->messages as $message)
                        <div class="flex {{ $message->sender_id === Auth::id() ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[70%] {{ $message->sender_id === Auth::id() ? 'bg-blue-500 text-white' : 'bg-gray-200 dark:bg-gray-700 text-gray-900 dark:text-gray-100' }} rounded-lg px-4 py-2 shadow">
                                <p>{{ $message->message }}</p>
                                <p class="text-xs {{ $message->sender_id === Auth::id() ? 'text-blue-100' : 'text-gray-500 dark:text-gray-400' }} mt-1 text-right">
                                    {{ $message->created_at->format('H:i') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Message Input -->
                <div class="p-4 border-t border-gray-200 dark:border-gray-700 bg-gray-50 dark:bg-gray-900">
                    <form action="{{ route('chats.messages.store', $chat) }}" method="POST" class="flex gap-4">
                        @csrf
                        <input type="text" name="message" class="flex-1 rounded-md border-gray-300 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300 focus:border-blue-500 focus:ring-blue-500 shadow-sm" placeholder="Type your message..." required autofocus>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                            Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Scroll to bottom of chat container
        const chatContainer = document.getElementById('chat-container');
        chatContainer.scrollTop = chatContainer.scrollHeight;
    </script>
</x-app-layout>
