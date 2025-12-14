<?php

namespace App\Application\Auth\Contracts;

interface TokenIssuer
{
    public function issue(string $userId): string;
}
