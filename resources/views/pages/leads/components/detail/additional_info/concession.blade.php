<div class="tab-pane fade show py-5" role="tab-panel">
    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
            <div class="card-header">
                <div class="card-title">
                    <h2>Concession</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5">
                        <tbody class="fw-bold text-gray-600">
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Concession Type:</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->vcd_concession_type ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Concession Code:</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->vcd_concession_code ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Card Number:</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->vcd_card_number ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Card Issue Date:</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->vcd_card_start_date ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">
                                        Card Expiry Date:</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->vcd_card_end_date ?? 'N/A' }}
                                </td>
                            </tr>


                        </tbody>
                        <!--end::Table body-->
                    </table>
                    </table>
                    <!--end::Table-->
                </div>
            </div>
            <!--end::Card body-->
        </div>

        <!--end::Documents-->
    </div>
</div>
