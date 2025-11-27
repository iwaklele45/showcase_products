<?php

namespace App\Http\Controllers;

use App\Models\Chat;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function initiate(Product $product)
    {
        $buyerId = Auth::id();
        $sellerId = $product->user_id;

        if ($buyerId === $sellerId) {
            return redirect()->back()->with('error', 'You cannot chat with yourself.');
        }

        // Check if chat already exists
        $chat = Chat::where(function ($query) use ($buyerId, $sellerId) {
            $query->where('buyer_id', $buyerId)->where('seller_id', $sellerId);
        })->orWhere(function ($query) use ($buyerId, $sellerId) {
            $query->where('buyer_id', $sellerId)->where('seller_id', $buyerId);
        })->first();

        if (!$chat) {
            $chat = Chat::create([
                'buyer_id' => $buyerId,
                'seller_id' => $sellerId,
            ]);
        }

        return redirect()->route('chats.show', $chat);
    }

    public function index()
    {
        $userId = Auth::id();
        $chats = Chat::where('buyer_id', $userId)
            ->orWhere('seller_id', $userId)
            ->with(['buyer', 'seller', 'messages' => function($query) {
                $query->latest()->limit(1);
            }])
            ->get()
            ->sortByDesc(function($chat) {
                return $chat->messages->first()?->created_at ?? $chat->created_at;
            });

        return view('chats.index', compact('chats'));
    }

    public function show(Chat $chat)
    {
        $this->authorizeChatAccess($chat);

        $chat->load(['messages.sender', 'buyer', 'seller']);
        
        // Mark messages as read
        Message::where('chat_id', $chat->id)
            ->where('sender_id', '!=', Auth::id())
            ->where('is_read', false)
            ->update(['is_read' => true]);

        return view('chats.show', compact('chat'));
    }

    public function store(Request $request, Chat $chat)
    {
        $this->authorizeChatAccess($chat);

        $request->validate([
            'message' => 'required|string',
        ]);

        Message::create([
            'chat_id' => $chat->id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
        ]);

        return redirect()->route('chats.show', $chat);
    }

    private function authorizeChatAccess(Chat $chat)
    {
        if (Auth::id() !== $chat->buyer_id && Auth::id() !== $chat->seller_id) {
            abort(403);
        }
    }
}
