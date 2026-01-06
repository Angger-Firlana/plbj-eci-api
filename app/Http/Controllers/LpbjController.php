<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lpbj;
use App\Services\LpbjService;   
use App\Http\Requests\UpdateLpbjRequest;
use Illuminate\Support\Facades\DB;
class LpbjController extends Controller
{
    protected $lpbjService;
    public function __construct(LpbjService $lpbjService)
    {
        $this->lpbjService = $lpbjService;
    }
    public function index(Request $request){
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $keyword = $request->get('keyword', '');

        $lpbj = Lpbj::select('id', 'request_by','department_id', 'title', 'request_date', 'status')->with(['user:id,name', 'department:id,name'])
            ->where('title', 'like', "%{$keyword}%")
            ->simplePaginate($limit, ['*'], 'page', $page);

        return response()->json($lpbj);
    }

    public function store(Request $request){
        try{
            DB::beginTransaction();
            $lpbj = $this->lpbjService->store($request->all());
            DB::commit();
            return response()->json($lpbj);
        }catch(\Exception $ex){
            DB::rollBack();
            return response()->json([
                'message' => $ex->getMessage(),
                'code' => 500
            ], 500);
        }
        
    }

    public function show($id){
        try{
            $data = $this->lpbjService->show($id);
            if(!($data['code'] >= 200 && $data['code'] < 300)){
                return response()->json([
                    'message' => $data['message']
                ], $data['code']);
            }
            return response()->json($lpbj);
        }catch(\Exception $ex){
            return response()->json([
                'message' => $ex->getMessage(),
                'code' => 500
            ], 500);
        }
    }
    
    public function update(UpdateLpbjRequest $request, $id){        
        try{
            DB::beginTransaction();
            $lpbj = $this->lpbjService->update($request->all(), $id);
            DB::commit();
            return response()->json($lpbj);
        }catch(\Exception $ex){
            DB::rollBack();
            return response()->json([
                'message' => $ex->getMessage(),
                'code' => 500
            ], 500);
        }
    }

    public function destroy($id){
        try{
            DB::beginTransaction();
            $this->lpbjService->destroy($id);
            DB::commit();
            return response()->json(['message' => 'LPBJ deleted successfully']);
        }catch(\Exception $ex){
            DB::rollBack();
            return response()->json([
                'message' => $ex->getMessage(),
                'code' => 500
            ], 500);
        }
    }
}
