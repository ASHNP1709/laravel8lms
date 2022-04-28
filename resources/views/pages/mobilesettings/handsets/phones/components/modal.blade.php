<!-- weekdays title -->
<div class="modal fade" id="add_handsets_modal" tabindex="-1" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header bg-primary px-5 py-4">
				<h2 class="fw-bolder fs-12 text-white">
				
					@if(empty($phones))
						Add Phone
					@else
						Edit Phone
					@endif
				
				</h2>
				<div data-bs-dismiss="modal"
                    class="btn btn-icon btn-sm btn-active-icon-primary badge-light-primary rounded-pill">
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="black" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="black" />
                        </svg>
                    </span>
                </div>
				
	  		</div>
	 		 <div class="modal-body px-5">
			  	
	 				{!! Form::model($phones,['method' => 'POST','id' => 'mobile_phones_form', 'name' => 'mobile_phones_form','enctype'=>"multipart/form-data"]) !!}
	 				<!-- hidden field -->
					 @csrf
					 <div class="row">
                        <div class="col-md-6">
                            <label class="col-form-label fw-bold fs-6">Display Name *</label>
                            <div class="fv-row">
                                <div class="form-check-solid fv-row">
                                {!! Form::text('name', null , ['class' => 'form-control form-control-lg form-control-solid','placeholder' => 'Enter Display Name']) !!}
                                <span class="error" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <label class="col-form-label fw-bold fs-6">Phone Brand *</label>
                            <div class="fv-row">
                                <div class="form-check-solid fv-row">
                                {!! Form::select('brand_id',$brandNames,null , ['class' => 'form-control form-control-lg form-control-solid','placeholder' => 'Select Brand']) !!}
                                <span class="error" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
                     </div>
					 <div class="row">
                        <div class="col-md-6">
                            <label class="col-form-label fw-bold fs-6">Phone Model *</label>
                            <div class="fv-row">
                                <div class="form-check-solid fv-row">
                                {!! Form::text('model', null , ['class' => 'form-control form-control-lg form-control-solid','placeholder' => 'Enter Phone Model']) !!}
                                <span class="error" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
    
                        <div class="col-md-6">
                            <label class="col-form-label fw-bold fs-6">Launch Details</label>
                            <div class="fv-row">
                                <div class="form-check-solid fv-row">
                                    {!! Form::text('launch_detail', null , ['class' => 'form-control form-control-lg form-control-solid','placeholder' => 'Enter Launch  Details']) !!}
                                <span class="error" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
                     </div>
                     <div class="row">
                         <div class="col-md-6">
                            <label class="col-form-label fw-bold fs-6">Image</label>
                            <div class="fv-row">
                                <div class="form-check-solid fv-row">
                                   {!! Form::file('image', ['class' => 'form-control form-control-lg form-control-solid']) !!}
                                <span class="error" style="color: red;"></span>
                                </div>
                            </div>
                         </div>
                         <div class="col-md-6">
                            <label class="col-form-label fw-bold fs-6">Pre-order Allowed</label>
                            <div class="fv-row">
                                <div class="md-radio-inline">
                                   {!! Form::radio('is_pre_order', '1', false, ['class' => 'md-radiobtn']) !!}
                                   <label>Yes</label>
                                   {!! Form::radio('is_pre_order', '0', false, ['class' => 'md-radiobtn']) !!}
                                   <label>No</label>
                                <span class="error" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                            <label class="col-form-label fw-bold fs-6">Why this?</label>
                            <div class="fv-row">
                                <div class="form-check-solid fv-row">
                                    {!! Form::textarea('why_this', null , ['class' => 'form-control form-control-lg form-control-solid ckeditor why_this', 'rows' => 4, 'cols' => 40]) !!}
                                <span class="error" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
                     </div>
                     <div class="row">
                        <div class="col-md-12">
                            <label class="col-form-label fw-bold fs-6">Other Information</label>
                            <div class="fv-row">
                                <div class="form-check-solid fv-row">
                                    {!! Form::textarea('other_info', null , ['class' => 'form-control form-control-lg form-control-solid ckeditor other_info', 'rows' => 4, 'cols' => 40]) !!}
                                <span class="error" style="color: red;"></span>
                                </div>
                            </div>
                        </div>
                     </div>
					
					<div class="clearfix"></div>
					<div class="card-footer d-flex justify-content-end py-6 px-9">
						<a class="btn btn-light btn-active-light-primary me-2" href="" data-bs-dismiss="modal">Cancel</a>
						<button type="submit" id="add_phones_submit_btn" class="submit_button" class="btn btn-primary add_phones_submit_btn">Add

                        </button>
					</div>

			      <?php echo Form::close(); ?>
				
			</div>
  		</div>
	</div>
</div>
