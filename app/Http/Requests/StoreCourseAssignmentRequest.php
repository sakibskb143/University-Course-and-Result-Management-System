<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseAssignmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'department_id' => 'required|exists:departments,id',
            'teacher_id' => 'required|exists:teachers,id',
            'course_id' => 'required|exists:courses,id|unique:course_assignments,course_id,NULL,id,teacher_id,'.$this->teacher_id,
            'assigned_credit' => 'required|numeric|min:0.5|max:5',
        ];
    }

    public function messages(): array
    {
        return [
            'department_id.required' => 'Please select a department.',
            'teacher_id.required' => 'Please select a teacher.',
            'course_id.required' => 'Please select a course.',
            'course_id.unique' => 'This course is already assigned to the selected teacher.',
            'assigned_credit.required' => 'Please enter assigned credit.',
            'assigned_credit.numeric' => 'Assigned credit must be a number.',
            'assigned_credit.min' => 'Minimum credit is 0.5.',
            'assigned_credit.max' => 'Maximum credit is 5.0.',
        ];
    }
}
