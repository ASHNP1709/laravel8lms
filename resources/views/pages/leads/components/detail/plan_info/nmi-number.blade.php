<div class="tab-pane fade show mb-5" role="tab-panel">
    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
            <div class="card-header">
                <div class="card-title">
                    <h2>NMI Numbers</h2>
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
                                            <div class="d-flex align-items-center">NMI Number:</div>
                                        </td>
                                        <td class="fw-bolder">{{ $saleDetail->vie_nmi_number ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Skip NMI Number:</div>
                                        </td>
                                        <td class="fw-bolder">{{ isset($saleDetail->vie_nmi_skip) &&$saleDetail->vie_nmi_skip==1 ? 'True':'False'}}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">DPI-MIRN Number:</div>
                                        </td>
                                        <td class="fw-bolder">
                                            {{ $saleDetail->vie_dpi_mirn_number ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Skip MIRN Number:</div>
                                        </td>
                                        <td class="fw-bolder">
                                            {{ isset($saleDetail->vie_mirn_skip) && $saleDetail->vie_mirn_skip == 1 ? 'True':'False' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Site Tariff Type:</div>
                                        </td>
                                        <td class="fw-bolder">
                                            {{ $saleDetail->vie_tariff_type ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Site Network Tariff List:</div>
                                        </td>
                                        <td class="fw-bolder">
                                            {{ $saleDetail->vie_tariff_list ?? 'N/A' }}
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
                                            <div class="d-flex align-items-center">Meter Number Electricity:</div>
                                        </td>
                                        <td class="fw-bolder">{{ $saleDetail->vie_meter_number_e ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Site Electricity Network Code:</div>
                                        </td>
                                        <td class="fw-bolder">{{ $saleDetail->vie_electricity_network_code ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Electricity Code:</div>
                                        </td>
                                        <td class="fw-bolder">{{ $saleDetail->vie_electricity_code ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Meter No. Gas:</div>
                                        </td>
                                        <td class="fw-bolder">{{ $saleDetail->vie_meter_number_g ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Site Gas Network Code:</div>
                                        </td>
                                        <td class="fw-bolder">{{ $saleDetail->vie_gas_network_code ?? 'N/A' }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted">
                                            <div class="d-flex align-items-center">Gas Code:</div>
                                        </td>
                                        <td class="fw-bolder">{{ $saleDetail->vie_gas_code ?? 'N/A' }}
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
