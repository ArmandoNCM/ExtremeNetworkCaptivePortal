<?php
require_once(dirname(__FILE__).'/class/Log.php');
require_once(dirname(__FILE__).'/class/Utils.php');
require_once(dirname(__FILE__).'/class/SimpleAWS.php');

$token = $_POST['token'];
$username = $_POST['username'];
$amazon_signature = $_POST['amazon_signature'];
$amazon_credential = $_POST['amazon_credential'];
$amazon_date = $_POST['amazon_date'];
$url = $_POST['url'];

$keys = array(
    'AudiTest' => 'ThisIsASharedSecret'
);
$aux = SimpleAWS::getUrlValidationResult($url, $keys);

if (isset($aux)){
    Log::print($aux, "message", __FILE__, __LINE__);
} else {
    Log::print("Nothing!", "error", __FILE__, __LINE__);
}

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