<?php
namespace App\Repositories\PlansEnergy;


trait PlanSolarRate
{
    static function getSolarRateList($planId){

        return self::where('plan_id',$planId)->OrderByDesc('id')->get();
      }

     static function saveSolarRate($requestData){
        $solarRate['solar_price'] =$requestData->solar_rate;
        $solarRate['solar_description'] =$requestData->solar_desc;
        $solarRate['is_show_frontend'] =$requestData->show_on_frontend;
        $solarRate['charge'] =$requestData->charge;
        $solarRate['plan_id'] =$requestData->plan_id; 
        $solarRate['status'] =0;

         if($requestData->has('id')&& $requestData->id == ''){
            return self::create($solarRate);
         }
         return self::where('id',decryptGdprData($requestData->id))->update($solarRate);

     }
     static function updateStatus($requestData){
         try {
             if($requestData->has('change_show_frontend')){
                return self::where('id',decryptGdprData($requestData->id))->update(['is_show_frontend'=>$requestData->change_show_frontend]);
             }
            self::where('plan_id',$requestData->plan_id)->where('status',1)->update(['status'=>0]);

            return self::where('id',decryptGdprData($requestData->id))->update(['status'=>$requestData->status]);
         } catch (\Exception $e) {
            return $e->getMessage();

        }

        return false;

     }



}

?>
