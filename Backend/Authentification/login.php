<?php
require('config.php');      

$redirect = 'https://accounts.google.com/o/oauth2/v2/auth?scope='. SCOPE .'&redirect_uri='. REDIRECT_URI .'&response_type=code&client_id='.GOOGLE_ID;
$response['redirect'] = $redirect;
echo json_encode($response);
?>