<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveCalendarRequest extends FormRequest
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
            'start_day' => 'required|date',
            'end_day' => 'required|date',
        ];
    }
    
    public function messages(): array
    {
        return [
            'start_day.required' => 'Không được để trống ngày!',
            'end_day.required' => 'Không được để trống thời gian bắt đầu!',
        ]; 
    }
}
