<?php

return array(

    // Main menu
    'main'          => array(
        //// Dashboard
        array(
            'title' => 'Dashboard',
            'path'  => '',
            'icon'  => theme()->getSvgIcon("common/media/icons/duotune/art/art002.svg", "svg-icon-2"),
        ),

        //// Modules
        array(
            'classes' => array('content' => 'pt-8 pb-2'),
            'content' => '<span class="menu-section text-muted text-uppercase fs-8 ls-1">Modules</span>',
        ),
        "lead_sale_visit" =>
        // Lead and Sales
        array(
            'title'      => 'Business',
            'icon'       => '<i class="bi bi-cart-fill"></i>',
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    "show_visits" =>
                    array(
                        'title'  => 'Visits',
                        'path'   => 'visits/list',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    "show_leads" =>
                    array(
                        'title'  => 'Leads',
                        'path'   => 'leads/list',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    "show_sales" =>
                    array(
                        'title'  => 'Sales',
                        'path'   => 'sales/list',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    )
                ),
            ),
        ),
        "show_affiliates" =>
        array(
            'title' => 'Affiliates',
            'path'  => 'affiliates/list',
            'icon'  => '<i class="bi bi-people-fill"></i>',
        ),

        "show_providers" =>
        array(
            'title' => 'Providers',
            'icon'  => '<i class="bi bi-shop"></i>',
            'path'  => 'provider/list',
        ),
        "show_addons" =>
        array(
            'title'      => 'Broadband Addons',
            'icon'       => array(
                'svg'  => theme()->getSvgIcon("common/media/icons/duotune/ecommerce/ecm001.svg", "svg-icon-2"),
                'font' => '<i class="bi bi-person fs-2"></i>',
            ),
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Home Line Connection',
                        'path'   => 'addons/home-line-connection/list',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Modem',
                        'path'   => 'addons/modem/list',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Additional Addons',
                        'path'   => 'addons/additional-addons/list',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    )
                ),
            ),
        ),
         //Set Usage
        array(
            'title'      => 'Energy Settings',
            'icon'       => '<i class="bi bi-lightbulb-fill"></i>',
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Usage Limits',
                        'path'   => '/usage/setlimits',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'DMO/VDO content',
                        'path'   => '/settings/dmovdo',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'DMO/VDO prices',
                        'path'   => '/settings/dmovdo-prices',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Life Support Equipments',
                        'path'   => '/settings/life-support-equipments',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),
        array(
            'title'      => 'Mobile Settings',
            'icon'       => '<i class="bi bi-phone-fill"></i>',
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Handsets',
                        'path'   => '/mobile/handsets',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    )
                ),
            ),
        ),
        //Recon Setting
        array(
            'title' => 'Recon Setting',
            'path'  => '/reconsettings/listing',
            'icon'  => '<i class="bi bi-graph-up-arrow"></i>',
        ),
        //Settings
        array(
            'title'      => 'Settings',
            'icon'       => '<i class="bi bi-gear-fill"></i>',
            'classes'    => array('item' => 'menu-accordion'),
            'attributes' => array(
                "data-kt-menu-trigger" => "click",
            ),
            'sub'        => array(
                'class' => 'menu-sub-accordion menu-active-bg',
                'items' => array(
                    array(
                        'title'  => 'Holiday Calendar',
                        'path'   => '/settings/holiday-calendar',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Tags',
                        'path'   => '/settings/tags',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Master Settings',
                        'path'   => '/settings/master-settings',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),

            ),
        ),


    ),

    // Horizontal menu
    'horizontal'    => array(
        // Dashboard
        array(
            'title'   => 'Dashboard',
            'path'    => '',
            'classes' => array('item' => 'me-lg-1'),
        ),

        array(
            'title'   => 'Two Factor Auth',
            'path'    => '/two-factor-auth-setting',
            'classes' => array('item' => 'me-lg-1'),
        ),

        // Dashboard
        array(
            'title'   => 'Dashboard',
            'path'    => '',
            'classes' => array('item' => 'me-lg-1'),
        ),

        // Edit Affiliates
        array(
            'title'   => 'Edit Affiliates',
            'path'    => 'affiliates/edit/{id}',
            'classes' => array('item' => 'me-lg-1'),
        ),

        //Sub Affiliates
        array(
            'title'   => 'Sub Affiliates',
            'path'    => 'affiliates/sub-affiliates/{id}',
            'classes' => array('item' => 'me-lg-1'),
        ),

        //Affiliates affiliate-keys-list
        array(
            'title'   => 'Affiliates key',
            'path'    => 'affiliates/affiliate-keys-list/{id}',
            'classes' => array('item' => 'me-lg-1'),
        ),

        //Sub Affiliates affiliate-keys-list
        array(
            'title'   => 'Sub Affiliates key',
            'path'    => 'affiliates/sub-affiliates/affiliate-keys-list/{id}',
            'classes' => array('item' => 'me-lg-1'),
        ),

        //Affiliates tags
        array(
            'title'   => 'Affiliates Tags',
            'path'    => 'affiliates/manage-tag/{id}',
            'classes' => array('item' => 'me-lg-1'),
        ),

        //Affiliates retention sale
        array(
            'title'   => 'Affiliates Tags',
            'path'    => 'affiliates/retention-sale/{id}',
            'classes' => array('item' => 'me-lg-1'),
        ),

        //Affiliates manage target
        array(
            'title'   => 'Affiliates Manage Targets',
            'path'    => 'affiliates/manage-target/{id}',
            'classes' => array('item' => 'me-lg-1'),
        ),

        //Affiliates matrix
        array(
            'title'   => 'Affiliates Matrix',
            'path'    => 'affiliates/matrix-id/{id}',
            'classes' => array('item' => 'me-lg-1'),
        ),

        // Resources
        array(
            'title'      => 'Resources',
            'classes'    => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
            'attributes' => array(
                'data-kt-menu-trigger'   => "click",
                'data-kt-menu-placement' => "bottom-start",
            ),
            'sub'        => array(
                'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
                'items' => array(
                    // Documentation
                    array(
                        'title' => 'Documentation',
                        'icon'  => theme()->getSvgIcon("common/media/icons/duotune/abstract/abs027.svg", "svg-icon-2"),
                        'path'  => 'documentation/getting-started/overview',
                    ),

                    // Changelog
                    array(
                        'title' => 'Changelog v' . theme()->getVersion(),
                        'icon'  => theme()->getSvgIcon("common/media/icons/duotune/general/gen005.svg", "svg-icon-2"),
                        'path'  => 'documentation/getting-started/changelog',
                    ),
                ),
            ),
        ),

        // Account
        array(
            'title'      => 'Account',
            'classes'    => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
            'attributes' => array(
                'data-kt-menu-trigger'   => "click",
                'data-kt-menu-placement' => "bottom-start",
            ),
            'sub'        => array(
                'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
                'items' => array(
                    array(
                        'title'  => 'Overview',
                        'path'   => 'account/overview',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'Settings',
                        'path'   => 'account/settings',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'      => 'Security',
                        'path'       => '#',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                        'attributes' => array(
                            'link' => array(
                                "title"             => "Coming soon",
                                "data-bs-toggle"    => "tooltip",
                                "data-bs-trigger"   => "hover",
                                "data-bs-dismiss"   => "click",
                                "data-bs-placement" => "right",
                            ),
                        ),
                    ),
                ),
            ),
        ),

        // System
        array(
            'title'      => 'System',
            'classes'    => array('item' => 'menu-lg-down-accordion me-lg-1', 'arrow' => 'd-lg-none'),
            'attributes' => array(
                'data-kt-menu-trigger'   => "click",
                'data-kt-menu-placement' => "bottom-start",
            ),
            'sub'        => array(
                'class' => 'menu-sub-lg-down-accordion menu-sub-lg-dropdown menu-rounded-0 py-lg-4 w-lg-225px',
                'items' => array(
                    array(
                        'title'      => 'Settings',
                        'path'       => '#',
                        'bullet'     => '<span class="bullet bullet-dot"></span>',
                        'attributes' => array(
                            'link' => array(
                                "title"             => "Coming soon",
                                "data-bs-toggle"    => "tooltip",
                                "data-bs-trigger"   => "hover",
                                "data-bs-dismiss"   => "click",
                                "data-bs-placement" => "right",
                            ),
                        ),
                    ),
                    array(
                        'title'  => 'Audit Log',
                        'path'   => 'log/audit',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                    array(
                        'title'  => 'System Log',
                        'path'   => 'log/system',
                        'bullet' => '<span class="bullet bullet-dot"></span>',
                    ),
                ),
            ),
        ),
    ),
);
