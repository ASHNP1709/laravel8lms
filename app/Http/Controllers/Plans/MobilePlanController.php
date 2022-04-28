<?php

namespace App\Http\Controllers\Plans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{Providers, ConnectionType, PlanMobile, Contract, CostType, PlansTelcoFee, Fee};
use App\Http\Requests\Plan\Mobile\PlanFormRequest;
use App\Http\Requests\Plan\Broadband\PlanBroadbandFeeRequest;

class MobilePlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $providerId)
    {
        try {
            $filters = $request->all();
            $plans = PlanMobile::planList($request, $providerId);
            $connectionTypes = ConnectionType::select('name', 'id')->where('service_id', 2)->where('status', 1)->pluck('name', 'id')->toArray();
            $planTypes = config('mobilePlan.planTypes');
            $selectedProvider = Providers::where('user_id',decryptGdprData($providerId))->first();
            return view('pages.plans.mobile.list', compact('selectedProvider','providerId', 'plans', 'planTypes', 'connectionTypes', 'filters'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $providerId)
    {
        try {
            // $connectionTypes = ConnectionType::select('name', 'local_id')->where('service_id', 2)->where('status', 1)->pluck('name', 'local_id')->toArray();
            $connectionTypes = ConnectionType::select('name', 'local_id','connection_type_id')->where('service_id', 2)->where('status', 1)->get();
            $contracts = Contract::where('status', 1)->get();
            $planTypes = config('mobilePlan.planTypes');
            $businessSizes = config('mobilePlan.businessSizes');
            $planDataUnits = [1 => "MB", 2 => "GB"];
            $networkTypes = config('mobilePlan.networkTypes');
            // $costTypes = [1 => "Monthly", 2 => "Quarterly",3 => "Yearly"];
            $costTypes = CostType::where('status', '1')->orderBy('order')->get();
            $feeTypes = Fee::get();
            $selectedProvider = Providers::where('user_id',decryptGdprData($providerId))->first();
            return view('pages.plans.mobile.form', compact('selectedProvider','providerId', 'connectionTypes', 'planTypes', 'planDataUnits', 'networkTypes', 'contracts', 'businessSizes', 'costTypes', 'feeTypes'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanFormRequest $request, $providerId)
    {
        return PlanMobile::storePlan($request, $providerId);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($providerId, $id)
    {
        try {
            $plan = PlanMobile::planDetail($providerId, $id);
            //$connectionTypes = ConnectionType::select('name', 'id')->where('service_id', 2)->where('status', 1)->pluck('name', 'id')->toArray();
            $connectionTypes = ConnectionType::select('name', 'local_id','connection_type_id')->where('service_id', 2)->where('status', 1)->get();
            $contracts = Contract::where('status', 1)->get();
            $planTypes = config('mobilePlan.planTypes');
            $businessSizes = config('mobilePlan.businessSizes');
            $planDataUnits = [1 => "MB", 2 => "GB"];
            $networkTypes = config('mobilePlan.networkTypes');
            $tollFreeNumbers = config('mobilePlan.tollFreeNumbers');
            // $costTypes = CostType::select('cost_name', 'id')->where('status', '1')->orderBy('order')->pluck('cost_name', 'id')->toArray();
            $costTypes = CostType::where('status', '1')->orderBy('order')->get();
            $feeTypes = Fee::get();
            $cancelButtonUrl = url('/provider/plans/mobile/' . $providerId);
            $selectedProvider = Providers::where('user_id',decryptGdprData($providerId))->first();
            return view('pages.plans.mobile.form', compact('selectedProvider','plan', 'providerId', 'connectionTypes', 'planTypes', 'planDataUnits', 'networkTypes', 'tollFreeNumbers', 'contracts', 'businessSizes', 'costTypes', 'feeTypes', 'cancelButtonUrl'));
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanFormRequest $request, $providerId, $id)
    {
        return PlanMobile::storePlan($request, $providerId, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyPlan($providerId, $id)
    {
        return PlanMobile::deletePlan($providerId, $id);
    }

    public function changePlanStatus(Request $request, $providerId, $id)
    {
        return PlanMobile::changePlanStatus($request, $providerId, $id);
    }

    public function destroyPlanReference($providerId, $planId, $id)
    {
        return PlanMobile::deletePlanReference($providerId, $planId, $id);
    }

    /**
     * store plan fees in database.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function savePlanFee(PlanBroadbandFeeRequest $request)
    {
        try {
            $response = PlanMobile::savePlanFeeRepo($request);
            return response()->json($response['data'], $response['status']);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()], 400);
        }
    }

    /**
     * store plan fees in database.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function deletePlanFee(Request $request)
    {
        try {
            $response = PlanMobile::deletePlanFeeRepo($request);
            return response()->json($response['data'], $response['status']);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()], 400);
        }
    }
}
