<?php
namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;

trait jsonTrait{
public function jsonResponse(int $status=200,$message='success',$data=null): JsonResponse{
    return response()->json([
        'status'=>$status,
        'message'=>$message,
        'data'=>$data
    ]);
}
}
?>
