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
    $strRedirectUri = (isset($_SESSION['redirectUri']) ? $_SESSION['redirectUri'] : "http://ec2-46-51-141-34.eu-west-1.compute.amazonaws.com/greentiger/client/dashboard.php?userId=me");  
    header('Location: ' . $strRedirectUri . '#access_token=' . $arrNewAccessToken['token'] . "|" . $objUser->getId() . '&token_type=example&expires_in=4301');
}
else {
    header('Location: ' . $_SESSION['redirectUri'] . '#error=access_denied');
}
?>