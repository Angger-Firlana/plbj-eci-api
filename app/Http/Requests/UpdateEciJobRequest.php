<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEciJobRequest extends FormRequest
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
            'department_id' => 'sometimes|integer|exists:departments,id',
            'job_level_id' => 'sometimes|integer|exists:job_levels,id',
            'name' => 'sometimes|string',
            'head_count' => 'sometimes|integer'
        ];
    }
}
