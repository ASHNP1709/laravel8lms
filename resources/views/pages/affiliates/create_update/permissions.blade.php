<style>
    .checker
    {
        width: 200px;
    }
</style>
<div class="d-flex flex-column gap-7 gap-lg-10">
    <form role="form" class="affiliate-permissions-form">
        @csrf
        <div class="card card-flush py-4">
            <div class="card-header">
                <div class="card-title">
                    <h2>Affiliate Permissions
                    </h2>
                </div>
            </div>
            <div class="card-body pt-0">
                <div class="col-lg-3 fv-row providerservice">

                    <input type="hidden" name="id" class="affiliate_user_id" value="{{encryptGdprData($records['id'])}}">
                    <input type="hidden" name="parent_id" value="{{@encryptGdprData($affiliateuser[0]['parent_id'])}}">

                    <select id="permission_service_id" class="form-control form-control-solid form-select providerservice" data-placeholder="Select Verticals" data-control="select2" name="service_id">
                        @if(count($verticals)>0)
                            <option value=""></option>
                            @foreach($verticals as $vertical)
                            <option value="{{$vertical->service_id}}">
                                {{$vertical->service_title}}
                            </option>
                            @endforeach
                        @endif
                    </select>

                    <span class="service_id_permission_error text-danger"></span>
                </div>
                <div id="permission_checkboxes">
                </div>
            </div>

            <div class="card-footer d-flex justify-content-end py-6 px-9">
                <a href="{{ theme()->getPageUrl('affiliates/list') }}" class="btn btn-white btn-active-light-primary me-2">{!! __('buttons.cancel') !!}</a>
               
                <button type="submit" class="submit_button" class="btn btn-primary">
                    @include('partials.general._button-indicator', ['label' => __('buttons.save')])
                </button>
            </div>
        </div>
    </form>

</div>