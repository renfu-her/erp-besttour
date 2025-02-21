<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ApiService;

class AuthController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // try {
        $response = $this->apiService->login($request->id, $request->pw);

        if ($response->successful()) {
            $data = $response->json();
            if ($data['code'] === '00') {
                // 確保將 token 存入 session
                session(['token' => $data['data']['token']]);
                return redirect()->route('dashboard');
            }
        }

        return back()->with('error', '登入失敗');
        // } catch (\Exception $e) {
        //     return back()->with('error', '登入失敗：系統錯誤');
        // }
    }

    public function logout()
    {
        session()->forget('token');
        return redirect()->route('login');
    }
}
