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
$wlan_identifier = $_POST['wlan_identifier'];
$seconds_allowed = $_POST['seconds_allowed'];

$valid_fields = TRUE;

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

if ($valid_fields) {
    require_once(dirname(__FILE__).'/grant_access.php');   
}

?>