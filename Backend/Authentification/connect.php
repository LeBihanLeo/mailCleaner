<?php
require '../../vendor/autoload.php';
require 'config.php';

use GuzzleHttp\Client;

$ca =  __dir__.'/cacert.pem';


$client = new Client([
    'timeout' => 2.0,
    'verify' => false
]);


try{
    $response = $client -> request('GET', 'https://accounts.google.com/.well-known/openid-configuration');
    $discoveryJSON = json_decode((string)$response -> getBody());
    $tokenEndpoint = $discoveryJSON-> token_endpoint;
    $userInfoEndpoint = $discoveryJSON-> userinfo_endpoint;


    $response = $client -> request('POST', $tokenEndpoint, [
        'form_params' => [
            'code' => $_GET['code'],
            'client_id' => GOOGLE_ID,
            'client_secret' => GOOGLE_SECRET,
            'redirect_uri' => REDIRECT_URI,
            'grant_type' => 'authorization_code'
        ]
    ]);
    $accessToken = json_decode((string)$response -> getBody())-> access_token;

} catch(\GuzzleHttp\Exception\ClientException $e){
    dd($e->getMessage());
}
echo "yooo";
session_start();

$_SESSION['accessToken'] = $accessToken;

//header('Location: /Backend/mailManagement/mailController.php');
header('Location: /FrontEnd/cleaner.html');

//exit();

//SEARCH MAIL
/*
$query = "https://www.googleapis.com/gmail/v1/users/me/messages?q=is:read category:promotions";

    $response = $client -> request('GET', $query,[
        'headers' => [
            'Authorization' => 'Bearer '. $accessToken
        ]
    ]);
    $response = json_decode((string)$response ->getBody());
    dd($response);
    /*if($response -> email_verified === true){
        session_start();
        echo "\nCongratulation email verified\n";
        $_SESSION['email'] = $response -> email;
        //header('Location: /Backend/Authentification/secret.php');
        exit();
    }
    else{
        echo "\nEmail not verified\n";
    }*/

?>