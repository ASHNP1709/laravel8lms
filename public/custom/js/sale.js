var pageNumber = 2, processing = false;
let sales = [];
let selectedSales = [];
let allSelectedSales = [];
let qaListHtml = '';
$("#lead_date_id,#lead_movin_date_id").daterangepicker(
	{
		autoUpdateInput: false,
	}
);

$("#lead_date_id,#lead_movin_date_id").on('apply.daterangepicker', function (ev, picker) {
	$(this).val(picker.startDate.format('YYYY-MM-DD') + ' - ' + picker.endDate.format('YYYY-MM-DD'));
});

$('.energy,.mobile,.broadband,.techTypeId,.propertyTypeId,.moveInDate').hide();

$(document).on('change','#vertical_id_field',function () {
	$('.energy,.mobile,.broadband,.techTypeId,.propertyTypeId').hide();
	$('#productType').html('');
	var serviceId = $(this).val(); 
	showFieldsByVertical(serviceId)
});
$('.energy,.mobile,.broadband,.techTypeId,.propertyTypeId').hide();
$('#productType').html('');
var serviceId = $('#vertical_id_field').val(); 
showFieldsByVertical(serviceId)

function showFieldsByVertical(serviceId)
{
	$('.energy').hide();
	if (serviceId == 1) { 
		$('#productType').html('<option></option><option value="1">Electrity</option><option value="2">Gas</option><option value="3">LPG</option>');
		$('.energy,.propertyTypeId').show();
		$('#propertyTypeId').html('<option></option><option value="1">Resedential</option><option value="2">Business</option>');
	}
	else if (serviceId == 2) {
		$('#productType').html('<option></option><option value="1">Sim</option><option value="2">Mobile+Sim</option>');
		$('.mobile,.propertyTypeId').show();
		$('#propertyTypeId').html('<option></option><option value="1">Personal</option><option value="2">Business</option><option value="3">Enterprise</option>');
	}
	else if (serviceId == 3) {
		$('#productType').html('<option></option><option value="1">NBM</option><option value="2">ADSL</option>');
		$('.broadband').show();
	}
}

$('#productType').change(function () {
	$('.techTypeId').hide();
	var productId = $(this).val();
	var serviceId = $('#vertical_id_field').val();
	if (productId == 1 && serviceId == 3) {
		$('.techTypeId').show();
	}
});

$('#affiliateId').change(function () {
	$('#subAffiliateId').html('');
	var productId = $(this).val();
	if (productId == 1) {
		$('#subAffiliateId').html('<option></option><option value="1">Raize</option>');
	}
	else if (productId == 2) {
		$('#subAffiliateId').html('<option></option><option value="1">Eon Sub</option>');
	}
});

$('#moveInId').change(function () {
	$('.moveInDate').hide();
	var productId = $(this).val();
	if (productId == 1) {
		$('.moveInDate').show();
	}
});

$('#apply_lead_filters').click(function (e) {
	e.preventDefault();
	pageNumber = 1;
	getFilterData();
});


