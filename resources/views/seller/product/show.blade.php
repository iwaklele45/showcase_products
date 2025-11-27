<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $product->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            @if ($product->image)
                                <img src="{{ asset('images/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-auto rounded-lg shadow-md">
                            @else
                                <div class="w-full h-64 bg-gray-200 dark:bg-gray-700 rounded-lg flex items-center justify-center">
                                    <span class="text-gray-500 dark:text-gray-400">No Image</span>
                                </div>
                            @endif
                        </div>
                        <div>
                            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
                            <p class="text-xl text-green-600 font-semibold mb-4">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                            
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Description</h3>
                                <p class="text-gray-600 dark:text-gray-300">{{ $product->description }}</p>
                            </div>

                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-2">Seller</h3>
                                <p class="text-gray-600 dark:text-gray-300">{{ $product->seller->name }} ({{ $product->seller->store_name ?? 'Store' }})</p>
                            </div>

                            @if (Auth::id() !== $product->user_id)
                                <form action="{{ route('chats.initiate', $product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                        Chat Seller
                                    </button>
                                </form>
                            @else
                                <p class="text-sm text-gray-500 italic">This is your product.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
