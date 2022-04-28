<?php

namespace App\Repositories\SaleProduct;
use App\Models\{SaleStatusHistoryEnergy, SaleStatusHistoryMobile, SaleStatusHistoryBroadband};


trait CommonCrud
{
	public static function saleProduct($id)
	{
		try {
            return self::where('id',$id)->with('statusHierarchies')->first();
		} catch (\Exception $err) {
			throw $err;
		}
	}

    public static function updateStats($request)
    {
        try {
            $saleProductId = decryptGdprData($request->saleProductId);
            self::where('id', $saleProductId)->update(['sale_status' => $request->status]);
            switch ($request->service_id) {
                case '1':
                    return SaleStatusHistoryEnergy::createHistory($request, $saleProductId);
                    break;
                case '2':
                    return SaleStatusHistoryMobile::createHistory($request, $saleProductId);
                    break;
                case '3':
                    return SaleStatusHistoryBroadband::createHistory($request, $saleProductId);
                    break;
            }
        } catch (\Exception $err) {
            throw $err;
        }
    }
}
