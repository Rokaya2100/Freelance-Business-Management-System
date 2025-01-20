<?php

namespace App\Http\Traits;

trait ApiResponseTrait
{
    /**
     * Summary of RevResponse
     * @param mixed $data
     * @param mixed $message
     * @param mixed $status
     * @return mixed|\Illuminate\Http\JsonResponse
     */
    public function RevResponse($data, $message, $status) {
        $array = [
            'data'=>$data,
            'message'=>$message
        ];

        return response()->json($array, $status);
    }
}
