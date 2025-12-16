<?php

namespace App\Domain\Accounting\Exceptions;

use DomainException;

class AccountNotFoundException extends DomainException
{
    public function __construct(string $message = 'Invalid account selected', int $code = 422)
    {
        parent::__construct(message: $message, code: $code);
    }
}
