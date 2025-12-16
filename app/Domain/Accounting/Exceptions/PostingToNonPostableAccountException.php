<?php

namespace App\Domain\Accounting\Exceptions;

use DomainException;

class PostingToNonPostableAccountException extends DomainException
{
    public function __construct(string $message = 'Non postable account cannot be posted', int $code = 422)
    {
        parent::__construct(message: $message, code: $code);
    }
}

