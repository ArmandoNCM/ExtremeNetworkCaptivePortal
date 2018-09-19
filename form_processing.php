<?php
require_once(dirname(__FILE__).'/class/Log.php');
require_once(dirname(__FILE__).'/class/Utils.php');

$approval_script_url = $_POST['approval_script_url'];

$token = $_POST['token'];
$username = $_POST['username'];
$filter = $_POST['filter'];

$query_parameters = array(
    'token' => $token,
    'username' => $username,
    'filter' => $filter
);

$response = Utils::perform_http_request('GET', $approval_script_url, $query_parameters);

if (isset($response) && array_key_exists('response_code', $response)){
    $response_code = $response['response_code'];
    
    if (array_key_exists('response_body', $response)){
        $response_body = $response['response_body'];

        Log::print($response_body, "message", __FILE__, __LINE__);
    }
}

?>

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
    <title><?php echo "Success" ?></title>
</head>
<body>
    
    <h1><?php echo "We're pleased to serve you!" ?></h1>

</body>
</html>