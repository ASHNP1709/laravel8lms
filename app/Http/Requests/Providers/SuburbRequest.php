<?php

namespace App\Http\Requests\Providers;

use Illuminate\Foundation\Http\FormRequest;

class SuburbRequest extends FormRequest
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
            'provider_id' => 'required',
            'state_id' => 'required',
            'suburb' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'provider_id.required' => trans('providers.assignSuburbSection.suburb.errors.required'),
            'state_id.required' => trans('providers.assignSuburbSection.state_id.errors.required'),
            'suburb.required' => trans('providers.assignSuburbSection.suburb.errors.required'),
        ];
    }
}
