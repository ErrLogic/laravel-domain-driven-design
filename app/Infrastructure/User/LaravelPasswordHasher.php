<?php

namespace App\Infrastructure\User;

use App\Application\User\Contracts\PasswordHasher;
use Illuminate\Support\Facades\Hash;

class LaravelPasswordHasher implements PasswordHasher
{
    public function hash(string $plain): string
    {
        return Hash::make($plain);
    }
}
