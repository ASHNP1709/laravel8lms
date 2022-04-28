<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Repositories\Plans\Mobile\{ BasicCrudMethods, Relationship, Accessor, Mutators };

class PlanMobile extends Model
{
    use HasFactory, BasicCrudMethods, Relationship, Accessor, Mutators, SoftDeletes;
    protected $table ='plans_mobile';
    // protected $fillable = [];
    protected $guarded = ['id']; 

}
