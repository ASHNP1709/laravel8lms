<div class="d-flex flex-column gap-7 gap-lg-10">
    <form role="form" id="provider_permission_form" class="provider_permission_form" name="provider_permission_form">
        @csrf
        <!--begin::General options-->
        <div class="card card-flush py-4">
            <!--begin::Card body-->
            <div class="card-body px-8">
                @if($account_detail['service_id'] != 1 && $account_detail['service_id'] != 4)
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold fs-6">New Connection Allowed:</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="col-lg-6 connection_allow">
                            <label class="form-check form-check-inline form-check-solid me-5">
                                <!-- <input type="hidden" name="connection_allow" value="yes"> -->
                                <input id="connection_allow_yes" class="form-check-input radio-w-h-18" name="connection_allow" type="radio" {{isset($permission["is_new_connection"]) && $permission["is_new_connection"]  ? 'checked' : ''}} value="1" />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('Yes') }}
                                </span>
                            </label>
                            <!--end::Option-->

                            <!--begin::Option-->
                            <label class="form-check form-check-inline form-check-solid">
                                <!-- <input type="hidden" name="connection_allow" value="No"> -->
                                <input id="connection_allow_no" class="form-check-input radio-w-h-18" name="connection_allow" type="radio" {{isset($permission["is_new_connection"]) && $permission["is_new_connection"] ? '' : 'checked'}} value="0"  />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('No') }}
                                </span>
                            </label>
                            <p><span class="error text-danger"></span></p>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold fs-6">Port In Allowed:</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="col-lg-8 port_allow">
                            <label class="form-check form-check-inline form-check-solid me-5">
                                <!-- <input type="hidden" name="port_allow" value="yes"> -->
                                <input id="port_allow_yes" class="form-check-input radio-w-h-18" name="port_allow" type="radio" {{isset($permission["is_port"]) && $permission["is_port"]  ? 'checked' : ''}} value="1" />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('Yes') }}
                                </span>
                            </label>
                            <!--end::Option-->

                            <!--begin::Option-->
                            <label class="form-check form-check-inline form-check-solid">
                                <!-- <input type="hidden" name="port_allow" value="No"> -->
                                <input id="port_allow_no" class="form-check-input radio-w-h-18" name="port_allow" type="radio" {{isset($permission["is_port"]) && $permission["is_port"] ? '' : 'checked'}} value="0"  />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('No') }}
                                </span>
                            </label>
                            <p><span class="error text-danger"></span></p>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold fs-6">Retention Allowed:</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="col-lg-8 retention_allow">
                            <label class="form-check form-check-inline form-check-solid me-5">
                                <input id="retention_allow_yes" class="form-check-input radio-w-h-18" name="retention_allow" type="radio" {{isset($permission["is_retention"]) && $permission["is_retention"]  ? 'checked' : ''}} value="1" />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('Yes') }}
                                </span>
                            </label>
                            <!--end::Option-->

                            <!--begin::Option-->
                            <label class="form-check form-check-inline form-check-solid">
                                <input id="retention_allow_no" class="form-check-input radio-w-h-18" name="retention_allow" type="radio" {{isset($permission["is_retention"]) && $permission["is_retention"] ? '' : 'checked'}} value="0"  />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('No') }}
                                </span>
                            </label>
                            <p><span class="error text-danger"></span></p>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                @endif
                @if($account_detail['service_id'] == 1 || $account_detail['service_id'] == 4)
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-6 fw-bold fs-6">Submit Sale Through API:</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="col-lg-6 submit_sale_api">
                            <label class="form-check form-check-inline form-check-solid me-5">
                                <input id="submit_sale_api_yes" class="form-check-input radio-w-h-18" name="submit_sale_api" type="radio" {{isset($permission["is_submit_sale_api"]) && $permission["is_submit_sale_api"]  ? 'checked' : ''}} value="1" />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('Yes') }}
                                </span>
                            </label>
                            <!--end::Option-->

                            <!--begin::Option-->
                            <label class="form-check form-check-inline form-check-solid">
                                <input id="submit_sale_api_no" class="form-check-input radio-w-h-18" name="submit_sale_api" type="radio" {{isset($permission["is_submit_sale_api"]) && $permission["is_submit_sale_api"] ? '' : 'checked'}} value="0"  />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('No') }}
                                </span>
                            </label>
                            <p><span class="error text-danger"></span></p>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-6 fw-bold fs-6">Life Support Allowed?</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="col-lg-6 life_support_allow">
                            <label class="form-check form-check-inline form-check-solid me-5">
                                <!-- <input type="hidden" name="life_support_allow" value="yes"> -->
                                <input id="life_support_allow_yes" class="form-check-input radio-w-h-18 is_life_support_allow" name="life_support_allow" type="radio" {{isset($permission["is_life_support"]) && $permission["is_life_support"]  ? 'checked' : ''}} value="1" />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('Yes') }}
                                </span>
                            </label>
                            <!--end::Option-->

                            <!--begin::Option-->
                            <label class="form-check form-check-inline form-check-solid">
                                <!-- <input type="hidden" name="life_support_allow" value="No"> -->
                                <input id="life_support_allow_no" class="form-check-input radio-w-h-18 is_life_support_allow" name="life_support_allow" type="radio" {{isset($permission["is_life_support"]) && $permission["is_life_support"] ? '' : 'checked'}} value="0"  />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('No') }}
                                </span>
                            </label>
                            <p><span class="error text-danger"></span></p>
                            @php
                                $display = 'display:none;';
                                $elec_only = '';
                                $gas_only = '';
                                $both_only = '';

                                if(isset($permission["life_support_energy_type"]) && $permission["life_support_energy_type"]){
                                    $display = 'display:block;';
                                }
                                if(isset($permission["life_support_energy_type"]) && $permission["life_support_energy_type"] == 1){
                                    $elec_only = 'checked';
                                } elseif(isset($permission["life_support_energy_type"]) && $permission["life_support_energy_type"] == 2){
                                    $gas_only = 'checked';
                                } elseif(isset($permission["life_support_energy_type"]) && $permission["life_support_energy_type"] == 3){
                                    $both_only = 'checked';
                                }
                            @endphp

                            <!--begin::Input group-->
                            <div class="life_support_type life_support_type_div life_support_energy_type" style="{{$display}}">
                                <label class="form-check form-check-inline form-check-solid me-5">
                                    <input id="life_support_elec" class="form-check-input radio-w-h-18 life_support_energy_type" name="life_support_energy_type" type="radio" value="1" {{$elec_only}} />
                                    <span class="fw-bold ps-2 fs-6">
                                        {{ __('Electricity') }}
                                    </span>
                                </label>
                                <!--end::Option-->

                                <!--begin::Option-->
                                <label class="form-check form-check-inline form-check-solid">
                                    <input id="life_support_gas" class="form-check-input radio-w-h-18 life_support_energy_type" name="life_support_energy_type" type="radio"  value="2"  {{$gas_only}} />
                                    <span class="fw-bold ps-2 fs-6">
                                        {{ __('Gas') }}
                                    </span>
                                </label>
                                <!--begin::Option-->
                                <label class="form-check form-check-inline form-check-solid">
                                    <input id="life_support_both" class="form-check-input radio-w-h-18 life_support_energy_type" name="life_support_energy_type" type="radio" value="3" {{$both_only}} />
                                    <span class="fw-bold ps-2 fs-6">
                                        {{ __('Both') }}
                                    </span>
                                </label>
                                <p><span class="error text-danger"></span></p>
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Input-->                        
                    </div>
                    <!--end::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-6 fw-bold fs-6">Retention Allowed?</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="col-lg-6 e_retention_allow">
                            <label class="form-check form-check-inline form-check-solid me-5">
                                <input id="m_retention_allow_yes" class="form-check-input radio-w-h-18" name="e_retention_allow" type="radio" {{isset($permission["is_retention"]) && $permission["is_retention"]  ? 'checked' : ''}} value="1" />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('Yes') }}
                                </span>
                            </label>
                            <!--end::Option-->

                            <!--begin::Option-->
                            <label class="form-check form-check-inline form-check-solid">
                                <input id="m_retention_allow_no" class="form-check-input radio-w-h-18" name="e_retention_allow" type="radio" {{isset($permission["is_retention"]) && $permission["is_retention"] ? '' : 'checked'}} value="0"  />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('No') }}
                                </span>
                            </label>
                            <p><span class="error text-danger"></span></p>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-6 fw-bold fs-6">GAS only sale allow?</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="col-lg-6 gas_sale_allow">
                            <label class="form-check form-check-inline form-check-solid me-5">
                                <!-- <input type="hidden" name="gas_sale_allow" value="yes"> -->
                                <input id="gas_sale_allow_yes" class="form-check-input radio-w-h-18" name="gas_sale_allow" type="radio" {{isset($permission["is_gas_only"]) && $permission["is_gas_only"]  ? 'checked' : ''}} value="1" />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('Yes') }}
                                </span>
                            </label>
                            <!--end::Option-->

                            <!--begin::Option-->
                            <label class="form-check form-check-inline form-check-solid">
                                <!-- <input type="hidden" name="gas_sale_allow" value="No"> -->
                                <input id="gas_sale_allow_no" class="form-check-input radio-w-h-18" name="gas_sale_allow" type="radio" {{isset($permission["is_gas_only"]) && $permission["is_gas_only"] ? '' : 'checked'}} value="0"  />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('No') }}
                                </span>
                            </label>
                            <p><span class="error text-danger"></span></p>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-6 fw-bold fs-6">Do you want to enable demand calculation?</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="col-lg-6">
                            <label class="form-check form-check-inline form-check-solid me-5">
                                <!-- <input type="hidden" name="manage_demand_status" value="1"> -->
                                <input class="form-check-input radio-w-h-18" name="manage_demand_status" type="radio" {{isset($permission["is_demand_usage"]) && $permission["is_demand_usage"]  ? 'checked' : ''}} value="1"/>
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('Yes') }}
                                </span>
                            </label>
                            <!--end::Option-->

                            <!--begin::Option-->
                            <label class="form-check form-check-inline form-check-solid">
                                <!-- <input type="hidden" name="manage_demand_status" value="0"> -->
                                <input class="form-check-input radio-w-h-18" name="manage_demand_status" type="radio" {{isset($permission["is_demand_usage"]) && $permission["is_demand_usage"] ? '' : 'checked'}} value="0"  />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('No') }}
                                </span>
                            </label>
                            <p><span class="error text-danger"></span></p>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--begin::Input group-->
                    <div class="row mb-3">
                        <!--begin::Label-->
                        <label class="col-lg-6 fw-bold fs-6">Allow credit score check for EnergyAustralia:</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="col-lg-6 ea_credit_score_check_allow">
                            <label class="form-check form-check-inline form-check-solid me-5">
                                <!-- <input type="hidden" name="ea_credit_score_check_allow" value="yes"> -->
                                <input id="ea_credit_score_check_allow_yes" class="form-check-input radio-w-h-18 is_credit_allow" name="ea_credit_score_check_allow" type="radio" {{isset($permission["ea_credit_score_allow"]) && $permission["ea_credit_score_allow"]  ? 'checked' : ''}} value="1" />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('Yes') }}
                                </span>
                            </label>
                            <!--end::Option-->

                            <!--begin::Option-->
                            <label class="form-check form-check-inline form-check-solid">
                                <!-- <input type="hidden" name="ea_credit_score_check_allow" value="No"> -->
                                <input id="ea_credit_score_check_allow_no" class="form-check-input radio-w-h-18 is_credit_allow" name="ea_credit_score_check_allow" type="radio" {{isset($permission["ea_credit_score_allow"]) && $permission["ea_credit_score_allow"] ? '' : 'checked'}} value="0"  />
                                <span class="fw-bold ps-2 fs-6">
                                    {{ __('No') }}
                                </span>
                            </label>
                            <p><span class="error text-danger"></span></p>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    @php
                        $dispplay_cs = 'display:none;';
                        if(isset($permission["ea_credit_score_allow"]) && $permission["ea_credit_score_allow"]){
                            $dispplay_cs = 'display:block;';
                        }
                    @endphp
                    <!--begin::Input group-->
                    <div class="row mb-3 credit_score_div" style="{{$dispplay_cs}}">
                        <!--begin::Label-->
                        <label class="col-lg-6 required fw-bold fs-6">Credit score value:</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="col-lg-6 credit_score">
                            <input type="text" class="form-control form-control-solid" placeholder="Enter credit score value:" name="credit_score" tabindex="3" value="{{$permission["credit_score"]??''}}">
                            <span class="error text-danger"></span>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                @endif
            </div>
            <!--begin::Actions-->
            <div class="card-footer px-8 pt-0">
                <div class="pull-right">
                    <!--begin::Button-->
                    <a type="reset" href="{{ theme()->getPageUrl('provider/list') }}" class="btn btn-light me-3">{{ __('Cancel') }}</a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="provider_permission_submit" class="btn btn-primary">
                        <span class="indicator-label">{{ __('Save Changes') }}</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
            </div>
            <!--end::Actions-->
        </div>  
    </form>    
</div>
