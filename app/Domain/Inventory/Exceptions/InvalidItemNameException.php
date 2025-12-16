<?php

namespace App\Domain\Inventory\Exceptions;

use DomainException;

class InvalidItemNameException extends DomainException
{
    public function __construct(string $message = 'Invalid item description', int $code = 422)
    {
        parent::__construct(message: $message, code: $code);
    }
}
