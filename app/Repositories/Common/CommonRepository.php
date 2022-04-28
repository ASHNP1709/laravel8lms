<?php

namespace App\Repositories\Common;

use App\Models\Distributor;

use DB;

trait CommonRepository
{
    public static function getIdentificationArr()
    {
        return DB::table('master_identification_details')->pluck('options', 'id');
    }

    public static function getDistributorList($energy)
    {
        return Distributor::where('status', 1)->where('is_deleted', 0)->where('energy_type', $energy)->get()->pluck('name', 'id');
    }
}
