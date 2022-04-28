<div class="tab-pane fade" id="customer" role="tab-panel">

    <!-- User Analytics Start-->
    {{ theme()->getView('pages/leads/components/detail/customer_info/user-analytics',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
    <!-- User Analytics End -->

     <!-- User Analytics Start-->
     {{ theme()->getView('pages/leads/components/detail/customer_info/customer-info',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
     <!-- User Analytics End -->

      <!-- User Analytics Start-->
    {{ theme()->getView('pages/leads/components/detail/customer_info/business-details',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
    <!-- User Analytics End -->

    <!-- connection-address Start-->
    {{ theme()->getView('pages/leads/components/detail/customer_info/connection-address',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
    <!-- connection-address End -->

     <!-- PO Box Address Start-->
     {{ theme()->getView('pages/leads/components/detail/customer_info/po-box-address') }}
     <!-- PO Box Address End --> 
     
    <!-- note Start-->
    {{ theme()->getView('pages/leads/components/detail/customer_info/note',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
    <!-- note End -->


</div>
