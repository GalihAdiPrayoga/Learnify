<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\Conversation;

Broadcast::channel('conversation.{conversationId}', function ($user, $conversationId) {
    $conversation = Conversation::find($conversationId);

    if (!$conversation) {
        return false;
    }

    if ($conversation->user_id === $user->id) {
        return true;
    }

    if ($user->hasRole('Admin')) {
        return true;
    }

    return false;
});

Broadcast::channel('admin.chats', function ($user) {
    return $user->hasRole('Admin');
});
