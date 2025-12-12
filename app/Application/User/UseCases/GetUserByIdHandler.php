<?php

namespace App\Application\User\UseCases;

use App\Domain\User\Entities\User;
use App\Domain\User\Exceptions\UserNotFoundException;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\ValueObjects\UserId;

readonly class GetUserByIdHandler
{
    public function __construct(
        private UserRepositoryInterface $users
    ) {}

    public function handle(string $id): User
    {
        $user = $this->users->findById(new UserId($id));

        if (! $user) {
            throw new UserNotFoundException;
        }

        return $user;
    }
}
