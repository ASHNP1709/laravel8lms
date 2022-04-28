  <!--begin::Card body-->
  <div class="pt-0 table-responsive">
      <!--begin::Table-->
      <table
          class="table border table-hover table-row-dashed align-middle fs-7 gy-2 gs-4 dt-bootstrap all-table-css-class"
          id="lead_data_table">
          <!--begin::Table head-->
          <thead>
              <!--begin::Table row-->
              <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                  <th class="w-10px pe-2">
                      <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                          <input class="form-check-input master-checkbox" type="checkbox" data-kt-check="true"
                              data-kt-check-target="#lead_data_table .form-check-input" value="1" />
                      </div>
                  </th> 
                  <th class="min-w-50px">ID</th>
                  @if ($saleType == 'sales')
                      <th class="min-w-50">Reference No.</th>
                  @endif
                  <th class="min-w-100px">Name</th>
                    @if($serviceId == 1)
                        <th class="min-w-100px energy_heading">Type</th>
                        <th class="min-w-100px mobile_heading d-none">Connection Type</th>
                        <th class="min-w-100px mobile_heading d-none">Plan TYpe</th>
                    @elseif($serviceId == 2)
                        <th class="min-w-100px energy_heading d-none">Type</th>
                        <th class="min-w-100px mobile_heading">Connection Type</th>
                        <th class="min-w-100px mobile_heading">Plan TYpe</th>
                    @elseif($serviceId == 3)

                    @endif
                  <th class="min-w-125px">Affiliate</th>
              
                  <th class="min-w-100px">Sub-Affiliate</th>
                  @if ($saleType == 'sales')
                      <th class="min-w-100px">Provider</th>
                      <th class="min-w-150px">QA</th> 
                      <th class="min-w-30px">Status</th>
                      <th class="min-w-150px">Movin Date</th>
                  @elseif($saleType == 'leads')
                      <th class="min-w-150px">Movin Date</th>
                      <th class="min-w-150px">Journey Completed</th>
                      <th class="min-w-150px">Duplicate</th>
                  @endif
                  <th class="min-w-150px">Created Date</th>
                  <th class="text-end min-w-70px">Actions</th>
              </tr>
              <!--end::Table row-->
          </thead>
          <!--end::Table head-->
          <!--begin::Table body-->
          <tbody class="fw-bold text-gray-600" class="lead_table_data_body">
              @foreach ($leads as $leadData)
                @php
                    $lead = $leadData[0];
                    $count = count($leadData);
                @endphp
                    <tr>
                        <td>
                          <div class="form-check form-check-sm form-check-custom form-check-solid">
                              <input class="form-check-input row-checkbox" type="checkbox" value="{{ $lead->LeadId }}" data-id="{{ $lead->LeadId }}" data-reference_no="{{ $lead->reference_no }}" data-name="{{ decryptGdprData($lead->VisitorFirstName)  }}" data-assigned_qa="{{ $lead->AssignedUser }}"/>
                          </div>
                        </td>
                        <td>
                            {{ $lead->LeadId }}
                        </td>
                        @if ($saleType == 'sales')
                            <td>
                                {{ $lead->reference_no }}<br>
                                @if($count > 1 && $leadData[0]->ProviderId != $leadData[1]->ProviderId)
                                    {{ $leadData[1]->reference_no }}
                                @endif
                            </td>
                        @endif
                        <td>{{ decryptGdprData($lead->VisitorFirstName) }}</td>
                         
                         
                        @if($serviceId == 1)
                            <td>
                                @if($count >= 1)
                                    both
                                @else
                                    {{ $lead->ProductTypeDescription }}
                                @endif
                            </td>
                        @elseif($serviceId == 2)
                            <td>
                                {{ $lead->ConnectionName }} 
                            </td>
                            <td>
                                {{ $lead->PlanName }} 
                            </td>
                        @elseif($serviceId == 3)

                        @endif
                         
                        
                        <td>{{ decryptGdprData($lead->AffiliateLegalName) }}</td> 
                        <td>{{ isset($lead->SubAffiliateName)?decryptGdprData($lead->SubAffiliateName): "N/A" }}</td>
                        @if ($saleType == 'sales')
                            <td>{{ decryptGdprData($lead->ProviderLegalName) }}</td>
                            <td>{{ decryptGdprData($lead->AssignedUserName) }}</td>  
                            <td class="min-w-30px">
                            <div class="badge badge-light-success">
                                {{ $leadData[0]->SaleStatus }}
                            </div> 
                            <br>
                            @if($count > 1) 
                                <div class="badge badge-light-success">{{ $leadData[1]->SaleStatus }}</div>
                            @endif 
                        </td>
                            <td>{{isset($lead->MovingDate)?$lead->MovingDate:''}}</td>
                            <td>{{$lead->LeadCreatedDate}}</td>
                        @elseif($saleType == 'leads')
                            <td>{{isset($lead->MovingDate)?$lead->MovingDate:''}}</td>
                            <td>{{ $lead->JourneyCompleted }}</td>
                            <td>{{isset($lead->is_duplicate)?$lead->is_duplicate:'No'}}</td>
                            <td>{{$lead->SalesCreatedDate}}</td>
                        @endif
                         
                         
                        <td class="text-end">
                            <a href="/{{ $saleType }}/detail/{{$userServices[0]->id}}/{{ $lead->LeadId }}" title="Detail">
                                <i class="bi bi-eye fs-2 mx-1 text-primary"></i>
                            </a>
                            <a>
                                <i class="bi bi-filetype-csv fs-2 mx-1 text-success"></i>
                            </a>
                        </td>
                    </tr>
              @endforeach
          </tbody>
          <!--end::Table body-->
      </table>
      <!--end::Table-->
  </div>
  <!--end::Card body-->
 
  @section('scripts')
  <link href="/common/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />

      <script src="/common/plugins/custom/datatables/datatables.bundle.js"></script>
      <script type="text/javascript" src="{{ URL::asset('common/plugins/custom/flatpickr/flatpickr.bundle.js') }}"></script>
      <script type="text/javascript" src="{{ URL::asset('custom/js/sale.js') }}"></script>
  @endsection
