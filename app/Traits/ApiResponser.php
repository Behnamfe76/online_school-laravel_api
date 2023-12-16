<?php

namespace App\Traits;

trait ApiResponser
{
    public function successResponse($data =  null, $message = null, $code = null)
    {
        return response()->json([
            'status' => 'success',
            'message' => $message,
            'data' => $data
        ], $code);
    }
    public function errorResponse($message = null, $code = null)
    {
        return response()->json([
            'status' => 'error',
            'message' => $message,
        ], $code);
    }
}
