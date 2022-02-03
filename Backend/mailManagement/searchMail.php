<?php

require '../../vendor/autoload.php';


use GuzzleHttp\Client;

$client = new Client([
    'timeout' => 2.0,
    'verify' => false
]);


function searchMessage($client, $accessToken, $query) {
    $searchMails['status'] = false;

    $response = $client -> request('GET', $query,[
        'headers' => [
            'Authorization' => 'Bearer '. $accessToken
        ]
    ]);
    $response = json_decode((string)$response ->getBody());
    //dd($response); 
    if($response -> resultSizeEstimate > 0){
        $searchMails['message'] = $response -> messages;
        $searchMails['status'] = true;
    }
    
    return  $searchMails;
}



function getArrayMailId($arrayMail){
    $arrayId = [];
    for($i = (int)0; $i < count($arrayMail); $i++){
        array_push($arrayId, $arrayMail[$i] ->id);
    }
    return $arrayId;
}

function getSnippet($mails){
//-> snippet
    $arraySnippet= [];
    for($i = (int)0; $i < count($mails); $i++){
        array_push($arraySnippet, $mails[$i]-> snippet);
    }
    return $arraySnippet;
}

?>