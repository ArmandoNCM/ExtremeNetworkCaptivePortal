<?php

require_once(dirname(__FILE__).'/class/Log.php');

$token = $_GET['token']; 
$access_point_mac = $_GET['bssid'];
$client_mac = $_GET['mac'];
$ssid = $_GET['ssid'];
$controller_ip = $_GET['hwc_ip'];
$controller_port = $_GET['hwc_port'];
$wlan_identifier = $_GET['wlan'];

$base_url = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']=='on' ? 'https' : 'http' ) . '://' .  $_SERVER['HTTP_HOST'];
$url = $base_url . $_SERVER["REQUEST_URI"];

$hidden_fields_array = array(
    'token' => $token,
    'access_point_mac' => $access_point_mac,
    'client_mac' => $client_mac,
    'controller_ip' => $controller_ip,
    'controller_port' => $controller_port,
    'wlan_identifier' => $wlan_identifier,
    'url' => $url  
);

Log::print("Showing Captive Portal to MAC: $client_mac", "message", __FILE__, __LINE__);

?>


<html>
<head>
    <meta charset="utf-8" />
    <title><?php echo "$ssid Captive Portal" ?></title>
</head>
<body>
    
    <h1><?php echo "Welcome to $ssid!" ?></h1>

    <h2><?php echo "Your MAC Address is: $client_mac" ?></h2>

    <br><br>

    <form action="form_processing.php" method="post">

        <!-- Hidden fields -->
        <?php
        foreach ($hidden_fields_array as $hidden_field => $value){
            echo "<input type='hidden' name='$hidden_field' value='$value'>";
        }
        ?>

        <label for="field_username">Username</label>
        <input id="field_username" type="text" name="username" required>
        <br>
        <input type="submit" value="Login">

    </form>
</body>
</html>