<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class ClassroomAllocationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'department_id' => 'required|exists:departments,id',
            'course_id' => 'required|exists:courses,id',
            'room_id' => 'required|exists:rooms,id',
            'day' => 'required|in:Saturday,Sunday,Monday,Tuesday,Wednesday,Thursday',
            'time_from' => 'required|date_format:H:i',
            'time_to' => 'required|date_format:H:i',
            'status' => 'required|in:0,1',
            'semester' => 'required|integer|min:1|max:8',

        ];
    }

    protected function prepareForValidation()
    {
        if ($this->time_from && $this->time_to) {
            $from = Carbon::createFromFormat('H:i', $this->time_from);
            $to = Carbon::createFromFormat('H:i', $this->time_to);

            if ($to->lte($from)) {
                $this->merge(['time_to_invalid' => true]);
            }
        }
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            if ($this->time_to_invalid ?? false) {
                $validator->errors()->add('time_to', 'The time to must be after time from.');
            }
        });
    }
}
