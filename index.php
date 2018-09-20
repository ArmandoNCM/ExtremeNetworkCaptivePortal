<?php

require_once(dirname(__FILE__).'/class/Log.php');

$token = $_GET['token'];
$access_point_mac = $_GET['bssid']; // VERY IMPORTANT
$client_mac = $_GET['mac']; // VERY IMPORTANT
$ssid = $_GET['ssid'];
$controller_ip = $_GET['hwc_ip'];
$controller_port = $_GET['hwc_port'];

$approval_script_url = "http://" . $controller_ip . ":" . $controller_port . "/approval.php";


$hidden_fields_array = array(
    'token' => $token,
    'filter' => 'CP_SPEEDWIAuthPolicy',
    'approval_script_url' => $approval_script_url
);

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
        <input id="field_username" type="text" name="username">
        <br>
        <input type="submit" value="Login">

    </form>
</body>
</html>