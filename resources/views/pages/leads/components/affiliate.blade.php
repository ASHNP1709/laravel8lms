<div class="tab-pane fade" id="affiliates" role="tab-panel">

            <!-- Affiliate Information Start-->
        {{ theme()->getView('pages/leads/components/detail/affiliate/affiliate-info',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
        <!-- Affiliate Information End -->

        <!-- Affiliate Comment Start-->
        {{ theme()->getView('pages/leads/components/detail/affiliate/affiliate-comment',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
        <!-- Affiliate Comment End -->

    </div>