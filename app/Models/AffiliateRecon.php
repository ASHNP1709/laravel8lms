<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Repositories\Recon\{GeneralMethods};

class AffiliateRecon extends Model
{
     protected $table = 'affiliate_recon';
     use GeneralMethods;
}
