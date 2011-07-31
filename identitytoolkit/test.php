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
    callbackUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/identitytoolkit/callback.php",
    realm: "",
    userStatusUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/identitytoolkit/userstatus.php",
    loginUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/identitytoolkit/login.php",
    signupUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/identitytoolkit/signup.php",
    homeUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/index.php",
    logoutUrl: "http://ec2-79-125-49-128.eu-west-1.compute.amazonaws.com/greentiger/identitytoolkit/signout.php",
    language: "en",
    idps: ["Gmail", "Yahoo", "AOL"],
    tryFederatedFirst: true,
    useCachedUserStatus: false
  });
  $("#navbar").accountChooser();
});
</script>
</head>

<div id="navbar"></div>         
</body>
</html>