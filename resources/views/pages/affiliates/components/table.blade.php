@php $setnav = 'Listing' @endphp
@php $diff_aff = '/affiliates/list' @endphp
@php $aff_head = 'Affiliates' @endphp
@if($info == 'sub-affiliates')
@php $setnav = 'Listing' @endphp
@php $diff_aff = '/affiliates/sub-affiliates/'.Request::segment(3) @endphp
@php $aff_head = 'Sub Affiliates' @endphp
@endif

<div class="pt-0  table-responsive">
    <table class="table border table-hover table-hov$info == 'sub-affiliates'er align-middle table-row-dashed fs-7 gy-2 gs-4 all-table-css-class" id="affiliate_table">
        <thead>
            <tr class="text-start text-gray-400 fw-bolder fs-7">
                <th class="w-10px pe-2">
                    <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                        <input class="form-check-input check-all" type="checkbox" data-kt-check="true" data-kt-check-target="#affiliate_table .check-all" value="1" />
                    </div>
                </th>
                <th>User Id</th>
                <th>Name</th>
                <th>Email</th>
                @if($info == 'affiliates')
                <th>Logo</th>
                @endif
                <th>Status</th>
                <th>2FA</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody class="text-gray-600" id="affiliatebody">
            @if(count($affiliateuser)>0)
            @foreach($affiliateuser as $affiliate )
            <tr>
                <td>
                    <div class="form-check form-check-sm form-check-custom form-check-solid">
                        <input class="form-check-input check-all" type="checkbox" value="1" />
                    </div>
                </td>
                <td>
                    <span>{{$affiliate['user_id']}}</span>
                </td>
                <td>
                    <span class="wraptext" data-toggle="tooltip" data-placement="top" title="{{$affiliate['company_name']}}">{{$affiliate['company_name']}}</span>
                </td>
                <td>
                    <span class="wraptext" data-toggle="tooltip" data-placement="top" title="{{decryptGdprData($affiliate['user']['email'])}}">{{decryptGdprData($affiliate['user']['email'])}}</span>
                </td>
                @if($info == 'affiliates')
                <td>
                    <span>
                        @if(isset($affiliate['logo']) )
                        <img src="{{$affiliate['logo']}}" width="32px" height="31px" class="img-pop">
                        @else
                        <img src="{{ asset(theme()->getMediaUrlPath() . 'avatars/blank.png') }}" width="32px" height="31px" class="img-pop">
                        @endif
                    </span>
                </td>
                @endif
                <td>
                    <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid" title="Change Status">
                        <input class="form-check-input sweetalert_demo change-status" type="checkbox" value="" name="notifications" @if ($affiliate['status']==1) checked @endif data-status="{{encryptGdprData($affiliate['user_id'])}}">
                    </div>
                </td>
                <td>
                    @if(isset($affiliate['two_factor_secret']) )
                    <div class="badge badge-light-success">Enabled</div>
                    @else
                    <div class="badge badge-light-danger">Disabled</div>
                    @endif

                </td>
                <td>
                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
                        <span class="svg-icon svg-icon-5 m-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="black" />
                            </svg>
                        </span>
                    </a>
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-150px py-4" data-kt-menu="true">
                        <div class="menu-item">
                            @if($info == 'affiliates')
                            <a href="{{ theme()->getPageUrl('affiliates/edit/'.encryptGdprData($affiliate['user_id'])) }}" class="menu-link "><i class="bi bi-pencil-square"></i> Edit</a>
                            @elseif($info == 'sub-affiliates')
                            <a href="{{ theme()->getPageUrl('affiliates/sub-affiliates/edit/'.encryptGdprData($affiliate['user_id'])) }}" class="menu-link "><i class="bi bi-pencil-square"></i> Edit</a>
                            @endif
                        </div>
                        <div class="menu-item">
                            @if($info == 'affiliates')
                            <!-- <a href="{{ route('affiliate-keys.list', [encryptGdprData($affiliate['user_id']), 'mode' => theme()->getCurrentMode()]); }}" class="menu-link">Api Keys</a> -->
                            <a href="{{ route('affiliate-keys.list', [encryptGdprData($affiliate['user_id']), 'mode' => theme()->getCurrentMode()]); }}" class="menu-link"><i class="bi bi-gear"></i> Settings</a>
                            @elseif($info == 'sub-affiliates')
                            <a href="{{ route('sub-affiliates.affiliate-keys.list', [encryptGdprData($affiliate['user_id']), 'mode' => theme()->getCurrentMode()]); }}" class="menu-link"><i class="bi bi-gear"></i> Settings</a>
                            @endif
                        </div>
                        @if($info == 'affiliates')
                        <div class="menu-item ">
                            <a href="{{ theme()->getPageUrl('affiliates/sub-affiliates/'.encryptGdprData($affiliate['user_id'])) }}" class="menu-link"><i class="bi bi-people"></i> Sub-Affiliates</a>
                        </div>
                        @endif

                        <div class="menu-item ">
                            <a href="{{ route('2fa.settings', ['id' => encryptGdprData($affiliate['user_id']) , 'mode' => theme()->getCurrentMode() ]) }}" class="menu-link"><i class="bi bi-unlock"></i> Manage 2FA</a>
                        </div>

                        <div class="menu-item ">
                            <a href="{{ theme()->getPageUrl('affiliates/templates/'.encryptGdprData($affiliate['user_id'])) }}" class="menu-link"><i class="bi bi-envelope-paper"></i> Templates</a>
                        </div>
                    </div>
                </td>
            </tr>
            @endforeach

            @else
            <td colspan="7" align="center">{{ __('affiliates.norecord') }}</td>
            @endif

        </tbody>
    </table>

</div>

@section('styles')
<link href="/common/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css" />
@endsection

@section('scripts')
<script src="/custom/js/affiliates.js"></script>
<script src="/custom/js/breadcrumbs.js"></script>
<script src="/custom/js/loader.js"></script>
<script>
    var type = '{{$setnav}}';
    var diff_aff = '{{$diff_aff}}';
    var aff_head = '{{$aff_head}}';
    var info = '{{$info}}';

    const breadArray = [{
        title: 'Dashboard',
        link: '/',
        active: false
    }, ];

    if (info == 'sub-affiliates') {
        breadArray.push({
            title: 'Affiliates',
            link: '/affiliates/list',
            active: false
        }, );
    }

    breadArray.push({
        title: aff_head,
        link: diff_aff,
        active: false
    }, {
        title: type,
        link: '#',
        active: true
    }, );

    const breadInstance = new BreadCrumbs(breadArray);
    breadInstance.init();
</script>
@endsection