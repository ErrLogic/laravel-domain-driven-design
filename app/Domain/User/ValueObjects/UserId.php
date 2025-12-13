<?php

namespace App\Domain\User\ValueObjects;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

readonly class UserId
{
    public function __construct(private string $value)
    {
        if (! Uuid::isValid($value)) {
            throw new InvalidArgumentException('Invalid UUID');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
