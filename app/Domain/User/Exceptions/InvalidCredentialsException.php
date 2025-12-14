<?php

namespace App\Domain\User\Exceptions;

use DomainException;

class InvalidCredentialsException extends DomainException
{
    public function __construct(string $message = 'Invalid credentials', int $code = 401)
    {
        parent::__construct(message: $message, code: $code);
    }
}
