<?php

require "../classes/user.php";
session_start();
if (isset($_SESSION['userId'])) {
    $objUser = new User($_SESSION['userId']); 
    $strEmail = $objUser->getEmail();
    $strName = $objUser->getName();
    $strId = $objUser->getId();
    $arrAccessTokens = $objUser->getAccessTokens(); 
    $arrNewAccessToken = array("token" => md5(mt_rand()), "createdDate" => new MongoDate());
    $arrAccessTokens[] = $arrNewAccessToken;  
    $objUser->setAccessTokens($arrAccessTokens);
    $objUser->upsert();
    if ($_SESSION['userNew'] = "Yes") {
        $strRedirectUri = "http://www.zowgle.com/client/thank-you-for-signing-up.php?userId=" . $strId . "#access_token=" . $arrNewAccessToken['token'] . "|" . $strId . "&token_type=example&expires_in=4301";
    } else {
        $strRedirectUri = "http://www.zowgle.com/client/dashboard.php?userId=" . $strId . "#access_token=" . $arrNewAccessToken['token'] . "|" . $strId . "&token_type=example&expires_in=4301";
    }
    echo '<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script><script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script><script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/googleapis/0.0.4/googleapis.min.js"></script><script type="text/javascript" src="https://ajax.googleapis.com/jsapi"></script><script type="text/javascript">google.load("identitytoolkit", "1", {packages: ["ac"]});</script><script type="text/javascript" src="../js/jquery.greentiger.js"></script><script type="text/javascript"> var strUrlImg = getUrlApi("users/" + "'. $strId .'" + "?part=image");var userData = {email: "'. $strEmail . '",displayName: "' . $strName . '", photoUrl: strUrlImg,};window.google.identitytoolkit.updateSavedAccount(userData);window.location = "'. $strRedirectUri.'"</script>';
}
?>