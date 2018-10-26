<?php
require_once(dirname(__FILE__).'/../class/Utils.php');

header('Location: ' . $destination);

$signedUrl = $_GET['signedUrl'];
$external = array_key_exists('external', $_GET);

$destination = 'http://audi-client.sundevs.cloud/#/';

if (isset($external) && $external){
    $destination = 'googlechrome://navigate?url=' . $destination;
}
Log::print('Destination URL: ' . $destination, 'debug', __FILE__, __LINE__);

Tool::perform_http_request('GET', $signedUrl);
?>