function getFilterData(type) {
	processing = true;
	let myForm = document.getElementById('filter_leads');
	let vertical_id = $('#vertical_id_field').val();
	let formData = new FormData(myForm);
	formData.append('verticalId', vertical_id);
	loaderInstance.show(); 
	axios.post('filter-data?page=' + pageNumber, formData)
		.then(function (response) {
			loaderInstance.hide();
			var html = '';
			sales = response.data.leads; 
			var serviceId = response.data.serviceId; 
			if (Object.keys(sales).length > 0) { 
				$.each(sales, function (key, leadData) { 
					var val = leadData[0];
					var count = leadData.length; 
					$('.mobile_heading,.energy_heading').addClass('d-none');
					html += `
					<tr>
						<td>
							<div class="form-check form-check-sm form-check-custom form-check-solid">
								<input class="form-check-input row-checkbox" type="checkbox" value="${val.LeadId}" data-id="${val.LeadId }" data-reference_no="${ val.reference_no }" data-name="${ val.VisitorFirstName }" data-assigned_qa="${ val.AssignedUser }"/>
							</div>
						</td> 
						<td>${val.LeadId}</td>`;

					if (formData.get("saleType") == 'sales') {
						html += `<td>${val.reference_no}<br> ${ (count > 1 && leadData[0]['ProviderId'] != leadData[1]['ProviderId']) ? leadData[1]['reference_no'] : ''  }</td>`;
					}

					html +=
						` <td>${val.VisitorFirstName}</td>`;
					
					if(serviceId == 1)
					{
						$('.energy_heading').removeClass('d-none');
						html +=`
							<td>${val.ProductTypeDescription}</td>
							`;
					}
					else if(serviceId == 2)
					{
						$('.mobile_heading').removeClass('d-none');
						html +=`
							<td>${val.ConnectionName}</td>
							<td>${val.PlanName}</td>
							`;
					} 
					 
					html +=`		
							<td>${val.AffiliateLegalName}</td>
							<td>${val.SubAffiliateName != null ? val.SubAffiliateName : 'N/A'}</td>`;
					if (formData.get("saleType") == 'sales') {
						html += `<td>${val.ProviderLegalName}</td>
								<td>${val.AssignedUserName}</td> 
								<td>
									<div class="badge badge-light-success">${val.SaleStatus}</div>
									<br>
								`;
						if(count>1)
						{
							html += `<div class="badge badge-light-success">${leadData[1]['SaleStatus'] }</div></td>`;
						}
						html +=	`
								</td>
								<td>${val.MovingDate}</td>
								<td>${val.LeadCreatedDate}</td>`; 
					}
					else if (formData.get("saleType") == 'leads') { 
						html += `<td>${val.MovingDate}</td>
								<td>${val.JourneyCompleted}</td>
								<td>${val.is_duplicate != null ? val.is_duplicate : 'No'}</td>
								<td>${val.SalesCreatedDate}</td>`;
					}
					html +=
						`   
							<td class="text-end">
								<a href="/${formData.get('saleType')}/detail/${vertical_id}/${val.LeadId}" class="btn-sm btn-light btn-active-light-primary" data-kt-menu-placement="bottom-end" title="View">
									<i class="bi bi-eye fs-2 mx-1 text-primary"></i>
								</a>
								<a>
									<i class="bi bi-filetype-csv fs-2 mx-1 text-success"></i>
								</a>
							</td> 
						</tr>`;
				});
				processing = false;
			}
			else {
				html = '<tr style="text-align:center"><td colspan="11">No Data Found</td></tr>'
			}
			if (type == 'scroll') {
				KTMenu.createInstances();
				$('.lead_table_data_body').append(html);
				pageNumber += 1;
				return;
			}
			KTMenu.createInstances();
			pageNumber = 2;
			$('.lead_table_data_body').html(html);
		})
		.catch(function (error) {
			loaderInstance.hide();
			console.log(error);
		});
}

$(document).scroll(function (e) {
	if ($(window).scrollTop() >= $(document).height() - $(window).height()) {
		if (processing)
			return false;
		getFilterData('scroll');
	}
});

