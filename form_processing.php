<?php
require_once(dirname(__FILE__).'/class/Log.php');
require_once(dirname(__FILE__).'/class/Utils.php');
require_once(dirname(__FILE__).'/class/SimpleAWS.php');

$token = $_POST['token'];
$username = $_POST['username'];
$url = $_POST['url'];
$controller_ip = $_POST['controller_ip'];
$controller_port = $_POST['controller_port'];
$wlanId = $_POST['wlan_identifier'];

$identity = 'AudiTest';
$shared_secret = 'ThisIsASharedSecret';

$keys = array(
    $identity => $shared_secret
);
$validationResult = SimpleAWS::getUrlValidationResult($url, $keys);
Log::print($validationResult, "message", __FILE__, __LINE__);

$useHttps = FALSE;
$assigned_role = NULL;
$destination = "https://www.google.com/";
$session_time = 30 * 60;

$unsignedUrl = SimpleAWS::makeUnsignedUrl($controller_ip, $controller_port, $useHttps, $token, $username, $wlanId, $assigned_role, $destination, $session_time);

$region = 'world';
$service = 'ecp';
$signature_expiration_time = 30;

$signedUrl = SimpleAWS::createPresignedUrl($unsignedUrl, $identity, $shared_secret, $region, $service, $signature_expiration_time);

header('Location: '.$signedUrl);
exit();
?>