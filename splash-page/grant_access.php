<?php
require_once(dirname(__FILE__).'/../class/SimpleAWS.php');
require_once(dirname(__FILE__).'/../class/Log.php');
require_once(dirname(__FILE__).'/../constants.php');

$identity = constant('IDENTITY');
$shared_secret = constant('SHARED_SECRET');

$useHttps = FALSE;
$assigned_role = NULL;
$destination = 'http://audi-client.sundevs.cloud/#/'; // 'http://kenshin.sundevs.cloud/ExtremeNetworksCaptivePortal/qrCodes/' . $qrCodeName . '.png';
$session_time = 60;

Log::print('Destination URL: ' . $destination, 'debug', __FILE__, __LINE__);
$unsignedUrl = SimpleAWS::makeUnsignedUrl($controller_ip, $controller_port, $useHttps, $token, $person_email, $wlan_identifier, $assigned_role, $destination, $session_time);

$region = 'world';
$service = 'ecp';
$signature_expiration_time = 3600;

$signedUrl = SimpleAWS::createPresignedUrl($unsignedUrl, $identity, $shared_secret, $region, $service, $signature_expiration_time);

require_once(dirname(__FILE__).'/success.php');

exit();

?>