// Assigned User code
$('#assign-qa').click(async function () {
	let saleIds = [];
	$('.assigned_user_table_data_body').html('');
	if ($('.row-checkbox:checked').length) {
		$('#kt_assign_sale_modal').modal('show');
		$('.assigned_user_table_data_body').append(`
		<tr>
			<td colspan="8">
				<div class="overlay overlay-block card-rounded text-center">
					<div class="overlay-wrapper p-5">
						Please Wait...
					</div>
					<div class="overlay-layer card-rounded bg-dark bg-opacity-5">
						<div class="spinner-border text-primary" role="status">
							<span class="visually-hidden">Loading...</span>
						</div>
					</div>
				</div>
			</td>
		</tr>`)

		// if (qaListHtml == '') {
		// 	await getQaList();
		// }
		await getAssignedQa();  
		$('.assigned_user_table_data_body').html('');
		$.each($('.row-checkbox:checked'), function () {
			selectedSales.push({ 'id': $(this).data('id') })
			$('.assigned_user_table_data_body').append(`
				<tr>
					<td>${$(this).data('reference_no')}</td>
					<td>${$(this).data('name')}</td>
					<td>
						<div class="badge badge-light-success">Lead</div>
					</td>
					<td>
						<input type="hidden" name="sales_id[]" value="${$(this).data('id')}">
						<input type="hidden" name="ref_no[${$(this).data('id')}]" value="${$(this).data('reference_no')}">
						<select class="form-select mb-2 qa-list qa-common" name="qas[${$(this).data('id')}][]" id="qa_${$(this).data('id')}" data-row="${$(this).data('id')}" data-control="select2" data-hide-search="true" data-placeholder="Select QA">
						${qaListHtml}
						</select>

					</td>
					<td>
						<select class="form-select mb-2 qa-list collaborator-common" name="collaborator[${$(this).data('id')}][]" id="collaborator_${$(this).data('id')}" data-row="${$(this).data('id')}" data-control="select2" data-hide-search="true" data-placeholder="Select Collaborator" multiple>
						${qaListHtml}
						</select>
					</td>
				</tr>
				`);   
				var leadId = $(this).data('id');
				items = [];
				$.each(allSelectedSales, function (key,value) { 
					if(value.lead_id == leadId)
					{
						array = value.get_assigned_qa;
						if(array.length>0)
					    	items = array.map(item => item['user_id']); 
					}
				}); 
				$('#qa_'+$(this).data('id')).val($(this).data('assigned_qa')).select2();
				$('#collaborator_'+$(this).data('id')).val(items).select2();
		}) 
		$('.assigned_qas_list').html(qaListHtml);
		$('.assigned_qas_list,.qa-list').select2({
			allowClear: true
		});
		KTMenu.createInstances();
	} else {
		toastr.error('Please select atleast one sale.')
	}
});

const getAssignedQa = () => {
	return new Promise((resolve, reject) => { 
		selectedLeadId = [];	
		qaListHtml = '';
		$.each($('.row-checkbox:checked'), function () {

			selectedLeadId.push({ 'id': $(this).data('id') })
		});  
		var serviceId = $('#vertical_id_field').val(); 
		axios.post('/sales/get-assigned-qa-list',{'lead_id':selectedLeadId, 'serviceId':serviceId})
		.then(function (response) { 
			qaListHtml = `<option></option>`;
			$.each(response.data.qas, function (key, value) {
				qaListHtml += `<option value="${value.id}">${value.full_name}</option>`;
			});  
			allSelectedSales = response.data.assigned_qas;
			resolve('resolved');
		}).catch(err => {
			if (err.response.status && err.response.data.message)
				toastr.error(err.response.data.message);
			else
				toastr.error('Whoops! something went wrong.'); 
			resolve('resolved');
		}); 
	});
}

// const getQaList = () => {
// 	return new Promise((resolve, reject) => { 

// 		axios.get('/sales/get-qa-list')
// 			.then(function (response) {
// 				qaListHtml = `<option></option>`;
				
// 				$.each(response.data.qas, function (key, value) {
// 					qaListHtml += `<option value="${value.id}">${value.full_name}</option>`;
// 				});

// 				resolve('resolved');
// 				// qaList
// 			}).catch(err => {
// 				if (err.response.status && err.response.data.message)
// 					toastr.error(err.response.data.message);
// 				else
// 					toastr.error('Whoops! something went wrong.');
// 				reject('reject');
// 			});
// 	});
// }

