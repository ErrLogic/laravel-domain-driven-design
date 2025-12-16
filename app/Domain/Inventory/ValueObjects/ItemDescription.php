<?php

namespace App\Domain\Inventory\ValueObjects;

use App\Domain\Inventory\Exceptions\InvalidItemDescriptionException;

readonly class ItemDescription
{
    public function __construct(private string $value)
    {
        if (strlen($value) < 10) {
            throw new InvalidItemDescriptionException;
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
