<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    public $timestamps = false;

    const LEVEL_PLAYER = 0;
    const LEVEL_OPERATOR = 1;
    const LEVEL_SUPER_OPERATOR = 2;
    const LEVEL_ADMIN = 3;
}
