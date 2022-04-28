<form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" data-kt-redirect="../../demo8/dist/apps/ecommerce/catalog/products.html">

    <!--begin::Main column-->
    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
        <div class="d-flex flex-column gap-7 gap-lg-10">
            <!-- Start section's -->
            <div class="card card-flush py-4">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Manage movein grace period and content </h2>
                    </div>
                </div>
                <!--end::Card header-->

                <!--start::Card body-->
                <div class="card-body px-8 pt-0 table-responsive">
                    <!--begin::Input group-->
                    <div class="row mb-5">
                        <!--begin::Label-->
                        <!-- <label class="col-lg-3 col-form-label required fw-bold fs-6">Energy type</label> -->
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="col-lg-3 fv-row">
                            <select data-control="select2" class="form-select form-control-solid" name="move_in_energy_type" id="move_in_energy_type">
                                <option value="1" class="">Electricity</option>
                                <option value="2" class="">Gas</option>

                            </select>
                        </div>
                        <!--end::Input-->

                        <!--begin::Label-->
                        <!-- <label class="col-lg-3 col-form-label required fw-bold fs-6">Distributor</label> -->
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div class="col-lg-3 fv-row" id="elec_distributor_div">
                            <select data-control="select2" class="form-select form-control-solid" name="move_in_elec_distributor" id="move_in_elec_distributor">
                                <option value="0">Other distributor(Default)</option>
                                @foreach($distributors['distributor'] as $row)
                                <option value="{{$row->id}}">{{$row->name}}</option>
                                @endforeach


                            </select>
                        </div>
                        <!--end::Input-->
                        <!--Hidden Input-->
                        <input type="hidden" name="sme_id" id="sme_id" value="{{isset($distributors['sme'][0]['id'])?$distributors['sme'][0]['id']:''}}">
                        <input type="hidden" name="residence_id" id="residence_id" value="{{isset($distributors['residence'][0]['id'])?$distributors['residence'][0]['id']:''}}">
                        <!--Hidden Input-->
                    </div>
                    <!--end::Input group-->
                    <table class="table border table-hover table-row-dashed align-middle fs-7 gy-2 gs-4 dt-bootstrap all-table-css-class mx-0 " id="provider_ackn_checkbox_table">
                        <thead>
                            <tr class="fw-bolder fs-6 text-gray-600 px-7">
                                <th>Distributor</th>
                                <th>Property Type</th>
                                <th>Energy Type</th>
                                <th>Days Interval</th>
                                <th>Cutt Off Time</th>
                                <th>Move-in Content</th>
                                <th>Move-in EIC Content</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            <tr>
                                <td>Other Distributor</td>
                                <td>SME</td>
                                <td>Electricity</td>
                                <td>
                                    <select class="form-control form-control-lg form-control-solid service_id" name="day_interval_bussiness" id="day_interval_bussiness">
                                        <option value="">Please select</option>
                                        <?php
                                        $i = 1
                                        ?>
                                        @if(isset($distributors['sme'][0]['grace_day']))
                                        @while ($i<30) <option value="{{$i}}" @if($i==$distributors['sme'][0]['grace_day']) selected @endif>{{$i}}</option>
                                            {{$i++}}
                                            @endwhile
                                            @else
                                            @while ($i<30) <option value="{{$i}}" @if($i==2) selected @endif>{{$i}}</option>
                                                {{$i++}}
                                                @endwhile
                                                @endif


                                    </select>
                                </td>
                                <td>
                                    <input class="form-control mt-4 form-control-solid" id="restrict_bussiness_time" name="restrict_bussiness_time" type="text" readonly value="{{isset($distributors['sme'][0]['restricted_start_time'])?$distributors['sme'][0]['restricted_start_time']:'17:00'}}">
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="moveincontent" data-type="move_in_content" data-prop="2"><i class="fa fa-comment"></i></a>
                                </td>
                                <!-- ------- movin EIC content -------- -->
                                <td>
                                    <a href="javascript:void(0)" class="moveincontent" data-type="move_in_eic_content" data-prop="2"><i class="fa fa-comment"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>Residential</td>
                                <td>Electricity</td>
                                <td>
                                    <select class="form-control form-control-lg form-control-solid service_id" name="day_interval_residence" id="day_interval_residence">
                                        <option value="">Please select</option>
                                        <?php
                                        $i = 1
                                        ?>
                                        @if(isset($distributors['residence'][0]['grace_day']))
                                        @while ($i<30) <option value="{{$i}}" @if($i==$distributors['residence'][0]['grace_day']) selected @endif>{{$i}}</option>
                                            {{$i++}}
                                            @endwhile
                                            @else
                                            @while ($i<30) <option value="{{$i}}" @if($i==2) selected @endif>{{$i}}</option>
                                                {{$i++}}
                                                @endwhile
                                                @endif
                                    </select>
                                </td>
                                <td>
                                    <input class="form-control mt-4 form-control-solid" id="restrict_residence_time" name="restrict_residence_time" type="text" readonly value="{{isset($distributors['residence'][0]['restricted_start_time'])?$distributors['residence'][0]['restricted_start_time']:'17:00'}}">
                                </td>
                                <!-- ------- movin content -------- -->
                                <td>
                                    <a href="javascript:void(0)" class="moveincontent" data-type="move_in_content" data-prop="1"><i class="fa fa-comment"></i></a>
                                </td>
                                <!-- ------- movin EIC content -------- -->
                                <td>
                                    <a href="javascript:void(0)" class="moveincontent" data-type="move_in_eic_content" data-prop="1"><i class="fa fa-comment"></i></a>
                                </td>
                            </tr>
                        </tbody>

                    </table>
                </div>
                <!--end::Card body-->
                <div class="card-footer text-end pt-0">
                    <!--begin::Button-->
                    <a href="list" id="" class="btn btn-light me-5">Cancel</a>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="button" id="grace_day" class="btn btn-primary">
                        <span class="indicator-label">Save Changes</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
            </div>
            <!-- End section's -->
            <!-- Start action -->

            <!-- End action -->
        </div>
    </div>
    <!--end::Main column-->
