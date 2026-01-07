<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateQuotationRequest extends FormRequest
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
            //
            'lpbj_id' => 'sometimes|exists:lpbjs,id',
            'quotation_number' => 'sometimes|string',
            'quotation_date' => 'sometimes|date',
            'pr_no' => 'sometimes|string',
            'description' => 'sometimes|string',
            'frenco' => 'sometimes|string',
            'pkp' => 'sometimes|string',
            'quotation_details' => 'sometimes|array',
            'approvals' => 'sometimes|array',
            'quotation_details.*.item_id' => 'sometimes|exists:lpbj_items,id',
            'quotation_details.*.quantity' => 'sometimes|numeric',
            'quotation_details.*.price' => 'sometimes|numeric',
            'quotation_details.*.total_price' => 'sometimes|numeric',
            'quotation_details.*.remarks' => 'sometimes|string',
            'approvals.*.approver_id' => 'sometimes|exists:users,id',
            'approvals.*.status' => 'sometimes|string',
            'approvals.*.approved_at' => 'nullable|date',
        ];
    }
}
