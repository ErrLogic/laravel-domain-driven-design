<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use App\Models\Account as BaseAccount;

class AccountModel extends BaseAccount
{
    protected $table = 'accounts';
}
