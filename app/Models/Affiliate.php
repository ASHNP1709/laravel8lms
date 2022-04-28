<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Affiliate\{BasicCrudMethods, CommissionStructureMethods, Relationship, Accessor, Mutators, GeneralMethods};

class Affiliate extends Model
{
    use BasicCrudMethods, Relationship, Accessor, Mutators, GeneralMethods, CommissionStructureMethods;

    protected $fillable = ['user_id', 'parent_id', 'legal_name', 'company_name', 'sender_id', 'support_phone_number', 'lead_export_password', 'sale_export_password', 'generate_token', 'show_agent_portal', 'sub_affiliate_type', 'referral_code_url', 'referral_code_title', 'referal_code', 'logo', 'dedicated_page', 'facebook_url', 'twitter_url', 'instagram_url', 'youtube_url', 'linkedin_url', 'google_plus_url', 'lead_data_in_cookie', 'lead_ownership_days_interval', 'debit_info_password', 'allow_credit_score', 'default_credit_score', 'allow_default_credit_score', 'status', 'restricted_start_time', 'restricted_end_time','reconmethod','cross_selling','life_support_content'];

    public function getreconAffiliates(){
        return $this->hasMany('App\Models\AffiliateRecon','user_id','user_id');
    }
}
