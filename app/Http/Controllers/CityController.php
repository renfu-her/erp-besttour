<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class CityController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * 顯示城市列表
     */
    public function index()
    {
        $response = $this->apiService->authenticatedRequest('GET', '/information/city');
        $data = $response->json();

        if ($data['code'] === '00') {
            return view('city.index', [
                'cities' => $data['data']
            ]);
        }

        return back()->with('error', $data['msg']);
    }

    /**
     * 顯示新增城市表單
     */
    public function create()
    {
        // 獲取國家列表供選擇
        $countryResponse = $this->apiService->authenticatedRequest('GET', '/information/country');
        $countryData = $countryResponse->json();

        return view('city.form', [
            'countries' => $countryData['code'] === '00' ? $countryData['data'] : []
        ]);
    }

    /**
     * 儲存新城市
     */
    public function store(Request $request)
    {
        $response = $this->apiService->authenticatedRequest('POST', '/information/city', [
            'country_id' => $request->country_id,
            'name' => $request->name,
            'en_name' => $request->en_name,
            'code' => $request->code,
            'use' => $request->use,
            'state_id' => 1,  // 預設值
            'state_zone_id' => 1  // 預設值
        ]);

        $data = $response->json();

        if ($data['code'] === '00') {
            return redirect()->route('city.index')
                ->with('success', '新增成功');
        }

        return back()->withInput()
            ->withErrors(['error' => $data['msg']]);
    }

    /**
     * 顯示編輯城市表單
     */
    public function edit($id)
    {
        $response = $this->apiService->authenticatedRequest('GET', "/information/city/{$id}");
        $countryResponse = $this->apiService->authenticatedRequest('GET', '/information/country');

        $data = $response->json();
        $countryData = $countryResponse->json();

        if ($data['code'] === '00') {
            return view('city.form', [
                'city' => $data['data'],
                'countries' => $countryData['code'] === '00' ? $countryData['data'] : []
            ]);
        }

        return back()->with('error', $data['msg']);
    }

    /**
     * 更新城市資料
     */
    public function update(Request $request, $id)
    {
        $response = $this->apiService->authenticatedRequest('PUT', "/information/city/{$id}", [
            'country_id' => $request->country_id,
            'name' => $request->name,
            'en_name' => $request->en_name,
            'code' => $request->code,
            'use' => $request->use,
            'state_id' => 1,  // 預設值
            'state_zone_id' => 1  // 預設值
        ]);

        $data = $response->json();

        if ($data['code'] === '00') {
            return redirect()->route('city.index')
                ->with('success', '更新成功');
        }

        return back()->withInput()
            ->withErrors(['error' => $data['msg']]);
    }

    /**
     * 刪除城市
     */
    public function destroy($id)
    {
        $response = $this->apiService->authenticatedRequest('DELETE', "/information/city/{$id}");
        $data = $response->json();

        if ($data['code'] === '00') {
            return response()->json([
                'code' => '00',
                'msg' => '刪除成功'
            ]);
        }

        return response()->json([
            'code' => '01',
            'msg' => $data['msg']
        ]);
    }
}
