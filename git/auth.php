<?php
require "../classes/user.php";
session_start();
if (isset($_SESSION['userId'])) {
    $objUser = new User($_SESSION['userId']);
    $arrAccessToken = $objUser->getAccessToken(); 
    $arrAccessToken[] = array(rand(8,12), new MongoDate());
    $objUser->setAccessToken($arrAccessToken);
    $objUser->upsert();
    $strAccessToken = md5("userid:" . $_SESSION['userId'] . "accesstoken:" . $arrAccessToken[0]); 
    header('Location: ' . $_SESSION['redirectUri'] . '#access_token=' . $strAccessToken . '&token_type=example&expires_in=4301');
}
else {
    header('Location: ' . $_SESSION['redirectUri'] . '#error=access_denied');
}
?>