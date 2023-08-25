<?php

namespace Omotolaawokunle\ExchangeRate\Http\Responses;

use Illuminate\Http\JsonResponse;

class ExchangeRateResponse
{
    /**
     * @param  array<string|int|bool|float|array|object> $data
     * @param  array<string> $headers
     */
    public static function success(
        array $data,
        int $statusCode = 200,
        array $headers = []
    ): JsonResponse {
        return response()->json([
            'success' => 1,
            'data' => $data,
            'error' => "",
            'errors' => [],
        ], $statusCode, $headers);
    }

    /**
     * Return error response
     * @param  array<string|array|int|bool|float> $errors
     * @param  array<string|array|int|bool|float|object> $data
     * @param  array<string> $headers
     * @return JsonResponse
     */
    public static function error(
        string $message,
        array $errors = [],
        array $data = [],
        int $statusCode = 400,
        array $headers = []
    ): JsonResponse {
        return response()->json([
            'success' => 0,
            'error' => $message,
            'errors' => $errors,
            'data' => $data,
        ], $statusCode, $headers);
    }
}
