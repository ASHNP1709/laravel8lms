<?php

namespace App\Repositories\Affiliate;

use App\Repositories\SparkPost\SparkPost;
use App\Models\{User, Affiliate, Role, UserService, AffiliateUnsubscribeSource, UserAddress, AffiliateThirdPartyApi, EmailTemplate, AffiliateParamter};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToArray;

trait BasicCrudMethods
{

	// Send Password link new affiliate
	public static function sendPasswordMail($user, $passwordToken)
	{
		$spark = new SparkPost();
		$data['service_id'] = 3;
		$status = 'false';
		$getToken = $spark->getToken($data);
		if ($getToken['status'] == 200) {
			$token = $getToken['data']->token;
			$email = EmailTemplate::whereId(3)->select("title", "subject", "description")->first();
			$find = ['@Name@', '@Phone@', '@Link@', '@Email@'];
			$link = url('affiliates/generate-password/' . $passwordToken);
			$values = [ucfirst(decryptGdprData($user->first_name)) . ' ' . ucfirst(decryptGdprData($user->last_name)), decryptGdprData($user->phone), $link, decryptGdprData($user->email)];

			$html = str_replace($find, $values, $email->description);
			$html = $html;
			$sendData = [
				'from_email' => config('env.FROM_EMAIL'),
				'service_id' => 3,
				'user_email' => decryptGdprData($user->email),
				'subject'    => $email->subject,
				'cc_mail'    => [],
				'bcc_mail'   => [],
				'attachments' => [],
				'text'        => '',
				'html'        => $html
			];

			$sendrequest = $spark->sendMail($sendData, $token);
			if ($sendrequest['status'] == 200) {
				$status = 'true';
			}
		}
		return $status;
	}

	/**
	 * Reset Password mail
	 */

