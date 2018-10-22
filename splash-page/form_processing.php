<?php
require_once(dirname(__FILE__).'/../class/Log.php');
require_once(dirname(__FILE__).'/../class/Utils.php');
require_once(dirname(__FILE__).'/../lib/phpqrcode/qrlib.php');
require_once(dirname(__FILE__).'/../constants.php');

$token = $_POST['token'];
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

$city = filter_input(INPUT_POST, "city", FILTER_SANITIZE_STRING);

$phone = filter_input(INPUT_POST, "phone", FILTER_SANITIZE_STRING);
$phone = Tool::remove_non_numeric_characters($phone);

if ($person_email){
    strtolower(trim($person_email));
} else {
    Log::print("Error in the email validation.", "error", __FILE__, __LINE__);
    $valid_fields = FALSE;
}

if ($valid_fields) {

    $dataArray = array(
        'email' => $person_email,
        'phone' => $phone
    );

    $dataJson = json_encode($dataArray);

    $qrCodeContent = $dataJson;
    $qrCodePath = uniqid(hash('md5', $qrCodeContent)) . '.png';
    QRcode::png($qrCodeContent, $qrCodePath); 
    $data = file_get_contents($qrCodePath);
    // unlink($qrCodePath);
    $base64QrCode = base64_encode($data);
    
    $dataArray['city'] = $city;
    $dataArray['name'] = $person_name;
    $dataArray['mac'] = $client_mac;
    $dataArray['qrCode'] = $base64QrCode;

    $dataJson = json_encode($dataArray);

    // TODO consume WS sending information

    Log::print("Granting access to person:\n\n$dataJson", 'message', __FILE__, __LINE__);

    require_once(dirname(__FILE__).'/grant_access.php');   
}

?>