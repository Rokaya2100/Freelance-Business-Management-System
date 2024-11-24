<?php
namespace App\Http\Traits;
use Illuminate\Http\JsonResponse;

trait ApiResponse{
    protected function successResponse($data = null,$message = 'success',int $code = 200): JsonResponse {
        return response()->json(
            [
                'Data' => $data,
                'Message' => $message,
                'Code' => $code,
            ]
        );
    }
    protected function errorResponse($message = 'Faild',int $code = 404): JsonResponse {
        return response()->json(
            [
                'Message' => $message,
                'Code' => $code,
            ],
        );
    }


}

