<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="card-body pt-0 table-responsive " id="">
    <table class="table border table-hover align-middle table-row-dashed fs-7 gy-2 gs-4 all-table-css-class"
        id="phones_table">
        <thead>
            <tr class="fw-bolder fs-7 text-gray-800 px-7">

                <th>Sr.No.</th>

                <th>Phone Name</th>
                <th>Model No</th>
                <th>Brand</th>
                <th>Status</th>
                <th class="">Actions</th>
            </tr>
        </thead>
        <tbody class="fw-bold text-gray-600" id="phones_list_tbody">
			@forelse ($phonesListing as $phone)
			<tr>
				<td>
					{{ $loop->iteration }}
				</td>
				<td title="{{ $phone->name }}">
                    @php
                    $str ='';
                       if (strlen($phone->name) > 15) {
                        $str = substr($phone->name, 0, 15) . '...';
                        } else {
                            $str = $phone->name;
                        }
                    @endphp
					{{ $str}}
				</td>
				<td>{{ $phone->model }}</td>
				<td>{{ isset($phone->brand) ? $phone->brand->title : '-' }}</td>
				<td>
                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid" title="Change Status">
                        <input class="form-check-input sweetalert_demo change-status" type="checkbox" data-id="{{encryptGdprData($phone->id)}}" {{$phone->status == 1 ? 'checked' : ''}}>
                    </div>
                </td>
				<td><a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
					<span class="svg-icon svg-icon-5 m-0">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
						</svg>
					</span>
				</a>
				<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
					<div class="menu-item">
                        <a href="{{url('/mobile/get-phone-form/'.encryptGdprData($phone->id))}}"><span class="menu-link api_popup">{{ __('buttons.edit') }}</span></a>
					</div>
					<div class="menu-item">
                        <a href="javascript:void(0);" class="delete-phone" data-id="{{ encryptGdprData($phone->id) }}"><span class="menu-link">{{ __('buttons.delete') }}</span></a>
					</div>
					<div class="menu-item">

                        <a href="javascript:void(0);" class="manage-phone-variant" data-id="{{ encryptGdprData($phone->id) }}"><span class="menu-link">
                            {{ __('buttons.variants') }}</span>
                        </a>
					</div>
				</div></td>
			</tr>
				
			@empty
				<tr>
                    <td>No record Found</td>
                </tr>
			@endforelse
        </tbody>
    </table>
</div>
@section('styles')
    <link href="/common/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endsection
@section('scripts')
<script src="/common/plugins/custom/datatables/datatables.bundle.js"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="/custom/js/breadcrumbs.js"></script>
@include('pages.mobilesettings.handsets.brands.components.js')
@include('pages.mobilesettings.handsets.phones.components.js')


    <script>
        $('#back_button').attr("href", '{{ url('/') }}');
        KTMenu.createInstances();
        let dataTable = $("#phones_table").DataTable({
            searching: true,
            "sDom": "tipr",
            pageLength: 10,
         });
        const breadArray = [{
                title: 'Dashboard',
                link: '/',
                active: false
            },
            {
                title: 'Handsets',
                link: "#",
                active: false
            },
        ];

        const breadInstance = new BreadCrumbs(breadArray);
        breadInstance.init();


    </script>
@endsection
