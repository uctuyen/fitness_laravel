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
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'class_id' => [
                'required',
                Rule::exists('classes', 'id')->where(function ($query) {
                    $query->whereHas('trainer');
                }),
            ],
            'trainer_id' => 'required|exists:trainers,id',
        ];
    }
    
        public function messages(): array
    {
        return [
            'start_date.required' => 'Không được để trống ngày bắt đầu!',
            'end_date.required' => 'Không được để trống ngày kết thúc!',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu!',
            'class_id.required' => 'Không được để trống lớp học!',
            'class_id.exists' => 'Lớp học không tồn tại hoặc không có huấn luyện viên!',
        ]; 
    }
}