<?php

namespace App\Application\Security;

interface PasswordHasher
{
    public function hash(string $plain): string;
}
