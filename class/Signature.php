<?php

require_once(dirname(__FILE__).'../constants.php');

class Signature {

    public static function signUrl($url, $scope, $date){
        
        $scope = explode('/', $scope, 2)[1];

        $url_parts = parse_url($url);

        $url_path_component = $url_parts['path'];
        $url_query_parameters = $url_parts['query'];
        $host_url = $url_parts['host'];

        $canonicalized_request_string =
        "GET\n"
        .$url_path_component."\n"
        .$url_query_parameters."\n"
        .'host:'.$host_url
        ."\n\nhost\nUNSIGNED-PAYLOAD";

        $stringToSign =
        "AWS4-HMAC-SHA256\n"
        .$date."\n"
        .$scope."\n"
        .hash('sha256', $canonicalized_request_string, FALSE);

        $signingKey = generateSigningKey($scope);

        return hash_hmac('sha256', $stringToSign, $signingKey, FALSE);
    }

    public static function generateSigningKey($scope){

        $scopeParts = explode("/", $scope);

        $date = $scopeParts[0];
        $region = $scopeParts[1];
        $service = $scopeParts[2];
        $tailString = $scopeParts[3];

        $shared_secret = "AWS4" . constant('SHARED_SECRET');
        
        $firstStep = hash_hmac('sha256', $date, $shared_secret, TRUE);

        $secondStep = hash_hmac('sha256', $region, $firstStep, TRUE);

        $thirdStep = hash_hmac('sha256', $service, $secondStep, TRUE);

        $fourthStep = hash_hmac('sha256', $tailString, $thirdStep, TRUE);

        return $fourthStep;
    }

}




?>