<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->header('Authorization');

        if (!$token) {
            return response()->json([
                'code' => '01',
                'msg' => '未授權的請求'
            ], 401);
        }

        // 這裡可以添加更多的token驗證邏輯

        return $next($request);
    }
}
