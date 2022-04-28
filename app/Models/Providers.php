<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Affiliate\{  GeneralMethods,ManageUsers };
use App\Repositories\ProviderConsentRepository\{ BasicCrudMethods, Relationship, Accessor, Mutators, StatesMethods };

class Providers extends Model
{
    use BasicCrudMethods, Relationship, Accessor, Mutators, GeneralMethods, ManageUsers, StatesMethods;

	protected $fillable = ['user_id','address_id','service_id','name','legal_name','abn_acn_no','support_email','complaint_email','description','demand_usage_check','status'];
}
