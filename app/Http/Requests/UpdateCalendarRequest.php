<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCalendarRequest extends FormRequest
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
            'name' => 'required|string',
            'time' => 'required|date_format:H:i',
        ];
    }
    
    public function messages(): array
    {
        return [
            'name.required' => 'Không được để trống tên lớp!',
            'name.string' => 'Tên lớp phải định dạng kí tự!',
            'time.required' => 'Không được để trống thời gian bắt đầu!',
            'time.date_format' => 'Thời gian bắt đầu phải đúng định dạng (ví dụ: 60:00)!',
        ]; 
    }
}
