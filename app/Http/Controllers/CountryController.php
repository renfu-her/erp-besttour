<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * 顯示國家列表
     */
    public function index()
    {
        $response = $this->apiService->authenticatedRequest('GET', '/information/country');
        $data = $response->json();

        if ($data['code'] === '00') {
            return view('country.index', [
                'countries' => $data['data']
            ]);
        }

        return back()->with('error', $data['msg']);
    }

    /**
     * 顯示新增國家表單
     */
    public function create()
    {
        // 獲取大洲列表供選擇
        $continentResponse = $this->apiService->authenticatedRequest('GET', '/information/continent');
        $continentData = $continentResponse->json();

        return view('country.form', [
            'continents' => $continentData['code'] === '00' ? $continentData['data'] : []
        ]);
    }

    /**
     * 儲存新國家
     */
    public function store(Request $request)
    {
        $response = $this->apiService->authenticatedRequest('POST', '/information/country', [
            'continent_id' => $request->continent_id,
            'name' => $request->name,
            'en_name' => $request->en_name,
            'code3' => $request->code3,
            'tel_area' => $request->tel_area
        ]);

        $data = $response->json();

        if ($data['code'] === '00') {
            return redirect()->route('country.index')
                ->with('success', '新增成功');
        }

        return back()->withInput()
            ->withErrors(['error' => $data['msg']]);
    }

    /**
     * 顯示編輯國家表單
     */
    public function edit($id)
    {
        $response = $this->apiService->authenticatedRequest('GET', "/information/country/{$id}");
        $continentResponse = $this->apiService->authenticatedRequest('GET', '/information/continent');

        $data = $response->json();
        $continentData = $continentResponse->json();

        if ($data['code'] === '00') {
            return view('country.form', [
                'country' => $data['data'],
                'continents' => $continentData['code'] === '00' ? $continentData['data'] : []
            ]);
        }

        return back()->with('error', $data['msg']);
    }

    /**
     * 更新國家資料
     */
    public function update(Request $request, $id)
    {
        $response = $this->apiService->authenticatedRequest('PUT', "/information/country/{$id}", [
            'continent_id' => $request->continent_id,
            'name' => $request->name,
            'en_name' => $request->en_name,
            'code3' => $request->code3,
            'tel_area' => $request->tel_area
        ]);

        $data = $response->json();

        if ($data['code'] === '00') {
            return redirect()->route('country.index')
                ->with('success', '更新成功');
        }

        return back()->withInput()
            ->withErrors(['error' => $data['msg']]);
    }

    /**
     * 刪除國家
     */
    public function destroy($id)
    {
        $response = $this->apiService->authenticatedRequest('DELETE', "/information/country/{$id}");
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
