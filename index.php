<?php

require_once(dirname(__FILE__).'/constants.php');
require_once(dirname(__FILE__).'/class/Log.php');
require_once(dirname(__FILE__).'/class/Utils.php');
require_once(dirname(__FILE__).'/class/SimpleAWS.php');
require_once(dirname(__FILE__).'/class/MacFormatter.php');

$browserData = get_browser(NULL, TRUE);
$browser = $browserData['browser'];
$platform = $browserData['platform'];
$open_external_browser = ($platform === 'Android');
Log::print("Browser and Platform: $browser & $platform", "info", __FILE__, __LINE__);

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

$hidden_fields_array = array(
    'token' => $token,
    'access_point_mac' => $access_point_mac,
    'client_mac' => $client_mac,
    'controller_ip' => $controller_ip,
    'controller_port' => $controller_port,
    'wlan_identifier' => $wlan_identifier,
    'open_external_browser' => $open_external_browser
);

$apiUrl = constant('API_URL') . '/exhibition-forms/expo-cund/exists/' . $client_mac;
$apiResponse = Tool::perform_http_request('GET', $apiUrl);

$alreadyRegistered = (isset($apiResponse) && array_key_exists('response_code', $apiResponse) && $apiResponse['response_code'] == 204);

if (isset($alreadyRegistered) && $alreadyRegistered) {
    require_once(dirname(__FILE__) . '/splash-page/grant_access.php');
} else {
    require_once(dirname(__FILE__).'/splash-page/login_form.php');
}


?>