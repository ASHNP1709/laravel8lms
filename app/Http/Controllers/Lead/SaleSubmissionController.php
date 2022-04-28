<?php

namespace App\Http\Controllers\Lead;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Lead\SaleSubmissions\EA\EASaleSubmissionRepo;

class SaleSubmissionController extends Controller
{
    function postChangeLeadStatus(Request $request)
    {
        $energyObj = new EASaleSubmissionRepo;
        $response = $energyObj->submitEASale($request,'gas');
        return $response;
    }
}