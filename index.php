<?php

require_once(dirname(__FILE__).'/constants.php');
require_once(dirname(__FILE__).'/class/Log.php');
require_once(dirname(__FILE__).'/class/Utils.php');
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

Log::print($_SERVER['HTTP_USER_AGENT'], 'browser-agent', __FILE__, __LINE__);
$browserData = get_browser(NULL, TRUE);
$browser = $browserData['browser'];
$platform = $browserData['platform'];
Log::print("Browser and Platform: $browser & $platform", "info", __FILE__, __LINE__);

if ($platform != 'Android'){
    $_GET['chrome'] = 'true';
}

// Get redirected URL
$base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
$url = $base_url . $_SERVER["REQUEST_URI"] . '&chrome=true';

$hidden_fields_array = array(
    'token' => $token,
    'access_point_mac' => $access_point_mac,
    'client_mac' => $client_mac,
    'controller_ip' => $controller_ip,
    'controller_port' => $controller_port,
    'wlan_identifier' => $wlan_identifier
);

$html_location_name = 'Trinitip Corferias';
$html_location_logo_url = '/ExtremeNetworksCaptivePortal/splash-page/assets/images/logo.png';

if (!array_key_exists('chrome', $_GET)){
    // Opened in default web view
    $hidden_fields_array['open_external_browser'] = TRUE;
}

require_once(dirname(__FILE__).'/splash-page/login_form.php');
?>