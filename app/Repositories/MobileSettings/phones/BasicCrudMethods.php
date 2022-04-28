<?php

namespace App\Repositories\MobileSettings\phones;

use App\Models\Handset;
use App\Models\HandsetInfo;
use App\Models\PlanMobileHandset;
use App\Models\ProviderHandset;
use App\Models\Providers;
use Illuminate\Support\Facades\DB;

trait BasicCrudMethods
{
	public static function getPhonesListingData($request = null){

        $list = self::with('brand','variants');
        if(isset($request->filter_status)){

            $status = $request->filter_status;
			$list->where('status',$status);
        }
        if(isset($request->search_phone)){
            $list->where('name','like', "%" . $request->search_phone . "%");
        }
        if(isset($request->search_model)){
            $list->where('model','like', "%" . $request->search_model . "%");
        }
        if(isset($request->search_brand)){
            $list->where('brand_id','=',$request->search_brand);
        }
        $phones = $list->get();
        return $phones;
    }

    /**
	 * create or update edit phone
	 */

	public static function storePhones($request, $type, $id = null)
	{
		try {
			if ($id) {
				$id = decryptGdprData($id);
			}
			$data = $request->except('form');
            if($request->form == 'add_more_info_form'){
				$handsetInfoId = null;
					if ($request->has('handset_info_id')){
						$handsetInfoId = $request->handset_info_id;
					}
				self::storeMobileMoreInfo($request,$id,$handsetInfoId);

				$handsetInfoList = HandsetInfo::where('handset_id', $id)->orderBy('s_no')->get();
				$response['handsetInfoList'] = $handsetInfoList;
			}
			else{
				$data['status'] = '1';
				self::updateOrCreate(['id' => $id], $data);
			}
			$response['status'] = 200;
			$response['message'] = 'Success';
			$response['type'] = $type;
            return response()->json($response, 200);
		} catch (\Exception $err) {
			return response()->json(['status' => 400, 'message' => $err->getMessage()], 500);
		}
	}

	/**
	 * Delete selected Phone
	 */

	public static function deletePhone($id)
	{
		$id = decryptGdprData($id);
        $assignedProviders =  ProviderHandset::where('handset_id',$id)->count();
        if($assignedProviders > 0){
			$result = [
				'status' => false,
				'message' => trans('handset.indexPage.delete_error')
			];
        }
        else{
            self::with('variants')->where('id',$id)->delete();
			$result = [
				'status' => true,
				'message' => trans('handset.indexPage.delete_success'),
				'phoneListing' => self::getPhonesListingData(),
			];
			
        }
		return $result;
	
	}

	/**
	 * Save Handset Extra Info
	 */

	public static function storeMobileMoreInfo($request, $handsetId, $id=null)
	{
		try {
			$data = $request->all();
			$data['handset_id'] = $handsetId;
			if ($request->linktype == 'file') {
				if ($request->has('file')) {
					$file = $request->file;
					$s3Folder = 'mobile/' . $handsetId . '/more-info/';
					$name = time() . $file->getClientOriginalName();
					// $uploadFile = \Storage::disk('s3')->put($s3Folder . '/' . $name, file_get_contents($file), 'public');
					$data['image'] = "https://" . config('env.AWS_BUCKET') . ".s3." . config('env.DEFAULT_REGION') . ".amazonaws.com/" . $s3Folder . $name;
				}
			}elseif($request->linktype == 'url'){
				if ($request->has('url')) {
					$data['image'] = $request->url;
				}
			}
			if (isset($request->current_s_no) && $request->current_s_no != ''){
				HandsetInfo::where('s_no', $request->s_no)->update(['s_no' => $request->current_s_no]);
			}
			HandsetInfo::updateOrCreate(['id' => $id], $data);
		} catch (\Throwable $th) {
			throw $th;
		}
	}

	public static function changeHandsetStatus($request){
		$id = decryptGdprData($request->handset_id);
        $status= $request->get('status');
        $res = self::find($id);

        $assigned_provider=[];
		$decryptedProviders = [];
        if($res->assign_provider)
        {
            $assigned_provider = $res->assign_provider->pluck('provider_id');
        }
        if(($status == 0) && ( $assigned_provider->count() > 0)) {
           $http_status = 400;
           $assigned_provider = Providers::whereIn('id',$assigned_provider)->pluck('name');
		   $decryptedProviders = [];
		   foreach($assigned_provider as $provider){
			   $decryptedProviders[] = decryptGdprData($provider);
		   }
           $response['decryptedProviders'] = $decryptedProviders;
		   $response['http_status'] = $http_status;
           return $response;
        }

        if($res->count() > 0) {

            if(($status == 1) && ($res->technology =="" ||  $res->network_managebility==""  || $res->extra_technology ==""  || $res->dimension ==""  || $res->weight ==""  || $res->sim_compatibility ==""  || $res->screen_type ==""  || $res->screen_size ==""  || $res->screen_resolution ==""  || $res->os ==""  || $res->chipset ==""  || $res->cpu ==""  || $res->sensors ==""  ||  $res->technical_specs ==""  || $res->battery_info ==""  || $res->in_the_box == "" || $res->image == "" || $res->camera == "") )
            {
                $response['http_status'] = 422;
                $response['message'] = trans('handset.indexPage.complete_handset_info_before');
            }
            else
            {
                $res->status = $status;

                if($res->update())
                {
                    PlanMobileHandset::where('handset_id',$id)->update(['master_status'=>$status]);
                    $response['http_status'] = 200;
                    $response['message'] =  trans('handset.indexPage.handset_status_changed');
                }else{
                    $response['http_status'] = 422;
                    $response['message'] = trans('handset.indexPage.handset_status_change_error');
                }
            }
        }
		return $response;
        
    }

	  /*
    * purpose: change status of master handset if this is assigned to some provider's handsets.iee. after confirmation if already assigned.
    */
    public static function changeStatusAccepted($request){
        $id = decryptGdprData($request->handset_id);
        $status= $request->get('status');

        $res= self::where('id',$id)->update(['status'=>$status]);
        if($res)
        {
            PlanMobileHandset::where('handset_id',$id)->update(['master_status'=>$status]);
			$response['http_status'] = 200;
            $response['message'] = trans('handset.indexPage.handset_status_changed');
        }else{
			$response['http_status'] = 422;
			$response['message'] = trans('handset.indexPage.handset_status_change_error');
		}
        return $response;
    }
}
