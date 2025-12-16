<?php

namespace App\Domain\Accounting\ValueObjects;

use App\Domain\Accounting\ValueObjects\Enums\DebitCredit;

readonly class JournalLine
{
    private AccountId $accountId;
    private Money $amount;
    private DebitCredit $side;

    public function __construct(
        AccountId $accountId,
        Money $amount,
        DebitCredit $side
    ) {
        $this->accountId = $accountId;
        $this->amount = $amount;
        $this->side = $side;
    }

    public function accountId(): AccountId
    {
        return $this->accountId;
    }

    public function amount(): Money
    {
        return $this->amount;
    }

    public function side(): DebitCredit
    {
        return $this->side;
    }

    public function signedAmount(): int
    {
        return $this->side === DebitCredit::DEBIT
            ? $this->amount->value()
            : -$this->amount->value();
    }
}
