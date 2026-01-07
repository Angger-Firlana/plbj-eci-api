<?php

namespace App\Services;

use App\Models\Quotation;
use Illuminate\Http\Request;

class QuotationService
{
    public function index(Request $request){
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 10);
        $quotations = Quotation::query();

        if($request->has('status')) {
            $quotations->where('status', $request->get('status'));
        }

        if($request->has('lpbj_id')) {
            $quotations->where('lpbj_id', $request->get('lpbj_id'));
        }

        if($request->has('quotation_number')) {
            $quotations->where('quotation_number', 'like', '%' . $request->get('quotation_number') . '%');
        }

        if($request->has('quotation_date')){
            $quotations->where('quotation_date', $request->get('quotation_date'));
        }

        if($request->has('title')) {
            $quotations->whereHas('lpbj', function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->get('title') . '%');
            });
        }

        if($request->has('department_id')) {
            $quotations->whereHas('lpbj', function ($query) use ($request) {
                $query->where('department_id', $request->get('department_id'));
            });
        }

        $quotations = $quotations->simplePaginate($limit, ['*'], 'page', $page);

        return 
            $quotations->toArray()
        ;
    }
    
    public function show($id): array
    {
        $quotation = Quotation::with([
            'quotation_details',
            'lpbj.department',
            'lpbj.user',
            'approvals'
        ])->find($id);
        if (!$quotation) {
            return [
                'data' => null,
                'message' => 'Quotation not found',
                'code' => 404,
            ];
        }
        return [
            'data' => $quotation,
            'message' => 'Quotation found',
            'code' => 200,
        ];
    }

    public function create(array $data): array
    {
        $quotation = Quotation::create([
            'lpbj_id' => $data['lpbj_id'],
            'quotation_number' => $data['quotation_number'],
            'quotation_date' => $data['quotation_date'],
            'pr_no' => isset($data['pr_no']) ? $data['pr_no'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'frenco' => isset($data['frenco']) ? $data['frenco'] : null,
            'pkp' => isset($data['pkp']) ? $data['pkp'] : null,
        ]);

        if(isset($data['quotation_details'])) {
            $quotation->quotation_details()->createMany($data['quotation_details']);
        }

        if(isset($data['approvals'])){
            $quotation->approvals()->createMany($data['approvals']);
        }

        if(!$quotation) {
            return [
                'data' => null,
                'message' => 'Quotation created failed',
                'code' => 500,
            ];
        }

        return [
            'data' => $quotation,
            'message' => 'Quotation created',
            'code' => 201,
        ];
    }

    public function update($id, array $data): array
    {
        $quotation = Quotation::find($id);
        if (!$quotation) {
            return [
                'data' => null,
                'message' => 'Quotation not found',
                'code' => 404,
            ];
        }

        $quotation->update([
            'lpbj_id' => $data['lpbj_id'],
            'quotation_number' => $data['quotation_number'],
            'quotation_date' => $data['quotation_date'],
            'pr_no' => isset($data['pr_no']) ? $data['pr_no'] : null,
            'description' => isset($data['description']) ? $data['description'] : null,
            'frenco' => isset($data['frenco']) ? $data['frenco'] : null,
            'pkp' => isset($data['pkp']) ? $data['pkp'] : null,
        ]);

        if(isset($data['quotation_details'])) {
            $quotation->quotation_details()->delete();
            $quotation->quotation_details()->createMany($data['quotation_details']);
        }

        if(isset($data['approvals'])) {
            $quotation->approvals()->delete();
            $quotation->approvals()->createMany($data['approvals']);
        }

        if(!$quotation) {
            return [
                'data' => null,
                'message' => 'Quotation updated failed',
                'code' => 500,
            ];
        }

        return [
            'data' => $quotation,
            'message' => 'Quotation updated',
            'code' => 200,
        ];
    }

    public function delete($id): array
    {
        $quotation = Quotation::find($id);
        if (!$quotation) {
            return [
                'data' => null,
                'message' => 'Quotation not found',
                'code' => 404,
            ];
        }

        $quotation->delete();

        return [
            'data' => null,
            'message' => 'Quotation deleted',
            'code' => 200,
        ];
    }
}
