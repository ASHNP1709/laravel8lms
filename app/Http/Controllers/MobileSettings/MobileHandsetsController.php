<?php

namespace App\Http\Controllers\MobileSettings;

use App\Http\Controllers\Controller;
use App\Http\Requests\MobileSettings\PhoneFormRequest;
use App\Models\Brand;
use App\Models\Handset;
use App\Models\HandsetInfo;
use App\Models\OperatingSystem;
use Illuminate\Http\Request;
class MobileHandsetsController extends Controller
{


    public function index(Request $request){
      
      $brands = '';
      $os = config('app.operating_system');
      $phones = '';
      $brandNames = Brand::getBrandNames();
      $phonesListing = Handset::getPhonesListingData($request);

      if($request->isMethod('post')){
        return response()->json(['phonesListing'=>$phonesListing],200);
      }
      return view('pages.mobilesettings.handsets.index', compact('brands','phones','brandNames','phonesListing','os'));
    }

    /**
     * get create or edit view on $id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\View
     */
    public function getCreateOrEdit($id=null){
        if($id){
            $id = decryptGdprData($id);
            $phone = Handset::find($id);
        }else{
            $phone = null;
        }
        $brandNames = Brand::getBrandNames();
        $operatingSystemNames = OperatingSystem::getOperatingSystemNames();
        $moreInfo = null;
        $handsetInfoList = HandsetInfo::getHandsetInfo($id);
        return view('pages.mobilesettings.handsets.phones.form',compact('phone','brandNames','operatingSystemNames','moreInfo','handsetInfoList'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storePhone(PhoneFormRequest $request)
    {   
        $type = 'add';
        return Handset::storePhones($request,$type);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updatePhone(PhoneFormRequest $request, $id)
    {
        $type = 'update';
        return Handset::storePhones($request,$type, $id);
    }

     /**
     * Delete the specified resource from storage
     *
     */
    public function deletePhone($id){
        try {
			$response = Handset::deletePhone($id);
			return $response;
		} catch (\Exception $e) {
			$status = 400;
			$result = [
				'exception_message' => $e->getMessage()
			];
			return response()->json($result, $status);
		}

    }

    /**
     * Change the status of the specified resource in storage
     *
     */
    public function changeHandsetstatus(Request $request)
    {
           $response = Handset::changeHandsetStatus($request);  
            return response()->json($response,$response['http_status']);  
    }

    /**
     * Change the status of handset after confirming, in storage
     *
     */
    public function changeStatusAccepted(Request $request)
    {
           $response = Handset::changeStatusAccepted($request);  
            return response()->json($response,$response['http_status']);  
    }

    

}