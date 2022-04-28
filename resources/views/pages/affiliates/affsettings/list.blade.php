<x-base-layout>
    <div class="card mb-5 mb-xl-10">

        {{ theme()->getView('pages/affiliates/components/affiliatedetails', array('records' => $records,'nav'=>'yes')) }}

    </div>
    <div class="card mb-5 mb-xl-10">
        <div class="tab-content">
            <!--begin::Tab pane-->
            <div class="tab-pane fade show active" id="api_keys" role="tab-panel">

                @include('pages.affiliates.affsettings.components.listingtoolbar')
                @include('pages.affiliates.affsettings.components.table')
                @include('pages.affiliates.affsettings.components.modal')
            </div>
            <div class="tab-pane fade" id="managetarget" role="tab-panel">
                @include('pages.affiliates.affsettings.components.target.list')
            </div>
            <div class="tab-pane fade" id="managetags" role="tab-panel">
                @include('pages.affiliates.affsettings.components.tags.list')

            </div>

            <div class="tab-pane fade" id="matrix" role="tab-panel">
                @include('pages.affiliates.affsettings.components.matrix.create_update')
            </div>
            <div class="tab-pane fade" id="retention_sale" role="tab-panel">
                @include('pages.affiliates.affsettings.components.retention.list')
            </div>

            <div class="tab-pane fade" id="manageusers" role="tab-panel">
                @include('pages.affiliates.affsettings.components.users.list')
            </div>

            <div class="tab-pane fade" id="manageproviders" role="tab-panel">
                @include('pages.affiliates.affsettings.components.providers.list')
            </div>

            <div class="tab-pane fade" id="managedistributors" role="tab-panel">
                @include('pages.affiliates.affsettings.components.distributors.list')
            </div>

            <div class="tab-pane fade" id="manageipwhitelist" role="tab-panel">
                @include('pages.affiliates.affsettings.components.ipwhitelist.list')
            </div>
            
            <div class="tab-pane fade show " id="affiiate_permissions" role="tab-panel">
                @include("pages.affiliates.create_update.permissions")
            </div>
            <!--end::Tab pane-->
        </div>

    </div>

</x-base-layout>