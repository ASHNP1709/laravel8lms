<div class="tab-pane fade show mb-5" id="stage" role="tab-panel">
    <!--begin::Order details-->
    <div class="d-flex flex-column flex-xl-row gap-7 mb-5 gap-lg-10">
        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
            <div class="card-header">
                <div class="card-title">
                    <h2>Stage</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="row">
                    <!-- left side -->
                    <div class="col-md-6">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5">
                                <tbody class="fw-bold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Source:</div>
                                        </td>
                                        <td class="fw-bolder text-end">
                                            API
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Completed By:</div>
                                        </td>
                                        <td class="fw-bolder text-end">Customer
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">SMS:</div>
                                        </td>
                                        <td class="fw-bolder text-end">Opt-Out
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Email:</div>
                                        </td>
                                        <td class="fw-bolder text-end">Opt-Out
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
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5">
                                <tbody class="fw-bold text-gray-600">
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Sale Id:</div>
                                        </td>
                                        <td class="fw-bolder text-end">
                                            {{ $saleDetail->sale_product_id ?? 'N/A' }}
                                        </td>
                                     </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Reference Number:</div>
                                        </td>
                                        <td class="fw-bolder text-end">{{ $saleDetail->sale_product_reference_no ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Sale Create Date:</div>
                                        </td>
                                        <td class="fw-bolder text-end">{{ $saleDetail->sale_product_sale_created_at ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Duplicate:</div>
                                        </td>
                                        <td class="fw-bolder text-end">{{ isset($saleDetail) && $saleDetail->l_is_duplicate == 1 ? 'Yes':'No' }}
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
            <!--end::Card body-->
        </div>
    </div>
    <div class="d-flex flex-column flex-xl-row gap-7 mb-5 gap-lg-10">
        <div class="card col-md-4 card-flush py-4 flex-row-fluid overflow-hidden">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>Electricity</h2>
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
                                    <div class="d-flex align-items-center">Electricity Lead Duplicate
                                    </div>
                                </td>
                                <td class="fw-bolder text-end">Yes
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Electricity sale Duplicate
                                    </div>
                                </td>
                                <td class="fw-bolder text-end">Yes
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Electricity Resale Allow
                                    </div>
                                </td>
                                <td class="fw-bolder text-end">Retention
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
                    <h2>Gas</h2>
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
                                    <div class="d-flex align-items-center">Gas Lead Duplicate</div>
                                </td>
                                <td class="fw-bolder text-end">Yes
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Gas Sale Duplicate</div>
                                </td>
                                <td class="fw-bolder text-end">Yes
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Gas Resale Allow</div>
                                </td>
                                <td class="fw-bolder text-end">Retention
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
        <div class="card card-flush py-4 flex-row-fluid overflow-hidden w-50">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>UTM</h2>
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
                                    <div class="d-flex align-items-center">UTM Source</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->m_utm_source ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">UTM Medium</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->m_utm_medium ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">UTM Compaign</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->m_utm_campaign ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">UTM Term</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->m_utm_term ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">UTM Content</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->m_utm_content ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">GClid</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->m_gclid ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">FBClid</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->m_fbclid ?? 'N/A' }}
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
