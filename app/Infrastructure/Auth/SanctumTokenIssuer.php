<?php

namespace App\Infrastructure\Auth;

use App\Application\Auth\Contracts\TokenIssuer;
use App\Models\User;

class SanctumTokenIssuer implements TokenIssuer
{
    public function issue(string $userId): string
    {
        $user = User::findOrFail($userId);

        return $user->createToken('api')->plainTextToken;
    }
}
