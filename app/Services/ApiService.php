<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://api-dev.besttour.com.tw/api';
    }

    /**
     * 發送登入請求
     */
    public function login($id, $password)
    {
        return Http::withoutVerifying()->post($this->baseUrl . '/auth/login', [
            'id' => $id,
            'pw' => $password
        ]);
    }

    /**
     * 發送請求時帶上 token
     */
    protected function withToken($token)
    {
        return Http::withoutVerifying()->withToken($token);
    }

    /**
     * 取得已認證的 HTTP 客戶端
     */
    protected function authenticatedHttp()
    {
        $token = session('token');
        return $this->withToken($token);
    }

    /**
     * 發送認證後的請求
     */
    public function authenticatedRequest($method, $endpoint, $data = [])
    {
        set_time_limit(0);
        $maxRetries = 3;  // 最大重試次數
        $retryDelay = 1000;  // 重試延遲（毫秒）
        $attempt = 0;

        while ($attempt < $maxRetries) {
            try {
                $http = $this->authenticatedHttp();

                $response = match (strtoupper($method)) {
                    'GET' => $http->timeout(60)->get($this->baseUrl . $endpoint, $data),
                    'POST' => $http->timeout(60)->post($this->baseUrl . $endpoint, $data),
                    'PUT' => $http->timeout(60)->put($this->baseUrl . $endpoint, $data),
                    'DELETE' => $http->timeout(60)->delete($this->baseUrl . $endpoint, $data),
                    default => throw new \InvalidArgumentException('不支援的 HTTP 方法'),
                };

                return $response;
            } catch (\Exception $e) {
                $attempt++;

                // 如果是最後一次嘗試，拋出異常
                if ($attempt === $maxRetries) {
                    if (str_contains($e->getMessage(), 'Operation timed out')) {
                        return response()->json([
                            'code' => '99',
                            'msg' => '連線逾時，請稍後再試'
                        ]);
                    }
                    return response()->json([
                        'code' => '99',
                        'msg' => '系統錯誤，請稍後再試'
                    ]);
                }

                // 等待一段時間後重試
                usleep($retryDelay * 1000);
                // 每次重試增加延遲時間
                $retryDelay *= 2;
            }
        }
    }

    public function formatCountryCode($twoCode, $threeCode)
    {
        return [
            'two' => $twoCode,
            'three' => $threeCode
        ];
    }

    public function validateCountryData($request)
    {
        return $request->validate([
            'continent_id' => 'required|exists:continents,id',
            'name' => 'required|string|max:255',
            'en_name' => 'required|string|max:255',
            'code3' => 'required|string|size:3|unique:countries,code_three',
            'tel_area' => 'required|string|max:10'
        ]);
    }
}
