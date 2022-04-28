<?php

namespace App\Http\Controllers;

use App\Http\Requests\Settings\DmoVdoPriceRequest;
use App\Models\DmoVdo;
use Illuminate\Support\Facades\Request;

class DmoVdoController extends Controller
{
    public function index()
    {
        try {
            return DmoVdo::index();
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function getDmoVdo(Request $request)
    {
        try {
            return DmoVdo::getDmoVdo($request);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function postDmoVdo(DmoVdoPriceRequest $request, $dmo_vdo_id=null)
    {
        try {
            return DmoVdo::postDmoVdo($request, $dmo_vdo_id);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }

    public function deleteDmoVdo($dmo_vdo_id)
    {
        try {
            return DmoVdo::deleteDmoVdo($dmo_vdo_id);
        } catch (\Exception $e) {
            return response()->json(['status' => 500, 'message' => $e->getMessage()]);
        }
    }
}
