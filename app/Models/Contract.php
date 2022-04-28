<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Contract extends Model
{
    protected $table = 'contract';
    
    protected $fillable = ['contract_unique_id','contract_name','validity','description','status','created_at','updated_at','deleted_at'] ;
 
}
