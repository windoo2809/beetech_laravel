<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'user_name' => 'required|unique:users|max:100',       
            'email' => 'required|unique:users|max:100|email',
            'first_name' => 'required|max:50|',
            'last_name' => 'required|max:50|',
            'birthday' => 'required|date|',
            'password' => 'required|max:100'
           ];
    }
    public function messages() {
        return [
             'user_name.required' => 'Vui lòng nhập Username',
             'user_name.unique' => 'Username đã tồn tại',

             'email.required' => 'Vui lòng nhập Email',
             'email.unique' => 'Email đã tồn tại',  
             'email.email' => 'Email phải đúng định dạng',  
                    
             'first_name.required' => 'Vui lòng nhập First Name',
             'first_name.max' => 'First name không được quá 50 ký tự',
      
             'last_name.required' => 'Vui lòng nhập Last Name',
             'last_name.max' => 'Last name không được quá 50 ký tự',
             
             'birthday.required' => 'Vui lòng chọn ngày',
             'birthday.date' => 'Birthday không đúng định dạng',

             'password.required' => 'Vui lòng nhập Password',
             'password.max' => 'Password không được quá 100',
        ];
    }
}