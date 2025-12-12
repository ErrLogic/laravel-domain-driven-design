<?php

namespace App\Domain\User\ValueObjects;

use App\Domain\User\Exceptions\InvalidEmailException;

readonly class UserEmail
{
    public function __construct(private string $value)
    {
        if (! filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException;
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
