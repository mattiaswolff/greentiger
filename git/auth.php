<?php
require "../classes/user.php";
session_start();
if (isset($_SESSION['userId'])) {
    $objUser = new User($_SESSION['userId']);
    $arrAccessTokens = $objUser->getAccessTokens(); 
    $arrNewAccessToken = array("token" => rand(8,12), "createdDate" => new MongoDate());
    $arrAccessTokens[] = $arrNewAccessToken;
    $objUser->setAccessTokens($arrAccessToken);
    echo var_dump($objUser);
    $objUser->upsert();
    $strAccessToken = md5("userid:" . $_SESSION['userId'] . "accesstoken:" . $arrNewAccessToken[0]); 
    header('Location: ' . $_SESSION['redirectUri'] . '#access_token=' . $strAccessToken . '&token_type=example&expires_in=4301');
}
else {
    header('Location: ' . $_SESSION['redirectUri'] . '#error=access_denied');
}
?>