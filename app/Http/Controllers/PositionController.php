<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePositionRequest;
use App\Http\Requests\UpdatePositionRequest;
use App\Models\Position;
use App\Services\PositionService;
use Illuminate\Http\Request;

class PositionController extends Controller
{
    protected $positionService;
    
    public function __construct(PositionService $positionService)
    {
        $this->positionService = $positionService;
    }
    
    //
    public function index(Request $request)
    {
        $data = $this->positionService->index($request);
        return response()->json($data);
    }
    
    //
    public function store(StorePositionRequest $request)
    {
        $data = $this->positionService->store($request->validated());
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }
        
        return response()->json($data, 201);
    }
    
    //
    public function show($id)
    {
        //
        $data = $this->positionService->show($id);
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }
        
        return response()->json($data, 201);
    }
    
    //
    public function update(UpdatePositionRequest $request, $id  )
    {
        //
        $data = $this->positionService->update($id, $request->validated());
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }
        
        return response()->json($data, 201);
    }
    
    //
    public function destroy($id)
    {
        //
        $data = $this->positionService->destroy($id);
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }
        
        return response()->json($data, 201);
    }
}
