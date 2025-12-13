<?php

namespace App\Application\User\UseCases;

use App\Application\Security\PasswordHasher;
use App\Application\User\DTO\CreateUserDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\ValueObjects\UserEmail;
use App\Domain\User\ValueObjects\UserName;

readonly class CreateUserHandler
{
    public function __construct(
        private UserRepositoryInterface $users,
        private PasswordHasher $hasher
    ) {}

    public function handle(CreateUserDTO $dto): User
    {
        $user = User::create(
            new UserName($dto->name),
            new UserEmail($dto->email),
            $this->hasher->hash($dto->password),
        );

        return $this->users->save($user);
    }
}
