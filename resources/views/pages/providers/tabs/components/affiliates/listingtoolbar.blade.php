<form id="affiliateFilter" name="affiliateFilter" accept-charset="UTF-8" class="submitsubmitAffiliate px-8 py-2">
    <div class="d-flex align-items-center position-relative gap-5 my-1">
        @csrf
        <div class="col-lg-6 providers">
        <select id="providers"  class="multipleaffiliates form-control form-control-solid  h-45px" multiple="multiple"  name="providers[]" aria-hidden="true" data-control="select2" data-placeholder="Select Affiliates">
            @if(count($users)>0)
            @foreach($users as $user )
            <option value="{{$user->user_id}}">{{$user->company_name}}</option>
            @endforeach
            @endif
        </select>
        <span class="error text-danger"></span>
        </div>
        <input type="hidden" name="id" value="{{$providerId}}">
        <div class="col-lg-6 px-5" style="text-align:right;">
        <button type="submit" class="btn btn-light-primary">+Assign</button>
        </div>
    </div>
</form>
