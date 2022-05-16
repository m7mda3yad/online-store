<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [

            'name'=>'required|min:3|max:190',
            'description'=>'required|min:3|max:10000',
            'price'=>'required|digits_between:1,1000000',
            'photo'=>'nullable|image',
            'real_price'=>'required|digits_between:1,1000000',
            'amount'=>'required||digits_between:1,1000000',
            'sub_category_id'=>'required|exists:sub_categories,id',


        ];
    }
}
            // 'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
