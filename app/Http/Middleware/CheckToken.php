<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckToken
{
    public function handle(Request $request, Closure $next)
    {
        // 檢查 session 中的 token
        $sessionToken = session('token');

        // 從請求頭獲取 Bearer token
        $bearerToken = $request->bearerToken();

        // 從請求頭獲取一般 Authorization
        $headerToken = $request->header('Authorization');

        // 如果都沒有 token，返回未授權
        if (!$sessionToken && !$bearerToken && !$headerToken) {
            return response()->json([
                'code' => '01',
                'msg' => '未授權的請求'
            ], 401);
        }

        // 如果有 Bearer token，去掉 'Bearer ' 前綴
        if ($bearerToken) {
            $token = str_replace('Bearer ', '', $bearerToken);
        } elseif ($headerToken) {
            $token = str_replace('Bearer ', '', $headerToken);
        } else {
            $token = $sessionToken;
        }

        // 將 token 存入 request 中，以便後續使用
        $request->merge(['auth_token' => $token]);

        return $next($request);
    }
}
