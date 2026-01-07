<?php

namespace App\Services;

use App\Models\Position;
use Illuminate\Http\Request;

class PositionService
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function index(Request $request):array
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $positions = Position::query();

        if(isset($request->search)){
            $positions = $positions->where('name', 'like', '%' . $request->search . '%')->paginate($limit, ['*'], 'page', $page);
        }else{
            $positions = $positions->paginate($limit, ['*'], 'page', $page);
        }

        return $positions->toArray();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return array
     */
    public function show($id):array
    {
        $position = Position::find($id);
        if(!$position){
            return [
                'data' => null,
                'message' => 'Position not found',
                'code' => 404
            ];
        }
        return [
            'data' => $position->toArray(),
            'message' => 'Position found',
            'code' => 200
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  array  $data
     * @return array
     */
    public function store(array $data):array
    {
        $position = Position::create([
            'eci_job_id' => $data['eci_job_id'],
            'user_id' => $data['user_id']
        ]);
        
        if(!$position){
            return [
                'data' => null,
                'message' => 'Position not created',
                'code' => 500
            ];
        }
        return [
            'data' => $position->toArray(),
            'message' => 'Position created successfully',
            'code' => 201
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  array  $data
     * @return array
     */
    public function update($id, array $data):array
    {
        $position = Position::find($id);
        if(!$position){
            return [
                'data' => null,
                'message' => 'Position not found',
                'code' => 404
            ];
        }
        $position->update($data);
        return [
            'data' => $position->toArray(),
            'message' => 'Position updated successfully',
            'code' => 200
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return array
     */
    public function destroy($id):array
    {
        $position = Position::find($id);
        if(!$position){
            return [
                'data' => null,
                'message' => 'Position not found',
                'code' => 404
            ];
        }
        $position->delete();
        return [
            'data' => null,
            'message' => 'Position deleted successfully',
            'code' => 200
        ];
    }
}
