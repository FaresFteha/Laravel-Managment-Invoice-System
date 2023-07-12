<?php
namespace App\Http\Controllers\API\Traits;

trait ApiResponseTrait
{

    public function apiResponse($data = null, $message = null, $status = null)
    {

        $array = [
            'data' => $data,
            'message_response' => $message,
            'status' => $status
        ];
        return response($array);
    }
}
