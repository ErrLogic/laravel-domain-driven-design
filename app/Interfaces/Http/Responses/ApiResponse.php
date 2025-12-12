<?php

namespace App\Interfaces\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

class ApiResponse
{
    public static function success(
        string $message,
        mixed $data = null,
        ?array $meta = null,
        int $status = 200
    ): JsonResponse {

        if ($data instanceof JsonResource) {
            $resolved = $data->toArray(request());

            $resourceMeta = method_exists($data, 'with')
                ? $data->with(request())
                : [];

            $finalMeta = array_merge($resourceMeta['meta'] ?? [], $meta ?? []);

            $final = [
                'success' => true,
                'message' => $message,
                'data' => $resolved,
                'meta' => $finalMeta,
            ];

            return response()->json($final, $status);
        }

        return response()->json([
            'success' => true,
            'message' => $message,
            'data' => $data,
            'meta' => $meta,
        ], $status);
    }

    public static function error(
        string $message,
        mixed $errors = null,
        int $status = 400
    ): JsonResponse {

        if ($errors instanceof JsonResource) {

            $resolved = $errors->toArray(request());

            $resourceMeta = method_exists($errors, 'with')
                ? $errors->with(request())
                : [];

            $final = [
                'success' => false,
                'message' => $message,
                'errors' => $resolved,
            ];

            if (! empty($resourceMeta['meta'])) {
                $final['meta'] = $resourceMeta['meta'];
            }

            return response()->json($final, $status);
        }

        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}
