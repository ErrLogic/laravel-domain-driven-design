<?php

namespace App\Application\Auth\UseCases;

use App\Application\Auth\Contracts\PasswordVerifier;
use App\Application\Auth\Contracts\TokenIssuer;
use App\Application\Auth\DTO\LoginUserDTO;
use App\Domain\User\Exceptions\InvalidCredentialsException;
use App\Domain\User\Repositories\UserRepositoryInterface;
use App\Domain\User\ValueObjects\UserEmail;

readonly class LoginUserHandler
{
    public function __construct(
        private UserRepositoryInterface $users,
        private PasswordVerifier $passwords,
        private TokenIssuer $tokens
    ) {}

    public function handle(LoginUserDTO $dto): string
    {
        $user = $this->users->findByEmail(new UserEmail($dto->email));

        if (! $user) {
            throw new InvalidCredentialsException;
        }

        if (! $this->passwords->verify(
            $dto->password,
            $user->password()
        )) {
            throw new InvalidCredentialsException;
        }

        return $this->tokens->issue($user->id()->value());
    }
}
