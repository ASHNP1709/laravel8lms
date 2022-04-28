<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AffiliateTemplateAttribute extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->data();
        DB::table('affiliate_template_attribute')->insert($data);
    }

    public function data()
    {
        return [
            [
                'source_type' => "0",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{twitter}}}'
            ],
            [
                'source_type' => "0",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{youtube}}}'
            ],
            [
                'source_type' => "0",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{facebook}}}'
            ],
            [
                'source_type' => "0",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{linkedin}}}'
            ],
            [
                'source_type' => "0",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{google_plus}}}'
            ],
            [
                'source_type' => "0",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{customer_name}}}'
            ],
            [
                'source_type' => "0",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{customer_email}}}'
            ],
            [
                'source_type' => "0",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{customer_number}}}'
            ],
            [
                'source_type' => "0",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{Sale-Date}}}'
            ],
            [
                'source_type' => "3",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{provider_name}}}'
            ],
            [
                'source_type' => "3",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{provider_number}}}'
            ],
            [
                'source_type' => "3",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{provider_logo}}}'
            ],
            [
                'source_type' => "3",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{provider_term_conditions}}'
            ],
            [
                'source_type' => "3",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{plan_name}}}'
            ],

            [
                'source_type' => "3",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{plan_detail_link}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '0',
                'template_type' => '3',
                'attribute' => '{{{gas_provider_name}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '0',
                'template_type' => '3',
                'attribute' => '{{{gas_provider_phone_number}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '0',
                'template_type' => '4',
                'attribute' => '{{{gas_plan_name}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '0',
                'template_type' => '4',
                'attribute' => '{{{gas_plan_detail_link}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{suburb}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{unsubscribe_url}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_1_display}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_1_provider_name}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_1_provider_logo}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_1_name}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_1_discount}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_1_discount_description}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_1_benefit_term}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_1_exit_fee}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_1_terms_description}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_1_dmo_percentage}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_1_dmo_less_more_text}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_1_dmo_content}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_2_display}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_2_provider_name}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_2_provider_logo}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_2_name}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_2_discount}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_2_discount_description}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_2_benefit_term}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_2_exit_fee}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_2_terms_description}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_2_dmo_percentage}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_2_dmo_less_more_text}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_2_dmo_content}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_3_provider_name}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_3_provider_logo}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_3_name}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_3_discount}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_3_discount_description}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_3_benefit_term}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_3_exit_fee}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_3_terms_description}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_3_dmo_percentage}}}'
            ],

            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_3_dmo_percentage}}}'
            ],

            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{plan_3_dmo_content}}}'
            ],

            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{dmo_vdo_text}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '4',
                'template_type' => '0',
                'attribute' => '{{{SignUp_Plan_Listing_Link}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '1',
                'email_type' => '4',
                'template_type' => '0',
                'attribute' => '{{{SignUp_Plan_Detail_Link}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '2',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{Handset-Name}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '2',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{Plan-Name}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '2',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{reference-number}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '2',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{Variant-Name}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '2',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{RAM}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '2',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{Internal-Storage}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '2',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{Color}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '2',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{Contract-Term}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{Plan_Name_1}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{Critical-Information-Summary}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{Terms-And-Conditions}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{NBN-Key-Fact}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{Reference-Number}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '{{{Property-Address}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Unsubscribe_Url}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Name_1}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Provider_Name_1}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Provider_Logo_1}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Cost_1}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Discount_1}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Discount_Description_1}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Termination_Fee_1}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Critical_Information_Summary_1}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Terms_And_Conditions_1}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{NBN_Key_Fact_1}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Name_2}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Provider_Name_2}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Provider_Logo_2}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Cost_2}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Discount_2}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Discount_Description_2}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Plan_Termination_Fee_2}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Critical_Information_Summary_2}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Terms_And_Conditions_2}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{NBN_Key_Fact_2}}}'
            ],
            [
                'source_type' => "1",
                'service_id' => '3',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '{{{Customer_Property_Address}}}'
            ],
            [
                'source_type' => "2",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '@User-Email@'
            ],
            [
                'source_type' => "2",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '@User-Phone-Number@'
            ],
            [
                'source_type' => "2",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '@User-name@'
            ],
            [
                'source_type' => "2",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '@Suburb@'
            ],
            [
                'source_type' => "2",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '@State@'
            ],
            [
                'source_type' => "2",
                'service_id' => '0',
                'email_type' => '0',
                'template_type' => '0',
                'attribute' => '@Postcode@'
            ],
            [
                'source_type' => "2",
                'service_id' => '0',
                'email_type' => '2',
                'template_type' => '0',
                'attribute' => '@Remarketing-link@'
            ],

        ];
    }
}
