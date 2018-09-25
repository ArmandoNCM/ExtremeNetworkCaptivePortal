<?php
require_once(dirname(__FILE__).'/../class/Log.php');
require_once(dirname(__FILE__).'/../class/Utils.php');
require_once(dirname(__FILE__).'/../class/SimpleAWS.php');
require_once(dirname(__FILE__).'/../constants.php');

$token = $_POST['token'];
$username = $_POST['email'];
$client_mac = $_POST['client_mac'];
$access_point_mac = $_POST['access_point_mac'];
$controller_ip = $_POST['controller_ip'];
$controller_port = $_POST['controller_port'];
$wlanId = $_POST['wlan_identifier'];
$login_type = $_POST['login_type'];

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

if ($response && array_key_exists('response_code', $response)){
    $responseCode = $response['response_code'];
    if ($responseCode == 200){

        $body = json_decode($response['response_body']);

        $html_location_name = $body->location->name;
        $html_location_logo_url = $body->location->cover->url;
        $user_download_limit = $body->business->apSettings->download;
        $user_upload_limit = $body->business->apSettings->upload;
        $seconds_allowed = $body->business->apSettings->sessionSeconds;

        $location_data_retrieved = TRUE;
        
    } else {
        Log::print("Location Info query failed with HTTP Code: $responseCode", "error", __FILE__, __LINE__);
        Log::print("Response Body: " . $response['response_body'], "error", __FILE__, __LINE__);
    }
} else {
    Log::print("Query of Location Info failed, couldn't successfully consume 'locationInfo' WS", "error", __FILE__, __LINE__);
}


if (!isset($location_data_retrieved)){
    $html_location_name = 'Trinitip Store';
    $html_location_logo_url = 'assets/images/logo.png';
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

$valid_fields = TRUE;

if ($login_type == 'quick'){

    if (array_key_exists('negative_button', $_POST) && $_POST['negative_button']){
        $bypass_mac_lookup = TRUE;
        $html_form_hidden_fields_array = array(
            // TODO rebuild
        );
        // require_once(dirname(__FILE__) . '/../../../splash-page/index.php');
        return;
    }
} else {
    $full_login = TRUE;
    // TODO Check name and email and in case of error, show form with error and retry
    $person_name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
    //Email Validation
    $person_email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

    $birthdate = filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_STRING);

    $gender = filter_input(INPUT_POST, "gender", FILTER_SANITIZE_STRING);

    if ($person_email){
        strtolower(trim($person_email));
    } else {
        Log::print("Error in the email validation.", "error", __FILE__, __LINE__);
        $valid_fields = FALSE;
    }
}

if ($valid_fields) {

    $eventMessage = array(
        'nodeMac' => $access_point_mac,
        'mac' => $client_mac,
        'eventType' => 'in'
    );

    if ($full_login){
        $eventMessage['name'] = $person_name;
        $eventMessage['email'] = $person_email;
        $eventMessage['gender'] = $gender;
        $eventMessage['birthdate'] = $birthdate; // TODO change to 'birthdate'
    }

    $apiUrl = constant('API_URL') . 'ap/indoorEvents';
    $response = Tool::perform_http_request('POST', $apiUrl, json_encode($eventMessage));

    if ($response && array_key_exists('responseCode', $response)){
        $responseCode = $response['responseCode'];
        if ($responseCode == 200){

            $body = json_decode($response['responseBody']);

            if ($body->isVerified){
                // TODO do something
            } else {
                // TODO do something
            }
            
        } else {
            Log::print("Creation of IN event failed with HTTP Code: $responseCode", "error", __FILE__, __LINE__);
            Log::print("Response Body: " . $response['responseBody'], "error", __FILE__, __LINE__);
        }
    } else {
        Log::print("Creation of IN event failed, couldn't successfully consume 'indoorEvents' WS", "error", __FILE__, __LINE__);
    }
    
    header('Location: '.$signedUrl);
}

exit();
?>