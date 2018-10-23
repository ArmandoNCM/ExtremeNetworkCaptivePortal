<?php
require_once(dirname(__FILE__).'/../class/Log.php');
require_once(dirname(__FILE__).'/../class/Utils.php');
require_once(dirname(__FILE__).'/../class/SimpleAWS.php');
require_once(dirname(__FILE__).'/../constants.php');

$token = $_POST['token'];
$client_mac = $_POST['client_mac'];
$access_point_mac = $_POST['access_point_mac'];
$controller_ip = $_POST['controller_ip'];
$controller_port = $_POST['controller_port'];
$wlan_identifier = $_POST['wlan_identifier'];
$seconds_allowed = $_POST['seconds_allowed'];

$apiUrl = constant('API_URL') . '/exhibition-forms/expo-students/exists/' . $client_mac;
$apiResponse = Tool::perform_http_request('GET', $apiUrl);

$alreadyRegistered = (isset($apiResponse) && array_key_exists('response_code', $apiResponse) && $apiResponse['response_code'] == 204);

if (isset($alreadyRegistered) && $alreadyRegistered) {
    header('Location: /ExtremeNetworksCaptivePortal/splash-page/out_of_order.html');
    exit();
}

$valid_fields = TRUE;

// TODO Check name and email and in case of error, show form with error and retry
$person_name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
//Email Validation
$person_email = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL);

$birthdate = filter_input(INPUT_POST, "birthdate", FILTER_SANITIZE_STRING);
$identification_document = filter_input(INPUT_POST, "id_number", FILTER_SANITIZE_STRING);
$identification_document = Tool::remove_non_numeric_characters($identification_document);

if ($person_email){
    strtolower(trim($person_email));
} else {
    Log::print("Error in the email validation.", "error", __FILE__, __LINE__);
    $valid_fields = FALSE;
}

if ($valid_fields) {

    $bodyArray = array(
        'mac' => $client_mac,
        'idNumber' => $identification_document,
        'name' => $person_name,
        'email' => $person_email,
        'dob' => $birthdate
    );

    $bodyJson = json_encode($bodyArray);

    $apiUrl = constant('API_URL') . '/exhibition-forms/expo-students';
    $apiResponse = Tool::perform_http_request('POST', $apiUrl, $bodyJson);
    
    if (isset($apiResponse) && array_key_exists('response_code', $apiResponse)){

        if ($apiResponse['response_code'] == 201){
            // Registry successful
            Log::print("Successfully registered person on device with mac: $client_mac", 'message', __FILE__, __LINE__);
        } else {
            // Something went wrong
            Log::print("Something went wrong trying to register person on device with mac: $client_mac\nThe service responded with HTTP Code: " . $apiResponse['response_code'], 'error', __FILE__, __LINE__);

            Log::print("Response Body:\n\n" . $apiResponse['response_body'], 'debug', __FILE__, __LINE__);
        }
    } else {
        Log::print("The person registry API could not be consumed", 'error', __FILE__, __LINE__);
    }

    require_once(dirname(__FILE__).'/grant_access.php');   
}

?>