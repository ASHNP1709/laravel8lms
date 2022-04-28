<?php

namespace App\Http\Requests\Providers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class CheckboxRequest extends FormRequest
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
    $request = Request::all();
    $rules = [];
    if ($request['form_name'] == "terms_condition_checkbox_form") {
      $rules = [
        "terms_checkbox_required"   =>   ['required'],
        "terms_condition_validates" =>   ['required_if:terms_checkbox_required,1'],
        "term_checkbox_status_save" =>   ['required'],
        "provider_id"               =>   ['required'],
        "terms_checkbox_content"    =>   ['required'],
        "type"                      =>   ['required'],
      ];
    }
    if ($request['form_name'] == "provider_ackn_checkbox_formm") {
      $rules = [
        // "ackn_checkbox_status_save" =>   ['required'],
        // "ackn_checkbox_required"    =>   ['required'],
        "ackn_validation_msg"       =>   ['required_if:ackn_checkbox_required,1'],
        "provider_id"               =>   ['required'],
        "ackn_checkbox_content"     =>   ['required']

      ];
    }
    if ($request['form_name'] == "tele_sale_setting_checkbox_form") {
      $rules = [
        "tele_sale_setting_checkbox_content"     => ['required'],
        "tele_sale_setting_checkbox_required"    => ['required'],
        "tele_sale_setting_validation_msg"       => ['required_if:tele_sale_setting_checkbox_required,1'],
        "tele_sale_setting_checkbox_save_status" => ['required'],
        "tele_select_eic_type"                   => ['required'],
        "provider_id"                            => ['required'],
      ];
    }

    if ($request['form_name'] == "state_checkbox_form") {
      $rules = [
        "state_eic_content_checkbox_content"     => ['required'],
        "state_eic_content_checkbox_required"    => ['required'],
        "state_eic_content_validation_msg"       => ['required_if:state_eic_content_checkbox_required,1'],
        "state_eic_content_checkbox_save_status" => ['required'],
        "statewise_select_eic_type"              => ['required'],
        "provider_id"                            => ['required'],
        'state'                                  => ['required'],
      ];
    }
    if ($request['form_name'] == "master_checkbox_form") {
      $rules = [
        "state_eic_content_checkbox_content"     => ['required'],
        "state_eic_content_checkbox_required"    => ['required'],
        "state_eic_content_validation_msg"       => ['required_if:state_eic_content_checkbox_required,1'],
        "state_eic_content_checkbox_save_status" => ['required'],
        "statewise_select_eic_type"              => ['required'],
        "provider_id"                            => ['required'],
        'state'                                  => ['required'],
      ];
    }
    if ($request['form_name'] == "debit_checkbox_form") {
      $rules = [
        "debit_checkbox_required" => ['required'],
        "debit_checkbox_content"  => ['required'],
        "debit_validation_msg"    => ['required_if:debit_checkbox_required,1'],
        "provider_id"             => ['required'],
      ];
    }
    return $rules;
  }
  public function messages(){
    return [
      'statewise_select_eic_type.required' => trans('providers.statewise_select_eic_type'),
      'state_eic_content_checkbox_content.required' => trans('providers.state_eic_content_checkbox_content'),
      'ackn_validation_msg.required_if'=>trans('providers.acknowledgement_msg_required'),
      'ackn_checkbox_content.required' => trans('providers.acknowledgement_checkbox_content_required'),
      'debit_checkbox_content.required' =>trans('providers.debit_checkbox_content_required'),
      'debit_validation_msg.required_if' => trans('providers.debit_validation_msg_required')
    ];
  }
}
