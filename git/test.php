<!DOCTYPE HTML>
<html>
<head>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <script type="text/javascript" src="../js/jquery.js"></script>
    <script type="text/javascript" src="../js/jquery.greentiger.js"></script>
    <script type="text/javascript" src="../js/jquery.toObject.js"></script>
    <script type="text/javascript" src="../js/form2object.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/jquery-ui.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/googleapis/0.0.4/googleapis.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/jsapi"></script>
<script type="text/javascript">
  google.load("identitytoolkit", "1.0", {packages: ["ac"]});
</script>
<script type="text/javascript">
$(function() {
  window.google.identitytoolkit.setConfig({
    developerKey: "AIzaSyD_mpU7Xw4GeTmQNqHgIuZFVyPXdOyj6qY",
    companyName: "GreenTiger",
    callbackUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/callback.php",
    realm: "",
    userStatusUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/userstatus.php",
    loginUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/login.php",
    signupUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/signup.php",
    homeUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/git/index.php",
    logoutUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/git/signout.php",
    language: "en",
    idps: ["Gmail", "Yahoo", "AOL"],
    tryFederatedFirst: true,
    useCachedUserStatus: false
  });
  $("#navbar").accountChooser();
});
</script>
</head>
<body>
<?php
require "../classes/rest.php";
require "../classes/user.php";

$data = RestUtils::processRequest();  

switch($data->getMethod()) {  

    case 'get':
        $arrRequestVars = $data->getRequestVars();
        session_start();
        $_SESSION['redirectUri'] = (isset($arrRequestVars['redirectUri']) ? $arrRequestVars['redirectUri'] : null);
        $_SESSION['clientId'] = (isset($arrRequestVars['clientId']) ? $arrRequestVars['clientId'] : null);
        $_SESSION['scope'] = (isset($arrRequestVars['scope']) ? $arrRequestVars['scope'] : null);
        $_SESSION['responseType'] = (isset($arrRequestVars['responseType']) ? $arrRequestVars['responseType'] : null);
        $_SESSION['state'] = (isset($arrRequestVars['state']) ? $arrRequestVars['state'] : null);
        break;
    case 'post':
            RestUtils::sendResponse(400);
        break;
    case 'put':
            RestUtils::sendResponse(400);
        break;
    case 'delete':
            RestUtils::sendResponse(400);
        break;
}
echo var_dump($_SESSION);
?>

<div id="navbar"></div>

</body>
</html>