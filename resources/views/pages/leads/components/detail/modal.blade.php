<!--begin::Modals-->
<!--begin::Modal - Customers - Add-->

<div class="modal fade" id="kt_assign_change_affiliate" tabindex="-1" role="dialog" aria-hidden="true"> 
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form class="form" action="#" id="assigned_user_form">
                <!--begin::Modal header-->
                <div class="modal-header px-5 py-4" id="kt_modal_assigned_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder fs-12 dynamic_affiliate_heading">Change Affiliate</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="kt_modal_add_close" class="btn btn-icon btn-sm btn-active-icon-primary badge-light-primary rounded-pill" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="black" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="black" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body">
                    <!--begin::Scroll-->
                    <div class="scroll-y me-n7 pe-7" id="kt_modal_assigned_user_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_assigned_user_header" data-kt-scroll-wrappers="#kt_modal_assigned_user_scroll" data-kt-scroll-offset="300px"> 
                        
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="fs-5 fw-bold form-label mb-5"> Select Affiliate: </label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="hidden" name="lead_id" value="{{ isset($saleDetail) && $saleDetail->l_lead_id ?? 'N/A' }}">
                        <input type="hidden" name="type" value="" id="affiliate_select_type"> 
                        <select name="affiliate_id" data-control="select2" data-placeholder="Affiliate Name" class="form-select form-select-solid form-select-lg tech_type_event" id="affiliate_select_options">
                                    
                            </select>
                        <span class="error text-danger"></span>
                        <!--end::Input-->
                    </div>
                    </div>
                    <!--end::Scroll-->
                    <div class="text-end">
                    <!--begin::Button-->
                    <button type="reset" id="kt_modal_assigned_user_cancel" class="btn btn-light me-3">Discard</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="kt_modal_assigned_user_submit" class="btn btn-primary"> 
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait...
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->

            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - Customers - Add-->