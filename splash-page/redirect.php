<?php
require_once(dirname(__FILE__).'/../class/Utils.php');

$signedUrl = $_GET['signedUrl'];
$phone = $_GET['phone'];
$external = array_key_exists('external', $_GET);

$destination = 'http://audi-client.sundevs.cloud/#/' . $phone;

if (isset($external) && $external){
    $destination = 'googlechrome://navigate?url=' . $destination;
}
Log::print('Destination URL: ' . $destination, 'debug', __FILE__, __LINE__);
header('Location: ' . $destination);
Tool::perform_http_request('GET', $signedUrl);
?>