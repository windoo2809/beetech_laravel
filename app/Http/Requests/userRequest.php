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
            'birthday' => 'required|date|before:-18 years|',
            'password' => 'required|max:100',
            'avatar' => 'required|image|mimes:jpg,png,jpeg|max:3000|'
           ];
    }

}
