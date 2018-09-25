<?php

require_once(dirname(__FILE__).'/class/Log.php');
require_once(dirname(__FILE__).'/class/Utils.php');
require_once(dirname(__FILE__).'/class/SimpleAWS.php');
require_once(dirname(__FILE__).'/constants.php');

$token = $_GET['token']; 
$access_point_mac = $_GET['bssid'];
$client_mac = $_GET['mac'];
$ssid = $_GET['ssid'];
$controller_ip = $_GET['hwc_ip'];
$controller_port = $_GET['hwc_port'];
$wlan_identifier = $_GET['wlan'];

Log::print("Redirecting unauthenticated traffic by MAC: $client_mac", "message", __FILE__, __LINE__);

$base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
$url = $base_url . $_SERVER["REQUEST_URI"];

$hidden_fields_array = array(
    'token' => $token,
    'access_point_mac' => $access_point_mac,
    'client_mac' => $client_mac,
    'controller_ip' => $controller_ip,
    'controller_port' => $controller_port,
    'wlan_identifier' => $wlan_identifier
);

$identity = 'AudiTest';
$shared_secret = 'ThisIsASharedSecret';

$keys = array(
    $identity => $shared_secret
);
$validationResult = SimpleAWS::getUrlValidationResult($url, $keys);
Log::print($validationResult, "message", __FILE__, __LINE__);


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
        Log::print("Consumption of personCanAccessToInternet failed with HTTP Code: $responseCode", "error", __FILE__, __LINE__);
        Log::print("Response Body: " . $response['responseBody'], "error", __FILE__, __LINE__);
    }
} else {
    Log::print("Couldn't successfully consume 'ap/personCanAccessToInternet' WS", "error", __FILE__, __LINE__);
}

if (isset($internetAvailable) && $internetAvailable) {
    Log::print("The person device with mac: $client_mac CAN access to internet", "message", __FILE__, __LINE__);
    Log::print("Client Device with Mac: $client_mac is given access for " . $seconds_allowed . " seconds", "message", __FILE__, __LINE__);

} else {
    Log::print("The person device with mac: $client_mac CAN NOT access to internet", "message", __FILE__, __LINE__);
    Log::print("Client Device with Mac: $client_mac is not yet authenticated", "message", __FILE__, __LINE__);
    require_once(dirname(__FILE__).'/splash-page/prepare_login.php');
}



?>