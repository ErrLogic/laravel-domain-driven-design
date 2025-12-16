<?php

namespace App\Domain\Accounting\ValueObjects;

use InvalidArgumentException;

readonly class Money
{
    public function __construct(
        private int $value
    ) {
        if ($value < 0) {
            throw new InvalidArgumentException();
        }
    }

    public function value(): int
    {
        return $this->value;
    }
}
