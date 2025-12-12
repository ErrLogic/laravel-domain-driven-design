<?php

namespace App\Interfaces\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseResource extends JsonResource
{
    /**
     * Unwrap ValueObjects automatically.
     */
    protected function unwrap(mixed $value): mixed
    {
        if (is_object($value) && method_exists($value, 'value')) {
            return $value->value();
        }

        return $value;
    }

    protected function map(array $fields): array
    {
        $result = [];

        foreach ($fields as $key => $value) {
            if (is_array($value)) {
                $result[$key] = $this->map($value);
            } else {
                $result[$key] = $this->unwrap($value);
            }
        }

        return $result;
    }
}
