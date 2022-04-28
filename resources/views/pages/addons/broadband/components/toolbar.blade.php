<!--begin::Card header-->
<div class="card-header border-0 pt-0 px-0">
    <!--begin::Card toolbar-->
    <div class="card-toolbar flex-row-fluid justify-content-end">
        <!--begin::Toolbar-->
        <div class="d-flex justify-content-end" data-kt-customer-table-toolbar="base">
            @if ($category == 'home-line-connection')
                <button type="button" class="btn btn-light-primary me-3" style="display:none;">

                    +Add</button>
                <a href="{{ theme()->getPageUrl('addons/add-home-connection/'.encryptGdprData(3)) }}" id="home_connection" class="btn btn-light-primary me-3">+Add Home Connection</a>
            @elseif ($category == 'modem')
                <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                    data-bs-target="#add_provider_modal" style="display:none;">

                    +Add</button>
                <a href="{{ theme()->getPageUrl('addons/add-modem/'.encryptGdprData(4)) }}" id="modem" class="btn btn-light-primary me-3">+Add Modem</a>
            @elseif  ($category == 'additional-addons')
                <button type="button" class="btn btn-light-primary me-3" data-bs-toggle="modal"
                    data-bs-target="#add_provider_modal" style="display:none;">

                    +Add</button>
                <a href="{{ theme()->getPageUrl('addons/add-addon/'.encryptGdprData(5)) }}" id="additional_modem" class="btn btn-light-primary me-3">+Add Additional Addons</a>
            @endif

        </div>
        <!--end::Toolbar-->
        <!--begin::Group actions-->
        <div class="d-flex justify-content-end align-items-center d-none" data-kt-customer-table-toolbar="selected">
            <div class="fw-bolder me-5">
                <span class="me-2" data-kt-customer-table-select="selected_count"></span>Selected
            </div>
            <button type="button" class="btn btn-danger" data-kt-customer-table-select="delete_selected">Delete
                Selected</button>
        </div>
        <!--end::Group actions-->
    </div>
    <!--end::Card toolbar-->
</div>
