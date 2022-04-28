<div class="card-header align-items-center border-0">
    <!--begin::Card title-->
    <div class="card-title">
        <!--begin::Search-->
        <div class="d-flex align-items-center position-relative my-1">
            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
            <input type="text" data-kt-customer-table-filter="search" id="search_suburb" class="form-control form-control-solid w-250px ps-15" placeholder="Search" />
        </div>
        <!--end::Search-->
    </div>
    <!--begin::Card title-->
    <div class="card-toolbar flex-row-fluid justify-content-end gap-2">
        <button type="button" class="btn btn-light-primary" data-bs-toggle="modal" id="assign_suburb_btn" data-bs-target="#suburb-modal">+Assign</button>
    </div>
</div>

<div class="pt-0 table-responsive px-8">
    <table class="table border table-hover table-row-dashed align-middle fs-7 gy-2 gs-4 dt-bootstrap all-table-css-class" id="suburb-table">
        <thead>
            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                <th class="min-w-50px">Suburb</th>
                <th class="min-w-50px">State</th>
                <th class="min-w-50px">{{ __('affiliates_label.table.status') }}</th>
                <th class="text-end min-w-70px">{{ __('affiliates_label.table.actions') }}</th>
            </tr>
        </thead>

        <tbody class="fw-bold text-gray-600 statesTabledata">
            @if(count($assignedSubrubs)>0)
            @foreach($userStates as $userState )
            @foreach($userState->userSubrubs as $userSubrub )
            <tr>
                <td>{{ $userSubrub->subrubs->suburb }}</td>
                <td>{{ $userSubrub->subrubs->state }}</td>
                <td>
                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid" title="Change Status">
                        <input class="form-check-input sweetalert_demo changeSuburbStatus" type="checkbox" data-id="{{$userSubrub->id}}" @if ($userSubrub->status==1) checked @endif>
                    </div>
                </td>
                <td class="text-end">
                    <a class="deleteSuburb" data-id="{{$userSubrub->id}}" title="Delete">
                        <i class="bi bi-trash fs-2 mx-1 text-primary"></i>
                    </a>
                </td>
            </tr>
            @endforeach
            @endforeach
            @else
            <!-- <td colspan="4" align="center">{{ __('affiliates.norecord') }}</td> -->
            @endif
        </tbody>

    </table>

</div>

<!--begin::Modal - terms-conditions-modal-->
<div class="modal fade" id="suburb-modal" tabindex="-1" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form id="assign_suburb_form" class="form">
                <!--begin::Modal header-->
                <div class="modal-header bg-primary px-5 py-4" id="kt_modal_assigned_user_header">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder fs-12 text-white">{{ __('providers.assignSuburbSection.tabSectionTitle') }}</h2>
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

                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label required">{{ __('providers.assignSuburbSection.state_id.label') }}</label>
                                <select class="form-select fsorm-select-transsparent" name="state_id" data-control="select2" data-hide-search="false" aria-label="{{ __('providers.assignSuburbSection.state_id.placeHolder') }}" data-placeholder="{{ __('providers.assignSuburbSection.state_id.placeHolder') }}">
                                    <option value=""></option>
                                    @foreach($userStates as $userState )
                                    <option value="{{$userState->state_id}}">{{$userState->state->state_code}}</option>
                                    @endforeach
                                </select>
                                <span class="text-danger errors" id="state_id_error"></span>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-12">
                                <label class="form-label required">{{ __('providers.assignSuburbSection.suburb.label') }}</label>
                                <select class="form-select fsorm-select-transsparent" id="suburb" name="suburb[]" data-control="select2" data-hide-search="false" aria-label="{{ __('providers.assignSuburbSection.suburb.placeHolder') }}" data-placeholder="{{ __('providers.assignSuburbSection.suburb.placeHolder') }}" multiple>
                                    <option value=""></option>
                                    {{-- @foreach($userState->state->suburbs as $suburb )
                                    <option value="{{$suburb->id}}" selected>{{$suburb->suburb}}</option>
                                    @endforeach --}}
                                </select>
                                <span class="text-danger errors" id="suburb_error"></span>
                            </div>
                        </div>

                    </div>
                    <!--end::Scroll-->

                    <!--begin::Modal footer-->
                    <div class="text-end">
                        <!--begin::Button-->
                        <button type="reset" id="kt_modal_assigned_user_cancel" data-bs-dismiss="modal" class="btn btn-light me-3">{{ __('providers.assignSuburbSection.cancelBtn') }}</button>
                        <!--end::Button-->
                        <!--begin::Button-->
                        <button type="button" id="plan_term_condition_form_submit_btn" class="btn btn-primary assign_suburb_submit_btn">
                            <span class="indicator-label">{{ __('providers.assignSuburbSection.submitBtn') }}</span>
                            <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Modal footer-->
                </div>
                <!--end::Modal body-->

            </form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--begin::Modal - terms-conditions-modal-->
