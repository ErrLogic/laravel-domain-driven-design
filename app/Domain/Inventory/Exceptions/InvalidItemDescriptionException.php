<?php

namespace App\Domain\Inventory\Exceptions;

use DomainException;

class InvalidItemDescriptionException extends DomainException
{
    public function __construct(string $message = 'Invalid item name', int $code = 422)
    {
        parent::__construct(message: $message, code: $code);
    }
}
