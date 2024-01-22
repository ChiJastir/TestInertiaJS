<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait HasJsonResponse
{
    public function success($data = []): JsonResponse
    {
        return new JsonResponse([
            'data' => $data,
            'success' => true
        ]);
    }

    public function failure(string $error, $data = []): JsonResponse
    {
        return new JsonResponse([
            'data' => $data,
            'success' => true,
            'error' => $error
        ]);
    }
}