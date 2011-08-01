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
    header('Location: ' . $_SESSION['redirectUri'] . '#access_token=' . $arrNewAccessToken['token'] . '&token_type=example&expires_in=4301');
}
else {
    header('Location: ' . $_SESSION['redirectUri'] . '#error=access_denied');
}
?>