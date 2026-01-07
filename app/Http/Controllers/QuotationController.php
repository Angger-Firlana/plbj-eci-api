<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuotationService;
use App\Http\Requests\StoreQuotationRequest;
use App\Http\Requests\UpdateQuotationRequest;

class QuotationController extends Controller
{
    /**
     * The quotation service instance.
     *
     * @var \App\Services\QuotationService
     */
    protected $quotationService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\QuotationService  $quotationService
     * @return void
     */
    public function __construct(QuotationService $quotationService)
    {
        $this->quotationService = $quotationService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request){
        $data = $this->quotationService->index($request);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreQuotationRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreQuotationRequest $request)
    {
        $data = $this->quotationService->create($request->validated());
        
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
        $data = $this->quotationService->show($id);
        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \App\Http\Requests\UpdateQuotationRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update($id, UpdateQuotationRequest $request){
        $data = $this->quotationService->update($id, $request->validated());
        
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
        $data = $this->quotationService->delete($id);
        
        if(!($data['code'] >= 200 && $data['code'] < 300)) {
            return response()->json($data, $data['code']);
        }
        
        return response()->json($data, $data['code']);
    }
    
}
