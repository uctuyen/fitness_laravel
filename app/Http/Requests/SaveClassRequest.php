<?php

namespace App\Http\Requests;

use App\Rules\UniqueClassTrainer;
use Illuminate\Foundation\Http\FormRequest;

class SaveClassRequest extends FormRequest
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
            'id' => ['somtimes', new UniqueClassTrainer],
            'name' => 'required|string',
            'price' => 'required|numeric|min:0',
            'quantity_member' => 'required|integer|min:0',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Không được để trống tên lớp!',
            'name.string' => 'Tên lớp phải định dạng kí tự!',
            'price.required' => 'Không được để trống giá!',
            'price.numeric' => 'Giá phải là một số!',
            'price.min' => 'Giá không được âm!',
            'quantity_member.required' => 'Không được để trống số lượng học viên!',
            'quantity_member.integer' => 'Số lượng học viên phải là một số nguyên!',
            'quantity_member.min' => 'Số lượng học viên không được âm!',
        ];
    }
}
