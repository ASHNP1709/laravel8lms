<?php

namespace App\Http\Requests\Plan\Mobile;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class PlanFormRequest extends FormRequest
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
        $validationRules = [];
        $validationRules['form'] = ['required'];
        $request = Request::all();
        switch ($request['form']) {
            case 'plan_basic_details_form':
                $validationRules['name'] = ['bail', 'required', 'max:100'];
                $validationRules['connection_type'] = ['bail', 'required'];
                $validationRules['plan_type'] = ['bail', 'required'];
                // $validationRules['cost'] = ['bail', 'required','numeric','gt:-1','between:1,99999.99'];
                $validationRules['cost'] = ['bail', 'required','numeric','gt:-1','min:1','max:99999.99'];
                $validationRules['plan_data'] = ['bail', 'required','numeric','gt:-1','max:99999.99'];
                // $validationRules['plan_data'] = ['bail', 'required','numeric','gt:-1','between:1,99999.99'];
                $validationRules['plan_data_unit'] = ['bail', 'required'];
                $validationRules['network_type'] = ['bail', 'required'];
                $validationRules['contract_id'] = ['bail', 'required'];
                $validationRules['activation_date_time'] = ['bail', 'required', 'date', 'after:today'];
                if(isset($request['planId'])){
                    $validationRules['activation_date_time'] = ['bail', 'required', 'date'];
                }
                $validationRules['deactivation_date_time'] = ['bail', 'nullable', 'date', 'after:activation_date_time'];
                $validationRules['billing_preference'] = ['required'];
                $validationRules['inclusion'] = ['bail', 'required', 'max:10000'];
                $validationRules['details'] = ['bail', 'required', 'max:10000'];
                break;

            case 'plan_permissions_authorizations_form':
                $validationRules['new_connection_allowed'] = ['bail', 'required'];
                $validationRules['port_allowed'] = ['bail', 'required'];
                $validationRules['retention_allowed'] = ['bail', 'required'];
                break;

            case 'plan_amazing_extra_facilities_form':
                $validationRules['amazing_extra_facilities'] = ['max:10000'];
                break;
            case 'plan_national_inclusion_form':
                $validationRules['national_voice_calls'] = ['max:100'];
                $validationRules['national_video_calls'] = ['max:100'];
                $validationRules['national_text'] = ['max:100'];
                $validationRules['national_mms'] = ['max:100'];
                $validationRules['national_directory_assist'] = ['max:100'];
                $validationRules['national_diversion'] = ['max:100'];
                $validationRules['national_call_forwarding'] = ['max:100'];
                $validationRules['national_voicemail_deposits'] = ['max:100'];
                $validationRules['national_toll_free_numbers'] = ['max:100'];
                $validationRules['national_internet_data'] = ['max:10000'];
                $validationRules['national_special_features'] = ['max:10000'];
                $validationRules['national_additonal_info'] = ['max:10000'];
                break;

            case 'plan_international_inclusion_form':
                $validationRules['international_voice_calls'] = ['max:100'];
                $validationRules['international_video_calls'] = ['max:100'];
                $validationRules['international_text'] = ['max:100'];
                $validationRules['international_mms'] = ['max:100'];
                $validationRules['international_diversion'] = ['max:100'];
                $validationRules['international_additonal_info'] = ['max:10000'];
                break;

            case 'plan_roaming_inclusion_form':
                $validationRules['roaming_charge'] = ['max:100'];
                $validationRules['roaming_voice_incoming'] = ['max:100'];
                $validationRules['roaming_voice_outgoing'] = ['max:100'];
                $validationRules['roaming_video_calls'] = ['max:100'];
                $validationRules['roaming_text'] = ['max:100'];
                $validationRules['roaming_mms'] = ['max:100'];
                $validationRules['roaming_voicemail_deposits'] = ['max:100'];
                $validationRules['roaming_internet_data'] = ['max:10000'];
                $validationRules['roaming_additonal_info'] = ['max:10000'];
                break;

            case 'plan_term_condition_form':
                $validationRules['term_title_content'] = ['bail', 'required'];
                break;

            case 'plan_reference_form':
                $validationRules['s_no'] = ['bail', 'required'];
                $validationRules['title'] = ['bail', 'required'];
                $validationRules['linktype'] = ['bail', 'required'];
                $validationRules['url'] = ['bail','required_if:linktype,1','url'];
                $validationRules['file'] = ['required_if:linktype,2'];
                break;
        }
        return $validationRules;
    }

    public function messages()
    {
        return [
            'name.required' => trans('mobile.formPage.basicDetails.name.errors.required'),
            'name.max' => trans('mobile.formPage.basicDetails.name.errors.max'),
            'connection_type.required' => trans('mobile.formPage.basicDetails.connection_type.errors.required'),
            'plan_type.required' => trans('mobile.formPage.basicDetails.plan_type.errors.required'),
            'cost.required' => trans('mobile.formPage.basicDetails.cost.errors.required'),
            'cost.numeric' => trans('mobile.formPage.basicDetails.cost.errors.numeric'),
            'cost.gt' => trans('mobile.formPage.basicDetails.cost.errors.gt'),
            // 'cost.between' => trans('mobile.formPage.basicDetails.cost.errors.between'),
            'cost.min' => trans('mobile.formPage.basicDetails.cost.errors.min'),
            'cost.max' => trans('mobile.formPage.basicDetails.cost.errors.max'),

            'plan_data.required' => trans('mobile.formPage.basicDetails.plan_data.errors.required'),
            'plan_data.numeric' => trans('mobile.formPage.basicDetails.plan_data.errors.numeric'),
            'plan_data.gt' => trans('mobile.formPage.basicDetails.plan_data.errors.gt'),
            'plan_data.min' => trans('mobile.formPage.basicDetails.plan_data.errors.min'),
            'plan_data.max' => trans('mobile.formPage.basicDetails.plan_data.errors.max'),

            'plan_data_unit.required' => trans('mobile.formPage.basicDetails.plan_data_unit.errors.required'),
            'network_type.required' => trans('mobile.formPage.basicDetails.network_type.errors.required'),
            'contract_id.required' => trans('mobile.formPage.basicDetails.contract_id.errors.required'),
            'activation_date_time.required' => trans('mobile.formPage.basicDetails.activation_date_time.errors.required'),

            'activation_date_time.date' => trans('mobile.formPage.basicDetails.activation_date_time.errors.date'),
            'deactivation_date_time.date' => trans('mobile.formPage.basicDetails.deactivation_date_time.errors.date'),

            'activation_date_time.after' => trans('mobile.formPage.basicDetails.activation_date_time.errors.after'),
            'deactivation_date_time.after' => trans('mobile.formPage.basicDetails.deactivation_date_time.errors.after'),

            'inclusion.required' => trans('mobile.formPage.basicDetails.inclusion.errors.required'),
            'details.required' => trans('mobile.formPage.basicDetails.details.errors.required'),

            'billing_preference.required' => trans('mobile.formPage.basicDetails.billing_preference.errors.required'),

            'new_connection_allowed.required' => trans('mobile.formPage.permissions_authorizations.new_connection_allowed.errors.required'),
            'port_allowed.required' => trans('mobile.formPage.permissions_authorizations.port_allowed.errors.required'),
            'retention_allowed.required' => trans('mobile.formPage.permissions_authorizations.retention_allowed.errors.required'),


            'national_voice_calls.max' => trans('mobile.formPage.nationalInclusion.national_voice_calls.errors.max'),
            'national_video_calls.max' => trans('mobile.formPage.nationalInclusion.national_video_calls.errors.max'),
            'national_text.max' => trans('mobile.formPage.nationalInclusion.national_text.errors.max'),
            'national_mms.max' => trans('mobile.formPage.nationalInclusion.national_mms.errors.max'),
            'national_directory_assist.max' => trans('mobile.formPage.nationalInclusion.national_directory_assist.errors.max'),
            'national_diversion.max'=> trans('mobile.formPage.nationalInclusion.national_diversion.errors.max'),
            'national_call_forwarding.max' => trans('mobile.formPage.nationalInclusion.national_call_forwarding.errors.max'),
            'national_voicemail_deposits.max'=> trans('mobile.formPage.nationalInclusion.national_voicemail_deposits.errors.max'),
            'national_toll_free_numbers.max' => trans('mobile.formPage.nationalInclusion.national_toll_free_numbers.errors.max'),
            'national_internet_data.max' => trans('mobile.formPage.nationalInclusion.national_internet_data.errors.max'),
            'national_special_features.max' => trans('mobile.formPage.nationalInclusion.national_special_features.errors.max'),
            'national_additonal_info.max' => trans('mobile.formPage.nationalInclusion.national_additonal_info.errors.max'),


            'international_voice_calls.max' => trans('mobile.formPage.internationalInclusion.international_voice_calls.errors.max'),
            'international_video_calls.max' => trans('mobile.formPage.internationalInclusion.international_video_calls.errors.max'),
            'international_text.max' => trans('mobile.formPage.internationalInclusion.international_text.errors.max'),
            'international_mms.max' => trans('mobile.formPage.internationalInclusion.international_mms.errors.max'),
            'international_diversion.max'=> trans('mobile.formPage.internationalInclusion.international_diversion.errors.max'),
            'international_additonal_info.max' => trans('mobile.formPage.internationalInclusion.international_additonal_info.errors.max'),


            'roaming_charge.max' => trans('mobile.formPage.roamingInclusion.roaming_charge.errors.max'),
            'roaming_voice_incoming.max' => trans('mobile.formPage.roamingInclusion.roaming_voice_incoming.errors.max'),
            'roaming_voice_outgoing.max' => trans('mobile.formPage.roamingInclusion.roaming_voice_outgoing.errors.max'),
            'roaming_video_calls.max' => trans('mobile.formPage.roamingInclusion.roaming_video_calls.errors.max'),
            'roaming_text.max' => trans('mobile.formPage.roamingInclusion.roaming_text.errors.max'),
            'roaming_mms.max' => trans('mobile.formPage.roamingInclusion.roaming_mms.errors.max'),
            'roaming_voicemail_deposits.max' => trans('mobile.formPage.roamingInclusion.roaming_voicemail_deposits.errors.max'),
            'roaming_internet_data.max'=> trans('mobile.formPage.roamingInclusion.roaming_internet_data.errors.max'),
            'roaming_additonal_info.max' => trans('mobile.formPage.roamingInclusion.roaming_additonal_info.errors.max'),


            'cancellation_fee.max' => trans('mobile.formPage.fees.cancellation_fee.errors.max'),
            'lease_phone_return_fee.max' => trans('mobile.formPage.fees.lease_phone_return_fee.errors.max'),
            'activation_fee.max' => trans('mobile.formPage.fees.activation_fee.errors.max'),
            'late_payment_fee.max' => trans('mobile.formPage.fees.late_payment_fee.errors.max'),
            'delivery_fee.max' => trans('mobile.formPage.fees.delivery_fee.errors.max'),
            'express_delivery_fee.max' => trans('mobile.formPage.fees.express_delivery_fee.errors.max'),
            'paper_invoice_fee.max' => trans('mobile.formPage.fees.paper_invoice_fee.errors.max'),
            'payment_processing_fee.max'=> trans('mobile.formPage.fees.payment_processing_fee.errors.max'),
            'minimum_total_cost.max' => trans('mobile.formPage.fees.minimum_total_cost.errors.max'),
            'other_fee_charges.max' => trans('mobile.formPage.fees.other_fee_charges.errors.max'),


            'term_title_content.required' => trans('mobile.formPage.tnc.term_title_content.errors.required'),

            's_no.required' => trans('mobile.formPage.planRef.modal.s_no.errors.required'),
            'title.required' => trans('mobile.formPage.planRef.modal.title.errors.required'),
            'linktype.required' => trans('mobile.formPage.planRef.modal.linktype.errors.required'),
            'url.required_if' => trans('mobile.formPage.planRef.modal.url.errors.required'),
            'file.required_if' => trans('mobile.formPage.planRef.modal.file.errors.required'),

            // 'dummy.required'=> trans('mobile.formPage.basicDetails.dummy.errors.required'),
        ];
    }
}
