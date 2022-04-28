<!--begin::Card header-->
<div class="card-header py-0 gap-2 gap-md-5 px-0 border-0">
    <!--begin::Card title-->
    <div class="card-title"></div>
    <!--begin::Card title-->
    <!--begin::Card toolbar-->
    <div class="card-toolbar">
        <!--begin::Toolbar-->
        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
            <!--begin::Filter-->

            <button type="button" class="btn btn-light-primary filter_mobile_plans collapsible collapsed me-3" data-bs-toggle="collapse" data-bs-target="#filter_mobile_plans">
                <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
                    </svg>
                </span>
                <!--end::Svg Icon-->{{ __('mobile.listPage.filter') }}

            </button>

            <a href="{{ theme()->getPageUrl('provider/plans/mobile/'.$providerId.'/create') }}" class="btn btn-light-primary me-3">
                <span class="svg-icon svg-icon-2">
                    <i class="fa fa-plus" aria-hidden="true"></i></span>{{ __('mobile.listPage.addPlan') }}
            </a>
        </div>
        <!--end::Toolbar-->
        <!--begin::Group actions-->
        <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
            <div class="fw-bolder me-5">
                <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected
            </div>
            <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
        </div>
    </div>
    <!--end::Group actions-->
</div>
<!--end::Card toolbar-->

<form name="filter_mobile_plans" id="filter_mobile_plans" method="post" class="collapse">
    @csrf
    <div class="card-header align-items-center py-5 gap-2 gap-md-5 px-0 border-0">
        <div class="input-group w-250px">
            <input class="form-control form-control-solid rounded rounded-end-0 input" type="text" name="name_filter" value="{{isset($filters) && isset($filters['name_filter']) ? $filters['name_filter'] :'' }}" placeholder="{{ __ ('mobile.listPage.name_filter.placeHolder')}}" />
        </div>
        <div class="input-group w-250px">

            <select class="form-select fsorm-select-transsparent form-select-solid" name="plan_type_filter" data-control="select2" data-hide-search="false" aria-label="{{ __ ('mobile.listPage.plan_type_filter.placeHolder')}}" data-placeholder="{{ __ ('mobile.listPage.plan_type_filter.placeHolder')}}">
                <option value=" ">All</option>
                @foreach($planTypes as $id => $planType)
                <option value="{{$id}}" {{isset($filters['plan_type_filter']) && $filters['plan_type_filter'] == $id ? 'selected' :'' }}>{{$planType}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group w-250px">
            <select class="form-select fsorm-select-transsparent form-select-solid" name="connection_type_filter" data-control="select2" data-hide-search="false" aria-label="{{ __ ('mobile.listPage.connection_type_filter.placeHolder')}}" data-placeholder="{{ __ ('mobile.listPage.connection_type_filter.placeHolder')}}">
                <option value=" ">All</option>
                @foreach($connectionTypes as $id => $connectionType)
                <option value="{{$id}}" {{isset($filters['connection_type_filter']) && $filters['connection_type_filter'] == $id ? 'selected' :'' }}>{{$connectionType}}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group w-250px">

            <select class="form-select fsorm-select-transsparent form-select-solid" name="status_filter" data-control="select2" data-hide-search="false" aria-label="{{ __ ('mobile.listPage.status_filter.placeHolder')}}" data-placeholder="{{ __ ('mobile.listPage.status_filter.placeHolder')}}">
                <option value=" ">All</option>
                <option value="1" {{isset($filters['status_filter']) && $filters['status_filter'] == 1 ? 'selected' :'' }}>Active</option>
                <option value="0" {{isset($filters['status_filter']) && $filters['status_filter'] == 0 ? 'selected' :'' }}>In-Active</option>
            </select>
        </div>

        <div class="align-items-center py-5 gap-2 gap-md-5 w-100">
            <div class="input-group w-500px">
                <div class="d-flex justify-content-end">
                    <button type="button" id="reset-filter" class="btn btn-light btn-active-light-primary me-5" data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset">{{ __ ('mobile.listPage.reset')}}</button>
                    <button type="submit" class="btn btn-primary" data-kt-menu-dismiss="true" data-kt-customer-table-filter="filter" id="apply_lead_filters">{{ __ ('mobile.listPage.applyFilter')}}</button>
                </div>
            </div>
        </div>
</form>
</div>