<?php

namespace App\Domain\Inventory\ValueObjects;

use App\Domain\Inventory\Exceptions\InvalidItemNameException;

readonly class ItemName
{
    public function __construct(private string $value)
    {
        if (strlen($value) < 3) {
            throw new InvalidItemNameException;
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
