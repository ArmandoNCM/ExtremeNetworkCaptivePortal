<?php

$qrCodeName = $_GET['code'] . '.png';
$qrCodePath = '/opt/qrCodes/' . $qrCodeName;

if (file_exists($qrCodePath)){
    header("Content-Type: image/png");
    header('Content-Disposition: attachment; filename="' . basename($qrCodeName) . '"');
    @readfile($qrCodePath); 
} else {
    http_response_code(400);
}

?>