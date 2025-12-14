<?php

namespace App\Application\Auth\DTO;

readonly class LoginUserDTO
{
    public function __construct(
        public string $email,
        public string $password
    ) {}

    public static function fromRequest($request): self
    {
        return new self(
            email: $request->input('email'),
            password: $request->input('password'),
        );
    }
}
