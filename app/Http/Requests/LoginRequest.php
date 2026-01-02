<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class LoginRequest extends FormRequest
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
            'input' => 'required|string|max:255',
            'password' => 'required|string|min:8'
        ];
    }
    
    public function messages(): array
    {
        return [
            'input.required' => 'Email atau Nomor HP wajib diisi',
            'input.string' => 'Email atau Nomor HP harus berupa string',
            'input.max' => 'Email atau Nomor HP maksimal 255 karakter',
            'password.required' => 'Password wajib diisi',
            'password.string' => 'Password harus berupa string',
            'password.min' => 'Password minimal 8 karakter',
        ];
    }
}
