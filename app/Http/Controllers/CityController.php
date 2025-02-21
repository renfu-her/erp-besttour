<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class CityController extends BaseController
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $response = $this->apiService->authenticatedRequest('GET', '/information/city');
        return response()->json($response->json());
    }
}
