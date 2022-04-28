<?php

namespace App\Http\Controllers\Plans;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\SolarRate;
use App\Http\Requests\Plan\SolarRateRequest;


class EnergySolarPlanRate extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($planId)
    {
        try {
            $planId = decryptGdprData($planId);
            $solarRate =SolarRate::getSolarRateList($planId);
            $url = URL('provider/plans/energy/electricity/list'.'/'.encryptGdprData(5));
            $planData=[]; 
            return view('pages.plans.energy.planRate.index', compact('solarRate','planData','planId','url'));
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createUpdateSolar(SolarRateRequest $request)
    {
        try {
            $result =  SolarRate::saveSolarRate($request);

            if($result){
                return response()->json(['status'=>true,'message'=>trans('plan.solarUpdate'),'reload_page'=>true],200);
            }else{
                return response()->json(['status'=>false,'message'=>'something went wrong'],400);
            }
        }  catch (\Exception $e) {
            return response()->json(['status'=>false,'message'=>$e->getMessage()],400);


        }

    }
    public function postChangeStatus(Request $request)
    {
        try {
            $result = SolarRate::updateStatus($request);

            if($result){
                return response()->json(['status'=>true,'message'=>'solar Rate active successfuly','reload_page'=>true],200);
            }else{
                return response()->json(['status'=>false,'message'=>'something went wrong'],400);
            }

        }  catch (\Exception $e) {
            return response()->json(['status'=>false,'message'=>$e->getMessage()],400);

        }

    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
