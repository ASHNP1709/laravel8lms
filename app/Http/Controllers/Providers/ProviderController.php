<?php

namespace App\Http\Controllers\Providers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Crypt;
use DB;
use Auth;
use Carbon\Carbon;
use App\Http\Requests\Providers\{
    AddPasswordProtectedProviderSaleSubmissionRequest,
    AddProviderSaleSubmissionRequest,
    AddSftpLogsRequest,
    AddSftpRequest,
    ProviderRequest,
    CheckboxRequest,
    UserRequest,
    AssignPostcodeRequest,
    SuburbRequest,
    ProviderMovin,
    CustomFieldRequest
};
//use App\Repositories\Provider\ProviderRepository;
use App\Models\{User, Providers, Services, Distributor, ProviderPostcode, UserStates, UserSuburb, UserPostcode, Postcode, States};
use App\Repositories\Common\CommonRepository;

class ProviderController extends Controller
{
    // public $provider;

    // public function __construct(ProviderRepository $provider)
    // {
    //     $this->provider = $provider;
    // }

    public function index(Request $request)
    { //dd($request->all(),$request->isMethod('post'));
        $info = 'providers';
        $condtion = [];
        $services = Providers::getServices();


        if ($request->isMethod('post')) {
            $request->merge(['email' => encryptGdprData($request->email), 'legal_name' => encryptGdprData($request->legal_name)]);
            $condtion['is_deleted'] = 0;
            if (isset($request->id)) {
                $condtion['user_id'] = $request->id;
            }

            if (isset($request->status)) {
                $condtion['status'] = $request->status;
            }

            if (isset($request->legal_name)) {
                $condtion['legal_name'] = $request->legal_name;
            }
            if (isset($request->service_id)) {
                $condtion['service_id'] = $request->service_id;
            }
            $provideruser = Providers::getFilters(
                $condtion,
                ['*'],
                [
                    'getProviderServices' => ['user_id', 'user_type', 'service_id'],
                ],
            );

            $getData = Providers::modifyProviderResponse($provideruser, $info);
            return response()->json(['providers' => $getData], 200);
        } else {
            $provideruser = Providers::getProviderList(
                ['is_deleted' => 0],
                ['*'],
                [
                    'user' => ['id', 'email', 'phone'],
                    'getProviderServices' => ['user_id', 'user_type', 'service_id'],
                    'getUserAddress' => ['user_id', 'address', 'address_type']
                ],
                true
            );
        }
        return view('pages.providers.list', compact('info', 'services', 'provideruser'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showAjax($providerId)
    {
        $provider = Providers::getFilters(
            ['user_id' => decryptGdprData($providerId)],
            ['*'],
            [
                'user' => ['id', 'email', 'phone'],
                'getUserAddress' => ['user_id', 'address'],
            ],
            false,
            false
        );
        $provider = $provider[0];
        return view('pages.providers.components.provider-details', compact('provider'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = 'create';
        $info = auth()->user()->info;
        $services = Providers::getServices();
        return view('pages.providers.edit.index', compact('info', 'services', 'action'));
    }

    /**
     * Save the data for creating a new provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(ProviderRequest $request)
    {
        try {
            $response = Providers::insertProvider($request);
            if ($response['status']) {
                return response()->json(['status' => $response['status'], 'message' => $response['message']]);
            } else {
                return response()->json(['status' => $response['status'], 'message' => $response['message']]);
            }
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    /**
     * Show the form for creating/updatig a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($provider_Id = null, $service_id = null)
    {
        $action = 'update';
        $info = auth()->user()->info;
        // $services = Services::where('status',1)->select('id','service_title')->get();
        $services = Providers::getServices();
        $states = Providers::getStates(); //    dd(decryptGdprData($service_id),decryptGdprData($provider_Id));
        $provider_details = Providers::getProviderDetails(
            ['user_id' => decryptGdprData($provider_Id), 'service_id' => decryptGdprData($service_id)],
            ['*'],
            [
                'user' => ['id', 'email', 'phone'],
                'getProviderServices' => ['id', 'user_id', 'service_id'],
                'getUserAddress' => ['user_id', 'address'],
                'getProviderContent.providerContentCheckbox' => ['*'],
                'getProviderSection.getSectionOption.getSectionSubOption' => ['*'],
                'getCustomField.customPlanSection' => ['*'],
                'getConnectionCustomField'  => ['*'],
                'getDirectDebitSettings.getContentCheckbox' => ['*'],
                'getPermissions' => ['*'],
                'getOutboundLinks' => ['*'],
                'getProviderContacts' => ['*'],
                'getDetokenizationSettings' => ['*'],
            ],
            false
        );
        $master_personal_details = config('app.personal_details');
        $master_connection_details = config('app.connection_details');
        $master_identification_details = config('app.identification_details');
        $master_employment_details = config('app.employment_details');
        $master_connection_address = config('app.connection_address');
        $master_billing_address = config('app.billing_address');
        $master_delivery_address = config('app.delivery_address');
        $t_and_c_types = config('app.terms_and_conditions_types');
        // dd($provider_details);
        return view('pages.providers.edit.index', compact('info', 'provider_Id', 'services', 'provider_details', 'states', 'master_personal_details', 'master_connection_details', 'master_identification_details', 'master_employment_details', 'master_connection_address', 'master_billing_address', 'master_delivery_address', 't_and_c_types'));
    }

    /**
     * Edit provider.
     *
     * @param   $request
     * @return \Illuminate\Http\Response
     */
    public function update(ProviderRequest $request)
    {
        try {
            return Providers::updateProviderDetail($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }



    /**
     * Show the form for creating/updating a provider move-in detail.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for creating/updating assign users to provider detail.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAssignUserToProvider($providerId)
    {

        $request = new Request([
            'id'   => $providerId,
            'providerservice' => 1,
            'type'  => 2,
            'providertype'  => 1
        ]);

        $users = Providers::getUserServiceById($request);
        $providerdetails = Providers::getProviderDetails(
            ['user_id' => decryptGdprData($providerId)],
            ['*'],
            ['user' => ['id', 'email', 'phone']],
            false
        );
        $assignedProviders = Providers::getAssignedProviders(1, '', '', decryptGdprData($providerId));
        $states = Providers::states(decryptGdprData($providerId));
        $assignedStates = Providers::providerassignedStates(decryptGdprData($providerId));
        $userStates = UserStates::where('user_id', decryptGdprData($providerId))->with('userSubrubs', 'state')->get();
        $assignedSubrubs = UserSuburb::where('user_id', decryptGdprData($providerId))->with('subrubs')->get();
        $assignedPostcodes = UserPostcode::where('user_id', decryptGdprData($providerId))->with('postcode')->get();
        $distributors = Providers::getMoveinDistributors($providerId);
        return view('pages.providers.assign-users', compact('providerdetails', 'users', 'providerId', 'assignedProviders', 'states', 'assignedStates', 'assignedSubrubs', 'assignedPostcodes', 'userStates', 'distributors'));
    }

    public function postProviderAffiliates(UserRequest $request)
    {
        try {
            return  Providers::assginProvidersWithService($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }
    // store or update provider contact data
    public function storeContact(ProviderRequest $request)
    {
        try {
            $result = Providers::storeOrUpdateContact($request);
            if ($result['status'] == true) {
                if(!empty($result['contactdata'])){
                    return response()->json(['contactdata' => $result['contactdata'], 'status' => $result['status'], 'message' => $result['message']]);
                }
                return response()->json(['contactdata' => '', 'status' => $result['status'], 'message' => $result['message']]);
            }
            return response()->json(['contactdata' => $result['contactdata'], 'status' => $result['status'], 'message' => $result['message']]);
        } catch (\Exception $err) {
            $result = [
                'exception_message' => $err->getMessage()
            ];
            $status = 400;

            return response()->json($result, $status);
        }
    }
    //delete provider contact
    public function deleteContact(Request $request, $id)
    {
        try {
            $response = Providers::deleteContact($request, $id);
            if ($response['status'] == true) {
                return response()->json(['data' => $response['data'], 'status' => $response['status'], 'message' => $response['message']]);
            }
            return response()->json(['data' => $response['data'], 'status' => $response['status'], 'message' => $response['message']]);
        } catch (\Exception $err) {
            $result = [
                'exception_message' => $err->getMessage()
            ];
            $status = 400;

            return response()->json($result, $status);
        }
    }
    //

    /**
     * get provider data on change of selectbox.
     *
     * @param   $request
     * @return \Illuminate\Http\Response
     */
    public function getSpecificTermData(Request $request)
    {
        try {
            return  Providers::getSpecificTermData($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    /**
     * Store or update checkbox of provider.
     *
     * @param   $request
     * @return \Illuminate\Http\Response
     */
    public function storeOrUpdateCheckbox(CheckboxRequest $request)
    {
        try {
            $res=  Providers::storeOrUpdateCheckbox($request);
            return $res;
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    /**
     * Remove checkbox of provider.
     *
     * @param   $request
     * @return \Illuminate\Http\Response
     */
    public function removeCheckbox(Request $request)
    {
        try {
            return  Providers::removeCheckbox($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    /**
     * Store or update IP settings of provider.
     *
     * @param   $request
     * @return \Illuminate\Http\Response
     */
    public function  postManageIps(Request $request)
    {
        try {
            return  Providers::postManageIps($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    /**
     * Get IP's settings of provider.
     *
     * @param   $request
     * @return \Illuminate\Http\Response
     */
    public function  getManageIps(Request $request)
    {
        try {
            return  Providers::getManageIps($request);
        } catch (\Exception $e) {
            return  $result = [
                'exception_message' => $e->getMessage()
            ];
        }
    }

    /**
     * Store detokenization token of provider.
     *
     * @param   $request
     * @return \Illuminate\Http\Response
     */
    public function  postManageToken(Request $request)
    {
        try {
            $response =  Providers::postManageToken($request);
            return $response;
            return response()->json(['status' => $response['status'], 'message' => $response['message'], 'token' => $response['token']], 200);
        } catch (\Exception $e) {
            return  $result = [
                'exception_message' => $e->getMessage()
            ];
        }
    }

    /*
     *
     *
     */
    public function  setDebitInfoIp(Request $request)
    {
        try {
            $response =  Providers::setDebitInfoIp($request);
            if ($response['status'] != '200') {
                return response()->json(['status' => 422, 'errors' => $response['errors']], 422);
            }
            return response()->json(['status' => $response['status'], 'message' => $response['message']], 200);
        } catch (\Exception $e) {
            return  $result = [
                'exception_message' => $e->getMessage()
            ];
        }
    }

    public function updateStatus(Request $request)
    {
        try {
            $response = Providers::updateStatus($request);
            if ($response['status'] != '200') {
                return response()->json(['status' => 422, 'errors' => $response], 422);
            }
            return response()->json(['status' => $response['status'], 'message' => $response['message']], 200);
        } catch (\Exception $e) {
            return response()->json(['status' => $response['status'], 'message' => $e->getMessage()], 400);
        }
    }

    public function deleteOutBoundLink(Request $request, $id)
    {
        try {
            return Providers::deleteOutboundLink($request, $id);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()], 400);
        }
    }
    public function getStateOrTeleData(Request $request)
    {
        try {
            return Providers::getStateOrTeleData($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    public function getDistributors(Request $request)
    {
        try {
            return  Distributor::getDistributorWithPostcodes($request->energyType, $request->providerId);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()], 400);
        }
    }

    public function updateSftpLog(AddSftpLogsRequest $request)
    {
        try {
            return Providers::updateSftpLog($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    public function assignPostcodes(AssignPostcodeRequest $request)
    {
        try {
            return Providers::assignPostcodes($request);
        } catch (\Exception $err) {
            return response()->json(['message' => 'Unable to assign postcodes.', 'exception' => $err->getMessage()], 500);
        }
    }

    public function getSuburbs(Request $request)
    {
        try {
            return Providers::getSuburbs($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    public function getPostcodeSuburbs(Request $request)
    {
        try {
            return Providers::getPostcodeSuburbs($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }



    public function assignSuburbs(SuburbRequest $request)
    {
        try {
            return Providers::assignSuburbs($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    public function changeSuburbStatus(Request $request)
    {
        try {
            return Providers::changeSuburbStatus($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }
    public function deleteSuburb(Request $request)
    {
        try {
            return Providers::deleteSuburb($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    public function changePostcodeStatus(Request $request)
    {
        try {
            return Providers::changePostcodeStatus($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }
    public function deletePostcode(Request $request)
    {
        try {
            return Providers::deletePostcode($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    public function postSaleSubmission(AddProviderSaleSubmissionRequest $request)
    {
        try {
            return Providers::postSaleSubmission($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    public function postPasswordProtectedSaleSubmission(AddPasswordProtectedProviderSaleSubmissionRequest $request)
    {
        try {
            return Providers::postPasswordProtectedSaleSubmission($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    public function addSftp(AddSftpRequest $request)
    {
        try {
            if (isset($request->sftp_id))
                return Providers::updateSftp($request);
            else
                return Providers::addSftp($request);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    public function getSftps($provider_id)
    {
        try {
            return Providers::getSftps($provider_id);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    public function deleteSftp($sftp_id)
    {
        try {
            return Providers::deleteSftp($sftp_id);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    public function changeSftpStatus($sftp_id)
    {
        try {
            return Providers::changeSftpStatus($sftp_id);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    public function changeProviderSftpStatus($user_id)
    {
        try {
            return Providers::changeProviderSftpStatus($user_id);
        } catch (\Exception $err) {
            return response()->json(['status' => 400, 'message' => $err->getMessage()]);
        }
    }

    public function getSaleSubmission($provider, $type)
    {
        try {
            return Providers::getSaleSubmission($provider, $type);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()], 400);
        }
    }



    public function providerMovinData(ProviderMovin $request)
    {
        try {
            return Providers::providerMovinData($request);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()], 400);
        }
    }

    public function getProviderMovinDetail(Request $request)
    {
        try {
            return Providers::getProviderMovinDetail($request);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()], 400);
        }
    }

    public function saveEicContentData(Request $request)
    {
        try {
            return Providers::saveEicContentData($request);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()], 400);
        }
    }
    public function getMovinDistributors(Request $request)
    {
        try {
            return Providers::getMoveinDistributors($request->provider_id, $request->energy_type);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()], 400);
        }
    }
    /**
     * Store or update custom fields.
     *
     * @param   $request
     * @return \Illuminate\Http\Response
     */
    public function saveEditCustomField(CustomFieldRequest $request)
    {
        try {
            return Providers::saveEditCustomField($request);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()], 400);
        }
    }
    /**
     * delete custom fields.
     *
     * @param   $request
     * @return \Illuminate\Http\Response
     */
    public function deleteCustomField(Request $request)
    {
        try {
            return Providers::deleteEditCustomField($request);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()], 400);
        }
    }
    /**
     * get plan according to provider.
     *
     * @param   $request
     * @return \Illuminate\Http\Response
     */
    public function getPlans(Request $request)
    {
        try {
            return Providers::getPlans($request);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()], 400);
        }
    }
    public function assignPlanToField(Request $request)
    {
        try {
            return Providers::assignPlanToField($request);
        } catch (\Exception $e) {
            return response()->json(['status' => 400, 'message' => $e->getMessage()], 400);
        }
    }
}
