<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveRoomRequest extends FormRequest
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
            'class_id' => 'required|gt:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Không được để trống tên phong!',
            'name.string' => 'Tên lớp phải định dạng kí tự!',
            'class_id.required' => 'Không được để trống tên lớp!',
        ];
    }
}
