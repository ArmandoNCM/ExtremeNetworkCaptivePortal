<?php
require_once(dirname(__FILE__).'/class/Log.php');
require_once(dirname(__FILE__).'/class/Utils.php');
require_once(dirname(__FILE__).'/class/SimpleAWS.php');
require_once(dirname(__FILE__).'/../constants.php');

$token = $_POST['token'];
$username = $_POST['email'];
$controller_ip = $_POST['controller_ip'];
$controller_port = $_POST['controller_port'];
$wlanId = $_POST['wlan_identifier'];

$identity = 'AudiTest';
$shared_secret = 'ThisIsASharedSecret';

$keys = array(
    $identity => $shared_secret
);


$apiUrl = constant('API_URL') . 'ap/locationInfo';
$queryParameters = array(
    'mac' => $access_point_mac
);
$response = Tool::perform_http_request('GET', $apiUrl, $queryParameters);

if ($response && array_key_exists('responseCode', $response)){
    $responseCode = $response['responseCode'];
    if ($responseCode == 200){

        $body = json_decode($response['responseBody']);

        $html_location_name = $body->location->name;
        $html_location_logo_url = $body->location->cover->url;
        $user_download_limit = $body->business->apSettings->download;
        $user_upload_limit = $body->business->apSettings->upload;
        $seconds_allowed = $body->business->apSettings->sessionSeconds;

        $location_data_retrieved = TRUE;
        
    } else {
        Log::print("Location Info query failed with HTTP Code: $responseCode", "error", __FILE__, __LINE__);
        Log::print("Response Body: " . $response['responseBody'], "error", __FILE__, __LINE__);
    }
} else {
    Log::print("Query of Location Info failed, couldn't successfully consume 'locationInfo' WS", "error", __FILE__, __LINE__);
}


if (!isset($location_data_retrieved)){
    $html_location_name = 'Trinitip Store';
    $html_location_logo_url = constant('PROJECT_URL') . 'splash-page/assets/images/logo.png';
    $seconds_allowed = 5 * 60;
}


$useHttps = FALSE;
$assigned_role = NULL;
$destination = "https://www.google.com/";
$session_time = $seconds_allowed;

$unsignedUrl = SimpleAWS::makeUnsignedUrl($controller_ip, $controller_port, $useHttps, $token, $username, $wlanId, $assigned_role, $destination, $session_time);

$region = 'world';
$service = 'ecp';
$signature_expiration_time = 30;

$signedUrl = SimpleAWS::createPresignedUrl($unsignedUrl, $identity, $shared_secret, $region, $service, $signature_expiration_time);

header('Location: '.$signedUrl);
exit();
?>