<?php
require '../../vendor/autoload.php';

use GuzzleHttp\Client;

$client = new Client([
    'timeout' => 2.0,
    'verify' => false
]);

function deleteMessage($client, $accessToken, $mailsId) {
    $query = "https://www.googleapis.com/gmail/v1/users/me/messages/";

    for($i = (int)0; $i < count($mailsId); $i++){
        $response = $client -> request('DELETE', $query.$mailsId[$i] ,[
            'headers' => [
                'Authorization' => 'Bearer '. $accessToken
            ]
        ]);
        //if not good delete
    }
    return $response;
}


function getMessage($client, $accessToken, $mailsId) {
    $query = "https://www.googleapis.com/gmail/v1/users/me/messages/";
    $response = [];
    for($i = (int)0; $i < count($mailsId); $i++){
        $result = $client -> request('GET', $query.$mailsId[$i] ,[
            'headers' => [
                'Authorization' => 'Bearer '. $accessToken
            ]
        ]);
        array_push($response, json_decode((string)$result ->getBody())) ;
        //if not good delete
    }
    return $response;
}


?>