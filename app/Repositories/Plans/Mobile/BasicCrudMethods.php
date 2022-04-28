<?php

namespace App\Repositories\Plans\Mobile;

use App\Models\{PlanMobileReference, PlansTelcoContent, Providers, ConnectionType, PlanMobile, Contract, CostType};
use App\Repositories\Plans\Common;


trait BasicCrudMethods
{
	use Common;

	/**
	 * Mobile Plan Listing
	 */

	public static function planList($request, $providerId)
	{
		try {
			$providerId = decryptGdprData($providerId);
			$plans = self::select('id', 'name', 'connection_type', 'plan_type', 'status')->where('provider_id', $providerId);
			if (isset($request->name_filter)) {
				$plans = $plans->Where('name', 'like', '%' . $request->name_filter . '%');
			}
			if (isset($request->plan_type_filter)) {
				$plans = $plans->where('plan_type', $request->plan_type_filter);
			}
			if (isset($request->connection_type_filter)) {
				$plans = $plans->where('connection_type', $request->connection_type_filter);
			}
			if (isset($request->status_filter)) {
				$plans = $plans->where('status', $request->status_filter);
			}
			return $plans->get();
		} catch (\Throwable $th) {
			throw $th;
		}
	}
	/**
	 * create or update edit provider
	 */

