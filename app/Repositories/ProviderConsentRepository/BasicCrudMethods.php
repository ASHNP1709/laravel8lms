<?php

namespace App\Repositories\ProviderConsentRepository;

use DB;
use Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\{ProviderContent, ProviderContentCheckbox, Providers, UserAddress, User, ProviderSection, ProviderSectionOption, ProviderSectionSubOption, ProviderPermission, ProviderDirectDebit, ProviderOutboundLink, ProvidersIp, UserService, UserStates, UserSuburb, UserPostcode, Postcode, States, ProvderMovein, ProviderContact, SectionCustomFields, PlanEnergy, ProviderFieldPlan, PlanMobile, PlansBroadband};
use Laravel\Socialite\Contracts\Provider;

trait BasicCrudMethods
{
	//Fetch and filters
	public static function getFilters($condition = null, $columns = '*', $relations = null, $filters = null, $relationMandatory = true)
	{
		$data = request()->all();
		$filterColumns = ['service_id'];
		$query = self::select($columns);

		if ($condition) {
			$query = $query->where($condition);
		}
		$query = self::where($condition)->select($columns);
		if ($relations) {
			foreach ($relations as $relation  => $select) {
				$relationData = ['data' => $data, 'filters' => $filters, 'relation' => $relation, 'filterColumns' => $filterColumns, 'select' => $select];
				if ($relationMandatory) {

					$query = $query->whereHas($relation, function ($query) use ($relationData) {

						if ($relationData['relation'] == 'getProviderServices' && $relationData['filters']) {
							foreach ($relationData['filterColumns'] as $key) {
								if (isset($relationData['data'][$key]) && !empty($relationData['data'][$key])) {
									$query->where($key, $relationData['data'][$key]);
								}
							}
						}
					});
				}
				$query = $query->with($relation, function ($query) use ($select) {
					$query->select($select);
				});
			}
		}
		return $query->get();
		// return $query->paginate(config('env.PAGINATION_PERPAGE_COUNT'));
	}

	public static function modifyProviderResponse($provideruser, $info)
	{
		$data = [];
		foreach ($provideruser as $key => $provider) {

			array_push($data, [
				'userid' => $provider['user_id'],
				'name'   => decryptGdprData($provider['legal_name']),
				'email'  => decryptGdprData($provider['user']['email']),
				'logo'   => ($provider['logo'] == null) ? asset(theme()->getMediaUrlPath() . 'avatars/blank.png') : $provider['logo'],
				'status' => $provider['status'],
				'id'     => encryptGdprData($provider['user_id']),
				'service_id'     => $provider->getProviderServices[0]['service_id'],
				'service_id_encrypt'     => encryptGdprData($provider->getProviderServices[0]['service_id']),
			]);
		}
		return $data;
	}

