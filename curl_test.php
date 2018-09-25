<?php


require_once(dirname(__FILE__).'/class/Utils.php');
require_once(dirname(__FILE__).'/constants.php');


$client_mac = 'D8:84:66:10:3C:C8';
$access_point_mac = '68:DB:CA:0B:E1:EB';

$apiUrl = constant('API_URL') . 'ap/personCanAccessToInternet';

$queryParameters = array(
    'mac' => $client_mac,
    'nodeMac' => $access_point_mac
);
$response = Tool::perform_http_request('GET', $apiUrl, $queryParameters);

if (isset($response) && array_key_exists('responseCode', $response)){
    $responseCode = $response['responseCode'];
    if ($responseCode == 200){
        $jsonBody = $response['responseBody'];
        $body = json_decode($jsonBody);
        $internetAvailable = $body->hasInternet;
    } else {
        print("Consumption of personCanAccessToInternet failed with HTTP Code: $responseCode"."\n");
        print("Response Body: " . $response['responseBody']."\n");
    }
} else {
    print("Couldn't successfully consume 'ap/personCanAccessToInternet' WS"."\n");
}


?>