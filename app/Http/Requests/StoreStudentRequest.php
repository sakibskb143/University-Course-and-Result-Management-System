<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $studentId = $this->route('student') ? $this->route('student')->id : null;

        return [
            'student_reg_no' => 'nullable|string|max:50|unique:students,student_reg_no,' . $studentId,
            'student_name'   => 'required|string|max:255',
            'email'          => 'nullable|email|unique:students,email,' . $studentId,
            'contact_no'     => 'nullable|string|max:20',
            'address'        => 'nullable|string|max:500',
            'year'           => 'nullable|digits:4|integer|min:2000|max:2099',
            'department_id'  => 'required|exists:departments,id',
            'semester'       => 'required|integer|min:1|max:8',
        ];
    }
}