$('#master-qa').on('change', function (e) {
	$('#master-collaborators').find("option[disabled='disabled']").removeAttr('disabled');
	$('#master-collaborators').find("option[value='" + $(this).val() + "']").attr('disabled', true);
	$('#master-collaborators').trigger('change.select2');
});

$('#master-collaborators').on('change', function (e) {
	$('#master-qa').find("option[disabled='disabled']").removeAttr('disabled');
	$(this).val().forEach(element => {
		$('#master-qa').find("option[value='" + element + "']").attr('disabled', true);
	});
	$('#master-qa').trigger('change.select2');
});

$('#apply-master-dropdown').click(function () {
	$('.qa-common').val($('#master-qa').val()).trigger('change.select2').change();
	$('.collaborator-common').val($('#master-collaborators').val()).trigger('change.select2').change();
})
$(document).on('change', '.qa-common', function (e) {
	$('#row_' + $(this).data('row') + '_collaborator').find("option[disabled='disabled']").removeAttr('disabled');
	$('#row_' + $(this).data('row') + '_collaborator').find("option[value='" + $(this).val() + "']").attr('disabled', true);
	$('#row_' + $(this).data('row') + '_collaborator').trigger('change.select2');
});

$(document).on('change', '.collaborator-common', function (e) {
	$('#row_' + $(this).data('row') + '_qa').find("option[disabled='disabled']").removeAttr('disabled');
	$(this).val().forEach(element => {
		$('#row_' + $(this).data('row') + '_qa').find("option[value='" + element + "']").attr('disabled', true);
	});
	$('#row_' + $(this).data('row') + '_qa').trigger('change.select2');
});

const assignUsers = () => {
	var formData = $('#assigned_user_form').serialize();
	formData += '&verticalId='+$('#vertical_id_field').val()
	axios.post('/sales/assign-qa', formData)
		.then(response => {
			toastr.success(response.data.message)
			$('.master-checkbox,.row-checkbox').prop('checked',false);
			pageNumber = 1;
			getFilterData();
			$('#kt_assign_sale_modal').modal('hide');
		}).catch(err => {
			if (err.response.status == 422) {
				showValidationMessages(err.response.data.errors);
			}
			if (err.response.status && err.response.data.message)
				toastr.error(err.response.data.message);
			else
				toastr.error('Whoops! something went wrong.');
		});
}

$(document).on('click', '.edit_affiliate_section', function (e) { 
	var value = $(this).data('type'); 
	var affiliate_id = $(this).data('affiliate_id'); 
	 
	var formData = new FormData();
	formData.append('type', value);
	formData.append('affiliate_id', affiliate_id); 
	axios.post('/sales/get_affiliate_list', formData)
		.then(response => {
			var affiliateOptions = '<option value=""></option>';
            $.each( response.data.data, function( key, value ) {
                affiliateOptions += `<option value="${value.user_id}">${value.company_name}</option>`;    
            });
			$('#affiliate_select_type').val(value);
            $('#affiliate_select_options').html(affiliateOptions);
            $('#affiliate_select_options').select2(); 
			$('#kt_assign_change_affiliate').modal('show');
		}).catch(err => { 
		});
});


$(document).on('submit', '#assigned_user_form', function (e) {  
	e.preventDefault();
	let formData = new FormData(this);  
	if(formData.get('affiliate_id') == null || formData.get('affiliate_id') =='')
	{
		toastr.error('Please select affiliate');
		return;
	}
	console.log(formData.get('affiliate_id'));
	axios.post('/sales/change_affilitae', formData)
		.then(response => {
			$('#kt_assign_change_affiliate').modal('hide');
			var data = jQuery("#affiliate_select_options option:selected").text();
			toastr.success(response.data.message) 
			if(formData.get('type') == 'affiliate')
			{
				$('#affiliate_display_name').html(data);
				return;
			}
			$('#sub_affiliate_display_name').html(data); 

		}).catch(err => {  
			toastr.error(err.response.data.message) 
		});
});