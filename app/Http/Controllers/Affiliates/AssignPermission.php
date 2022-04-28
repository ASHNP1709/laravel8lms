<?php
namespace App\Http\Controllers\Affiliates;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Services\PermissionsService; 
use DB; 
use Illuminate\Support\Facades\Redis; 
use App\Http\Requests\Affiliates\AffiliatePermissions;
class AssignPermission extends Controller
{
    /**
     * get list of all permissions and assigned permissions.
     *
     * @param  object  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getServicePermissions(Request $request)
    {
        try {
            $userId = decryptGdprData($request->user_id);    
            $assignPermissions = \DB::table('model_has_permissions')
                ->join('permissions', 'permissions.id', 'model_has_permissions.permission_id')
                ->where('model_has_permissions.model_id', $userId)  
                ->where('model_has_permissions.service_id',$request->service_id)
                ->pluck('permissions.name')  
                ->toArray(); 

            $permissionList = new PermissionsService;
            $allPermission = $permissionList->getPermissionsList()['permissions_section'];

            return response()->json(['permissions' => $allPermission , 'assignPermissions' => $assignPermissions],200);
        }
        catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    /**
     * save the bradband plan form.
     *
     * @param  object  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function SavePermissions(AffiliatePermissions $request)
    {
        try {
            $user_id = decryptGdprData($request->id); 
            
            $selectPerm = isset($request->permissions)?$request->permissions:[];
           
            $selectedPermissions = DB::table('permissions')->select('id')->whereIn('name', $selectPerm)->pluck('id')->toArray();
            
            $assignPermissions =  DB::table('model_has_permissions')->where('model_id', $user_id)->where('service_id',$request->service_id)->pluck('permission_id')->toArray();    
            
            $deletePermissions=array_diff($assignPermissions,$selectedPermissions);
            $insertPermissions = array_diff($selectedPermissions,$assignPermissions);

            DB::table('model_has_permissions')->where('model_id', $user_id)->whereIn('permission_id',$deletePermissions)->delete();
            
            $savepermission = [];
            foreach ($insertPermissions as $permission) {
                $Permission['permission_id'] = $permission;
                $Permission['model_id'] = $user_id;  
                $Permission['model_type'] = 'App\Models\User';  
                $Permission['service_id'] = $request->service_id; 
                $savepermission[] = $Permission;
            }
            DB::table('model_has_permissions')->insert($savepermission); 
            $userPermissions = getPermissions($user_id);
            Redis::set('user_permission:' . $user_id, json_encode($userPermissions)); 

            return response()->json(['status' => true ,'message' => 'Permissions updated successfully.'],200);
        }
        catch (\Exception $err) 
        {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }
}