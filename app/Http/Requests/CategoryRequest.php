<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [

            'name' => [
                'required',
                Rule::unique('categories')->ignore($this->route),
                'min:3',
                'max:100'
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => 'Category name must be unique.'
        ];
    }
}