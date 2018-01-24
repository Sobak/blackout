<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    public $timestamps = false;

    protected $dateFormat = 'u';

    protected $dates = [
        'timestamp',
    ];

    protected $table = 'chat';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
