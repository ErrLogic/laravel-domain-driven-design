<?php

namespace App\Domain\Inventory\ValueObjects;

use App\Domain\Inventory\Exceptions\InvalidItemCodeException;

readonly class ItemCode
{
    public function __construct(private string $value)
    {
        if (strlen($value) < 12) {
            throw new InvalidItemCodeException;
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
