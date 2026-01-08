<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePurchasedOrderRequest extends FormRequest
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
            'quotation_id' => 'sometimes|exists:quotations,id',
            'store_id' => 'sometimes|exists:stores,id',
            'vendor_id' => 'sometimes|exists:vendors,id',
            'purchased_order_number' => 'sometimes|string|max:255|unique:purchased_orders,purchased_order_number,' . $this->route('id'),
            'purchased_order_date' => 'sometimes|date',
            'term' => 'required|string',
            'cost' => 'required|numeric',
            'delivery_date' => 'sometimes|date|after_or_equal:purchased_order_date',
            'expired_date' => 'sometimes|date|after_or_equal:delivery_date',
            'status' => 'sometimes|string|max:255', // e.g., pending, approved, rejected
            'notes' => 'sometimes|string',
            'purchased_order_details' => 'sometimes|array',
            'purchased_order_details.*.quotation_detail_id' => 'sometimes|exists:quotation_details,id',
            'purchased_order_details.*.item_name' => 'sometimes|string|max:255',
            'purchased_order_details.*.quantity' => 'sometimes|numeric|min:1',
            'purchased_order_details.*.model' => 'sometimes|string|max:255',
            'purchased_order_details.*.price' => 'sometimes|numeric|min:0',
            'purchased_order_details.*.discount' => 'sometimes|numeric|min:0',
            'purchased_order_details.*.amount' => 'sometimes|numeric|min:0',
            'purchased_order_details.*.remarks' => 'sometimes|string',
            'approvals' => 'sometimes|array',
            'approvals.*.approver_id' => 'sometimes|exists:users,id',
            'approvals.*.status' => 'sometimes|string',
            'approvals.*.approved_at' => 'nullable|date',
        ];
    }
}