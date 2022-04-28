<?php

namespace App\Http\Requests\Providers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;
use App\Rules\Providers\UniqueEmailCustom;
use Illuminate\Validation\Rule;

class ProviderRequest extends FormRequest
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
        if ($request['request_from'] == 'provider_basic_detail_form') {
            $rules = [
                'business_name' => "bail|required|regex:/^(?!\d+$)(?:[a-zA-Z0-9][a-zA-Z0-9 !@#$&'()-`.+]*)?+$/|max:50",
                'legal_name' => "bail|required|regex:/^(?!\d+$)(?:[a-zA-Z0-9][a-zA-Z0-9 !@#$&'()-`.+]*)?+$/|max:50",
                'abn' => 'bail|required|digits_between :9,11',
                'email' => ["required", "regex:/(.+)@(.+)\.(.+)/i", new UniqueEmailCustom($request)],
                'support_email' => 'sometimes|nullable|required_if:service_type,1|regex:/(.+)@(.+)\.(.+)/i',
                'complaint_email' => 'sometimes|nullable|required_if:service_type,1|regex:/(.+)@(.+)\.(.+)/i',
                'contact_no' => 'bail|required|numeric|digits_between :5,10',
                'address' => 'bail|required|max:200',
                'description' => ['required_if:service_type,1', 'max:1000'],
            ];
        }

        if ($request['request_from'] == 'provider_logo_form') {
            $rules = [
                'category_id' => 'required',
                'logo' => 'bail|required|mimes:png|dimensions:width=300,height=130',
                // 'logos' => ['nullable','mimes:jpeg,png,svg',new ProviderLogoDimension(Request::Input('height'),Request::Input('width'),Request::Input('category_id')) ],
                // 'logo.*' => ['required','mimes:jpeg,png,svg',new ProviderLogoDimension(Request::Input('height'),Request::Input('width'),Request::Input('category_id')) ],
                // 'width' => 'numeric|min:2|max:1500',
                // 'height' => 'numeric|min:2|max:1500',
            ];
        }

        if ($request['request_from'] == 'provider_permission_form') {
            if ($request['service_type_id'] == 1 || $request['service_type_id'] == 4) {
                $rules = [
                    'submit_sale_api' => 'required',
                    'life_support_allow' => 'required',
                    'life_support_energy_type' => ['required_if:life_support_allow,1'],
                    'e_retention_allow' => 'required',
                    'gas_sale_allow' => 'required',
                    'ea_credit_score_check_allow' => 'required',
                    'credit_score' => ['required_if:ea_credit_score_check_allow,1', 'numeric', 'between:1,99999.99', 'min:0', 'not_in:0', 'gt:0'],
                ];
            }

            if ($request['service_type_id'] != 1 && $request['service_type_id'] != 4) {
                $rules = [
                    'connection_allow' => 'required',
                    'port_allow' => 'required',
                    'retention_allow' => 'required',
                ];
            }
        }
        if($request['request_from'] == 'add_contact_form'){
            $rules = [
                'contact_name'=>'required',
                'contact_email'=>["required", "regex:/(.+)@(.+)\.(.+)/i"],
                'contact_designation'=>'required|min:2',
                'contact_description'=>'max:1000'
            ];
        }
        if ($request['request_from'] == 'billing_preference_form') {
            $rules = [
                'content_allow' => 'required|array',
                'content_allow_status' => 'required',
                'paper_bill_content' => ['required_if:content_allow_status,1', 'max:1000'],
            ];
        }

        if ($request['request_from'] == 'post_submission_form') {
            $rules = [
                // 'post_submission_service_type' => 'required',
                'what_happen_next_content' => 'required|max:1000',
                'why_us_content' => 'required|max:1000',
            ];
        }
        if ($request['request_from'] == 'terms_and_condition_form') {
            $rules = [
                'term_description' => 'required',
                'title' => 'required',
                'terms_and_condition_title' => ['required', Rule::in([1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17])]
            ];
        }
        if ($request['request_from'] == 'apply_now_popup_form') {
            $rules = [
                'pop_up_content' => ['required_if:show_plan_on,1', 'max:1000'],
            ];
        }
        if ($request['request_from'] == 'provider_manage_section_form') {
            if ($request['request_sub_from'] == 'personal_details_form') {
            }
            if ($request['request_sub_from'] == 'connection_details_form') {
                $rules = [
                    'conn_detail_status' => 'required',
                    'connection_detail' => ['required_if:conn_detail_status,1'],
                ];
            }
            if ($request['request_sub_from'] == 'identification_details_form') {
                $rules = [
                    'identification_detail_status' => 'required',
                    'identification_details' => ['required_if:identification_detail_status,1'],
                    'identification_details_sub_option.1' => ['required_if:identification_details.1,1'],
                    'identification_details_sub_option.2' => ['required_if:identification_details.2,1'],
                ];
            }
            if ($request['request_sub_from'] == 'employment_details_form') {
                $rules = [
                    'employment_detail_status' => 'required',
                    'employment_details' => ['required_if:employment_detail_status,1'],
                ];
            }
            if ($request['request_sub_from'] == 'connection_address_form') {
                $rules = [
                    'conn_address_detail_status' => 'required',
                    'connection_address' => ['required_if:conn_address_detail_status,1'],
                ];
            }
            if ($request['request_sub_from'] == 'billing_and_delivery_address_form') {
                $rules = [
                    'billing_delivery_detail_status' => 'required',
                    'billing_and_delivery_address' => ['required_if:billing_delivery_detail_status,1'],
                    'billing_and_delivery_address_sub_opt.1' => ['required_if:billing_and_delivery_address.1,1'],
                    'billing_and_delivery_address_sub_opt.2' => ['required_if:billing_and_delivery_address.2,1'],
                ];
            }
        }
        if ($request['request_from'] == 'direct_debit_setting_form') {
            $rules = [
                'direct_debit_status' => 'required',
                'payment_method' => ['required_if:direct_debit_status,1', 'array'],
                'debit_info_type' => ['required_if:direct_debit_status,1'],
                'card_info_status' => 'required',
                'card_info_content' => ['required_if:card_info_status,1'],
                'bank_info_status' => 'required',
                'bank_info_content' => ['required_if:bank_info_status,1','max:1000']
            ];
        }
        if ($request['request_from'] == 'footer_content_form') {
            $rules = [
                'footer_content' => 'max:1000',
            ];
        }
        if ($request['request_from'] == 'statewise_consent_form') {
            if ($request['eic_type_checkbox'] == 'master') {
                $rules = [
                    'statewise_consent_content' => 'required'
                ];
            }
            if ($request['eic_type_checkbox'] == 'state') {
                $rules = [
                    'select_consent_state' => 'required',
                    'statewise_consent_content' => 'required'
                ];
            }
        }
        if ($request['request_from'] == 'satellite_eic_form') {
            $rules = [
                'satellite_eic_status' => 'required',
                'satellite_eic_description' => ['required_if:satellite_eic_status,1']
            ];
        }
        if ($request['request_from'] == 'tele_sale_setting_form') {
            $rules = [
                'allow_telecom' => 'required',
                'allow_send_plan' => 'required',
                'telesale_eic_allow' => 'required',
                'select_tele_sale_state' => 'required',
                'tele_sale_setting_content' => ['required_if:telesale_eic_allow,1'],
            ];
        }
        if ($request['request_from'] == 'provider_outbound_link_form') {
            // $regex = '/^((https)?:\/\/)?([\da-z\.-]+)\.([a-z\.]{2,6})([\/\w \.-]*)*\/?$/';
            $regex="/^http(s?)\:\/\/[0-9a-zA-Z]([-.\w]*[0-9a-zA-Z])*(:(0-9)*)*(\/?)([a-zA-Z0-9\-\.\?\,\'\/\\\+&amp;%\$#_]*)?$/";
            $rules = [
                'link_title' => 'required|max:99',
                'link_url' => 'required|max:99|regex:'.$regex,
                'order' => 'required|numeric|min:1',
            ];
        }
        if ($request['request_from'] == 'acknowledgement_content_form') {
            $rules = [
                'acknowledgment_status' => 'required',
                'acknowledgment_content' => ['required_if:acknowledgment_status,1'],
            ];
        }
        return $rules;
    }

    public function messages()
    {
        return [
            'business_name.required' => trans('providers.business_name_required'),
            'legal_name.required' => trans('providers.legal_name_required'),
            // 'legal_name.required' => trans('providers.legal_name_unique'),
            'abn.required' => trans('providers.abn_required'),
            'abn.digits_between' => trans('providers.abn_digit'),
            'email.unique' => trans('providers.email_unique'),
            'email.required' => trans('providers.email_required'),
            'email.email' => trans('providers.valid_email_required'),
            'support_email.required_if' => trans('providers.support_email_required'),
            'support_email.email' => trans('providers.valid_email_required'),
            'complaint_email.required_if' => trans('providers.complaint_email_required'),
            'complaint_email.email' => trans('providers.valid_email_required'),
            'contact_no.required' => trans('providers.contact_no_required'),
            'contact_no.numeric' => trans('providers.contact_no_numeric'),
            'contact_no.digits_between' => trans('providers.contact_no_digits_between'),
            'address.required' => trans('providers.address_required'),
            'description.required_if' => trans('providers.description_required'),

            'category_id.required' => trans('providers.category_id_required'),
            'logo.required' => trans('providers.logo_required'),
            'logo.dimensions' => trans('providers.logo_dimensions'),

            'submit_sale_api.required' => trans('providers.submit_sale_api_required'),
            'life_support_allow.required' => trans('providers.life_support_allow_required'),
            'life_support_energy_type.required_if' => trans('providers.life_support_energy_type_required'),
            'e_retention_allow.required' => trans('providers.e_retention_allow_required'),
            'gas_sale_allow.required' => trans('providers.gas_sale_allow_required'),
            'ea_credit_score_check_allow.required' => trans('providers.ea_credit_score_check_allow_required'),
            'credit_score.required' => trans('providers.credit_score_required'),
            'credit_score.numeric' => trans('providers.credit_score_numeric'),
            'credit_score.max' => trans('providers.credit_score_between'),
            'credit_score.between' => trans('providers.credit_score_between'),
            'credit_score.not_in' => trans('credit_score_not_in'),
            'credit_score.min' => trans('providers.credit_score_min'),
            'content_allow.required' => trans('providers.content_allow_required'),
            'content_allow_status.required' => trans('providers.content_allow_status_required'),
            'paper_bill_content.required_if' => trans('providers.paper_bill_content_required'),

            'post_submission_service_type.required' => trans('providers.post_submission_service_type_required'),
            'what_happen_next_content.required' => trans('providers.what_happen_next_content_required'),
            'why_us_content.required' => trans('providers.why_us_content_required'),

            'is_apply_popup_status.required' => trans('providers.is_apply_popup_status_required'),
            'pop_up_content.required_if' => trans('providers.pop_up_content_required'),

            'connection_detail.required_if' => trans('providers.identification_option_required'),
            'identification_details_sub_option.required_if' => trans('providers.identification_option_required'),
            'identification_details_sub_option.1.required_if' => trans('providers.identification_option_required'),
            'identification_details_sub_option.2.required_if' => trans('providers.identification_option_required'),
            'employment_details.required_if' => trans('providers.identification_option_required'),
            'connection_address.required_if' => trans('providers.identification_option_required'),
            'billing_and_delivery_address_sub_opt.1.required_if' => trans('providers.identification_option_required'),
            'billing_and_delivery_address_sub_opt.2.required_if' => trans('providers.identification_option_required'),

            'direct_debit_status.required' => trans('providers.direct_debit_status_required'),
            'debit_info_type.required_if' => trans('providers.debit_info_type_required'),
            'payment_method.required_if' => trans('providers.payment_method_required'),
            'card_info_status.required' => trans('providers.card_info_status_required'),
            'card_info_content.required_if' => trans('providers.card_info_content_required'),
            'bank_info_status.required' => trans('providers.bank_info_status_required'),
            'bank_info_content.required_if' => trans('providers.bank_info_content_required'),

            'footer_content.max' => trans('providers.footer_content_max'),

            'select_consent_state.required' => trans('providers.select_consent_state_required'),
            'statewise_consent_content.required' => trans('providers.statewise_consent_content_required'),

            'satellite_eic_status.required' => trans('providers.satellite_eic_status_required'),
            'satellite_eic_description.required_if' => trans('providers.satellite_eic_description_required'),

            'allow_telecom.required' => trans('providers.allow_telecom_required'),
            'allow_send_plan.required' => trans('providers.allow_send_plan_required'),
            'telesale_eic_allow.required' => trans('providers.telesale_eic_allow_required'),
            'select_tele_sale_state.required' => trans('providers.select_tele_sale_state_required'),
            'tele_sale_setting_content.required_if' => trans('providers.tele_sale_setting_content_required'),

            'acknowledgment_status.required' => trans('providers.acknowledgment_status_required'),
            'acknowledgment_content.required_if' => trans('providers.acknowledgment_content_required'),

        ];
    }
}
