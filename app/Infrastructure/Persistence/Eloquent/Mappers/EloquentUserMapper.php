<?php

namespace App\Infrastructure\Persistence\Eloquent\Mappers;

use App\Domain\User\Entities\User;
use App\Domain\User\ValueObjects\UserEmail;
use App\Domain\User\ValueObjects\UserId;
use App\Domain\User\ValueObjects\UserName;
use App\Infrastructure\Persistence\Eloquent\Models\UserModel;

class EloquentUserMapper
{
    public static function toDomain(UserModel $model): User
    {
        return new User(
            id: new UserId($model->id),
            name: new UserName($model->name),
            email: new UserEmail($model->email),
            password: $model->password,
        );
    }
}
