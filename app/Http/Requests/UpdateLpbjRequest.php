<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateLpbjRequest extends FormRequest
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
            'title' => 'sometimes|string|max:255',
            'request_by' => 'sometimes|exists:users,id',
            'lpbj_number' => 'sometimes|integer',
            'department_id' => 'sometimes|exists:departments,id',
            'request_date' => 'sometimes|date',
            'store_id' => 'sometimes|exists:stores,id',
            'items' => 'sometimes|array',
            'items.*.media' => 'sometimes|string',
            'items.*.name' => 'sometimes|string',
            'items.*.quantity' => 'sometimes|integer',
            'items.*.article' => 'sometimes|string',
            'items.*.store_id' => 'sometimes|exists:stores,id',
            'items.*.general_ledger' => 'sometimes|string',
            'items.*.cost_center' => 'sometimes|string',
            'items.*.order'  => 'sometimes|string',
            'items.*.information' => 'sometimes|string',
            'items.*.item_photo' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'items.*.detail_item' => 'sometimes|array',
            'items.*.detail_item.*.detail' => 'sometimes|string',
            'items.*.approvals' => 'sometimes|array',
            'items.*.approvals.*.approver_id' => 'sometimes|exists:users,id',
        ];
    }
}
