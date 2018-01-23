<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Error extends Model
{
    public $timestamps = false;

    protected $dateFormat = 'u';

    protected $dates = [
        'error_time',
    ];

    protected $primaryKey = 'error_id';
}
