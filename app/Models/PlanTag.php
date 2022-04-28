<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanTag extends Model
{
    use HasFactory;
    protected $table ='plan_tags';
    protected $fillable = ['plan_id','tag_id','is_deleted'];
}
