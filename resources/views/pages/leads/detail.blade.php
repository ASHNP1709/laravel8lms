<x-base-layout>
    <link rel="stylesheet" href="{{ URL::asset('custom/css/sale.css') }}">
    {{ theme()->getView('pages/leads/components/modal') }}
    <!--begin::Row-->
    {{-- <div class="row gy-12 gx-xl-12 card mt-3">
        {{ theme()->getView('pages/leads/components/view/toolbar') }}
    </div> --}}
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="w-100">
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">

                        {{ theme()->getView('pages/leads/components/header') }}
                        <!--begin::Navs-->
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                            <li class="nav-item mt-2 me-6 py-5">
                                <a class="nav-link text-active-primary ms-0 active" data-bs-toggle="tab" href="#salestatus">Status</a>
                            </li>

                            <li class="nav-item mt-2 me-6 py-5">
                                <a class="nav-link text-active-primary ms-0" data-bs-toggle="tab" href="#customer">Customer</a>
                            </li>
                            <li class="nav-item mt-2 me-6 py-5">
                                <a class="nav-link text-active-primary ms-0" data-bs-toggle="tab" href="#journey">Journey</a>
                            </li>
                            <li class="nav-item mt-2 me-6 py-5">
                                <a class="nav-link text-active-primary ms-0" data-bs-toggle="tab" href="#stage">Stage</a>
                            </li>
                            <li class="nav-item mt-2 me-6 py-5">
                                <a class="nav-link text-active-primary ms-0" data-bs-toggle="tab" href="#plan_info">Plan</a>
                            </li>

                            <li class="nav-item mt-2 me-6 py-5">
                                <a class="nav-link text-active-primary ms-0" data-bs-toggle="tab" href="#api_response">API</a>
                            </li>
                            <li class="nav-item mt-2 me-6 py-5">
                                <a class="nav-link text-active-primary ms-0" data-bs-toggle="tab" href="#affiliates">Affiliates</a>
                            </li>
                            <li class="nav-item mt-2 me-6 py-5">
                                <a class="nav-link text-active-primary ms-0" data-bs-toggle="tab" href="#qa_section">QA</a>
                            </li>
                            <li class="nav-item mt-2 me-6 py-5">
                                <a class="nav-link text-active-primary ms-0" data-bs-toggle="tab" href="#identification">Identification</a>
                            </li>
                            <li class="nav-item mt-2 me-6 py-5">
                                <a class="nav-link text-active-primary ms-0" data-bs-toggle="tab" href="#additional_info">Additional Info</a>
                            </li>

                        </ul>
                        <!--begin::Navs-->
                    </div>
                </div>
                <!--end::Navbar-->
                <!--begin::Basic info-->
                <div class="tab-content">
                    {{ theme()->getView('pages/leads/components/detail/modal',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
                    {{ theme()->getView('pages/leads/components/status',array('statuses'=>$statuses,'saleProduct'=>$saleProduct,'verticalId'=>$verticalId)) }}
                    {{ theme()->getView('pages/leads/components/customer',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
                    {{ theme()->getView('pages/leads/components/customerjourney',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
                    {{ theme()->getView('pages/leads/components/stage',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
                    {{ theme()->getView('pages/leads/components/plan_info',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
                    {{ theme()->getView('pages/leads/components/api_responses') }}
                    {{ theme()->getView('pages/leads/components/affiliate',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
                    {{ theme()->getView('pages/leads/components/qa-section') }}
                    {{ theme()->getView('pages/leads/components/identification',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
                    {{ theme()->getView('pages/leads/components/additional_info',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
                </div>
            </div>

        </div>
    </div>
    <!--end::Row-->
</x-base-layout>
<script src="/custom/js/breadcrumbs.js"></script>
<script src="/custom/js/sale.js"></script>
<script>
    const breadArray = [{
            title: 'Dashboard',
            link: '/',
            active: false
        },
        {
            title: 'Sales',
            link: "{{url('sales/list')}}",
            active: false
        },
        {
            title: 'View',
            link: '#',
            active: true
        },
    ];
    const breadInstance = new BreadCrumbs(breadArray);
    breadInstance.init();

    let changedStatus = "";
    let verticalId = "{{$verticalId}}";

    $('.change-status').change(function() {
        let saleProductId = $(this).data('product_id');
        let status = $(this).val();
        if (!status)
            return false;

        Swal.fire({
            title: "Are you sure?",
            text: "You want to change status!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes"
        }).then(function(result) {
            if (result.isConfirmed) {
                getSubStatuses(saleProductId, status);
            } else
                $('.change-status').val('').change();

        });
    })

    const getSubStatuses = (saleProductId, status) => {
        changedStatus = status;
        axios.post('/sales/get-sub-statuses', {
                status
            })
            .then(response => {
                setSubStatusHtml(saleProductId, response.data)
            }).catch(err => {
                if (err.response.status && err.response.data.message)
                    toastr.error(err.response.data.message);
                else
                    toastr.error('Whoops! something went wrong.');
            });
    }

    const setSubStatusHtml = (saleProductId, subStatusList) => {
        $('#sub_status').html(`<option value=""></option>`);
        $('#change_sale_status_form_submit_btn').data('saleproductid', saleProductId)
        subStatusList.forEach(element => {
            $('#sub_status').append(`
            <option value="${element.id}">${element.get_status.title}</option
            `);
        });
        $('#sub_status').change();
        $('#change_sale_status_pop_up').modal('show');
    }

    $("#change_sale_status_pop_up").on('hidden.bs.modal', function() {
        $('.change-status').val('').change();
    });

    $('#change_sale_status_form_submit_btn').click(function() {
        let formData = $('#change_sale_status_form').serialize();
        let id = $('#change_sale_status_form_submit_btn').data('saleproductid');
        formData += '&status=' + changedStatus + '&saleProductId=' + id + '&service_id=' + verticalId;
        axios.post('/sales/change-status', formData)
            .then(response => {
                window.location.href = window.location.href;
                // setSubStatusHtml(response.data)
            }).catch(err => {
                if (err.response.status && err.response.data.message)
                    toastr.error(err.response.data.message);
                else
                    toastr.error('Whoops! something went wrong.');
            });
    });
</script>