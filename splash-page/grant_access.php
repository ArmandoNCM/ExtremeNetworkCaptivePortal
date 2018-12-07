<?php

require_once(dirname(__FILE__).'/../constants.php');

if ($open_external_browser) {
    $destination = "googlechrome://navigate?url=https://redirect.sundevs.cloud";
} else {
    $destination = "https://redirect.sundevs.cloud";
}

$identity = constant('IDENTITY');
$shared_secret = constant('SHARED_SECRET');

$useHttps = FALSE;
$assigned_role = NULL;
$session_time = 3600 * 24;

$unsignedUrl = SimpleAWS::makeUnsignedUrl($controller_ip, $controller_port, $useHttps, $token, $username, $wlan_identifier, $assigned_role, $destination, $session_time);

$region = 'world';
$service = 'ecp';
$signature_expiration_time = 30;

$signedUrl = SimpleAWS::createPresignedUrl($unsignedUrl, $identity, $shared_secret, $region, $service, $signature_expiration_time);
Log::print("Attempting to Authenticate with Signed URL:\n\n\n--->   $signedUrl   <---", "info", __FILE__, __LINE__);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <script>
        window.onload = function() {
            fetch("<?php $signedUrl ?>");
            window.open("<?php $destination ?>");
        }
    </script>
</head>
<body>
    <h1>Redireccionando...</h1>
</body>
</html>