<?php

namespace App\Http\Requests\MobileSettings;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class BrandRequest extends FormRequest
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
       
        $rules=[];

        $rules = [
            'title' => "required|min:0|max:50",
            'os_name' => "required",
        ];
             
        return $rules;
    }

    public function messages()
    {
        return [
            'title.required' => trans('handsets.brandPage.brandsrequired'),
            'os_name.required' => trans('handsets.brandPage.osrequired'),
        ];
    }
}
