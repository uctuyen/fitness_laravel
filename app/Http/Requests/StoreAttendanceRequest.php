<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAttendanceRequest extends FormRequest
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
            'class_id' => 'required|exists:classes,id',
            'calendar_id' => 'required|exists:calendars,id',
        ];
    }

    public function messages(): array
    {
        return [
            'class_id.required' => 'Không được để trống lớp học!',
            'class_id.exists' => 'Lớp học không tồn tại hoặc không có huấn luyện viên!',
            'calendar_id.required' => 'Không được để trống ca học!',
            'calendar_id.exists' => 'Ca học không tồn tại!',
        ];
    }
}
