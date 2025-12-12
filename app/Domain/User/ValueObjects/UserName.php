<?php

namespace App\Domain\User\ValueObjects;

use App\Domain\User\Exceptions\InvalidUserNameException;

readonly class UserName
{
    public function __construct(private string $value)
    {
        if (strlen($value) < 3) {
            throw new InvalidUserNameException;
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
