<?php

namespace App\Services;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentService
{
    //
    public function getDepartments(Request $request):array{
        $page = $request->get('page',1);
        $limit = $request->get('limit',10);
        $departments = Department::simplePaginate($limit, ['*'], 'page', $page);
        
        return $departments->toArray();
    }

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
