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
    /**
     * The store service instance.
     *
     * @var \App\Services\StoreService
     */
    protected $storeService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\StoreService  $storeService
     * @return void
     */
    public function __construct(StoreService $storeService){
        $this->storeService = $storeService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $data = $this->storeService->index($request);
        return response()->json($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id){
        $data = $this->storeService->show($id);

        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json([
                'message' => $data['message'],
            ], $data['code']);
        }
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreStoreEciRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreStoreEciRequest $request){
        $data = $this->storeService->create($request->all());
        
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json([
                'message' => $data['message'],
            ], $data['code']);
        }
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStoreEciRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateStoreEciRequest $request, $id){
        $data = $this->storeService->update($id, $request->all());
        
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json([
                'message' => $data['message'],
            ], $data['code']);
        }
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
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
