<!--begin::Card header-->
<div class="card-header align-items-center py-0 gap-2 gap-md-5 px-0 border-0">
    <!--begin::Card toolbar-->
    <div class="card-toolbar flex-row-fluid justify-content-end">
        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
            <button type="button" class="btn btn-light-primary filter_leads collapsible collapsed me-3" data-bs-toggle="collapse" data-bs-target="#affiliate_filters">
                <span class="svg-icon svg-icon-2">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
                    </svg>
                </span>
                Filter
            </button>
        </div>
        <!--begin::Add product-->
        @if($info == 'sub-affiliates')
        <a href="{{ theme()->getPageUrl('affiliates/sub-affiliates/create/'.encryptGdprData($affId)) }}" class="btn btn-light-primary">+Add</a>
        @else
        <a href="{{ theme()->getPageUrl('affiliates/create') }}" class="btn btn-light-primary">+Add</a>
        @endif
        <!--end::Add product-->
    </div>
</div>
<form role="form" name="@if($info==' sub-affiliates')subaffiliate_filters @else affiliate_filters @endif" id="affiliate_filters" class="collapse affiliate_filters">
    @csrf
    <div class="row">
        <div class="col">
            <div class="input-group">
                <input class="form-control form-control-solid rounded rounded-end-0 input" type="text" name="id" placeholder="User Id" />
            </div>
        </div>
        <div class="col">
            <div class="input-group">
                <input class="form-control form-control-solid rounded rounded-end-0 input" type="text" name="company_name" placeholder="Name" />
            </div>
        </div>
        <div class="col">
            <div class="input-group ">
                <input class="form-control form-control-solid rounded rounded-end-0 input" type="email" name="email" placeholder="Email" />
            </div>
        </div>
        <div class="col">
            <div class="input-group ">
                <select data-placeholder="Filter By Status" class="form-select form-select-solid" name="status" data-control="select2" data-hide-search="true">
                    <option></option>
                    <option value="1">Enabled</option>
                    <option value="0">Disabled</option>
                </select>
            </div>
        </div>
        <div class="align-items-center py-5 gap-2 gap-md-5">
            <div class="input-group w-500px">
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-light btn-active-light-primary me-2 resetbutton" data-kt-menu-dismiss="true" data-kt-customer-table-filter="reset" data-id="@if($info == 'sub-affiliates'){{request()->segment(3)}} @endif">Reset</button>
                    <button type="submit" class="btn btn-primary" id="apply_affiliate_filters">Apply Filter</button>
                </div>
            </div>
        </div>
    </div>
</form>
<!--end::Card toolbar-->

<!--end::Card header-->