<?php

namespace App\Domain\User\Entities;

use App\Domain\User\ValueObjects\UserEmail;
use App\Domain\User\ValueObjects\UserId;
use App\Domain\User\ValueObjects\UserName;

final class User
{
    public function __construct(
        private ?UserId $id,
        private UserName $name,
        private UserEmail $email,
        private readonly string $password,
    ) {}

    public static function create(UserName $name, UserEmail $email, string $password): self
    {
        return new self(
            id: null,
            name: $name,
            email: $email,
            password: $password
        );
    }

    public function rename(UserName $name): self
    {
        $clone = clone $this;
        $clone->name = $name;

        return $clone;
    }

    public function changeEmail(UserEmail $email): self
    {
        $clone = clone $this;
        $clone->email = $email;

        return $clone;
    }

    public function withId(UserId $id): self
    {
        $clone = clone $this;
        $clone->id = $id;

        return $clone;
    }

    public function id(): ?UserId
    {
        return $this->id;
    }

    public function name(): UserName
    {
        return $this->name;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): string
    {
        return $this->password;
    }
}
