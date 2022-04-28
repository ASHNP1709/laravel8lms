
    <!--begin::Content-->
{{ theme()->getView('pages/mobilesettings/handsets/brands/components/filtertoolbar', array('modal_id'=>'#mobile_brands_modal')) }}
{{ theme()->getView('pages/mobilesettings/handsets/brands/components/modal', array('brands' => $brands,'os'=>$os)) }}
{{ theme()->getView('pages/mobilesettings/handsets/brands/components/table')}}

<!--end::Content-->

