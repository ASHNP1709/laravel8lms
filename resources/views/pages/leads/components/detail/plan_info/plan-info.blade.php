<div class="tab-pane fade show py-5" role="tab-panel">
    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
            <div class="card-header">
                <div class="card-title">
                    <h2>Plan Information</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <!-- left side -->
                    <div class="col-md-6">
                        <div class="col-md-3">
                            <span
                                class="text-dark fw-bolder fs-6">{{ __('sale_detail.electricity') }}:</span>
                        </div>
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5">
                                <tbody class="fw-bold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Provider Name:</div>
                                        </td>
                                        <td class="fw-bolder">{{ isset($saleDetail->p_name) && decryptGdprData($saleDetail->p_name) ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Plan Name:</div>
                                        </td>
                                        <td class="fw-bolder">{{ $saleDetail->plan_name ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Plan Desc:</div>
                                        </td>
                                        <td class="fw-bolder">

                                            {{ $saleDetail->plan_plan_desc ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Plan Compaign Code:</div>
                                        </td>
                                        <td class="fw-bolder">
                                            {{ $saleDetail->plan_compaign_code ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Distributor:</div>
                                        </td>
                                        <td class="fw-bolder">
                                            Ausgrid
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Plan Bundle Code:</div>
                                        </td>
                                        <td class="fw-bolder">
                                            {{ $saleDetail->plan_bundle_code ?? 'N/A' }}
                                        </td>
                                    </tr>
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>

                    <!-- right side -->
                    <div class="col-md-6">
                        <div class="col-md-3">
                            <span
                                class="text-dark fw-bolder fs-6">{{ __('sale_detail.gas') }}:</span>
                        </div>
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5">
                                <tbody class="fw-bold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Provider Name:</div>
                                        </td>
                                        <td class="fw-bolder">{{ isset($saleDetail->p_name) && decryptGdprData($saleDetail->p_name) ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Plan Name:</div>
                                        </td>
                                        <td class="fw-bolder">{{ $saleDetail->plan_name ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Plan Desc:</div>
                                        </td>
                                        <td class="fw-bolder">

                                            {{ $saleDetail->plan_plan_desc ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Plan Compaign Code:</div>
                                        </td>
                                        <td class="fw-bolder">
                                            {{ $saleDetail->plan_compaign_code ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Distributor:</div>
                                        </td>
                                        <td class="fw-bolder">
                                            Ausgrid
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Plan Bundle Code:</div>
                                        </td>
                                        <td class="fw-bolder">
                                            {{ $saleDetail->plan_bundle_code ?? 'N/A' }}
                                        </td>
                                    </tr>

                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>