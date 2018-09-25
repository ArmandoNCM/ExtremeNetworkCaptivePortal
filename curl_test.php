<?php


// require_once(dirname(__FILE__).'/class/Utils.php');
require_once(dirname(__FILE__).'/constants.php');


$client_mac = 'D8:84:66:10:3C:C8';
$access_point_mac = '68:DB:CA:0B:E1:EB';

$apiUrl = constant('API_URL') . 'ap/personCanAccessToInternet';

$queryParameters = array(
    'mac' => $client_mac,
    'nodeMac' => $access_point_mac
);

$method = 'GET';

$data = $queryParameters;

print("A\n");

$curl = curl_init();

print("B\n");

switch ($method) {
    case "POST":
        print("AA\n");
        curl_setopt($curl, CURLOPT_POST, 1);

        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            "Cache-Control: no-cache",
            "Content-Type: application/json",
        ));

        if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        break;
    case "PUT":
        print("BB\n");
        curl_setopt($curl, CURLOPT_PUT, 1);
        break;
    default:
        print("CC\n");
        if ($data){
            print("D\n");
            $url = sprintf("%s?%s", $url, http_build_query($data));
        }
}


curl_setopt($curl, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
curl_setopt($curl, CURLOPT_TIMEOUT, 30);
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

print("E\n");

$response_body = curl_exec($curl);

print("F\n");

$response_code = curl_getinfo($curl, CURLINFO_RESPONSE_CODE);

print("G\n");

$err = curl_error($curl);

$response = FALSE;
if ($err) {
    print("cURL Error #: " . json_encode($err)."\n");
} else {
    $response = array(
        'response_body' => $response_body,
        'response_code' => $response_code
    );
}
curl_close($curl);

print("H\n");


// $response = Tool::perform_http_request('GET', $apiUrl, $queryParameters);

if (isset($response)){
    var_dump($response);
    print("\n\n");
}

if (isset($response) && array_key_exists('responseCode', $response)){
    $responseCode = $response['responseCode'];
    if ($responseCode == 200){
        $jsonBody = $response['responseBody'];
        $body = json_decode($jsonBody);
        $internetAvailable = $body->hasInternet;
    } else {
        print("Consumption of personCanAccessToInternet failed with HTTP Code: $responseCode"."\n");
        print("Response Body: " . $response['responseBody']."\n");
    }
} else {
    print("Couldn't successfully consume 'ap/personCanAccessToInternet' WS"."\n");
}


?>