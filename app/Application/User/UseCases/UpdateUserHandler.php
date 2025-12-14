<?php

namespace App\Application\User\UseCases;

use App\Application\User\Contracts\PasswordHasher;
use App\Application\User\DTO\UpdateUserDTO;
use App\Domain\User\Entities\User;
use App\Domain\User\Exceptions\UserNotFoundException;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\ValueObjects\UserEmail;
use App\Domain\User\ValueObjects\UserId;
use App\Domain\User\ValueObjects\UserName;

readonly class UpdateUserHandler
{
    public function __construct(
        private UserRepositoryInterface $users,
        private PasswordHasher $hasher
    ) {}

    public function handle(UpdateUserDTO $dto): User
    {
        $user = $this->users->findById(new UserId($dto->id));

        if (! $user) {
            throw new UserNotFoundException;
        }

        if ($dto->name) {
            $user = $user->rename(new UserName($dto->name));
        }

        if ($dto->email) {
            $user = $user->changeEmail(new UserEmail($dto->email));
        }

        if ($dto->password) {
            $user = new User(
                $user->id(),
                $user->name(),
                $user->email(),
                $this->hasher->hash($dto->password),
            );
        }

        return $this->users->save($user);
    }
}
