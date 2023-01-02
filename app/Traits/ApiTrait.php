<?php

namespace App\Traits;

Trait ApiTrait
{
    public function successResponse(string $message,array $data = [],int $statusCode = 200)
    {
        return response()->json(
            [
                "success" => true,
                "message" => $message,
                "data" => (object)$data,
                "errors" => (object)[]
            ],
            $statusCode
        );
    }
    public function errorResponse(array $errors = [], string $message = "", int $statusCode = 422)
    {
        return response()->json(
            [
                "success" => false,
                "message" => $message,
                "data" => (object)[],
                "errors" => (object)$errors
            ],
            $statusCode
        );
    }
    public function dataResponse(array $data = [], string $message = "", int $statusCode = 200)
    {
        return response()->json(
            [
                "success" => true,
                "message" => $message,
                "data" => (object)$data,
                "errors" => (object)[]
            ],
            $statusCode
        );
    }
}
