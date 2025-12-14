<?php

namespace App\Domain\User\Exceptions;

use DomainException;

class UserNotFoundException extends DomainException
{
    public function __construct(string $message = 'User not found', int $code = 404)
    {
        parent::__construct(message: $message, code: $code);
    }
}
