<?php

$qrCodeName = $_GET['code'] . '.png';
$qrCodePath = '/opt/qrCode/' . $qrCodeName;

if (file_exists($qrCodePath)){
    header("Content-Type: image/png");
    header('Content-Disposition: attachment; filename="' . $qrCodeName . '"');
    @readfile($qrCodePath); 
} else {
    http_response_code(402);
}

?>