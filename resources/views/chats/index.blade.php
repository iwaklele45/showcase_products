@extends('admin-lte.layouts.app')

@section('title', 'My Chats')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">My Chats</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-body p-0">
                    <div class="list-group list-group-flush">
                        @forelse ($chats as $chat)
                            <a href="{{ route('chats.show', $chat) }}" class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">
                                        @if (Auth::id() === $chat->buyer_id)
                                            {{ $chat->seller->name }} (Seller)
                                        @else
                                            {{ $chat->buyer->name }} (Buyer)
                                        @endif
                                    </h5>
                                    <small class="text-muted">
                                        {{ $chat->messages->first()?->created_at->diffForHumans() ?? $chat->created_at->diffForHumans() }}
                                    </small>
                                </div>
                                <p class="mb-1 text-truncate" style="max-width: 80%;">
                                    {{ $chat->messages->first()?->message ?? 'No messages yet' }}
                                </p>
                            </a>
                        @empty
                            <div class="p-4 text-center text-muted">
                                No chats found.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
