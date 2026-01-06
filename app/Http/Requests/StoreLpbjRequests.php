<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreLpbjRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
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
            'title' => 'required|string|max:255',
            'request_by' => 'required|exists:users,id',
            'lpbj_number' => 'required|integer',
            'department_id' => 'required|exists:department,id',
            'request_date' => 'required|date',
            'store_id' => 'required|exists:stores,id',
            'items' => 'required|array',
            'items.*.media' => 'required|string',
            'items.*.name' => 'required|string',
            'items.*.quantity' => 'required|integer',
            'items.*.article' => 'required|string',
            'items.*.store_id' => 'required|exists:stores,id',
            'items.*.general_ledger' => 'required|string',
            'items.*.cost_center' => 'required|string',
            'items.*.order'  => 'required|string',
            'items.*.information' => 'required|string',
            'items.*.item_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
