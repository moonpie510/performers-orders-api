<?php

namespace Domains\User\Repositories;

use App\Exceptions\AuthException;
use Domains\User\DTOs\RegisterUserDto;
use Domains\User\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Laravel\Passport\Token;

class UserRepository implements UserRepositoryInterface
{
    public function getByEmail(string $email): User
    {
        $user = User::query()->where('email', $email)->first();

        if (!$user) {
            throw AuthException::wrongCredentials();
        }

        return $user;
    }

    public function getSessionById(User $user, string $id): Token
    {
        $session = $user->tokens()->where('id', $id)->first();

        if (!$session) {
            throw AuthException::sessionNotFound();
        }

        return $session;
    }

    public function register(RegisterUserDto $dto): User
    {
        return User::query()->create([
            'partnership_id' => $dto->partnershipId,
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
        ]);
    }

    public function getActiveSessions(User $user): Collection
    {
        return $user->tokens()
            ->where('revoked', false)
            ->where('expires_at', '>', now())
            ->get();
    }
}
