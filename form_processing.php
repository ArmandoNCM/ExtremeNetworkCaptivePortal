<?php
require_once(dirname(__FILE__).'/class/Log.php');
require_once(dirname(__FILE__).'/class/Utils.php');
require_once(dirname(__FILE__).'/class/SimpleAWS.php');

$token = $_POST['token'];
$username = $_POST['username'];
$url = $_POST['url'];
$controller_ip = $_POST['controller_ip'];
$controller_port = $_POST['controller_port'];

$keys = array(
    'AudiTest' => 'ThisIsASharedSecret'
);
$validationResult = SimpleAWS::getUrlValidationResult($url, $keys);
Log::print($validationResult, "message", __FILE__, __LINE__);

$unsignedUrl = SimpleAWS::makeUnsignedUrl($controller_ip, $controller_port, FALSE, $token, $username, NULL, NULL, NULL, 3 * 60); 

$signedUrl = SimpleAWS::createPresignedUrl($unsignedUrl, 'AudiTest', 'ThisIsASharedSecret', 'world', 'ecp', 30);

$validationResult = SimpleAWS::getUrlValidationResult($signedUrl, $keys);
Log::print("Second Validation: $validationResult", "message", __FILE__, __LINE__);

Log::print("Redirecting to: $signedUrl", "message", __FILE__, __LINE__);

header('Location: '.$signedUrl);
exit();

?>