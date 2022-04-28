<x-base-layout>
    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            <div class="d-flex flex-wrap flex-sm-nowrap mb-3">

                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img src="/common/media/avatars/blank.png" alt="image">
                        @if($providerdetails[0]['status']==1)
                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>
                        @else
                        <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-danger rounded-circle border border-4 border-white h-20px w-20px"></div>
                        @endif
                    </div>
                </div>

                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <div class="d-flex flex-column">
                            <div class="d-flex align-items-center mb-2">
                                <a href="#" class="text-gray-800 text-hover-primary fs-2 fw-bolder me-1">{{ ucfirst(decryptGdprData($providerdetails[0]['name'])) }}</a>
                                <a href="#">
                                    {!! theme()->getSvgIcon("icons/duotune/general/gen026.svg", "svg-icon-1 svg-icon-primary") !!}
                                </a>

                                <a href="mailto:{{decryptGdprData($providerdetails[0]['user']['email'])}}" target="_blank" class="btn btn-sm btn-light-success fw-bolder ms-2 fs-8 py-1 px-3">{{ decryptGdprData($providerdetails[0]['user']['email']) }}</a>
                            </div>

                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a href="" onClick="(function(){ window.open('tel:{{ decryptGdprData($providerdetails[0]['user']['phone']) }}');
                                                    })();" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                    {!! theme()->getSvgIcon("icons/duotune/communication/com006.svg", "svg-icon-4 me-1") !!}
                                    {{ decryptGdprData($providerdetails[0]['user']['phone']) }}
                                </a>
                            </div>
                        </div>

                        <div class="d-flex my-4">
                            <a href="#" class="btn btn-sm btn-light me-2" id="kt_user_follow_button">
                                {!! theme()->getSvgIcon("icons/duotune/arrows/arr012.svg", "svg-icon-3 d-none") !!}
                                {{ theme()->getView('partials/general/_button-indicator', array('label' => 'Follow')) }}
                            </a>

                            <a href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="tooltip" data-bs-placement="left" data-bs-trigger="hover" title="Coming soon">Hire Me</a>

                            <div class="me-0">
                                <button class="btn btn-sm btn-icon btn-bg-light btn-active-color-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                                    <i class="bi bi-three-dots fs-3"></i>
                                </button>
                                {{ theme()->getView('partials/menus/_menu-3') }}
                            </div>
                        </div>
                    </div>

                    <div class="d-flex flex-wrap flex-stack">
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <div class="d-flex flex-wrap">
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        {!! theme()->getSvgIcon("icons/duotune/arrows/arr066.svg", "svg-icon-3 svg-icon-success me-2") !!}
                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="$">0</div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">{{ __('Earnings') }}</div>
                                </div>

                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        {!! theme()->getSvgIcon("icons/duotune/arrows/arr065.svg", "svg-icon-3 svg-icon-danger me-2") !!}
                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="75">0</div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">{{ __('Projects') }}</div>
                                </div>

                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <div class="d-flex align-items-center">
                                        {!! theme()->getSvgIcon("icons/duotune/arrows/arr066.svg", "svg-icon-3 svg-icon-success me-2") !!}
                                        <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%">0</div>
                                    </div>
                                    <div class="fw-bold fs-6 text-gray-400">{{ __('Success Rate') }}</div>
                                </div>

                            </div>

                        </div>

                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="fw-bold fs-6 text-gray-400">{{ __('Profile Completion') }}</span>
                                <span class="fw-bolder fs-6">50%</span>
                            </div>

                            <div class="h-5px mx-3 w-100 bg-light mb-3">
                                <div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
            <div class="d-flex overflow-auto h-55px">
                <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder flex-nowrap">
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 active " data-bs-toggle="tab" href="#affiliates">Affiliates</a>
                    </li>
                    @if(isset($providerdetails[0]) && $providerdetails[0]['service_id'] == 1)
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" href="#states">States</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" href="#suburb">Suburb</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" href="#postcode-tab-panel">{{ __('providers.assignPostcodeSection.tabTitle') }}</a>
                    </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 sftp-tab" data-bs-toggle="tab" href="#sftp">SFTP</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" href="#sale-submission">Sale Submission</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-active-primary pb-4 " data-bs-toggle="tab" href="#movin">Movi-In</a>
                    </li>

                </ul>
            </div>
        </div>

    </div>

    @include('pages.providers.tabs.tab-list')
    @section('scripts')
    <script src="/custom/js/loader.js"></script>
    <script src="/common/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="/common/plugins/custom/flatpickr/flatpickr.bundle.js"></script>
    @include('pages.providers.js')
    <script src="/custom/js/breadcrumbs.js"></script>
    <script>
        const breadArray = [{
                title: 'Dashboard',
                link: '/',
                active: false
            },
            {
                title: 'Provider',
                link: `{{ theme()->getPageUrl('provider/list') }}`,
                active: false
            },
            {
                title: 'Assign users',
                link: '#',
                active: true
            },
        ];
        const breadInstance = new BreadCrumbs(breadArray);
        breadInstance.init();
    </script>

    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    @include('pages.providers.tabs.components.assign-js')
    @include('pages.providers.tabs.components.sale-submission.sale-submission-js')
    @include('pages.providers.tabs.components.sftp.sftp-js')
    @endsection

    @section('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    @endsection
</x-base-layout>