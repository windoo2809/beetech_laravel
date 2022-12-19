<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_name' => [
                'required',
                'max:100',
                Rule::unique('users')->ignore($this->user)
            ],

           'email' => [
                'required',
                'max:100',
                Rule::unique('users')->ignore($this->user)
            ],
            'first_name' => 'required|max:50|',
            'last_name' => 'required|max:50|',
            'birthday' => 'required|date|',
            'avatar' => 'required|image|max:3000|mimes:jpg,png,jpeg|'

        ];
    }
    public function messages() {
        return [
            'email.required' => 'Vui lòng nhập Email',
            'email.unique' => 'Email đã tồn tại',

            'user_name.required' => 'Vui lòng nhập Username',
            'user_name.unique' => 'Username đã tồn tại',
            
            'first_name.required' => 'Vui lòng nhập First Name',
            'first_name.max' => 'First name không được quá 50 ký tự',
     
            'last_name.required' => 'Vui lòng nhập Last Name',
            'last_name.max' => 'Last name không được quá 50 ký tự',
            
            'birthday.required' => 'Vui lòng chọn ngày',
            'birthday.date' => 'Birthday không đúng định dạng',


            'avatar.max' => 'Avatar không được quá 3MB',
            'avatar.mimes' => 'Avatar không đúng định dạng',
            'avatar.image' => 'Avatar phải là ảnh',
        ];
    }
}