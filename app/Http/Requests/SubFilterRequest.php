<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubFilterRequest extends FormRequest
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


    public function rules()
    {
        return [
            'name'=>'required|min:1|max:100',
            'filter_id'=>"required|exists:filters,id"

        ];
    }
}
