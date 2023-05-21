<?php

namespace App\Http\Requests\Admin\brands;

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
            'image'                => ['required','image'],
            'name.ar'                  => 'required|max:191',
            'name.en'                  => 'required|max:191',
            'active'  => 'required',
        ];
    }
}
