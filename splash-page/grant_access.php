<?php

require_once(dirname(__FILE__).'/../constants.php');

$identity = constant('IDENTITY');
$shared_secret = constant('SHARED_SECRET');

$useHttps = FALSE;
$assigned_role = NULL;
$destination = "https://www.tarjetajoven.com/";
$session_time = 3600 * 24;

$unsignedUrl = SimpleAWS::makeUnsignedUrl($controller_ip, $controller_port, $useHttps, $token, $username, $wlan_identifier, $assigned_role, $destination, $session_time);

$region = 'world';
$service = 'ecp';
$signature_expiration_time = 30;

$signedUrl = SimpleAWS::createPresignedUrl($unsignedUrl, $identity, $shared_secret, $region, $service, $signature_expiration_time);

header('Location: '.$signedUrl);

exit();

?>