<?php

namespace App\Interfaces\Http\Resources;

use App\Domain\User\Entities\User;
use App\Interfaces\Http\Resources\Core\BaseResource;
use Illuminate\Http\Request;

class UserResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     *
     * @property User $resource
     */
    public function toArray(Request $request): array
    {
        return $this->map([
            'id' => $this->resource->id(),
            'name' => $this->resource->name(),
            'email' => $this->resource->email(),
        ]);
    }
}
