<?php

namespace App\Application\User\DTO;

readonly class UpdateUserDTO
{
    public function __construct(
        public string $id,
        public ?string $name,
        public ?string $email,
        public ?string $password,
    ) {}

    public static function fromRequest($request, string $id): self
    {
        return new self(
            id: $id,
            name: $request->input('name'),
            email: $request->input('email'),
            password: $request->input('password'),
        );
    }
}
