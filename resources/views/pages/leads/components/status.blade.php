<div class="tab-pane fade show active" id="salestatus" role="tab-panel">
    <!-- Electricity Status Start-->
    {{ theme()->getView('pages/leads/components/detail/status/status',array('statuses'=>$statuses,'saleProduct'=>$saleProduct,'verticalId'=>$verticalId)) }}
    <!-- Electricity Status End -->
</div>