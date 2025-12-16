<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $id
 * @property-read string $date
 * @property-read string $description
 */
class JournalEntry extends Model
{
    use HasUuids;

    protected $fillable = [
        'date',
        'description',
    ];

    protected function cast(): array
    {
        return [
            'date' => 'date',
            'description' => 'string',
        ];
    }
}
