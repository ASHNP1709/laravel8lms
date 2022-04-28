<div class="tab-pane fade show py-5" role="tab-panel">
    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
        <div class="card card-flush py-4 flex-row-fluid overflow-hidden w-50">
            <div class="card-header">
                <div class="card-title">
                    <h2>Connection Address</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table table-row-bordered align-middle gy-5 mb-0 fs-6">
                    <tbody class="fw-bold text-gray-600">
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Address:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_address ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Suburb:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_suburb ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Property Name:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_property_name ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">State:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_state ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Post Code:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_postcode ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Lot Number:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_lot_number ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Unit Number:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_unit_no ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Unit Type:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_unit_type?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Unit Type Code: </div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_unit_type_code ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Floor Number:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_floor_no ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Floor Level Type:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_floor_level_type ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Floor Type Code:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_floor_type_code ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Street Name:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_street_name ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Street Number: </div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_street_number ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Street Suffix: </div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_street_suffix ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Street Code: </div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_street_code ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">House Number: </div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_house_num ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">House Number Suffix: </div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_house_number_suffix ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Site Location Descriptor:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_site_descriptor ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Property Ownership:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_property_ownership ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">DPID:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_po_box_dpid ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Ignore address validation ( Only for AGL ):
                                </div>
                            </td>
                            <td class="fw-bolder text-end">N/A
                            </td>
                        </tr>
                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
        </div>
        <div class="card card-flush py-4 flex-row-fluid overflow-hidden w-50">
            <div class="card-header">
                <div class="card-title">
                    <h2>Billing Address</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <table class="table table-row-bordered align-middle gy-5 mb-0 fs-6">
                    <tbody class="fw-bold text-gray-600">
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Address:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_address ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Suburb:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_suburb ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Property Name:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_property_name ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">State:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_state ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Post Code:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_postcode ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Lot Number:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_lot_number ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Unit Number:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_unit_no ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Unit Type:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_unit_type?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Unit Type Code: </div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_unit_type_code ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Floor Number:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_floor_no ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Floor Level Type:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_floor_level_type ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Floor Type Code:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_floor_type_code ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Street Name:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_street_name ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Street Number: </div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_street_number ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Street Suffix: </div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_street_suffix ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Street Code: </div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_street_code ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">House Number: </div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_house_num ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">House Number Suffix: </div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_house_number_suffix ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Site Location Descriptor:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_site_descriptor ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Property Ownership:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_property_ownership ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">DPID:</div>
                            </td>
                            <td class="fw-bolder text-end">{{$saleDetail->va_po_box_dpid ?? 'N/A'}}
                            </td>
                        </tr>
                        <tr>
                            <td class="text-muted">
                                <div class="d-flex align-items-center">Ignore address validation ( Only for AGL ):
                                </div>
                            </td>
                            <td class="fw-bolder text-end">N/A
                            </td>
                        </tr>
                    </tbody>
                    <!--end::Table body-->
                </table>
            </div>
        </div>
    </div>
</div>
