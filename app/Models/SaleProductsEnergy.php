<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\SaleProduct\{CommonCrud,CommonRelation};

class SaleProductsEnergy extends Model
{
    use HasFactory,CommonCrud,CommonRelation;

    protected $table ='sale_products_energy';

    public  function getAssignedQa(){
		return $this->hasMany('App\Models\SaleAssignedEnergyQa','lead_id','lead_id');
	}
}
