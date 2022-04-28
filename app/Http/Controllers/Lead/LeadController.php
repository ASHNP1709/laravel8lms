<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use App\Models\{Providers, Affiliate, SaleAssignedEnergyQa, SaleAssignedBroadbandQa, SaleAssignedMobileQa, SaleStatusHistoryBroadband, User, Status, SaleStatusHistoryEnergy, SaleStatusHistoryMobile, SaleProductsEnergy, SaleProductsMobile, SaleProductsBroadband, StatusHierarchy,Lead,AffiliateKeys};
use Illuminate\Http\Request;
use DB;

class LeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $type = ['visits' => 0, 'leads' => 1, 'sales' => 2];
        $info = auth()->user()->info;
        if ($request->method() == 'POST') { 
            $page = $request->page - 1;
            
            DB::enableQueryLog();
            $queryString = 'where '; 
            $filterData = $this->filter($request); 
            $filterAssigned = 0;
            if (isset($type[$request->saleType]))
                $queryString .= 'l.status = '.$type[$request->saleType]; 

            if (isset($filterData['providerId']))
            {
                if($filterAssigned == 0)
                    $queryString .= ' and ';
                $queryString .= ' sp.provider_id = '.$filterData['providerId']; 
            }

            if (isset($filterData['referenceNo']))
            { 
                $queryString .= ' and sp.reference_no = '.$filterData['referenceNo'];
            } 

            if (isset($filterData['moveIn']))
            { 
                $queryString .= ' and sp.is_moving = '.$filterData['moveIn']; 
            }

            if (isset($filterData['moveInDate']))
            {   
                $queryString .= ' and sp.moving_at between '.$filterData['fromMovinDate'].' and '.$filterData['toMovinDate']; 
            }

            if ($type[$request->saleType] == 1  && isset($filterData['fromCreatedAt']) && isset($filterData['toCreatedAt']))
            { 
                $queryString .= ' and sp.created_at between '.$filterData['fromCreatedAt'].' and '.$filterData['toCreatedAt']; 
            }

            if ($type[$request->saleType] == 2  && isset($filterData['fromCreatedAt']) && isset($filterData['toCreatedAt']))
            { 
                $queryString .= ' and sp.sale_created_at between '.$filterData['fromCreatedAt'].' and '.$filterData['toCreatedAt']; 
            } 

            if (isset($filterData['leadId']))
            { 
                $queryString .= ' and l.lead_id = '.$filterData['leadId']; 
            }

            if (isset($filterData['affiliateId']))
            { 
                $queryString .= ' and a.user_id = '.$filterData['affiliateId']; 
            }

            if (isset($filterData['subAffiliateId']))
            { 
                $queryString .= ' and a.user_id = '.$filterData['subAffiliateId']; 
            }

            if (isset($filterData['first_name']))
            { 
                $queryString .= " and v.first_name = '".encryptGdprData($filterData['first_name'])."'"; 
            }

            if (isset($filterData['last_name']))
            { 
                $queryString .= " and v.last_name = '".encryptGdprData($filterData['last_name'])."'";
            }

            if (isset($filterData['email']))
            { 
                $queryString .= " and v.email = '".encryptGdprData($filterData['email'])."'";
            }

            if (isset($filterData['phone']))
            { 
                $queryString .= " and v.phone = '".encryptGdprData($filterData['phone'])."'";
            } 
            
            $leads = []; 
            $leads = DB::select('set @where_clause="' . $queryString.'"');
            $leads = DB::select('set @SL=0');
            $leads = DB::select('set @NOR=30'); 
            if($filterData['verticalId'] == 1)
            {   
                $leads = DB::select('call final_sales_listing_energy(@where_clause , @SL, @NOR)');
            } 
            else if($filterData['verticalId'] == 2)
            {   
                $leads = DB::select('call final_sales_listing_mobile(@where_clause , @SL, @NOR)');
                 
            }
            else if($filterData['verticalId'] == 3)
            {   
                $leads = DB::select('call final_sales_listing_mobile(@where_clause , @SL, @NOR)');
            }

            $leads = array_map(function ($lead) {
                $lead->AffiliateLegalName = decryptGdprData($lead->AffiliateLegalName);
                if(isset($lead->SubAffiliateName))
                    $lead->SubAffiliateName = decryptGdprData($lead->SubAffiliateName);
                if(isset($lead->VisitorFirstName))
                    $lead->VisitorFirstName = decryptGdprData($lead->VisitorFirstName);
                if(isset($lead->ProviderLegalName))
                    $lead->ProviderLegalName = decryptGdprData($lead->ProviderLegalName);
                if(isset($lead->AssignedUserName))
                    $lead->AssignedUserName = decryptGdprData($lead->AssignedUserName);
                return $lead;
            }, $leads);

            $leads = collect($leads)->groupBy('LeadId'); 

            $saleType = $request->saleType;

            return response()->json(['leads' => $leads,'serviceId' => $filterData['verticalId']], 200);
        }

        $saleType = explode('.', \Request::route()->getName())[0];
        $status = isset($type[$saleType]) ? $type[$saleType] : '0';

        $userServices = auth()->user()->services;
        $serviceId = isset($userServices[0]['id']) ? $userServices[0]['id'] : 0;  
        
        $affiliates = Affiliate::select('id', 'company_name', 'user_id')->where('parent_id', 0)->get();
        $subAffiliates = Affiliate::select('id', 'company_name', 'user_id')->where('parent_id', '<>', 0)->get();
        $providers = Providers::select('id', 'name', 'user_id')->get(); 
        $leads = []; 

        $leads = DB::select('set @SL=0');
        $leads = DB::select('set @NOR=30'); 
        $queryString = 'where l.status = '.$status; 
        $leads = DB::select('set @where_clause="' . $queryString.'"');

        if($serviceId == 1)
        {   
            $leads = DB::select('call final_sales_listing_energy(@where_clause , @SL, @NOR)');
        } 
        else if($serviceId == 2)
        {  
            $leads = DB::select('call final_sales_listing_mobile(@where_clause , @SL, @NOR)');
        } 
        else if($serviceId == 3)
        {     
            $leads = DB::select('call final_sales_listing_mobile(@where_clause , @SL, @NOR)');
        } 
        $leads = collect($leads)->groupBy('LeadId');  
     
        return view('pages.leads.list', compact('info', 'userServices', 'saleType', 'leads', 'affiliates', 'subAffiliates', 'providers','serviceId'));
    }

    public function filter($request)
    {
        $filterData = $request->all();  
        if(isset($filterData['date']))
        {
            $date = explode(" - ",$filterData['date']);
            $filterData['fromCreatedAt'] = $date[0];
            $filterData['toCreatedAt'] = $date[1];
        }

        if(isset($filterData['moveInDate']))
        {
            $date = explode(" - ",$filterData['moveInDate']);
            $filterData['fromMovinDate'] = $date[0];
            $filterData['toMovinDate'] = $date[1];
        } 
        return $filterData;
    }
    public function detail($verticalId, $productId)
    { 
        $leads = DB::select('set @leadId=' . $productId);
        $secondSaleDetail = null;
        switch ($verticalId) {
            case '1': 
                $saleDetails = DB::select('call final_sale_detail_energy(@leadId)'); 
                   
                //first sale product
                $saleDetail = isset($saleDetails[0]) ? $saleDetails[0]:null;
                $productId = isset($saleDetails[0]->sale_product_id) ? $saleDetails[0]->sale_product_id:null;
                $saleProduct = SaleProductsEnergy::saleProduct($productId);
                $statuses = SaleStatusHistoryEnergy::getStatusHistory($productId);
                
                // get sale products detail by using procedure 
                // $secondSaleDetail = isset($saleDetails[1]) ? $saleDetails[1]:null;
                // $productId = isset($saleDetails[1]->sale_product_id) ? $saleDetails[1]->sale_product_id:null;
                // $saleProduct = SaleProductsEnergy::saleProduct($productId);
                // $statuses = SaleStatusHistoryEnergy::getStatusHistory($productId);

                break;
            case '2': 
                $saleDetails = DB::select('call final_sale_detail_mobile(@leadId)');  
                $saleDetail = isset($saleDetails[0]) ? $saleDetails[0]:null;
                $productId = isset($saleDetails[0]->sale_product_id) ? $saleDetails[0]->sale_product_id:null;
                $saleProduct = SaleProductsMobile::saleProduct($productId);   
                $statuses = SaleStatusHistoryMobile::getStatusHistory($productId);
                break;
            case '3':
                $saleDetails = DB::select('call final_sale_detail_mobile(@leadId)');  
                $saleDetail = isset($saleDetails[0]) ? $saleDetails[0]:null;
                $productId = isset($saleDetails[0]->sale_product_id) ? $saleDetails[0]->sale_product_id:null;
                $saleProduct = SaleProductsBroadband::saleProduct($productId);
                $statuses = SaleStatusHistoryBroadband::getStatusHistory($productId); 
                break;
            default:
                $saleDetails = DB::select('call final_sale_detail_mobile(@leadId)');  
                $saleDetail = isset($saleDetails[0]) ? $saleDetails[0]:null;
                $productId = isset($saleDetails[0]->sale_product_id) ? $saleDetails[0]->sale_product_id:null;
                $saleProduct = SaleProductsEnergy::saleProduct($productId);
                $statuses = SaleStatusHistoryEnergy::getStatusHistory($productId); 
                break;
        } 
        return view('pages.leads.detail', compact('statuses', 'saleProduct', 'verticalId','saleDetail'));
    }


    public function getQaList()
    {
        $qas = User::users(4);
        return response()->json(['qas' => $qas]);
    }

    public function getAssignedQaList(Request $request)
    {
        $qas = User::users(4);   

        $saleProduct = new SaleProductsEnergy;
        if($request->serviceId == 2)
        {
            $saleProduct = new SaleProductsMobile;
        }
        elseif($request->serviceId == 3)
        {
            $saleProduct = new SaleProductsBroadband;
        } 
        $data = $saleProduct->with(['getAssignedQa' => function($query)
        {
            $query->select('id','lead_id','user_id')->where('type',2);
        }])->select('lead_id')->whereIn('lead_id',array_column($request->lead_id,'id'))->get()->toArray(); 
        
        return response()->json(['qas' => $qas,'assigned_qas' => $data]);
    }

    public function assignQa(Request $request)
    {
        try {
            $authUser = auth()->user();
            $dataToInsert = [];
            $leadIds = [];

            $assignedUsers = DB::table('lead_assigned_users')->select('lead_id', 'assigned_user', 'type')->whereIn('lead_id', $leadIds)->get()->toArray();

            $assignedQas =  array_filter($assignedUsers, function ($qa) {
                return $qa->type == 1;
            });
            $assignedCollaborators =  array_filter($assignedUsers, function ($qa) {
                return $qa->type == 2;
            });
             
            return response()->json(['assignedQas' => $assignedQas, 'assignedCollaborators' => $assignedCollaborators]);
 
            return response()->json(['message' => 'QA assigned successfully']);
        } catch (\Throwable $th) {
            return response()->json(['exception' => $th->getMessage() . $th->getLine()]);
        }
    }


    public function assginQaTOsale(Request $request)
    {
        try {
            switch ($request->verticalId) {
                case '1':
                    return  SaleAssignedEnergyQa::assginQaTOsale($request);
                    break;
                case '2':
                    return SaleAssignedMobileQa::assginQaTOsale($request);
                    break;
                case '3':
                    return SaleAssignedBroadbandQa::assginQaTOsale($request);
                    break;
            }
            return response()->json(['message' => "Failed to assign QA/collaborator"], 400);
        } catch (\Exception $e) {

            $result = [
                'exception_message_front' => $e->getMessage(),
                'exception_message_line' => $e->getLine(),
                'success' => 'false'
            ];
            return response()->json($result, 400);
        }
    }

    public function getSubStatus(Request $request)
    {
        try {
            return StatusHierarchy::where('status_id', $request->status)->where('type', 2)->with('getStatus')->get();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Whoops! Unable to fetch sub status.', 'exception' => $th->getMessage() . $th->getLine()], 500);
        }
    }
    public function changeStatus(Request $request)
    {
        try {
            switch ($request->service_id) {
                case '1':
                    return SaleProductsEnergy::updateStats($request);
                    break;
                case '2':
                    return SaleProductsMobile::updateStats($request);
                    break;
                case '3':
                    return SaleProductsBroadband::updateStats($request);
                    break;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        dd('herre');

        // try {
        //     $saleProductId = decryptGdprData($request->saleProductId);
        //     $status = $request->status;
        //     $subStatus = $request->sub_status;
        //     $comment = $request->comment;
        //     $user = auth()->user();
        //     SaleProduct::where('id', $saleProductId)->update(['sale_status' => $status]);
        //     SaleProductStatusHistory::create([
        //         'user_id' => $user->id,
        //         'sale_product_id' => $saleProductId,
        //         'status' => $status,
        //         'sub_status' => $subStatus,
        //         'comment' => $comment
        //     ]);
        //     return response()->json(['message' => 'Status changed successfully.']);
        // } catch (\Throwable $th) {
        //     throw $th;
        // }
    }

    public function getAffiliateData(Request $request){
        try {
             
                $affiliates = Affiliate::where('status',1);
                if($request->type !="sub-affiliate"){
                   $affiliates =  $affiliates->where('parent_id',0);
                }else{   
                    $affiliateId = Affiliate::where('user_id',$request->affiliate_id)->value('id');
                    $subAffiliateId = Affiliate::select('id','user_id','company_name')->where('parent_id',$affiliateId)->get()->toArray();  
                    $subAffiliateId = array_column($subAffiliateId,'user_id');  
                    $affiliates =  $affiliates->whereIn('user_id',$subAffiliateId);
                }
                $affiliates =  $affiliates->select('user_id','legal_name','company_name')->get()->toArray();
                return response()->json(['data' => $affiliates ,200]); 
            
        }catch(\Exception $e) {
            $result = [
                'exception_message' => $e->getMessage()
            ];

        }
    }

    public function changeAffiliate(Request $request){ 
        try {  
            $id =$request->lead_id;  
            $data = [];
            $affiliate_id = $request['affiliate_id'];
            if($request->type=='sub-affiliate'){ 
                $data['sub_affiliate_id'] = $affiliate_id; 
            }else{
                $affiliate_key_id = AffiliateKeys::where('user_id',$affiliate_id)->where('status',1)->orderBy('id', 'asc')->pluck('id')->first();
                if(empty($affiliate_key_id)){
                    $response = ['message'=>'Please enable atleast one affiliate key.'];
                    $status = 422;  
                    return response()->json($response,$status);
                }

                $data['api_key_id'] = $affiliate_key_id; 
                $data['affiliate_id'] = $affiliate_id;  
            }  
            $result = Lead::where('lead_id',$id)->update($data);  
            if($result){
                $msg ='Affliate updated Successfully.';
                if($request->type=='sub-affiliate'){
                    $msg ='Sub-Affliate updated Successfully.';
                }
                $response = ['message'=>$msg]; 
                $status = 200;   
                return response()->json( $response ,$status); 
            }
            $response = ['message'=>'Affiliate not updated']; 
            $status = 400;  
            return response()->json($response ,$status); 
            
        }catch(\Exception $e) {
            $result = [
                'message' => $e->getMessage()
            ]; 
            return response()->json($result ,400); 
        }
    }

}
