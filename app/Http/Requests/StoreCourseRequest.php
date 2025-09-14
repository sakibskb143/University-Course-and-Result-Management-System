<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    public function authorize()
    {
        return true; // allow all for now
    }

    public function rules()
    {
        $courseId = $this->route('course')?->id ?? null; // ignore unique for editing

        return [
            'department_id' => 'required|exists:departments,id',
            'semester_id'   => 'required|integer|min:1|max:8',
            'course_code'   => 'required|string|max:10|unique:courses,course_code,' . $courseId,
            'course_name'   => 'required|string|max:255',
            'credit'        => 'required|numeric|min:0.5|max:5',
        ];
    }
}
