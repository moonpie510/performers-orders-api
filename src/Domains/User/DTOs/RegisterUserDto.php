<?php

namespace Domains\User\DTOs;

use Illuminate\Http\Request;

readonly class RegisterUserDto
{
    private function __construct(
        public string $name,
        public string $email,
        public string $password,
        public int $partnershipId
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->name,
            email: $request->email,
            password: $request->password,
            partnershipId: $request->partnership_id
        );
    }
}