	public static function resetPasswordMail($request, $broker)
	{
		try {
			$users = User::find(decryptGdprData($request->id));
			$token = $broker->createToken($users);
			User::where('email', $users->email)->update(['token' => $token]);
			$emailsent = self::sendPasswordMail($users, $token);
			if ($emailsent == 'true') {
				return response()->json(['status' => 200, 'message' => trans('affiliates.emailsent')]);
			}
			return response()->json(['status' => 400, 'message' => trans('affiliates.emailnotsent')]);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}



	/**
	 * create affiliate
	 */
	public static function insertAffiliate($request, $broker)
	{
		DB::beginTransaction();
		try {
			$response = [];
			$subAccountOnSparkpost =  self::subAccountOnSparkpost();
			if (!$subAccountOnSparkpost['status']) {
				$httpStatus = 400;
				$message = trans('affiliates.subaccountnotcreated');
				return response()->json(['status' => $httpStatus, 'message' => $message, 'data' => $response]);
			}
			$status = 'false';
			$request['first_name'] = encryptGdprData(strtolower($request['first_name']));
			$request['last_name'] = encryptGdprData(strtolower($request['last_name']));
			$request['email'] = encryptGdprData(strtolower($request['email']));
			$request['phone'] = encryptGdprData($request['phone']);
			$userType = 'affiliate';
			if ($request['request_from'] == 'subaffiliate_basic_detail_form') {
				$userType = 'sub-affiliate';
			}
			$addUser = self::createAffiliateUser($request, $userType); //dd($addUser);
			if ($addUser['status']) {
				$status = 'true';
				$affiliate = [];
				$affiliate['user_id'] = $addUser['user_id'];
				$affiliate['company_name'] = $request['company_name'];
				$affiliate['show_agent_portal'] = $request['show_agent_portal'];
				$affiliate['cross_selling'] = $request['crossselling'];
				$affiliate['reconmethod'] = 1;
				if ($request['request_from'] == 'affiliate_basic_detail_form') {
					$affiliate['support_phone_number'] = encryptGdprData($request['support_phone_number']);
					$affiliate['sender_id'] = $request['sender_id'];
					$affiliate['parent_id'] = 0;
					$affiliate['legal_name'] = encryptGdprData(strtolower($request['legal_name']));
					if ($request->has('marketing')) {
						$affiliate['generate_token'] = 1;
					}
				}

				if ($request['request_from'] == 'subaffiliate_basic_detail_form') {
					$affiliate['sub_affiliate_type'] = $request['sub_affiliate_type'];
					$affiliate['referral_code_title'] = $request['referral_code_title'];
					$affiliate['referral_code_url'] = $request['referral_code_url'];
					$affiliate['referal_code'] = mt_rand(100, 100000);
					$affiliate['parent_id'] = decryptGdprData($request['user_id']);
				}

				$addAffiliate = Affiliate::create($affiliate);


				if ($addAffiliate) {
					AffiliateThirdPartyApi::insert([
						'user_id' => $addUser['user_id'],
						'third_party_platform' => 1,
						'subaccount_id'    =>  $subAccountOnSparkpost['data'][0],
						'subaccount_key'    =>  $subAccountOnSparkpost['data'][1],
						'subaccount_short_key'    =>  $subAccountOnSparkpost['data'][2],
						'status'  => 1,
						'created_at' => Carbon::now(),
						'updated_at' => Carbon::now()
					]);
					//tags data insert
					self::addTags($addUser['user_id'], $addAffiliate['id']);
					if ($request['request_from'] == 'affiliate_basic_detail_form') {
						//Add sources
						self::addSources($addUser['user_id'], $request);
					}
					//Add address
					$address = [];
					$address['user_id'] = $addUser['user_id'];
					$address['address'] = $request['company_address'];
					$address['address_type'] = 3;
					$address['created_at'] = Carbon::now();
					$address['updated_at'] = Carbon::now();
					UserAddress::insert($address);
				}
			}
			if ($status == 'true') {
				DB::commit();
				$httpStatus = 200;
				$message = trans('affiliates.affiliate_created');
				if ($request['request_from'] == 'subaffiliate_basic_detail_form') {
					$message = trans('affiliates.subaffiliate_created');
				}
				$response['id'] = encryptGdprData($addUser['user_id']);
				return response()->json(['status' => $httpStatus, 'message' => $message, 'data' => $response]);
			}
			DB::rollback();
			$httpStatus = 400;
			$message = trans('affiliates.affiliate_notcreated');
			if ($request['request_from'] == 'subaffiliate_basic_detail_form') {
				$message = trans('affiliates.subaffiliate_notcreated');
			}
			return response()->json(['status' => $httpStatus, 'message' => $message, 'data' => $response]);
		} catch (\Exception $err) {
			DB::rollback();
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}


	/**
	 * Add sources
	 */
	public static function addSources($userId, $request)
	{
		try {
			//Add sources
			if ($request->has('unsubscribe_source')) {
				$addSources = [];
				foreach ($request['unsubscribe_source'] as $values) {
					array_push($addSources, [
						'unsubscribe_source' => $values,
						'user_id' => $userId,
						'status'  => 1,
						'created_at' => Carbon::now(),
						'updated_at' => Carbon::now()
					]);
				}
				AffiliateUnsubscribeSource::insert($addSources);
			}
			return ['status' => 'true'];
		} catch (\Exception $err) {
			return ['status' => false, 'message' => $err->getMessage()];
		}
	}


	/**
	 * Add tags
	 */
	public static function addTags($userid, $id)
	{
		try {
			//tags data insert
			$tags = DB::table('tags')->get();

			$tdata['is_cookies'] = 1;
			$tdata['is_advertisement'] = 1;
			$tdata['is_remarketing'] = 1;
			$tdata['is_any_time'] = 1;
			$tdata['user_id'] = $userid;
			$tdata['created_at'] = Carbon::now();
			$tdata['updated_at'] = Carbon::now();
			$finalData = [];
			$tdata['affiliate_id'] = $id;
			foreach ($tags as  $value) {
				$tdata['tag_id'] = $value->id;
				$finalData[] = $tdata;
			}
			DB::table('affiliate_tags')->insert($finalData);
			return ['status' => 'true'];
		} catch (\Exception $err) {
			return ['status' => false, 'message' => $err->getMessage()];
		}
	}


	/**
	 * create user and return userId for affiliate
	 */
	public static function  createAffiliateUser($request, $roleType)
	{
		try {
			$roleId = Role::where('name', $roleType)->pluck('id')->first();
			$loginId = Auth::id();
			$password = randomString();
			$user = User::create([
				'first_name' => $request['first_name'],
				'last_name' => $request['last_name'],
				'email' => $request['email'],
				'phone' => $request['phone'],
				'role' => $roleId,
				'password' => Hash::make($password),
				'created_by' => $loginId
			]);

			if ($user) {
				$user->assignRole($roleType);
				return ['status' => true, 'user_id' => $user->id, 'user_data' => $user];
			}
			return ['status' => false];
		} catch (\Exception $err) {
			return ['status' => false, 'message' => $err->getMessage()];
		}
	}


	//Fetch and filters
	public static function getFilters($condition = null, $columns = '*', $relations = null, $filters = null, $relationMandatory = true)
	{
		$data = request()->all();
		$filterColumns = ['id', 'email'];
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

						if ($relationData['relation'] == 'user' && $relationData['filters']) {
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

		return $query->paginate(config('env.PAGINATION_PERPAGE_COUNT'));
	}

	//Update Affiliate
	public static function updateAffiliate($request)
	{
		DB::beginTransaction();
		try {
			$userId = decryptGdprData($request['id']);
			$response = [];
			$status = 'true';
			if ($request['request_from'] == 'affiliate_basic_detail_form' || $request['request_from'] == 'subaffiliate_basic_detail_form') {
				$getSubaccountid = AffiliateThirdPartyApi::where('user_id', $userId)->pluck('subaccount_id')->first();
				if (!empty($getSubaccountid)) {
					$updateSubAccountOnSparkpost =  self::updateSubAccountOnSparkpost($getSubaccountid);
					if (!$updateSubAccountOnSparkpost['status']) {
						$httpStatus = 400;
						$message = trans('affiliates.subaccountnotupdated');
						return response()->json(['status' => $httpStatus, 'message' => $message, 'data' => $response]);
					}
				}

				$request['first_name'] = encryptGdprData(strtolower($request['first_name']));
				$request['last_name'] = encryptGdprData(strtolower($request['last_name']));
				$request['phone'] = encryptGdprData($request['phone']);
				$request['email'] = encryptGdprData(strtolower($request['email']));
				$userType = 'affiliate';
				if ($request['request_from'] == 'subaffiliate_basic_detail_form') {
					$userType = 'sub-affiliate';
				}
				$updateUser = self::updateAffiliateUser($userId, $request, $userType);
				if ($updateUser['status']) {
					//Update Affiliate
					self::updateBasicDetails($userId, $request);
				}
			}

			if ($request->has('logo')) {
				$file = $request->logo;
				$s3fileName = 'affiliate/' . $userId . '/logo/';
				$name = time() . $file->getClientOriginalName();
				Storage::disk('s3')->put($s3fileName . '/' . $name, file_get_contents($file), 'public');
				$url = "https://" . config('env.AWS_BUCKET') . ".s3." . config('env.DEFAULT_REGION') . ".amazonaws.com/" . $s3fileName . $name;
				$logoUpload = Affiliate::where('user_id', $userId)->update(['logo' => $url]);
				if (!$logoUpload) {
					$status = 'false';
				}
			}

			if ($request['request_from'] == 'affiliate_social_links_form') {
				self::updateSocialLinks($userId, $request);
			}

			if ($request['request_from'] == 'affiliate_additional_feature_form') {
				$additional = [];
				$additional['lead_data_in_cookie'] = $request['lead_data_in_cookie'];
				$additional['lead_ownership_days_interval'] = $request['lead_ownership_days_interval'];
				$additional['restricted_start_time'] = Carbon::parse($request->restrict_start_time);
				$additional['restricted_end_time'] = Carbon::parse($request->restrict_end_time);
				if (!empty($request['lead_export_password'])) {
					$additional['lead_export_password'] = encryptGdprData($request['lead_export_password']);
				}

				if (!empty($request['sale_export_password'])) {
					$additional['sale_export_password'] = encryptGdprData($request['sale_export_password']);
				}

				$updateadditional = Affiliate::where('user_id', $userId)->update($additional);
				if (!$updateadditional) {
					$status = 'false';
				}
			}

			if ($request['request_from'] == 'affiliate_spark_post_feature_form') {
				self::updateThirdParty($userId, $request);
			}

			if ($request['request_from'] == 'affiliate_life_support_content_form') {
				self::updateLifeSupportContent($userId, $request);
			}

			if ($status == 'true') {
				DB::commit();
				$httpStatus = 200;
				$message = trans('affiliates.affiliate_updated');
				if ($request['request_from'] == 'subaffiliate_basic_detail_form') {
					$message = trans('affiliates.subaffiliate_updated');
				}
				$response['id'] = encryptGdprData($userId);
			} else {
				DB::rollback();
				$httpStatus = 400;
				$message = trans('affiliates.affiliate_notupdated');
				if ($request['request_from'] == 'subaffiliate_basic_detail_form') {
					$message = trans('affiliates.subaffiliate_notupdated');
				}
			}
			return response()->json(['status' => $httpStatus, 'message' => $message, 'data' => $response]);
		} catch (\Exception $err) {
			DB::rollback();
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}


	/**
	 * Update Affiliate basic details
	 */
	public static function updateBasicDetails($userId, $request)
	{
		try {
			$status = 'true';
			$affiliate = [];
			$affiliate['company_name'] = $request['company_name'];
			$affiliate['show_agent_portal'] = $request['show_agent_portal'];
			$affiliate['cross_selling'] = $request['crossselling'];
			$affiliate['reconmethod'] = 1;
			if ($request['request_from'] == 'affiliate_basic_detail_form') {
				$affiliate['legal_name'] = encryptGdprData(strtolower($request['legal_name']));
				$affiliate['support_phone_number'] = encryptGdprData($request['support_phone_number']);
				$affiliate['sender_id'] = $request['sender_id'];
				$affiliate['parent_id'] = 0;
				$affiliate['generate_token'] = 0;
				if ($request->has('marketing')) {
					$affiliate['generate_token'] = 1;
				}
			}

			if ($request['request_from'] == 'subaffiliate_basic_detail_form') {
				$affiliate['sub_affiliate_type'] = $request['sub_affiliate_type'];
				$affiliate['referral_code_title'] = $request['referral_code_title'];
				$affiliate['referral_code_url'] = $request['referral_code_url'];
			}

			$updateAffiliate = Affiliate::where('user_id', $userId)->update($affiliate);
			if ($updateAffiliate) {
				if ($request['request_from'] == 'affiliate_basic_detail_form') {
					//Update sources
					if ($request->has('unsubscribe_source')) {
						$addSources = [];
						foreach ($request['unsubscribe_source'] as $values) {
							array_push($addSources, [
								'unsubscribe_source' => $values,
								'user_id' => $userId,
								'status'  => 1,
								'created_at' => Carbon::now(),
								'updated_at' => Carbon::now()
							]);
						}
						AffiliateUnsubscribeSource::where('user_id', $userId)->delete();
						$addSources = AffiliateUnsubscribeSource::insert($addSources);
						if (!$addSources) {
							$status = 'false';
						}
					}
				}

				//Update address
				$address['user_id'] = $userId;
				$address['address'] = $request['company_address'];
				$address['updated_at'] = Carbon::now();
				$addAddress = UserAddress::where('user_id', $userId)->update($address);
				if (!$addAddress) {
					$status = 'false';
				}
			} else {
				$status = 'false';
			}
			return ['status' => $status];
		} catch (\Exception $err) {
			return ['status' => false, 'message' => $err->getMessage()];
		}
	}


	/**
	 * Update social Links
	 */
	public static function updateSocialLinks($userId, $request)
	{
		try {
			$socialInfo = [];
			$socialInfo['dedicated_page'] = $request['dedicated_page'];
			$socialInfo['facebook_url'] = $request['facebook_url'];
			$socialInfo['twitter_url'] = $request['twitter_url'];
			$socialInfo['instagram_url'] = $request['instagram_url'];
			$socialInfo['youtube_url'] = $request['youtube_url'];
			$socialInfo['linkedin_url'] = $request['linkedin_url'];
			$socialInfo['google_plus_url'] = $request['google_plus_url'];
			Affiliate::where('user_id', $userId)->update($socialInfo);
			return ['status' => 'true'];
		} catch (\Exception $err) {
			return ['status' => false, 'message' => $err->getMessage()];
		}
	}


	/**
	 * Update and insert spark post in third party
	 */
	public static function updateThirdParty($userId, $request)
	{
		try {

			$checkapi = AffiliateThirdPartyApi::where('user_id', $userId)->first();

			if ($checkapi) {
				$affiliatespakpostAPI['user_id'] = $userId;
				$affiliatespakpostAPI['third_party_platform'] = 1;
				$affiliatespakpostAPI['api_key'] = $request['affiliate_sparkpostkey'];
				$affiliatespakpostAPI['status'] = 1;
				$affiliatespakpostAPI['updated_at'] = Carbon::now();
				AffiliateThirdPartyApi::where('user_id', $userId)->update($affiliatespakpostAPI);
				return ['status' => 'true'];
			}

			$affiliatespakpostAPI['user_id'] = $userId;
			$affiliatespakpostAPI['third_party_platform'] = 1;
			$affiliatespakpostAPI['api_key'] = $request['affiliate_sparkpostkey'];
			$affiliatespakpostAPI['status'] = 1;
			$affiliatespakpostAPI['created_at'] = Carbon::now();
			$affiliatespakpostAPI['updated_at'] = Carbon::now();
			AffiliateThirdPartyApi::insert($affiliatespakpostAPI);

			return ['status' => 'true'];
		} catch (\Exception $err) {
			return ['status' => false, 'message' => $err->getMessage()];
		}
	}

    public static function updateLifeSupportContent($userId, $request)
	{
		try {
            Affiliate::where('user_id', $userId)->update(['life_support_content' => $request['content']]);
			return ['status' => 'true'];
		} catch (\Exception $err) {
			return ['status' => false, 'message' => $err->getMessage()];
		}
	}


	//Update users
	public static function updateAffiliateUser($userId, $request, $roleType)
	{
		try {
			$user = User::find($userId);
			$user->update([
				'first_name' => $request['first_name'],
				'last_name' => $request['last_name'],
				'email' => $request['email'],
				'phone' => $request['phone']
			]);


			$role = $user->roles->pluck('name')->first();
			if (empty($role)) {
				$user->assignRole($roleType);
			}
			return ['status' => true, 'user_id' => $userId];
		} catch (\Exception $err) {
			return ['status' => false, 'message' => $err->getMessage()];
		}
	}

	public static function affiliateChangeStatus($request, $broker)
	{
		DB::beginTransaction();
		try {
			$status = 'false';
			$httpStatus = 400;
			$userId = decryptGdprData($request['id']);
			$users = User::find($userId);

			$affiliateStatus = Affiliate::where('user_id', $userId)->update(['status' => $request['status']]);

			if ($affiliateStatus) {
				$affiliateUserStatus = User::where('id', $userId)->update(['status' => $request['status']]);
				if ($affiliateUserStatus) {
					$status = 'true';
				}
				if ($users->email_sent == 0) {
					$emailSent = self::resetPasswordMail((object)['id' => $request->id], $broker);
					if ($emailSent->getData()->status == 200) {
						//Update email sent
						User::where('id', $userId)->update(['email_sent' => 1]);
					}
				}
			}

			if ($status == 'true') {
				DB::commit();
				$httpStatus = 200;
				$message = trans('affiliates.affiliate_status_update');
				return response()->json(['status' => $httpStatus, 'message' => $message]);
			}
			DB::rollback();
			$message = trans('affiliates.affiliate_status_notupdate');


			return response()->json(['status' => $httpStatus, 'message' => $message]);
		} catch (\Exception $err) {
			DB::rollback();
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	/**
	 * create sub account in sparkpost
	 */
	public static function subAccountOnSparkpost()
	{
		$spark = new SparkPost();
		$data['service_id'] = 3;
		$request = request()->all();
		$sendData = [];

		$getToken = $spark->getToken($data);
		if ($getToken['status'] == 200) {
			$sendrequest['name'] = strtolower($request['first_name']) . " " . strtolower($request['last_name']);
			$sendrequest['key_label'] = strtolower($request['first_name']) . " " . strtolower($request['last_name']);
			$sendrequest['key_grants'] = ["smtp/inject", "sending_domains/manage", "tracking_domains/view", "tracking_domains/manage", "message_events/view", "suppression_lists/manage", "transmissions/view", "transmissions/modify", "webhooks/modify", "webhooks/view"];
			$token = $getToken['data']->token;

			$createNewSubaccount = $spark->createNewSubaccount($sendrequest, $token);

			if ($createNewSubaccount['status'] == 200) {

				$sendData[] =  $createNewSubaccount['data']->data->results->subaccount_id;
				$sendData[] =  $createNewSubaccount['data']->data->results->key;
				$sendData[] =   $createNewSubaccount['data']->data->results->short_key;

				return ['status' => true, 'data' => $sendData];
			}
			return ['status' => false, 'data' => $sendData];
		}
		return ['status' => false, 'data' => $sendData];
	}

	//Update subaccount in sparkpost
	public static function updateSubAccountOnSparkpost($subaccountId)
	{
		$spark = new SparkPost();
		$data['service_id'] = 3;
		$request = request()->all();
		$getToken = $spark->getToken($data);
		if ($getToken['status'] == 200) {

			$sendrequest['name'] = strtolower($request['first_name']) . " " . strtolower($request['last_name']);
			$sendrequest['key_label'] = strtolower($request['first_name']) . " " . strtolower($request['last_name']);
			$sendrequest['key_grants'] = ["smtp/inject", "sending_domains/manage", "tracking_domains/view", "tracking_domains/manage", "message_events/view", "suppression_lists/manage", "transmissions/view", "transmissions/modify", "webhooks/modify", "webhooks/view"];
			$sendrequest['suaccount_id'] = $subaccountId;
			$token = $getToken['data']->token;
			$updateSubaccount = $spark->putUpdateSubaccount($sendrequest, $token);

			if ($updateSubaccount['status'] == 200) {

				return ['status' => true];
			}
			return ['status' => false];
		}
		return ['status' => false];
	}

	public static function getVerticals($id)
	{
		try {
			$query = UserService::selectRaw('user_services.*,users.first_name,users.last_name,services.service_title')
				->join("users", "users.id", "=", "user_services.assigned_by")
				->leftJoin("services", "services.id", "=", "user_services.service_id")
				->where('user_services.user_id', $id)->get();
			return $query;
		} catch (\Exception $err) {
			return ['status' => 400, 'message' => $err->getMessage()];
		}
	}

	public static function verticalChangeStatus($request)
	{
		DB::beginTransaction();
		try {
			$status = 'false';
			$httpStatus = 400;
			$verticalId = decryptGdprData($request['id']);

			$verticalStatus = UserService::where('id', $verticalId)->update(['status' => $request['status']]);
			if ($verticalStatus) {
				$status = 'true';
			}

			if ($status == 'true') {
				DB::commit();
				$httpStatus = 200;
				$message = trans('affiliates.affiliate_status_update');
				return response()->json(['status' => $httpStatus, 'message' => $message]);
			}
			DB::rollback();
			$message = trans('affiliates.affiliate_status_notupdate');


			return response()->json(['status' => $httpStatus, 'message' => $message]);
		} catch (\Exception $err) {
			DB::rollback();
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	public static function storeServices($request)
	{
		try {
			$services = array_map('intval', explode(',', $request->service));
			$loginId = Auth::id();

			$addServices = [];
			$addParameters = [];
			foreach ($services as $service) {
				$type = 1;
				if ($request->type == 'sub-affiliates') {
					$type = 4;
				}
				array_push($addServices, [
					'service_id' => $service,
					'user_id' => decryptGdprData($request->id),
					'user_type' => $type,
					'assigned_by' => $loginId,
					'created_at' => Carbon::now(),
					'updated_at' => Carbon::now()
				]);

				array_push($addParameters, [
					'service_id' => $service,
					'user_id' => decryptGdprData($request->id),
					'plan_listing' => 'pl',
					'plan_detail' => 'pd',
					'remarketing' => 'rm',
				]);
			}

			UserService::insert($addServices);
			AffiliateParamter::insert($addParameters);
			$query =  self::getVerticals(decryptGdprData($request->id));
			return self::modifyverticalresult($query);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	public static function modifyverticalresult($services)
	{
		$data = [];
		foreach ($services as $value) {
			array_push($data, [
				'name' => ucfirst(decryptGdprData($value->first_name)) . ' ' . ucfirst(decryptGdprData($value->last_name)),
				'status' => $value->status,
				'created' => date("Y-m-d H:i:s", strtotime($value->created_at)),
				'title'  => $value->service_title,
				'id' => encryptGdprData($value->id),
				'service_id' => $value->service_id
			]);
		}
		return $data;
	}

	public static function getVerticalAssignedServices($userId)
	{
		try {
			return UserService::where('user_id', $userId)->pluck('service_id')->toArray();
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	public static function deleteVerticalById($request)
	{
		try {
			$httpStatus = 200;
			$message = trans('affiliates.delete');
			if ($request->type == 'sub-affiliates') {
				UserService::where('id', decryptGdprData($request->rowid))->delete();

				$userId = Affiliate::getAffiliateIdByParentId(decryptGdprData($request->id));
				$userId = encryptGdprData($userId);
				$verticals = Affiliate::getVerticals(decryptGdprData($request->id));
				$checkservices = [];
				foreach ($verticals as $key) {
					$checkservices[] = $key->service_id;
				}
				$assignedServices = Affiliate::getUserServices(decryptGdprData($userId), $checkservices);

				AffiliateParamter::where('user_id', decryptGdprData($request->id))->where('service_id', $request->service)->delete();

				return response()->json(['status' => $httpStatus, 'message' => $message, 'services' => $assignedServices]);
			}

			//Check affiliate in leads
			$query = self::checkAffiliateIdInleads(decryptGdprData($request->id),$request->service);
			if($query){
				return response()->json(['status' => 400, 'message' => trans('affiliates.servicealready')]);
			}
			//Check service is not assigned with any sub affiliates
			$getId = self::getAffiliateIdByUserId(decryptGdprData($request->id));
			$subaffiliateId =   self::getSubaffiliatesId($getId);
			if (count($subaffiliateId) > 0) {
				//check services of sub affiliates
				$type = 4;
				$checkServices = self::checkSubaffiliatesServices($subaffiliateId, $request->service, $type);
				if ($checkServices > 0) {
					//return error service in use
					return response()->json(['status' => 400, 'message' => trans('affiliates.servicealready')]);
				}
				//return success and delete record
				UserService::where('id', decryptGdprData($request->rowid))->delete();
			}
			//return success and delete record
			UserService::where('id', decryptGdprData($request->rowid))->delete();

			$assignedServices = Affiliate::getVerticalAssignedServices(decryptGdprData($request->id));
			$services = Affiliate::getServices($assignedServices);
            AffiliateParamter::where('user_id', decryptGdprData($request->id))->where('service_id', $request->service)->delete();
			return response()->json(['status' => $httpStatus, 'message' => $message, 'services' => $services]);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}

	public static function updatePassword($request)
	{
		$user = self::getUserByToken($request->token);
		return User::whereId($user->id)->update([
			'password' => Hash::make($request->password),
			'token' => null
		]);
	}

	public static function getParameterByServiceId($request){
		$service = $request->service;
		return AffiliateParamter::where('user_id', decryptGdprData($request->userid))->where('service_id', $service)->with('journey',function($q) use ($service){
			$q->where('service_id',$service);
		}	)->get();
	}

	public static function createUpdateParameter($request){
		try {
		  $update = [];
          $update['user_id'] = decryptGdprData($request->paramuser);
          $update['service_id'] = $request->paramservice;
          $update['plan_listing'] = $request->planlisting;
          $update['plan_detail'] = $request->plandetail;
          $update['remarketing'] = $request->remarketing;
          $update['slug'] = $request->slug;
          $update['terms'] = $request->terms;

		  $response = AffiliateParamter::updateOrCreate(['id' => isset($request->paramid) ? $request->paramid : ""], $update);

			UserService::where('user_id',decryptGdprData($request->paramuser))->where('service_id',$request->paramservice)->update([
			'journey_order' => $request->journey
			]);

          return response()->json(['status' => 200, 'message' => trans('affiliates.update')]);
		}catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()]);
		}
	}
}
