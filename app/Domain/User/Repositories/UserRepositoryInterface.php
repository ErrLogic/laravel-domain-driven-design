<?php

namespace App\Domain\User\Repositories;

use App\Domain\User\Entities\User;
use App\Domain\User\ValueObjects\UserEmail;
use App\Domain\User\ValueObjects\UserId;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface UserRepositoryInterface
{
    public function save(User $user): User;

    public function findById(UserId $id): ?User;

    public function findByEmail(UserEmail $email): ?User;

    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function delete(UserId $id): void;
}
