<?php

namespace App\Http\Controllers\Api\V1;

use App\DTOs\User\LoginDto;
use App\DTOs\User\RegisterDto;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\User\RegisterRequest;
use App\Http\Resources\SessionResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;


class UserController extends Controller
{
    public function __construct(
        private readonly UserService $userService,
    )
    {}

    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->login(LoginDto::fromRequest($request));
            return $this->successResponse(['token' => $user->createToken(User::TOKEN_NAME)->accessToken]);
        } catch (\Throwable $th) {
            return $this->errorResponse($th->getMessage());
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = $this->userService->register(RegisterDto::fromRequest($request));
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
            return SessionResource::collection($sessions);
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
