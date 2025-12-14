<?php

namespace App\Application\Auth\Contracts;

interface PasswordVerifier
{
    public function verify(string $plain, string $hashed): bool;
}
