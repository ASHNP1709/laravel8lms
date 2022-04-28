<?php

namespace App\Http\Requests\Affiliates;

use Illuminate\Foundation\Http\FormRequest;

class ManageApiKey extends FormRequest
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

        $rules = [];
        $rules = [
            'name' => "bail|required|regex:/^(?!\d+$)(?:[a-zA-Z0-9][a-zA-Z0-9 !@#$&'()-`.+]*)?+$/|max:100",
            'page_url' => "required|url",
            'origin_url' => 'nullable|url',

        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => trans('affiliates.name'),
            'page_url.required' => trans('affiliates.page_url'),
            'page_url.url' => trans('affiliates.valid_url'),
            'origin_url.url' => trans('affiliates.origin_url'),

        ];
    }
}
