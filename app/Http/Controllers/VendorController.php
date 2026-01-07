<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Services\VendorService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreVendorRequest;

class VendorController extends Controller
{
    /**
     * The vendor service instance.
     *
     * @var \App\Services\VendorService
     */
    protected $vendorService;

    /**
     * Create a new controller instance.
     *
     * @param  \App\Services\VendorService  $vendorService
     * @return void
     */
    public function __construct(VendorService $vendorService){
        $this->vendorService = $vendorService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVendorRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
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
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
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
    
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
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
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
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
