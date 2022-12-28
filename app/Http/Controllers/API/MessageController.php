<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Send response
     *
     * @param mixed $result
     * @param mixed $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function SendResponse($result, $message)
    {
        $response = [
            'success' => true,
            'data' => $result,
            'message'=> $message,
        ];
        return response()->json($response, 200);
    }
    /**
     * Error message
     *
     * @param mixed $error
     * @return \Illuminate\Http\JsonResponse
     */

    public function SendError($error)
    {
        $code= 404;
        $errorMessage= [];

        $response = [
            'succes' => false,
            'message' => $error,
        ];

        if(!empty($errorMessage)){
            $response['data'] =$errorMessage;
        }
        return response()->json($response, $code);
    }
}
