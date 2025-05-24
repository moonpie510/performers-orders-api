<?php

namespace Domains\User\DTOs;

use Illuminate\Http\Request;

readonly class LoginUserDto
{
    private function __construct(
        public string $email,
        public string $password,
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            email: $request->email,
            password: $request->password,
        );
    }
}