	public static function storePlan($request, $providerId, $id = null)
	{
		try {
			$data = $request->except('form');
			$data['provider_id'] = decryptGdprData($providerId);
			if ($id) {
				$id = decryptGdprData($id);
			}
			switch ($request->form) {
				case 'plan_basic_details_form':
					// $data['cost'] = 20;
					$data['network_type'] = isset($data['network_type']) && count($data['network_type']) ? implode(',', $data['network_type']) : null;

					break;
				case 'plan_national_inclusion_form':
					$data['national_toll_free_numbers'] = isset($data['national_toll_free_numbers']) && count($data['national_toll_free_numbers']) ? implode(',', $data['national_toll_free_numbers']) : null;
					break;
					// 
				case 'plan_term_condition_form':
					self::updatePlanTermsContent($request);
					break;
				case 'plan_other_info_form':
					self::updatePlanOtherInfo($request, $id);
					break;
				case 'plan_reference_form':
					$planRefId = null;
					if ($request->has('planRefId'))
						$planRefId = decryptGdprData($request->planRefId);
					self::storeplanMobileReference($request, $providerId, $id, $planRefId);
					break;

				default:
					# code...
					break;
			}

			$plan = self::updateOrCreate(['id' => $id], $data);
			// $plan = self::create($data);
			$response = ['status' => 200, 'message' => 'Success', 'listingUrl' => null];
			if (!$id) {
				self::generatePlanTermsContent($plan->id);
				$response['listingUrl'] = url('/provider/plans/mobile/' . $providerId);
			}
			if ($request->form == 'plan_term_condition_form') {
				$plansTermList = PlansTelcoContent::select('id', 'title', 'description')->where('plan_id', $plan->id)->get();
				$response['plansTermList'] = $plansTermList;
			}
			if ($request->form == 'plan_reference_form') {
				$planRefList = PlanMobileReference::select('id', 'title', 'url', 's_no')->where('plan_id', $plan->id)->orderBy('s_no')->get();
				$response['planRefList'] = $planRefList;
			}

			if ($plan) {
				return response()->json($response, 200);
			}
			return response()->json(['status' => 400, 'message' => 'False'], 400);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()], 500);
		}
	}

	public static function updatePlanOtherInfo($request, $planId)
	{
		try {
			PlansTelcoContent::where('plan_id', $planId)->where(function ($q) {
				$q->where('slug', '=', '')->orWhereNull('slug');
			})->delete();
			$otherInfosData = [];
			// dd(count($request->other_info_field));
			if (count($request->other_info_field)) {
				foreach ($request->other_info_field as $key => $value) {
					$otherInfosData[] = ['plan_id' => $planId, 'service_id' => 2, 'title' => $value ?? '', 'slug' => null, 'description' => $request->other_info_desc[$key] ?? '', 'status' => 1, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()];
				}
				// if(count($otherInfosData) == 1 && ($otherInfosData[0]['title'] !='' || $otherInfosData[0]['description'] !='' ))
				return PlansTelcoContent::insert($otherInfosData);
			} else {
				return true;
			}
		} catch (\Throwable $th) {
			throw $th;
		}
	}

	public static function updatePlanTermsContent($request)
	{
		try {
			return PlansTelcoContent::where('id', decryptGdprData($request->planTermId))->update(['title' => $request->term_title_content, 'description' => $request->term_content]);
		} catch (\Throwable $th) {
			throw $th;
		}
	}

	public static function generatePlanTermsContent($plan_id)
	{
		$planTerms = config('mobilePlan.planTerms');
		$insertData = [];
		foreach ($planTerms as $key => $value) {
			$insertData[] = ['plan_id' => $plan_id, 'service_id' => 2, 'title' => $value, 'slug' => $key, 'description' => '', 'status' => 1, 'created_at' => \Carbon\Carbon::now(), 'updated_at' => \Carbon\Carbon::now()];
		}

		return PlansTelcoContent::insert($insertData);
	}


	/**
	 * get plan details
	 */

	public static function storeplanMobileReference($request, $providerId, $planId, $id = null)
	{
		try {
			$data = $request->all();
			$data['plan_id'] = $planId;
			if ($request->linktype == 2) {
				if ($request->has('file')) {
					$file = $request->file;
					$s3Folder = 'plans/mobile/' . $planId . '/plan-reference/';
					$name = time() . $file->getClientOriginalName();
					$uploadFile = \Storage::disk('s3')->put($s3Folder . '/' . $name, file_get_contents($file), 'public');
					$data['url'] = "https://" . config('env.AWS_BUCKET') . ".s3." . config('env.DEFAULT_REGION') . ".amazonaws.com/" . $s3Folder . $name;
				}
			}
			if (isset($request->current_s_no) && $request->current_s_no != '')
				PlanMobileReference::where('s_no', $request->s_no)->update(['s_no' => $request->current_s_no]);
			PlanMobileReference::updateOrCreate(['id' => $id, 'plan_id' => $planId], $data);
			return self::where('provider_id', $providerId)->where('id', $planId)->first();
		} catch (\Throwable $th) {
			throw $th;
		}
	}



	/**
	 * get plan details
	 */

	public static function createPlan($providerId, $planId)
	{
		try {
			// $providerId = decryptGdprData($providerId);
			// $planId = decryptGdprData($planId);
			// $plan = self::where('provider_id', $providerId)->where('id', $planId)->first();
			// $connectionTypes = ConnectionType::select('name', 'id')->where('service_id', 2)->where('status', 1)->pluck('name', 'id')->toArray();
			// $contracts = Contract::where('status', 1)->get();
			// $planTypes = config('mobilePlan.planTypes');
			// $businessSizes = config('mobilePlan.businessSizes');
			// $planDataUnits = [1 => "MB", 2 => "GB"];
			// $networkTypes = config('mobilePlan.networkTypes');
			// $tollFreeNumbers = config('mobilePlan.tollFreeNumbers');
			// $costTypes = CostType::select('cost_name', 'id')->where('status', '1')->orderBy('order')->pluck('cost_name', 'id')->toArray();
			// return view('pages.plans.mobile.form', compact('plan', 'providerId', 'connectionTypes', 'planTypes', 'planDataUnits', 'networkTypes', 'tollFreeNumbers', 'contracts', 'businessSizes', 'costTypes'));
		} catch (\Throwable $th) {
			throw $th;
		}
	}

	/**
	 * get plan details
	 */

	public static function planDetail($providerId, $planId)
	{
		try {
			$providerId = decryptGdprData($providerId);
			$planId = decryptGdprData($planId);
			return self::where('provider_id', $providerId)->where('id', $planId)->first();
		} catch (\Throwable $th) {
			throw $th;
		}
	}

	/**
	 * Delete Plan Reference
	 */

	public static function deletePlan($providerId, $id)
	{
		try {
			$id = decryptGdprData($id);
			self::where('id', $id)->where('id', $id)->delete();
			return response()->json(['status' => 200, 'message' => 'Success'], 200);
		} catch (\Throwable $th) {
			throw $th;
		}
	}

	/**
	 * Delete Plan Reference
	 */

	public static function changePlanStatus($request, $providerId, $id)
	{
		try {
			$id = decryptGdprData($id);
			self::where('id', $id)->update(['status' => $request->status]);
			return response()->json(['status' => 200, 'message' => 'Success'], 200);
		} catch (\Throwable $th) {
			throw $th;
		}
	}

	/**
	 * Delete Plan Reference
	 */

	public static function deletePlanReference($providerId, $planId, $id)
	{
		try {
			$id = decryptGdprData($id);
			$planId = decryptGdprData($planId);
			PlanMobileReference::where('id', $id)->where('plan_id', $planId)->delete();
			$planRefList = PlanMobileReference::select('id', 'title', 'url', 's_no')->where('plan_id', $planId)->orderBy('s_no')->get();
			return response()->json(['status' => 200, 'message' => 'Success', 'planRefList' => $planRefList], 200);
		} catch (\Throwable $th) {
			throw $th;
		}
	}
}
