<?php

namespace App\Http\Traits;


trait ApiResponseTrait
{


    public function apiResponse($data, $message, $status = 200)
    {
        $responseData = [
            'data' => $data,
            'message' => $message,
            'status' => $status,
        ];


        return response($responseData, $status);
    }
}
