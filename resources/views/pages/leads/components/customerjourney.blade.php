<div class="tab-pane fade" id="journey" role="tab-panel">
   

    <!-- Customer Journey Start-->
    {{ theme()->getView('pages/leads/components/detail/journey/customer-journey',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
    <!-- Customer Journey End -->

    <!-- demand-details Start-->
    {{ theme()->getView('pages/leads/components/detail/journey/demand-details',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
    <!-- demand-details End -->

</div>
