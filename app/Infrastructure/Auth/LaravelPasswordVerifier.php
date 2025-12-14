<?php

namespace App\Infrastructure\Auth;

use App\Application\Auth\Contracts\PasswordVerifier;
use Illuminate\Support\Facades\Hash;

class LaravelPasswordVerifier implements PasswordVerifier
{
    public function verify(string $plain, string $hashed): bool
    {
        return Hash::check($plain, $hashed);
    }
}
