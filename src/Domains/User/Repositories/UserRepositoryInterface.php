<?php

namespace Domains\User\Repositories;

use Domains\User\DTOs\RegisterUserDto;
use Domains\User\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Passport\Token;

interface UserRepositoryInterface
{
    public function getByEmail(string $email): User;
    public function register(RegisterUserDto $dto): User;
    public function getActiveSessions(User $user): Collection;
    public function getSessionById(User $user, string $id): Token;
}
