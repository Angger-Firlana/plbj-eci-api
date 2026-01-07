<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePurchasedOrderRequest extends FormRequest
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
            'quotation_id' => 'required|exists:quotations,id',
            'vendor_id' => 'required|exists:vendors,id',
            'purchased_order_number' => 'required|string|max:255|unique:purchased_orders,purchased_order_number',
            'purchased_order_date' => 'required|date',
            'delivery_date' => 'required|date|after_or_equal:purchased_order_date',
            'status' => 'nullable|string|max:255', // e.g., pending, approved, rejected
            'notes' => 'nullable|string',
            'purchased_order_details' => 'required|array',
            'purchased_order_details.*.item_name' => 'required|string|max:255',
            'purchased_order_details.*.quantity' => 'required|numeric|min:1',
            'purchased_order_details.*.price' => 'required|numeric|min:0',
            'purchased_order_details.*.total_price' => 'required|numeric|min:0',
            'purchased_order_details.*.remarks' => 'nullable|string',
            'approvals' => 'nullable|array',
            'approvals.*.approver_id' => 'required|exists:users,id',
            'approvals.*.status' => 'required|string',
            'approvals.*.approved_at' => 'nullable|date',
        ];
    }
}