	/**
	 * Edit provider.
	 *
	 * @param   $request
	 * @return \Illuminate\Http\Response
	 */
	public static function updateProviderDetail($request)
	{ 
		
		try {
			$data = [];
			$updateProvider = 0;
			$status = 'true';
			$case = 1;
			$stateId = 0;
			if ($request->eic_type_checkbox == "state" && $request->select_consent_state) {
				$stateId = $request->select_consent_state;
			}
			// $master_tab_manage_section = config('app.master_tab_manage_section');
			$provider = [];
			switch ($request->request_from) {
				case "terms_and_condition_form":
					$data['type'] = $request->terms_and_condition_title;
					$data['title'] = $request->title;
					$data['provider_id'] = $request->user_id;
					$data['description'] = $request->term_description;
					break;
				case "acknowledgement_content_form":
					$data['status'] = $request->acknowledgment_status;
					$data['description'] = $request->acknowledgment_content;
					$data['provider_id'] = $request->user_id;
					$data['type'] = "17"; 
					break;
				case "footer_content_form":
					$data['description'] = $request->footer_content;
					$data['provider_id'] = $request->user_id;
					$data['type'] = "13";
					break;
				case "satellite_eic_form":
					$data['status'] = $request->satellite_eic_status;
					$data['description'] = $request->satellite_eic_description;
					$data['provider_id'] = $request->user_id;
					$data['type'] = "15";
					break;
				case "statewise_consent_form":
					$data['description'] = $request->statewise_consent_content;
					$data['state_id'] = $stateId;
					$data['provider_id'] = $request->user_id;
					$data['type'] = "14";
					break;
				case "post_submission_form":
					$data['description'] = $request->what_happen_next_content;
					$data['why_us'] = $request->why_us_content;
					$data['provider_id'] = $request->user_id;
					$data['type'] = "11";
					$data['service_type'] = $request->service_type_id;
					break;
				case "apply_now_popup_form":
					$data['description'] = $request->pop_up_content;
					$data['show_plan_on'] = $request->show_plan_on;
					$data['provider_id'] = $request->user_id;
					$data['type'] = "12";
					break;
				case "tele_sale_setting_form":
					$data['status'] = $request->telesale_eic_allow;
					$data['provider_id'] = $request->user_id;
					$data['state_id'] = $request->select_tele_sale_state;
					$data['description'] = $request->tele_sale_setting_content;
					$data['type'] = "16";
					break;
				case "billing_preference_form":
					$data['e_billing_preference_option'] = implode(',', $request->content_allow);
					$data['status'] = $request->content_allow_status;
					$data['description'] = $request->paper_bill_content;
					$data['provider_id'] = $request->user_id;
					$data['type'] = "10";
					break;
				case "provider_manage_section_form":
					$response = self::updateProviderManageSection($request);
					if ($response['status'] == 'true') {
						$updateProvider = 1;
					}
					$case = 2;
					break;
				case "provider_permission_form":
					return $response = self::createUpdateProviderPermission($request);
					if ($response['status'] == 'true') {
						$updateProvider = 1;
					}
					$case = 3;
					break;
				case "provider_outbound_link_form":
					return $response = self::createUpdateProviderOutBoundLink($request);
					if ($response['status'] == 'true') {
						$updateProvider = 1;
					}
					$case = 4;
					break;
				case "direct_debit_setting_form":
					return $response = self::createUpdateProviderDirectDebitSetting($request); //dd($response);

					if ($response['status'] == 'true') {
						$updateProvider = 1;
					}
					$case = 5;
					break;
			}
			if ($case == 1) {
				if (!$data) {
					//    return response()->json(['status' => 400, 'message' => 'False']);
					$status = 'false';
				} else {
					$condition['provider_id'] = $request->user_id;
					$condition['type'] = $data['type'];
					if ($request->request_from == "statewise_consent_form" && $request->eic_type_checkbox == "master") {
						$condition['state_id'] = $stateId;
					} else {
						$condition['state_id'] = $request->select_consent_state;
					}
					$response = ProviderContent::updateOrCreate($condition, $data);
					if ($request->request_from == "tele_sale_setting_form") {
						ProviderPermission::updateOrCreate(['user_id' => $request->user_id], ["is_telecom" => $request->allow_telecom, "is_send_plan" => $request->allow_send_plan]);
					}
					$status = 'true';
				}
			}

			if ($status == 'true' || $updateProvider) {
				if ($request->request_from == "apply_now_popup_form") {
					return response()->json(['status' => 200, 'message' => 'Apply now content saved successfully']);
				}
				else if ($request->request_from == "billing_preference_form") {
					return response()->json(['status' => 200, 'message' => 'Billing preference changes saved successfully']);
				}else if($request->request_from == 'statewise_consent_form'){
					return response()->json(['status' => 200, 'message' => 'Statewise consent added successfully']);		
				}else if($request->request_from == 'acknowledgement_content_form'){
					return response()->json(['status' => 200, 'message' => 'Acknowledgement added successfully']);		
				}
				else {
					return response()->json(['status' => 200, 'message' => 'Data Saved Successfully']);
				}	
			}
			return response()->json(['status' => 400, 'message' => 'False']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	// store or upadte provider contact

	public static function storeOrUpdateContact($request)
	{
		try {
			if ($request) {
				$id = '';
				$msg = 'Contact has been added succesfully';
				$email=$request->contact_email;
				$user_id=$request->user_id;
				$contactId=$request->contactId;
				if(!empty($email) && !empty($contactId)){
					$editResult=ProviderContact::where(['email'=> $email])->whereNotIn('id',[$contactId])->count();
					if($editResult>=1){
						$msg='Email already exists';
						return ['contactdata'=>'','status'=> true,'message'=>$msg];
					}
				}else if(!empty($email) && empty($contactId)){
					$addResult=ProviderContact::where(['email'=>$email])->count();
					if($addResult>=1){
						$msg='Email already exists';
						return ['contactdata'=>'','status'=> true,'message'=>$msg];
					}
				}
				if (isset($contactId) && $contactId != "") {
					$id = $contactId; //table id
					$msg = trans('Contact has been updated succesfully');
				}
				$data = [
					'name' => $request->contact_name,
					'provider_id' => $user_id,
					'email' => $email,
					'designation' => $request->contact_designation,
					'description' => $request->contact_description,
				];
				ProviderContact::updateOrCreate(['id' => $id], $data);
				$contactdata = ProviderContact::where('provider_id', $request->user_id)->orderBy('created_at', 'desc')->get()->toArray();
				return ['contactdata' => $contactdata, 'status' => true, 'message' => $msg];
			}
		} catch (\Exception $err) {
			throw $err;
		}
	}

	public static function deletecontact($request, $id)
	{
		try {
			$response = ProviderContact::where('id', $id)->delete();
			if ($response) {
				$data = ProviderContact::where('provider_id', $request->user_id)->orderBy('created_at', 'desc')->get()->toArray();
				$status = true;
				$message = 'Deleted';
			} else {
				$status = false;
				$message = 'Not deleted';
			}

			return ['data' => $data, 'status' => $status, 'message' => $message];
		} catch (\Exception $err) {
			throw $err;
		}
	}

	/**
	 * get provider data on change of selectbox.
	 *
	 * @param   $request
	 * @return \Illuminate\Http\Response
	 */
	public static function getSpecificTermData($request)
	{
		try {
			$response = ProviderContent::where(['provider_id' => $request->user_id, "type" => $request->type])->with('getcontentcheckbox')->get()->toArray();
			return response()->json(["data" => $response], 200);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}


	/**
	 * Store or update checkbox of provider.
	 *
	 * @param   $request
	 * @return \Illuminate\Http\Response
	 */
	public static function storeOrUpdateCheckbox($request)
	{
		try {
			$data = [];
			switch ($request->form_name) {
				case "terms_condition_checkbox_form":
					$data['checkbox_required'] = $request->terms_checkbox_required;
					$data['validation_message'] = $request->terms_condition_validates;
					$data['content'] = $request->terms_checkbox_content;
					$data['status'] = $request->term_checkbox_status_save;
					break;
				case "provider_ackn_checkbox_formm":
					$data['checkbox_required'] = $request->ackn_checkbox_required;
					$data['validation_message'] = $request->ackn_validation_msg;
					$data['content'] = $request->ackn_checkbox_content;
					$data['status'] = $request->ackn_checkbox_status_save;
					$request->request->add(['type' => '17']);
					break;
				case "tele_sale_setting_checkbox_form":
					$data['content'] = $request->tele_sale_setting_checkbox_content;
					$data['checkbox_required'] = $request->tele_sale_setting_checkbox_required;
					$data['validation_message'] = $request->tele_sale_setting_validation_msg;
					$data['status'] = $request->tele_sale_setting_checkbox_save_status;
					$data['type'] = $request->tele_select_eic_type;
					$request->request->add(['type' => '16']);
					break;
				case "state_checkbox_form":
					$data['content'] = $request->state_eic_content_checkbox_content;
					$data['checkbox_required'] = $request->state_eic_content_checkbox_required;
					$data['validation_message'] = $request->state_eic_content_validation_msg;
					$data['status'] = $request->state_eic_content_checkbox_save_status;
					$data['type'] = $request->statewise_select_eic_type;
					$request->request->add(['type' => '14']);
					break;
				case "master_checkbox_form":
					$data['content'] = $request->state_eic_content_checkbox_content;
					$data['checkbox_required'] = $request->state_eic_content_checkbox_required;
					$data['validation_message'] = $request->state_eic_content_validation_msg;
					$data['status'] = $request->state_eic_content_checkbox_save_status;
					$data['type'] = $request->statewise_select_eic_type;
					$request->request->add(['type' => '14']);
					break;
				case "debit_checkbox_form":
					$data['content'] = $request->debit_checkbox_content;
					$data['checkbox_required'] = $request->debit_checkbox_required;
					$data['validation_message'] = $request->debit_validation_msg;
					$data['type'] = 18;
					$data['info_type'] = $request->debit_info_type;
					$request->request->add(['type' => '18']);
					break;
				case "post_submission_checkbox_form":
					$data['checkbox_required'] = $request->post_submission_checkbox_required;
					$data['validation_message'] = $request->post_submission_validation_msg;
					$data['content'] = $request->post_submission_checkbox_content;
					$request->request->add(['type' => '11']);
					break;
			}
			//dd($request->all(),$data, $exist_data);
			if ($request->form_name != 'debit_checkbox_form') {
				$validate = [];
				if ($request->form_name == 'state_checkbox_form') {
					$validate['state_id'] = $request->state;
				}
				else if ($request->form_name == 'master_checkbox_form') {
					$validate['state_id'] = $request->state;
				}
				$validate['provider_id'] = $request->user_id;
				$validate["type"] = $request->type;
				$exist_data = ProviderContent::where($validate)->with('getcontentcheckbox')->first();
				if ($exist_data) {
					$data['provider_content_id'] = $exist_data->id;
					ProviderContentCheckbox::updateOrCreate(['id' => $request->id], $data);

					$response = ProviderContent::select('id')->where(['provider_id' => $request->user_id, "type" => $request->type])->with('getcontentcheckbox')->get()->toArray();
					return response()->json(["data" => $response, 'message' => trans('providers.provider_acknowledgement_checkbox_added'), 'status' => 200]);
				}
			} else {
				$exist_data = ProviderDirectDebit::where(['user_id' => $request->user_id])->first();

				if ($exist_data) {
					$data['provider_content_id'] = $exist_data->id;
					ProviderContentCheckbox::updateOrCreate(['id' => $request->id], $data);

					$response = ProviderDirectDebit::select('id')->where(['user_id' => $request->user_id])->with('getcontentcheckbox')->get()->toArray();
					return response()->json(["data" => $response, 'message' => trans('providers.provider_direct_debit_card_checkbox_added'), 'status' => 200]);
				}
			}
			return response()->json(['status' => 400, 'message' => 'Please add content first.']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	/**
	 * remove checkbox of provider.
	 *
	 * @param   $request
	 * @return \Illuminate\Http\Response
	 */
	public static function removeCheckbox($request)
	{
		try {
			$response = ProviderContentCheckbox::where('id', $request->id)->delete();
			if ($response) {
				return response()->json(['status' => 200, 'message' => "Success", 'data' => $response]);
			}
			return response()->json(['status' => 400, 'message' => 'Failed']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	/**
	 * create provider
	 */
	public static function insertProvider($request)
	{ 
		\DB::beginTransaction();
		try {
			$status = 'true';
			$request['email'] = encryptGdprData(strtolower($request['email']));
			$request['phone'] = encryptGdprData($request['contact_no']);
			$addUser = self::createProviderUser($request, 'provider');

			if ($addUser['status']) {
				$status = 'true';
				$addProvider = 0;
				if ($request['request_from'] == 'provider_basic_detail_form') {
					$provider['user_id'] = $addUser['user_id'];
					//$provider['service_id'] = $request['service_type_id']; 
					$provider['service_id'] = $request['service_type_id'];
					$provider['status'] = 1;
					$provider['name'] = encryptGdprData(strtolower($request['business_name']));
					$provider['legal_name'] = encryptGdprData(strtolower($request['legal_name']));
					$provider['abn_acn_no'] = $request['abn']; //encryptGdprData($request['abn']);
					$provider['support_email'] = encryptGdprData($request['support_email']);
					$provider['complaint_email'] = encryptGdprData($request['complaint_email']);
					$provider['description'] = $request['description'];
					if (!$provider) {
						return response()->json(['status' => 200, 'message' => 'False']);
					}
					$addProvider = Providers::updateOrCreate([
						'user_id' => $addUser['user_id']
					], $provider);
				}
				if ($addProvider) {
					//Add services
					$services = [];
					$services['user_id'] = $addUser['user_id'];
					//$services['service_id'] = $request['service_type_id']; 
					$services['service_id'] = $request['service_type_id'];
					$services['user_type'] = 2; //dd($services,$request->all());
					$addServices = UserService::updateOrCreate(['user_id' => $addUser['user_id']], $services);
					if (!$addServices) {
						$status = 'false';
					}

					//Add address
					$address['user_id'] = $addUser['user_id'];
					$address['address'] = $request['address'];
					$address['address_type'] = 7;
					$addAddress = UserAddress::updateOrCreate(['user_id' => $addUser['user_id']], $address);
					if (!$addAddress) {
						$status = 'false';
					}
				} else {
					$status = 'false';
				}
			} else {
				$status = 'false';
			}
			if ($status == 'true') {
				\DB::commit();
				$http_status = 200;
				$message = trans('providers.provider_created');
			} else {
				\DB::rollback();
				$http_status = 400;
				$message = trans('providers.provider_notcreated');
			}

			return ['status' => $http_status, 'message' => $message];
		} catch (\Exception $err) {
			\DB::rollback();
			return ['status' => 400, 'message' => $err->getMessage()];
		}
	}

	/**
	 * update provider manage section setting
	 */
	public static function updateProviderManageSection($request)
	{
		// \DB::beginTransaction();
		try { //dd($request->all());
			$status = 'true';
			$identity_data = [];
			$identity_data['user_id'] = $request['user_id'];
			$identity_data['service_id'] = $request['service_type_id'];
			if ($request['request_sub_from'] == 'personal_details_form') {
				$identity_data['section_id'] = $request['section_type_id'];
				$identity_data['section_status'] = isset($request['personal_details']) ? 1 : 0;
				$identity_data['section_script'] = $request['personal_detail_script'];
				$identity_data['section_option'] = $request['personal_details'];
			}
			if ($request['request_sub_from'] == 'connection_details_form') {
				$identity_data['section_id'] = $request['section_type_id'];
				$identity_data['section_status'] = $request['conn_detail_status'];
				$identity_data['section_option'] = $request['connection_detail'];
				$identity_data['section_script'] = $request['connection_detail_script'];
			}
			if ($request['request_sub_from'] == 'identification_details_form') {
				$identity_data['section_id'] = $request['section_type_id'];
				$identity_data['section_status'] = $request['identification_detail_status'];
				$identity_data['acknowledgement'] = $request['identification_details_acknowledgement'];
				$identity_data['section_option'] = $request['identification_details'];
				$identity_data['is_required'] = $request['is_required'];
				$identity_data['section_sub_option'] = $request['identification_details_sub_option'];
				$identity_data['section_script'] = $request['identity_detail_script'];
				
			}
			if ($request['request_sub_from'] == 'employment_details_form') {
				$identity_data['section_id'] = $request['section_type_id'];
				$identity_data['section_status'] = $request['employment_detail_status'];
				$identity_data['section_script'] = $request['employment_detail_script'];
				$identity_data['section_option'] = $request['employment_details'];
			}
			if ($request['request_sub_from'] == 'connection_address_form') {
				$identity_data['section_id'] = $request['section_type_id'];
				$identity_data['section_status'] = $request['conn_address_detail_status'];
				$identity_data['section_script'] = $request['connection_address_script'];
				$identity_data['section_option'] = $request['connection_address'];
			}
			if ($request['request_sub_from'] == 'billing_and_delivery_address_form') {
				$identity_data['section_id'] = $request['section_type_id'];
				$identity_data['section_status'] = $request['billing_delivery_detail_status'];
				$identity_data['section_option'] = $request['billing_and_delivery_address'];
				$identity_data['section_sub_option'] = $request['billing_and_delivery_address_sub_opt'];
				$identity_data['section_script'] = $request['billing_delivery_detail_script'];
			}
			//save provider section
			$providerSection = ProviderSection::updateOrCreate(['user_id' => $request['user_id'], 'service_id' => $request['service_type_id'], 'section_id' => $identity_data['section_id']],$identity_data);
			
			
			if ($providerSection) {
				$status = 'true';
				$section_id = $providerSection->id;
			}
			$section_option = [];
			// if ($request['section_type_id'] == 3) {
			// 	ProviderSection::where('id', $section_id)->update(['section_script' => $identity_data['section_script'], 'acknowledgement' => $identity_data['acknowledgement']]);
			// }
			
			ProviderSectionOption::where('provider_section_id', $section_id)->update(['section_option_status' => 0, 'min_value_limit' => 0, 'max_value_limit' => 0, 'is_required' => 0]);
			//echo "<pre>"; print_r($request['employment_details_year_option']); die('--');	
			if ($identity_data['section_status'] == 1) {
				if (!empty($identity_data['section_option'])) {
					foreach ($identity_data['section_option']  as $key => $value) {
						if ($request['request_sub_from'] == 'identification_details_form' || $request['request_sub_from'] == 'billing_and_delivery_address_form') {

						$year = $request['employment_details_year_option'] ?? 0;
						$month = $request['employment_details_month_option'] ?? 0;
						$section_option = ProviderSectionOption::updateOrCreate(['provider_section_id' => $section_id, 'section_option_id' => $key], ['section_option_status' => $value, 'min_value_limit' => $month, 'max_value_limit' => $year]);

						$section_option_id = $section_option->id;
						}
						
							
						if ($request['section_type_id'] == 3) {
							ProviderSectionOption::where('id', $section_option_id)->update(['is_required' => $identity_data['is_required'][$key]]);
						}
						//echo "<pre>section_id-".$section_id.";section_option_id:-".$value.";min_value_limit:-".$month.";max_value_limit:-".$year; die('--');	
						//save sub option
						ProviderSectionSubOption::where('section_option_id', $section_option_id)->update(['section_sub_option_status' => 0]);
						if (isset($identity_data['section_sub_option'])) {
							if (isset($request['billing_and_delivery_address_sub_opt'][$key])) {
								foreach ($request['billing_and_delivery_address_sub_opt'][$key] as $k => $val) {
									ProviderSectionSubOption::updateOrCreate(
										[
											'section_option_id' => $section_option_id,
											'section_sub_option_id' => $k
										],
										['section_sub_option_status' => $val]
									);
								}
							}
							if (isset($request['identification_details_sub_option'])) {
								foreach ($request['identification_details_sub_option']as $key => $val) {
									foreach($val as $sub_key => $sub_value){
										$res=ProviderSectionSubOption::updateOrCreate(['section_option_id' => $section_option_id, 'section_sub_option_id' => $key], ['section_sub_option_status' => $sub_value]);
									}
									
								}
							}
						}
					}
				}
				$status = 'true';
			}


			if ($status == 'true') {
				// \DB::commit();
				$http_status = 200;
				$message = trans('providers.provider_created');
			} else {
				// \DB::rollback();
				$http_status = 400;
				$message = trans('providers.provider_notcreated');
			}

			return ['status' => $http_status, 'message' => $message];
		} catch (\Exception $err) {
			// \DB::rollback();
			return ['status' => 400, 'message' => $err->getMessage()];
		}
	}

	/**
	 * create user and return userId for provider
	 */
	public static function  createProviderUser($request, $role_type)
	{
		try {
			// $role_id = Role::where('name', $role_type)->pluck('id')->first();
			$login_id = Auth::id();
			$user = User::updateOrCreate(['id' => $request['user_id']], [
				'first_name' => '',
				'last_name' => '',
				'email' => $request['email'],
				'phone' => $request['phone'],
				// 'role' => $role_id,
				'status' => '1',
				// 'password' => Hash::make($password),
				'created_by' => $login_id,
				'status' => 1,
			]);
			if ($user) {
				// $user->assignRole($role_type);
				return ['status' => true, 'user_id' => $user->id];
			}
			return ['status' => false];
		} catch (\Exception $err) {
			return ['status' => false, 'message' => $err->getMessage()];
		}
	}

	//Common function for fetch provider data
	public static function getProviderList($condition = null, $columns = '*', $relations = null, $withPagination = null)
	{
		$query = self::select($columns);

		if ($condition) {
			$query = $query->where($condition);
		}
		$query = self::where($condition)->select($columns)->orderBy('id', 'DESC');
		if ($relations) {
			foreach ($relations as $relation  => $select) {
				$query = $query->with([$relation => function ($query) use ($select) {
					$query->select($select);
				}]);
			}
		}

		// if($withPagination){
		// 	return $query->paginate(1);
		// }Provider

		return $query->get()->toArray();
	}




	public static function getProviderDetails($condition = null, $columns = '*', $relations = null, $withPagination = null)
	{
		$query = self::select($columns);

		if ($condition) {
			$query = $query->where($condition);
		}
		$query = self::where($condition)->select($columns);
		if ($relations) {
			foreach ($relations as $relation  => $select) {
				$query = $query->with([$relation => function ($query) use ($select) {
					$query->select($select);
				}]);
			}
		}

		// if($withPagination){
		// 	return $query->paginate(1);
		// }Provider

		return $query->get()->toArray();
	}





	public static function updateStatus($request)
	{
		\DB::beginTransaction();
		try {
			$status = $request['status'];
			$user_id = decryptGdprData($request['user_id']);
			$providerStatus = Providers::where('user_id', $user_id)->update(['status' => $status]);
			if ($providerStatus) {
				$providerUserStatus = User::where('id', $user_id)->update(['status' => $status]);
				if ($providerUserStatus) {
					$status = 'true';
				} else {
					$status = 'false';
				}
			} else {
				$status = 'false';
			}

			if ($status == 'true') {
				\DB::commit();
				$http_status = 200;
				$message = trans('providers.provider_status_update');
			} else {
				\DB::rollback();
				$http_status = 400;
				$message = trans('providers.provider_status_notupdate');
			}

			return ['status' => $http_status, 'message' => $message];
		} catch (\Exception $err) {
			\DB::rollback();
			return ['status' => 400, 'message' => $err->getMessage()];
		}
	}

	public static function createUpdateProviderPermission($request)
	{
		\DB::beginTransaction();
		try {
			$data = [];
			$status = 'true';
			//'is_telecom','is_send_plan'
			if ($request->service_type_id == 1 || $request->service_type_id == 4) {
				$data['user_id'] = $request->user_id;
				$data['is_submit_sale_api'] = $request->submit_sale_api;
				$data['is_life_support'] = $request->life_support_allow;
				$data['life_support_energy_type'] = isset($request->life_support_energy_type) ? $request->life_support_energy_type : 0;
				$data['is_retention'] = $request->e_retention_allow;
				$data['is_gas_only'] = $request->gas_sale_allow;
				$data['is_demand_usage'] = $request->manage_demand_status;
				$data['ea_credit_score_allow'] = $request->ea_credit_score_check_allow;
				$data['credit_score'] = $request->credit_score;
			}
			if ($request->service_type_id != 1 && $request->service_type_id != 4) {
				$data['user_id'] = $request->user_id;
				$data['is_new_connection'] = $request->connection_allow;
				$data['is_port'] = $request->port_allow;
				$data['is_retention'] = $request->retention_allow;
			}

			if (!$data) {
				$status = 'false';
			} else {
				$response = ProviderPermission::updateOrCreate(['user_id' => $request->user_id], $data);
			}

			if ($status == 'true') {
				\DB::commit();
				$http_status = 200;
				$message = trans('providers.providerpermission_updated');
			} else {
				\DB::rollback();
				$http_status = 400;
				$message = trans('providers.providerpermission_notupdated');
			}
			return response()->json(['message' => $message, 'status' => $http_status]);
		} catch (\Exception $err) {
			\DB::rollback();
			// return ['status' => 400, 'message' => $err->getMessage()];
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}
	public static function createUpdateProviderOutBoundLink($request)
	{
		\DB::beginTransaction();
		try {
			$data = [];
			$response = '';
			$status = 'true';
			$data['user_id'] = $request->user_id;
			$data['order'] = $request->order;
			$data['link_title'] = $request->link_title;
			$data['link_url'] = $request->link_url;
			//  dd($request->all(),$data);

			$linkCountOrder = ProviderOutboundLink::where('user_id', $request->user_id)->where('order', $request->order);
			if (isset($request->link_id) && $request->link_id != null) {
				$linkCountOrder = $linkCountOrder->where('id', '!=', $request->link_id);
			}
			$linkCountOrder = $linkCountOrder->select('id')->get();
			if (count($linkCountOrder) > 0) {
				// return response()->json(['success' => false,'message'=>'Order type already exists.','status'=>422],422);
				$errors['order'] = 'Order type already exists.';
				return response()->json(['status' => 422, 'errors' => $errors], 422);
			}
			if (!$data) {
				$status = 'false';
			} else {
				ProviderOutboundLink::updateOrCreate(['user_id' => $request->user_id, 'id' => $request->link_id], $data);
				$response = ProviderOutboundLink::where('user_id', $request->user_id)->orderBy('order', 'ASC')->get()->toArray();
			}

			if ($status == 'true') {
				\DB::commit();
				$http_status = 200;
				$message = trans('providers.provider_created');
			} else {
				\DB::rollback();
				$http_status = 400;
				$message = trans('providers.provider_notcreated');
			}
			// return ['status' => $http_status, 'message' => $message];
			return response()->json(["data" => $response, 'message' => $message, 'status' => $http_status]);
		} catch (\Exception $err) {
			\DB::rollback();
			// return ['status' => 400, 'message' => $err->getMessage()];
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}
	public static function createUpdateProviderDirectDebitSetting($request)
	{
		\DB::beginTransaction();
		try {
			$data = [];
			$status = 'true';
			$data['user_id'] = $request->user_id;
			$data['payment_method_type'] = isset($request->payment_method) ? implode(",", $request->payment_method) : '';
			$data['card_information'] = $request->card_info_content;
			$data['bank_information'] = $request->bank_info_content;
			$data['is_card_content'] = $request->card_info_status;
			$data['is_bank_content'] = $request->bank_info_status;
			$data['status'] = $request->direct_debit_status;
			// dd($request->all(),$data);
			if (!$data) {
				$status = 'false';
			} else {
				$response = ProviderDirectDebit::updateOrCreate(['user_id' => $request->user_id], $data);
			}
			if ($status == 'true') {
				\DB::commit();
				$http_status = 200;
				$message = trans('providers.provider_directdebit_updated');
			} else {
				\DB::rollback();
				$http_status = 400;
				$message = trans('providers.provider_directdebit_notupdated');
			}
			// return ['status' => $http_status, 'message' => $message];
			return response()->json(['message' => $message, 'status' => $http_status]);
		} catch (\Exception $err) {
			\DB::rollback();
			// return ['status' => 400, 'message' => $err->getMessage()];
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	/*
     *
     *
     */
	public static function  postManageIps($request)
	{
		try {
			$ip_data = [];
			$status = 'true';
			$ips = explode(",", $request->ips);
			$ip_range = explode(",", $request->ip_range);
			foreach ($ips as $ip) {
				if (filter_var($ip, FILTER_VALIDATE_IP)) {
				} else {
					if ($ip != "")
						$errors['ips'] = 'Invaild IP address';
				}
			}
			foreach ($ip_range as $ip) {
				$range = explode("-", $ip);
				if (isset($range[1])) {
					if (!filter_var($range[0], FILTER_VALIDATE_IP)) {
						$errors['ip_range'] = 'Invaild IP range address';
					}
				} else {
					if ($ip != "")
						$errors['ip_range'] = 'Invaild IP range address';
				}
			}
			if (isset($errors)) {
				//return response()->json(array('success' => 'false',"message"=>"invaild ip","errors"=>$errors),422);
				return response()->json(['status' => 422, 'errors' => $errors], 422);
			}
			$ip_data['ip_range'] = $request->ip_range;
			$ip_data['ips'] = $request->ips;
			$ip_data['user_id'] = $request->user_id;

			if (!$ip_data) {
				$status = 'false';
			} else {
				ProvidersIp::updateOrCreate(['user_id' => $request->user_id], $ip_data);
				// dd($request->all(),$data);
			}

			if ($status == 'true') {
				\DB::commit();
				$http_status = 200;
				$message = trans('providers.provider_ip_added');
			} else {
				\DB::rollback();
				$http_status = 400;
				$message = trans('providers.provider_ip_notadded');
				$data = '';
			}
			return response()->json(['status' => $http_status, 'message' => $message], 200);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()], 400);
		}
	}

	/*
     *
     *
     */
	public static function  getManageIps($request)
	{
		try {

			$providers_ips = ProvidersIp::where('user_id', $request->user_id)->first();
			return response()->json(["data" => $providers_ips, 'message' => 'Success', 'status' => 200]);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}
	/*
     *
     *
     */
	public static function  postManageToken($request)
	{
		try {
			$token = [];
			$status = 'true';
			if ($request->has('user_id')) {
				$token['token'] = \Str::random(25);
				ProvidersIp::updateOrCreate(['user_id' => $request->user_id], $token);
			} else {
				$status = 'false';
			}

			if ($status == 'true') {
				\DB::commit();
				$http_status = 200;
				$message = trans('providers.provider_token_added');
			} else {
				\DB::rollback();
				$http_status = 400;
				$message = trans('providers.provider_token_notadded');
			}
			return ['status' => $http_status, 'message' => $message, 'token' => $token['token']];
		} catch (\Exception $e) {
			return  $result = [
				'exception_message' => $e->getMessage()
			];
		}
	}

	public static function setDebitInfoIp($request)
	{
		try {
			$ip_data = [];
			$status = 'true';
			$ips = explode(',', $request->export_leads);
			foreach ($ips as $ip) {
				if (filter_var($ip, FILTER_VALIDATE_IP)) {
				} else {
					if ($ip != "")
						$errors['export_leads'] = 'Invaild ip address';
				}
			}

			if (isset($errors)) {
				//return response()->json(array('success' => 'false',"message"=>"invaild ip","errors"=>$errors),422);
				return ['status' => 422, 'errors' => $errors];
			}
			$ip_data['debit_info_csv_ip'] = $request->export_leads;
			//store and update sale export password
			if ($request->sale_export_password != '' && $request->sale_export_password != null) {
				$sale_password = base64_encode($request->input('sale_export_password'));
				$ip_data['debit_info_csv_password'] = $sale_password;
			}

			if (!$ip_data) {
				$status = 'false';
			} else {
				$response = ProvidersIp::updateOrCreate(['user_id' => $request->user_id], $ip_data);
				// dd($request->all(),$data);
			}

			if ($status == 'true') {
				\DB::commit();
				$http_status = 200;
				$message = trans('providers.provider_ip_update');
			} else {
				\DB::rollback();
				$http_status = 400;
				$message = trans('providers.provider_ip_notupdated');
			}
			return ['status' => $http_status, 'message' => $message];
		} catch (\Exception $e) {
			return  $result = [
				'exception_message' => $e->getMessage()
			];
		}
	}

	public static function deleteOutboundLink($request, $id)
	{
		try {
			$response = ProviderOutboundLink::where('id', $id)->delete();
			if ($response) {
				$response = ProviderOutboundLink::where('user_id', $request->user_id)->orderBy('order', 'ASC')->get()->toArray();
				$http_status = 200;
				$message = trans('providers.outboundlink_deleted');
			} else {
				$http_status = 400;
				$message = trans('providers.outboundlink_notdeleted');
			}
			// return ['status' => $http_status, 'message' => $message];
			return response()->json(["data" => $response, 'message' => $message, 'status' => $http_status]);
		} catch (\Exception $err) {
			\DB::rollback();
			// return ['status' => 400, 'message' => $err->getMessage()];
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	public static function getStateOrTeleData($request)
	{
		try {
			$response = ProviderContent::where(['provider_id' => $request->user_id, "state_id" => $request->state])->with('getcontentcheckbox')->get()->toArray();
			return response()->json(["data" => $response], 200);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	public static function getSuburbs($request)
	{
		try {
			$suburbs = States::where('state_id', $request->state_id)->with('suburbs', function ($q) {
				$q->select('id', 'state', 'suburb');
			})->first();

			$assignedSubrubs = UserSuburb::select('suburb_id')->where('user_id', decryptGdprData($request->provider_id))->get()->pluck('suburb_id')->toArray();
			return response()->json(['suburbs' => $suburbs, 'assignedSubrubs' => $assignedSubrubs]);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to assign postcodes.', 'exception' => $err->getMessage()]);
		}
	}

	public static function getPostcodeSuburbs($request)
	{
		try {
			$assignedSubrubs = UserSuburb::where('user_id', decryptGdprData($request->provider_id))->where('state_id', $request->state_id)->where('status', 1)->with('subrubs')->get();
			return response()->json(['assignedSubrubs' => $assignedSubrubs]);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to assign postcodes.', 'exception' => $err->getMessage()]);
		}
	}


	public static function assignSuburbs($request)
	{
		try {
			UserSuburb::where('user_id', decryptGdprData($request->provider_id))->where('state_id', $request->state_id)->delete();
			$dataToInsert =  [];
			foreach ($request->suburb as $key => $value) {
				$dataToInsert[] = ['user_id' => decryptGdprData($request->provider_id), 'state_id' => $request->state_id, 'suburb_id' => $value, 'status' => 1];
			}
			UserSuburb::insert($dataToInsert);
			return response()->json(['message' => 'Suburb(s) assigned successfully.']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to assign postcodes.', 'exception' => $err->getMessage()]);
		}
	}

	public static function assignPostcodes($request)
	{
		try {
			UserPostcode::create(['user_id' => decryptGdprData($request->provider_id), 'postcode_id' => $request->assign_postcode_postcode_id,  'status' => 1,]);
			return response()->json(['message' => 'Postcode assigned successfully.'], 200);
		} catch (\Exception $err) {
			// return response()->json(['status' => 400, 'message' => $e->getMessage()],400);
			return response()->json(['message' => 'Unable to assign postcodes.', 'exception' => $err->getMessage()], 500);
		}
	}

	public static function changeSuburbStatus($request)
	{
		try {
			UserSuburb::where('id', $request->id)->update(['status' => $request->status]);
			return response()->json(['message' => 'Status updated successfully.']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to update status.', 'exception' => $err->getMessage()]);
		}
	}

	public static function deleteSuburb($request)
	{
		try {
			UserSuburb::where('id', $request->id)->delete();
			return response()->json(['message' => 'Suburb unassigned successfully.']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to update status.', 'exception' => $err->getMessage()]);
		}
	}

	public static function changePostcodeStatus($request)
	{
		try {
			UserPostcode::where('id', $request->id)->update(['status' => $request->status]);
			return response()->json(['message' => 'Status updated successfully.']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to update status.', 'exception' => $err->getMessage()]);
		}
	}

	public static function deletePostcode($request)
	{
		try {
			UserPostcode::where('id', $request->id)->delete();
			return response()->json(['message' => 'Postcode unassigned successfully.']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to unassign postcode.', 'exception' => $err->getMessage()]);
		}
	}

	public static function postSaleSubmission($request)
	{
		try {
			$sale_submission = DB::table('provider_sale_submissions')
				->where(['provider_id' => decryptGdprData($request->provider_id), 'sale_submission_type' => $request->sale_submission_type])
				->get();
			if (count($sale_submission)) { // update
				$sale_submission = $sale_submission[0];
				DB::table('provider_sale_submissions')
					->where(['provider_id' => decryptGdprData($request->provider_id), 'sale_submission_type' => $request->sale_submission_type])
					->update([
						'from_name'            => encryptGdprData($request->from_name),
						'from_email'           => encryptGdprData($request->from_email),
						'subject'              => $request->subject,
						'to_email_ids'         => encryptGdprData($request->to_email_ids),
						'cc_emails_ids'        => encryptGdprData($request->cc_email_ids),
						'bcc_emails_ids'       => encryptGdprData($request->bcc_email_ids),
						'updated_at'           => now(),
					]);

				DB::table('provider_sale_submission_intervals')
					->where('provider_sale_emails_id', $sale_submission->id)
					->delete();

				foreach ($request->cor_sale_time as $time) {
					DB::table('provider_sale_submission_intervals')->insert([
						'provider_sale_emails_id' => $sale_submission->id,
						'time'                    => $time,
					]);
				}
				// return response()->json(['message'=>'Sale submission updated successfully.']);
				$message = 'Sale submission updated successfully.';
				return self::getSaleSubmission($request->provider_id, $request->sale_submission_type, $message);
			}

			// create
			$sale_submission = DB::table('provider_sale_submissions')->insertGetId([
				'provider_id'          => decryptGdprData($request->provider_id),
				'from_name'            => encryptGdprData($request->from_name),
				'from_email'           => encryptGdprData($request->from_email),
				'subject'              => $request->subject,
				'to_email_ids'         => encryptGdprData($request->to_email_ids),
				'cc_emails_ids'        => encryptGdprData($request->cc_email_ids),
				'bcc_emails_ids'       => encryptGdprData($request->bcc_email_ids),
				'sale_submission_type' => $request->sale_submission_type,
				'created_at'           => now(),
				'updated_at'           => now(),
			]);

			foreach ($request->cor_sale_time as $time) {
				DB::table('provider_sale_submission_intervals')->insert([
					'provider_sale_emails_id' => $sale_submission,
					'time'                    => $time,
				]);
			}
			$message = 'Sale submission added successfully.';
			return self::getSaleSubmission($request->provider_id, $request->sale_submission_type, $message);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to add/update sale submission.', 'exception' => $err->getMessage()]);
		}
	}

	public static function postPasswordProtectedSaleSubmission($request)
	{
		try {
			DB::table('providers')->where('user_id', decryptGdprData($request->provider_id))->update([
				'protected_sale_submission' => $request->status,
				'protected_password' => isset($request->password) && ($request->status == 1) ? encryptGdprData($request->password) : null,
				'updated_at' => now(),
			]);

			return response()->json(['message' => 'Password protected sale submission updated successfully.']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to update password protected sale submission.', 'exception' => $err->getMessage()]);
		}
	}

	public static function addSftp($request)
	{
		try {
			DB::table('provider_sftps')->insert([
				'provider_id' => decryptGdprData($request->provider_id),
				'destination_name' => encryptGdprData($request->destination_name),
				'auth_type' => $request->auth_type,
				'protocol_type' => $request->protocol_type,
				'remote_host' => encryptGdprData($request->remote_host),
				'port' => $request->port,
				'username' => encryptGdprData($request->username),
				'password' => encryptGdprData($request->password),
				'timeout' => isset($request->timeout) ? $request->timeout : '30',
				'directory' => isset($request->directory) ? encryptGdprData($request->directory) : encryptGdprData('/'),
				'status' => 0,
				'created_at' => now(),
				'updated_at' => now(),
			]);
			return response()->json(['status' => true, 'message' => 'SFTP added successfully.']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to add SFTP.', 'exception' => $err->getMessage()]);
		}
	}
	public static function updateSftp($request)
	{
		try {
			DB::table('provider_sftps')->where('id', $request->sftp_id)->update([
				'provider_id' => decryptGdprData($request->provider_id),
				'destination_name' => encryptGdprData($request->destination_name),
				'auth_type' => $request->auth_type,
				'protocol_type' => $request->protocol_type,
				'remote_host' => encryptGdprData($request->remote_host),
				'port' => $request->port,
				'username' => encryptGdprData($request->username),
				'password' => encryptGdprData($request->password),
				'timeout' => isset($request->timeout) ? $request->timeout : '30',
				'directory' => isset($request->directory) ? encryptGdprData($request->directory) : encryptGdprData('/'),
				'status' => $request->status,
				'updated_at' => now(),
			]);
			return response()->json(['status' => true, 'message' => 'SFTP updated successfully.']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to update SFTP.', 'exception' => $err->getMessage()]);
		}
	}

	public static function updateSftpLog($request)
	{
		try {
			DB::table('providers')->where('user_id', decryptGdprData($request->provider_id))->update([
				// 'sftp_enable' => $request->sftp_enable,
				'log_from_email' => encryptGdprData($request->log_from_email),
				'log_from_name' => encryptGdprData($request->log_from_name),
				'log_subject' => $request->log_subject,
				'log_to_emails' => encryptGdprData($request->log_to_emails),
				'updated_at' => now()
			]);
			return response()->json(['status' => true, 'message' => 'SFTP log updated successfully.', 'sftp' => $request->all()]);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to update SFTP log.', 'exception' => $err->getMessage()]);
		}
	}

	public static function getSftps($provider_id)
	{
		$sftps = DB::table('provider_sftps')
			->where('provider_id', decryptGdprData($provider_id))
            ->orderBy('id', 'desc')
			->get();
		$sftps = $sftps->transform(function ($item, $key) {
			$item->destination_name = decryptGdprData($item->destination_name);
			$item->remote_host = decryptGdprData($item->remote_host);
			$item->username = decryptGdprData($item->username);
			$item->password = decryptGdprData($item->password);
			$item->directory = decryptGdprData($item->directory);
			return $item;
		});
		return response()->json($sftps);
	}

	public static function deleteSftp($sftp_id)
	{
		try {
			DB::table('provider_sftps')->delete($sftp_id);
			return response()->json(['status' => true, 'message' => 'SFTP deleted successfully.']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to delete SFTP.', 'exception' => $err->getMessage()]);
		}
	}

	public static function changeSftpStatus($sftp_id)
	{
		try {
			$status = DB::table('provider_sftps')->where('id', $sftp_id)->pluck('status');
			DB::table('provider_sftps')->where('id', $sftp_id)->update(['status' => !$status[0]]);
			return response()->json(['status' => true, 'message' => 'Status updated successfully.']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to update status.', 'exception' => $err->getMessage()]);
		}
	}

	public static function changeProviderSftpStatus($user_id)
	{
		try {
			$status = DB::table('providers')->where('id', $user_id)->pluck('sftp_enable');
			DB::table('providers')->where('id', $user_id)->update(['sftp_enable' => !$status[0]]);
			return response()->json(['status' => true, 'message' => 'Status updated successfully.']);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => 'Unable to update status.', 'exception' => $err->getMessage()]);
		}
	}

	public static function getMoveinDistributors($providerId = null, $energyType = null)
	{
		try {
			if (empty($energyType)) {
				$energyType = 1;
			}
			$response = DB::table('distributors')->select('name', 'id')->where([
				'status' => 1,
				'is_deleted' => 0,
				'energy_type' => $energyType
			])->get()->toArray();
			$data = [];
			$data['distributor'] = $response;
			$days = ProvderMovein::where([
				'is_deleted' => 0,
				'energy_type' => $energyType,
				'distributor_id' => 0,
				'user_id' => decryptGdprData($providerId)
			])->get();
			$data['residence'] = [];
			$data['sme'] = [];
			foreach ($days as $row) {
				if ($row->property_type == 1) {
					array_push($data['residence'], [
						'id' => $row->id,
						'grace_day' => $row->grace_day,
						'restricted_start_time' => $row->restricted_start_time,
					]);
				}
				if ($row->property_type == 2) {
					array_push($data['sme'], [
						'id' => $row->id,
						'grace_day' => $row->grace_day,
						'restricted_start_time' => $row->restricted_start_time,
					]);
				}
			}
			return $data;
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}
	public static function providerMovinData($request)
	{
		try { //dd($request->all());
			$response = [];
			if (empty($request->residence_id)) {
				$data = ProvderMovein::create([
					'user_id' => decryptGdprData($request->providerid),
					'property_type' => 1,
					'energy_type' => $request->energy_type,
					'distributor_id' => $request->distributor,
					'restricted_start_time' => $request->restrict_residence,
					'grace_day' => $request->day_interval_residenced,
					'is_deleted' => 0
				]);
				$response['residence'] = [
					'id' => $data->id,
					'grace_day' => $data->grace_day,
					'name' => 'residence',
					'restricted_start_time' => $request->restrict_residence,
				];
			} else {

				$data = DB::table('provider_movein')->where('id', '=', $request->residence_id)->update([
					'grace_day' => $request->day_interval_residenced,
					'restricted_start_time' => $request->restrict_residence,
				]);
				$response['residence'] = [
					'id' => $request->residence_id,
					'grace_day' => $request->day_interval_residenced,
					'name' => 'residence',
					'restricted_start_time' => $request->restrict_residence,
				];
			}
			if (empty($request->sme_id)) {

				$data = ProvderMovein::create([
					'user_id' => decryptGdprData($request->providerid),
					'property_type' => 2,
					'energy_type' => $request->energy_type,
					'distributor_id' => $request->distributor,
					'grace_day' => $request->day_interval_bussiness,
					'restricted_start_time' => $request->restrict_bussiness,
					'is_deleted' => 0
				]);
				$response['sme'] = [
					'id' => $data->id,
					'grace_day' => $data->grace_day,
					'name' => 'sme',
					'restricted_start_time' => $request->restrict_bussiness
				];
			} else {

				DB::table('provider_movein')->where('id', '=', $request->sme_id)->update([
					'grace_day' => $request->day_interval_bussiness,
					'restricted_start_time' => $request->restrict_bussiness
				]);
				$response['sme'] = [
					'id' => $request->sme_id,
					'grace_day' => $request->day_interval_bussiness,
					'restricted_start_time' => $request->restrict_bussiness,
					'name' => 'sme'
				];
			}
			return response()->json(['data' => $response, 'message' => "Data has been save successfully", 'status' => 200]);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}
	public static function getProviderMovinDetail($request)
	{
		try {
			$query = [];
			if (\Request::has('property_type')) {
				$query['property_type'] = $request->property_type;
			}
			$query['user_id'] = decryptGdprData($request->providerid);
			$query['energy_type'] = $request->energy_type;
			$query['distributor_id'] = $request->distributor;
			$query['is_deleted'] = 0;
			$response = DB::table('provider_movein')->where($query)->get()->toArray();
			return response()->json(["data" => $response, 'message' => "Data has been fetched successfully", 'status' => 200]);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}
	public static function saveEicContentData($request)
	{
		try {
			$query = DB::table('provider_movein')->select('id')->where([
				'property_type' => $request->property_type,
				'user_id' => decryptGdprData($request->providerid),
				'distributor_id' => $request->distributor,
				'energy_type' => $request->energy_type,
				'is_deleted' => 0,
			])->get()->toArray();
			$update = [];
			$update['property_type'] = $request->property_type;
			$update['user_id'] = decryptGdprData($request->providerid);
			$update['distributor_id'] = $request->distributor;
			$update['is_deleted'] = 0;
			$update['energy_type'] = $request->energy_type;

			if (\Request::has('move_in_eic_content')) {
				$update['move_in_eic_content'] = $request->move_in_eic_content;
				$update['move_in_eic_content_status'] = $request->move_in_eic_content_status;
			}
			if (\Request::has('move_in_content')) {
				$update['move_in_content'] = $request->move_in_content;
				$update['move_in_content_status'] = $request->status;
			}

			$response = ProvderMovein::updateOrCreate(['id' => isset($query[0]->id) ? $query[0]->id : ""], $update);
			return response()->json(["data" => $response->id, 'status' => 200]);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	public static function getSaleSubmission($provider, $type, $message = null)
	{
		try {
			$saleSubmission =  DB::table('provider_sale_submissions')
				->where('provider_id', decryptGdprData($provider))
				->where('sale_submission_type', $type)
				->get();
			if (count($saleSubmission)) {
				$saleSubmission = $saleSubmission[0];
				$saleSubmission->from_email = decryptGdprData($saleSubmission->from_email);
				$saleSubmission->from_name = decryptGdprData($saleSubmission->from_name);
				$saleSubmission->to_email_ids = decryptGdprData($saleSubmission->to_email_ids);
				$saleSubmission->cc_emails_ids = decryptGdprData($saleSubmission->cc_emails_ids);
				$saleSubmission->bcc_emails_ids = decryptGdprData($saleSubmission->bcc_emails_ids);
				$saleSubmission->provider_encrypted = encryptGdprData($saleSubmission->provider_id);

				$data['sale_submission'] = $saleSubmission;

				$data['intervals'] = DB::table('provider_sale_submission_intervals')->where('provider_sale_emails_id', $saleSubmission->id)->get();
				$data['status'] = 200;
				$data['message'] = $message;
			} else {
				$data['status'] = 204;
			}
			return response()->json($data);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	public static function saveEditCustomField($request)
	{
		try {
			$data = [];
			$data['user_id'] = $request->user_id;
			$data["section_id"] = $request->section_id;
			if ($request->form_request == 'personal_form') {
				$data['label']         = $request->custom_field_label;
				$data["placeholder"]   = $request->custom_field_placeholder;
				$data["message"]       = $request->custom_field_message;
				$data['mandatory']     = $request->custom_field_mandatory;
			}
			if ($request->form_request == 'connection_form') {
				$data['question']      = $request->connection_custom_field_quest;
				$data['message']       = $request->connection_custom_field_message;
				$data['answer_type']   = $request->connection_custom_field_type;
				$data['mandatory']     = $request->connection_custom_field_mandatory;
				if ($data['answer_type'] == 2) {
					$data['count'] = $request->connection_custom_field_count;
				}
			}
			$response = SectionCustomFields::updateOrCreate(
				['id' => $request->id],
				$data
			);

			if ($response) {
				$response = SectionCustomFields::with(['customPlanSection' => function ($q) {
					$q->select('provider_section_custom_fields_id', 'plan_id');
				}])->where([
					"user_id" => $request->user_id,
					"section_id" => $request->section_id,
				])->get()->toArray();
				return response()->json(["message" => "Data has been saved", "data" => $response, 'status' => 200]);
			}
			return response()->json(["message" => "Something went wrong", 'status' => 500]);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}
	public static function deleteEditCustomField($request)
	{
		try {
			$response = SectionCustomFields::where([
				'id' => $request->id
			])->delete();
			if ($response) {
				ProviderFieldPlan::where(['provider_section_custom_fields_id' => $request->id])->delete();
				return response()->json(["message" => "Data has been deleted Successfully", 'status' => 200]);
			}
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	public static function getPlans($request)
	{
		try {
			$service = Providers::where('user_id', $request->user_id)->first()->service_id;
			$plans = [];
			if ($service == 1) {
				$plans = PlanEnergy::where('provider_id', $request->user_id)->pluck('plan_name', 'id');
			} else if ($service == 2) {
				$plans = PlanMobile::where('provider_id', $request->user_id)->pluck('name', 'id');
			} else if ($service == 3) {
				$plans = PlansBroadband::where('provider_id', $request->user_id)->pluck('name', 'id');
			}
			return response()->json(["message" => "success", "data" => $plans, 'status' => 200]);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}
	public static function assignPlanToField($request)
	{
		try {
			ProviderFieldPlan::where(['user_id' => $request->user_id, 'provider_section_custom_fields_id' => $request->id])->delete();
			if (isset($request->options)) {
				$options = array_map('intval', explode(',', $request->options));
				$data = [];
				foreach ($options as $option) {
					array_push($data, [
						'user_id'                           => $request->user_id,
						'plan_id'                           => $option,
						'provider_section_custom_fields_id' => $request->id,
						'created_at'                        => Carbon::now(),
						'updated_at'                        => Carbon::now()
					]);
				}
				ProviderFieldPlan::insert($data);
			}
			$response = SectionCustomFields::with(['customPlanSection' => function ($q) {
				$q->select('provider_section_custom_fields_id', 'plan_id');
			}])->where([
				"user_id" => $request->user_id,
				"section_id" => 1,
			])->get()->toArray();
			return response()->json(["message" => "success", 'data' => $response, 'status' => 200]);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}
}
