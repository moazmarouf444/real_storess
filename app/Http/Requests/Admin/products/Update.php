<?php

namespace App\Http\Requests\Admin\products;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'description.ar'                  => 'required',
            'description.en'                  => 'required',
            'price' => 'required|min:0',
            'qty' => 'required|min:0',
            'is_active' => 'required|in:0,1',
            'selling_price' => 'required|min:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
//            'images'     => 'nullable|array',
//            'images.*'   => 'nullable|image',
        ];
    }
}
