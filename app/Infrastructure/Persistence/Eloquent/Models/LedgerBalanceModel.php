<?php

namespace App\Infrastructure\Persistence\Eloquent\Models;

use App\Models\LedgerBalance as BaseLedgerBalance;

class LedgerBalanceModel extends BaseLedgerBalance
{
    protected $table = 'ledger_balances';
}
