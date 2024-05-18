<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class RegisterCustomerRequest extends FormRequest
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
            'name' => 'required|regex:/^[\pL\s]+$/u|max:255',
            'email' => 'required|email|unique:customers,email|max:255',
            'phone_number' => 'required|regex:/^[0-9]{10,11}$/',
            'address' => 'required|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Họ và tên là bắt buộc.',
            'name.regex' => 'Họ và tên chỉ được chứa chữ cái và khoảng trắng.',
            'name.max' => 'Họ và tên không được vượt quá 255 ký tự.',

            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email phải là một địa chỉ email hợp lệ.',
            'email.unique' => 'Email này đã được sử dụng.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',

            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'phone_number.regex' => 'Số điện thoại phải có độ dài từ 10 đến 11 chữ số.',

            'address.required' => 'Địa chỉ là bắt buộc.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',
        ];
    }
}
