<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveClassSessionRequest extends FormRequest
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
            'day_of_week' => 'required|in:Thứ Hai,Thứ Ba,Thứ Tư,Thứ Năm,Thứ Sáu,Thứ Bảy',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ];
    }
    
    public function messages(): array
    {
        return [
            'name.required' => 'Không được để trống tên lớp!',
            'name.string' => 'Tên lớp phải định dạng kí tự!',
            'day_of_week.required' => 'Không được để trống ngày trong tuần!',
            'day_of_week.in' => 'Ngày trong tuần không hợp lệ(vd: Thứ Hai, Thứ Ba,....)!',
            'start_time.required' => 'Không được để trống thời gian bắt đầu!',
            'start_time.date_format' => 'Thời gian bắt đầu phải đúng định dạng (ví dụ: 60:00)!',
            'end_time.required' => 'Không được để trống thời gian kết thúc!',
            'end_time.date_format' => 'Thời gian kết thúc phải đúng định dạng (ví dụ: 80:00)!',
            'end_time.after' => 'Thời gian kết thúc phải sau thời gian bắt đầu!',
        ];
    }
}
