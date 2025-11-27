@extends('admin-lte.layouts.app')

@section('title', 'Chat')

@section('content')
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">
                        Chat with 
                        @if (Auth::id() === $chat->buyer_id)
                            {{ $chat->seller->name }}
                        @else
                            {{ $chat->buyer->name }}
                        @endif
                    </h3>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="card" style="height: 600px;">
                <div class="card-body overflow-auto" id="chat-container">
                    <div class="d-flex flex-column gap-3">
                        @foreach ($chat->messages as $message)
                            <div class="d-flex {{ $message->sender_id === Auth::id() ? 'justify-content-end' : 'justify-content-start' }}">
                                <div class="card mb-0 {{ $message->sender_id === Auth::id() ? 'bg-primary text-white' : 'bg-light' }}" style="max-width: 70%;">
                                    <div class="card-body p-2">
                                        <p class="mb-1">{{ $message->message }}</p>
                                        <small class="{{ $message->sender_id === Auth::id() ? 'text-white-50' : 'text-muted' }} d-block text-end">
                                            {{ $message->created_at->format('H:i') }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="card-footer">
                    <form action="{{ route('chats.messages.store', $chat) }}" method="POST" class="d-flex gap-2">
                        @csrf
                        <input type="text" name="message" class="form-control" placeholder="Type your message..." required autofocus>
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-send"></i> Send
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const chatContainer = document.getElementById('chat-container');
            chatContainer.scrollTop = chatContainer.scrollHeight;
        });
    </script>
@endsection
