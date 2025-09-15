<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'department_id' => 'required|exists:departments,id',
            'teacher_name' => 'required|string|max:255',
            'email' => 'required|nullable|email|unique:teachers,email',
            'contact_no' => 'required|nullable|digits:11|numeric',
            'designation' => 'required|nullable|string|max:255',
            'credit_to_be_taken' => 'required|numeric|min:20',
        ];
    }

    public function messages(): array
    {
        return [
            'department_id.required' => 'Department is required.',
            'department_id.exists' => 'Selected department is invalid.',
            'teacher_name.required' => 'Teacher name is required.',
            'teacher_name.max' => 'Teacher name cannot exceed 255 characters.',
            'email.email' => 'Email must be valid.',
            'email.required'=> 'Email is required',
            'email.unique' => 'Email already exists.',
            'contact_no.digits' => 'Contact number must be exactly 11 digits.',
            'contact_no.required' => 'Contact number must be required',
            'contact_no.numeric' => 'Contact number must contain only numbers.',
            'credit_to_be_taken.required' => 'Credit is required.',
            'credit_to_be_taken.numeric' => 'Credit must be a number.',
            'credit_to_be_taken.min' => 'Credit must be at least 20.',
        ];
    }
}
