<?php

namespace App\Http\Controllers\Affiliates;

use App\Http\Controllers\Controller;
use App\Http\Requests\Affiliates\CommissionRequest;
use App\Models\Affiliate;
use Illuminate\Http\Request;

class CommissionController extends Controller
{
    public function getCommission($affiliate_id)
    {
        try {
            return Affiliate::getCommission($affiliate_id);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function getCommissionAjax(Request $request, $affiliate_id, $service_id=null)
    {
        try {
            return Affiliate::getCommissionAjax($request, $affiliate_id, $service_id);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()]);
        }
    }

    public function addCommission(CommissionRequest $request, $affiliate_id, $service_id){
        try {
            return Affiliate::addCommission($request, $affiliate_id, $service_id);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()]);
        }
    }
}
