<?php
require_once(dirname(__FILE__).'/../class/Utils.php');
require_once(dirname(__FILE__).'/../class/Log.php');
require_once(dirname(__FILE__).'/../constants.php');

$apiUrl = constant('API_URL') . 'ap/findPerson';
$queryParameters = array(
    'mac' => $client_mac
);
$response = Tool::perform_http_request('GET', $apiUrl, $queryParameters);

if ($response && array_key_exists('response_code', $response)){

    if ($response['response_code'] == 200){
        
        $jsonBodyString = $response['response_body'];

        $body = json_decode($jsonBodyString);

        Log::print("Find Person Body:\n$jsonBodyString", "message", __FILE__, __LINE__);

        if ($body->isFound){

            $isVerified = $body->isVerified;
            if (!$isVerified){
                $isBanned = $body->isBanned;
            }
            $personName = $body->name;
        }
    }
}

/**
 * The Form Process URL
 */
$html_form_process_url = '/ExtremeNetworksCaptivePortal/splash-page/form_processing.php'; // TODO get this from API

if (isset($hidden_fields_array)){

    // if (isset($bypass_mac_lookup) && $bypass_mac_lookup){
        // $html_page = 'full_login';
    // } else {

        // if (isset($isBanned) && $isBanned){
            // $html_page = 'banned_page';
        // } else {
            if (isset($personName)){
                // $html_page = 'quick_login';
                $html_page = 'grant_access';
            } else {
                $html_page = 'full_login';
            }
        // }
    // }
}

switch ($html_page){
    case 'full_login':
        require_once(dirname(__FILE__) . '/' . 'full_login_form.php');
        break;

    // case 'quick_login':
    //     require_once(dirname(__FILE__) . '/' . 'quick_login_form.php');
    //     break;

    // case 'banned_page':
    //     require_once(dirname(__FILE__) . '/' . 'banned_page.php');
    //     break;

    case 'grant_access':

        $eventMessage = array(
            'nodeMac' => $access_point_mac,
            'mac' => $client_mac,
            'eventType' => 'in'
        );

        $apiUrl = constant('API_URL') . 'ap/indoorEvents';
        $response = Tool::perform_http_request('POST', $apiUrl, json_encode($eventMessage));

        if ($response && array_key_exists('response_code', $response)){
            $response_code = $response['response_code'];
            if ($response_code == 200){

                $body = json_decode($response['response_body']);

                if ($body->isVerified){
                    // TODO do something
                } else {
                    // TODO do something
                }
                
            } else {
                Log::print("Creation of IN event failed with HTTP Code: $response_code", "error", __FILE__, __LINE__);
                Log::print("Response Body: " . $response['response_body'], "error", __FILE__, __LINE__);
            }
        } else {
            Log::print("Creation of IN event failed, couldn't successfully consume 'indoorEvents' WS", "error", __FILE__, __LINE__);
        }

        require_once(dirname(__FILE__) . '/' . 'grant_access.php');      
        break;
        
    default:
        require_once(dirname(__FILE__) . '/' . 'generic_splash.php');
        break;
}
?>