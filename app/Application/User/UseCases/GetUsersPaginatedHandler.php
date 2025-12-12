<?php

namespace App\Application\User\UseCases;

use App\Domain\User\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

readonly class GetUsersPaginatedHandler
{
    public function __construct(
        private UserRepositoryInterface $users
    ) {}

    public function handle(int $perPage = 15): LengthAwarePaginator
    {
        return $this->users->paginate($perPage);
    }
}
