<?php

namespace App\Domain\Inventory\ValueObjects;

use App\Domain\Inventory\Exceptions\InvalidItemIdException;
use InvalidArgumentException;
use Ramsey\Uuid\Uuid;

readonly class ItemId
{
    public function __construct(private string $value)
    {
        if (! Uuid::isValid($value)) {
            throw new InvalidItemIdException('Invalid Item UUID');
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}
