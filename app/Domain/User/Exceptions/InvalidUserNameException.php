<?php

namespace App\Domain\User\Exceptions;

use DomainException;

class InvalidUserNameException extends DomainException
{
    public function __construct(string $message = 'Invalid username', int $code = 422)
    {
        parent::__construct(message: $message, code: $code);
    }
}
