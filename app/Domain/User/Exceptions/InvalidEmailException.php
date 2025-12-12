<?php

namespace App\Domain\User\Exceptions;

use DomainException;

class InvalidEmailException extends DomainException
{
    public function __construct(string $message = 'Invalid email format')
    {
        parent::__construct($message);
    }
}
