<?php

namespace App\Domain\Accounting\ValueObjects;

use App\Domain\Accounting\Exceptions\AccountNotFoundException;
use Ramsey\Uuid\Uuid;

readonly class AccountId
{
    public function __construct(private string $value)
    {
        if (! Uuid::isValid($value)) {
            throw new AccountNotFoundException('Invalid account UUID');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
