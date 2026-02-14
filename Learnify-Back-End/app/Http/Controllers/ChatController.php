<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Events\NewConversationMessage;
use App\Http\Requests\SendMessageRequest;
use App\Models\Conversation;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ChatController extends Controller
{
    /**
     * USER: Get or create the user's own conversation and load messages.
     */
    public function userIndex(Request $request)
    {
        try {
            $user = $request->user();

            $conversation = Conversation::firstOrCreate(
                ['user_id' => $user->id],
                ['last_message_at' => now()]
            );

            $messages = $conversation->messages()
                ->with('sender:id,name,profile')
                ->orderBy('created_at', 'asc')
                ->get();

            return response()->json([
                'success' => true,
                'data' => [
                    'conversation_id' => $conversation->id,
                    'messages' => $messages,
                ],
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in ChatController@userIndex: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat chat',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * USER: Send a message in the user's own conversation.
     */
    public function userSend(SendMessageRequest $request)
    {
        try {
            $user = $request->user();

            $conversation = Conversation::firstOrCreate(
                ['user_id' => $user->id],
                ['last_message_at' => now()]
            );

            $message = Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $user->id,
                'sender_role' => 'User',
                'body' => $request->validated()['body'],
                'status' => 'sent',
            ]);

            $conversation->update(['last_message_at' => now()]);

            $message->load('sender:id,name,profile');

            broadcast(new MessageSent($message))->toOthers();

            broadcast(new NewConversationMessage(
                $conversation->id,
                $user->id,
                $user->name,
                Str::limit($message->body, 50)
            ));

            return response()->json([
                'success' => true,
                'data' => $message,
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Error in ChatController@userSend: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim pesan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * ADMIN: List all conversations with latest message and unread count.
     */
    public function adminConversations(Request $request)
    {
        try {
            $conversations = Conversation::with([
                'user:id,name,email,profile',
                'latestMessage',
            ])
                ->withCount([
                    'messages as unread_count' => function ($query) {
                        $query->where('sender_role', 'User')->whereNull('read_at');
                    }
                ])
                ->orderByDesc('last_message_at')
                ->get();

            return response()->json([
                'success' => true,
                'data' => $conversations,
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in ChatController@adminConversations: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat daftar percakapan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * ADMIN: Get messages for a specific conversation.
     */
    public function adminMessages(Request $request, $conversationId)
    {
        try {
            $conversation = Conversation::with('user:id,name,email,profile')
                ->findOrFail($conversationId);

            $messages = $conversation->messages()
                ->with('sender:id,name,profile')
                ->orderBy('created_at', 'asc')
                ->get();

            // Mark user messages as read
            $conversation->messages()
                ->where('sender_role', 'User')
                ->whereNull('read_at')
                ->update(['read_at' => now()]);

            return response()->json([
                'success' => true,
                'data' => [
                    'conversation' => $conversation,
                    'messages' => $messages,
                ],
            ]);
        } catch (\Exception $e) {
            \Log::error('Error in ChatController@adminMessages: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat pesan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * ADMIN: Send a message to a user's conversation.
     */
    public function adminSend(SendMessageRequest $request, $conversationId)
    {
        try {
            $admin = $request->user();
            $conversation = Conversation::findOrFail($conversationId);

            $message = Message::create([
                'conversation_id' => $conversation->id,
                'sender_id' => $admin->id,
                'sender_role' => 'Admin',
                'body' => $request->validated()['body'],
                'status' => 'sent',
            ]);

            $conversation->update(['last_message_at' => now()]);

            $message->load('sender:id,name,profile');

            broadcast(new MessageSent($message))->toOthers();

            return response()->json([
                'success' => true,
                'data' => $message,
            ], 201);
        } catch (\Exception $e) {
            \Log::error('Error in ChatController@adminSend: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Gagal mengirim pesan',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * USER: Mark admin messages as read.
     */
    public function userMarkRead(Request $request)
    {
        try {
            $user = $request->user();
            $conversation = Conversation::where('user_id', $user->id)->first();

            if ($conversation) {
                $conversation->messages()
                    ->where('sender_role', 'Admin')
                    ->whereNull('read_at')
                    ->update(['read_at' => now()]);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menandai pesan',
            ], 500);
        }
    }

    /**
     * USER: Get unread count for the logged-in user.
     */
    public function userUnreadCount(Request $request)
    {
        try {
            $user = $request->user();
            $conversation = Conversation::where('user_id', $user->id)->first();

            $count = 0;
            if ($conversation) {
                $count = $conversation->messages()
                    ->where('sender_role', 'Admin')
                    ->whereNull('read_at')
                    ->count();
            }

            return response()->json([
                'success' => true,
                'data' => ['unread_count' => $count],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat jumlah pesan belum dibaca',
            ], 500);
        }
    }

    /**
     * ADMIN: Get total unread count across all conversations.
     */
    public function adminUnreadCount(Request $request)
    {
        try {
            $count = Message::where('sender_role', 'User')
                ->whereNull('read_at')
                ->count();

            return response()->json([
                'success' => true,
                'data' => ['unread_count' => $count],
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal memuat jumlah pesan belum dibaca',
            ], 500);
        }
    }
}
