<div class="tab-pane fade show mb-5" role="tab-panel">
        <!--begin::Order details-->
        <div class="d-flex flex-column flex-xl-row gap-7 mb-5 gap-lg-10">
            <div class="card col-md-4 card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>General Info</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-280px">
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Fuel Type</div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        {{ $saleDetail->journey_energy_type ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Property Type</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->journey_property_type ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Moving Property</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ isset($saleDetail->journey_moving_house) && $saleDetail->journey_moving_house ==1 ? 'Yes':'No' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Moving Date</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->journey_moving_date ?? 'N/A' }}
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->

            </div>
            <div class="card col-md-4 card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Life Support</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-280px">
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Life Support</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->journey_life_support ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Life Support Fuel</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->journey_life_support_energy_type ?? 'N/A' }}
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <div class="card col-md-4 card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Solar Panel</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-280px">
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Solar Panel</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->journey_solar_panel ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Solar Panel Option</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->journey_solar_option ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Solar Panel Usage</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_solar_panel_usage ?? 'N/A' }}
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>

        </div>
        <div class="d-flex flex-column flex-xl-row gap-7 py-5 gap-lg-10">
            <!--begin::Order details-->
            <div class="card col-md-4 card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Moving</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-280px">
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Moving Property</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ isset($saleDetail->sale_product_is_moving) && $saleDetail->sale_product_is_moving ==1 ? 'Yes':'No' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Electricity Moving Date</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->sale_product_moving_at ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Gas Moving Date</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->sale_product_moving_at ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Perferred Move-In Time</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->journey_prefered_move_in_time ?? 'N/A' }}
                                    </td>
                                </tr> 
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <div class="card col-md-4 card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Electricity Usage</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-280px">
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Electricity Peak Usage</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_peak_usage ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">Electricity Off Peak Usage
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_off_peak_usage ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Electricity Shoulder Usage
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_shoulder_usage ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Electricity Usage Level
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_usage_level ?? 'N/A' }}
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <div class="card col-md-4 card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Electricity Bill</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-280px">
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Electricity Bill Amount
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->journey_bill_available ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Electricity Bills Available
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_bill_amount ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Electricity Bill Period
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_bill_start_date ?? 'N/A' }}
                                        <span> To </span>{{ $saleDetail->ebd_bill_end_date ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Electricity Meter Type</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_meter_type ?? 'N/A' }}
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
        </div>
        <div class="d-flex flex-column flex-xl-row gap-7 py-5 gap-lg-10">
            <div class="card col-md-4 card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Control Load</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-280px">
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Control Load One Usage</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_control_load_one_usage ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Control Load Two Usage</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_control_load_two_usage ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Control Load One Off Peak
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_control_load_one_off_peak ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Control Load One Shoulder
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_control_load_one_shoulder ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Control Load Two Off Peak
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_control_load_two_off_peak ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Control Load Two Shoulder
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_control_load_two_shoulder ?? 'N/A' }}
                                    </td>
                                </tr>
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <div class="card col-md-4 card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Gas Bill</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-280px">
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Gas Bill Amount</div>
                                    </td>
                                    <td class="fw-bolder text-end">$150
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center"> Gas Bills Available</div>
                                    </td>
                                    <td class="fw-bolder text-end">Yes
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Gas Bill Period</div>
                                    </td>
                                    <td class="fw-bolder text-end">01/12/2021
                                        <span> To </span>03/01/2022
                                    </td>
                                </tr>

                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <div class="card col-md-4 card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Gas Usage</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-280px">
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Gas Peak Usage</div>
                                    </td>
                                    <td class="fw-bolder text-end">11
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Current Gas Provider</div>
                                    </td>
                                    <td class="fw-bolder text-end">Others
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Gas OffPeak Usage</div>
                                    </td>
                                    <td class="fw-bolder text-end">N/A
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Gas Usage Level</div>
                                    </td>
                                    <td class="fw-bolder text-end">Low
                                    </td>
                                </tr>

                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>


        </div>
        <div class="d-flex flex-column flex-xl-row gap-7 py-5 gap-lg-10">
            <div class="card col-md-4 card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Distributor</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-280px">
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Electricity Distributor
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">Ausgrid
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Gas Distributor</div>
                                    </td>
                                    <td class="fw-bolder text-end">Jemena
                                    </td>
                                </tr>

                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
            <div class="card col-md-4 card-flush py-4 flex-row-fluid">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Distributor</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-280px">
                            <tbody class="fw-bold text-gray-600">
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Is Any Access Issue on Site
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ isset($saleDetail->vie_is_any_access_issue) && $saleDetail->vie_is_any_access_issue ==1 ? 'Yes':'No'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Is Electrical Work is going
                                            on at
                                            site
                                        </div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ isset($saleDetail->vie_is_elec_work) && $saleDetail->vie_is_elec_work ==1 ? 'Yes':'No'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Credit Score</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_credit_score ?? 'N/A' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Concession on Gas</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ isset($saleDetail->vcd_energy_concession) && $saleDetail->vcd_energy_concession ==1 ? 'Yes':'No'}}
                                    </td>
                                </tr>

                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Card body-->
            </div>
        </div>
</div>
