<?php

require '../../vendor/autoload.php';
require '../Authentification/config.php';
require './deleteMail.php';
require './searchMail.php';

use GuzzleHttp\Client;

$client = new Client([
    'timeout' => 2.0,
    'verify' => false
]);


$_POST['query'] = "is:read category:promotions";


session_start();
if(!isset($_SESSION['accessToken']) || !isset($_POST['query'])){
    header("../Authentification/connect.php");
    exit();
}

$accessToken = $_SESSION['accessToken'];
$query = "https://www.googleapis.com/gmail/v1/users/me/messages?q=".$_POST['query'];
//"https://www.googleapis.com/gmail/v1/users/me/messages?q=is:read category:promotions";



echo json_encode(searchAndDelete($client, $accessToken, $query));




function searchAndDelete($client, $accessToken, $query){

    $messages = searchMessage($client, $accessToken, $query);
    $result['nbmMails'] = 0;
        if($messages['status'] === true){
        $mailsId = getArrayMailId($messages['message']);
        $result['nbmMails'] = count($mailsId); 
        $result['mailSnippet'] = getSnippet(getMessage($client, $accessToken, $mailsId));
        deleteMessage($client, $accessToken, $mailsId);
    }
    return $result; 
}






/*

"<br />
<b>Warning</b>:  Undefined array key "mails" in <b>D:\leo\Projet\Code\GmailAPI\Backend\mailManagement\mailController.php</b> on line <b>36</b><br />
<br />
<b>Fatal error</b>:  Uncaught TypeError: Unsupported operand types: null + string in D:\leo\Projet\Code\GmailAPI\Backend\mailManagement\mailController.php:36
Stack trace:
#0 D:\leo\Projet\Code\GmailAPI\Backend\mailManagement\mailController.php(24): searchAndDelete(Object(GuzzleHttp\Client), 'ya29.A0ARrdaM9W...', 'https://www.goo...')
#1 {main}
  thrown in <b>D:\leo\Projet\Code\GmailAPI\Backend\mailManagement\mailController.php</b> on line <b>36</b><br />
"

*/

?>