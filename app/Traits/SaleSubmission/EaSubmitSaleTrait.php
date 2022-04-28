<?php

namespace App\Traits\SaleSubmission;
use GuzzleHttp\Client;

trait EaSubmitSaleTrait
{
    function getOktaToken()
    {
            $guzzle = new Client; 
            $url = config('app.ea_okta_authorization_url');
            $response = $guzzle->post($url, [
                'form_params' => [
                    'grant_type' => 'client_credentials',
                    'client_id' => config('app.ea_okta_client_id'),
                    'client_secret' => config('app.ea_okta_client_secret'),
                    'scope' => 'integration',
                ],
            ]);
            return json_decode((string) $response->getBody(), true)['access_token'];
    }

    function submitSaleToProvider($accessToken,$graphQLquery)
    {
        $graphQLquery = '{"query":"mutation { submitSale(input: { id: \"16517095990\" vendorCode: \"CMT\" version: \"1\" saleDate: \"2022-01-17T10:00:00Z\" customerType: RES transactionType: PS customer: { title: \"Miss\" firstName: \"kirti\" lastName: \"Pathania\" emailAddress: \"kirtipathania@cimet.com.au\" dateOfBirth: \"1996-09-18\" phone: [ { type: MOBILE number: \"0420580919\" } ] preferredContactMethod: EMAIL premiseRelationship: TENANT identification: { type: PASSPORT number: \"565656\" firstName: \"kirti\" lastName: \"Pathania\" countryOfIssue: \"AUS\" } } premise: { address: { streetNumber: \"25\" streetName: \"Barangaroo\" streetType: \"Ave\" suburb: \"BARANGAROO\" state: NSW postcode: \"2300\" } solarDetails: { solarPower: false timeOfUse: false } } offers: [ { fuel: ELE planId: \"RSOT-EN\" sourceCode: \"Basic\" greenEnergyPercentage: 0 } ] mailingAddressType: STREET streetMailingAddress: { streetNumber: \"25\" streetName: \"Barangaroo\" streetType: \"Ave\" suburb: \"BARANGAROO\" state: NSW postcode: \"2300\" } billDeliveryMethod: EMAIL carbonNeutralOptIn: false lifeSupport: false safetyFlag: false }) { id version vendorCode submitted quotes { id lastUpdated fuel status rejectionReasons { code detail } } } }"}'; 
        
        $response = (new Client)->request('post', config('app.ea_sale_submission_url'), [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type' => 'application/json',
                'X-EA-Env' => config('app.x_ea_env')
            ],
            'body' => $graphQLquery
        ]);
        return json_decode((string) $response->getBody(), true);
    }
}
