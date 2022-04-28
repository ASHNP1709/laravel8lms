<div class="tab-content">
    <div class="tab-pane fade show active" id="affiliates" role="tab-panel">
        <div class="card mb-5 mb-xl-10">
        @include('pages.providers.tabs.components.affiliates.listingtoolbar')
        @include('pages.providers.tabs.components.affiliates.table')
        </div>
    </div>

    <div class="tab-pane fade" id="states" role="tab-panel">
        <div class="card mb-5 mb-xl-10">
        @include('pages.providers.tabs.components.states.listingtoolbar')
        @include('pages.providers.tabs.components.states.table')
        </div>
    </div>

    <div class="tab-pane fade  " id="suburb" role="tab-panel">
        <div class="card mb-5 mb-xl-10">
        @include('pages.providers.tabs.components.suburb.listingtoolbar')
        </div>
    </div>

    @if(isset($providerdetails[0]) && $providerdetails[0]['service_id'] == 1)
    <div class="tab-pane fade" id="postcode-tab-panel" role="tab-panel">
     @include('pages.providers.tabs.components.postcode.list')
    </div>
    @endif

    <div class="tab-pane fade" id="sftp" role="tab-panel">
     @include('pages.providers.tabs.components.sftp.sftp')
    </div>

    <div class="tab-pane fade" id="sale-submission" role="tab-panel">
     @include('pages.providers.tabs.components.sale-submission.sale-submission')
    </div>

    <div class="tab-pane fade  " id="movin" role="tab-panel">
        @include('pages.providers.tabs.components.move-in.create-update')
    </div>
</div>

