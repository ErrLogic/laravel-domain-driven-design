<?php

namespace App\Interfaces\Http\Controllers;

use App\Application\Auth\DTO\LoginUserDTO;
use App\Application\Auth\UseCases\LoginUserHandler;
use App\Interfaces\Http\Requests\LoginRequest;
use App\Interfaces\Http\Responses\ApiResponse;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
    public function login(LoginRequest $request, LoginUserHandler $handler): JsonResponse
    {
        $dto = LoginUserDTO::fromRequest($request);
        $token = $handler->handle($dto);

        return ApiResponse::success(
            message: 'User login successfully.',
            data: ['token' => $token],
            status: Response::HTTP_OK
        );
    }
}
