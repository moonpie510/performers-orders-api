<?php

namespace Domains\User\Services;

use App\Exceptions\AuthException;
use Domains\User\DTOs\LoginUserDto;
use Domains\User\Models\User;
use Domains\User\Repositories\UserRepositoryInterface;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Collection;

readonly class UserService
{
    public function __construct(
        private UserRepositoryInterface $userRepository
    )
    {}

    public function login(LoginUserDto $dto): User
    {
        $user = $this->userRepository->getByEmail($dto->email);

        if (!password_verify($dto->password, $user->password)) {
            throw AuthException::wrongCredentials();
        }

        return $user;
    }

    public function logout(): void
    {
        /** @var User $user */
        $user = $this->getAuthUser();

        $user->tokens()->delete();
    }

    public function getActiveSessions(): Collection
    {
        /** @var User $user */
        $user = $this->getAuthUser();

        return $this->userRepository->getActiveSessions($user);
    }

    public function closeSession(string $id): void
    {
        /** @var User $user */
        $user = $this->getAuthUser();

        $session = $this->userRepository->getSessionById($user, $id);

        $session->revoke();
    }

    public function getAuthUser(): Authenticatable|User
    {
        $user = auth('api')->user();

        if (!$user) {
            throw AuthException::notAuthorized();
        }

        return $user;
    }
}
