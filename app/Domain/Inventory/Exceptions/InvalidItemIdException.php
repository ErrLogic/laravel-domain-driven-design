<?php

namespace App\Domain\Inventory\Exceptions;

use DomainException;

class InvalidItemIdException extends DomainException
{
    public function __construct(string $message = 'Invalid item ID', int $code = 422)
    {
        parent::__construct(message: $message, code: $code);
    }
}
