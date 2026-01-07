<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Services\VendorService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreVendorRequest;

class VendorController extends Controller
{
    protected $vendorService;

    public function __construct(VendorService $vendorService){
        $this->vendorService = $vendorService;
    }

    public function index(Request $request){
        $data = $this->vendorService->index($request);

        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json([
                'message' => $data['message']
            ], $data['code']);
        }

        return response()->json(
            $data['data'],
            $data['code']
        );
    }

    public function store(StoreVendorRequest $request){
        $data = $this->vendorService->create($request->validated());

        if(!($data['code'] >= 200 && $data['code'] < 300 )){
            return response()->json([
                'message' => $data['message']
            ], $data['code']);
        }

        return response()->json(
            $data,
            $data['code']
        );
    }
    
    public function show($id){
        $data = $this->vendorService->show($id);

        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json([
                'message' => $data['message']
            ], $data['code']);
        }

        return response()->json(
            $data,
            $data['code']
        );
    }
    
    public function update($id, Request $request){
        $data = $this->vendorService->update($id, $request->all());

        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json([
                'message' => $data['message']
            ], $data['code']);
        }

        return response()->json(
            $data,
            $data['code']
        );
    }
    
    public function destroy($id){
        $data = $this->vendorService->delete($id);

        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json([
                'message' => $data['message']
            ], $data['code']);
        }

        return response()->json(
            $data,
            $data['code']
        );
    }
}
