<?php

namespace App\Interfaces\Http\Resources;

use App\Domain\User\Entities\User;
use App\Infrastructure\Persistence\Eloquent\Mappers\EloquentUserMapper;

class UserCollection extends BaseCollection
{
    protected function mapper($model): User
    {
        return EloquentUserMapper::toDomain($model);
    }

    protected function resourceClass(): string
    {
        return UserResource::class;
    }
}
