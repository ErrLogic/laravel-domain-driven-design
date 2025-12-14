<?php

use App\Interfaces\Http\Middleware\ForceJsonResponse;
use App\Interfaces\Http\Responses\ApiResponse;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->append(middleware: ForceJsonResponse::class);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (Throwable $e, $request) {
            if ($request->is('api/*')) {
                $response = new ApiResponse;

                switch (true) {
                    case $e instanceof MethodNotAllowedHttpException:
                        return $response->error(
                            message: 'Method not allowed',
                            errors: ['method' => $request->method().' is not supported for this route'],
                            status: Response::HTTP_METHOD_NOT_ALLOWED
                        );

                    case $e instanceof RouteNotFoundException:
                    case $e instanceof ModelNotFoundException:
                    case $e instanceof NotFoundHttpException:
                        return $response->error(
                            message: 'Not found exception',
                            errors: $e->getMessage(),
                            status: Response::HTTP_NOT_FOUND
                        );

                    case $e instanceof ThrottleRequestsException:
                        return $response->error(
                            message: 'Too many requests',
                            errors: $e->getMessage(),
                            status: Response::HTTP_TOO_MANY_REQUESTS
                        );

                    case $e instanceof AuthenticationException:
                        return $response->error(
                            message: 'Unauthenticated',
                            status: Response::HTTP_UNAUTHORIZED
                        );

                    case $e instanceof AccessDeniedHttpException:
                        return $response->error(
                            message: 'Forbidden',
                            status: Response::HTTP_FORBIDDEN
                        );

                    case $e instanceof ValidationException:
                        return $response->error(
                            message: 'Validation error',
                            errors: $e->errors(),
                            status: Response::HTTP_UNPROCESSABLE_ENTITY
                        );

                    case $e instanceof ConnectionException:
                        return $response->error(
                            message: 'Connection error',
                            errors: $e->getMessage(),
                            status: Response::HTTP_REQUEST_TIMEOUT
                        );

                    case $e instanceof RequestException:
                        return $response->error(
                            message: 'Request error',
                            errors: ['body' => json_decode($e->response->body(), true) ?? $e->getMessage()],
                            status: $e->getCode()
                        );

                    case $e instanceof QueryException:
                        $message = config('app.debug')
                            ? $e->getMessage()
                            : 'Database error occurred';

                        return $response->error(
                            message: $message,
                            status: Response::HTTP_INTERNAL_SERVER_ERROR
                        );

                    case $e instanceof DomainException:
                        return $response->error(
                            message: $e->getMessage(),
                            status: $e->getCode() ?? Response::HTTP_UNPROCESSABLE_ENTITY
                        );

                    default:
                        $statusCode = method_exists($e, 'getStatusCode')
                            ? $e->getStatusCode()
                            : Response::HTTP_INTERNAL_SERVER_ERROR;

                        return $response->error(
                            message: config('app.debug') ? $e->getMessage() : 'Server error',
                            errors: config('app.debug') ? [
                                'exception' => get_class($e),
                                'file' => $e->getFile(),
                                'line' => $e->getLine(),
                                'trace' => $e->getTrace(),
                            ] : 'Internal server error occurred',
                            status: $statusCode
                        );
                }
            }

            return null;
        });

        $exceptions->report(function (QueryException $e) {
            logger()?->error(message: 'Database error: '.$e->getMessage());
        });
    })->create();
