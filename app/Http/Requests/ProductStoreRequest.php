<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
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
            'name' => 'required|max:255',
            'price' => 'required|numeric|between:0,100000',
            'description' => 'required',
        ];
    }

    public function messages()
    {
        return [
          'name.required' => 'Название товара обязательно к заполнению',
          'name.max' => "Слишком длинное название",
          'price.required' => 'Цена товара обязательна к заполнению',
          'price.numeric' => 'Цена товара должна быть числом',
          'description.required' => 'Описание товара обязательно к заполнению',
        ];
    }
}
