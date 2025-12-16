<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $id
 * @property-read string $account_id
 * @property-read string $period
 * @property-read integer $balance
 */

class LedgerBalance extends Model
{
    use HasUuids;

    protected $fillable = [
        'account_id',
        'period',
        'balance'
    ];

    protected function cast(): array
    {
        return [
            'account_id' => 'string',
            'period' => 'date',
            'balance' => 'integer'
        ];
    }
}
