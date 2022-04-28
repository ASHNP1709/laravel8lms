<?php

namespace App\Http\Services; 

class PermissionsService
{ 
	public function getPermissionsList()
    {
		return [
		    'permissions_section' 
					=> array( 
						[ 
							'0' => 'Visit',
							'1' => 'show_visits', 
							'2' => '',
							'3' =>  [
										[
											'0' => 'Stage',
											'1' => 'visit_stage', 
											'2' => 'energy',
											'3' =>  
													[
														[
															'0' => 'Source',
															'1' => 'visit_source', 
															'2' => '',
														],
														[
															'0' => 'RC',
															'1' => 'visit_rc', 
															'2' => '',
														],
														[
															'0' => 'CUI',
															'1' => 'visit_cui',
															'2' => '', 
														],
														[
															'0' => 'UTM Resource',
															'1' => 'visit_utm_resource', 
															'2' => '',
														],
														[
															'0' => 'UTM Content',
															'1' => 'visit_utm_content', 
															'2' => '',
														], 
													]
										],
										[
											'0' => 'Affiliates',
											'1' => 'visit_affiliate_information', 
											'2' => '',
											'3' =>  
													[
														[
															'0' => 'Affiliate Name',
															'1' => 'visit_affiliate_name', 
															'2' => '',
														],
														[
															'0' => 'Affiliate Key',
															'1' => 'visit_affiliate_key', 
															'2' => '',
														],
														[
															'0' => 'Affiliate Email',
															'1' => 'visit_affiliate_email', 
															'2' => '',
														],
														[
															'0' => 'Affiliate Phone',
															'1' => 'visit_affiliate_phone', 
															'2' => '',
														],  
													]
										],
										[
											'0' => 'User Analytic Section',
											'1' => 'visit_user_analytices', 
											'2' => '',
											'3' =>  
													[
														[
															'0' => 'Browser',
															'1' => 'visit_browser', 
															'2' => '',
														],
														[
															'0' => 'Platform',
															'1' => 'visit_platform', 
															'2' => '',
														],
														[
															'0' => 'Device Type',
															'1' => 'visit_device_type', 
															'2' => '',
														],
														[
															'0' => 'User Agent',
															'1' => 'visit_user_agent', 
															'2' => '',
														],
														[
															'0' => 'Visit IP',
															'1' => 'visit_ip', 
															'2' => '',
														],
														[
															'0' => 'Visit Date',
															'1' => 'visit_date', 
															'2' => '',
														],
														[
															'0' => 'Latitude',
															'1' => 'visit_latitude', 
															'2' => '',
														], 
														[
															'0' => 'Longitude',
															'1' => 'visit_longitude', 
															'2' => '',
														],  
													]
										],
										[
											'0' => 'Plan Details Section',
											'1' => 'visit_plan_detail', 
											'2' => '',
											'3' =>  
													[
														[
															'0' => 'Plan Type',
															'1' => 'visit_plan_type', 
															'2' => '',
														],
														[
															'0' => 'Connection Type',
															'1' => 'visit_connection_type', 
															'2' => '',
														],
														[
															'0' => 'Data Usage Min',
															'1' => 'visit_data_usage_min', 
															'2' => '',
														],
														[
															'0' => 'Plan Cost Max',
															'1' => 'visit_plan_cost_max', 
															'2' => '',
														],
														[
															'0' => 'Current Provider',
															'1' => 'visit_current_provider', 
															'2' => '',
														],
														[
															'0' => 'Development Type',
															'1' => 'visit_developmet_type', 
															'2' => '',
														],
														[
															'0' => 'Service Type',
															'1' => 'visit_service_type', 
															'2' => '',
														], 
														[
															'0' => 'Plan Cost',
															'1' => 'visit_plan_cost', 
															'2' => '',
														],  
													]
												], 
									],            
						],
						[ 
							'0' => 'Lead',
							'1' => 'show_leads', 
							'2' => '',
							'3' =>  [
											[
												'0' => 'Stage',
												'1' => 'lead_stage', 
												'2' => '',
												'3' =>  []
											],
											[
												'0' => 'Affiliates',
												'1' => 'lead_affiliate_information', 
												'2' => '',
												'3' =>  
														[
															[
																'0' => 'Affiliate Name',
																'1' => 'lead_affiliate_name', 
																'2' => '',
															],
															[
																'0' => 'Affiliate Key',
																'1' => 'lead_affiliate_key', 
																'2' => '',
															],
															[
																'0' => 'Affiliate Email',
																'1' => 'lead_affiliate_email', 
																'2' => '',
															],
															[
																'0' => 'Affiliate Phone',
																'1' => 'lead_affiliate_phone', 
																'2' => '',
															],
															[
																'0' => 'Sub Affiliate Name',
																'1' => 'lead_affiliate_sub_affiliate_name', 
																'2' => '',
															], 
															[
																'0' => 'Referal Code Url Title',
																'1' => 'lead_referal_code_url', 
																'2' => '',
															],  
														]
											],
											[
												'0' => 'User Analytic Section',
												'1' => 'lead_user_analytices', 
												'2' => '',
												'3' =>  
														[
															[
																'0' => 'Browser',
																'1' => 'lead_browser', 
																'2' => '',
															],
															[
																'0' => 'Platform',
																'1' => 'lead_platform', 
																'2' => '',
															],
															[
																'0' => 'Device Type',
																'1' => 'lead_device_type', 
																'2' => '',
															],
															[
																'0' => 'User Agent',
																'1' => 'lead_user_agent', 
																'2' => '',
															],
															[
																'0' => 'Visit IP',
																'1' => 'lead_ip', 
																'2' => '',
															],
															[
																'0' => 'Visit Date',
																'1' => 'lead_date', 
																'2' => '',
															],
															[
																'0' => 'Latitude',
																'1' => 'lead_latitude', 
																'2' => '',
															], 
															[
																'0' => 'Longitude',
																'1' => 'lead_longitude', 
																'2' => '',
															],  
														]
											],
											[
												'0' => 'Customer Journey',
												'1' => 'lead_customer_journey', 
												'2' => '',
												'3' =>  [] 
											], 
											[
												'0' => 'Customer Information',
												'1' => 'lead_customer_information', 
												'2' => '',
												'3' =>  [] 
											], 
											[
												'0' => 'Identification Information',
												'1' => 'lead_identification_information', 
												'2' => '',
												'3' =>  [] 
											],
											[
												'0' => 'Address Details',
												'1' => 'lead_address_detail', 
												'2' => '',
												'3' =>  [] 
											], 
											[
												'0' => 'Installation Detail',
												'1' => 'lead_installation_detail', 
												'2' => '',
												'3' =>  [] 
											], 
											[
												'0' => 'Plan Information',
												'1' => 'lead_plan_information', 
												'2' => '',
												'3' =>  [] 
											], 
											[
												'0' => 'Plan Fees',
												'1' => 'lead_plan_fees', 
												'2' => '',
												'3' =>  [] 
											], 
											[
												'0' => "Included Addon's",
												'1' => 'lead_include_addons', 
												'2' => '',
												'3' =>  [] 
											], 
											[
												'0' => "Addon's",
												'1' => 'lead_addons', 
												'2' => '',
												'3' =>  [] 
											],
											[
												'0' => 'API Response',
												'1' => 'lead_api_response', 
												'2' => '',
												'3' =>  [] 
											], 
											[
												'0' => 'Connection Details',
												'1' => 'lead_connection_deatils', 
												'2' => '',
												'3' =>  [] 
											], 
											[
												'0' => 'Direct Debit Information',
												'1' => 'lead_direct_debit_information', 
												'2' => '',
												'3' =>  [
															[
																'0' => 'Detokenization Button',
																'1' => 'lead_detokenization_button', 
																'2' => '',
															],

														] 
											], 
											[
												'0' => 'Employment Details',
												'1' => 'lead_employement_detail', 
												'2' => '',
												'3' =>  [] 
											], 
											[
												'0' => 'Remarketing Logs',
												'1' => 'lead_remarketing_logs', 
												'2' => '',
												'3' =>  [] 
											], 

									],  
						],
						[ 
							'0' => 'Sale',
							'1' => 'show_sales', 
							'2' => '',
							'3' =>  [
										[
											'0' => 'Stage',
											'1' => 'sale_stage', 
											'2' => '',
											'3' =>  []
										],
										[
											'0' => 'Affiliate Information',
											'1' => 'sale_affiliate_information', 
											'2' => '',
											'3' =>  
													[
														[
															'0' => 'Affiliate Name',
															'1' => 'sale_affiliate_name', 
															'2' => '',
														],
														[
															'0' => 'Affiliate Key',
															'1' => 'sale_affiliate_key', 
															'2' => '',
														],
														[
															'0' => 'Affiliate Email',
															'1' => 'sale_affiliate_email', 
															'2' => '',
														],
														[
															'0' => 'Affiliate Phone',
															'1' => 'sale_affiliate_phone', 
															'2' => '',
														],
														[
															'0' => 'Sub Affiliate Name',
															'1' => 'sale_affiliate_sub_affiliate_name', 
															'2' => '',
														], 
														[
															'0' => 'Referal Code Url Title',
															'1' => 'sale_referal_code_url', 
															'2' => '',
														],  
													]
										],
										[
											'0' => 'User Analytic',
											'1' => 'sale_user_analytices', 
											'2' => '',
											'3' =>  
													[
														[
															'0' => 'Browser',
															'1' => 'sale_browser', 
															'2' => '',
														],
														[
															'0' => 'Platform',
															'1' => 'sale_platform', 
															'2' => '',
														],
														[
															'0' => 'Device Type',
															'1' => 'sale_device_type', 
															'2' => '',
														],
														[
															'0' => 'User Agent',
															'1' => 'sale_user_agent', 
															'2' => '',
														],
														[
															'0' => 'Visit IP',
															'1' => 'sale_ip', 
															'2' => '',
														],
														[
															'0' => 'Visit Date',
															'1' => 'sale_date', 
															'2' => '',
														],
														[
															'0' => 'Latitude',
															'1' => 'sale_latitude', 
															'2' => '',
														], 
														[
															'0' => 'Longitude',
															'1' => 'sale_longitude', 
															'2' => '',
														],  
													]
										],
										[
											'0' => 'Customer Journey',
											'1' => 'sale_customer_journey', 
											'2' => '',
											'3' =>  [] 
										], 
										[
											'0' => 'Customer Information',
											'1' => 'sale_customer_information', 
											'2' => '',
											'3' =>  [] 
										], 
										[
											'0' => 'Identification Information',
											'1' => 'sale_identification_information', 
											'2' => '',
											'3' =>  [] 
										],
										[
											'0' => 'Address Details',
											'1' => 'sale_address_detail', 
											'2' => '',
											'3' =>  [] 
										], 
										[
											'0' => 'Installation Detail',
											'1' => 'sale_installation_detail', 
											'2' => '',
											'3' =>  [] 
										], 
										[
											'0' => 'Plan Information',
											'1' => 'sale_plan_information', 
											'2' => '',
											'3' =>  [] 
										], 
										[
											'0' => 'Plan Fees',
											'1' => 'sale_plan_fees', 
											'2' => '',
											'3' =>  [] 
										], 
										[
											'0' => "Included Addon's",
											'1' => 'sale_include_addons', 
											'2' => '',
											'3' =>  [] 
										], 
										[
											'0' => "Addon's",
											'1' => 'sale_addons', 
											'2' => '',
											'3' =>  [] 
										],
										[
											'0' => 'API Response',
											'1' => 'sale_api_response', 
											'2' => '',
											'3' =>  [] 
										], 
										[
											'0' => 'Connection Details',
											'1' => 'sale_connection_detail', 
											'2' => '',
											'3' =>  [] 
										], 
										[
											'0' => 'Direct Debit Information',
											'1' => 'sale_direct_debit_information', 
											'2' => '',
											'3' =>  [
														[
															'0' => 'Detokenization Button',
															'1' => 'sale_detokenization_button', 
															'2' => '',
														],

													] 
										], 
										[
											'0' => 'Employment Details',
											'1' => 'sale_employement_detail', 
											'2' => '',
											'3' =>  [] 
										], 
										[
											'0' => 'Handset Information',
											'1' => 'sale_handset_information', 
											'2' => '',
											'3' =>  [] 
										], 
										[
											'0' => 'Remarketing Logs',
											'1' => 'sale_remarketing_logs', 
											'2' => '',
											'3' =>  [] 
										], 
										[
											'0' => 'Sale Status Information',
											'1' => 'sale_status_information', 
											'2' => '',
											'3' =>  [
														[
															'0' => 'Change Sale Status',
															'1' => 'sale_change_sale_status', 
															'2' => '',
														],
														[
															'0' => 'Sale Status History',
															'1' => 'sale_status_history', 
															'2' => '',
														],

													] 
										], 

									],  
						],
		            			         
		        ),
		];

    }
} 