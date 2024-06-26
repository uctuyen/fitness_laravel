<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEquipmentRequest extends FormRequest
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
            'name' => 'required|string ',
            'status' => 'required|gt:0',
            'room_id' => 'required|exists:rooms,id',
            'room_id.required' => 'Vui lòng chọn một phòng',
            'room_id.exists' => 'Hãy chọn phòng',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Không được để trống trường Email!',
            'name.string' => 'Tên thiết bị phải là chuỗi!',
            'status.required' => 'Không được để trống trường Status!',
            'status.gt' => 'Hãy chọn tình trạng!',
        ];
    }
}
