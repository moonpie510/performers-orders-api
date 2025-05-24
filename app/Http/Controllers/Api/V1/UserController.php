<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Domains\User\DTOs\LoginUserDto;
use Domains\User\DTOs\RegisterUserDto;
use Domains\User\Models\User;
use Domains\User\Repositories\UserRepositoryInterface;
use Domains\User\Requests\LoginUserRequest;
use Domains\User\Requests\RegisterUserRequest;
use Domains\User\Resources\UserSessionResource;
use Domains\User\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
        private readonly UserRepositoryInterface $userRepository,
    )
    {}

    public function login(LoginUserRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->login(LoginUserDto::fromRequest($request));
            return $this->successResponse(['token' => $user->createToken(User::TOKEN_NAME)->accessToken]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {
        try {
            $user = $this->userRepository->register(RegisterUserDto::fromRequest($request));
            return $this->successResponse(['token' => $user->createToken(User::TOKEN_NAME)->accessToken]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function logout(): JsonResponse
    {
        try {
            $this->userService->logout();
            return $this->successResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function index(): AnonymousResourceCollection|JsonResponse
    {
        try {
            $sessions = $this->userService->getActiveSessions();
            return UserSessionResource::collection($sessions);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function delete(string $id): JsonResponse
    {
        try {
            $this->userService->closeSession($id);
            return $this->successResponse();
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }
}
