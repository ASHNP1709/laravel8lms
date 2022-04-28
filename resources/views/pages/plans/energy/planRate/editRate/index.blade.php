<x-base-layout>
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">

                <!--begin::Form-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        @include('pages.plans.common.header')
                        <ul
                            class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="ms-md-4 nav-link text-active-primary pb-4 active" data-bs-toggle="tab"
                                    href="#rate_info">{{ __('plans/energyPlans.rate_info') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="ms-md-4 nav-link text-active-primary pb-4 "id="get_limt_list" data-bs-toggle="tab"
                                    href="#rate_limt">{{ __('plans/energyPlans.rate_limit') }}</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            @if($editRate->type !='gas_peak_offpeak')
                            <li class="nav-item">
                                <a class="ms-md-4 nav-link text-active-primary pb-4 dmo_vdo" data-bs-toggle="tab"
                                    href="#dmo_vdo">{{ __('plans/energyPlans.dmo_vdo_content') }}</a>
                            </li>
                            <!--end:::Tab item-->
                            <!--begin:::Tab item-->
                            <li class="nav-item">
                                <a class="ms-md-4 nav-link text-active-primary pb-4 tele_dmo_vdo"  data-bs-toggle="tab"
                                    href="#tele_dmo_vdo">{{ __('plans/energyPlans.telesale_dmo_vdo_content') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="ms-md-4 nav-link text-active-primary pb-4 dmo_static" data-bs-toggle="tab"
                                    href="#dmo_static">{{ __('plans/energyPlans.dmo_static_content') }}</a>
                            </li>
                            @endif

                            <!--end:::Tab item-->
                        </ul>
                    </div>
                </div>


                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin:::Tabs-->
                    <!--end:::Tabs-->
                    <!--begin::Tab content-->
                    <div class="tab-content ">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="rate_info" role="tab-panel">
                            @include('pages.plans.energy.planRate.editRate.rate_info')
                        </div>
                        <div class="tab-pane fade show " id="rate_limt" role="tab-panel">
                            @include('pages.plans.energy.planRate.editRate.rate_limit')
                        </div>
                        <div class="tab-pane fade show " id="dmo_vdo" role="tab-panel">
                            @include('pages.plans.energy.planRate.editRate.dmo_vdo_content',array('type'=>'DMO/VDO
                            Content','dmoContent'=>$dmoVdo,'action'=>'dmo_content'))
                        </div>
                        <div class="tab-pane fade show " id="tele_dmo_vdo" role="tab-panel">
                            @include('pages.plans.energy.planRate.editRate.dmo_vdo_content',array('type'=>'Enable
                            Telesales
                            DMO/VDO Content','dmoContent'=>$teleDmoVdo,'action'=>'telesale_content'))
                        </div>

                        <div class="tab-pane fade show " id="dmo_static" role="tab-panel">
                            @include('pages.plans.energy.planRate.editRate.dmo_static_content')
                        </div>


                        <!--end::Tab pane-->
                    </div>
                    <!--end::Tab content-->

                </div>
                <!--end::Main column-->

                <!--end::Form-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    @section('scripts')
    @include('pages.plans.energy.planRate.js')
    <script src="/custom/js/breadcrumbs.js"></script>
    <script>
        var energyType = "{{ $energyTypeVal }}";
        var diff_aff = '/provider/list';
        var aff_head = 'Providers';
        let selectedProvider = "{{ ucwords(decryptGdprData($selectedProvider->name)) }}";
        let selectedPlan = "{{ ucwords($selectedPlan[0]['plan_name']) }}";
        let selectedPlanRate = "{{ ucwords($selectedPlanRate[0]['name']) }}";
         const breadArray = [{
            title: 'Dashboard',
            link: '/',
            active: false
        },
        {
            title: aff_head,
            link: diff_aff,
            active: false
        },
        {
            title: selectedProvider,
            link: "{{ $planUrl }}",
            active: false
        },
        {
            title: capitalizeFirstLetter(energyType) + " Plans",
            link: "{{ $planUrl }}",
            active: false
        },
        {
            title: selectedPlan,
            link: "{{ $url }}",
            active: false
        },
        {
            title: "Plan Rates",
            link: "{{ $url }}",
            active: false
        },
        {
            title: selectedPlanRate,
            link: '#',
            active: false
        },
        {
            title: "Edit",
            link: '#',
            active: true
        },
    ];
    const breadInstance = new BreadCrumbs(breadArray);
    breadInstance.init();

    function capitalizeFirstLetter(str) {
        return str[0].toUpperCase() + str.slice(1);
    }
        </script>
    @endsection
    <!--end::Content-->
</x-base-layout>
