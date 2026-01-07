<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Services\DepartmentService;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    /**
     * The department service instance.
     *
     * @var \App\Services\DepartmentService
     */
    protected $departmentService;
    
    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\DepartmentService  $departmentService
     * @return void
     */
    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }
    
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        //
        return $this->departmentService->getDepartments($request);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreDepartmentRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreDepartmentRequest $request)
    {
        //
        $data = $this->departmentService->create($request->validated());
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }
        
        return response()->json($data, $data['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(string $id)
    {
        //
        $data = $this->departmentService->getDepartment($id);
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }
        return response()->json($data, $data['code']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, string $id)
    {
        //
        $data = $this->departmentService->update($id, $request->all());
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }
        return response()->json($data, $data['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(string $id)
    {
        //
        $data = $this->departmentService->delete($id);
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }
        return response()->json($data, $data['code']);
    }
}
