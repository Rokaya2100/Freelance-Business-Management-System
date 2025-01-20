<?php
namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait jsonTrait{
    /**
     * Summary of jsonResponse
     * @param int $status
     * @param mixed $message
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function jsonResponse(int $status=200,$message='success',$data=null): JsonResponse{
        return response()->json([
            'status'=>$status,
            'message'=>$message,
            'data'=>$data
        ]);
    }
    /**
     * Summary of errorResponse
     * @param int $code
     * @param mixed $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function errorResponse(int $code = 404,$message = 'Faild'): JsonResponse {
        return response()->json(
            [
                'Code' => $code,
                'Message' => $message,
            ],
        );
    }
}
?>
