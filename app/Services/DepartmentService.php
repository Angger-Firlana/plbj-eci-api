<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentService
{
    //
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function getDepartments(Request $request):array{
        $page = $request->get('page',1);
        $limit = $request->get('limit',10);
        $departments = Department::simplePaginate($limit, ['*'], 'page', $page);
        
        return $departments->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function getDepartment($id):array{
        $department = Department::find($id);
        if(!$department){
            return [
                'message' => 'Department not found',
                'code' => 404
            ];
        }
        return [
            'message' => 'Department found',
            'code' => 200,
            'data' => $department
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return array
     */
    public function create(array $data):array{
        $department = Department::create([
            'name' => $data['name'],
            'code' => $data['code'],
            'description' => $data['description']
        ]);

        if(!$department){
            return [
                'message' => 'Department not created',
                'code' => 500
            ];
        }

        return [
            'message' => 'Department created successfully',
            'code' => 201,
            'data' => $department
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  array  $data
     * @return array
     */
    public function update($id, array $data):array{
        $department = Department::find($id);
        if(!$department){
            return [
                'message' => 'Department not found',
                'code' => 404
            ];
        }

        $department->update([
            'name' => $data['name'],
            'code' => $data['code'],
            'description' => $data['description']
        ]);

        return [
            'message' => 'Department updated successfully',
            'code' => 200,
            'data' => $department
        ];
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function delete($id):array{
        $department = Department::find($id);
        if(!$department){
            return [
                'message' => 'Department not found',
                'code' => 404
            ];
        }

        $department->delete();

        return [
            'message' => 'Department deleted successfully',
            'code' => 200
        ];
    }
}
