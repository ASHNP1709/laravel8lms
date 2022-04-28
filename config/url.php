<?php
return [
    'data_tool_request_key' => env('DATA_TOOL_REQUEST_KEY', 'RK-5B12D-921A3-40E40-07582-91095-B52FF-5C0DB-9E868'),
    'gnaf_search_url' => env('GNAF_SEARCH_URL', 'https://kleber.datatoolscloud.net.au/KleberWebServiceSoap/DtKleberService.svc?WSDL'),
    'gnaf_retrieve_url' => env('GNAF_RETRIEVE_URL', 'http://kleber-devuat.datatoolscloud.net.au/KleberWebServiceSoap/DtKleberService.svc?WSDL'),
    'data_tool_method_search' => env('DATA_TOOL_METHOD_SEARCH', 'DataTools.Capture.Address.Predictive.Gnaf.SearchAddress'),
    'data_tool_method_retrieve' => env('DATA_TOOL_METHOD_RETRIEVE', 'DataTools.Capture.Address.Predictive.Gnaf.RetrieveAddress'),
];
