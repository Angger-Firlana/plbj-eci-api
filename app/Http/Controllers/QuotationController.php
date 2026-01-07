<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\QuotationService;
use App\Http\Requests\StoreQuotationRequest;
use App\Http\Requests\UpdateQuotationRequest;

class QuotationController extends Controller
{
    protected $quotationService;

    public function __construct(QuotationService $quotationService)
    {
        $this->quotationService = $quotationService;
    }

    public function index(Request $request){
        $data = $this->quotationService->index($request);
        return response()->json($data);
    }

    public function store(StoreQuotationRequest $request)
    {
        $data = $this->quotationService->create($request->validated());
        
        if(!($data['code'] >= 200 && $data['code'] < 300)) {
            return response()->json($data, $data['code']);
        }
        
        return response()->json($data, $data['code']);
    }

    public function show($id)
    {
        $data = $this->quotationService->show($id);
        return response()->json($data);
    }

    public function update($id, UpdateQuotationRequest $request){
        $data = $this->quotationService->update($id, $request->validated());
        
        if(!($data['code'] >= 200 && $data['code'] < 300)) {
            return response()->json($data, $data['code']);
        }
        
        return response()->json($data, $data['code']);
    }

    public function destroy($id){
        $data = $this->quotationService->delete($id);
        
        if(!($data['code'] >= 200 && $data['code'] < 300)) {
            return response()->json($data, $data['code']);
        }
        
        return response()->json($data, $data['code']);
    }
    
}
