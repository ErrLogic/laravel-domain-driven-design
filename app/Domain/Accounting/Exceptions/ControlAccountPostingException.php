<?php

namespace App\Domain\Accounting\Exceptions;

use DomainException;

class ControlAccountPostingException extends DomainException
{
    public function __construct(string $message = 'Control account cannot be posted', int $code = 422)
    {
        parent::__construct(message: $message, code: $code);
    }
}
