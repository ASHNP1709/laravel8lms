<div class="card mb-5 mb-xl-10">

    <div class="card-header border-0 cursor-pointer" data-bs-toggled="collapse" data-bs-targetd="#amazing_extra_facilities_section">
        <div class="card-title m-0">
            <h3 class="fw-bolder m-0">SFTP</h3>
        </div>
    </div>
    <div id="amazing_extra_facilities_section" class="collapse show">
        <div class="card-body pt-0 table-responsive " id="ReloadListing">
            <div class="row pb-5">
                <label class="col-md-2 col-form-label required fw-bold fs-6">Enable SFTP</label>
                @if($providerdetails[0]['sftp_enable'] == 1)
                    <button type="button" class="col-md-2 btn btn-success" id="sftp-status" data-sftp_status="{{$providerdetails[0]['sftp_enable']}}" data-id="{{$providerdetails[0]['id']}}">
                        Disable
                    </button>
                @else
                    <button type="button" class="col-md-2 btn btn-danger" id="sftp-status" data-sftp_status="{{$providerdetails[0]['sftp_enable']}}" data-id="{{$providerdetails[0]['id']}}">
                        Enable
                    </button>
                @endif

                <button type="button" class="btn btn-primary col-md-2 my-1 my-md-0 ms-0 ms-md-2" id="btn-log-emails" data-log_from_email="{{decryptGdprData($providerdetails[0]['log_from_email'])}}" data-log_from_name="{{decryptGdprData($providerdetails[0]['log_from_name'])}}" data-log_subject="{{$providerdetails[0]['log_subject']}}" data-log_to_emails="{{decryptGdprData($providerdetails[0]['log_to_emails'])}}" data-bs-toggle="modal" data-bs-target="#sftp-logs-modal" style="display:none">
                    Log Emails
                </button>

                <button type="button" class="btn btn-primary col-md-2 ms-0 ms-md-2" id="btn-add-sftp" data-bs-toggle="modal" data-bs-target="#add-sftp-modal" style="display:none">
                    Add SFTP
                </button>

                <div class="col-md-2 d-flex align-items-center ms-auto mt-1 mt-md-0 px-0 me-3">
                    <span class="svg-icon svg-icon-1 position-absolute ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="black"/>
                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="black"/>
                        </svg>
                    </span>
                    <input type="text" data-kt-customer-table-filter="search" id="search_target_table" class="form-control form-control-solid ps-15" placeholder="Search"/>
                </div>
            </div>
            @include('pages.providers.tabs.components.sftp.table')
        </div>
    </div>
</div>
@include('pages.providers.tabs.components.sftp.modals')
