<x-base-layout>
    <!--begin::Content-->
    <div class="d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container">
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <!--begin::Navs-->
                        @include('pages.mobilesettings.handsets.phones.components.form.tabs-nav')
                        <!--begin::Navs-->
                    </div>
                </div>
                <!--end::Navbar-->

                <!-- Tabs -->
                <div class="tab-content">
                    @include('pages.mobilesettings.handsets.phones.components.form.basic-details')
                    @if(isset($phone))
                    @include('pages.mobilesettings.handsets.phones.components.form.specifications')
                    @include('pages.mobilesettings.handsets.phones.components.form.features')
                    @include('pages.mobilesettings.handsets.phones.components.form.more_info')
                    @endif
                </div>
                <!-- End Tabs -->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
        @if(isset($phone))
        @include('pages.mobilesettings.handsets.phones.components.form.add_more_info_modal')
        @endif
    </div>
    @section('scripts')
    <link href="/common/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css"/>
    <script src="/custom/js/breadcrumbs.js"></script>
    <script src="/common/plugins/custom/datatables/datatables.bundle.js"></script> 
    @include('pages.mobilesettings.handsets.phones.components.js')
    @endsection
    <!--end::Content-->
</x-base-layout>