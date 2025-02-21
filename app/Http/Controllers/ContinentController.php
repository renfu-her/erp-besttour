<?php

namespace App\Http\Controllers;

use App\Services\ApiService;
use Illuminate\Http\Request;

class ContinentController extends Controller
{
    protected $apiService;

    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * 顯示大洲列表
     */
    public function index()
    {
        $response = $this->apiService->authenticatedRequest('GET', '/information/continent');
        $data = $response->json();

        if ($data['code'] === '00') {
            return view('continent.index', [
                'continents' => $data['data']
            ]);
        }

        return back()->with('error', $data['msg']);
    }

    /**
     * 顯示新增大洲表單
     */
    public function create()
    {
        return view('continent.form');
    }

    /**
     * 儲存新大洲
     */
    public function store(Request $request)
    {
        $response = $this->apiService->authenticatedRequest('POST', '/information/continent', [
            'code' => $request->code,
            'name' => $request->name,
            'en_name' => $request->en_name
        ]);

        $data = $response->json();

        if ($data['code'] === '00') {
            return redirect()->route('continent.index')
                ->with('success', '新增成功');
        }

        return back()->withInput()
            ->withErrors(['error' => $data['msg']]);
    }

    /**
     * 顯示編輯大洲表單
     */
    public function edit($id)
    {
        $response = $this->apiService->authenticatedRequest('GET', "/information/continent/{$id}");
        $data = $response->json();

        if ($data['code'] === '00') {
            return view('continent.form', [
                'continent' => $data['data']
            ]);
        }

        return back()->with('error', $data['msg']);
    }

    /**
     * 更新大洲資料
     */
    public function update(Request $request, $id)
    {
        $response = $this->apiService->authenticatedRequest('PUT', "/information/continent/{$id}", [
            'code' => $request->code,
            'name' => $request->name,
            'en_name' => $request->en_name
        ]);

        $data = $response->json();

        if ($data['code'] === '00') {
            return redirect()->route('continent.index')
                ->with('success', '更新成功');
        }

        return back()->withInput()
            ->withErrors(['error' => $data['msg']]);
    }

    /**
     * 刪除大洲
     */
    public function destroy($id)
    {
        $response = $this->apiService->authenticatedRequest('DELETE', "/information/continent/{$id}");
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
