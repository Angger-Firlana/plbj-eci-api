<?php

namespace App\Services;

use App\Models\EciJob;
use Illuminate\Http\Request;

class EciJobService
{
    public function index(Request $request):array
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $query = EciJob::query();

        if ($request->has('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        return $query->simplePaginate($limit, ['*'], 'page', $page)->toArray();
    }

    public function show($id):array
    {
        $eciJobs = EciJob::findOrFail($id);
        if(!$eciJobs){
            return[
                'message' => 'Eci Job not found',
                'code' => 404
            ];
        }
        return [
            'data' => $eciJobs->toArray(),
            'code' => 200
        ];
    }

    public function store(array $data):array
    {
        $job = EciJob::create([
            'name' => $data['name'],
            'head_count' => $data['head_count'],
            'job_level_id' => $data['job_level_id'],
        ]);

        if(isset($data['department_id'])){
            $job->department_id = $data['department_id'];
        }
        $job->save();
        
        if(!$job){
            return[
                'message' => 'Eci Job not created',
                'code' => 500
            ];
        }
        return [
            'data' => $job->toArray(),
            'message' => 'Eci Job created successfully',
            'code' => 201
        ];
    }

    public function update($id, array $data):array
    {
        $eciJob = EciJob::findOrFail($id);
        $eciJob->update([
            'name' => $data['name'],
            'head_count' => $data['head_count'],
            'job_level_id' => $data['job_level_id'],
        ]);

        if(isset($data['department_id'])){
            $eciJob->department_id = $data['department_id'];
        }
        $eciJob->save();
        return [
            'data' => $eciJob->toArray(),
            'message' => 'Eci Job updated successfully',
            'code' => 200
        ];
    }

    public function destroy($id):array
    {
        $eciJob = EciJob::findOrFail($id);
        if(!$eciJob){
            return[
                'message' => 'Eci Job not found',
                'code' => 404
            ];
        }
        $eciJob->delete();
        return [
            'data' => $eciJob->toArray(),
            'message' => 'Eci Job deleted successfully',
            'code' => 200
        ];
    }
}