<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveMajorRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'major_name' => 'required|string',
        ];
    }

    public function messages(): array
    {
        return [
            'major_name.required' => 'Không được để trống tên chuyên môn!',
            'major_name.string' => 'chuyên môn phải định dạng kí tự!',
        ];
    }
}
