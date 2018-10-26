<?php
require_once(dirname(__FILE__).'/../class/Utils.php');

$signedUrl = $_GET['signedUrl'];
$external = array_key_exists('external', $_GET);

$destination = 'http://audi-client.sundevs.cloud/#/';

if (isset($external) && $external){
    $destination = 'googlechrome://navigate?url=' . $destination;
}

Tool::perform_http_request('GET', $signedUrl);

header('Location: ' . $destination);

?>