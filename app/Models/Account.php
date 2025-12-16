<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

/**
 * @property-read string $id
 * @property-read null|string $parent_id
 * @property-read string $code
 * @property-read string $name
 * @property-read string $type
 * @property-read boolean $is_postable
 * @property-read boolean $is_control
 */
class Account extends Model
{
    use HasUuids;

    protected $fillable = [
        'parent_id',
        'code',
        'name',
        'type',
        'is_postable',
        'is_control'
    ];

    protected function cast(): array
    {
        return [
            'parent_id' => 'string',
            'code' => 'string',
            'name' => 'string',
            'type' => 'string',
            'is_postable' => 'boolean',
            'is_control' => 'boolean',
        ];
    }
}
