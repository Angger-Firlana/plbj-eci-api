<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEciJobRequest;
use App\Http\Requests\UpdateEciJobRequest;
use Illuminate\Http\Request;
use App\Models\EciJob;
use App\Models\JobLevel;
use App\Services\EciJobService;

class EciJobController extends Controller
{
    //
    protected $eciJobService;

    public function __construct(EciJobService $eciJobService){
        $this->eciJobService = $eciJobService;
    }
    public function index(Request $request){
        $data = $this->eciJobService->index($request);
      
        return response()->json($data);
    }

    public function show($id){
        $data = $this->eciJobService->show($id);
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }
        return response()->json($data['data'], $data['code']);
    }

    public function store(StoreEciJobRequest $request){
        $data = $this->eciJobService->store($request->validated());
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }
        return response()->json($data['data'], $data['code']);
    }

    public function update($id, UpdateEciJobRequest $request){
        $data = $this->eciJobService->update($id, $request->validated());
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }
        return response()->json($data['data'], $data['code']);
    }

    public function destroy($id){
        $data = $this->eciJobService->destroy($id);
        if(!($data['code'] >= 200 && $data['code'] < 300)){
            return response()->json($data, $data['code']);
        }
        return response()->json($data['data'], $data['code']);
    }
}
