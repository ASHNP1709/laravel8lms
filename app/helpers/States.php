<?php
use Illuminate\Support\Facades\DB;

if (!function_exists('states')) {
    function states(){
        return DB::table('states')->selectRaw('state_id,state')->get();
    }
}


