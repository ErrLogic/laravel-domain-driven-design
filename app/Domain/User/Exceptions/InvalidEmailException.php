<?php

namespace App\Domain\User\Exceptions;

use DomainException;

class InvalidEmailException extends DomainException
{
    public function __construct(string $message = 'Invalid email format', int $code = 422)
    {
        parent::__construct(message: $message, code: $code);
    }
}
