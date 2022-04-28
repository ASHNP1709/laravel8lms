<x-base-layout>
    <!--begin::Row-->
    <div class="gy-12 gx-xl-12 card mt-0 mx-0 px-8 all-table-title-css">
        {{ theme()->getView('pages/settings/dmo-vdo/components/toolbar') }}
        {{ theme()->getView('pages/settings/dmo-vdo/components/table') }}
    </div>
    {{ theme()->getView('pages/settings/dmo-vdo/components/modal',['distributors'=>$distributors, 'tariff_types'=>$tariff_types, 'states'=>$states]) }}
    <!--end::Row-->
    @section('styles')
        <link href="/custom/css/loader.css" rel="stylesheet" type="text/css"/>
    @endsection
    @section('scripts')
        <script src="/custom/js/breadcrumbs.js"></script>
        <script src="/custom/js/loader.js"></script>
        <script src="/common/plugins/custom/datatables/datatables.bundle.js"></script>
        @include('pages.settings.dmo-vdo.components.js');

        <script>
            const breadArray = [{
                title: 'Dashboard',
                link: '/',
                active: false
            },
                {
                    title: 'DMO VDO',
                    link: '#',
                    active: true
                },
            ];
            const breadInstance = new BreadCrumbs(breadArray);
            breadInstance.init();
        </script>
    @endsection
</x-base-layout>
