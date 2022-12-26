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
            'birthday' => 'required|date|before:-18 years|',
            'avatar' => 'image|max:3000|mimes:jpg,png,jpeg|'

        ];
    }
}
