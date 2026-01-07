<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PurchasedOrderService;
use App\Http\Requests\StorePurchasedOrderRequest;
use App\Http\Requests\UpdatePurchasedOrderRequest;

class PurchasedOrderController extends Controller
{
    /**
     * The purchased order service instance.
     *
     * @var \App\Services\PurchasedOrderService
     */
    protected $purchasedOrderService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\PurchasedOrderService  $purchasedOrderService
     * @return void
     */
    public function __construct(PurchasedOrderService $purchasedOrderService)
    {
        $this->purchasedOrderService = $purchasedOrderService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $data = $this->purchasedOrderService->index($request);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePurchasedOrderRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StorePurchasedOrderRequest $request)
    {
        $data = $this->purchasedOrderService->store($request->validated());
        
        if(!($data['code'] >= 200 && $data['code'] < 300)) {
            return response()->json($data, $data['code']);
        }
        
        return response()->json($data, $data['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        $data = $this->purchasedOrderService->show($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \App\Http\Requests\UpdatePurchasedOrderRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdatePurchasedOrderRequest $request){
        $data = $this->purchasedOrderService->update($id, $request->validated());
        
        if(!($data['code'] >= 200 && $data['code'] < 300)) {
            return response()->json($data, $data['code']);
        }
        
        return response()->json($data, $data['code']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id){
        $data = $this->purchasedOrderService->delete($id);
        
        if(!($data['code'] >= 200 && $data['code'] < 300)) {
            return response()->json($data, $data['code']);
        }
        
        return response()->json($data, $data['code']);
    }
}