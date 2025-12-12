<?php

namespace App\Application\User\UseCases;

use App\Domain\User\Exceptions\UserNotFoundException;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\ValueObjects\UserId;

readonly class DeleteUserHandler
{
    public function __construct(
        private UserRepositoryInterface $users
    ) {}

    public function handle(string $id): void
    {
        $userId = new UserId($id);

        $user = $this->users->findById($userId);

        if (! $user) {
            throw new UserNotFoundException("User with ID $id not found");
        }

        $this->users->delete($userId);
    }
}
