<?php

namespace App\Repositories\Distributor;


trait BasicCrudMethods
{
	public static function getDistributorWithPostcodes($energyType, $providerId)
	{
		return self::where('status', 1)->where('is_deleted', 0)->where('energy_type', (int)$energyType)->with(['postCodes', 'providerPostCodes' => function ($q) use ($providerId) {
            $q->where('provider_id', decryptGdprData($providerId));
        }])->get();
	}
}
