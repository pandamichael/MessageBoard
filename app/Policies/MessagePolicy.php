<?php

namespace App\Policies;

use App\Models\Message;
use App\Models\User;

class MessagePolicy
{
    public function delete(User $user, Message $message): bool
    {
        return $user->id === $message->user_id;
    }

    public function update(User $user, Message $message)
    {
        return $user->id === $message->user_id;
    }
    
}
