<?php

namespace App\Domain\Accounting\ValueObjects\Enums;

enum DebitCredit: string
{
    case DEBIT = 'debit';
    case CREDIT = 'credit';
}
