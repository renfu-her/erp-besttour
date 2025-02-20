<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $response = Http::post('https://api-dev.hsihung.com.tw/api/auth/login', [
                'id' => $request->id,
                'pw' => $request->pw
            ]);

            $data = $response->json();

            if ($data['code'] === '00') {
                // 登入成功，儲存 token 到 session
                session(['token' => $data['data']['token']]);
                return redirect()->route('dashboard');
            }

            return back()->with('error', '登入失敗：' . $data['msg']);
        } catch (\Exception $e) {
            return back()->with('error', '登入失敗：系統錯誤');
        }
    }
} 