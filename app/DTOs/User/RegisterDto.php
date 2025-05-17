<?php

namespace App\DTOs\User;

use Illuminate\Http\Request;

readonly class RegisterDto
{
    private function __construct(
        public string $name,
        public string $email,
        public string $password,
    )
    {}

    public static function fromRequest(Request $request): self
    {
        return new self(
            name: $request->name,
            email: $request->email,
            password: $request->password,
        );
    }
}
