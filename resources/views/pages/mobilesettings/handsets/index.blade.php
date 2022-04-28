<x-base-layout>

    <div class="card mb-5 mb-xl-10">

        {{ theme()->getView('pages.mobilesettings.handsets.tab', array('nav'=>'yes')) }}
    </div>
    <div class="card mb-5 mb-xl-10">
        <div class="tab-content">
            <!--begin::Tab pane-->
            <div class="tab-pane fade show active" id="phones" role="tab-panel">
               @include('pages.mobilesettings.handsets.phones.index')
            </div>
            <!--end::Tab pane-->
            <div class="tab-pane fade" id="brands" role="tab-panel">
                @include('pages.mobilesettings.handsets.brands.index')
            </div>
            <div class="tab-pane fade" id="ram" role="tab-panel">
                @include('pages.mobilesettings.handsets.ram.index')

            </div>

            <div class="tab-pane fade" id="internal_storage" role="tab-panel">
                @include('pages.mobilesettings.handsets.internal_storage.index')
            </div>
            <div class="tab-pane fade" id="colors" role="tab-panel">
                @include('pages.mobilesettings.handsets.colors.index')
            </div>

            <div class="tab-pane fade" id="contracts" role="tab-panel">
                 @include('pages.mobilesettings.handsets.contracts.index')
            </div>
        </div>

    </div>
  
</x-base-layout>