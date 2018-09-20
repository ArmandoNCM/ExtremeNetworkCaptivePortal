<?php
require_once(dirname(__FILE__).'/class/Log.php');
require_once(dirname(__FILE__).'/class/Utils.php');

Log::print("Running form_processing.php", "message", __FILE__, __LINE__);

$approval_script_url = $_POST['approval_script_url'];

Log::print("Approval URL: $approval_script_url", "message", __FILE__, __LINE__);

$token = $_POST['token'];
$username = $_POST['username'];
$filter = $_POST['filter'];

$query_parameters = array(
    'token' => $token,
    'username' => $username,
    'filter' => $filter
);

$queryParametersJson = json_encode($query_parameters);

Log::print("Query Parameters of Approval HTTP GET:\n$queryParametersJson", "message", __FILE__, __LINE__);

/*
$response = Utils::perform_http_request('GET', $approval_script_url, $query_parameters);

if (isset($response) && array_key_exists('response_code', $response)){
    $response_code = $response['response_code'];
    
    Log::print("Response Code: $response_code", "message", __FILE__, __LINE__);

    if (array_key_exists('response_body', $response)){
        $response_body = $response['response_body'];

        Log::print($response_body, "message", __FILE__, __LINE__);
    }
} else {
    Log::print("Something went wrong making HTTP GET request", "error", __FILE__, __LINE__);
}
*/

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