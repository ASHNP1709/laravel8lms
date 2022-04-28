<x-base-layout>

    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            @include('pages.plans.common.header')
        </div>
    </div>
    {{ theme()->getView('pages/plans/energy/planRate/demand/add_edit_demand_model', array('demandList' => $demandList,'rateId'=>$rateId))}}
    <!--begin::Row-->
        <div class="row gy-12 gx-xl-12 card mt-3">
            {{ theme()->getView('pages/plans/energy/planRate/demand/toolbar')}}
            {{ theme()->getView('pages/plans/energy/planRate/demand/demand_listing', array('demandList' => $demandList,'rateId'=>$rateId,'url'=>$url)) }}


        </div>

        <!--end::Row-->




</x-base-layout>

