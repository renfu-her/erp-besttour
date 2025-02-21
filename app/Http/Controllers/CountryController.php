<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class CountryController extends BaseController
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    public function index()
    {
        $response = $this->apiService->authenticatedRequest('GET', '/information/country');
        return response()->json($response->json());
    }

    public function store(Request $request)
    {
        $response = $this->apiService->authenticatedRequest('POST', '/information/country', [
            'continent_id' => $request->continent_id,
            'name' => $request->name,
            'en_name' => $request->en_name,
            'code3' => $request->code3,
            'tel_area' => $request->tel_area
        ]);
        return response()->json($response->json());
    }
}
