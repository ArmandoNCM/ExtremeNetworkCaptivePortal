<?php

require_once(dirname(__FILE__).'/constants.php');
require_once(dirname(__FILE__).'/class/Log.php');
require_once(dirname(__FILE__).'/class/Utils.php');
require_once(dirname(__FILE__).'/class/SimpleAWS.php');
require_once(dirname(__FILE__).'/class/MacFormatter.php');

// Get authorization data
$token = $_GET['token']; 
$access_point_mac = $_GET['bssid'];
$access_point_mac = MacFormatter::formatMac($access_point_mac);
$client_mac = $_GET['mac'];
$client_mac = MacFormatter::formatMac($client_mac);
$controller_ip = $_GET['hwc_ip'];
$controller_port = $_GET['hwc_port'];
$wlan_identifier = $_GET['wlan'];

Log::print("Redirecting unauthenticated traffic by MAC: $client_mac", "message", __FILE__, __LINE__);

// Get redirected URL
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

$identity = constant('IDENTITY');
$shared_secret = constant('SHARED_SECRET');

$keys = array(
    $identity => $shared_secret
);
$validationResult = SimpleAWS::getUrlValidationResult($url, $keys);
Log::print($validationResult, "message", __FILE__, __LINE__);

$html_location_name = 'Trinitip Corferias';
$html_location_logo_url = '/ExtremeNetworksCaptivePortal/splash-page/assets/images/logo.png';
$seconds_allowed = 60 * 20;

$hidden_fields_array['seconds_allowed'] = $seconds_allowed;

$apiUrl = constant('API_URL') . '/exhibition-forms/expo-students/exists/' . $client_mac;
$apiResponse = Tool::perform_http_request('GET', $apiUrl);

$alreadyRegistered = (isset($apiResponse) && array_key_exists('response_code', $apiResponse) && $apiResponse['response_code'] == 204);

if (isset($alreadyRegistered) && $alreadyRegistered) {
    // Log::print("New Login attempt by the person device with mac: $client_mac BLOCKED", "message", __FILE__, __LINE__);
    // header('Location: /ExtremeNetworksCaptivePortal/splash-page/out_of_order.html');
    require_once(dirname(__FILE__) . '/grant_access.php');
    exit();
} else {
    require_once(dirname(__FILE__).'/splash-page/login_form.php');
}


?>