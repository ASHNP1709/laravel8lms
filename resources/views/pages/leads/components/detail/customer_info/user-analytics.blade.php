<div class="tab-pane fade show mb-5" role="tab-panel">
    <div class="d-flex flex-column flex-xl-row gap-7 mb-3 gap-lg-10">
        <!--begin::Order details-->
        <div class="card col-md-4 card-flush py-4 flex-row-fluid overflow-hidden">
            <!--begin::Card header-->
            <div class="card-header">
                <div class="card-title">
                    <h2>User Analytics</h2>
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
                                    <div class="d-flex align-items-center">Browser</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->si_browser ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Platform</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->si_platform ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Device Type</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->si_device ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Screen Resolution</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->si_screen_resolution ?? 'N/A' }}
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
                <div class="card-title d-inline">
                    <h2 class="mt-5">Site Access Information</h2>
                    <span class="fw-normal text-gray-600 fs-6">(Will Be Sent To Retailers)<span>
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
                                    <div class="d-flex align-items-center">Meter Hazards</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->vie_meter_hazard ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Site Access Electricity</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->vie_site_access_electricity ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">DOG CODE </div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vie_dog_code ?? 'N/A' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Site Access Gas </div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->vie_site_access_gas ?? 'N/A' }}
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
                    <h2>Joint Account Information</h2>
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
                                    <div class="d-flex align-items-center">Name</div>
                                </td>
                                <td class="fw-bolder text-end">{{ $saleDetail->vie_joint_acc_holder_title ?? ''}} {{ $saleDetail->vie_joint_acc_holder_first_name ?? ''}} {{ $saleDetail->vie_joint_acc_holder_last_name ?? '' }}
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Email</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    <a href="mailto:customercare@energyaustralia.com.au"
                                        class="btn btn-sm btn-light-success fw-bolder ms-3 fs-8"
                                        target="blank">{{ $saleDetail->vie_joint_acc_holder_email ?? 'N/A' }}</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">Phone</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    <a href="" onClick="(function(){
                                        window.open('tel:{{ $saleDetail->vie_joint_acc_holder_phone_no ?? 'N/A' }}');
                
                                    })();" class="text-gray-600 text-hover-primary mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3"
                                                    d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z"
                                                    fill="black" />
                                                <path
                                                    d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z"
                                                    fill="black" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        {{ $saleDetail->vie_joint_acc_holder_phone_no ?? 'N/A' }}
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-muted">
                                    <div class="d-flex align-items-center">D.O.B</div>
                                </td>
                                <td class="fw-bolder text-end">
                                    {{ $saleDetail->vie_joint_acc_holder_dob ?? 'N/A' }}
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

        <!--end::Documents-->
    </div>
</div>
