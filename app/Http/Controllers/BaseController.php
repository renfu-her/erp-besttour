<?php

namespace App\Http\Controllers;

class BaseController extends Controller
{
    protected function successResponse($data = [], $message = 'OK', $code = '00')
    {
        return response()->json([
            'code' => $code,
            'msg' => $message,
            'data' => $data
        ]);
    }

    protected function errorResponse($message = 'Error', $code = '01')
    {
        return response()->json([
            'code' => $code,
            'msg' => $message
        ]);
    }
}
