<?php

namespace App\Interfaces\Http\Controllers;

use App\Application\User\DTO\CreateUserDTO;
use App\Application\User\DTO\UpdateUserDTO;
use App\Application\User\UseCases\CreateUserHandler;
use App\Application\User\UseCases\DeleteUserHandler;
use App\Application\User\UseCases\GetUserByIdHandler;
use App\Application\User\UseCases\GetUsersPaginatedHandler;
use App\Application\User\UseCases\UpdateUserHandler;
use App\Interfaces\Http\Requests\CreateUserRequest;
use App\Interfaces\Http\Requests\UpdateUserRequest;
use App\Interfaces\Http\Resources\UserCollection;
use App\Interfaces\Http\Resources\UserResource;
use App\Interfaces\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    public function store(CreateUserRequest $request, CreateUserHandler $handler): JsonResponse
    {
        $dto = CreateUserDTO::fromRequest($request);
        $user = $handler->handle($dto);

        return ApiResponse::success(
            message: 'User created successfully.',
            data: new UserResource($user),
            status: Response::HTTP_CREATED
        );
    }

    public function update(UpdateUserRequest $request, string $id, UpdateUserHandler $handler): JsonResponse
    {
        $dto = UpdateUserDTO::fromRequest($request, $id);

        $user = $handler->handle($dto);

        return ApiResponse::success(
            message: 'User updated successfully.',
            data: new UserResource($user),
            status: Response::HTTP_OK
        );
    }

    public function show(string $id, GetUserByIdHandler $handler): JsonResponse
    {
        $user = $handler->handle($id);

        return ApiResponse::success(
            message: 'User retrieved successfully.',
            data: new UserResource($user)
        );
    }

    public function index(Request $request, GetUsersPaginatedHandler $handler): JsonResponse
    {
        $perPage = $request->query('per_page', 15);

        $paginated = $handler->handle($perPage);

        return ApiResponse::success(
            message: 'Users retrieved successfully.',
            data: new UserCollection($paginated)
        );
    }

    public function destroy(string $id, DeleteUserHandler $handler): JsonResponse
    {
        $handler->handle($id);

        return ApiResponse::success(
            message: 'User deleted successfully.'
        );
    }
}
