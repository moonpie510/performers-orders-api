<?php

namespace App\Services;

use App\DTOs\User\LoginDto;
use App\DTOs\User\RegisterDto;
use App\Exceptions\AuthException;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;

readonly class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    )
    {}

    public function login(LoginDto $dto): User
    {
        $user = $this->userRepository->getUserByEmail($dto->email);

        if (!$user || !password_verify($dto->password, $user->password)) {
            throw AuthException::wrongCredentials();
        }

        return $user;
    }

    public function register(RegisterDto $dto): User
    {
        return User::query()->create([
            'name' => $dto->name,
            'email' => $dto->email,
            'password' => $dto->password,
        ]);
    }

    public function logout(): void
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user) {
            throw AuthException::notAuthorized();
        }

        $user->tokens()->delete();
    }

    public function getActiveSessions(): Collection
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user) {
            throw AuthException::notAuthorized();
        }

        return $user->tokens()
            ->where('revoked', false)
            ->where('expires_at', '>', now())
            ->get();
    }

    public function closeSession(string $id): void
    {
        /** @var User $user */
        $user = auth()->user();

        if (!$user) {
            throw AuthException::notAuthorized();
        }

        $session = $this->userRepository->getSessionById($user, $id);

        if (!$session) {
            throw AuthException::sessionNotFound();
        }

        $session->revoke();
    }
}
