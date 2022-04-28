<?php

namespace App\Repositories\Lead\SaleSubmissions\EA; 
use App\Models\{
    SaleProduct,
    SaleProductsEnergy 
            };
use App\Repositories\Lead\SaleSubmissions\EA\CountryCodes;
use App\Traits\SaleSubmission\EaSubmitSaleTrait;

class EASaleSubmissionRepo
{
    use CountryCodes,EaSubmitSaleTrait;
    function submitEASale($saleId,$energy)
    {     
        $saleId =1;
        $data['gasSale'] = $data['StreetPostcode'] = $data['StreetState'] = $data['StreetStreetName'] = $data['StreetStreetNumber'] = $data['StreetStreetType'] = $data['StreetSuburb'] = $data['gasSale'] = $data['offerElecPlanId'] = $data['offerElecSourceCode'] = $data['offerGasPlanId'] = $data['offerGasSourceCode'] = '';
        try{
            $saleData = SaleProductsEnergy::where('lead_id',$saleId);
            if ($energy == 'both') {
                $saleData = $saleData->get();
                if ($saleData[0]->product_type == 'gas') {
                    $sale = $saleData[1];
                    $gasSale = $saleData[0];
                } else {
                    $sale = $saleData[0];
                    $gasSale = $saleData[1];
                }
            } else {
                $saleData = $saleData->where('product_type', 1)->get(); 
                $sale = $saleData[0];
            }
             

            //get batch no to create unique vendor ID
            $data['vendorID'] = $sale->reference_no;
            settype($data['vendorID'], "string");
            $saleSubAttempt = $sale->sale_submission_attempt;
            $data['vendorID'] .= $saleSubAttempt;
            $data['vendorCode'] = 'CMT';
            $businessCodes = [
                'business' => 'BUS',
                'residential' => 'RES'
            ];
            $errors = [];
            $data['saleDate'] = '';
            if (isset($sale->VisitorInformation->qa_notes_created_date) && $sale->VisitorInformation->qa_notes_created_date != '') {
                $qa_saleDate = strtotime(str_replace('/', '-', $sale->VisitorInformation->qa_notes_created_date));
                $data['saleDate'] = date('Y-m-d\T10:i:s\Z', $qa_saleDate);
            }
            if ($data['saleDate'] == '' || $data['saleDate'] == null) {
                array_push($errors, ['Sale Date' => 'Sale date field is required']);
            }
            
            $data['customerType'] = isset($businessCodes[$sale->property_type])?$businessCodes[$sale->property_type] :'';
            if ($data['customerType'] == '' || $data['customerType'] == null) {
                array_push($errors, ['Customer Type' => 'Customer type field is required']);
            }

            $data['transactionType'] = 'PS';
            if ($sale->moving_house == 'yes') {
                $data['transactionType'] = 'ENE';
            } else if ($sale->Resale_type == 1) {
                $data['transactionType'] = 'COR';
            }
            
            $data['customerTitle'] = $sale->title;
            $data['customerFirstName'] = $sale->first_name;
            $data['customerLastName'] = $sale->last_name;
            $data['customerEmail'] = $sale->email;
            $data['customerDOB'] = $sale->dob;
            if ($data['customerTitle'] == '' || $data['customerTitle'] == null) {
                array_push($errors, ['Title' => 'Customer title field is required']);
            }
            if ($data['customerFirstName'] == '' || $data['customerFirstName'] == null) {
                array_push($errors, ['First Name' => 'Customer first name field is required']);
            }
            if ($data['customerLastName'] == '' || $data['customerLastName'] == null) {
                array_push($errors, ['Last Name' => 'Customer last name field is required']);
            }
            if ($data['customerEmail'] == '' || $data['customerEmail'] == null) {
                array_push($errors, ['Email' => 'Customer email field is required']);
            }
            if ($data['customerDOB'] == '' || $data['customerDOB'] == null) {
                array_push($errors, ['DOB' => 'Customer DOB field is required']);
            }

            $data['customerPhoneType'] = 'MOBILE';
            $data['customerPhoneNumber'] = $sale->phone;
            if ($data['customerPhoneNumber'] == '' || $data['customerPhoneNumber'] == null) {
                array_push($errors, ['Mobile' => 'Customer Mobile field is required']);
            } else if (!preg_match('/^[0][23478][0-9]{8}$/', $data['customerPhoneNumber'])) {
                array_push($errors, 'Customer Mobile should be in correct format');
            }

            $data['customerAlternatePhoneNumber'] = $sale->alternate_phone;
            if (isset($data['customerAlternatePhoneNumber']) && $data['customerAlternatePhoneNumber'] != '') {
                if (!preg_match('/^[0][23478][0-9]{8}$/', $data['customerAlternatePhoneNumber'])) {
                    array_push($errors, 'Customer alternate mobile no should be in correct format');
                }
            }

            $data['preferredContactMethod'] = 'EMAIL';
            $data['premiseRelationship'] = 'TENANT';

            $data['customerIdType'] = $sale->VisitorInformation->identity_type;
            if ($data['customerIdType'] == "Drivers Licence") {
                $data['customerIdType'] = 'DL';
                $data['customerIdNumber'] = $sale->VisitorInformation->licence_number;
                $data['customerIdExpiry'] = $sale->VisitorInformation->licence_card_expiry_date;
            } else if ($data['customerIdType'] == "Medicare Card") {
                $data['customerIdType'] = 'MEDICARE';
                $data['customerIdNumber'] = $sale->VisitorInformation->medicare_number;
                $data['customerIdExpiry'] = $sale->VisitorInformation->medicare_card_expiry_date;
            } else {
                $data['customerIdType'] = 'PASSPORT';
                $data['customerIdNumber'] = $sale->VisitorInformation->passport_number;
                $data['customerIdExpiry'] = $sale->VisitorInformation->passport_card_expiry_date;
            }
            $data['customerIdMedicareCardColour'] = $sale->VisitorInformation->card_color;
            $data['customerIdmedicareReferenceNumber'] = $sale->VisitorInformation->medicare_reference_number;
            $data['customerIdFirstName'] = $sale->VisitorInformation->c_first_name;
            $data['customerIdMiddleName'] = $sale->VisitorInformation->card_middle_name;
            $data['customerIdLastName'] = $sale->VisitorInformation->c_last_name;
            if ($data['customerIdFirstName'] == null  || $data['customerIdFirstName'] == '') {
                $data['customerIdFirstName'] = $data['customerFirstName'];
            }
            if ($data['customerIdLastName'] == null  || $data['customerIdLastName'] == '') {
                $data['customerIdLastName'] = $data['customerLastName'];
            }
            $data['customerIdStateOfIssue'] = $sale->VisitorInformation->licence_state_code;

            $data['customerIdCountryOfIssue'] = 'AUS';
            if ($sale->VisitorInformation->identity_type == "Foreign Passport") {
                $data['customerIdCountryOfIssue'] = $sale->VisitorInformation->country_code;
            }
            $countryOfIssueCodes = self::getCountryCode();
            if (strlen($data['customerIdCountryOfIssue']) == 2) {
                $data['customerIdCountryOfIssue'] = isset($countryOfIssueCodes[$data['customerIdCountryOfIssue']]) ? $countryOfIssueCodes[$data['customerIdCountryOfIssue']] : '';
            }

            $cardCodes = [
                'G' => 'GREEN',
                'B' => 'BLUE',
                'Y' => 'YELLOW'
            ];

            $data['customerIdMedicareCardColour'] = isset($cardCodes[$data['customerIdMedicareCardColour']]) ? $cardCodes[$data['customerIdMedicareCardColour']] : '';

            //Identification fields is required when Customer type is RESIDENTIAL
            if ($data['customerType'] == 'RES') {
                if ($data['customerIdNumber'] == '' || $data['customerIdNumber'] == null) {
                    array_push($errors, ['Customer ID Number' => 'Customer ID number field is required']);
                }
                if ($data['customerIdFirstName'] == '' || $data['customerIdFirstName'] == null) {
                    array_push($errors, ['Identification First Name' => 'Customer ID first name field is required']);
                }
                if ($data['customerIdLastName'] == '' || $data['customerIdLastName'] == null) {
                    array_push($errors, ['Identification Last Name' => 'Customer ID last name field is required']);
                }
                if ($data['customerIdType'] == '' || $data['customerIdType'] == null) {
                    array_push($errors, ['Identification Id Type' => 'Customer ID type field is required']);
                } else if ($data['customerIdType'] == 'DL') {
                    if ($data['customerIdStateOfIssue'] == '' || $data['customerIdStateOfIssue'] == null) {
                        array_push($errors, ['State Of Issue' => 'State of issue field is required for DL']);
                    }
                } else if ($data['customerIdType'] == 'PASSPORT') {
                    if ($data['customerIdCountryOfIssue'] == '' || $data['customerIdCountryOfIssue'] == null) {
                        array_push($errors, ['Country Of Issue' => 'Country of issue field is required for passport']);
                    }
                } else {
                    if ($data['customerIdmedicareReferenceNumber'] == '' || $data['customerIdmedicareReferenceNumber'] == null) {
                        array_push($errors, ['Reference No' => 'Medicare reference no field is required for medicare']);
                    }
                    if ($data['customerIdMedicareCardColour'] == '' || $data['customerIdMedicareCardColour'] == null) {
                        array_push($errors, ['Medicare Card Colour' => 'Medicare card colour field is required for medicare']);
                    }
                    if ($data['customerIdExpiry'] == '' || $data['customerIdExpiry'] == null) {
                        array_push($errors, ['Medicare Expiry Date' => 'Medicare Expiry date field is required for medicare']);
                    }
                }
            }

            $data['businessName'] =  isset($sale->VisitorBusinessDetail->business_legal_name) ? $sale->VisitorBusinessDetail->business_legal_name : '';
            $data['businessIdType'] =  'ABN';
            $data['businessIdValue'] =  isset($sale->VisitorBusinessDetail->business_abn) ? $sale->VisitorBusinessDetail->business_abn : '';
            $data['businessType'] =  isset($sale->VisitorBusinessDetail->business_industry_type) ? $sale->VisitorBusinessDetail->business_company_type : '';
            if ($data['businessType'] == 'Incorporation') {
                $data['businessType'] = 'INCORPORATED';
            } elseif ($data['businessType'] == 'Limited Company') {
                $data['businessType'] = "LIMITED_COMPANY";
            } elseif ($data['businessType'] == 'Partnership') {
                $data['businessType'] = "PARTNERSHIP";
            } elseif ($data['businessType'] == 'Private') {
                $data['businessType'] = "OTHERS";
            } elseif ($data['businessType'] == 'Sole Trader') {
                $data['businessType'] = "SOLE_TRADER";
            } elseif ($data['businessType'] == 'Trust') {
                $data['businessType'] = "OTHERS";
            } else {
                $data['businessType'] = "OTHERS";
            }
            $data['businessAnzsic'] =  isset($sale->VisitorBusinessDetail->anzsic) ? $sale->VisitorBusinessDetail->anzsic : '';


            //Business fields is required when Customer type is BUSINESS
            if ($data['customerType'] == 'BUS') {
                if ($data['businessName'] == '' || $data['businessName'] == null) {
                    $errors['Business Name'] = 'Business name field is required';
                }
                if ($data['businessIdValue'] == '' || $data['businessIdValue'] == null) {
                    $errors['Business ID Value'] = 'Business id value field is required';
                }
                if ($data['businessType'] == '' || $data['businessType'] == null) {
                    $errors['Business type'] = 'Business type field is required';
                }
                if ($data['businessAnzsic'] == '' || $data['businessAnzsic'] == null) {
                    $errors['Business Anzsic'] = 'Business anzsic field is required';
                }
            }

            $data['AccountHolderFirstName'] =  $sale->VisitorInformation->joint_acc_holder_first_name;
            $data['AccountHolderLastName'] =  $sale->VisitorInformation->joint_acc_holder_last_name;
            $data['AccountHolderEmail'] =  $sale->VisitorInformation->joint_acc_holder_email;
            $data['AccountHolderAccessLevel'] =  'BASIC_READ_WRITE';

            $data['energisationConnectionDate'] = date('Y-m-d', strtotime(str_replace('/', '-', $sale->moving_date)));
            $data['energisationVisualInspection'] = 'false';
            if (trim($sale->VisitorConnectionAddress->state) == 'OLD' || trim($sale->VisitorConnectionAddress->state) == 'NSW') {
                $data['energisationVisualInspection'] = 'true';
            }

            $data['energisationAccessDetails'] = '';
            if ($energy == 'both') {
                $data['energisationAccessDetails'] = $sale->VisitorInformation->site_access_electricity . ' ' . $sale->VisitorInformation->site_access_gas;
            } else if ($energy == 'electricity') {
                $data['energisationAccessDetails'] = $sale->VisitorInformation->site_access_electricity;
            } else {
                $data['energisationAccessDetails'] = $sale->VisitorInformation->site_access_gas;
            }
            $data['energisationInspectionTime'] = $sale->note;
            $data['energisationRenovationsSinceDeenergisation'] = 'false';
            $data['energisationRenovationsInProgressOrPlanned'] = 'false';
            $data['energisationAfterHoursServiceOrder'] = 'false';
            
            //Energisation fields are required when transactionType is ENE (Moving)
            if ($data['transactionType'] == 'ENE') {
                if ($data['energisationConnectionDate'] == '' || $data['energisationConnectionDate'] == null) {
                    $errors['Connection Date'] = 'Connection date field is required';
                }
                if (trim($sale->VisitorConnectionAddress->state) == 'OLD' || trim($sale->VisitorConnectionAddress->state) == 'NSW') {
                    if (trim($data['energisationAccessDetails']) == '') {
                        $errors['Access Detail'] = 'Access detail field is required';
                    }
                    if ($data['energisationInspectionTime'] == '' || $data['energisationInspectionTime'] == null) {
                        $errors['Inspection Time'] = 'Inspection time field is required';
                    } else if (!preg_match('/^(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9])$/', $data['energisationInspectionTime'])) {
                        $errors['Insepection time'] = 'Insepection time field should be in ISO 8601 time-only format (hh:mm) format';
                    }
                } else if ($data['energisationInspectionTime'] != '' && $data['energisationInspectionTime'] != null) {
                    if (!preg_match('/^(0[0-9]|1[0-9]|2[0-3]):([0-5][0-9])$/', $data['energisationInspectionTime'])) {
                        $errors['Insepection time'] = 'Insepection time field should be in ISO 8601 time-only format (hh:mm) format';
                    }
                }
            }

            $data['premiseNmi'] =  $sale->VisitorInformation->nmi_number;
            $data['premiseMirn'] =  $sale->VisitorInformation->dpi_mirn_number;
            $data['premiseUnitNumber'] = $sale->VisitorConnectionAddress->unit_no;
            $data['premiseUnitType'] = $sale->VisitorConnectionAddress->unit_type_code;
            $data['premiseFloorNumber'] = $sale->VisitorConnectionAddress->floor_no;
            $data['premiseFloorType'] = $sale->VisitorConnectionAddress->floor_type_code;
            $data['premiseStreetNumber'] = $sale->VisitorConnectionAddress->street_number;
            $data['premiseStreetName'] = $sale->VisitorConnectionAddress->street_name;
            $data['premiseStreetType'] = $sale->VisitorConnectionAddress->street_code;
            $data['premiseSuburb'] = $sale->VisitorConnectionAddress->suburb;
            $data['premiseState'] = $sale->VisitorConnectionAddress->state;
            $data['premisePostcode'] = $sale->VisitorConnectionAddress->postcode;
            $data['premiseDpid'] = $sale->VisitorConnectionAddress->connection_dpid;
            $data['premiseSolarPower'] = 'false';
            if ($sale->solar_panel == 'yes') {
                $data['premiseSolarPower'] = 'true';
            }
            $data['premiseNetworkTariffCode'] = $sale->VisitorInformation->electricity_network_code;
            $data['premiseTimeOfUse'] = 'false';

            if ($sale->VisitorInformation->nmi_skip == 0 && ($energy == 'electricity' || $energy == 'both')) {
                if (!preg_match('/^[a-zA-Z0-9]{10,11}$/', $data['premiseNmi'])) {
                    $errors['NMI'] = 'NMI should contain 10 to 11 characters';
                }
            }
            if ($sale->VisitorInformation->mirn_skip == 0  && ($energy == 'gas' || $energy == 'both')) {
                if (!preg_match('/^[a-zA-Z0-9]{10,11}$/', $data['premiseMirn'])) {
                    $errors['MIRN'] = 'MIRN should contain 10 to 11 characters';
                }
            }

            if ($data['premiseStreetNumber'] == '' || $data['premiseStreetNumber'] == null) {
                $errors['Premise Street Number'] = 'Premise street number field is required';
            }
            if ($data['premiseStreetName'] == '' || $data['premiseStreetName'] == null) {
                $errors['Premise Street Name'] = 'Premise street name field is required';
            }
            if ($data['premiseStreetType'] == '' || $data['premiseStreetType'] == null) {
                $errors['Premise Street Type'] = 'Premise street type field is required';
            }
            if ($data['premiseSuburb'] == '' || $data['premiseSuburb'] == null) {
                $errors['Premise Suburb'] = 'Premise suburb field is required';
            }
            if ($data['premiseState'] == '' || $data['premiseState'] == null) {
                $errors['Premise state'] = 'Premise state field is required';
            }
            if ($data['premisePostcode'] == '' || $data['premisePostcode'] == null) {
                $errors['Premise postcode'] = 'Premise postcode field is required';
            }
            if (($data['premiseDpid'] != '' && $data['premiseDpid'] != null) && !is_numeric($data['premiseDpid'])) {
                $errors['Premise Address DPID'] = 'Premise address DPID fields should be numeric';
            }
            if($energy == 'electricity')
            {
                $data['offerElecPlanId'] = $sale->plan->plan_campaign_code;
                $data['offerElecSourceCode'] = $sale->plan->product_code_e;
                if ($data['offerElecPlanId'] == '' || $data['offerElecPlanId'] == null) {
                    $errors['Electricty Plan ID'] = 'Electricty plan ID field is required';
                }
                if ($data['offerElecSourceCode'] == '' || $data['offerElecSourceCode'] == null) {
                    $errors['Electricty source code'] = 'Electricty source code field is required';
                }
            } else if ($energy == 'gas') {
                $data['offerGasPlanId'] = $sale->plan->plan_campaign_code;
                $data['offerGasSourceCode'] =  $sale->plan->product_code_g;
                if ($data['offerGasPlanId'] == '' || $data['offerGasPlanId'] == null) {
                    $errors['Gas Plan ID'] = 'Gas plan ID field is required';
                }
                if ($data['offerGasSourceCode'] == '' || $data['offerGasSourceCode'] == null) {
                    $errors['Gas source code'] = 'Gas source code field is required';
                }
            } else {
                $data['offerElecPlanId'] = $sale->plan->plan_campaign_code;
                $data['offerElecSourceCode'] = $sale->plan->product_code_e;
                $data['offerGasPlanId'] = $gasSale->plan->plan_campaign_code;
                $data['offerGasSourceCode'] =  $gasSale->plan->product_code_g;

                if ($data['offerElecPlanId'] == '' || $data['offerElecPlanId'] == null) {
                    $errors['Electricty Plan ID'] = 'Electricty plan ID field is required';
                }
                if ($data['offerElecSourceCode'] == '' || $data['offerElecSourceCode'] == null) {
                    $errors['Electricty source code'] = 'Electricty source code field is required';
                }
                if ($data['offerGasPlanId'] == '' || $data['offerGasPlanId'] == null) {
                    $errors['Gas Plan ID'] = 'Gas plan ID field is required';
                }
                if ($data['offerGasSourceCode'] == '' || $data['offerGasSourceCode'] == null) {
                    $errors['Gas source code'] = 'Gas source code field is required';
                }
            }

            $data['postalDeliveryNumber'] =  $data['postalDeliveryType'] = $data['postalSuburb'] = $data['postalState'] = $data['postalPostcode'] = $data['postalDpid'] = '';

            $data['billDeliveryMethod'] = 'EMAIL';
            if (isset($sale->billing_option_selected) && $sale->billing_option_selected != 'email_billing') {
                $data['billDeliveryMethod'] = 'POST';
            }
            
            if ($sale->save_po_box == 1) {
                $data['mailingAddressType'] = 'POSTAL';
                $data['preferredContactMethod'] = 'POSTAL';
                $data['postalDeliveryNumber'] = $sale->VisitorPoBoxAddress->address;
                $data['postalDeliveryType'] = 'PO_BOX';
                $data['postalSuburb'] = isset($sale->VisitorPoBoxAddress) ? $sale->VisitorPoBoxAddress->suburb : '';
                $data['postalState'] = isset($sale->VisitorPoBoxAddress) ? $sale->VisitorPoBoxAddress->state : '';
                $data['postalPostcode'] = isset($sale->VisitorPoBoxAddress) ? $sale->VisitorPoBoxAddress->postcode : '';
                $data['postalDpid'] = isset($sale->VisitorPoBoxAddress) ? $sale->VisitorPoBoxAddress->po_box_dpid : '';
                if ($data['postalDeliveryNumber'] == '' || $data['postalDeliveryNumber'] == null) {
                    $errors['Postal Address Delivery Number'] = 'Postal address delivery number field is required';
                }
                if ($data['postalSuburb'] == '' || $data['postalSuburb'] == null) {
                    $errors['Postal Address Suburb'] = 'Postal address suburb field is required';
                }
                if ($data['postalState'] == '' || $data['postalState'] == null) {
                    $errors['Postal Address state'] = 'Postal address state field is required';
                }
                if ($data['postalPostcode'] == '' || $data['postalPostcode'] == null) {
                    $errors['Postal Address postcode'] = 'Postal address postcode field is required';
                }
                if (($data['postalDpid'] != '' && $data['postalDpid'] != null) && !is_numeric($data['postalDpid'])) {
                    $errors['Postal Address DPID'] = 'Postal address DPID fields should be numeric';
                }
            } else {
                $data['mailingAddressType'] = 'STREET';
                if (isset($sale->billing_option_selected) && $sale->billing_option_selected == 'yes') {
                    $data['preferredContactMethod'] = 'EMAIL';
                    $data['StreetUnitNumber'] = $sale->VisitorBillingAddress->unit_no;
                    $data['StreetUnitType'] = $sale->VisitorBillingAddress->unit_type_code;
                    $data['StreetFloorNumber'] = $sale->VisitorBillingAddress->floor_no;
                    $data['StreetFloorType'] = $sale->VisitorBillingAddress->floor_type_code;
                    $data['StreetStreetNumber'] = $sale->VisitorBillingAddress->street_number;
                    $data['StreetStreetName'] = $sale->VisitorBillingAddress->street_name;
                    $data['StreetStreetType'] = $sale->VisitorBillingAddress->street_code;
                    $data['StreetSuburb'] = $sale->VisitorBillingAddress->suburb;
                    $data['StreetState'] = $sale->VisitorBillingAddress->state;
                    $data['StreetPostcode'] = $sale->VisitorBillingAddress->postcode;
                    $data['StreetDpid'] = $sale->VisitorBillingAddress->billing_dpid;
                } else if (isset($sale->billing_option_selected) && $sale->billing_option_selected == 'email_billing' && $sale->email_welcome_pack == 1) {
                    $data['preferredContactMethod'] = 'POSTAL';
                    $data['StreetUnitNumber'] = $sale->VisitorEmailWelcomeAddress->unit_no;
                    $data['StreetUnitType'] = $sale->VisitorEmailWelcomeAddress->unit_type_code;
                    $data['StreetFloorNumber'] = $sale->VisitorEmailWelcomeAddress->floor_no;
                    $data['StreetFloorType'] = $sale->VisitorEmailWelcomeAddress->floor_type_code;
                    $data['StreetStreetNumber'] = $sale->VisitorEmailWelcomeAddress->street_number;
                    $data['StreetStreetName'] = $sale->VisitorEmailWelcomeAddress->street_name;
                    $data['StreetStreetType'] = $sale->VisitorEmailWelcomeAddress->street_code;
                    $data['StreetSuburb'] = $sale->VisitorEmailWelcomeAddress->suburb;
                    $data['StreetState'] = $sale->VisitorEmailWelcomeAddress->state;
                    $data['StreetPostcode'] = $sale->VisitorEmailWelcomeAddress->postcode;
                    $data['StreetDpid'] = $sale->VisitorEmailWelcomeAddress->billing_dpid;
                } else {
                    $data['preferredContactMethod'] = 'EMAIL';
                    $data['StreetUnitNumber'] = $sale->VisitorConnectionAddress->unit_no;
                    $data['StreetUnitType'] = $sale->VisitorConnectionAddress->unit_type_code;
                    $data['StreetFloorNumber'] = $sale->VisitorConnectionAddress->floor_no;
                    $data['StreetFloorType'] = $sale->VisitorConnectionAddress->floor_type_code;
                    $data['StreetStreetNumber'] = $sale->VisitorConnectionAddress->street_number;
                    $data['StreetStreetName'] = $sale->VisitorConnectionAddress->street_name;
                    $data['StreetStreetType'] = $sale->VisitorConnectionAddress->street_code;
                    $data['StreetSuburb'] = $sale->VisitorConnectionAddress->suburb;
                    $data['StreetState'] = $sale->VisitorConnectionAddress->state;
                    $data['StreetPostcode'] = $sale->VisitorConnectionAddress->postcode;
                    $data['StreetDpid'] = $sale->VisitorConnectionAddress->connection_dpid;
                }

                if ($data['StreetStreetNumber'] == '' || $data['StreetStreetNumber'] == null) {
                    $errors['Street Address Street Number'] = 'Street address street number fields is required';
                }
                if ($data['StreetStreetName'] == '' || $data['StreetStreetName'] == null) {
                    $errors['Street Address Street Name'] = 'Street address street name fields is required';
                }
                if ($data['StreetStreetType'] == '' || $data['StreetStreetType'] == null) {
                    $errors['Street Address Street Type'] = 'Street address street type fields is required';
                }
                if ($data['StreetSuburb'] == '' || $data['StreetSuburb'] == null) {
                    $errors['Street Address Suburb'] = 'Street address suburb fields is required';
                }
                if ($data['StreetState'] == '' || $data['StreetState'] == null) {
                    $errors['Street Address State'] = 'Street address state fields is required';
                }
                if ($data['StreetPostcode'] == '' || $data['StreetPostcode'] == null) {
                    $errors['Street Address Postcode'] = 'Street address postcode fields is required';
                }
                if (($data['StreetDpid'] != '' && $data['StreetDpid'] != null) && !is_numeric($data['StreetDpid'])) {
                    $errors['Street Address DPID'] = 'Street address DPID fields is numeric';
                }
            }
            $data['carbonNeutralOptIn'] = 'false';
            $data['lifeSupport'] = 'false';
            if ($sale->medical_equipment == 'yes') {
                $data['lifeSupport'] = 'true';
            }
            $data['safetyFlag'] = 'false';

            //making grapghQL data
            $startGraphQL = '{ "query": "mutation { submitSale(input: { ';

            //Mobile number
            $phoneString = 'phone: [ ';
            $firstMobile = '{ type: ' . $data['customerPhoneType'] . ' number: \"' . $data['customerPhoneNumber'] . '\" } ';

            $alternateMobile = ' ';
            if (isset($data['customerAlternatePhoneNumber']) && $data['customerAlternatePhoneNumber'] != '') {
                $data['alternateMobile'] = '{ type: ' . $data['customerPhoneType'] . ' number: \"' . $data['customerAlternatePhoneNumber'] . '\" } ';
            }
            $phoneString = $phoneString . $firstMobile . $alternateMobile . ' ]';

            //customer detail start
            $customer = ' customer: { title: \"' . $data['customerTitle'] . '\" firstName: \"' . $data['customerFirstName'] . '\" lastName: \"' . $data['customerLastName'] . '\" emailAddress: \"' . $data['customerEmail'] . '\" dateOfBirth: \"' . $data['customerDOB'] . '\" ' . $phoneString . ' preferredContactMethod: ' . $data['preferredContactMethod'] . ' ';

            $premiseRelString = ' ';
            $identification = ' ';
            if ($data['customerType'] == 'RES') {
                $premiseRelString = 'premiseRelationship: ' . $data['premiseRelationship'] . ' ';

                //identification start
                $identification = '  identification: { type: ' . $data['customerIdType'] . ' number: \"' . $data['customerIdNumber'] . '\" firstName: \"' . $data['customerIdFirstName'] . '\" lastName: \"' . $data['customerIdLastName'] . '\" ';

                $stateOfIssue = 'stateOfIssue: ' . $data['customerIdStateOfIssue'];
                $countryOfIssue = 'countryOfIssue: \"' . $data['customerIdCountryOfIssue'] . '\"';

                $customerMidNameStr = '';
                if ($data['customerIdMiddleName'] != null && $data['customerIdMiddleName'] != '') {
                    $customerMidNameStr = ' middleName: \"' . $data['customerIdMiddleName'] . '\"';
                }
                $medicalIdDetail = $customerMidNameStr . ' medicareReferenceNumber: \"' . $data['customerIdmedicareReferenceNumber'] . '\" medicareCardColour: ' . $data['customerIdMedicareCardColour'] . ' expiry: \"' . $data['customerIdExpiry'] . '\" ';

                if ($data['customerIdType'] == 'DL') {
                    $countryOfIssue = ' ';
                    $medicalIdDetail = ' ';
                } else if ($data['customerIdType'] == 'PASSPORT') {
                    $stateOfIssue = ' ';
                    $medicalIdDetail = ' ';
                } else {
                    $stateOfIssue = ' ';
                    $countryOfIssue = ' ';
                }
                $identification = $identification . $stateOfIssue . $countryOfIssue . $medicalIdDetail . ' } ';
                //identification  
            }
            $customer = $customer . $premiseRelString . $identification . ' } ';

            //customer detail end

            //join account info start
            $accountHolder = ' ';
            if ($sale->VisitorInformation->is_connection_joint_account_holder == 1) {
                $accountHolder = ' additionalAccountHolder: { firstName: \"' . $data['AccountHolderFirstName'] . '\" lastName: \"' . $data['AccountHolderLastName'] . '\" emailAddress: \"' . $data['AccountHolderEmail'] . '\" accessLevel: ' . $data['AccountHolderAccessLevel'] . ' }';
            }
            //join account info end

            //business detail start
            $buisnessDetail = ' ';
            if ($data['customerType'] == 'BUS') {
                $buisnessDetail = ' business: { name: \"' . $data['businessName'] . '\" idType: ' . $data['businessIdType'] . ' idValue: \"' . $data['businessIdValue'] . '\" businessType: ' . $data['businessType'] . ' anzsic: ' . $data['businessAnzsic'] . ' } ';
            }
            //business detail end

            //energisation(moving) detail start
            $energisation = ' ';
            if ($data['transactionType'] == 'ENE') {
                $energisation = ' energisation: { connectionDate: \"' . $data['energisationConnectionDate'] . '\" visualInspection: ' . $data['energisationVisualInspection'] . ' accessDetails: \"' . $data['energisationAccessDetails'] . '\" inspectionTime: \"' . $data['energisationInspectionTime'] . '\" renovationsSinceDeenergisation: ' . $data['energisationRenovationsSinceDeenergisation'] . ' renovationsInProgressOrPlanned: ' . $data['energisationRenovationsInProgressOrPlanned'] . ' afterHoursServiceOrder: ' . $data['energisationAfterHoursServiceOrder'] . ' }';
            }
            //energisation(moving) detail end

            //premise start
            $premise = ' premise: { ';
            $premiseNMIString = ' ';
            $premiseMIRNString = ' ';
            //NMI 
            if ($sale->VisitorInformation->nmi_skip == 0 && ($energy == 'electricity' || $energy == 'both')) {
                $premiseNMIString = ' nmi: \"' . $data['premiseNmi'] . '\" ';
            }
            //MIRN
            if ($sale->VisitorInformation->mirn_skip == 0  && ($energy == 'gas' || $energy == 'both')) {
                $premiseMIRNString = 'mirn: \"' . $data['premiseMirn'] . '\" ';
            }
            //Address
            $premiseDpidString = ' ';
            if (isset($data['premiseDpid']) && $data['premiseDpid'] != '') {
                $premiseDpidString = 'dpid: ' . $data['premiseDpid'];
            }
            $premiseUnitTypeStr = '';
            if (isset($data['premiseUnitType']) && $data['premiseUnitType'] != '') {
                $premiseUnitTypeStr = 'unitType: \"' . $data['premiseUnitType'] . '\"';
            }
            $premiseUnitNumStr = '';
            if (isset($data['premiseUnitNumber']) && $data['premiseUnitNumber'] != '') {
                $premiseUnitNumStr = 'unitNumber: \"' . $data['premiseUnitNumber'] . '\"';
            }
            $premiseFloorNumStr = '';
            if (isset($data['premiseFloorNumber']) && $data['premiseFloorNumber'] != '') {
                $premiseFloorNumStr = 'floorNumber: \"' . $data['premiseFloorNumber'] . '\"';
            }
            $premiseFloorTypeStr = '';
            if (isset($data['premiseFloorType']) && $data['premiseFloorType'] != '') {
                $premiseFloorTypeStr = 'floorType: \"' . $data['premiseFloorType'] . '\"';
            }

            $premiseAddress = 'address: { ' . $premiseUnitTypeStr . $premiseUnitNumStr . $premiseFloorNumStr . $premiseFloorTypeStr . ' streetNumber: \"' . $data['premiseStreetNumber'] . '\" streetName: \"' . $data['premiseStreetName'] . '\" streetType: \"' . $data['premiseStreetType'] . '\" suburb: \"' . $data['premiseSuburb'] . '\" state: ' . $data['premiseState'] . ' postcode: \"' . $data['premisePostcode'] . '\" ' . $premiseDpidString . ' } ';

            //Solar detail
            $premiseNetTariffStr = ' ';
            if ($data['premiseSolarPower'] == 'true') {
                $premiseNetTariffStr = ' networkTariffCode: \"' . $data['premiseNetworkTariffCode'] . '\"';
            }
            $premiseSolar = ' solarDetails: { solarPower: ' . $data['premiseSolarPower'] . $premiseNetTariffStr . ' timeOfUse: ' . $data['premiseTimeOfUse'] . ' } ';

            $premise = $premise . $premiseNMIString . $premiseMIRNString . $premiseAddress . $premiseSolar . ' } ';
            //premise end

            //Offer starts
            $offer = ' offers: [ ';
            $offerElec = '';
            $offerGas = '';
            if ($energy == 'both') {
                $offerElec = '{ fuel: ELE planId: \"' . $data['offerElecPlanId'] . '\" sourceCode: \"' . $data['offerElecSourceCode'] . '\" greenEnergyPercentage: 0 }';
                $offerGas = ' { fuel: GAS planId: \"' . $data['offerGasPlanId'] . '\" sourceCode: \"' . $data['offerGasSourceCode'] . '\" } ';
            } else if ($energy == 'electricity') {
                $offerElec = '{ fuel: ELE planId: \"' . $data['offerElecPlanId'] . '\" sourceCode: \"' . $data['offerElecSourceCode'] . '\" greenEnergyPercentage: 0 }';
            } else {
                $offerGas = ' { fuel: GAS planId: \"' . $data['offerGasPlanId'] . '\" sourceCode: \"' . $data['offerGasSourceCode'] . '\" } ';
            }
            $offer = $offer . $offerElec . $offerGas . ' ]';
            //Offer ends

            //postal address or street address start
            $postalDpidString = ' ';
            if (isset($data['postalDpid']) && $data['postalDpid'] != '') {
                $postalDpidString = ' dpid: ' . $data['postalDpid'];
            }
            $StreetDpidString = ' ';
            if (isset($data['StreetDpid']) && $data['StreetDpid'] != '') {
                $StreetDpidString = 'dpid: ' . $data['StreetDpid'];
            }
            $postalAddress = ' ';
            $streetAddress = ' ';
            if ($data['mailingAddressType'] == 'POSTAL') {
                $postalAddress = ' postalMailingAddress: { postalDeliveryNumber: \"' . $data['postalDeliveryNumber'] . '\" postalDeliveryType: ' . $data['postalDeliveryType'] . ' suburb: \"' . $data['postalSuburb'] . '\" state: ' . $data['postalState'] . ' postcode: \"' . $data['postalPostcode'] . '\"';
                $postalAddress = $postalAddress . $postalDpidString . ' }';
            } else if ($data['mailingAddressType'] == 'STREET') {
                $StreetUnitNumStr = '';
                if (isset($data['StreetUnitNumber']) && $data['StreetUnitNumber'] != '') {
                    $StreetUnitNumStr = 'unitNumber: \"' . $data['StreetUnitNumber'] . '\"';
                }
                $StreetUnitTypeStr = '';
                if (isset($data['StreetUnitType']) && $data['StreetUnitType'] != '') {
                    $StreetUnitTypeStr = 'unitType: \"' . $data['StreetUnitType'] . '\"';
                }
                $StreetFloorNumStr = '';
                if (isset($data['StreetFloorNumber']) && $data['StreetFloorNumber'] != '') {
                    $StreetFloorNumStr = 'floorNumber: \"' . $data['StreetFloorNumber'] . '\"';
                }
                $StreetFloorTypeStr = '';
                if (isset($data['StreetFloorType']) && $data['StreetFloorType'] != '') {
                    $StreetFloorTypeStr = 'floorType: \"' . $data['StreetFloorType'] . '\"';
                }

                $streetAddress = ' streetMailingAddress: { ' . $StreetUnitNumStr . $StreetUnitTypeStr . $StreetFloorNumStr . $StreetFloorTypeStr . ' streetNumber: \"' . $data['StreetStreetNumber'] . '\" streetName: \"' . $data['StreetStreetName'] . '\" streetType: \"' . $data['StreetStreetType'] . '\" suburb: \"' . $data['StreetSuburb'] . '\" state: ' . $data['StreetState'] . ' postcode: \"' . $data['StreetPostcode'] . '\" ' . $StreetDpidString . ' } ';
            }
            //postal address or street address end 
            if (!empty($errors)) {
                return ['code' => 400, 'header' => 'EA Sale Submission API', 'output' => json_encode($errors), 'data' => 'Validation Error'];
            }
            $endGrapghQL = ' }) { id version vendorCode submitted quotes { id lastUpdated fuel status rejectionReasons { code detail } } } }" }';

            //combine all detail to make full graphQL structure
            $graphQLquery = $startGraphQL . ' id: \"' . $data['vendorID'] . '\" vendorCode: \"' . $data['vendorCode'] . '\" version: \"1\" saleDate: \"' . $data['saleDate'] . '\" customerType: ' . $data['customerType'] . ' transactionType: ' . $data['transactionType'] . $customer . $accountHolder . $buisnessDetail . $energisation . $premise . $offer . ' mailingAddressType: ' . $data['mailingAddressType'] . $postalAddress . $streetAddress . ' billDeliveryMethod: ' . $data['billDeliveryMethod'] . ' carbonNeutralOptIn: ' . $data['carbonNeutralOptIn'] . ' lifeSupport: ' . $data['lifeSupport'] . ' safetyFlag: ' . $data['safetyFlag'] . ' ' . $endGrapghQL;

            dd(1);
            //get okta token and use as bearer in sale submission API
            $accessToken = self::getOktaToken();
            
            //submit sale to API
            $data =  self::submitSaleToProvider($accessToken,$graphQLquery);
            $jsonResponse = json_encode($data);

            //store api response in Database
            $apirequest['visitor_id'] = $saleId;
            $apirequest['api_name'] = 'EA Sale Submission API';
            $apirequest['api_response'] = $jsonResponse;
            $apirequest['header_data'] = 'EA API Response';
            $apirequest['api_reference'] = $data['vendorID'];
            $apirequest['api_request'] = $graphQLquery;
             
            //return api response  if validation error
            if (isset($data['errors'])) {
                return ['code' => 400, 'header' => 'EA Sale Submission API', 'output' => $jsonResponse, 'data' => $graphQLquery];
            }

            //increament batch no
            SaleProduct::where('sale_id', $saleId)->update(['sale_submission_attempt' => $saleSubAttempt + 1]);

            //return api response
            if ($energy == 'both' && ($data['data']['submitSale']['quotes'][0]['status'] == 'REJECTED' || $data['data']['submitSale']['quotes'][1]['status'] == 'REJECTED')) {
                return ['code' => 400, 'header' => 'EA Sale Submission API', 'output' => $jsonResponse, 'data' => $graphQLquery];
            } 
            else if ($energy != 'both' && $data['data']['submitSale']['quotes'][0]['status'] == 'REJECTED') {
                return ['code' => 400, 'header' => 'EA Sale Submission API', 'output' => $jsonResponse, 'data' => $graphQLquery];
            }
            return ['code' => '200', 'header' => 'EA Sale Submission API', 'output' => $jsonResponse, 'data' => $graphQLquery];
        } catch (\Exception $e) {
            return $e->getMessage();
            return ['code' => 400, 'header' => 'EA Sale Submission API', 'output' => $e->getMessage(), 'data' => ''];
        }
    }

}
