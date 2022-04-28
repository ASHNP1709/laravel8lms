<x-base-layout>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            @include('pages.plans.common.header',['selectedProvider' => $selectedProvider])
        </div>
    </div>
    <!--begin::Row-->
    <div class="gy-12 gx-xl-12 card mt-0 mx-0 px-8 all-table-title-css">
        {{ theme()->getView('pages/plans/mobile/components/toolbar', array('providerId' => $providerId,'connectionTypes' =>$connectionTypes,'planTypes'=>$planTypes,'filters'=>$filters)) }}
        {{ theme()->getView('pages/plans/mobile/components/table', array('providerId' => $providerId,'plans'=>$plans,'planTypes'=>$planTypes)) }}
    </div>
    <!--end::Row-->

    @section('scripts')
    <script src="/custom/js/breadcrumbs.js"></script>
    <script src="/common/plugins/custom/datatables/datatables.bundle.js"></script>
    <script>
        var type = 'Mobile Plans';
        var diff_aff = '/provider/list';
        var aff_head = 'Providers';
        var current_head = "{{ ucwords(decryptGdprData($selectedProvider->name)) }}";
        var current_head_url = "/provider/plans/mobile/{{ $providerId }}";
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
                title: current_head,
                link: current_head_url,
                active: false
            },
            {
                title: type,
                link: '#',
                active: true
            },
        ];
        const breadInstance = new BreadCrumbs(breadArray);
        breadInstance.init();

        if ($('#no-data').length == 0) {
            const dataTable = $("#mobile_plans_data_table").DataTable({
                responsive: true,
                searching: true,
                "sDom": "tipr"
            });
        }

        $(document).on('click', '#reset-filter', function() {
            $('[name="plan_type_filter"],[name="connection_type_filter"],[name="status_filter"]').val('').trigger('chosen:updated');
            $('[name="name_filter"]').val('');
            $('#filter_mobile_plans').submit();
        })

        $(document).on('click', '.delete-plan', function() {
            let planId = $(this).data('id');
            let url = window.location.href + "/" + planId;
            Swal.fire({
                title: "Are you sure?",
                text: "You want to delete plan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes"
            }).then(function(result) {
                if (result.isConfirmed) {
                    axios.delete(url)
                        .then(response => {
                            toastr.success('Delete successfully.')
                            location.href = location.href;
                        }).catch(err => {
                            if (err.response.status && err.response.data.message)
                                toastr.error(err.response.data.message);
                            else
                                toastr.error('Whoops! something went wrong.');
                        });
                }
            });
        })

        $(document).on('click', '.status', function() {
            let planId = $(this).data('id');
            let status = $(this).is(':checked') ? 1 : 0;
            let that = $(this);
            let url = window.location.href + "/change-status/" + planId;
            Swal.fire({
                title: "Are you sure?",
                text: "You want to change status!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Yes"
            }).then(function(result) {
                if (result.isConfirmed) {
                    axios.post(url, {
                            status
                        })
                        .then(response => {
                            toastr.success('Status changed successfully.')
                            location.href = location.href;
                        }).catch(err => {
                            if (err.response.status && err.response.data.message)
                                toastr.error(err.response.data.message);
                            else
                                toastr.error('Whoops! something went wrong.');
                        });
                } else {
                    that.prop('checked', !status);
                }
            });

        })
    </script>
    @endsection
</x-base-layout>