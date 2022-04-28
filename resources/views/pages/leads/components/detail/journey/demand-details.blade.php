<div class="tab-pane fade show mb-5" role="tab-panel">
        <!--begin::Order details-->
        <div class="d-flex flex-column flex-xl-row gap-7 mb-5 gap-lg-10">
            <div class="card col-md-4 card-flush py-4 flex-row-fluid overflow-hidden">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Demand Details Info</h2>
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
                                        <div class="d-flex align-items-center">Demand Usage Type</div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        {{ $saleDetail->ebd_demand_usage_type ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Tariff Code</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_tariff_code ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Meter Type</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_meter_type ?? 'N/A'}}
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
            <div class="card col-md-4 card-flush py-4 flex-row-fluid overflow-hidden">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Demand Rate 1</h2>
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
                                        <div class="d-flex align-items-center">Demand Rate 1 Peak</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate1_peak_usage ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Rate 1 OffPeak</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate1_off_peak_usage ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Rate 1 Shoulder</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate1_shoulder_usage ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Rate 1 Days</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate1_days ?? 'N/A'}}
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
            <div class="card col-md-4 card-flush py-4 flex-row-fluid overflow-hidden">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Demand Rate 2</h2>
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
                                        <div class="d-flex align-items-center">Demand Rate 2 Peak</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate2_peak_usage ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Rate 2 OffPeak</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate2_off_peak_usage ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Rate 2 Shoulder</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate2_shoulder ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Rate 2 Days</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate2_days ?? 'N/A'}}
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
            <div class="card col-md-6 card-flush py-4 flex-row-fluid overflow-hidden">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Demand Rate 3</h2>
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
                                        <div class="d-flex align-items-center">Demand Rate 3 Peak</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate3_peak_usage ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Rate 3 OffPeak</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate3_off_peak_usage ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Rate 3 Shoulder</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate3_shoulder ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Rate 3 Days</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate3_days ?? 'N/A'}}
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
            <div class="card col-md-6 card-flush py-4 flex-row-fluid overflow-hidden">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Demand Rate 4</h2>
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
                                        <div class="d-flex align-items-center">Demand Rate 4 Peak</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate4_peak_usage ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Rate 4 OffPeak</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate4_off_peak_usage ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Rate 4 Shoulder</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate4_shoulder ?? 'N/A'}}
                                    </td>
                                </tr>
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">Demand Rate 4 Days</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{ $saleDetail->ebd_demand_rate4_days ?? 'N/A'}}
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
