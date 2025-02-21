<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class ContinentController extends BaseController
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $response = $this->apiService->authenticatedRequest('GET', '/information/continent');
        return response()->json($response->json());
    }

    public function store(Request $request)
    {
        $response = $this->apiService->authenticatedRequest('POST', '/information/continent', $request->all());
        return response()->json($response->json());
    }
}