</form>
<!--end::Form-->
<!--begin::Modal - Adjust Balance-->
<!-- ------- Modal popup for movein content --------- -->
<!--begin::Modal - Adjust Balance-->
<div class="modal fade moveincontent_modal" id="moveincontent" tabindex="-1" role="dialog">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <div class="modal-body">
                <div class="row" style="margin-left:5px;margin-right:5px;">

                    <div class="col-md-8">
                        <div class="form-group">
                            <!--begin::Input-->
                            <div class="col-lg state_eic_content_checkbox_required">
                                <label class="form-check form-check-inline form-check-solid me-5">
                                    <input class="form-check-input" name="movin_status" type="radio" value="1" checked />
                                    <span class="fw-bold ps-2 fs-6">
                                        Enable
                                    </span>
                                </label>
                                <!--end::Option-->

                                <!--begin::Option-->
                                <label class="form-check form-check-inline form-check-solid">
                                    <input class="form-check-input" name="movin_status" type="radio" value="0" />
                                    <span class="fw-bold ps-2 fs-6">
                                        Disable
                                    </span>
                                </label>
                                <p><span class="error text-danger"></span></p>
                            </div>
                            <!--end::Input-->
                        </div>
                        <div class="form-group">
                            <div class="field-holder">
                                <textarea class="form-control ckeditor" placeholder="Move-in Content" id="move_in_content" name="move_in_content" cols="50" rows="10"></textarea>
                                <span class="form_error" id="move_in_content_error" style="color:red"></span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <div class="field-holder" id="attributes_movin">
                                <select id="move_in_attribute" class="form-control" style="height:300px;" multiple="multiple" name="movin_attributes">
                                    <option value="@Provider-Name@">@Provider-Name@</option>
                                    <option value="@Provider-Term-And-Conditions@">@Provider-Term-And-Conditions@</option>
                                    <option value="@Provider-Logo@">@Provider-Logo@</option>
                                    <option value="@Plan-Name@">@Plan-Name@</option>
                                    <option value="@Provider-Phone-Number@">@Provider-Phone-Number@</option>
                                    <option value="@Provider-Email@">@Provider-Email@</option>
                                    <option value="@Affiliate-Name@">@Affiliate-Name@</option>
                                    <option value="@Affiliate-Logo@">@Affiliate-Logo@</option>
                                    <option value="@Customer-Full-Name@">@Customer-Full-Name@</option>
                                    <option value="@Customer-Mobile-Number@">@Customer-Mobile-Number@</option>
                                    <option value="@Customer-Email@">@Customer-Email@</option>
                                    <option value="@Connection-Fee@">@Connection-Fee@</option>
                                    <option value="@Disconnection-Fee@">@Disconnection-Fee@</option>
                                    <option value="@distributor_name@">@distributor_name@</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" id="save_movin_content" class="submit-button btn btn-primary">Save</button>
                <button type="button" class="cancel-button btn" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">Cancel</span></button>
            </div>

        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>

<!-- END CONTENT -->