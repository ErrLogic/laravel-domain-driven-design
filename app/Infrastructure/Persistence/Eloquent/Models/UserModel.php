<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use App\Models\User as BaseUser;

class UserModel extends BaseUser
{
    protected $table = 'users';
}
