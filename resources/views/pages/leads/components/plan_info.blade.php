<div class="tab-pane fade" id="plan_info" role="tab-panel">

    <!-- NMI Numbers Start-->
    {{ theme()->getView('pages/leads/components/detail/plan_info/nmi-number',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
    <!-- NMI Numbers End -->

    <!-- plan-info Start-->
    {{ theme()->getView('pages/leads/components/detail/plan_info/plan-info',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
    <!-- plan-info End -->


    <!-- handset-info Start-->
    {{ theme()->getView('pages/leads/components/detail/plan_info/handset-info',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
    <!-- handset-info End -->
    <!-- employment-info Start-->
    {{ theme()->getView('pages/leads/components/detail/plan_info/employment-details',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
    <!-- employment-info End -->
</div>
