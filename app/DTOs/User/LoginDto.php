<?php

namespace App\DTOs\User;

use Illuminate\Http\Request;

readonly class LoginDto
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
