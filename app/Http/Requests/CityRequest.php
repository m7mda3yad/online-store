<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class CityRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }
    public function rules()
    {
        return [
            'name'=>'required|min:3|max:191',
            'country_id'=>'required|exists:countries,id'
        ];
    }
}
