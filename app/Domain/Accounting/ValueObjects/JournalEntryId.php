<?php

namespace App\Domain\Accounting\ValueObjects;

use Ramsey\Uuid\Uuid;

readonly class JournalEntryId
{
    public function __construct(private string $value)
    {
        if (! Uuid::isValid($value)) {
            throw new \DomainException('Invalid journal entry UUID');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
