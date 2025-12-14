<?php

namespace App\Application\User\Contracts;

interface PasswordHasher
{
    public function hash(string $plain): string;
}
