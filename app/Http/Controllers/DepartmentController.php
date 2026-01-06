<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Http\Requests\StoreDepartmentRequest;
use App\Services\DepartmentService;
use App\Http\Requests\UpdateDepartmentRequest;

class DepartmentController extends Controller
{
    protected $departmentService;
    
    public function __construct(DepartmentService $departmentService)
    {
        $this->departmentService = $departmentService;
    }
    
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        return $this->departmentService->getDepartments($request);
    }

    /**
     * Store a newly created resource in storage.
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
