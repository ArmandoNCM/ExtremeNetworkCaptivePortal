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
$seconds_allowed = 5 * 60;

$hidden_fields_array['seconds_allowed'] = $seconds_allowed;



$alreadyRegistered = FALSE;

if (isset($alreadyRegistered) && $alreadyRegistered) {
    Log::print("The person device with mac: $client_mac CAN access to internet", "message", __FILE__, __LINE__);
    Log::print("Client Device with Mac: $client_mac is given access for " . $seconds_allowed . " seconds", "message", __FILE__, __LINE__);
    require_once(dirname(__FILE__).'/splash-page/out_of_order.php');
} else {
    Log::print("The person device with mac: $client_mac CAN NOT access to internet", "message", __FILE__, __LINE__);
    Log::print("Client Device with Mac: $client_mac is not yet authenticated", "message", __FILE__, __LINE__);
    require_once(dirname(__FILE__).'/splash-page/full_login_form.php');
}


?>