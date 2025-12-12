<?php

namespace App\Infrastructure\Persistence\Eloquent\Repositories;

use App\Domain\User\Entities\User as DomainUser;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\ValueObjects\UserEmail;
use App\Domain\User\ValueObjects\UserId;
use App\Domain\User\ValueObjects\UserName;
use App\Infrastructure\Persistence\Eloquent\Models\UserModel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class EloquentUserRepository implements UserRepositoryInterface
{
    public function save(DomainUser $user): DomainUser
    {
        if ($user->id() === null) {
            $model = UserModel::create([
                'name' => $user->name()->value(),
                'email' => $user->email()->value(),
                'password' => $user->password(),
            ]);

            return $user->withId(new UserId($model->id));
        }

        $model = UserModel::findOrFail($user->id()->value());
        $model->update([
            'name' => $user->name()->value(),
            'email' => $user->email()->value(),
            'password' => $user->password(),
        ]);

        return $user;
    }

    public function findById(UserId $id): ?DomainUser
    {
        $model = UserModel::find($id->value());

        if (! $model) {
            return null;
        }

        return new DomainUser(
            new UserId($model->id),
            new UserName($model->name),
            new UserEmail($model->email),
            $model->password,
        );
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return UserModel::paginate($perPage);
    }

    public function delete(UserId $id): void
    {
        $model = UserModel::find($id->value());

        $model?->delete();
    }
}
