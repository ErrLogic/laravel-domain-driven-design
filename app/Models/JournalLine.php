<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $id
 * @property-read string $journal_entry_id
 * @property-read string $account_id
 * @property-read integer $debit
 * @property-read integer $credit
 */
class JournalLine extends Model
{
    use HasUuids;

    protected $fillable = [
        'journal_entry_id',
        'account_id',
        'debit',
        'credit',
    ];

    protected function cast(): array
    {
        return [
            'journal_entry_id' => 'string',
            'account_id' => 'string',
            'debit' => 'integer',
            'credit' => 'integer',
        ];
    }
}
