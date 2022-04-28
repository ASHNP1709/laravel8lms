<div class="tab-pane fade" id="identification" role="tab-panel">
    
    <!--begin::Content-->

     <!-- Identification details Start-->
     {{ theme()->getView('pages/leads/components/detail/identification/identification-detail',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
     <!-- Identification details End -->
     
        <!-- Customer Documents Start-->
        {{ theme()->getView('pages/leads/components/detail/identification/customer-document',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
        <!-- Customer Documents End -->

        <!-- customer-consent-acceptance Start-->
        {{ theme()->getView('pages/leads/components/detail/identification/customer-consent-acceptance',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
        <!-- customer-consent-acceptance End -->

</div>