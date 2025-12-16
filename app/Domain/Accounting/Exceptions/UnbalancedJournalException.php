<?php

namespace App\Domain\Accounting\Exceptions;

use DomainException;

class UnbalancedJournalException extends DomainException
{
    public function __construct(string $message = 'Unbalanced journal value', int $code = 422)
    {
        parent::__construct(message: $message, code: $code);
    }
}
