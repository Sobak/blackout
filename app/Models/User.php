<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = false;

    protected $appends = [
        'unread_messages_count',
    ];

    protected $casts = [
        'bana' => 'boolean',
    ];

    const LEVEL_PLAYER = 0;
    const LEVEL_OPERATOR = 1;
    const LEVEL_SUPER_OPERATOR = 2;
    const LEVEL_ADMIN = 3;

    public function getUnreadMessagesCountAttribute()
    {
        static $count;

        if ($count === null) {
            $count = Message::where('message_owner', $this->id)->where('message_unread', 1)->count();
        }

        return $count;
    }
}
