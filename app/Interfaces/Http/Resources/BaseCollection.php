<?php

namespace App\Interfaces\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

abstract class BaseCollection extends JsonResource
{
    abstract protected function mapper($model);

    abstract protected function resourceClass(): string;

    public function toArray($request): array
    {
        return $this->resource->getCollection()
            ->map(fn ($model) => (new ($this->resourceClass())($this->mapper($model)))->toArray($request))
            ->values()
            ->all();
    }

    public function with($request): array
    {
        $p = $this->resource;

        return [
            'meta' => [
                'total' => $p->total(),
                'count' => $p->count(),
                'per_page' => $p->perPage(),
                'current_page' => $p->currentPage(),
                'last_page' => $p->lastPage(),
            ],
        ];
    }
}
