<x-base-layout>

    <div class="card mb-5 mb-xl-10">
        <div class="card-body pt-9 pb-0">
            @include('pages.plans.common.header')
        </div>
    </div>

    {{ theme()->getView('pages/plans/energy/planRate/add-solar-rate-modal') }}
    <!--begin::Row-->
        <div class="gy-12 gx-xl-12 card mt-3">


            {{ theme()->getView('pages/plans/energy/planRate/toolbar')}}
            {{ theme()->getView('pages/plans/energy/planRate/solarRates', array('solarRate'=>$solarRate,'planData'=>$planData,'planId'=>$planId,'url'=>$url)) }}

        </div>
        <!--end::Row-->
</x-base-layout>
