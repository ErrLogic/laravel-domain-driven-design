<?php

namespace App\Domain\Inventory\Exceptions;

use DomainException;

class InvalidItemCodeException extends DomainException
{
    public function __construct(string $message = 'Invalid item code', int $code = 422)
    {
        parent::__construct(message: $message, code: $code);
    }
}
