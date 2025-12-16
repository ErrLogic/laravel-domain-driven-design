<?php

namespace App\Domain\Accounting\ValueObjects;

readonly class AccountCode
{
    public function __construct(private string $value)
    {
        if (strlen($value) < 1) {
            throw new \DomainException('Invalid account code');
        }
    }

    public function value(): string
    {
        return $this->value;
    }

    public function isChildOf(self $parent): bool
    {
        return str_starts_with($this->value, $parent->value . '.');
    }
}
