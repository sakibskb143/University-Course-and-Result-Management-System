<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // allow all users, adjust if you want role-based auth
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'department_code' => 'required|string|min:2|max:7|unique:departments,department_code',
            'department_name' => 'required|string|max:255',
        ];
    }

    /**
     * Custom messages (optional).
     */
    public function messages(): array
    {
        return [
            'department_code.required' => 'Department code is required.',
            'department_code.unique'   => 'This department code already exists.',
            'department_name.required' => 'Department name is required.',
        ];
    }
}
