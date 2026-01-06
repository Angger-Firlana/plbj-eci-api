<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreStoreEciRequest;
use App\Http\Requests\UpdateStoreEciRequest;
use App\Services\StoreService;
use App\Models\Store;

class StoreController extends Controller
{
    //
    protected $storeService;

    public function __construct(StoreService $storeService){
        $this->storeService = $storeService;
    }

    public function index(Request $request){
        $data = $this->storeService->index($request);
        return response()->json($data);
    }

    public function show($id){
        $data = $this->storeService->show($id);

        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json([
                'message' => $data['message'],
            ], $data['code']);
        }
        return response()->json($data);
    }

    public function store(StoreStoreEciRequest $request){
        $data = $this->storeService->create($request->all());
        
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json([
                'message' => $data['message'],
            ], $data['code']);
        }
        return response()->json($data);
    }

    public function update(UpdateStoreEciRequest $request, $id){
        $data = $this->storeService->update($id, $request->all());
        
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json([
                'message' => $data['message'],
            ], $data['code']);
        }
        return response()->json($data);
    }

    public function destroy($id){
        $data = $this->storeService->delete($id);
        
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json([
                'message' => $data['message'],
            ], $data['code']);
        }
        return response()->json($data);
    }
}
