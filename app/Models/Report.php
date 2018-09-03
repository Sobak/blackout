<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    public $timestamps = false;

    public $incrementing = false;

    protected $primaryKey = 'rid';

    protected $table = 'rw';
}
