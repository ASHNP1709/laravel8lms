<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\SaleProduct\{CommonCrud,CommonRelation};

class SaleProductsMobile extends Model
{
    use HasFactory,CommonCrud,CommonRelation;
    protected $table = 'sale_products_mobile';
    
    public  function getAssignedQa(){
		return $this->hasMany('App\Models\SaleAssignedMobileQa','lead_id','lead_id');
	} 
}
