<?php

namespace App\Domain\User\Exceptions;

use DomainException;

class InvalidUserNameException extends DomainException
{
    public function __construct(string $message = 'Invalid username')
    {
        parent::__construct($message);
    }
}
