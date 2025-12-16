<?php

namespace App\Domain\Accounting\ValueObjects\Enums;

enum AccountType: string
{
    case ASSET = 'asset';
    case LIABILITY = 'liability';
    case EQUITY = 'equity';
    case REVENUE = 'revenue';
    case EXPENSE = 'expense';

    public function normalSide(): DebitCredit
    {
        return match ($this) {
            self::ASSET, self::EXPENSE => DebitCredit::DEBIT,
            self::LIABILITY, self::EQUITY, self::REVENUE => DebitCredit::CREDIT,
        };
    }
}
