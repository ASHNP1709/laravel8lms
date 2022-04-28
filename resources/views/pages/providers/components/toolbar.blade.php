<!--begin::Card header-->
<div class="card-header border-0 pt-0 px-0">
    <!--begin::Card title-->
    <div class="card-title">
        <!--begin::Search-->
        <div class="d-flex align-items-center position-relative my-1 d-none">
            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
            <span class="svg-icon svg-icon-1 position-absolute ms-6">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black" />
                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->
            <input type="text" data-kt-customer-table-filter="search" id="search_providers" class="form-control form-control-solid w-250px ps-15" placeholder="Search" />
        </div>
        <!--end::Search-->
    </div>
    <!--begin::Card title-->
    <!--begin::Card toolbar-->
    <div class="card-toolbar">
        <!--begin::Toolbar-->
        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">

            <button type="button" class="btn btn-light-primary filter_providers collapsible collapsed me-3" data-bs-toggle="collapse" data-bs-target="#provider_filters">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
                    </svg>
                </span>
                Filter
            </button>
            <a href="{{ theme()->getPageUrl('provider/create') }}" id="provider" class="btn btn-light-primary me-3">+Add</a>

        </div>
        <!--end::Toolbar-->
        <!--begin::Group actions-->
        <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
            <div class="fw-bolder me-5">
            <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected</div>
            <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete Selected</button>
        </div>
        <!--end::Group actions-->
    </div>
    <!--end::Card toolbar-->
</div>
<form role="form" name="provider_filters" id="provider_filters" class="collapse provider_filters">
    @csrf
    <div class="row">
        <div class="col-lg-3">
            <div class="input-group">
                <input class="form-control form-control-solid rounded rounded-end-0 input" type="text" name="id" placeholder="User Id" />
            </div>
        </div>
        <div class="col-lg-3">
            <div class="input-group">
                <input class="form-control form-control-solid rounded rounded-end-0 input" type="text" name="service_id" placeholder="Service Id" />
            </div>
        </div>
        <div class="col-lg-3">
        <div class="input-group">
            <input class="form-control form-control-solid rounded rounded-end-0 input" type="text" name="legal_name" placeholder="Name" />
        </div>
        </div>
        <div class="col-lg-4 d-none">
        <div class="input-group ">
            <input class="form-control form-control-solid rounded rounded-end-0 input" type="email" name="email" placeholder="Email" />
        </div>
        </div>
        <div class="col-lg-3">
        <div class="input-group ">
            <select data-placeholder="Filter By Status" class="form-select form-select-solid status_filter" name="status" data-control="select2" data-hide-search="true">
                <option></option>
                <option value="1">Enabled</option>
                <option value="0">Disabled</option>
            </select>
        </div>
        </div>
        <div class="align-items-center py-5 gap-2 gap-md-5">
            <div class="input-group w-500px">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-light btn-active-light-primary me-2 resetbutton" data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset" data-id="">Reset</button>
                    <button type="submit" class="btn btn-primary" id="apply_provider_filters">Apply Filter</button>
                </div>
            </div>
        </div>
    </div>
</form>
