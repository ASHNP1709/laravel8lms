<div class="tab-pane fade show mb-5" role="tab-panel">
    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
            <div class="card-header">
                <div class="card-title">
                    <h2>Identification Details</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5">
                        <tbody class="fw-bold text-gray-600">
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Identification Type:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_identification_type ?? 'N/A' }}
                                </td>
                            </tr>
                            @if(isset($saleDetail->vi_identification_type))
                            @switch($saleDetail->vi_identification_type)
                            @case('Drivers Licence')
                            
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Licence State:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_licence_state_code ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Licence Number:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_licence_number ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Identification Expiry Date:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_licence_expiry_date ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">ID Matrix Reference Number:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    N/A
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">ID Matrix Status:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    Disabled
                                </td>
                            </tr>
                                @break
                            @case('Foreign Passport')
                            
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Passport Number:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_foreign_passport_number ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Country Name:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_foreign_country_name ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Country Code:</div>
                                </td> 
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_foreign_country_code ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Identification Expiry Date:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_foreign_passport_expiry_date ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">ID Matrix Reference Number:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    N/A
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">ID Matrix Status:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    Disabled
                                </td>
                            </tr>
                                @break
                            @case('Passport')
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Passport Number:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_passport_number ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Identification Expiry Date:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_passport_expiry_date ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">ID Matrix Reference Number:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    N/A
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">ID Matrix Status:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    Disabled
                                </td>
                            </tr>
                                @break
                            @case('Medicare Card')
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Medicare Card Number:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_medicare_number ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Reference Number:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_reference_number ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Middle Name On Card:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_card_middle_name ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Card Color:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_card_color ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Identification Expiry Date:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vi_medicare_card_expiry_date ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">ID Matrix Reference Number:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    N/A
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">ID Matrix Status:</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    Disabled
                                </td>
                            </tr>
                                @break
                        
                            @default
                                
                        @endswitch
                            @endif
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
