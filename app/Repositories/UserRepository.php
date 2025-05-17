<?php

namespace App\Repositories;

use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Laravel\Passport\Token;

class UserRepository implements UserRepositoryInterface
{
    public function getUserByEmail(string $email): ?User
    {
        return User::query()->where('email', $email)->first();
    }

    public function getSessionById(User $user, string $id): ?Token
    {
        return $user->tokens()->where('id', $id)->first();
    }
}
