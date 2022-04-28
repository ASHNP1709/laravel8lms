<?php

namespace App\Repositories\MobileSettings\Brands;
use App\Models\{Brand,Handset};



trait BasicCrudMethods
{
	
	/**
	 * create or update edit brands
	 */
	public function storeBrand($requestArr)
    {
        $editID = '';
        if ($requestArr->hidden_edit_id) {
            $editID = $requestArr->hidden_edit_id; //table id
        }
        $recordArr = [
            'title' =>  $requestArr->title,
            'os_name' => $requestArr->os_name,
			
        ];
		

        $result = self::updateOrCreate(['id' => $editID], $recordArr);
		
	
        return ['status' => true, 'message' => trans('handsets.brandPage.success_message'), 'edit_id' => $result['id']];
    }

	public static function getMobileBrands($request)
	{
		$brandRecord = [];
		$status = 1;
        if($request->has('filter_status')){
            $status = $request->filter_status;
        }
        if($request->has('filter_status') && ($request->filter_status == 'all')){
			$brandRecord['brand'] = self::orderBy('created_at', 'desc')->Paginate(20);
        }else{
			$brandRecord['brand'] = self::where('status',$status)->orderBy('created_at', 'desc')->Paginate(20);
		}
		return $brandRecord;
	}


	public static function deleteBrand($id)
	{
		// $id = encryptGdprData($id);
        // delete cases.
        // 1. check if brand assigned to some handsets or not.
        $found =  Handset::where('brand_id',$id)->count();
        if($found > 0){
			$result = [
				'status' => false,
				'message' => trans('handsets.brandPage.delete_error')
			];
        }
        else{
            Brand::destroy($id);
			$result = [
				'status' => true,
				'message' => trans('handsets.brandPage.delete_success')
			];
			
        }
		return $result;
	
	}
	
	public function changeStatus($requestArr)
    {
        //if (User::find(decryptGdprData($requestArr['user_id']))->status == 1) {
        $status = Self::where('id', ($requestArr['id']))
            ->update(['status' => $requestArr['status']]);
        if ($status) {
            return ['status' => true, 'message' => trans('handsets.brandPage.brand_status_success')];
        }
        return ['status' => false, 'message' => trans('handsets.brandPage.brand_error')];
    }


}
