<?php

namespace App\Domain\User\Exceptions;

use DomainException;

class InvalidUserIdException extends DomainException
{
    public function __construct(string $message = 'Invalid user ID', int $code = 422)
    {
        parent::__construct(message: $message, code: $code);
    }
}
