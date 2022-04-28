<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Distributor\{Accessor,BasicCrudMethods,Mutators,Relationship};


class Distributor extends Model
{
    use HasFactory,Accessor,BasicCrudMethods,Mutators,Relationship;
    protected $fillable=['name','energy_type','status','is_deleted'];

}
