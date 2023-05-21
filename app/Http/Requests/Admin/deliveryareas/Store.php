<?php

namespace App\Http\Requests\Admin\deliveryareas;

use Illuminate\Foundation\Http\FormRequest;

class Store extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name.ar'                  => 'required|max:191',
            'name.en'                  => 'required|max:191',
            'price' => 'required|digits_between:1,99999999999999',
        ];
    }
}
