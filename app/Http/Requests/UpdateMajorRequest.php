<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMajorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
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
