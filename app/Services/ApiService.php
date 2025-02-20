<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class ApiService
{
    protected $baseUrl;

    public function __construct()
    {
        $this->baseUrl = 'https://api-dev.hsihung.com.tw/api';
    }

    /**
     * 發送登入請求
     */
    public function login($id, $password)
    {
        return Http::post($this->baseUrl . '/auth/login', [
            'id' => $id,
            'pw' => $password
        ]);
    }

    /**
     * 發送請求時帶上 token
     */
    protected function withToken($token)
    {
        return Http::withToken($token);
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
        $http = $this->authenticatedHttp();
        
        return match (strtoupper($method)) {
            'GET' => $http->get($this->baseUrl . $endpoint, $data),
            'POST' => $http->post($this->baseUrl . $endpoint, $data),
            'PUT' => $http->put($this->baseUrl . $endpoint, $data),
            'DELETE' => $http->delete($this->baseUrl . $endpoint, $data),
            default => throw new \InvalidArgumentException('不支援的 HTTP 方法'),
        };
    }
} 