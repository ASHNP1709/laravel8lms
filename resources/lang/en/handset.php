<?php

return [

    //Phone Tab
    'phones' => [
        'phone_created' => 'Phone Added successfully',
        'phone_notcreated' => 'Phone not Added, Please Try Again Later',
    ],
    'formPage' => [
        'tabs' => [
            'basicDetails' => 'Basic Details',
            'specifications' => 'Specifications',
            'features' => 'Features',
            'more_info' => 'More Info',
        ],
        'basicDetails' => [
            'sectionTitle' => 'Basic Details',
            'submitButton' => 'Save Changes',
            'cancelButton' => 'Discard',
            'phone_name' => [
                'label' => 'Display Name',
                'placeHolder' => 'Enter Display Name',
                'errors' => [
                    'required' => 'Enter Display Name.',
                    'max' => 'Name exceeding max character length of 100.'
                ],
            ],
            'phone_brand' => [
                'label' => 'Phone Brand',
                'placeHolder' => 'Select Phone Brand',
                'errors' => [
                    'required' => 'Select Phone Brand',
                ],
            ],
            'phone_model' => [
                'label' => 'Phone Model',
                'placeHolder' => 'Enter Phone Model',
                'errors' => [
                    'required' => 'Enter Phone Model',
                ],
            ],
            'launch_details' => [
                'label' => 'Launch Details',
                'placeHolder' => 'Enter Launch Details',
            ],
            'image' => [
                'label' => 'Image',
                'errors' => [
                    'required' => 'Add Image',
                ],
            ],
            'pre_order_allowed' => [
                'label' => 'Pre-Order Allowed',
            ],
            'why_this' => [
                'label' => 'Why this?',
            ],
            'other_info' => [
                'label' => 'Other Info',
            ],
        ],
        'specifications' => [
            'sectionTitle' => 'Specifications',
            'submitButton' => 'Save Changes',
            'cancelButton' => 'Discard',
            'network' => [
                'subSectionTitle' => 'Network And Connectivity',
                'technology' => [
                    'label' => 'Technology',
                    'placeHolder' => 'Enter Technology Name',
                    'errors' => [
                        'required' => "Please Enter Technology Name",
                        'max' => 'Technology exceeding max character length of 100.'
                    ]
                ],
                'network_manageability' => [
                    'label' => 'Network Manageability',
                    'errors' => [
                        'required' => "Please enter Network Manageability.",
                        'max' => 'Network Manageability exceeding max character length of 1000.'
                    ]  
                ],
                'extra_technologies' => [
                    'label' => 'Extra Technologies',
                    'errors' => [
                        'required' => "Please enter Extra Technologies.",
                        'max' => 'Extra Technologies exceeding max character length of 1000.'
                    ]  
                ]
            ],
            'body' => [
                'subSectionTitle' => 'Body',
                'dimensions' => [
                    'label' => 'Dimensions',
                    'placeHolder' => 'Enter Dimensions',
                    'errors' => [
                        'required' => 'Please enter Dimensions.',
                        'max' => 'Dimensions exceeding max character length of 100.'
                    ],
                ],
                'weight' => [
                    'label' => 'Weight (g)',
                    'placeHolder' => 'Enter Weight',
                    'errors' => [
                        'required' => 'Please enter Weight.',
                        'max' => 'Weight exceeding max character length of 100.'
                    ],
                ],
                'body_protection_build' => [
                    'label' => 'Body Protection Build',
                    'placeHolder' => 'Enter Body Protection Build',
                ],
                'sim_compatibility' => [
                    'label' => 'SIM Compatibility',
                    'errors' => [
                        'required' => 'Please enter SIM Compatibility.',
                        'max' => 'SIM Compatibility exceeding max character length of 100.'
                    ],
                ],
                'card_slot' => [
                    'label' => 'Card Slot',
                ]
            ],
            'screen_display' => [
                'subSectionTitle' => 'Screen Display',
                'screen_type' => [
                    'label' => 'Screen Type',
                    'placeHolder' => 'Enter Screen Type',
                    'errors' => [
                        'required' => 'Please enter Screen Type.',
                        'max' => 'Screen Display exceeding max character length of 100.'
                    ],
                ],
                'screen_size' => [
                    'label' => 'Screen Size',
                    'placeHolder' => 'Enter Screen Size',
                    'errors' => [
                        'required' => 'Please enter Screen Size.',
                        'max' => 'Screen Size exceeding max character length of 100.'
                    ],
                ],
                'screen_resolution' => [
                    'label' => 'Screen Resolution',
                    'placeHolder' => 'Enter Screen Resolution',
                    'errors' => [
                        'required' => 'Please enter Screen Resolution',
                        'max' => 'Screen Resolution exceeding max character length of 100.'
                    ],
                ],
                'multitouch' => [
                    'label' => 'Multitouch',
                    'placeHolder' => 'Enter Multitouch',
                ],
                'screen_protection' => [
                    'label' => 'Screen Protection',
                    'placeHolder' => 'Enter Screen Protection',
                ],
               
           
            ],
            'operating_system' => [
                'subSectionTitle' => 'Operating System',
                'operating_system' => [
                    'label' => 'Operating System',
                    'placeHolder' => 'Select Operating System',
                    'errors' => [
                        'required' => 'Please select Operating System.',
                    ],
                ],
                'version' => [
                    'label' => 'Version',
                    'placeHolder' => 'Enter Version',
                    'errors' => [
                        'required' => 'Please enter Version.',
                        'max' => 'Version exceeding max character length of 100.'
                    ],
                ],
                'chipset' => [
                    'label' => 'Chipset',
                    'placeHolder' => 'Enter Chipset',
                    'errors' => [
                        'required' => 'Please enter Chipset',
                        'max' => 'Chipset exceeding max character length of 100.'
                    ],
                ],
                'cpu' => [
                    'label' => 'CPU',
                    'placeHolder' => 'Enter CPU',
                    'errors' => [
                        'required' => 'Please enter CPU',
                    ],
                ],
            ],
        ],
        'feature' => [
            'sectionTitle' => 'Features & Box Details',
            'submitButton' => 'Save Changes',
            'cancelButton' => 'Discard',
            'camera' => [
                'label' => 'Camera',
                'errors' => [
                    'required' => 'Please enter Camera Details',
                    'max' => 'Camera exceeding max character length of 10000.'
                ],
            ],
            'sensor' => [
                'label' => 'Sensors',
                'errors' => [
                    'required' => 'Please enter Sensors Details',
                    'max' => 'Sensors exceeding max character length of 10000.'
                ],
            ],
            'technical_specs' => [
                'label' => 'Technical Specs',
                'errors' => [
                    'required' => 'Please enter Technical Specifications',
                    'max' => 'Technical Specs exceeding max character length of 10000.'
                ],
            ],
            'battery_info' => [
                'label' => 'Battery Info',
                'errors' => [
                    'required' => 'Please enter Battery Info',
                    'max' => 'Battery Info exceeding max character length of 10000.'
                ],
            ],
            'in_the_box' => [
                'label' => 'In The Box',
                'errors' => [
                    'required' => 'Please enter Box Details',
                    'max' => 'Box Details exceeding max character length of 10000.'
                ],
            ],
        ],
        'more_info' => [
            'sectionTitle' => 'More Information',
            'addMoreInfoButton' => 'Add More Info',
            'submitButton' => 'Save',
            'cancelButton' => 'Cancel',
            's_no' => [
                'label' => 'S No',
                'placeHolder' => 'Select S No',
                'errors' => [
                    'required' => 'Please enter S No',
                ],
            ],
            'title' => [
                'label' => 'Title',
                'placeHolder' => 'Enter Title',
                'errors' => [
                    'required' => 'Please enter Title',
                ],
            ],
            'what_to_upload' => [
                'label' => 'Select Option',
                'errors' => [
                    'required' => 'Please select option',
                ],
            ],
            'url' => [
                'label' => 'URL',
                'placeHolder' => 'Enter URL',
                'errors' => [
                    'required' => 'Please enter URL',
                ],
            ],
            'file' => [
                'label' => 'File',
                'errors' => [
                    'required' => 'Please upload a File',
                ],
            ],
        ],
    ],
    'indexPage' => [
        'warning_msg_title' => 'Are you sure?',
        'delete_msg_text' => 'You want to delete',
        'delete_success' => 'Handset has been deleted successfully.',
        'delete_error' => 'Handset cannot be deleted as it is assigned to some providers.',
        'yes_text' => 'Yes',
        'handset_status_changed' => 'Handset Status Updated Successfully.',
        'handset_status_change_error' => 'Handset status not updated. Please try again later.',
        'complete_handset_info_before' => 'Please complete all info related Handset before Enable Handset',
    ],
];