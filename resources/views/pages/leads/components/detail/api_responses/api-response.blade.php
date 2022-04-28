<div class="tab-pane fade show mb-5" role="tab-panel">
    <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
        <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
            <div class="card-header">
                <div class="card-title">
                    <h2>API Responses</h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="table-responsive">
                    <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5"
                        id="kt_ecommerce_sales_table">
                        <thead  class="fw-bold text-gray-600">
                            <tr>
                                <th class="min-w-100px text-muted">S No.</th>
                                <th class="min-w-175px text-muted">API Name</th>
                                <th class="min-w-100px text-muted">API Reference Number</th>
                                <th class="min-w-70px text-muted">API Status</th>
                                <th class="min-w-100px text-muted">Created dt</th>
                                <th class="min-w-100px text-muted">View Status</th>
                                <th class="min-w-100px text-muted">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="fw-bolder text-gray-600">
                            <tr>
                                <td>1</td>
                                <td>Dialler API</td>
                                <td>6264083</td>
                                <td>N/A
                                </td>
                                <td>2022-02-04 17:28:02
                                </td>
                                <td>N/A
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="font-weight-bold mr-2" data-bs-toggle="modal"
                                        data-bs-target="#api_response_pop_up">View</a>
                                </td>
                            </tr>

                            <tr>
                                <td>2</td>
                                <td>Origin Gas product-ID</td>
                                <td>Origin Energy</td>
                                <td>N/A
                                </td>
                                <td>2022-02-04 17:40:27
                                </td>
                                <td>N/A
                                </td>
                                <td>
                                    <a href="javascript:void(0)" class="font-weight-bold mr-2" data-bs-toggle="modal"
                                        data-bs-target="#api_response_pop_up">View</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>



                <!-- The Modal -->
                <div class="modal fade" id="api_response_pop_up" data-bs-backdrop="static">
                    <div class="modal-dialog modal-lg modal-dialog-scrollable">
                        <div class="modal-content">

                            <!-- Modal Header -->
                            <div class="modal-header">
                                <h4 class="modal-title">API Response</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                            </div>

                            <!-- Modal body -->
                            <div class="modal-body">
                                <div class="separator my-1"></div>
                                <div class="inner-section mx-4">
                                    <h5>Header Data</h5>
                                    <p>"undefined"</p>
                                    <h5>Request Data</h5>
                                    <p>"http://sip6.wehoster.com/vicidial/non_agent_api.php?source=Econnex&source_id=438&user=opentop&pass=ape38D3xsX&function=add_lead&phone_number=0420580919&phone_code=61&list_id=2018061501&email=maninderjeetsingh@cimet.com.au&city=BARANGAROO&state=NSW&postal_code=2000&address1=&date_of_birth=&comments=URL=https://agents-test.cimet.io/e/?vcrf=MTE1MTQ3fGVtYWls||AffName=Econnex|LeadDt=2022-02-04|17:26:59|Property=residential|Energy=electricitygas|Electricity=Others|Gas=Others|Solar=yes|MedEquip=yes&vendor_lead_code=MTE1MTQ3fGVtYWls&duplicate_check=DUPLIST"
                                    </p>

                                    <h5>Response Data</h5>
                                    <p>" ERROR add_lead DUPLICATE PHONE NUMBER IN LIST - 0420580919 2018061501 6264083 n
                                        "
                                    </p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
