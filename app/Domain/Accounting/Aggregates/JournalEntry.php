<?php

namespace App\Domain\Accounting\Aggregates;

use App\Domain\Accounting\Exceptions\UnbalancedJournalException;
use App\Domain\Accounting\ValueObjects\JournalEntryId;
use App\Domain\Accounting\ValueObjects\JournalLine;

final class JournalEntry
{
    private array $lines = [];

    public function __construct(
        private JournalEntryId $id,
        private \DateTimeImmutable $date,
        private string $description
    ) {}

    public function addLine(JournalLine $line): void
    {
        $this->lines[] = $line;
    }

    public function assertBalanced(): void
    {
        $total = array_sum(
            array_map(fn (JournalLine $l) => $l->signedAmount(), $this->lines)
        );

        if ($total !== 0) {
            throw new UnbalancedJournalException();
        }
    }

    public function lines(): array
    {
        return $this->lines;
    }
}
