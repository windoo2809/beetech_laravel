<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class UpdateProductRequest extends FormRequest
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
            'name' => 'required|max:255',       
            'stock' => 'required|min:0|max:10000|numeric',
            'expired_at' => 'nullable|required|:today',
            'avatar' => 'max:3MB',
            'sku' => [
                'min:10',
                'max:20',
                'regex:/^[a-zA-Z0-9 ]+$/i',
                Rule::unique('product')->ignore($this->product),
             ]
        ];
    }
}
