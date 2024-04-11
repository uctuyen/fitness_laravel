<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEmployeeRequest extends FormRequest
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
            'email' => 'required|string|email|unique:employees,email, '.$this->id.'|max:255',
            'first_name' => 'required|string',
            'last_name' => 'required|string ',
        ];
    }
    public function messages(): array
    {
        return [
            'email.required' => 'Không được để trống trường Email!',
            'email.email' => 'Sai định dạng Email! (ví dụ: abcd@gmail.com)',
            'email.unique' => 'Email đã tồn tài, Hãy chọn Email khác!',
            'email.string' => 'Email phải định dạng kí tự!',
            'email.max' => 'Độ dài tối đa là 255 kí tự!',
            'first_name.required' => 'Không được để trống Họ eqweqweqw!',
            'first_name.string' => 'Họ phải là dạng kí tự!',
            'last_name.required' => 'Không được để trống Tên!',
            'last_name.string' => 'Họ phải là dạng kí tự!',
        ];
    }
}
