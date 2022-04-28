<div class="tab-pane fade" id="inclusions" role="tab-panel">
    <div class="card mb-5 mb-xl-10">
        <!-- National Inclusion -->
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" data-bs-toggled="collapse" data-bs-targetd="#national_inclusion_section">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __ ('mobile.formPage.nationalInclusion.sectionTitle')}}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div id="national_inclusion_section" class="collapse show">
            <!--begin::Form-->
            <form id="plan_national_inclusion_form" class="form">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.nationalInclusion.national_voice_calls.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="national_voice_calls" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.nationalInclusion.national_voice_calls.placeHolder')}}" value="{{isset($plan)?$plan->national_voice_calls:''}}" />
                            <span class="text-danger errors" id="national_voice_calls_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.nationalInclusion.national_video_calls.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="national_video_calls" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.nationalInclusion.national_video_calls.placeHolder')}}" value="{{isset($plan)?$plan->national_video_calls:''}}" />
                            <span class="text-danger errors" id="national_video_calls_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.nationalInclusion.national_text.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="national_text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.nationalInclusion.national_text.placeHolder')}}" value="{{isset($plan)?$plan->national_text:''}}" />
                            <span class="text-danger errors" id="national_text_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.nationalInclusion.national_mms.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="national_mms" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.nationalInclusion.national_mms.placeHolder')}}" value="{{isset($plan)?$plan->national_mms:''}}" />
                            <span class="text-danger errors" id="national_mms_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.nationalInclusion.national_directory_assist.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="national_directory_assist" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.nationalInclusion.national_directory_assist.placeHolder')}} Assistance" value="{{isset($plan)?$plan->national_directory_assist:''}}" />
                            <span class="text-danger errors" id="national_directory_assist_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.nationalInclusion.national_diversion.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="national_diversion" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.nationalInclusion.national_diversion.placeHolder')}}" value="{{isset($plan)?$plan->national_diversion:''}}" />
                            <span class="text-danger errors" id="national_diversion_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.nationalInclusion.national_call_forwarding.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="national_call_forwarding" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.nationalInclusion.national_call_forwarding.placeHolder')}}" value="{{isset($plan)?$plan->national_call_forwarding:''}}" />
                            <span class="text-danger errors" id="national_call_forwarding_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.nationalInclusion.national_voicemail_deposits.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="national_voicemail_deposits" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.nationalInclusion.national_voicemail_deposits.placeHolder')}}" value="{{isset($plan)?$plan->national_voicemail_deposits:''}}" />
                            <span class="text-danger errors" id="national_voicemail_deposits_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.nationalInclusion.national_toll_free_numbers.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <select class="form-select fsorm-select-transsparent" name="national_toll_free_numbers[]" aria-label="Select example" id="national_toll_free_numbers" data-control="select2" data-hide-search="true" data-placeholder="{{ __ ('mobile.formPage.nationalInclusion.national_toll_free_numbers.placeHolder')}}" multiple>
                                @foreach($tollFreeNumbers as $key => $number)
                                <option value="{{$key}}" {{isset($plan) && in_array($key,explode(',',$plan->national_toll_free_numbers))  ? 'selected' :''}}>{{$number}}</option>
                                @endforeach
                            </select>
                            <span class="text-danger errors" id="national_toll_free_numbers_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.nationalInclusion.national_internet_data.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <textarea name="national_internet_data" id="national_internet_data" class="form-control form-control-lg form-control-solid custom_ck_editor" placeholder="{{ __ ('mobile.formPage.nationalInclusion.national_internet_data.placeHolder')}}" >{{isset($plan)?$plan->national_internet_data:''}}</textarea>
                            <span class="text-danger errors" id="national_internet_data_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.nationalInclusion.national_special_features.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <textarea name="national_special_features" id="national_special_features" class="form-control form-control-lg form-control-solid custom_ck_editor" placeholder="{{ __ ('mobile.formPage.nationalInclusion.national_special_features.placeHolder')}}" >{{isset($plan)?$plan->national_special_features:''}}</textarea>
                            <span class="text-danger errors" id="national_special_features_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.nationalInclusion.national_additonal_info.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <textarea name="national_additonal_info" id="national_additonal_info" class="form-control form-control-lg form-control-solid custom_ck_editor" placeholder="{{ __ ('mobile.formPage.nationalInclusion.national_additonal_info.placeHolder')}}" >{{isset($plan)?$plan->national_additonal_info:''}}</textarea>
                            <span class="text-danger errors" id="national_additonal_info_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>


                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="button" class="btn btn-primary submit_btn" id="plan_national_inclusion_form_submit_btn" data-form="plan_national_inclusion_form">{{ __ ('mobile.formPage.nationalInclusion.submitButton')}}</button>
                    <a href="{{url('/provider/plans/mobile/'.$providerId)}}" class="btn btn-light btn-active-light-primary me-2">{{ __ ('mobile.formPage.nationalInclusion.cancelButton')}}</a>
                </div>
            </form>
            <!--end::Input group-->
        </div>
        <!--end::Card body-->
        <!-- End National Inclusion -->
    </div>

    <div class="card mb-5 mb-xl-10">
        <!-- International Inclusion -->
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" data-bs-toggled="collapse" data-bs-targetd="#international_inclusion_section">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __ ('mobile.formPage.internationalInclusion.sectionTitle')}}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Content-->
        <div id="international_inclusion_section" class="collapse show">
            <!--begin::Form-->
            <form id="plan_international_inclusion_form" class="form">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">


                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.internationalInclusion.international_voice_calls.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="international_voice_calls" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.internationalInclusion.international_voice_calls.placeHolder')}}" value="{{isset($plan)?$plan->international_voice_calls:''}}" />
                            <span class="text-danger errors" id="international_voice_calls_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.internationalInclusion.international_video_calls.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="international_video_calls" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.internationalInclusion.international_video_calls.placeHolder')}}" value="{{isset($plan)?$plan->international_video_calls:''}}" />
                            <span class="text-danger errors" id="international_video_calls_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.internationalInclusion.international_text.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="international_text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.internationalInclusion.international_text.placeHolder')}}" value="{{isset($plan)?$plan->international_text:''}}" />
                            <span class="text-danger errors" id="international_text_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.internationalInclusion.international_mms.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="international_mms" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.internationalInclusion.international_mms.placeHolder')}}" value="{{isset($plan)?$plan->international_mms:''}}" />
                            <span class="text-danger errors" id="international_mms_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.internationalInclusion.international_diversion.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="international_diversion" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.internationalInclusion.international_diversion.placeHolder')}}" value="{{isset($plan)?$plan->international_diversion:''}}" />
                            <span class="text-danger errors" id="international_diversion_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.internationalInclusion.international_additonal_info.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <textarea name="international_additonal_info" id="international_additonal_info" class="form-control form-control-lg form-control-solid custom_ck_editor" placeholder="{{ __ ('mobile.formPage.internationalInclusion.international_additonal_info.placeHolder')}}">{{isset($plan)?$plan->international_additonal_info:''}}</textarea>
                            <span class="text-danger errors" id="international_additonal_info_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>


                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="button" class="btn btn-primary submit_btn" id="plan_international_inclusion_form_submit_btn" data-form="plan_international_inclusion_form">{{ __ ('mobile.formPage.internationalInclusion.submitButton')}}</button>
                    <a href="{{url('/provider/plans/mobile/'.$providerId)}}" class="btn btn-light btn-active-light-primary me-2">{{ __ ('mobile.formPage.internationalInclusion.cancelButton')}}</a>
                </div>
            </form>
            <!--end::Form - international_inclusion_section-->
        </div>
        <!--end::Card body-->
    </div>
    <!-- End International Inclusion -->

    <!-- Roaming Inclusion -->
    <div class="card mb-5 mb-xl-10">
        <!--begin::Card header-->
        <div class="card-header border-0 cursor-pointer" data-bs-toggled="collapse" data-bs-targetd="#roaming_inclusion_section">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __ ('mobile.formPage.roamingInclusion.sectionTitle')}}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--end::Card header-->
        <!--begin::Content-->
        <div id="roaming_inclusion_section" class="collapse show">
            <!--begin::Form-->
            <form id="plan_roaming_inclusion_form" class="form">
                <!--begin::Card body-->
                <div class="card-body border-top p-9">
                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.roamingInclusion.roaming_charge.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="roaming_charge" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.roamingInclusion.roaming_charge.placeHolder')}}" value="{{isset($plan)?$plan->roaming_charge:''}}" />
                            <span class="text-danger errors" id="roaming_charge_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.roamingInclusion.roaming_voice_incoming.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="roaming_voice_incoming" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.roamingInclusion.roaming_voice_incoming.placeHolder')}}" value="{{isset($plan)?$plan->roaming_voice_incoming:''}}" />
                            <span class="text-danger errors" id="roaming_voice_incoming_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.roamingInclusion.roaming_voice_outgoing.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="roaming_voice_outgoing" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.roamingInclusion.roaming_voice_outgoing.placeHolder')}}" value="{{isset($plan)?$plan->roaming_voice_outgoing:''}}" />
                            <span class="text-danger errors" id="roaming_voice_outgoing_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>


                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.roamingInclusion.roaming_video_calls.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="roaming_video_calls" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.roamingInclusion.roaming_video_calls.placeHolder')}}" value="{{isset($plan)?$plan->roaming_video_calls:''}}" />
                            <span class="text-danger errors" id="roaming_video_calls_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.roamingInclusion.roaming_text.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="roaming_text" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.roamingInclusion.roaming_text.placeHolder')}}" value="{{isset($plan)?$plan->roaming_text:''}}" />
                            <span class="text-danger errors" id="roaming_text_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.roamingInclusion.roaming_mms.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="roaming_mms" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.roamingInclusion.roaming_mms.placeHolder')}}" value="{{isset($plan)?$plan->roaming_mms:''}}" />
                            <span class="text-danger errors" id="roaming_mms_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.roamingInclusion.roaming_voicemail_deposits.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <input type="text" autocomplete="off" name="roaming_voicemail_deposits" class="form-control form-control-lg form-control-solid mb-3 mb-lg-0" placeholder="{{ __ ('mobile.formPage.roamingInclusion.roaming_voicemail_deposits.placeHolder')}}" value="{{isset($plan)?$plan->roaming_voicemail_deposits:''}}" />
                            <span class="text-danger errors" id="roaming_voicemail_deposits_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.roamingInclusion.roaming_internet_data.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <textarea name="roaming_internet_data" id="roaming_internet_data" class="form-control form-control-lg form-control-solid custom_ck_editor" placeholder="{{ __ ('mobile.formPage.roamingInclusion.roaming_internet_data.placeHolder')}}">{{isset($plan)?$plan->roaming_internet_data:''}}</textarea>
                            <span class="text-danger errors" id="roaming_internet_data_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>

                    <div class="row mb-6">
                        <!--begin::Label-->
                        <label class="col-lg-4 col-form-label  fw-bold fs-6">{{ __ ('mobile.formPage.roamingInclusion.roaming_additonal_info.label')}}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <textarea name="roaming_additonal_info" id="roaming_additonal_info" class="form-control form-control-lg form-control-solid custom_ck_editor" placeholder="{{ __ ('mobile.formPage.roamingInclusion.roaming_additonal_info.placeHolder')}}">{{isset($plan)?$plan->roaming_additonal_info:''}}</textarea>
                            <span class="text-danger errors" id="roaming_additonal_info_error"></span>
                        </div>
                        <!--end::Col-->
                    </div>


                </div>
                <div class="card-footer d-flex justify-content-end py-6 px-9">
                    <button type="button" class="btn btn-primary submit_btn" id="plan_roaming_inclusion_form_submit_btn" data-form="plan_roaming_inclusion_form">{{ __ ('mobile.formPage.roamingInclusion.submitButton')}}</button>
                    <a href="{{url('/provider/plans/mobile/'.$providerId)}}" class="btn btn-light btn-active-light-primary me-2">{{ __ ('mobile.formPage.roamingInclusion.cancelButton')}}</a>
                </div>
            </form>
            <!--end::Form - plan_roaming_inclusion_form-->
        </div>
        <!--end::Card body-->
    </div>
    <!-- End Roaming Inclusion -->


</div>
<!--end::Content-->