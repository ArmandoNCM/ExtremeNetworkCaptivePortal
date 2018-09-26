<?php

$identity = 'AudiTest';
$shared_secret = 'ThisIsASharedSecret';

$keys = array(
    $identity => $shared_secret
);

$useHttps = FALSE;
$assigned_role = NULL;
$destination = "https://www.google.com/";
$session_time = $seconds_allowed;

$unsignedUrl = SimpleAWS::makeUnsignedUrl($controller_ip, $controller_port, $useHttps, $token, $username, $wlan_identifier, $assigned_role, $destination, $session_time);

$region = 'world';
$service = 'ecp';
$signature_expiration_time = 30;

$signedUrl = SimpleAWS::createPresignedUrl($unsignedUrl, $identity, $shared_secret, $region, $service, $signature_expiration_time);

header('Location: '.$signedUrl);

exit();

?>