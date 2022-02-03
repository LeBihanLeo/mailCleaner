<?php
require '../../vendor/autoload.php';

session_start();
if(!isset($_SESSION["email"])){
    header("login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secret</title>
</head>
<body>
    <h1>Hello secret page you are login now GG!!</h1>
    <?php dd($_SESSION) ?>
</body>
</html>