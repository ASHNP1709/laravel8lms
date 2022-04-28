<form id="providerStates" name="providerStates" accept-charset="UTF-8" class="submitStates px-8 py-2">
    <div class="d-flex align-items-center position-relative gap-5 my-1">
        @csrf
        <div class="col-lg-6 states">
            <select id="states" class="multiplestates form-control form-control-solid  h-45px" multiple="multiple" name="states[]" aria-hidden="true" data-control="select2" data-placeholder="Select States">
                @if(count($states)>0)
                    @foreach($states as $state )
                        <option value="{{$state->state_id}}">{{$state->state_code}}</option>
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
