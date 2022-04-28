<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<div class="card-body pt-0 table-responsive " id="">
    <table class="table border table-hover align-middle table-row-dashed fs-7 gy-2 gs-4 all-table-css-class" id="national_holiday_table">
        <thead>
            <tr class="fw-bolder fs-7 text-gray-800 px-7">
                
                <th>Sr.No.</th>
               
                <th>Contract </th>
                <th>Validity in Months</th>
				<th>Status</th>
                <th class="">Actions</th>
            </tr>
        </thead>
        <tbody class="fw-bold text-gray-600" id="national_list_table">
			<tr>
				<td>1</td>
               
			   <td>24 Months</td>
			   <td>24 Monthsy</td>
			   <td>
					<div class="form-check form-switch form-switch-sm form-check-custom form-check-solid" title="Change Status">
						<input class="form-check-input sweetalert_demo change-status" type="checkbox" value="" name="notifications" checked="">
					</div>
				</td>
			    <td>
					<a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
						<span class="svg-icon svg-icon-5 m-0">
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
							</svg>
						</span>
					</a>
					<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
						<div class="menu-item ">
							<span class="menu-link api_popup">{{ __('buttons.edit') }}</span>
						</div>
						<div class=" menu-item ">
							<span class=" menu-link ">{{ __('buttons.delete') }}</span>
						</div>
					</div>
                </td>
			</tr>
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
<script src="/custom/js/mobile-settings.js"></script>


<script>
 	$('#back_button').attr("href", '{{url("/")}}');

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