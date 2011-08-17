<?php
require "../classes/user.php";
session_start();
if (isset($_SESSION['userId'])) {
    $objUser = new User($_SESSION['userId']);
    $arrAccessTokens = $objUser->getAccessTokens(); 
    $arrNewAccessToken = array("token" => md5(mt_rand()), "createdDate" => new MongoDate());
    $arrAccessTokens[] = $arrNewAccessToken;
    $objUser->setAccessTokens($arrAccessTokens);
    $objUser->upsert();
    echo var_dump($_SESSION);
    die();
    //header('Location: ' . $_SESSION['redirectUri'] . '#access_token=' . $arrNewAccessToken['token'] . "|" . $objUser->getId() . '&token_type=example&expires_in=4301');
    header('Location: http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/client/dashboard.php');
}
else {
    header('Location: ' . $_SESSION['redirectUri'] . '#error=access_denied');
}
?>