<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreQuotationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'lpbj_id' => 'required|exists:lpbjs,id',
            'quotation_number' => 'required|string',
            'quotation_date' => 'required|date',
            'pr_no' => 'nullable|string',
            'description' => 'nullable|string',
            'frenco' => 'nullable|string',
            'pkp' => 'nullable|string',
            'quotation_details' => 'nullable|array',
            'approvals' => 'nullable|array',
            'quotation_details.*.item_id' => 'required|exists:lpbj_items,id',
            'quotation_details.*.quantity' => 'required|numeric',
            'quotation_details.*.price' => 'required|numeric',
            'quotation_details.*.total_price' => 'required|numeric',
            'quotation_detail.*.remarks' => 'sometimes|string',
            'approvals.*.approver_id' => 'required|exists:users,id',
            'approvals.*.status' => 'required|string',
            'approvals.*.approved_at' => 'nullable|date'
        ];
    }
}
