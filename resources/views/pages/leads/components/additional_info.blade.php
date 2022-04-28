<div class="tab-pane fade" id="additional_info" role="tab-panel">

               <!-- Other Information Start-->
                {{ theme()->getView('pages/leads/components/detail/additional_info/other-info',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
                <!-- Other Information End -->

                <!-- concession Start-->
                {{ theme()->getView('pages/leads/components/detail/additional_info/concession',array('verticalId'=>$verticalId,'saleDetail'=>$saleDetail)) }}
                <!-- concession End -->
</div>