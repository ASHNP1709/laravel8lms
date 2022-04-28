<x-base-layout>
    {{ theme()->getView('pages/providers/components/modal') }}
    <!--begin::Row-->
        <div class="gy-12 gx-xl-12 card mt-0 mx-0 px-8 all-table-title-css">
            {{ theme()->getView('pages/providers/components/toolbar') }}
            {{ theme()->getView('pages/providers/components/table', array('info' => $info,'provideruser' => $provideruser)) }}
        </div>
        <!--end::Row-->

        @section('scripts')
            <script src="/custom/js/provider.js"></script>
        @endsection
</x-base-layout>
